<?php

namespace App\Models\admin\bph\publikasi_informasi;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageDokumen extends Model
{
    /** @use HasFactory<\Database\Factories\ManageDokumenFactory> */
    use HasFactory;
    protected $table = 'manage_dokumens';

    protected $fillable = [
        'judul',
        'kategori',
        'file_path',
        'deskripsi',
        'original_filename',
        'file_size',
        'file_type',
        'year_published',
        'is_active',
    ];
}
