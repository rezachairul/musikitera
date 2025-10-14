<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageCTA extends Model
{
    /** @use HasFactory<\Database\Factories\ManageCTAFactory> */
    use HasFactory;

    protected $table = 'manage_c_t_a_s';

    protected $fillable = [
        'foto_pendaftar',
        'nama_lengkap',
        'nim',
        'angkatan',
        'program_studi',
        'alamat_asli',
        'alamat_domisili',
        'nomor_telepon',
        'instagram',
        'alasan_gabung',
        'minat',
    ];

    public function link()
    {
        return $this->belongsTo(Link::class, 'link_id');
    }

}
