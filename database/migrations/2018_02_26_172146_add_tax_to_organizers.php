<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('organisers', function ($table) {
            $table->string('taxname', 15)->default('');
            $table->float('taxvalue')->default(0.00);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('organisers', function ($table) {
            $table->dropColumn('taxname');
            $table->dropColumn('taxvalue');
        });
    }
};
