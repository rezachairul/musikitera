<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Http\Request;

use App\Models\admin\bph\publikasi_informasi\ManageDokumen;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;




class ManageDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Dokumen";

        return view('admin.bph.publikasi_informasi.dokumen.index', compact( 'title'));
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
    public function show(ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageDokumen $manageDokumen)
    {
        //
    }
}
