<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\manajemen_konten\ManageTestimoni;

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
        'tahun_lulus',   // opsional
    ];

    public function anggota()
    {
        return $this->belongsTo(AnggotaAktif::class, 'anggota_id');
    }

    public function testimoni()
    {
        return $this->hasMany(ManageTestimoni::class, 'anggota_id');
    }
}
