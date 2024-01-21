<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'title' => 'Dollar',
            'symbol_left' => '$',
            'symbol_right' => '',
            'code' => 'USD',
            'decimal_place' => 2,
            'value' => 100.00,
            'decimal_point' => '.',
            'thousand_point' => ',',
            'status' => 1,
        ];
    }

    public function gBP()
    {
        return $this->state(['title' => 'Pound Sterling', 'symbol_left' => '£', 'symbol_right' => '', 'code' => 'GBP', 'decimal_place' => 2, 'value' => 0.62220001, 'decimal_point' => '.', 'thousand_point' => ',', 'status' => 1]);
    }
}
