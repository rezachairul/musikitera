<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageProfile extends Model
{
    /** @use HasFactory<\Database\Factories\ManageProfileFactory> */
    use HasFactory;

    protected $fillable = [
        'nama',
        'akronim',
        'jenis_organisasi',
        'tagline',
        'deskripsi',
        'alamat',
        'kontak_internal',
        'kontak_eksternal',
    ];

    protected $casts = [
        'kontak_internal' => 'array',
        'kontak_eksternal' => 'array',
    ];
}