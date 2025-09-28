<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Models\admin\bph\ManageHighlight;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;


class ManageHighlightController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Highlight";

        return view('admin.bph.manajemen_konten.highlight.index', compact( 'title'));
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
    public function show(ManageHighlight $manageHighlight)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageHighlight $manageHighlight)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageHighlight $manageHighlight)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageHighlight $manageHighlight)
    {
        //
    }
}
