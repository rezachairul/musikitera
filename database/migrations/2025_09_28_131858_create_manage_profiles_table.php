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
        Schema::create('manage_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('akronim')->nullable();
            $table->string('jenis_organisasi')->nullable();
            $table->string('tagline')->nullable();
            $table->text('deskripsi')->nullable();
            $table->text('alamat')->nullable();
            $table->json('kontak_internal')->nullable(); // Simpan nama & nomor internal
            $table->json('kontak_eksternal')->nullable(); // Simpan nama & nomor eksternal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_profiles');
    }
};
