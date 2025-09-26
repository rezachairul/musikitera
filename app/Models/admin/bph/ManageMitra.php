<?php

namespace App\Models\admin\bph;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMitra extends Model
{
    use HasFactory;

    protected $table = 'manage_mitras';

    protected $fillable = [
        'name',       // nama mitra
        'type',       // internal / eksternal
        'sub_type',   // institusi, ormawa, komunitas, dll
        'logo',       // file logo/foto
        'description' // deskripsi tambahan
    ];
}
