<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        $title = 'Alumni';
        $search = $request->input('search', '');
        $filterTahun = $request->query('tahun', 'all');
        $perPage = $request->query('perPage', 10);

        // ✅ Ambil hanya anggota aktif yang berstatus "graduate" untuk form create
        $anggotaAktif = AnggotaAktif::where('status', 'graduate')
            ->whereDoesntHave('alumnis') // agar tidak bisa pilih yang sudah jadi alumni
            ->orderBy('nama', 'asc')
            ->get();

        // ✅ Ambil semua tahun lulus unik dari tabel manage_alumnis (untuk filter dropdown)
        $tahunLulusList = ManageAlumni::select('tahun_lulus')
            ->whereNotNull('tahun_lulus')
            ->distinct()
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('tahun_lulus');

        // 🔍 Pencarian
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // ✅ Query utama hanya dari tabel ManageAlumni
        $query = ManageAlumni::with('anggota');

        if ($search) {
            $query->whereHas('anggota', function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where('nama', 'like', "%{$word}%")
                        ->orWhere('nia', 'like', "%{$word}%")
                        ->orWhere('prodi', 'like', "%{$word}%")
                        ->orWhere('angkatan', 'like', "%{$word}%");
                }
            });
        }

        // ✅ Filter berdasarkan tahun lulus alumni
        if ($filterTahun !== 'all') {
            $query->where('tahun_lulus', $filterTahun);
        }

        // ✅ Urutkan berdasarkan tahun_lulus terbaru lalu nama anggota
        $query->orderBy('tahun_lulus', 'desc')
            ->orderBy(
                AnggotaAktif::select('nama')
                    ->whereColumn('anggota_aktifs.id', 'manage_alumnis.anggota_id')
            );

        // ✅ Pagination (bisa 'all' atau angka)
        $alumnis = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // ✅ Hitung total alumni per tahun
        $totalsByYear = ManageAlumni::selectRaw('tahun_lulus, COUNT(*) as total')
            ->groupBy('tahun_lulus')
            ->orderBy('tahun_lulus', 'desc')
            ->pluck('total', 'tahun_lulus')
            ->toArray();

        $totalsByYear['all'] = array_sum($totalsByYear);

        // ✅ Label status
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

        // ✅ Untuk request AJAX (misal filter/pagination dinamis)
        if ($request->ajax()) {
            return view('admin.bph.manajemen_anggota.alumni.partials.table_body', compact(
                'title',
                'alumnis',
                'tahunLulusList',
                'filterTahun',
                'totalsByYear',
                'search',
                'perPage',
                'anggotaAktif',
                'statusLabels'
            ))->render();
        }

        // ✅ View utama
        return view('admin.bph.manajemen_anggota.alumni.index', compact(
            'title',
            'alumnis',
            'tahunLulusList',
            'filterTahun',
            'totalsByYear',
            'search',
            'perPage',
            'anggotaAktif',
            'statusLabels'
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
        // Validasi
        $validated = $request->validate([
            'anggota_id'   => 'required|exists:anggota_aktifs,id|unique:manage_alumnis,anggota_id',
            'tahun_lulus'  => 'required|digits:4|integer',
            'pekerjaan'    => 'nullable|string|max:255',
            'quote'        => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);

        $pathFoto = null;

        // Upload foto kalau ada
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $anggota = AnggotaAktif::find($request->anggota_id);
            $anggotaName = Str::slug($anggota->nama ?? 'alumni');
            $fileName = 'Alumni_' . $anggotaName . '_' . Carbon::now()->format('Ymd_His') . '.' . $file->getClientOriginalExtension();

            // ✅ Gunakan disk 'public', bukan hardcoded 'public/alumni'
            $pathFoto = $file->storeAs('alumni', $fileName, 'public');
        }

        // Simpan ke database (path relatif sudah benar)
        $alumni = ManageAlumni::create([
            'anggota_id'  => $request->anggota_id,
            'tahun_lulus' => $request->tahun_lulus,
            'pekerjaan'   => $request->pekerjaan,
            'quote'       => $request->quote,
            'foto'        => $pathFoto,
        ]);

        $alumni->save();

        return redirect()->route('manage-alumni.index')
            ->with('success', 'Data alumni berhasil disimpan.');
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
