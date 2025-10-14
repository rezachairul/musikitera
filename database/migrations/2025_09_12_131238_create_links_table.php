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
        Schema::create('links', function (Blueprint $table) {
            $table->id();
            $table->string('nama_link'); // Nama link, contoh: Grup WA Oprec 2025
            $table->text('url'); // Alamat link penuh
            $table->enum('kategori', [
                // Website
                'website',

                // Google
                'google_form',
                'google_docs',
                'google_sheets',
                'google_slides',
                'google_drive',
                'google_calendar',
                'google_meet',
                'google_classroom',
                'google_sites',
                'google_jamboard',
                'google_maps',
                'google_photos',
                'google_keep',
                'google_chat',
                'google_other',

                // Media Sosial
                'instagram',
                'tiktok',
                'youtube',
                'whatsapp',
                'x_twitter',
                'facebook',
                'linkedin',
                'telegram',
                'discord',
                'threads',
                'line',
                'spotify',
                'soundcloud',
            ]);
            $table->text('deskripsi')->nullable(); // Keterangan tambahan
            $table->boolean('status')->default(true); // true = aktif, false = nonaktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('links');
    }
};
