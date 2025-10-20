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
        Schema::create('manage_testimonis', function (Blueprint $table) {
            $table->id();
            // Relasi ke AnggotaAktif
            $table->unsignedBigInteger('anggota_id')->index(); // Foreign Key

            $table->string('foto')->nullable();   // Path gambar/foto opsional
            $table->text('kesan')->nullable();    // Kolom kesan
            $table->text('pesan')->nullable();    // Kolom pesan

            $table->foreign('anggota_id')
                ->references('id')
                ->on('anggota_aktifs')
                ->onDelete('cascade'); // kalau data alumni dihapus, testimoninya ikut hilang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_testimonis');
    }
};
