<?php

namespace App\Http\Controllers\admin\bph;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardBPHController extends Controller
{
    public function index()
    {
        $title = 'Badan Pengurus';
        return view('admin.bph.dashboard.index', compact('title'));
    }
}
