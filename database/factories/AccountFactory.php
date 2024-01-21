<?php

namespace Database\Factories;

use App\Models\Currency;
use App\Models\DateFormat;
use App\Models\DateTimeFormat;
use App\Models\Timezone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->email(),
            'timezone_id' => function () {
                return Timezone::factory()->create()->id;
            },
            'date_format_id' => function () {
                return DateFormat::factory()->create()->id;
            },
            'datetime_format_id' => function () {
                return DateTimeFormat::factory()->create()->id;
            },
            'currency_id' => function () {
                return Currency::factory()->create()->id;
            },
            'name' => $this->faker->name(),
            'last_ip' => '127.0.0.1',
            'last_login_date' => Carbon::now()->subDays(2),
            'address1' => $this->faker->address(),
            'address2' => '',
            'city' => $this->faker->city(),
            'state' => $this->faker->stateAbbr(),
            'postal_code' => $this->faker->postcode(),
            //        'country_id'             => \App\Models\Country::factory()->create()->id,
            'email_footer' => 'Email footer text',
            'is_active' => false,
            'is_banned' => false,
            'is_beta' => false,
            'stripe_access_token' => Str::random(10),
            'stripe_refresh_token' => Str::random(10),
            'stripe_secret_key' => Str::random(10),
            'stripe_publishable_key' => Str::random(10),
        ];
    }
}
