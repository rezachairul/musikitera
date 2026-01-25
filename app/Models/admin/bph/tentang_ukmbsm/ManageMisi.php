<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageMisi extends Model
{
    /** @use HasFactory<\Database\Factories\ManageMisiFactory> */
    use HasFactory;

    protected $fillable = ['manage_visi_id', 'misi'];

    public function visi()
    {
        return $this->belongsTo(ManageVisi::class, 'manage_visi_id');
    }
}
