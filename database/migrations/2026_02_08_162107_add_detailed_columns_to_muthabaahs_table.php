<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('muthabaahs', function (Blueprint $table) {
            // Qobliyah details
            $table->boolean('q_shubuh')->default(false);
            $table->boolean('q_zuhur')->default(false);
            $table->boolean('q_ashar')->default(false);
            $table->boolean('q_maghrib')->default(false);
            $table->boolean('q_isya')->default(false);
            
            // Ba'adiyah details
            $table->boolean('b_zuhur')->default(false);
            $table->boolean('b_maghrib')->default(false);
            $table->boolean('b_isya')->default(false);
            
            // Measurements
            $table->integer('dhuha_rakaat')->default(0);
            $table->integer('tahajud_rakaat')->default(0);
            $table->integer('murojaah_halaman')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('muthabaahs', function (Blueprint $table) {
            $table->dropColumn([
                'q_shubuh', 'q_zuhur', 'q_ashar', 'q_maghrib', 'q_isya',
                'b_zuhur', 'b_maghrib', 'b_isya',
                'dhuha_rakaat', 'tahajud_rakaat', 'murojaah_halaman'
            ]);
        });
    }
};
