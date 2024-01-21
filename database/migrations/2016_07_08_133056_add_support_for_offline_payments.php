<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_payment_received')->default(0);
        });

        Schema::table('events', function (Blueprint $table) {
            $table->boolean('enable_offline_payments')->default(0);
            $table->text('offline_payment_instructions')->nullable();
        });

        $order_statuses = [
            [
                'id' => 5,
                'name' => 'Awaiting Payment',
            ],
        ];

        DB::table('order_statuses')->insert($order_statuses);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_payment_received');
        });

        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('enable_offline_payments');
            $table->dropColumn('offline_payment_instructions');
        });

        DB::table('order_statuses')->where('name', 'Awaiting Payment')->delete();

    }
};
