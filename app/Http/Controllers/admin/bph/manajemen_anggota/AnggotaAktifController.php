<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use App\Models\admin\bph\AnggotaAktif;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAnggotaAktifRequest;
use App\Http\Requests\UpdateAnggotaAktifRequest;

class AnggotaAktifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Anggota Aktif';
        return view('admin.bph.manajemen_anggota.anggota_aktif.index', compact('title'));
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
    public function store(StoreAnggotaAktifRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnggotaAktifRequest $request, AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaAktif $anggotaAktif)
    {
        //
    }
}
