<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\ManageKegiatanExport;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\publikasi_informasi\ManageKegiatan;

class ManageKegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = "Kegiatan";
        $search  = $request->input('search', '');
        $filterKategori = $request->query('filterKategori', 'all');
        $filterStatus   = $request->query('filterStatus', 'all');
        $perPage = $request->query('perPage', 10);

        // ================== 🔍 Pencarian ==================
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageKegiatan::query();

        // Search berdasarkan beberapa kolom
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('nama_kegiatan', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%")
                        ->orWhere('kategori', 'like', "%{$word}%")
                        ->orWhere('tanggal_mulai', 'like', "%{$word}%")
                        ->orWhere('tanggal_selesai', 'like', "%{$word}%")
                        ->orWhere('jam_mulai', 'like', "%{$word}%")
                        ->orWhere('jam_selesai', 'like', "%{$word}%")
                        ->orWhere('lokasi', 'like', "%{$word}%")
                        ->orWhere('poster', 'like', "%{$word}%")
                        ->orWhere('lampiran_path', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        // ================== 🧩 Filter Kategori ==================
        if ($filterKategori !== 'all') {
            $query->where('kategori', $filterKategori);
        }

        // ================== 🧩 Filter Status ==================
        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        // ================== 🔢 Urutan & Pagination ==================
        $query->orderByDesc('created_at');
        $kegiatans = $query->orderBy('created_at', 'desc')
            ->paginate($perPage === 'all' ? $query->count() : (int) $perPage);
        $totalKegiatan = $query->count();

        // ================== 🏷️ Label Status ==================
        $statusLabels = [
            'draft'     => 'Draft',
            'published' => 'Dipublikasikan',
            'done'      => 'Selesai',
        ];

        // ================== 🔁 AJAX Partial View ==================
        if ($request->AJAX()) {
            return view('admin.bph.publikasi_informasi.kegiatan.partials.table_body', compact('title', 'kegiatans', 'statusLabels', 'totalKegiatan', 'filterKategori', 'filterStatus', 'perPage', 'search'))->render();
        }

        // ================== 📄 Full Page View ==================
        return view(
            'admin.bph.publikasi_informasi.kegiatan.index',
            compact('title', 'kegiatans', 'statusLabels', 'totalKegiatan', 'filterKategori', 'filterStatus', 'perPage', 'search')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'kategori'        => 'nullable|string|max:100',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'nullable|date_format:H:i',
            'jam_selesai'     => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'          => 'nullable|string|max:255',

            // file
            'poster'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lampiran' => 'nullable|file|max:4096',

            // status
            'status'       => 'required|in:draft,published,done',
            'is_highlight' => 'nullable|boolean',
        ]);

        // Upload poster
        if ($request->hasFile('poster')) {
            $file = $request->file('poster');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'poster_' . Str::slug($validated['nama_kegiatan'], '-') . '_' . time() . '.' . $ext;
            $path = $file->storeAs('kegiatan/poster', $fileName, 'public');

            $validated['poster'] = $path;
        }

        // Upload lampiran
        if ($request->hasFile('lampiran')) {
            $file = $request->file('lampiran');
            $ext  = $file->getClientOriginalExtension();

            $fileName = 'lampiran_' . Str::slug($validated['nama_kegiatan'], '-') . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('kegiatan/lampiran', $fileName, 'public');

            // mapping ke kolom di DB
            $validated['lampiran_path']     = $filePath;
            $validated['lampiran_original'] = $file->getClientOriginalName();
            $validated['lampiran_size']     = $file->getSize();
            $validated['lampiran_type']     = $ext;
        }

        ManageKegiatan::create($validated);

        return redirect()->route('manage-kegiatan.index')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id)
    {
        dd($id);
        $manageKegiatan = ManageKegiatan::findOrFail($id);
        $validated = $request->validate([
            'nama_kegiatan'   => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',
            'kategori'        => 'nullable|string|max:100',
            'tanggal_mulai'   => 'required|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'jam_mulai'       => 'nullable|date_format:H:i',
            'jam_selesai'     => 'nullable|date_format:H:i|after_or_equal:jam_mulai',
            'lokasi'          => 'nullable|string|max:255',

            // file
            'poster'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'lampiran' => 'nullable|file|max:4096',

            // status
            'status'       => 'required|in:draft,published,done',
            'is_highlight' => 'nullable|boolean',
        ]);

        // === Poster Update ===
        if ($request->hasFile('poster')) {
            // hapus poster lama
            if ($manageKegiatan->poster && Storage::disk('public')->exists($manageKegiatan->poster)) {
                Storage::disk('public')->delete($manageKegiatan->poster);
            }

            $file = $request->file('poster');
            $ext = $file->getClientOriginalExtension();

            $fileName = 'poster_' . Str::slug($validated['nama_kegiatan'], '-') . '_' . time() . '.' . $ext;
            $path = $file->storeAs('kegiatan/poster', $fileName, 'public');

            $validated['poster'] = $path;
        }

        // === Lampiran Update ===
        if ($request->hasFile('lampiran')) {
            // hapus lampiran lama
            if ($manageKegiatan->lampiran_path && Storage::disk('public')->exists($manageKegiatan->lampiran_path)) {
                Storage::disk('public')->delete($manageKegiatan->lampiran_path);
            }

            $file = $request->file('lampiran');
            $ext  = $file->getClientOriginalExtension();

            $fileName = 'lampiran_' . Str::slug($validated['nama_kegiatan'], '-') . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('kegiatan/lampiran', $fileName, 'public');

            $validated['lampiran_path']     = $filePath;
            $validated['lampiran_original'] = $file->getClientOriginalName();
            $validated['lampiran_size']     = $file->getSize();
            $validated['lampiran_type']     = $ext;
        }

        // Update DB
        $manageKegiatan->update($validated);

        return redirect()->route('manage-kegiatan.index')
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $manageKegiatan = ManageKegiatan::findOrFail($id);
        // Hapus poster kalau ada
        if ($manageKegiatan->poster && Storage::disk('public')->exists($manageKegiatan->poster)) {
            Storage::disk('public')->delete($manageKegiatan->poster);
        }

        // Hapus lampiran kalau ada
        if ($manageKegiatan->lampiran_path && Storage::disk('public')->exists($manageKegiatan->lampiran_path)) {
            Storage::disk('public')->delete($manageKegiatan->lampiran_path);
        }

        // Hapus record dari database
        $manageKegiatan->delete();

        return redirect()->route('manage-kegiatan.index')->with('success', 'Kegiatan berhasil dihapus.');
    }

    /**
     * Export dokumen (kosong dulu).
    */
    public function export(Request $request)
    {
        $filterKategori = $request->query('filterKategori');
        $filterStatus   = $request->query('filterStatus');
        $search         = $request->query('search');

        // Normalisasi filter
        if ($filterKategori === 'all' || empty($filterKategori)) {
            $filterKategori = null;
        }
        if ($filterStatus === 'all' || empty($filterStatus)) {
            $filterStatus = null;
        }

        return (new ManageKegiatanExport($filterKategori, $filterStatus, $search))->export();
    }

}
