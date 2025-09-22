<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use App\Models\admin\bph\AnggotaAktif;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class AnggotaAktifController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $title   = 'Anggota';
        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // Status yang digunakan
        $statuss = ['graduate', 'on_going', 'drop_out', 'exit'];

        // Build query untuk tiap status
        $queries = [];
        foreach ($statuss as $status) {
            $queries[$status] = AnggotaAktif::where('status', $status);

            if ($search) {
                $queries[$status]->where(function ($q) use ($keywords) {
                    foreach ($keywords as $word) {
                        $q->where(function ($q) use ($word) {
                            $q->where('nama', 'like', "%{$word}%")
                            ->orWhere('nim', 'like', "%{$word}%")
                            ->orWhere('nia', 'like', "%{$word}%")
                            ->orWhere('prodi', 'like', "%{$word}%");
                        });
                    }
                    // urutan: pendiri dulu, lalu berdasarkan nomor urut
                });
            }
            $queries[$status]
                ->orderByDesc('pendiri')
                ->orderBy('nomor_urut');
        }

        // Ambil data sesuai filter
        $results = [];
        foreach ($statuss as $status) {
            if ($filter === $status) {
                $results[$status] = $queries[$status]->get();
            } elseif ($filter === 'all') {
                $results[$status] = $queries[$status]->get();
            } else {
                $results[$status] = collect(); // kosong
            }
        }

        // Merge semua hasil
        $merged = collect([]);
        foreach ($statuss as $status) {
            $merged = $merged->merge($results[$status]);
        }

        // Pagination manual
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        if ($perPage === 'all') {
            $perPage = max(1, $merged->count());
        } else {
            $perPage = max(1, (int) $perPage);
        }

        if ($merged->isEmpty()) {
            $anggota_aktifs = new LengthAwarePaginator([], 0, $perPage, $currentPage, [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
        } else {
            $currentItems = $merged->slice(($currentPage - 1) * $perPage, $perPage)->values();
            $total = $merged->count();

            $anggota_aktifs = new LengthAwarePaginator($currentItems, $total, $perPage, $currentPage, [
                'path'  => $request->url(),
                'query' => $request->query(),
            ]);
        }

        // Hitung total anggota sesuai status
        $totals = [];
        foreach ($statuss as $status) {
            $totals[$status] = AnggotaAktif::where('status', $status)->count();
        }

        // Total keseluruhan
        $totals['all'] = array_sum($totals);

        // Label dan warna untuk tiap status
        $statusLabels = [
            'graduate' => [
                'label' => 'Lulus',
                'color' => 'bg-green-100 text-green-700 border border-green-300',
            ],
            'on_going' => [
                'label' => 'Aktif',
                'color' => 'bg-blue-100 text-blue-700 border border-blue-300',
            ],
            'drop_out' => [
                'label' => 'Drop Out',
                'color' => 'bg-red-100 text-red-700 border border-red-300',
            ],
            'exit' => [
                'label' => 'Keluar',
                'color' => 'bg-gray-100 text-gray-700 border border-gray-300',
            ],
        ];

        // AJAX response
        if ($request->ajax()) {
            return view(
                'admin.bph.manajemen_anggota.anggota_aktif.partials.table_body',
                compact('anggota_aktifs', 'statusLabels')
            )->render();
        }

        return view('admin.bph.manajemen_anggota.anggota_aktif.index', compact(
            'title',
            'anggota_aktifs',
            'statusLabels',
            'totals',
            'filter'
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
        // dd($request->all());
        // 1. validasi dulu
        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'nim'          => 'required|string|max:15|unique:anggota_aktifs,nim',
            'angkatan'     => 'required|integer|min:2000|max:' . date('Y'),
            'prodi'        => 'required|string|max:255',
            'nomor_urut'   => 'required|integer',
            'angkatan_ukm' => 'required|integer|min:1',
            'pendiri'      => 'nullable|boolean',
            'status'       => 'required|in:graduate,on_going,drop_out,exit',
        ]);

        // 2. buat object sementara untuk dapatkan NIA dari accessor model
        $anggota = new AnggotaAktif($validated);

        // ambil nia otomatis dari accessor
        $nia = $anggota->nia;

        // 3. simpan ke DB (include nia)
        $anggota->nia = $nia;
        $anggota->save();

        return redirect()->route('anggota-aktif.index')
            ->with('success', 'Data anggota berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AnggotaAktif $anggotaAktif)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AnggotaAktif $anggotaAktif)
    {
        //
    }
}
