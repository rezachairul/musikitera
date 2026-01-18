<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\bph\manajemen_anggota\ManageKabinet;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\administrator\AdminManageBPH;

class ManageBadanPengurus extends Model
{
    /** @use HasFactory<\Database\Factories\ManageBadanPengurusFactory> */
    use HasFactory;

     protected $table = 'manage_badan_penguruses';

    protected $fillable = [
        'manage_kabinet_id',
        'anggota_aktif_id',
        'jabatan_id',
        'status',
        'mulai_menjabat',
        'selesai_menjabat'
    ];

    // Relasi ke tiap model &dB terkait

    public function kabinet()
    {
        return $this->belongsTo(ManageKabinet::class, 'manage_kabinet_id');
    }

    public function anggota()
    {
        return $this->belongsTo(AnggotaAktif::class, 'anggota_aktif_id');
    }

    public function jabatan()
    {
        return $this->belongsTo(AdminManageBPH::class, 'jabatan_id');
    }
}
