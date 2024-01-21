<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
            'order_status_id' => function () {
                return \App\Models\OrderStatus::factory()->create()->id;
            },
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'ticket_pdf_path' => '/ticket/pdf/path',
            'order_reference' => $this->faker->text(15),
            'transaction_id' => $this->faker->text(50),
            'discount' => .20,
            'booking_fee' => .10,
            'organiser_booking_fee' => .10,
            'order_date' => Carbon::now(),
            'notes' => $this->faker->text(),
            'is_deleted' => 0,
            'is_cancelled' => 0,
            'is_partially_refunded' => 0,
            'is_refunded' => 0,
            'amount' => 20.00,
            'amount_refunded' => 0,
            'event_id' => function () {
                return \App\Models\Event::factory()->create()->id;
            },
            'payment_gateway_id' => 1,
            'is_payment_received' => false,
            'taxamt' => 0,
        ];
    }
}
