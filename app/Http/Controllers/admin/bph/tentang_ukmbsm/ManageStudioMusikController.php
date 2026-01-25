<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;
use App\Models\admin\bph\tentang_ukmbsm\ManageStudioMusik;
use App\Http\Controllers\Controller;

class ManageStudioMusikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Studio Musik";

        return view('admin.bph.tentang_ukmbsm.studio_musik.index', compact( 'title'));
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
    public function show(ManageStudioMusik $manageStudioMusik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageStudioMusik $manageStudioMusik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageStudioMusik $manageStudioMusik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageStudioMusik $manageStudioMusik)
    {
        //
    }
}
