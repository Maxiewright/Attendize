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
            /*
             * @see https://github.com/milon/barcode
             */
            $table->string('barcode_type', 20)->default('QRCODE');
            $table->string('ticket_border_color', 20)->default('#000000');
            $table->string('ticket_bg_color', 20)->default('#FFFFFF');
            $table->string('ticket_text_color', 20)->default('#000000');
            $table->string('ticket_sub_text_color', 20)->default('#999999');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn([
                'barcode_type',
                'ticket_border_color',
                'ticket_bg_color',
                'ticket_text_color',
                'ticket_sub_text_color',
            ]);
        });
    }
};
