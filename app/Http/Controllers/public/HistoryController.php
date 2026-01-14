<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        $title = 'History Page';
        $description = 'Explore the rich history of UKMBSM ITERA, tracing our journey from inception to becoming a leading music community at Institut Teknologi Sumatera (ITERA). Learn about our milestones, achievements, and the legacy we continue to build.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.about.history', compact('title', 'description', 'keywords', 'author'));
    }
}
