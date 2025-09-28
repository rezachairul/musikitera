<?php

namespace App\Http\Controllers\admin\bph\kerjasama_mitra;

use App\Models\admin\bph\kerjasama_mitra\ManageKerjasama;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ManageKerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Kerjasama";

        return view('admin.bph.kerjasama_mitra.kerjasama.index', compact( 'title'));

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
    public function show(ManageKerjasama $manageKerjasama)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageKerjasama $manageKerjasama)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageKerjasama $manageKerjasama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageKerjasama $manageKerjasama)
    {
        //
    }
}
