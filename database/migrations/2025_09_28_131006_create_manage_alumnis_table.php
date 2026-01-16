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
        Schema::create('manage_alumnis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('anggota_id')->unique();
            $table->year('tahun_lulus')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('url')->nullable();
            $table->text('quote')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('anggota_id')->references('id')->on('anggota_aktifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_alumnis');
    }
};
