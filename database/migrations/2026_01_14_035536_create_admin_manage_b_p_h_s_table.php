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
        Schema::create('admin_manage_b_p_h_s', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('jenis');
            $table->foreignId('parent_id')->nullable()->constrained('admin_manage_b_p_h_s')->cascadeOnDelete();
            $table->unsignedTinyInteger('level');
            $table->unsignedInteger('urutan')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admin_manage_b_p_h_s');
    }
};
