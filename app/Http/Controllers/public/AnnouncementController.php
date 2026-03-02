<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\bph\publikasi_informasi\ManagePengumuman;

class AnnouncementController extends Controller
{
    public function index()
    {
        $title = 'Announcement Page';
        $description = 'Stay updated with the latest announcements from UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Find important news, event updates, and notifications that keep you informed about our activities and initiatives.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        $announcements = ManagePengumuman::where('status', 'publish')->orderByDesc('created_at')->get();
        $perPage = 3;
        $currentPage = request('page', 1);
        $latest = $announcements->first();
        if (is_array($latest)) {
            $latest = (object) $latest;
        }

        $others = $announcements->slice(1);
        $totalPages = ceil($others->count() / $perPage);
        $paginatedOthers = $others->slice(($currentPage - 1) * $perPage, $perPage);

        $limit = 3;
        $start = max(1, $currentPage - floor($limit / 2));
        $end = min($totalPages, $start + $limit - 1);

        // Geser start jika end sudah mentok di total halaman
        if ($end - $start + 1 < $limit) {
            $start = max(1, $end - $limit + 1);
        }
        
        return view('public.announcement.index', compact('title', 'description', 'keywords', 'author', 'announcements', 'latest', 'others', 'paginatedOthers', 'totalPages', 'currentPage', 'start', 'end'));
    }

    public function pengumuman($id)
    {
        $title = 'Detail Announcement Page';
        $description = 'Get detailed information on the latest announcements from UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Stay informed about important news, event updates, and notifications that highlight our activities and initiatives.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        $announcement = ManagePengumuman::where('status', 'publish')
            ->findOrFail($id);

        $others = ManagePengumuman::where('status', 'publish')
            ->where('id', '!=', $id)
            ->latest()
            ->take(3)
            ->get();
        
        return view('public.announcement.pengumuman', compact('title', 'description', 'keywords', 'author', 'announcement', 'others'));
    }
}
