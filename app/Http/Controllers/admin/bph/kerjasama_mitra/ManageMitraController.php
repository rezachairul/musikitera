<?php

namespace App\Http\Controllers\admin\bph\kerjasama_mitra;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\ManageMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ManageMitraController extends Controller
{
    /**
     * Tampilkan semua mitra (internal/eksternal)
     */
    public function index(Request $request)
    {
        $type = $request->query('type'); // optional filter
        
        $query = ManageMitra::query();

        if ($type) {
            $query->where('type', $type); // type = internal / eksternal
        }

        $mitras = $query->latest()->paginate(10);

        return view('admin.bph.kerjasama_mitra.index', compact('mitras', 'type'));
    }

    /**
     * Simpan mitra baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => 'required|string|max:255',
            'type'          => 'required|in:internal,eksternal',
            'sub_type'      => 'nullable|in:institusi,ormawa_hmps,ormawa_ukm,komunitas,ukmbs',
            'logo'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'   => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            $validated['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        ManageMitra::create($validated);

        return redirect()->back()->with('success', 'Mitra berhasil ditambahkan.');
    }

    /**
     * Update mitra
     */
    public function update(Request $request, $id)
    {
        $mitra = ManageMitra::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'type'           => 'required|in:internal,eksternal',
            'sub_type'       => 'nullable|in:institusi,ormawa_hmps,ormawa_ukm,komunitas,ukmbs',
            'logo'           => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description'    => 'required|string|max:255',
        ]);

        if ($request->hasFile('logo')) {
            // hapus logo lama
            if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
                Storage::disk('public')->delete($mitra->logo);
            }

            $validated['logo'] = $request->file('logo')->store('mitra', 'public');
        }

        $mitra->update($validated);

        return redirect()->back()->with('success', 'Mitra berhasil diperbarui.');
    }

    /**
     * Hapus mitra
     */
    public function destroy($id)
    {
        $mitra = ManageMitra::findOrFail($id);

        if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
            Storage::disk('public')->delete($mitra->logo);
        }

        $mitra->delete();

        return redirect()->back()->with('success', 'Mitra berhasil dihapus.');
    }

    /**
     * Export mitra (contoh: CSV/Excel/PDF)
     */
    public function export()
    {
        $mitras = ManageMitra::all();

        // sementara dump json dulu
        return response()->json($mitras);

        // nanti bisa diubah pakai Excel::download / dompdf
    }
}
