<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OprecSetting extends Model
{
    /** @use HasFactory<\Database\Factories\OprecSettingFactory> */
    use HasFactory;

    protected $fillable = [
        'title',
        'is_active',
        'start_at',
        'end_at',
        'wa_group_link',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'start_at' => 'datetime',
        'end_at' => 'datetime',
    ];
}
