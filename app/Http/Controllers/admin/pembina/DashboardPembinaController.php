<?php

namespace App\Http\Controllers\admin\pembina;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPembinaController extends Controller
{
    public function index()
    {
        $title = 'Dashboard Pembina';
        return view('admin.pembina.dashboard.index', compact('title'));
    }
}
