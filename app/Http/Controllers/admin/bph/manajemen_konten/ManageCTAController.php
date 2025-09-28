<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Models\admin\bph\ManageCTA;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageCTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Call to Action";

        return view('admin.bph.manajemen_konten.cta.index', compact( 'title'));
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
    public function show(ManageCTA $manageCTA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageCTA $manageCTA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageCTA $manageCTA)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageCTA $manageCTA)
    {
        //
    }
}
