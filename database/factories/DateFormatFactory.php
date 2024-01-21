<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DateFormatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'format' => 'Y-m-d',
            'picker_format' => 'Y-m-d',
            'label' => 'utc date',
        ];
    }
}
