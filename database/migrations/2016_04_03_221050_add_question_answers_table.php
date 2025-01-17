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
        Schema::create('question_answers', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('attendee_id')->unsigned()->index();

            $table->integer('event_id')->unsigned()->index();
            $table->integer('question_id')->unsigned()->index();
            $table->integer('account_id')->unsigned()->index();
            $table->text('answer_text');
            $table->nullableTimestamps();

            $table->foreign('question_id')->references('id')->on('questions');

            $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->foreign('attendee_id')->references('id')->on('attendees')->onDelete('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::drop('question_answers');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
