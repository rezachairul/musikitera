<?php

namespace App\Models\admin\bph;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePembina extends Model
{
    /** @use HasFactory<\Database\Factories\ManagePembinaFactory> */
    use HasFactory;
    
    protected $fillable = [
        'nama',
        'nip_nidn',
        'jabatan',
        'awal_periode',
        'akhir_periode',
        'program_studi',
        'kontak',
        'foto',
    ];
}
