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
        Schema::table('events', function (Blueprint $table) {
            $table->string('questions_collection_type', 10)->default('buyer'); // buyer or attendee
            $table->integer('checkout_timeout_after')->default(8); // timeout in mins for checkout
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn(['checkout_timeout_after', 'questions_collection_type']);
        });
    }
};
