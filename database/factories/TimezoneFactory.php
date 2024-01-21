<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TimezoneFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->timezone(),
            'location' => $this->faker->city(),
        ];
    }

    public function europeLondon()
    {
        return $this->state(['name' => 'Europe/London', 'location' => '(GMT) London']);
    }
}
