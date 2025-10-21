<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\manajemen_anggota\ManageAlumni;

class ManageTestimoni extends Model
{
    /** @use HasFactory<\Database\Factories\ManageTestimoniFactory> */
    use HasFactory;
    protected $table = 'manage_testimonis';

    protected $fillable = [
        'alumni_id',
        'foto',
        'kesan',
        'pesan',
    ];

    /**
     * Relasi ke ManageAlumni
     * Satu testimoni dimiliki oleh satu alumni
     */
    public function alumni()
    {
        return $this->belongsTo(ManageAlumni::class, 'alumni_id');
    }
}
