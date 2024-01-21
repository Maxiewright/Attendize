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
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->bigIncrements('id')->change();
            $table->longText('payload')->nullable()->change();
            $table->longText('exception')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('failed_jobs', function (Blueprint $table) {
            $table->increments('id')->change();
            $table->text('payload')->change();
            $table->dropColumn('exception');
        });
    }
};
