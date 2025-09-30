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
        Schema::create('manage_dokumens', function (Blueprint $table) {
            $table->id();
            $table->string('judul'); // Nama dokumen (contoh: "Format Surat Penyewaan Studio Musik")
            $table->string('kategori')->nullable(); // kategori dokumen (contoh: "Surat", "SOP", "Perjanjian")
            $table->string('file_path'); // lokasi file dokumen (pdf, docx, dll)
            $table->text('deskripsi')->nullable(); // penjelasan singkat tentang isi dokumen
            $table->string('original_filename')->nullable(); // Nama file asli
            $table->bigInteger('file_size')->nullable(); // Ukuran file dalam bytes
            $table->string('file_type')->nullable(); // Tipe file (pdf, doc, etc)
            $table->year('year_published')->nullable(); // Tahun terbit
            $table->boolean('is_active')->default(true); // status aktif / nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_dokumens');
    }
};
