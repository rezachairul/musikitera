<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageVisi extends Model
{
    /** @use HasFactory<\Database\Factories\ManageVisiFactory> */
    use HasFactory;
    
    protected $fillable = ['visi'];

    public function misis()
    {
        return $this->hasMany(ManageMisi::class, 'manage_visi_id');
    }
}
