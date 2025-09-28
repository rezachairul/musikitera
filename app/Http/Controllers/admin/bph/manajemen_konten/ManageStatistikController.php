<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Models\admin\bph\manajemen_konten\ManageStatistik;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageStatistikController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Statisrik";

        return view('admin.bph.manajemen_konten.statistik.index', compact( 'title'));
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
    public function show(ManageStatistik $manageStatistik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageStatistik $manageStatistik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageStatistik $manageStatistik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageStatistik $manageStatistik)
    {
        //
    }
}
