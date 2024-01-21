<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Change Private Reference Number from INT to VARCHAR ColumnType
     * and increases the character count to 15
     */
    public function up(): void
    {
        Schema::table('attendees', function (Blueprint $table) {
            $table->string('private_reference_number', 15)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('attendees', function ($table) {
        //     $table->integer('private_reference_number')->change();
        // });
    }
};
