<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->title(),
            'quantity' => 5,
            'unit_price' => 20.00,
            'unit_booking_fee' => 2.00,
            'order_id' => function () {
                return \App\Models\Order::factory()->create()->id;
            },
        ];
    }
}
