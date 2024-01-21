<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TicketStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        $selection = ['Sold Out', 'Sales Have Ended', 'Not On Sale Yet', 'On Sale'];

        return [
            'name' => $this->faker->randomElement($selection),
        ];
    }
}
