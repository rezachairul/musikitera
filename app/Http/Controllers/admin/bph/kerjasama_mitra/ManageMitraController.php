<?php

namespace App\Http\Controllers\admin\bph\kerjasama_mitra;

use App\Http\Controllers\Controller;
use App\Models\admin\bph\ManageMitra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;

class ManageMitraController extends Controller
{
    /**
     * Tampilkan semua mitra (internal/eksternal)
     */
    public function index(Request $request)
    {
        $title = 'Mitra';
        $type = $request->query('type'); // optional filter
        
        $query = ManageMitra::query();

        if ($type) {
            $query->where('type', $type); // type = internal / eksternal
        }

        $mitras = $query->latest()->paginate(10);
        $totalMitras = $query->count();

        return view('admin.bph.kerjasama_mitra.mitra.index', compact('title', 'mitras', 'type', 'totalMitras'));
    }

    /**
     * Simpan mitra baru
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:internal,eksternal',
            'sub_type'    => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:255',
            'url'         => 'nullable|url|max:255',
        ]);

        // validasi lanjutan sub_type
        if ($validated['type'] === 'internal') {
            $request->validate([
                'sub_type' => 'required|in:institusi,ormawa_hmps,ormawa_ukm',
            ]);
        } elseif ($validated['type'] === 'eksternal') {
            $request->validate([
                'sub_type' => 'required|in:komunitas,ukmbs',
            ]);
        }

        // simpan logo dengan nama sesuai name
        if ($request->hasFile('logo')) {
            $file      = $request->file('logo');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['name'], '-') . '.' . $ext;

            // simpan ke storage/app/public/mitra
            $path = $file->storeAs('mitra', $fileName, 'public');
            $validated['logo'] = $path;
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
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:internal,eksternal',
            'sub_type'    => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:255',
            'url'         => 'nullable|url|max:255',
        ]);

        // validasi lanjutan sub_type
        if ($validated['type'] === 'internal') {
            $request->validate([
                'sub_type' => 'required|in:institusi,ormawa_hmps,ormawa_ukm',
            ]);
        } elseif ($validated['type'] === 'eksternal') {
            $request->validate([
                'sub_type' => 'required|in:komunitas,ukmbs',
            ]);
        }

        // update logo kalau ada file baru
        if ($request->hasFile('logo')) {
            // hapus logo lama
            if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
                Storage::disk('public')->delete($mitra->logo);
            }

            $file      = $request->file('logo');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['name'], '-') . '.' . $ext;

            $path = $file->storeAs('mitra', $fileName, 'public');
            $validated['logo'] = $path;
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
