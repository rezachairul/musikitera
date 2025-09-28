<?php

namespace App\Models\admin\bph\manajemen_anggota;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManagePembina extends Model
{
    /** @use HasFactory<\Database\Factories\ManagePembinaFactory> */
    use HasFactory;

    protected $table = 'manage_pembinas';    
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
