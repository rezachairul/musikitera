<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use Illuminate\Support\Str;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Http\Controllers\Controller;
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
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // Validasi
        $validated = $request->validate([
            'anggota_id'   => 'required|exists:anggota_aktifs,id|unique:manage_alumnis,anggota_id',
            'tahun_lulus'  => 'required|digits:4|integer',
            'pekerjaan'    => 'nullable|string|max:255',
            'url'          => 'nullable|url|max:255',
            'quote'        => 'nullable|string',
            'foto'         => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
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
            'url'         => $request->url,
            'quote'       => $request->quote,
            'foto'        => $pathFoto,
        ]);

        $alumni->save();

        return back()->with('success', 'Data alumni berhasil disimpan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Ambil data alumni
        $alumni = ManageAlumni::findOrFail($id);

        // Validasi
        $validated = $request->validate([
            'anggota_id'  => [
                'required',
                'exists:anggota_aktifs,id',
                Rule::unique('manage_alumnis', 'anggota_id')->ignore($alumni->id),
            ],
            'tahun_lulus' => 'required|digits:4|integer',
            'pekerjaan'   => 'nullable|string|max:255',
            'url'         => 'nullable|url|max:255',
            'quote'       => 'nullable|string',
            'foto'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $pathFoto = $alumni->foto; // default pakai foto lama

        // Jika upload foto baru
        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if ($alumni->foto && Storage::disk('public')->exists($alumni->foto)) {
                Storage::disk('public')->delete($alumni->foto);
            }

            $file = $request->file('foto');
            $anggota = AnggotaAktif::find($request->anggota_id);
            $anggotaName = Str::slug($anggota->nama ?? 'alumni');
            $fileName = 'Alumni_' . $anggotaName . '_' . Carbon::now()->format('Ymd_His') . '.' . $file->getClientOriginalExtension();

            $pathFoto = $file->storeAs('alumni', $fileName, 'public');
        }

        // Update database
        $alumni->update([
            'anggota_id'  => $request->anggota_id,
            'tahun_lulus' => $request->tahun_lulus,
            'pekerjaan'   => $request->pekerjaan,
            'url'         => $request->url,
            'quote'       => $request->quote,
            'foto'        => $pathFoto,
        ]);

        return back()->with('success', 'Data alumni berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $alumni = ManageAlumni::findOrFail($id);

        // Hapus foto jika ada
        if ($alumni->foto && Storage::disk('public')->exists($alumni->foto)) {
            Storage::disk('public')->delete($alumni->foto);
        }

        $alumni->delete();
        return back()->with('success', 'Data alumni berhasil dihapus.');
    }
    
}
