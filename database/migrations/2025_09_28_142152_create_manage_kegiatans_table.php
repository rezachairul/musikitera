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
        Schema::create('manage_kegiatans', function (Blueprint $table) {
            $table->id();
            // Identitas kegiatan
            $table->string('nama_kegiatan');        // Nama kegiatan
            $table->text('deskripsi')->nullable();  // Deskripsi kegiatan
            $table->string('kategori')->nullable(); // Jenis kegiatan

            // Waktu & tempat
            $table->date('tanggal_mulai');              
            $table->date('tanggal_selesai')->nullable(); 
            $table->time('jam_mulai')->nullable();  
            $table->time('jam_selesai')->nullable();
            $table->string('lokasi')->nullable();   

            // Dokumentasi & media
            $table->string('poster')->nullable();    // Path poster

            // Informasi lampiran (detail metadata)
            $table->string('lampiran_path')->nullable();      // Path file di storage
            $table->string('lampiran_original')->nullable();  // Nama asli file
            $table->string('lampiran_type')->nullable();      // Ekstensi file (pdf, docx, jpg)
            $table->bigInteger('lampiran_size')->nullable();  // Ukuran dalam byte

            // Status
            $table->enum('status', ['draft', 'published', 'done'])->default('draft');
            $table->boolean('is_highlight')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_kegiatans');
    }
};
