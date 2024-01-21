<?php

use App\Models\PaymentGateway;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        PaymentGateway::where('name', 'Coinbase')->delete();
        PaymentGateway::where('name', 'Migs_ThreeParty')->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
