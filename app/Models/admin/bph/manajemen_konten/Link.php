<?php

namespace App\Models\admin\bph\manajemen_konten;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_link',
        'url',
        'kategori',
        'deskripsi',
        'status',
    ];

    // Label status
    public function getStatusLabelAttribute()
    {
        return $this->status ? 'Aktif' : 'Nonaktif';
    }

    // Warna badge untuk status
    public function getStatusBadgeColorAttribute()
    {
        return $this->status
            ? 'bg-green-50 text-green-700 border border-green-200 rounded-full px-2.5 py-0.5 text-xs font-medium'
            : 'bg-gray-100 text-gray-600 border border-gray-300 rounded-full px-2.5 py-0.5 text-xs font-medium';
    }


    // Label kategori (untuk tampilan)
    public static function getKategoriList()
    {
        return [
            // Website
            'website' => 'Website',

            // Google
            'google_form' => 'Google Form',
            'google_docs' => 'Google Docs',
            'google_sheets' => 'Google Sheets',
            'google_slides' => 'Google Slides',
            'google_drive' => 'Google Drive',
            'google_calendar' => 'Google Calendar',
            'google_meet' => 'Google Meet',
            'google_classroom' => 'Google Classroom',
            'google_sites' => 'Google Sites',
            'google_jamboard' => 'Google Jamboard',
            'google_maps' => 'Google Maps',
            'google_photos' => 'Google Photos',
            'google_keep' => 'Google Keep',
            'google_chat' => 'Google Chat',
            'google_other' => 'Google Other',

            // Media Sosial
            'instagram' => 'Instagram',
            'tiktok' => 'TikTok',
            'youtube' => 'YouTube',
            'whatsapp' => 'WhatsApp',
            'x_twitter' => 'X (Twitter)',
            'facebook' => 'Facebook',
            'linkedin' => 'LinkedIn',
            'telegram' => 'Telegram',
            'discord' => 'Discord',
            'threads' => 'Threads',
            'line' => 'Line',
            'spotify' => 'Spotify',
            'soundcloud' => 'SoundCloud',
        ];
    }

    // Warna kategori (bisa dipakai di index view)
    public function getKategoriBadgeColorAttribute()
    {
        return match ($this->kategori) {
            // Website
            'website' => 'bg-indigo-100 text-indigo-800 border border-indigo-300 rounded-full px-2.5 py-0.5 text-xs font-medium',

            // Google
            'google_form' => 'bg-green-50 text-green-700 border border-green-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_docs' => 'bg-blue-50 text-blue-700 border border-blue-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_sheets' => 'bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_slides' => 'bg-yellow-50 text-yellow-700 border border-yellow-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_drive' => 'bg-gray-50 text-gray-700 border border-gray-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_calendar' => 'bg-red-50 text-red-700 border border-red-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_meet' => 'bg-teal-50 text-teal-700 border border-teal-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_classroom' => 'bg-lime-50 text-lime-700 border border-lime-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_sites' => 'bg-purple-50 text-purple-700 border border-purple-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_jamboard' => 'bg-amber-50 text-amber-700 border border-amber-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_maps' => 'bg-cyan-50 text-cyan-700 border border-cyan-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_photos' => 'bg-pink-50 text-pink-700 border border-pink-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_keep' => 'bg-yellow-50 text-yellow-800 border border-yellow-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_chat' => 'bg-green-50 text-green-800 border border-green-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'google_other' => 'bg-slate-50 text-slate-700 border border-slate-200 rounded-full px-2.5 py-0.5 text-xs font-medium',

            // Media sosial
            'instagram' => 'bg-pink-50 text-pink-700 border border-pink-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'tiktok' => 'bg-gray-50 text-gray-700 border border-gray-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'youtube' => 'bg-red-50 text-red-700 border border-red-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'whatsapp' => 'bg-green-50 text-green-700 border border-green-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'x_twitter' => 'bg-slate-50 text-slate-700 border border-slate-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'facebook' => 'bg-blue-50 text-blue-700 border border-blue-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'linkedin' => 'bg-sky-50 text-sky-700 border border-sky-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'telegram' => 'bg-cyan-50 text-cyan-700 border border-cyan-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'discord' => 'bg-indigo-50 text-indigo-700 border border-indigo-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'threads' => 'bg-neutral-50 text-neutral-700 border border-neutral-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'line' => 'bg-lime-50 text-lime-700 border border-lime-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'spotify' => 'bg-emerald-50 text-emerald-700 border border-emerald-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
            'soundcloud' => 'bg-orange-50 text-orange-700 border border-orange-200 rounded-full px-2.5 py-0.5 text-xs font-medium',

            // Default
            default => 'bg-gray-50 text-gray-700 border border-gray-200 rounded-full px-2.5 py-0.5 text-xs font-medium',
        };
    }

    // Atribut kategori label (bisa dipakai di form create/edit)
    public function getKategoriLabelAttribute()
    {
        return self::getKategoriList()[$this->kategori] ?? ucfirst(str_replace('_', ' ', $this->kategori));
    }

    public function ctaPendaftar()
    {
        return $this->hasMany(ManageCTA::class, 'link_id');
    }

}
