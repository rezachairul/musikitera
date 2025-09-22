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
        Schema::create('anggota_aktifs', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nim', 15)->unique();
            $table->year('angkatan'); // angkatan kampus
            $table->string('prodi');
            $table->string('nia')->unique(); // gabungan otomatis
            $table->unsignedInteger('nomor_urut'); 
            $table->string('organisasi')->default('BSM');
            $table->unsignedInteger('angkatan_ukm'); // angka asli (6 → VI)
            $table->boolean('pendiri')->default(false);
            $table->enum('status', ['graduate', 'on_going', 'drop_out', 'exit'])->default('on_going');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anggota_aktifs');
    }
};
