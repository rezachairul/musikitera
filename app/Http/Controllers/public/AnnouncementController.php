<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        $title = 'Announcement Page';
        $description = 'Stay updated with the latest announcements from UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Find important news, event updates, and notifications that keep you informed about our activities and initiatives.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';
        
        return view('public.announcement.index', compact('title', 'description', 'keywords', 'author'));
    }
    public function pengumuman()
    {
        $title = 'Detail Announcement Page';
        $description = 'Get detailed information on the latest announcements from UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Stay informed about important news, event updates, and notifications that highlight our activities and initiatives.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';
        
        return view('public.announcement.pengumuman', compact('title', 'description', 'keywords', 'author'));
    }
}
