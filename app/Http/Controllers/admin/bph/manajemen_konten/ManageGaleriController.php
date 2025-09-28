<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Models\admin\bph\manajemen_konten\ManageGaleri;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Gallery";

        return view('admin.bph.manajemen_konten.galeri.index', compact( 'title'));
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
    public function show(ManageGaleri $manageGaleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageGaleri $manageGaleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageGaleri $manageGaleri)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageGaleri $manageGaleri)
    {
        //
    }
}
