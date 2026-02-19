<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStudioMusik extends Model
{
    /** @use HasFactory<\Database\Factories\ManageStudioMusikFactory> */
    use HasFactory;

    protected $fillable = [
        'nama_studio',
        'deskripsi',
        'weekday_open','weekday_close',
        'weekend_open','weekend_close',
        'ruang','lantai','gedung','lokasi'
    ];

    public function facilities()
    {
        return $this->hasMany(ManageStudioFacilities::class);
    }
}
