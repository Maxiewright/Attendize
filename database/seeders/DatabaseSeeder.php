<?php

namespace Database\Seeders;

use Eloquent;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Eloquent::unguard();

        $this->call([
            CountriesSeeder::class,
            CurrencySeeder::class,
            OrderStatusSeeder::class,
            PaymentGatewaySeeder::class,
            QuestionTypesSeeder::class,
            TicketStatusSeeder::class,
            TimezoneSeeder::class,
        ]);
    }
}
