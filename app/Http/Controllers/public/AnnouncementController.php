<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('public.announcement.index');
    }
    public function pengumuman()
    {
        return view('public.announcement.pengumuman');
    }
}
