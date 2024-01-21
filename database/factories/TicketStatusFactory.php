<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TicketStatus;

class TicketStatusFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $selection = ['Sold Out', 'Sales Have Ended', 'Not On Sale Yet', 'On Sale'];

        return [
            'name' => $this->faker->randomElement($selection),
        ];
    }
}
