<?php

namespace App\Http\Controllers;

use App\Models\admin\bph\ManageBadanPengurus;
use App\Http\Requests\StoreManageBadanPengurusRequest;
use App\Http\Requests\UpdateManageBadanPengurusRequest;

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
    public function store(StoreManageBadanPengurusRequest $request)
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
    public function update(UpdateManageBadanPengurusRequest $request, ManageBadanPengurus $manageBadanPengurus)
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
