<?php

namespace App\Models\admin\bph\publikasi_informasi;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ManagePengumuman extends Model
{
    /** @use HasFactory<\Database\Factories\ManagePengumumanFactory> */
    use HasFactory;
    use HasFactory;

    protected $table = 'manage_pengumumans';

    protected $fillable = [
        'judul',
        'isi',
        'sifat',
        'gambar',
        'gambar_path',
        'gambar_size',
        'gambar_type',
        'file_dokumen',
        'file_dokumen_path',
        'file_dokumen_size',
        'file_dokumen_type',
        'tanggal_pengumuman',
        'status',
        'user_id',
    ];

    // Relasi ke User (opsional)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
