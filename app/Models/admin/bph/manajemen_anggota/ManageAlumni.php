<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageAlumni extends Model
{
    /** @use HasFactory<\Database\Factories\ManageAlumniFactory> */
    use HasFactory;
    protected $table = 'manage_alumnis';
    protected $fillable = [
        'anggota_id',    // relasi ke anggota_aktifs
        'foto',          // path foto alumni
        'pekerjaan',     // opsional
        'quote',         // opsional
    ];

    public function anggota()
    {
        return $this->belongsTo(AnggotaAktif::class, 'anggota_id');
    }
}
