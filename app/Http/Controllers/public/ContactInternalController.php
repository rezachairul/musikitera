<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactInternalController extends Controller
{
    public function index()
    {
        $title = 'Contact Internal Page';
        $description = 'Get in touch with the internal team of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Reach out for collaborations, inquiries, and support related to our music events and activities.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.contact.internal', compact('title', 'description', 'keywords', 'author'));
    }
}
