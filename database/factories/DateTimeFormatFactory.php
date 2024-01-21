<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DateTimeFormatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'format' => 'Y-m-d H:i:s',
            'picker_format' => 'Y-m-d H:i:s',
            'label' => 'utc',
        ];
    }
}
