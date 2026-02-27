<?php

namespace App\Http\Controllers\public;

use App\Models\public\Home;
use Carbon\Carbon;

use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\bph\manajemen_anggota\ManageBadanPengurus;
use App\Models\admin\bph\manajemen_anggota\ManageKabinet;

use App\Models\admin\bph\manajemen_konten\ManageGaleri;
use App\Models\admin\bph\manajemen_konten\OprecSetting;

use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home Page';
        $description = 'Welcome to UKMBSM ITERA, the official music community of Institut Teknologi Sumatera (ITERA). Explore our events, activities, and musical journey.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';
        $showHeader = false;

        // ================= ANGGOTA =================
        $totalAnggota = AnggotaAktif::count();
        $anggotaAktif = AnggotaAktif::where('status', 'on_going')->count();
        $anggotaLulus = AnggotaAktif::where('status', 'graduate')->count();
        $anggotaDO    = AnggotaAktif::where('status', 'drop_out')->count();
        $anggotaExit  = AnggotaAktif::where('status', 'exit')->count();

        // ================= BADAN PENGURUS =================
        $totalPengurus      = ManageBadanPengurus::count();
        $pengurusAktif      = ManageBadanPengurus::where('status', 'aktif')->count();
        $pengurusDemisioner = ManageBadanPengurus::where('status', 'demisioner')->count();

        // ================= KABINET =================
        $totalKabinet = ManageKabinet::count();
        $kabinetAktif = ManageKabinet::where('is_active', 1)->first();

        // ================= GALLERY =================
        $galeris = ManageGaleri::whereNotNull('image')
            ->orderByDesc('kegiatan_date')
            ->orderByDesc('created_at')
            ->limit(9)
            ->get();

        // ================= CTA OPREC =================
        $oprec = OprecSetting::first();
        $status = null;

        if ($oprec && (int)$oprec->is_active === 1) {
            $now = now();

            if ($oprec->start_at && $now->lt($oprec->start_at)) {
                $status = 'coming_soon';
            } elseif (
                (!$oprec->start_at || $now->gte($oprec->start_at)) &&
                (!$oprec->end_at || $now->lte($oprec->end_at))
            ) {
                $status = 'open';
            } else {
                $status = 'closed';
            }
        }


        // ================= MITRA =================
        $totalMitras = ManageMitra::count();
        // Ambil mitra internal + logo
        $internalMitras = ManageMitra::where('type', 'internal')
            ->whereNotNull('logo')
            ->where('logo', '!=', '')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('sub_type');

            // Ambil mitra eksternal + logo
        $eksternalMitras = ManageMitra::where('type', 'eksternal')
            ->whereNotNull('logo')
            ->where('logo', '!=', '')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('sub_type');

        return view('public.home.index', compact(
            'title', 'description', 'keywords', 'author', 'showHeader', 
            'internalMitras', 'eksternalMitras', 'totalMitras', 
            'totalAnggota', 'anggotaAktif', 'anggotaLulus', 'anggotaDO', 'anggotaExit',
            'totalPengurus', 'pengurusAktif', 'pengurusDemisioner',
            'galeris',
            'oprec', 'status',
            'totalKabinet', 'kabinetAktif'
            ));
    }

}
