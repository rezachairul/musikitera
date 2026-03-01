<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageStatistik extends Model
{
    /** @use HasFactory<\Database\Factories\ManageStatistikFactory> */
    use HasFactory;
    protected $fillable = [
        'date',
        'total_visit',
    ];
}
