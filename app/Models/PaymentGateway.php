<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Class PaymentGateway
 */
class PaymentGateway extends MyBaseModel
{
    use HasFactory;

    public $timestamps = false;

    /**
     * @return array
     */
    public static function getAllWithDefaultSet(): array
    {
        $payment_gateways = PaymentGateway::all()->toArray();
        $payment_gateway = PaymentGateway::select('id')->where('default', 1)->get()->first();
        if (empty($payment_gateway)) {
            $default_payment_gateway_id = config('attendize.default_payment_gateway');
            foreach ($payment_gateways as &$payment_gateway) {
                if ($payment_gateway['id'] == $default_payment_gateway_id) {
                    $payment_gateway['default'] = 1;
                }
            }
        }

        return $payment_gateways;
    }

    /**
     * @return \Illuminate\Config\Repository|mixed
     */
    public static function getDefaultPaymentGatewayId()
    {
        $payment_gateway = PaymentGateway::select('id')->where('default', 1)->get()->first();
        if (empty($payment_gateway)) {
            $default_payment_gateway_id = config('attendize.default_payment_gateway');

            return $default_payment_gateway_id;
        }

        return $payment_gateway['id'];
    }
}
