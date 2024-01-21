<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'edited_by_user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
            'order_id' => function () {
                return \App\Models\Order::factory()->create()->id;
            },
            'event_id' => function () {
                return \App\Models\Event::factory()->create()->id;
            },
            'title' => $this->faker->name(),
            'description' => $this->faker->text(),
            'price' => 50.00,
            'max_per_person' => 4,
            'min_per_person' => 1,
            'quantity_available' => 50,
            'quantity_sold' => 0,
            'start_sale_date' => Carbon::now()->format(config('attendize.default_datetime_format')),
            'end_sale_date' => Carbon::now()->addDays(20)->format(config('attendize.default_datetime_format')),
            'sales_volume' => 0,
            'organiser_fees_volume' => 0,
            'is_paused' => 0,
            'public_id' => null,
            'sort_order' => 0,
            'is_hidden' => false,
        ];
    }
}
