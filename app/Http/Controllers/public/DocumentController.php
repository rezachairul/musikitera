<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function index()
    {
        $title = 'Documents Page';
        $description = 'Explore the documents of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Access important files, guidelines, and resources that support our mission and activities.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.document.index', compact('title', 'description', 'keywords', 'author'));
    }
}
