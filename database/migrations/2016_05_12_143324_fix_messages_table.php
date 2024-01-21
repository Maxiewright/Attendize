<?php

use App\Models\Message;
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
        Schema::table('messages', function ($table) {
            $table->string('recipients')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Message::where('recipients', null)->delete();
        Schema::table('messages', function ($table) {
            $table->string('recipients')->nullable(false)->change();
        });
    }
};
