<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\tentang_ukmbsm\ManageVisi;
use App\Models\admin\bph\tentang_ukmbsm\ManageMisi;
use Illuminate\Support\Facades\DB;

class ManageVisiMisiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Visi & Misi";

        $visis = ManageVisi::with('misis')->get();

        return view('admin.bph.tentang_ukmbsm.visi_misi.index', compact( 'title', 'visis'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'visi'   => 'required|string',
            'misi'   => 'required|array|min:1',
            'misi.*' => 'required|string'
        ]);

        DB::transaction(function () use ($request) {

            $visi = ManageVisi::create([
                'visi' => $request->visi,
            ]);

            foreach ($request->misi as $item) {
                ManageMisi::create([
                    'manage_visi_id' => $visi->id,
                    'misi' => $item
                ]);
            }

        });

        return redirect()->back()->with('success', 'Visi & Misi berhasil disimpan');
    }

    /**
     * Update the specified resource in storage.
     */
     public function update(Request $request, $id)
    {
        $request->validate([
            'visi'   => 'required|string',
            'misi'   => 'required|array|min:1',
            'misi.*' => 'required|string'
        ]);

        DB::transaction(function () use ($request, $id) {

            $visi = ManageVisi::findOrFail($id);

            $visi->update([
                'visi' => $request->visi
            ]);

            // hapus semua misi lama
            $visi->misis()->delete();

            // simpan ulang misi
            foreach ($request->misi as $item) {
                ManageMisi::create([
                    'manage_visi_id' => $visi->id,
                    'misi' => $item
                ]);
            }

        });

        return redirect()->back()->with('success', 'Visi & Misi berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $visi = ManageVisi::findOrFail($id);
        $visi->delete(); // misi otomatis kehapus (cascade)

        return redirect()->back()->with('success', 'Visi & Misi berhasil dihapus');
    }
}
