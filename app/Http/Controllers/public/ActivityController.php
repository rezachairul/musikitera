<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $title = 'Activity Page';
        $description = 'Explore the activities of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Discover our events, workshops, and initiatives that showcase our passion for music and foster a thriving student organization.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.activity.index', compact('title', 'description', 'keywords', 'author'));
    }
}
