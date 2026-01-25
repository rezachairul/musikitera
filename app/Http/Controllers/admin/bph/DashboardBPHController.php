<?php

namespace App\Http\Controllers\admin\bph;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\bph\manajemen_anggota\ManageBadanPengurus;
use App\Models\admin\bph\manajemen_anggota\ManageKabinet;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Illuminate\Http\Request;

class DashboardBPHController extends Controller
{
    public function index()
    {
        $title = 'Badan Pengurus';

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

        // ================= MITRA =================
        $totalMitras = ManageMitra::count();

        return view('admin.bph.dashboard.index', compact(
            'title', 'totalMitras', 'totalAnggota', 'anggotaAktif', 'anggotaLulus', 'anggotaDO', 'anggotaExit',
            'totalPengurus', 'pengurusAktif', 'pengurusDemisioner',
            'totalKabinet', 'kabinetAktif'
            ));
    }
}
