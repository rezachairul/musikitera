<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageGaleri extends Model
{
    /** @use HasFactory<\Database\Factories\ManageGaleriFactory> */
    use HasFactory;

    protected $table = 'manage_galeris';

    protected $fillable = [
        'title',
        'description',
        'image',
        'kegiatan_date',
    ];
}
