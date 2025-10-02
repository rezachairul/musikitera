<?php

namespace App\Models\admin\bph\publikasi_informasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageKegiatan extends Model
{
    /** @use HasFactory<\Database\Factories\ManageKegiatanFactory> */
    use HasFactory;

    protected $table = 'manage_kegiatans';

    protected $fillable = [
        'nama_kegiatan',
        'deskripsi',
        'kategori',
        'tanggal_mulai',
        'tanggal_selesai',
        'jam_mulai',
        'jam_selesai',
        'lokasi',
        'poster',
        'lampiran_path',
        'lampiran_original',
        'lampiran_type',
        'lampiran_size',
        'status',
        'is_highlight',
    ];

}
