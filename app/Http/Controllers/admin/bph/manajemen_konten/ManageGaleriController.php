<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use App\Exports\ManageGaleriExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\manajemen_konten\ManageGaleri;

class ManageGaleriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title    = "Galeri";
        $search   = $request->input('search', '');
        $filter   = $request->query('filter', 'all');
        $perPage  = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageGaleri::query();

        // Search
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('title', 'like', "%{$word}%")
                        ->orWhere('description', 'like', "%{$word}%")
                        ->orWhere('kegiatan_date', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter & Order
        if ($filter === 'kegiatan_date') {
            $query->orderBy('kegiatan_date', 'desc');
        } else {
            // default 'all' -> urut berdasarkan title
            $query->orderBy('title', 'asc');
        }

        // Kalau ada search, tambahin urut title supaya konsisten
        if ($search) {
            $query->orderBy('title', 'asc');
        }

        // Hitung Total Galeri
        $totalGaleris = $query->count();

        // Pagination
        $galeris = $query->paginate(
            $perPage === 'all' ? $totalGaleris : (int) $perPage
        );

        // AJAX response
        if ($request->ajax()) {
            return view( 'admin.bph.manajemen_konten.galeri.partials.table_body', compact('title', 'galeris', 'totalGaleris'))->render();
        }

        return view('admin.bph.manajemen_konten.galeri.index',compact('title', 'galeris', 'totalGaleris'));
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
        // dd($request->all());
        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'image'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kegiatan_date' => 'nullable|date',
        ]);

        // Simpan image dengan nama sesuai title
        if ($request->hasFile('image')) {
            $file      = $request->file('image');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['title'], '-') . '.' . $ext;

            // simpan ke storage/app/public/galeri
            $path = $file->storeAs('galeri', $fileName, 'public');
            $validated['image'] = $path;
        }

        ManageGaleri::create($validated);

        return redirect()->back()->with('success', 'Galeri berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageGaleri $manageGaleri)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageGaleri $manageGaleri)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $galeri = ManageGaleri::findOrFail($id);

        $validated = $request->validate([
            'title'         => 'required|string|max:255',
            'description'   => 'nullable|string|max:255',
            'image'         => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'kegiatan_date' => 'nullable|date',
        ]);

        // update image kalau ada file baru
        if ($request->hasFile('image')) {
            // hapus image lama
            if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
                Storage::disk('public')->delete($galeri->image);
            }

            $file      = $request->file('image');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['title'], '-') . '.' . $ext;

            $path = $file->storeAs('galeri', $fileName, 'public');
            $validated['image'] = $path;
        }

        $galeri->update($validated);

        return redirect()->back()->with('success', 'Galeri berhasil diupdate.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $galeri = ManageGaleri::findOrFail($id);

        if ($galeri->image && Storage::disk('public')->exists($galeri->image)) {
            Storage::disk('public')->delete($galeri->image);
        }

        $galeri->delete();

        return redirect()->back()->with('success', 'Galeri berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $search = $request->query('search');

        return (new ManageGaleriExport( $search))->export();
    }
}
