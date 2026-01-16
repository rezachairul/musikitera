<?php

namespace App\Http\Controllers\admin\bph\kerjasama_mitra;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use App\Models\admin\bph\kerjasama_mitra\ManageKerjasama;
use App\Exports\ManageKerjasamaExport;
use Maatwebsite\Excel\Facades\Excel;


class ManageKerjasamaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = "Kerjasama";
        $search  = $request->input('search', '');
        $filterJenis  = $request->query('filterJenis', 'all');
        $filterStatus = $request->query('filterStatus', 'all');
        $perPage = $request->query('perPage', 10);

        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageKerjasama::query();

        // 🔍 Pencarian
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('judul_kerjasama', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%")
                        ->orWhere('nama_organisasi', 'like', "%{$word}%")
                        ->orWhere('jenis_kerjasama', 'like', "%{$word}%")
                        ->orWhere('status', 'like', "%{$word}%");
                }
            });
        }

        // 🧩 Filter Jenis Kerjasama
        if ($filterJenis !== 'all') {
            $query->where('jenis_kerjasama', $filterJenis);
        }

        // 🧩 Filter Status
        if ($filterStatus !== 'all') {
            $query->where('status', $filterStatus);
        }

        // 🔢 Urutkan & Pagination
        $query->orderByDesc('created_at');
        $kerjasamas = $query->paginate($perPage === 'all' ? $query->count() : (int) $perPage);
        $totalKerjasama = $query->count();

        // Label status
        $statusLabels = [
            'rencana'  => 'Rencana',
            'berjalan' => 'Berjalan',
            'selesai'  => 'Selesai',
        ];

        // Ambil list mitra untuk dropdown di form create/edit
        $mitras = ManageMitra::all();

        // Jika request via AJAX (misal filter / search)
        if ($request->AJAX()) {
            return view('admin.bph.kerjasama_mitra.kerjasama.partials.table_body', compact(
                    'title',
                'kerjasamas',
                'statusLabels',
                'totalKerjasama',
                'filterJenis',
                'filterStatus',
                'perPage',
                'search',
                'mitras'
            ))->render();
        }

        return view('admin.bph.kerjasama_mitra.kerjasama.index', compact(
            'title',
            'kerjasamas',
            'statusLabels',
            'totalKerjasama',
            'filterJenis',
            'filterStatus',
            'perPage',
            'search',
            'mitras'
        ));
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
        $validated = $request->validate([
            'is_from_mitra'     => 'required|boolean',
            'mitra_id'          => 'nullable|exists:mitras,id',
            'nama_organisasi'   => 'nullable|string|max:255',
            'judul_kerjasama'   => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'jenis_kerjasama'   => 'required|string',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'            => 'required|string',
            'file_dokumen'      => 'nullable|file|max:2048',
            'poster'            => 'nullable|image|max:2048',
            'link_dokumentasi'  => 'nullable|string|max:255',
        ]);

        if ($validated['is_from_mitra']) {
            $validated['nama_organisasi'] = null;
        } else {
            $validated['mitra_id'] = null;
        }

        // Upload file dokumen (jika ada)
        if ($request->hasFile('file_dokumen')) {
            $file = $request->file('file_dokumen');
            $ext  = $file->getClientOriginalExtension();

            // Ambil ukuran file SEBELUM disimpan
            $size = $file->getSize();

            $fileName = 'kerjasama_' . Str::slug($validated['judul_kerjasama']) . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('kerjasama/dokumen', $fileName, 'public');

            // mapping ke kolom database
            $validated['file_dokumen_path'] = $filePath;
            $validated['file_dokumen'] = $file->getClientOriginalName();
            $validated['file_dokumen_size'] = $size; // ← ini yang penting!
            $validated['file_dokumen_type'] = $ext;
        }

        // Upload poster (jika ada)
        if ($request->hasFile('poster')) {
            $poster = $request->file('poster');

            // Ambil ukuran sebelum disimpan (optional tapi baik)
            $posterSize = $poster->getSize();

            $path = $poster->storeAs('kerjasama/poster', $poster->getClientOriginalName(), 'public');

            $validated['poster'] = $poster->getClientOriginalName();
            $validated['poster_size'] = $posterSize;
            $validated['poster_type'] = $poster->getClientMimeType();
        }

        ManageKerjasama::create($validated);

        return redirect()->back()->with('success', 'Data kerjasama berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($id);
        $kerjasama = ManageKerjasama::findOrFail($id);

        $validated = $request->validate([
            'is_from_mitra'     => 'required|boolean',
            'mitra_id'          => 'nullable|exists:mitras,id',
            'nama_organisasi'   => 'nullable|string|max:255',
            'judul_kerjasama'   => 'required|string|max:255',
            'deskripsi'         => 'nullable|string',
            'jenis_kerjasama'   => 'required|string',
            'tanggal_mulai'     => 'required|date',
            'tanggal_selesai'   => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'            => 'required|string',
            'file_dokumen'      => 'nullable|file|max:2048',
            'poster'            => 'nullable|image|max:2048',
            'link_dokumentasi'  => 'nullable|string|max:255',
        ]);

        // Atur nilai organisasi/mitra agar tidak bentrok
        if ($validated['is_from_mitra']) {
            $validated['nama_organisasi'] = null;
        } else {
            $validated['mitra_id'] = null;
        }

        // ==========================
        // Update file dokumen
        // ==========================
        if ($request->hasFile('file_dokumen')) {
            // Hapus file lama (jika ada)
            if ($kerjasama->file_dokumen_path && Storage::disk('public')->exists($kerjasama->file_dokumen_path)) {
                Storage::disk('public')->delete($kerjasama->file_dokumen_path);
            }

            $file = $request->file('file_dokumen');
            $ext  = $file->getClientOriginalExtension();
            $size = $file->getSize();

            $fileName = 'kerjasama_' . Str::slug($validated['judul_kerjasama']) . '_' . time() . '.' . $ext;
            $filePath = $file->storeAs('kerjasama/dokumen', $fileName, 'public');

            $validated['file_dokumen_path'] = $filePath;
            $validated['file_dokumen'] = $file->getClientOriginalName();
            $validated['file_dokumen_size'] = $size;
            $validated['file_dokumen_type'] = $ext;
        }

        // ==========================
        // Update poster
        // ==========================
        if ($request->hasFile('poster')) {
            // Hapus poster lama (jika ada)
            if ($kerjasama->poster && Storage::disk('public')->exists('kerjasama/poster/' . $kerjasama->poster)) {
                Storage::disk('public')->delete('kerjasama/poster/' . $kerjasama->poster);
            }

            $poster = $request->file('poster');
            $posterSize = $poster->getSize();

            $path = $poster->storeAs('kerjasama/poster', $poster->getClientOriginalName(), 'public');

            $validated['poster'] = $poster->getClientOriginalName();
            $validated['poster_size'] = $posterSize;
            $validated['poster_type'] = $poster->getClientMimeType();
        }

        // ==========================
        // Update ke database
        // ==========================
        $kerjasama->update($validated);

        return redirect()->back()->with('success', 'Data kerjasama berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $manageKerjasama = ManageKerjasama::findOrFail($id);
        if ($manageKerjasama->file_dokumen) {
            Storage::disk('public')->delete($manageKerjasama->file_dokumen);
        }

        if ($manageKerjasama->poster) {
            Storage::disk('public')->delete($manageKerjasama->poster);
        }

        $manageKerjasama->delete();

        return redirect()->back()->with('success', 'Data kerjasama berhasil dihapus.');
    }

     public function export(Request $request)
    {
        $filterJenis  = $request->query('filterJenis', 'all');
        $filterStatus = $request->query('filterStatus', 'all');
        $search       = $request->query('search', '');

        // Normalisasi filter
        if ($filterJenis === 'all' || empty($filterJenis)) {
            $filterJenis = null;
        }
        if ($filterStatus === 'all' || empty($filterStatus)) {
            $filterStatus = null;
        }

        return (new ManageKerjasamaExport($filterJenis, $filterStatus, $search))->export();
    }
}
