<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\admin\bph\publikasi_informasi\ManageKegiatan;

class ActivityController extends Controller
{
    public function index()
    {
        $title = 'Activity Page';
        $description = 'Explore the activities of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Discover our events, workshops, and initiatives that showcase our passion for music and foster a thriving student organization.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        $activities = ManageKegiatan::whereIn('status', ['published', 'done'])
            ->orderBy('tanggal_mulai', 'desc')
            ->get()
            ->map(function ($act) {
                $now = Carbon::now();
                $start = Carbon::parse($act->tanggal_mulai);
                $end = $act->tanggal_selesai 
                        ? Carbon::parse($act->tanggal_selesai) 
                        : $start;

                if ($now->lt($start)) {
                    $act->time_label = 'Coming Soon';
                } elseif ($now->between($start, $end)) {
                    $act->time_label = 'Now';
                } else {
                    $act->time_label = 'Done';
                }

                return $act;
            });

        return view('public.activity.index', compact('title', 'description', 'keywords', 'author', 'activities'));
    }
}
