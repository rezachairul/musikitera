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
        Schema::create('manage_c_t_a_s', function (Blueprint $table) {
            $table->id();
            $table->string('foto_pendaftar')->nullable(); // path foto pendaftar
            $table->string('nama_lengkap');
            $table->string('nim')->unique();
            $table->year('angkatan'); // tahun masuk
            $table->string('program_studi');
            $table->text('alamat_asli');
            $table->text('alamat_domisili')->nullable();
            $table->string('nomor_telepon');
            $table->string('instagram')->nullable();
            $table->text('alasan_gabung');
            $table->string('minat'); // alat musik / vokal / soundman / lainnya
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_c_t_a_s');
    }
};
