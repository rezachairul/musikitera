<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;
use App\Exports\ManageLinkExport;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\admin\bph\manajemen_konten\Link;
use Illuminate\Pagination\LengthAwarePaginator;

class LinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Daftar Link';
        $search = $request->input('search', '');
        $filterKategori = $request->query('filterKategori', 'all');
        $perPage = $request->query('perPage', 10);

        // Pisahkan keyword (multi kata)
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query dasar
        $query = Link::query();

        // Total keseluruhan sebelum filter
        $totalAll = Link::count();

        // 🔍 Pencarian (multi kolom, multi keyword)
        if (!empty($keywords)) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_link', 'like', "%{$word}%")
                        ->orWhere('url', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%");
                    });
                }
            });
        }

        // 🎯 Filter kategori (jika bukan 'all')
        if ($filterKategori !== 'all') {
            $query->where('kategori', $filterKategori);
        }

        // Hitung total setelah filter
        $totalFiltered = $query->count();

        // Urutkan terbaru
        $query->orderBy('created_at', 'desc');

        // Pagination dinamis
        $links = $query->paginate(
            $perPage === 'all' ? $totalFiltered : (int) $perPage
        );

        // 🔖 Ambil daftar kategori dari Model
        $kategoriList = Link::getKategoriList();

        // Response AJAX (untuk tabel saja)
        if ($request->ajax()) {
            return view('admin.bph.manajemen_konten.link.partials.table_body', compact(
                'links', 'search', 'filterKategori', 'perPage', 'totalAll', 'totalFiltered', 'kategoriList'
            ))->render();
        }

        // Response full page
        return view('admin.bph.manajemen_konten.link.index', compact(
            'title', 'links', 'search', 'filterKategori', 'perPage', 'totalAll', 'totalFiltered', 'kategoriList'
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
            'nama_link'  => 'required|string|max:255',
            'url'        => 'required|url|max:2048',
            'kategori'   => 'required|string',
            'deskripsi'  => 'nullable|string',
            'status'     => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        Link::create($validated);

        return redirect()->back()->with('success', 'Link berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Link $link)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Link $link)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $link = Link::findOrFail($id);

        $validated = $request->validate([
            'nama_link'  => 'required|string|max:255',
            'url'        => 'required|url|max:2048',
            'kategori'   => 'required|string',
            'deskripsi'  => 'nullable|string',
            'status'     => 'nullable|boolean',
        ]);

        $validated['status'] = $request->boolean('status', true);

        $link->update($validated);

        return redirect()->back()->with('success', 'Data link berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $link = Link::findOrFail($id);
        $link->delete();

        return redirect()->back()->with('success', 'Data link berhasil dihapus.');
    }

    /**
     * Export data to Excel.
     */

    public function export(Request $request)
    {
        $search = $request->query('search', '');
        $filterKategori = $request->query('filterKategori', 'all');

        return (new ManageLinkExport($search, $filterKategori))->export();
    }

}
