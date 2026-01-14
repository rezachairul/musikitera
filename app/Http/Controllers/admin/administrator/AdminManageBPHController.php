<?php

namespace App\Http\Controllers\admin\administrator;

use App\Models\admin\administrator\AdminManageBPH;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AdminManageBPHController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage BPH Administrator';
        $description = 'Manage BPH accounts within the UKMBSM ITERA Administrator Panel. Add, edit, and delete BPH accounts to maintain secure access to the music community management system.';
        $author = 'UKMBSM ITERA';

        return view('admin.administrator.manage-bph.index', compact('title', 'description', 'author'));
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
    public function show(AdminManageBPH $adminManageBPH)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AdminManageBPH $adminManageBPH)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AdminManageBPH $adminManageBPH)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AdminManageBPH $adminManageBPH)
    {
        //
    }
}
