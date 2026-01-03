<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LegislativeController extends Controller
{
    public function index()
    {
        return view('public.legislative.index');
    }
    public function kabinet()
    {
        return view('public.legislative.show');
    }
}
