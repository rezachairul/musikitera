<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\manajemen_konten\ManageTestimoni;

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
        'organisasi',     // misalnya BSM
        'angkatan_ukm',   // integer, nanti diubah ke romawi
        'pendiri',        // boolean (1 = pendiri, 0 = bukan)
        'status',
        'nia',
    ];
    
    protected $attributes = [
        'organisasi' => 'BSM',
    ];

    /**
     * Konversi angka ke romawi
     */
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

    /**
     * Accessor: format nomor urut dengan leading zero
     * contoh: 1 -> 001, 12 -> 012, 123 -> 123
     */
    public function getNomorUrutFormattedAttribute()
    {
        return str_pad($this->nomor_urut, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Accessor: hasilkan NIA gabungan
     */
    public function getNiaAttribute()
    {
        $nomorUrut = $this->nomor_urut_formatted;

        if ($this->pendiri) {
            // khusus pendiri: tanpa angkatan romawi
            return "{$nomorUrut}/{$this->organisasi}/P";
        }

        // default: pakai angkatan romawi
        $angkatanRomawi = $this->toRoman($this->angkatan_ukm);
        return "{$nomorUrut}/{$this->organisasi}/{$angkatanRomawi}";
    }


    public function testimonis()
    {
        return $this->hasMany(ManageTestimoni::class, 'anggota_id');
    }

    public function alumnis()
    {
        return $this->hasMany(ManageAlumni::class, 'anggota_id');
    }

}