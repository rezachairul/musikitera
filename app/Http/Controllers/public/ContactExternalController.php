<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactExternalController extends Controller
{
    public function index()
    {
        $title = 'Contact External Page';
        $description = 'Get in touch with the external partners of UKMBSM ITERA, the vibrant music community at Institut Teknologi Sumatera (ITERA). Reach out for collaborations, inquiries, and support related to our music events and activities.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';

        return view('public.contact.external', compact('title', 'description', 'keywords', 'author'));
    }
}
