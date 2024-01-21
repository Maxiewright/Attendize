<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'location' => $this->faker->text,
            'bg_type' => 'color',
            'bg_color' => config('attendize.event_default_bg_color'),
            'bg_image_path' => $this->faker->imageUrl,
            'description' => $this->faker->text,
            'start_date' => Carbon::now()->format(config('attendize.default_datetime_format')),
            'end_date' => Carbon::now()->addWeek()->format(config('attendize.default_datetime_format')),
            'on_sale_date' => Carbon::now()->subDays(20)->format(config('attendize.default_datetime_format')),
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
            'user_id' => function () {
                return \App\Models\User::factory()->create()->id;
            },
            'currency_id' => function () {
                return \App\Models\Currency::factory()->create()->id;
            },
            'organiser_fee_fixed' => 0.00,
            'organiser_fee_percentage' => 0.00,
            'organiser_id' => function () {
                return \App\Models\Organiser::factory()->create()->id;
            },
            'venue_name' => $this->faker->name,
            'venue_name_full' => $this->faker->name,
            'location_address' => $this->faker->address,
            'location_address_line_1' => $this->faker->streetAddress,
            'location_address_line_2' => $this->faker->secondaryAddress,
            'location_country' => $this->faker->country,
            'location_country_code' => $this->faker->countryCode,
            'location_state' => $this->faker->state,
            'location_post_code' => $this->faker->postcode,
            'location_street_number' => $this->faker->buildingNumber,
            'location_lat' => $this->faker->latitude,
            'location_long' => $this->faker->longitude,
            'location_google_place_id' => $this->faker->randomDigit,
            'pre_order_display_message' => $this->faker->text,
            'post_order_display_message' => $this->faker->text,
            'social_share_text' => 'Check Out [event_title] - [event_url]',
            'social_show_facebook' => true,
            'social_show_linkedin' => true,
            'social_show_twitter' => true,
            'social_show_email' => true,
            'location_is_manual' => 0,
            'is_live' => false,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => null,
        ];
    }
}
