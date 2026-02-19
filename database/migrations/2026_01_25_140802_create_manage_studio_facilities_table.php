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
        Schema::create('manage_studio_facilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('manage_studio_musik_id')->constrained()->cascadeOnDelete();

            $table->string('nama');
            $table->text('deskripsi')->nullable();
            $table->string('image')->nullable();
            $table->integer('urutan')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_studio_facilities');
    }
};
