<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::create('ticket_event_access_code', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('ticket_id');
            $table->unsignedInteger('event_access_code_id');
            $table->timestamps();

            $table->foreign('ticket_id')->references('id')->on('tickets');
            $table->foreign('event_access_code_id')->references('id')->on('event_access_codes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ticket_event_access_code');
        Schema::enableForeignKeyConstraints();
    }
};
