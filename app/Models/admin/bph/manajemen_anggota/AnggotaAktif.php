<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\manajemen_konten\ManageTestimoni;
use App\Models\admin\bph\manajemen_anggota\ManageAlumni;

class AnggotaAktif extends Model
{
    use HasFactory;

    protected $table = 'anggota_aktifs';

    protected $fillable = [
        'nama',
        'nim',
        'angkatan',
        'prodi',
        'nomor_urut',
        'organisasi',
        'angkatan_ukm',
        'pendiri',
        'status',
        'nia',
    ];
    
    protected $attributes = [
        'organisasi' => 'BSM',
    ];

    /* -----------------------------
     * Utility NIA & nomor urut
     * ----------------------------- */

    private function toRoman($number)
    {
        $map = [
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1,
        ];

        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }

    public function getNomorUrutFormattedAttribute()
    {
        return str_pad($this->nomor_urut, 3, '0', STR_PAD_LEFT);
    }

    public function getNiaAttribute()
    {
        $nomorUrut = $this->nomor_urut_formatted;

        if ($this->pendiri) {
            return "{$nomorUrut}/{$this->organisasi}/P";
        }

        $angkatanRomawi = $this->toRoman($this->angkatan_ukm);
        return "{$nomorUrut}/{$this->organisasi}/{$angkatanRomawi}";
    }

    /* -----------------------------
     * Relasi
     * ----------------------------- */

    // 1 anggota = 1 alumni (karena anggota_id di manage_alumnis itu unique)
    public function alumni()
    {
        return $this->hasOne(ManageAlumni::class, 'anggota_id');
    }

    // ALIAS buat kompatibel dengan kode lama (supaya whereDoesntHave('alumnis') tetap jalan)
    public function alumnis()
    {
        return $this->hasOne(ManageAlumni::class, 'anggota_id');
    }

    public function testimonis()
    {
        return $this->hasMany(ManageTestimoni::class, 'anggota_id');
    }

    /* -----------------------------
     * Scope helper
     * ----------------------------- */

    public function scopeGraduate($query)
    {
        return $query->where('status', 'graduate');
    }
}
