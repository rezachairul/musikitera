<?php

namespace App\Models\admin\bph;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    /** @use HasFactory<\Database\Factories\HeroFactory> */
    use HasFactory;

    protected $fillable = [
        'image',
        'quote_1',
        'quote_2',
    ];
}
