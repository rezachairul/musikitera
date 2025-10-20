<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;

class ManageTestimoni extends Model
{
    /** @use HasFactory<\Database\Factories\ManageTestimoniFactory> */
    use HasFactory;
    protected $table = 'manage_testimonis';

    protected $fillable = [
        'anggota_id',
        'foto',
        'kesan',
        'pesan',
    ];

    /**
     * Relasi ke AnggotaAktif
     * Satu testimoni dimiliki oleh satu alumni
     */
    public function anggota()
    {
        return $this->belongsTo(AnggotaAktif::class, 'anggota_id');
    }
}
