<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Http\Request;

use App\Models\admin\bph\ManagePengumuman;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManagePengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Pengumuman";

        return view('admin.bph.publikasi_informasi.pengumuman.index', compact( 'title'));
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
    public function show(ManagePengumuman $managePengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManagePengumuman $managePengumuman)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManagePengumuman $managePengumuman)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManagePengumuman $managePengumuman)
    {
        //
    }
}
