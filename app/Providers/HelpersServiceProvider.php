<?php

namespace App\Providers;

use App\Attendize\PaymentUtils;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot(): void
    {
        require app_path('Helpers/helpers.php');
        require app_path('Helpers/strings.php');
        $this->paymentUtils();
    }

    /**
     * Add blade custom if for PaymentUtils
     */
    public function paymentUtils(): void
    {
        Blade::if(
            'isFree',
            static function ($amount) {
                return PaymentUtils::isFree($amount);
            }
        );
        Blade::if(
            'requiresPayment',
            static function ($amount) {
                return PaymentUtils::requiresPayment($amount);
            }
        );
    }

    /**
     * Register the application services.
     */
    public function register(): void
    {
    }
}
