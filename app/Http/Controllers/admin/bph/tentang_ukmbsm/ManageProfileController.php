<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;


use App\Models\admin\bph\tentang_ukmbsm\ManageProfile;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Profile";

        return view('admin.bph.tentang_ukmbsm.profil_organisasi.index', compact( 'title'));
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
    public function show(ManageProfile $manageProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageProfile $manageProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageProfile $manageProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageProfile $manageProfile)
    {
        //
    }
}
