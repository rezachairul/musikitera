<?php

namespace App\Http\Controllers\admin\bph\publikasi_informasi;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\publikasi_informasi\ManageDokumen;




class ManageDokumenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = 'Dokumen';
        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

        // pisahkan keyword jika lebih dari 1 kata
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageDokumen::query();

        // search judul, kategori, status, deskripsi
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->orWhere('judul', 'like', "%{$word}%")
                    ->orWhere('kategori', 'like', "%{$word}%")
                    ->orWhere('is_active', 'like', "%{$word}%")
                    ->orWhere('deskripsi', 'like', "%{$word}%");
                }
            });
        }

        // filter kategori (kalau bukan all)
        if ($filter !== 'all') {
            $query->where('kategori', $filter);
        }

        // urutkan dokumen terbaru dulu
        $dokumens = $query->orderBy('created_at', 'desc')
            ->paginate($perPage === 'all' ? $query->count() : (int) $perPage);

        // Total dokumen dan total dokumen per kategori
        $KategoriDokumen = ['SOP', 'MoU', 'Format'];
        $totals = [];
        foreach ($KategoriDokumen as $dokumenKategori) {
            $totals[$dokumenKategori] = ManageDokumen::where('kategori', $dokumenKategori)->count();
        }
        $totals['all'] = array_sum($totals);

        // label kategori
        $kategoriLabels = [
            'SOP'    => ['label' => 'SOP', 'color' => 'bg-blue-100 text-blue-700 border border-blue-300'],
            'MoU'    => ['label' => 'MoU', 'color' => 'bg-green-100 text-green-700 border border-green-300'],
            'Format' => ['label' => 'Format', 'color' => 'bg-yellow-100 text-yellow-700 border border-yellow-300'],
        ];

        // kalau request AJAX, return partial table aja
        if ($request->ajax()) {
            return view('admin.bph.publikasi_informasi.dokumen.partials.table_body', compact('title','totals', 'kategoriLabels', 'dokumens', 'kategoriLabels'))->render();
        }

        // return ke view utama
        return view('admin.bph.publikasi_informasi.dokumen.index', compact('title', 'dokumens', 'kategoriLabels', 'filter', 'totals'));
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
        // validasi input
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'nullable|in:SOP,MoU,Format',
            'file'           => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // max 5MB
            'deskripsi'      => 'nullable|string',
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'is_active'      => 'nullable|boolean',
        ]);

        $filePath = null;
        $originalName = null;
        $fileSize = null;
        $fileType = null;

        // simpan file ke storage
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // bikin nama file dari judul, spasi ganti strip, plus timestamp biar unik
            $filename  = Str::slug($request->judul, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath  = $file->storeAs('dokumen', $filename, 'public');

            // ambil info file
            $originalName = $file->getClientOriginalName();
            $fileSize     = $file->getSize();
            $fileType     = $file->getClientOriginalExtension();
        }

        // simpan ke DB
        ManageDokumen::create([
            'judul'             => $validated['judul'],
            'kategori'          => $validated['kategori'] ?? null,
            'file_path'         => $filePath,
            'deskripsi'         => $validated['deskripsi'] ?? null,
            'original_filename' => $originalName,
            'file_size'         => $fileSize,
            'file_type'         => $fileType,
            'year_published'    => $validated['year_published'] ?? null,
            'is_active'         => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $dokumen = ManageDokumen::findOrFail($id);

        // validasi input
        $validated = $request->validate([
            'judul'          => 'required|string|max:255',
            'kategori'       => 'nullable|in:SOP,MoU,Format',
            'file'           => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:5120', // max 5MB
            'deskripsi'      => 'nullable|string',
            'year_published' => 'nullable|digits:4|integer|min:1900|max:' . date('Y'),
            'is_active'      => 'nullable|boolean',
        ]);

        $filePath       = $dokumen->file_path;
        $originalName   = $dokumen->original_filename;
        $fileSize       = $dokumen->file_size;
        $fileType       = $dokumen->file_type;

        // kalau ada file baru di-upload
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // hapus file lama dari storage kalau ada
            if ($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path)) {
                Storage::disk('public')->delete($dokumen->file_path);
            }

            // bikin nama file baru
            $filename  = Str::slug($request->judul, '-') . '-' . time() . '.' . $file->getClientOriginalExtension();
            $filePath  = $file->storeAs('dokumen', $filename, 'public');

            // update info file
            $originalName = $file->getClientOriginalName();
            $fileSize     = $file->getSize();
            $fileType     = $file->getClientOriginalExtension();
        }

        // update data ke DB
        $dokumen->update([
            'judul'             => $validated['judul'],
            'kategori'          => $validated['kategori'] ?? null,
            'file_path'         => $filePath,
            'deskripsi'         => $validated['deskripsi'] ?? null,
            'original_filename' => $originalName,
            'file_size'         => $fileSize,
            'file_type'         => $fileType,
            'year_published'    => $validated['year_published'] ?? null,
            'is_active'         => $validated['is_active'] ?? true,
        ]);

        return redirect()->route('dokumen.index')->with('success', 'Dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageDokumen $manageDokumen)
    {
        //
    }

    /**
     * Export dokumen (kosong dulu).
    */
    public function export() {
        return response()->json(['message' => 'Fitur export belum diimplementasikan.']);
    }
}
