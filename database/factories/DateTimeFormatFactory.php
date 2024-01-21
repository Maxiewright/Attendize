<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DateTimeFormatFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'format' => 'Y-m-d H:i:s',
            'picker_format' => 'Y-m-d H:i:s',
            'label' => 'utc',
        ];
    }
}
