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
        Schema::create('manage_badan_penguruses', function (Blueprint $table) {
            $table->id();

            // FK
            $table->foreignId('manage_kabinet_id')->constrained('manage_kabinets')->cascadeOnDelete();
            $table->foreignId('anggota_aktif_id')->constrained('anggota_aktifs')->cascadeOnDelete();
            $table->foreignId('jabatan_id')->constrained('admin_manage_b_p_h_s')->cascadeOnDelete();
            $table->string('status')->default('aktif'); // aktif | demisioner
            $table->date('mulai_menjabat')->nullable();
            $table->date('selesai_menjabat')->nullable();
            $table->timestamps();
            // optional: biar tidak dobel persis
            $table->unique([
                'manage_kabinet_id',
                'anggota_aktif_id',
                'jabatan_id'
            ], 'unique_pengurus_per_kabinet');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manage_badan_penguruses');
    }
};
