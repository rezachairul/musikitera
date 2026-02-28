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
        Schema::create('manage_sejarahs', function (Blueprint $table) {
            $table->id();
            $table->string('nama_ukm');
            $table->string('logo')->nullable();
            $table->text('deskripsi');
            $table->year('tahun_mulai');
            $table->year('tahun_akhir')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_sejarahs');
    }
};
