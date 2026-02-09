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
        Schema::create('muthabaahs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->boolean('sholat_dhuha')->default(false);
            $table->boolean('sholat_qobliyah')->default(false);
            $table->boolean('sholat_tahajud')->default(false);
            $table->boolean('murojaah')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();

            // Ensure one record per user per day
            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('muthabaahs');
    }
};
