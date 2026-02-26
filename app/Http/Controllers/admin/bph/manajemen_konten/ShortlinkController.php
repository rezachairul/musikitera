<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\admin\bph\manajemen_konten\Shortlink;

class ShortlinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Daftar Short Link';
        $search = $request->input('search', '');
        $filterStatus = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

         // Pisahkan keyword (multi kata)
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Query dasar
        $query = Shortlink::query();

        // Total
        $totalAll = Shortlink::count(); 

        // Search multi kolom multi keyword
        if (!empty($keywords)) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('original_url', 'like', "%{$word}%")
                        ->orWhere('slug', 'like', "%{$word}%");
                    });
                }
            });
        }

        // FILTER status
        if ($filterStatus !== 'all') {
            if ($filterStatus === 'active') {
                $query->where('is_hidden', false)
                    ->where(function ($q) {
                        $q->whereNull('expired_at')
                            ->orWhere('expired_at', '>', now());
                    });
            }

            if ($filterStatus === 'hidden') {
                $query->where('is_hidden', true);
            }

            if ($filterStatus === 'expired') {
                $query->whereNotNull('expired_at')
                    ->where('expired_at', '<=', now());
            }
        }

        // Hitung total setelah filter
        $totalFiltered = $query->count();

        // Urutkan dari yang terbaru
        $query->orderBy('created_at', 'asc');

        // Paginate Dinamis
        $shortlinks = $query->paginate(
            $perPage === 'all' ? $totalFiltered : (int) $perPage
        );

        // Response AJAX (untuk tabel saja)
        if ($request->ajax()) {
            return view('admin.bph.manajemen_konten.shortlink.partials.table_body', compact(
                'shortlinks', 'search', 'filterStatus', 'perPage', 'totalAll', 'totalFiltered',
            ))->render();
        }

        return view('admin.bph.manajemen_konten.shortlink.index', compact('title', 'search', 'filterStatus', 'perPage', 'shortlinks', 'totalAll', 'totalFiltered'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $data = $request->validate([
            'original_url' => 'required|url',
            'slug' => 'nullable|string|max:100',
            'is_hidden' => 'required|in:0,1',
            'expired_at' => 'nullable|date',
        ]);

        // Jika user isi slug → slugify + hapus spasi depan/belakang
        if (!empty($data['slug'])) {
            $slug = Str::slug(trim($data['slug']));
        } else {
            // Jika kosong → random
            $slug = Str::random(6);
        }

        // Pastikan unik
        $originalSlug = $slug;
        $counter = 1;
        while (Shortlink::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;

        // Expired default 3 bulan
        $data['expired_at'] = !empty($data['expired_at'])
            ? Carbon::parse($data['expired_at'])->toDateString()
            : now()->addMonths(3)->toDateString();

        Shortlink::create($data);

        return redirect()->back()->with('success', 'Shortlink berhasil dibuat!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $shortlink = Shortlink::findOrFail($id);

        $data = $request->validate([
            'original_url' => 'required|url',
            'slug' => 'nullable|string|max:100',
            'is_hidden' => 'required|in:0,1',
            'expired_at' => 'nullable|date',
        ]);

        // Jika user isi slug → slugify
        if (!empty($data['slug'])) {
            $slug = Str::slug($data['slug']);
        } else {
            // Jika kosong → pakai slug lama (biar link ga berubah)
            $slug = $shortlink->slug;
        }

        // Pastikan unik (kecuali dirinya sendiri)
        $originalSlug = $slug;
        $counter = 1;
        while (
            Shortlink::where('slug', $slug)
                ->where('id', '!=', $shortlink->id)
                ->exists()
        ) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $data['slug'] = $slug;

        // Expired default 3 bulan jika kosong
        $data['expired_at'] = !empty($data['expired_at'])
            ? Carbon::parse($data['expired_at'])->toDateString()
            : now()->addMonths(3)->toDateString();

        // Update data
        $shortlink->update($data);

        return redirect()->back()->with('success', 'Shortlink berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //  dd($id);

        $shortlink = Shortlink::findOrFail($id);
        $shortlink->delete();

        return redirect()->back()->with('success', 'Shortlink berhasil dihapus!');
    }

    /**
     * Redirect shortlink
     */
    public function redirect($slug)
    {
        $shortlink = Shortlink::where('slug', $slug)->firstOrFail();

        // Jika disembunyikan
        if ($shortlink->is_hidden) {
            abort(404);
        }

        // Jika expired
        if ($shortlink->expired_at && now()->greaterThan($shortlink->expired_at)) {
            abort(404);
        }

        // Increment jumlah klik
        $shortlink->increment('click_count');

        return redirect()->away($shortlink->original_url);
    }
}
