<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\admin\bph\manajemen_anggota\ManageBadanPengurus;

class ManageKabinet extends Model
{
    /** @use HasFactory<\Database\Factories\ManageKabinetFactory> */
    use HasFactory;

    protected $table = 'manage_kabinets';

    protected $fillable = [
        'nama_kabinet',
        'logo',
        'banner',
        'deskripsi',
        'periode_awal',
        'periode_akhir',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'periode_awal' => 'integer',
        'periode_akhir' => 'integer',
    ];

    // Relasi ke model Manage Badan Pengurus
    public function badanPengurus()
    {
        return $this->hasMany(ManageBadanPengurus::class, 'manage_kabinet_id');
    }
}
