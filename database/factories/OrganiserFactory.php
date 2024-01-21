<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrganiserFactory extends Factory
{
    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'account_id' => function () {
                return \App\Models\Account::factory()->create()->id;
            },
            'name' => $this->faker->name(),
            'about' => $this->faker->text(),
            'email' => $this->faker->email(),
            'phone' => $this->faker->phoneNumber(),
            'facebook' => 'https://facebook.com/organizer-profile',
            'twitter' => 'https://twitter.com/organizer-profile',
            'logo_path' => 'path/to/logo',
            'is_email_confirmed' => 0,
            'confirmation_key' => Str::Random(15),
            'show_twitter_widget' => $this->faker->boolean(),
            'show_facebook_widget' => $this->faker->boolean(),
            'page_header_bg_color' => $this->faker->hexColor(),
            'page_bg_color' => '#ffffff',
            'page_text_color' => '#000000',
            'enable_organiser_page' => $this->faker->boolean(),
            'google_analytics_code' => null,
            'tax_name' => $this->faker->text(11).' tax',
            'tax_value' => $this->faker->randomFloat(2, 0, 30),
            'tax_id' => '',
            'charge_tax' => $this->faker->boolean(),
        ];
    }
}
