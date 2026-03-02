<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ManagePengumumanExport;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\bph\publikasi_informasi\ManagePengumuman;
use Illuminate\Support\Facades\Auth;

class ManagePengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = "Pengumuman";
        $search = $request->input('search', '');
        $filterSifat = $request->query('filterSifat', 'all');
        $filterStatus = $request->query('filterStatus', 'all');
        $perPage = $request->query('perPage', 10);

        // 🔍 Pencarian
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];
        $query = ManagePengumuman::with('user');

        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('judul', 'like', "%{$word}%")
                        ->orWhere('isi', 'like', "%{$word}%")
                        ->orWhere('sifat', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        // 🧩 Filter Sifat
        if ($filterSifat !== 'all') {
            $query->where('sifat', $filterSifat);
        }

        // 🧩 Filter Status
        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        // 🔢 Urutan & Pagination
        $query->orderByDesc('created_at');
        $pengumumans = $query->paginate($perPage === 'all' ? $query->count() : (int) $perPage);
        $totalPengumuman = $query->count();

        // 🏷️ Label Status
        $statusLabels = [
            'draft' => 'Draft',
            'publish' => 'Dipublikasikan',
            'arsip' => 'Arsip',
        ];

        // 🔁 AJAX Partial View
        if ($request->AJAX()) {
            return view('admin.bph.publikasi_informasi.pengumuman.partials.table_body', compact(
                'title',
                'pengumumans',
                'statusLabels',
                'totalPengumuman',
                'filterSifat',
                'filterStatus',
                'perPage',
                'search'
            ))->render();
        }

        // 📄 Full Page View
        return view('admin.bph.publikasi_informasi.pengumuman.index', compact(
            'title',
            'pengumumans',
            'statusLabels',
            'totalPengumuman',
            'filterSifat',
            'filterStatus',
            'perPage',
            'search'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'sifat' => 'required|string|max:100',
            'tanggal_pengumuman' => 'nullable|date',
            'status' => 'required|in:draft,publish,arsip',

            // File opsional
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_dokumen' => 'nullable|file|max:4096',
        ]);

        // === Upload Gambar (Poster / Banner) ===
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'poster_' . Str::slug($validated['judul']) . '_' . time() . '.' . $ext;
            $path = $file->storeAs('pengumuman/gambar', $fileName, 'public');

            $validated['gambar'] = $fileName;
            $validated['gambar_path'] = $path;
            $validated['gambar_size'] = $file->getSize();
            $validated['gambar_type'] = $ext;
        }

        // === Upload File Dokumen (Lampiran) ===
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'lampiran_' . Str::slug($validated['judul']) . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('pengumuman/dokumen', $fileName, 'public');

            $validated['file_dokumen'] = $fileName;
            $validated['file_dokumen_path'] = $filePath;
            $validated['file_dokumen_size'] = $file->getSize();
            $validated['file_dokumen_type'] = $ext;
        }

        // === Simpan user yang sedang login ===
        $validated['user_id'] = Auth::id();

        // === Simpan ke database ===
        ManagePengumuman::create($validated);

        return redirect()->route('manage-pengumuman.index')
            ->with('success', 'Pengumuman berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $managePengumuman = ManagePengumuman::findOrFail($id);

        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'isi' => 'nullable|string',
            'sifat' => 'required|string|max:100',
            'tanggal_pengumuman' => 'nullable|date',
            'status' => 'required|in:draft,publish,arsip',

            // File opsional
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'file_dokumen' => 'nullable|file|max:4096',
        ]);

        // === Gambar Update ===
        if ($request->hasFile('gambar')) {
            if ($managePengumuman->gambar_path && Storage::disk('public')->exists($managePengumuman->gambar_path)) {
                Storage::disk('public')->delete($managePengumuman->gambar_path);
            }

            $file = $request->file('gambar');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'poster_' . Str::slug($validated['judul']) . '_' . time() . '.' . $ext;
            $path = $file->storeAs('pengumuman/gambar', $fileName, 'public');

            $validated['gambar'] = $fileName;
            $validated['gambar_path'] = $path;
            $validated['gambar_size'] = $file->getSize();
            $validated['gambar_type'] = $ext;
        }

        // === File Dokumen Update ===
        if ($request->hasFile('file_dokumen')) {
            if ($managePengumuman->file_dokumen_path && Storage::disk('public')->exists($managePengumuman->file_dokumen_path)) {
                Storage::disk('public')->delete($managePengumuman->file_dokumen_path);
            }

            $file = $request->file('file_dokumen');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'pengumuman_' . Str::slug($validated['judul']) . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('pengumuman/dokumen', $fileName, 'public');

            $validated['file_dokumen'] = $fileName;
            $validated['file_dokumen_path'] = $filePath;
            $validated['file_dokumen_size'] = $file->getSize();
            $validated['file_dokumen_type'] = $ext;
        }

        // === Simpan user yang sedang login ===
        $validated['user_id'] = Auth::id();

        $managePengumuman->update($validated);

        return redirect()->route('manage-pengumuman.index')->with('success', 'Pengumuman berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $managePengumuman = ManagePengumuman::findOrFail($id);

        // Hapus gambar jika ada
        if ($managePengumuman->gambar_path && Storage::disk('public')->exists($managePengumuman->gambar_path)) {
            Storage::disk('public')->delete($managePengumuman->gambar_path);
        }

        // Hapus dokumen jika ada
        if ($managePengumuman->file_dokumen_path && Storage::disk('public')->exists($managePengumuman->file_dokumen_path)) {
            Storage::disk('public')->delete($managePengumuman->file_dokumen_path);
        }

        $managePengumuman->delete();

        return redirect()->route('manage-pengumuman.index')->with('success', 'Pengumuman berhasil dihapus.');
    }

    /**
     * Export data pengumuman.
     */
    public function export(Request $request)
    {
        $filterSifat = $request->query('filterSifat');
        $filterStatus = $request->query('filterStatus');
        $search = $request->query('search');

        if ($filterSifat === 'all' || empty($filterSifat)) {
            $filterSifat = null;
        }
        if ($filterStatus === 'all' || empty($filterStatus)) {
            $filterStatus = null;
        }

        return (new ManagePengumumanExport($filterSifat, $filterStatus, $search))->export();
    }
}
