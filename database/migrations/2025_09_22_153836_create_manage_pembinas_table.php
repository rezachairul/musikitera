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
        Schema::create('manage_pembinas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nip_nidn')->unique();
            $table->string('jabatan');
            $table->date('awal_periode')->nullable();
            $table->date('akhir_periode')->nullable();
            $table->string('program_studi')->nullable();
            $table->string('kontak')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_pembinas');
    }
};
