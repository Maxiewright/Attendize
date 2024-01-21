<?php

use App\Models\PaymentGateway;
use Illuminate\Database\Migrations\Migration;

class DropCoinbaseAndMigsAsDefaults extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        PaymentGateway::where('name', 'Coinbase')->delete();
        PaymentGateway::where('name', 'Migs_ThreeParty')->delete();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
