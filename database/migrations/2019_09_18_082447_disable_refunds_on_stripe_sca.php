<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::table('payment_gateways')
            ->where('name', 'Stripe\PaymentIntents')
            ->update(['can_refund' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
