<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('orders', function ($table) {
            $table->float('taxamt')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('orders', function ($table) {
            $table->dropColumn('taxamt');
        });
    }
};
