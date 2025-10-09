<?php

namespace App\Models\admin\bph\kerjasama_mitra;

use Illuminate\Database\Eloquent\Model;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManageKerjasama extends Model
{
    use HasFactory;

    protected $fillable = [
        'is_from_mitra',
        'mitra_id',
        'nama_organisasi',
        'judul_kerjasama',
        'deskripsi',
        'jenis_kerjasama',
        'tanggal_mulai',
        'tanggal_selesai',
        'status',
        'file_dokumen',
        'file_dokumen_path',
        'file_dokumen_size',
        'file_dokumen_type',
        'poster',
        'poster_size',
        'poster_type',
        'link_dokumentasi',
    ];

    public function mitra()
    {
        return $this->belongsTo(ManageMitra::class, 'mitra_id');
    }
}
