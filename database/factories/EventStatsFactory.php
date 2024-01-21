<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventStatsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date' => Carbon::now(),
            'views' => 0,
            'unique_views' => 0,
            'tickets_sold' => 0,
            'sales_volume' => 0,
            'organiser_fees_volume' => 0,
            'event_id' => function () {
                return \App\Models\Event::factory()->create()->id;
            },
        ];
    }
}
