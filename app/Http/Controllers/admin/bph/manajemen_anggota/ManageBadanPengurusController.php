<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use App\Models\admin\bph\manajemen_anggota\ManageBadanPengurus;
use App\Models\admin\bph\manajemen_anggota\ManageKabinet;
use App\Models\admin\bph\manajemen_anggota\AnggotaAktif;
use App\Models\admin\administrator\AdminManageBPH;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;

class ManageBadanPengurusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = "Badan Pengurus";
        $decription = '';
        $keywordsMeta = '';
        $author = 'UKMBSM ITERA';

        $search   = $request->input('search', '');
        $filter   = $request->query('filter', 'all'); // all | aktif | demisioner
        $perPage  = $request->query('perPage', 10);
        $kabinetId = $request->query('kabinet'); // filter kabinet

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        // ================= QUERY UTAMA =================

        $query = ManageBadanPengurus::with(['kabinet', 'anggota', 'jabatan']);

        // Filter kabinet (WAJIB kalau sudah dipilih)
        if ($kabinetId) {
            $query->where('manage_kabinet_id', $kabinetId);
        }

        // Search: nama anggota / jabatan / kabinet
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->whereHas('anggota', function ($qa) use ($word) {
                            $qa->where('nama', 'like', "%{$word}%")
                            ->orWhere('nim', 'like', "%{$word}%")
                            ->orWhere('nia', 'like', "%{$word}%");
                        })
                        ->orWhereHas('jabatan', function ($qj) use ($word) {
                            $qj->where('nama', 'like', "%{$word}%")
                            ->orWhere('jenis', 'like', "%{$word}%");
                        })
                        ->orWhereHas('kabinet', function ($qk) use ($word) {
                            $qk->where('nama_kabinet', 'like', "%{$word}%")
                            ->orWhere('periode_awal', 'like', "%{$word}%")
                            ->orWhere('periode_akhir', 'like', "%{$word}%");
                        });
                    });
                }
            });
        }

        // Filter status
        if ($filter !== 'all') {
            $query->where('status', $filter);
        }

        // Urutan: kabinet terbaru → level jabatan → urutan jabatan
        $query->join('manage_kabinets as k', 'manage_badan_penguruses.manage_kabinet_id', '=', 'k.id')
            ->join('admin_manage_b_p_h_s as j', 'manage_badan_penguruses.jabatan_id', '=', 'j.id')

        // Urutan: kabinet terbaru → level jabatan → urutan jabatan
            ->orderByDesc('k.periode_awal')
            ->orderBy('j.level', 'asc')
            ->orderBy('j.urutan', 'asc')

        // Ambil hanya kolom utama biar model tetap ManageBadanPengurus
            ->select('manage_badan_penguruses.*');

        // Paginate
        $badan_penguruses = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // ================= DATA PENDUKUNG =================

        // Semua kabinet (buat dropdown filter)
        $kabinets = ManageKabinet::orderByDesc('periode_awal')->get();

        // Hitung total berdasarkan status (opsional, buat badge counter)
        $statuss = ['aktif', 'demisioner'];
        $totals = [];
        foreach ($statuss as $status) {
            $totals[$status] = ManageBadanPengurus::when($kabinetId, function ($q) use ($kabinetId) {
                    $q->where('manage_kabinet_id', $kabinetId);
                })
                ->where('status', $status)
                ->count();
        }
        $totals['all'] = array_sum($totals);

        // Label & warna status
        $statusLabels = [
            'aktif' => [
                'label' => 'Aktif',
                'color' => 'bg-green-100 text-green-700 border border-green-300',
            ],
            'demisioner' => [
                'label' => 'Demisioner',
                'color' => 'bg-gray-100 text-gray-700 border border-gray-300',
            ],
        ];

        $anggotas = AnggotaAktif::where('status', 'on_going')
            ->orderBy('nama')
            ->get();

        $jabatans = AdminManageBPH::orderBy('level')->orderBy('urutan')->get();


        // ================= CARD DATA =================
        // Total kabinet
        $totalKabinet = ManageKabinet::count();
        // Kabinet aktif (saat ini)
        $kabinetAktif = ManageKabinet::where('is_active', 1)->first();

        // ================= AJAX =================
        if ($request->ajax()) {
            return view(
                'admin.bph.manajemen_anggota.badan_pengurus.partials.table_body',
                compact('title','badan_penguruses','statusLabels','totals','filter','kabinets','kabinetId','totalKabinet','kabinetAktif','anggotas','jabatans')
            )->render();
        }

        // ================= VIEW =================
        return view('admin.bph.manajemen_anggota.badan_pengurus.index',compact('title','badan_penguruses','statusLabels','totals','filter','kabinets','kabinetId','totalKabinet','kabinetAktif','anggotas','jabatans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'manage_kabinet_id' => 'required|exists:manage_kabinets,id',
            'anggota_aktif_id'  => 'required|exists:anggota_aktifs,id',
            'jabatan_id'        => 'required|exists:admin_manage_b_p_h_s,id',
            'mulai_menjabat'    => 'nullable|date',
            'selesai_menjabat'  => 'nullable|date|after_or_equal:mulai_menjabat',
        ]);

        $kabinet = ManageKabinet::findOrFail($request->manage_kabinet_id);

        // status otomatis dari kabinet
        $status = $kabinet->is_active ? 'aktif' : 'demisioner';

        // validasi tambahan berbasis kondisi
        if ($request->status === 'demisioner' && !$request->selesai_menjabat) {
            return back()->withErrors(['selesai_menjabat' => 'Tanggal selesai wajib diisi jika status demisioner.'])->withInput();
        }

        if ($kabinet->is_active) {
            $request->merge(['selesai_menjabat' => null]);
        }

        // anti dobel persis
        $exists = ManageBadanPengurus::where('manage_kabinet_id', $request->manage_kabinet_id)
            ->where('anggota_aktif_id', $request->anggota_aktif_id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'anggota_aktif_id' => 'Anggota ini sudah terdaftar pada jabatan tersebut di kabinet ini.'
            ])->withInput();
        }

        ManageBadanPengurus::create([
            'manage_kabinet_id' => $request->manage_kabinet_id,
            'anggota_aktif_id'  => $request->anggota_aktif_id,
            'jabatan_id'        => $request->jabatan_id,
            'status'            => $status,
            'mulai_menjabat'    => $request->mulai_menjabat ?? now(),
        ]);

        return redirect()->back()->with('success', 'Anggota berhasil ditambahkan ke badan pengurus.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $manageBadanPengurus = ManageBadanPengurus::findOrFail($id);

        $request->validate([
            'manage_kabinet_id' => 'required|exists:manage_kabinets,id',
            'anggota_aktif_id'  => 'required|exists:anggota_aktifs,id',
            'jabatan_id'        => 'required|exists:admin_manage_b_p_h_s,id',
            'mulai_menjabat'    => 'nullable|date',
            'selesai_menjabat'  => 'nullable|date|after_or_equal:mulai_menjabat',
        ]);

        $kabinet = ManageKabinet::findOrFail($request->manage_kabinet_id);

        // status otomatis dari kabinet
        $status = $kabinet->is_active ? 'aktif' : 'demisioner';

        // validasi kondisional
        if (!$kabinet->is_active && !$request->selesai_menjabat) {
            return back()->withErrors([
                'selesai_menjabat' => 'Tanggal selesai wajib diisi jika kabinet sudah demisioner.'
            ])->withInput();
        }

        if ($kabinet->is_active) {
            $request->merge(['selesai_menjabat' => null]);
        }

        // anti dobel (kecuali dirinya sendiri)
        $exists = ManageBadanPengurus::where('manage_kabinet_id', $request->manage_kabinet_id)
            ->where('anggota_aktif_id', $request->anggota_aktif_id)
            ->where('id', '!=', $manageBadanPengurus->id)
            ->exists();

        if ($exists) {
            return back()->withErrors([
                'anggota_aktif_id' => 'Data kepengurusan ini sudah ada.'
            ])->withInput();
        }

        $manageBadanPengurus->update([
            'manage_kabinet_id' => $request->manage_kabinet_id,
            'anggota_aktif_id'  => $request->anggota_aktif_id,
            'jabatan_id'        => $request->jabatan_id,
            'status'            => $status,
            'mulai_menjabat'    => $request->mulai_menjabat,
            'selesai_menjabat'  => $request->selesai_menjabat,
        ]);

        return redirect()->back()->with('success', 'Data badan pengurus berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);

        $manageBadanPengurus = ManageBadanPengurus::findOrFail($id);
        $manageBadanPengurus->delete();

        return redirect()->back()->with('success', 'Data badan pengurus berhasil dihapus.');
    }
}