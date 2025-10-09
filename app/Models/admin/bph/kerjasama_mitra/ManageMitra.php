<?php

namespace App\Models\admin\bph\kerjasama_mitra;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\admin\bph\kerjasama_mitra\ManageKerjasama;

class ManageMitra extends Model
{
    use HasFactory;

    protected $table = 'manage_mitras';

    protected $fillable = [
        'name',         // nama mitra
        'type',         // internal / eksternal
        'sub_type',     // institusi, ormawa, komunitas, dll
        'logo',         // file logo/foto
        'description',  // deskripsi tambahan
        'url'           // url
    ];

    public function kerjasamas()
    {
        return $this->hasMany(ManageKerjasama::class, 'mitra_id');
    }
}
