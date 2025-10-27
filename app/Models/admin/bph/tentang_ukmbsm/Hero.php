<?php

namespace App\Models\admin\bph\tentang_ukmbsm;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    /** @use HasFactory<\Database\Factories\HeroFactory> */
    use HasFactory;

    protected $table = 'heroes';
    protected $fillable = [
        'image',
        'quote_1',
        'quote_2',
    ];
}
