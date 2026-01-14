<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $title = 'Gallery Page';
        $description = 'Explore the vibrant gallery of UKMBSM ITERA, showcasing memorable moments, events, and activities that highlight our journey as a leading music community at Institut Teknologi Sumatera (ITERA).';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.gallery.index', compact('title', 'description', 'keywords', 'author'));
    }
}
