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

        // Ambil record pertama (single form). Jika belum ada, $profile = null
        $profile = ManageProfile::first();

        return view('admin.bph.tentang_ukmbsm.profil_organisasi.index', compact( 'title', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'akronim' => 'nullable|string|max:50',
            'jenis_organisasi' => 'nullable|string|max:100',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kontak_internal_nama.*' => 'nullable|string|max:255',
            'kontak_internal_no.*' => 'nullable|string|max:50',
            'kontak_eksternal_nama.*' => 'nullable|string|max:255',
            'kontak_eksternal_no.*' => 'nullable|string|max:50',
        ]);

        // gabungkan nama & no kontak ke array
        $validated['kontak_internal'] = array_map(
            fn($nama, $no) => ['nama' => $nama, 'no' => $no],
            $request->kontak_internal_nama ?? [],
            $request->kontak_internal_no ?? []
        );

        $validated['kontak_eksternal'] = array_map(
            fn($nama, $no) => ['nama' => $nama, 'no' => $no],
            $request->kontak_eksternal_nama ?? [],
            $request->kontak_eksternal_no ?? []
        );

        ManageProfile::create($validated);

        return redirect()->back()->with('success', 'Profile berhasil disimpan!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageProfile $manageProfile)
    {
        // dd(request()->all());
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'akronim' => 'nullable|string|max:50',
            'jenis_organisasi' => 'nullable|string|max:100',
            'tagline' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'alamat' => 'nullable|string',
            'kontak_internal_nama.*' => 'nullable|string|max:255',
            'kontak_internal_no.*' => 'nullable|string|max:50',
            'kontak_eksternal_nama.*' => 'nullable|string|max:255',
            'kontak_eksternal_no.*' => 'nullable|string|max:50',
        ]);

        $validated['kontak_internal'] = array_map(
            fn($nama, $no) => ['nama' => $nama, 'no' => $no],
            $request->kontak_internal_nama ?? [],
            $request->kontak_internal_no ?? []
        );

        $validated['kontak_eksternal'] = array_map(
            fn($nama, $no) => ['nama' => $nama, 'no' => $no],
            $request->kontak_eksternal_nama ?? [],
            $request->kontak_eksternal_no ?? []
        );

        ManageProfile::create($validated);

        return redirect()->back()->with('success', 'Profile berhasil diupdate!');
    }
}
