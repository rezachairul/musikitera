<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;

use App\Models\admin\bph\tentang_ukmbsm\ManageVisiMisi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageVisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Visi & Misi";

        return view('admin.bph.tentang_ukmbsm.visi_misi.index', compact( 'title'));
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
    public function show(ManageVisiMisi $manageVisiMisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageVisiMisi $manageVisiMisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageVisiMisi $manageVisiMisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageVisiMisi $manageVisiMisi)
    {
        //
    }
}
