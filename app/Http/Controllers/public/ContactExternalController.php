<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ContactExternalController extends Controller
{
    public function index()
    {
        return view('public.contact.external');
    }
}
