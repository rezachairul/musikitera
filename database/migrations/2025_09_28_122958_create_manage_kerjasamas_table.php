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
        Schema::create('manage_kerjasamas', function (Blueprint $table) {
            $table->id();

            // 🔀 Penentuan sumber kerja sama
            $table->boolean('is_from_mitra')->default(false)->comment('true = dari mitra terdaftar, false = bukan mitra');
            $table->foreignId('mitra_id')->nullable()->constrained('manage_mitras')->nullOnDelete();
            $table->string('nama_organisasi')->nullable()->comment('Diisi jika bukan dari mitra');

            // 🧾 Informasi inti kerja sama
            $table->string('judul_kerjasama');
            $table->text('deskripsi')->nullable();
            $table->enum('jenis_kerjasama', ['MoU', 'MoA', 'Event', 'Proyek', 'Sponsorship', 'Lainnya'])->default('Lainnya');

            // 📅 Waktu pelaksanaan
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();

            // 📌 Status kerja sama
            $table->enum('status', ['rencana', 'berjalan', 'selesai'])->default('rencana');

            // 📂 File dan media pendukung
            $table->string('file_dokumen')->nullable()->comment('Name file MoU atau dokumen kerja sama');
            $table->string('file_dokumen_path')->nullable()->comment('Path file MoU atau dokumen kerja sama');
            $table->unsignedBigInteger('file_dokumen_size')->nullable()->comment('Ukuran file dokumen dalam byte');
            $table->string('file_dokumen_type')->nullable()->comment('Tipe MIME file dokumen');

            $table->string('poster')->nullable()->comment('Path file poster atau foto kegiatan');
            $table->unsignedBigInteger('poster_size')->nullable()->comment('Ukuran file poster dalam byte');
            $table->string('poster_type')->nullable()->comment('Tipe MIME file poster');

            $table->string('link_dokumentasi')->nullable()->comment('Link dokumentasi eksternal seperti YouTube atau Google Drive');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_kerjasamas');
    }
};
