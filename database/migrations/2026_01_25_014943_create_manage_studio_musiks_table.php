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
        Schema::create('manage_studio_musiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_studio');
            $table->text('deskripsi');

            // jam buka
            $table->time('weekday_open');
            $table->time('weekday_close');
            $table->time('weekend_open');
            $table->time('weekend_close');

            // lokasi
            $table->string('ruang');
            $table->string('lantai');
            $table->string('gedung');
            $table->string('lokasi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_studio_musiks');
    }
};
