<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\bph\manajemen_konten\ManageTestimoni;

class ManageAlumni extends Model
{
    use HasFactory;

    protected $table = 'manage_alumnis';

    protected $fillable = [
        'anggota_id',
        'tahun_lulus',
        'url',
        'pekerjaan',
        'quote',
        'foto',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(AnggotaAktif::class, 'anggota_id');
    }

    public function testimoni(): HasMany
    {
        return $this->hasMany(ManageTestimoni::class, 'anggota_id', 'anggota_id');
    }
}
