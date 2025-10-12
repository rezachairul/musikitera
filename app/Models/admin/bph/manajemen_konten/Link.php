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
            'website' => 'bg-indigo-200 text-indigo-900',

            // Google
            'google_form' => 'bg-green-100 text-green-800',
            'google_docs' => 'bg-blue-100 text-blue-800',
            'google_sheets' => 'bg-emerald-100 text-emerald-800',
            'google_slides' => 'bg-yellow-100 text-yellow-800',
            'google_drive' => 'bg-gray-100 text-gray-800',
            'google_calendar' => 'bg-red-100 text-red-800',
            'google_meet' => 'bg-teal-100 text-teal-800',
            'google_classroom' => 'bg-lime-100 text-lime-800',
            'google_sites' => 'bg-purple-100 text-purple-800',
            'google_jamboard' => 'bg-amber-100 text-amber-800',
            'google_maps' => 'bg-cyan-100 text-cyan-800',
            'google_photos' => 'bg-pink-100 text-pink-800',
            'google_keep' => 'bg-yellow-200 text-yellow-900',
            'google_chat' => 'bg-green-200 text-green-900',
            'google_other' => 'bg-slate-100 text-slate-800',

            // Media sosial
            'instagram' => 'bg-pink-100 text-pink-800',
            'tiktok' => 'bg-gray-200 text-gray-800',
            'youtube' => 'bg-red-100 text-red-800',
            'whatsapp' => 'bg-green-100 text-green-800',
            'x_twitter' => 'bg-slate-200 text-slate-800',
            'facebook' => 'bg-blue-100 text-blue-800',
            'linkedin' => 'bg-sky-100 text-sky-800',
            'telegram' => 'bg-cyan-100 text-cyan-800',
            'discord' => 'bg-indigo-100 text-indigo-800',
            'threads' => 'bg-neutral-100 text-neutral-800',
            'line' => 'bg-lime-100 text-lime-800',
            'spotify' => 'bg-emerald-100 text-emerald-800',
            'soundcloud' => 'bg-orange-100 text-orange-800',

            default => 'bg-gray-100 text-gray-800',
        };
    }

    // Atribut kategori label (bisa dipakai di form create/edit)
    public function getKategoriLabelAttribute()
    {
        return self::getKategoriList()[$this->kategori] ?? ucfirst(str_replace('_', ' ', $this->kategori));
    }


}
