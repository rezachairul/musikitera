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
        Schema::create('manage_kabinets', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kabinet');
            $table->string('logo')->nullable();
            $table->string('banner')->nullable();
            $table->text('deskripsi')->nullable();
            $table->year('periode_awal');
            $table->year('periode_akhir');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_kabinets');
    }
};
