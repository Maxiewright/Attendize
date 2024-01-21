<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AttendeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'order_id' => function () {
                return \App\Models\Order::factory()->create()->id;
            },
            'event_id' => function () {
                return \App\Models\Event::factory()->create()->id;
            },
            'ticket_id' => function () {
                return \App\Models\Ticket::factory()->create()->id;
            },
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'reference_index' => $this->faker->numberBetween(),
            'private_reference_number' => 1,
            'is_cancelled' => false,
            'is_refunded' => false,
            'has_arrived' => false,
            'arrival_time' => Carbon::now(),
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
        ];
    }
}
