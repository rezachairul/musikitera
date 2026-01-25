<?php

namespace App\Http\Controllers\public;

use App\Models\public\Home;

use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHomeRequest;
use App\Http\Requests\UpdateHomeRequest;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Home Page';
        $description = 'Welcome to UKMBSM ITERA, the official music community of Institut Teknologi Sumatera (ITERA). Explore our events, activities, and musical journey.';
        $keywords = 'UKMBSM, ITERA, music community, student organization, music events, ITERA music club';
        $author = 'UKMBSM ITERA';
        $showHeader = false;

        // Ambil mitra internal + logo
        $internalMitras = ManageMitra::where('type', 'internal')
            ->whereNotNull('logo')
            ->where('logo', '!=', '')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('sub_type');

            // Ambil mitra eksternal + logo
        $eksternalMitras = ManageMitra::where('type', 'eksternal')
            ->whereNotNull('logo')
            ->where('logo', '!=', '')
            ->orderBy('created_at', 'asc')
            ->get()
            ->groupBy('sub_type');

        return view('public.home.index', compact('title', 'description', 'keywords', 'author', 'showHeader', 'internalMitras', 'eksternalMitras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHomeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHomeRequest $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}
