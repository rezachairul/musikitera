<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\bph\manajemen_konten\ManageTestimoni;

class ManageTestimoniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title       = 'Apa Kata Mereka?';
        $search      = $request->input('search', '');
        $filterProdi = $request->query('filterProdi', 'all');
        $perPage     = $request->query('perPage', 10);
        $anggotaAktif = AnggotaAktif::orderBy('nama', 'asc')->get();

        // Pisahkan search menjadi array kata
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageTestimoni::with('anggota');
        $totalAll = ManageTestimoni::count();

        // Search multi kolom (nama, prodi, kesan, pesan)
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->whereHas('anggota', function ($q2) use ($word) {
                        $q2->where('nama', 'like', "%{$word}%")
                        ->orWhere('prodi', 'like', "%{$word}%");
                    })
                    ->orWhere('kesan', 'like', "%{$word}%")
                    ->orWhere('pesan', 'like', "%{$word}%");
                }
            });
        }

        // Filter berdasarkan program studi
        if ($filterProdi !== 'all') {
            $query->whereHas('anggota', function ($q) use ($filterProdi) {
                $q->where('prodi', $filterProdi);
            });
        }

        // Hitung data setelah filter/search
        $totalFiltered = $query->count();

        // Urutan terbaru
        $query->orderBy('created_at', 'desc');

        // Pagination
        $testimonis = $query->paginate(
            $perPage === 'all' ? $totalFiltered : (int) $perPage
        );

        // Daftar Prodi unik (untuk filter dropdown)
        $programStudis = AnggotaAktif::select('prodi')->distinct()->pluck('prodi');

        // Jika AJAX request → hanya render bagian tabel
        if ($request->AJAX()) {
            return view('admin.bph.manajemen_konten.testimoni.partials.table_body', compact(
                'testimonis', 'programStudis', 'filterProdi', 'search', 'perPage', 'anggotaAktif', 'totalAll', 'totalFiltered'
            ))->render();
        }

        // Return full view
        return view('admin.bph.manajemen_konten.testimoni.index', compact(
            'title', 'testimonis', 'programStudis', 'filterProdi', 'search', 'perPage', 'anggotaAktif', 'totalAll', 'totalFiltered'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggota_aktifs,id',
            'kesan'      => 'nullable|string',
            'pesan'      => 'nullable|string',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $pathFoto = null;

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $anggotaName = Str::slug($request->anggota_nama ?? 'anggota');
            $fileName = 'Testimoni_' . $anggotaName . '_' . Carbon::now()->format('Ymd_His') . '.' . $request->file('foto')->getClientOriginalExtension();
            $pathFoto = $request->file('foto')->storeAs('public/testimoni', $fileName);
        }

        ManageTestimoni::create([
            'anggota_id' => $request->anggota_id,
            'kesan'      => $request->kesan,
            'pesan'      => $request->pesan,
            'foto'       => $pathFoto ? str_replace('public/', '', $pathFoto) : null,
        ]);

        return redirect()->back()->with('success', 'Testimoni berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageTestimoni $manageTestimoni)
    {
        $request->validate([
            'kesan' => 'nullable|string',
            'pesan' => 'nullable|string',
            'foto'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data = [
            'kesan' => $request->kesan,
            'pesan' => $request->pesan,
        ];

        // Jika upload foto baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika ada
            if ($manageTestimoni->foto && Storage::exists('public/' . $manageTestimoni->foto)) {
                Storage::delete('public/' . $manageTestimoni->foto);
            }

            $anggotaName = Str::slug($manageTestimoni->anggotaAktif->nama);
            $fileName = 'Testimoni_' . $anggotaName . '_' . Carbon::now()->format('Ymd_His') . '.' . $request->file('foto')->getClientOriginalExtension();
            $pathFoto = $request->file('foto')->storeAs('public/testimoni', $fileName);

            $data['foto'] = str_replace('public/', '', $pathFoto);
        }

        $manageTestimoni->update($data);

        return redirect()->back()->with('success', 'Testimoni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageTestimoni $manageTestimoni)
    {
        if ($manageTestimoni->foto && Storage::exists('public/' . $manageTestimoni->foto)) {
            Storage::delete('public/' . $manageTestimoni->foto);
        }

        $manageTestimoni->delete();

        return redirect()->back()->with('success', 'Testimoni berhasil dihapus.');
    }
}
