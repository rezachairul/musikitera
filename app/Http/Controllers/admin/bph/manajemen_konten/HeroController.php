<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Exports\AnggotaExport;
use App\Models\admin\bph\Hero;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class HeroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = 'Hero';
        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = Hero::query();

        // Search
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('quote_1', 'like', "%{$word}%")
                        ->orWhere('quote_2', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Kalau mau bikin filter tambahan (misal filter image ada/ga ada), bisa disini
        if ($filter !== 'all') {
            if ($filter === 'with-image') {
                $query->whereNotNull('image');
            } elseif ($filter === 'without-image') {
                $query->whereNull('image');
            }
        }

        $query->orderBy('created_at', 'asc');

        // Paginate
        $heroes = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Hitung total
        $totalHeroes = $query->count();

        // AJAX response (table body partial)
        if ($request->ajax()) {
            return view(
                'admin.bph.manajemen_konten.hero.partials.table_body',
                compact('heroes', 'totalHeroes')
            )->render();
        }

        return view('admin.bph.manajemen_konten.hero.index', compact('title', 'heroes', 'totalHeroes'));
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
            'image'   => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'quote_1' => 'nullable|string|max:255',
            'quote_2' => 'nullable|string|max:255',
        ]);

        // ✅ Simpan gambar dengan nama asli
        if ($request->hasFile('image')) {
            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('heroes', $originalName, 'public');
            $validated['image'] = $path;
        }

        Hero::create($validated);

        return redirect()->back()->with('success', 'Hero berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $hero = Hero::findOrFail($id);

        $validated = $request->validate([
            'image'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'quote_1' => 'nullable|string|max:255',
            'quote_2' => 'nullable|string|max:255',
        ]);

        if ($request->hasFile('image')) {
            // Hapus foto lama
            if ($hero->image && Storage::disk('public')->exists($hero->image)) {
                Storage::disk('public')->delete($hero->image);
            }

            $originalName = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('heroes', $originalName, 'public');
            $validated['image'] = $path;
        }

        $hero->update($validated);

        return redirect()->back()->with('success', 'Hero berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if ($hero->image && Storage::disk('public')->exists($hero->image)) {
            Storage::disk('public')->delete($hero->image);
        }

        $hero->delete();

        return redirect()->back()->with('success', 'Hero berhasil dihapus.');
    }

    public function export()
    {

    }
}
