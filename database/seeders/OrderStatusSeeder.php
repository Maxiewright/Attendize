<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $order_statuses = [
            [
                'id' => 1,
                'name' => 'Completed',
            ],
            [
                'id' => 2,
                'name' => 'Refunded',
            ],
            [
                'id' => 3,
                'name' => 'Partially Refunded',
            ],
            [
                'id' => 4,
                'name' => 'Cancelled',
            ],
        ];

        DB::table('order_statuses')->insert($order_statuses);
    }
}
