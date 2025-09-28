<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use App\Models\admin\bph\manajemen_anggota\ManageAlumni;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Badan Pengurus";

        return view('admin.bph.manajemen_anggota.alumni.index', compact( 'title'));
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
    public function show(ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageAlumni $manageAlumni)
    {
        //
    }
}
