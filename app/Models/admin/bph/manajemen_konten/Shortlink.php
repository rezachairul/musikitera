<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shortlink extends Model
{
    /** @use HasFactory<\Database\Factories\ShortlinkFactory> */
    use HasFactory;
    
    protected $fillable = [
        'slug',
        'original_url',
        'is_hidden',
        'expired_at',
        'click_count',
    ];

    protected $casts = [
        'is_hidden' => 'boolean',
        'expired_at' => 'datetime',
    ];    

    public function getStatusAttribute()
    {
        if ($this->expired_at && $this->expired_at->isPast()) {
            return 'expired';
        }

        return $this->is_hidden ? 'hidden' : 'active';
    }

    public function getStatusLabelAttribute()
    {
        return match ($this->status) {
            'expired' => 'Expired',
            'hidden' => 'Hidden',
            default => 'Aktif',
        };
    }

    public function getStatusBadgeColorAttribute()
    {
        return match ($this->status) {
            'expired' => 'px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700',
            'hidden'  => 'px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-700',
            default   => 'px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700',
        };
    }
    
}
