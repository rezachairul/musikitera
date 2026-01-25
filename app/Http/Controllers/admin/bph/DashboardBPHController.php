<?php

namespace App\Http\Controllers\admin\bph;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Illuminate\Http\Request;

class DashboardBPHController extends Controller
{
    public function index()
    {
        $title = 'Badan Pengurus';

        // Hitung mitra
        $totalMitras     = ManageMitra::count();

        return view('admin.bph.dashboard.index', compact('title', 'totalMitras'));
    }
}
