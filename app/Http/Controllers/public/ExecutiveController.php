<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExecutiveController extends Controller
{
    public function index()
    {
        $title = 'Supervisory Board Page';
        $description = 'Explore the vibrant gallery of UKMBSM ITERA, showcasing memorable moments, events, and activities that highlight our journey as a leading music community at Institut Teknologi Sumatera (ITERA).';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.executive.index', compact('title', 'description', 'keywords', 'author'));
    }
    public function kabinet()
    {
        $title = 'Cabinet Page';
        $description = 'Discover the dedicated cabinet members of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Learn about their roles, responsibilities, and contributions to our organization.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.executive.kabinet', compact('title', 'description', 'keywords', 'author'));
    }
}
