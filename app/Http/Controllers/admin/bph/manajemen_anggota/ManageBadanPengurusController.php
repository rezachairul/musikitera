<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use App\Models\admin\bph\manajemen_anggota\ManageBadanPengurus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageBadanPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Badan Pengurus";

        return view('admin.bph.manajemen_anggota.badan_pengurus.index', compact( 'title'));
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
    public function show(ManageBadanPengurus $manageBadanPengurus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageBadanPengurus $manageBadanPengurus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageBadanPengurus $manageBadanPengurus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageBadanPengurus $manageBadanPengurus)
    {
        //
    }
}
