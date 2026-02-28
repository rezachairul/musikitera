<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageSejarah extends Model
{
    /** @use HasFactory<\Database\Factories\ManageSejarahFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_ukm',
        'logo',
        'deskripsi',
        'tahun_mulai',
        'tahun_akhir',
    ];

    protected $casts = [
        'tahun_mulai' => 'integer',
        'tahun_akhir' => 'integer',
    ];
}
