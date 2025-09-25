<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use App\Models\admin\bph\Hero;

use Illuminate\Http\Request;
use App\Exports\AnggotaExport;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title  = 'Hero';

        // Redirect ke halaman Hero
        return view('admin.bph.manajemen_konten.hero.index', compact('title'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        //
    }
}
