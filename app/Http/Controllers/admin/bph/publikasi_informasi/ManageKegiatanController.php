<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Http\Request;

use App\Models\admin\bph\ManageKegiatan;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kegiatan";

        return view('admin.bph.publikasi_informasi.kegiatan.index', compact( 'title'));
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
    public function show(ManageKegiatan $manageKegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageKegiatan $manageKegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageKegiatan $manageKegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageKegiatan $manageKegiatan)
    {
        //
    }
}
