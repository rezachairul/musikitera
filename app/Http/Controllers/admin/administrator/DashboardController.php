<?php

namespace App\Http\Controllers\admin\administrator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $title = 'Administrator';
        $description = 'Welcome to the Administrator Dashboard of UKMBSM ITERA, the official music community of Institut Teknologi Sumatera (ITERA). Manage events, activities, and member information efficiently.';
        $author = 'UKMBSM ITERA';

        return view('admin.administrator.dashboard.index', compact('title', 'description', 'author'));
    }
}
