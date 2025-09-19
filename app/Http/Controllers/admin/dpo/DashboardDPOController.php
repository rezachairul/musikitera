<?php

namespace App\Http\Controllers\admin\dpo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDPOController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Dewan Pengawas';
        return view('admin.dpo.dashboard.index', compact('title'));
    }
}
