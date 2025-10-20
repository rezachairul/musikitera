<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\bph\manajemen_anggota\ManageAlumni;

class ManageAlumniController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title    = 'Alumni';
        $search   = $request->input('search', '');
        $filterTahun = $request->query('tahun', 'all'); // filter tahun lulus
        $perPage  = $request->query('perPage', 10);
        $anggotaAktif = AnggotaAktif::orderBy('nama', 'asc')->get();

        // Ambil semua tahun lulus unik dari manage_alumnis (untuk dropdown filter)
        $tahunLulusList = ManageAlumni::select('tahun_lulus')
            ->whereNotNull('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus');

        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = AnggotaAktif::where('status', 'graduate')
            ->with('testimonis', 'manageAlumni'); // relasi ke alumni

        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where('nama', 'like', "%{$word}%")
                    ->orWhere('nim', 'like', "%{$word}%")
                    ->orWhere('prodi', 'like', "%{$word}%");
                }
            });
        }

        // ✅ Filter berdasarkan tahun lulus
        if ($filterTahun !== 'all') {
            $query->whereHas('manageAlumni', function ($q) use ($filterTahun) {
                $q->where('tahun_lulus', $filterTahun);
            });
        }

        // Urutkan berdasarkan tahun lulus terbaru, lalu nama
        $query->orderBy(
            ManageAlumni::select('tahun_lulus')
                ->whereColumn('manage_alumnis.anggota_id', 'anggota_aktifs.id')
                ->latest()
                ->take(1),
            'desc'
        )->orderBy('nama', 'asc');

        // Pagination
        $alumnis = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Hitung total alumni per tahun
        $totalsByYear = ManageAlumni::selectRaw('tahun_lulus, COUNT(*) as total')
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('total', 'tahun_lulus')
            ->toArray();
        $totalsByYear['all'] = array_sum($totalsByYear);

        if ($request->ajax()) {
            return view('admin.bph.manajemen_anggota.alumni.partials.table_body', compact('title', 'alumnis', 'tahunLulusList', 'filterTahun', 'totalsByYear', 'search', 'perPage', 'anggotaAktif'))->render();
        }

        return view('admin.bph.manajemen_anggota.alumni.index', compact(
            'title', 'alumnis', 'tahunLulusList', 'filterTahun', 'totalsByYear', 'search', 'perPage', 'anggotaAktif'
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ManageAlumni $manageAlumni)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ManageAlumni $manageAlumni)
    {
        //
    }
}
