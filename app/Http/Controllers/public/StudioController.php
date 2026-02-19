<?php

namespace App\Http\Controllers\Public;

use App\Models\admin\bph\tentang_ukmbsm\ManageStudioMusik;
use App\Models\admin\bph\tentang_ukmbsm\ManageStudioFacilities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudioController extends Controller
{
    public function index()
    {
        $title = 'Music Studio Page';
        $description = 'Explore the state-of-the-art music studio of UKMBSM ITERA, equipped with modern instruments and recording technology. Perfect for budding musicians and producers at Institut Teknologi Sumatera (ITERA) to hone their craft and create amazing music.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        // Ambil data studio (single entry)
        $studio = ManageStudioMusik::first();

        // Ambil fasilitas AKTIF saja & urut
        $facilities = ManageStudioFacilities::where('manage_studio_musik_id', $studio?->id)
            ->where('is_active', 1)
            ->orderBy('urutan')
            ->get();

        return view('public.about.studio', compact('title', 'description', 'keywords', 'author', 'studio', 'facilities'));
    }
}
