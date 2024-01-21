<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderStatus;

class OrderStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $selection = ['Completed', 'Refunded', 'Partially Refunded', 'Cancelled'];

        return [
            'name' => $this->faker->randomElement($selection),
        ];
    }
}
