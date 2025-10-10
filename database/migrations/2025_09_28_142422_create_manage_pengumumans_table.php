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
        Schema::create('manage_pengumumans', function (Blueprint $table) {
            $table->id();

            // Informasi dasar
            $table->string('judul'); // Judul pengumuman
            $table->text('isi')->nullable(); // Isi pengumuman
            $table->string('sifat')->default('umum'); // umum, internal, penting, rahasia, dsb

            // Opsi tambahan (file / gambar)
            $table->string('gambar')->nullable(); // jika pengumuman disertai poster/banner
            $table->string('gambar_path')->nullable();
            $table->bigInteger('gambar_size')->nullable();
            $table->string('gambar_type')->nullable();

            $table->string('file_dokumen')->nullable(); // untuk lampiran PDF/dokumen
            $table->string('file_dokumen_path')->nullable();
            $table->bigInteger('file_dokumen_size')->nullable();
            $table->string('file_dokumen_type')->nullable();

            // Metadata tambahan
            $table->date('tanggal_pengumuman')->nullable(); // tanggal posting
            $table->string('status')->default('draft'); // draft / publish / arsip

            // Relasi opsional: siapa yang membuat pengumuman
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_pengumumans');
    }
};
