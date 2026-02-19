<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStudioFacilities extends Model
{
    /** @use HasFactory<\Database\Factories\ManageStudioFacilitiesFactory> */
    use HasFactory;

    protected $fillable = [
        'manage_studio_musik_id',
        'nama',
        'deskripsi',
        'image',
        'urutan',
        'is_active'
    ];

    public function studio()
    {
        return $this->belongsTo(ManageStudioMusik::class,'manage_studio_musik_id');
    }
}
