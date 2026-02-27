<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Exports\ManageCTAExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\admin\bph\manajemen_konten\ManageCTA;
use App\Models\admin\bph\manajemen_konten\OprecSetting;

class ManageCTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = 'Data Pendaftar';
        $description = '';
        $author      = 'UKMBSM ITERA';

        // Ambil Oprec Setting (Single Entry)
        $settings = OprecSetting::firstOrCreate([], [
            'title' => 'Oprec UKMBSM',
            'is_active' => false,
            'start_at' => null,
            'end_at' => null,
            'wa_group_link' => null,
        ]);

        $search  = $request->input('search', '');
        $filterProdi = $request->query('filterProdi', 'all');
        $perPage = $request->query('perPage', 10);

        // pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageCTA::query();
        $totalAll = ManageCTA::count();
        $totalFiltered = $query->count();

        // Search (multi kolom)
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_lengkap', 'like', "%{$word}%")
                            ->orWhere('nim', 'like', "%{$word}%")
                            ->orWhere('program_studi', 'like', "%{$word}%")
                            ->orWhere('minat', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter berdasarkan program studi
        if ($filterProdi !== 'all') {
            $query->where('program_studi', $filterProdi);
        }

        // Urutkan berdasarkan waktu terbaru
        $query->orderBy('created_at', 'desc');

        // Pagination
        $ctas = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Ambil list program studi unik untuk dropdown filter
        $programStudis = ManageCTA::select('program_studi')->distinct()->pluck('program_studi');

        // AJAX response (untuk dynamic filter / search)
        if ($request->ajax()) {
            return view('admin.bph.manajemen_konten.cta.partials.table_body', compact('title', 'ctas', 'programStudis', 'filterProdi', 'search', 'perPage', 'totalAll', 'totalFiltered'))->render();
        }

        return view('admin.bph.manajemen_konten.cta.index', compact('title', 'ctas', 'programStudis', 'filterProdi', 'search', 'perPage', 'totalAll', 'totalFiltered', 'settings'));
    }

    // Admin

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'foto_pendaftar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_lengkap'   => 'required|string|max:255',
            'nim'            => 'required|string|max:20|unique:manage_c_t_a_s,nim',
            'angkatan'       => 'required|integer|min:2000|max:' . date('Y'),
            'program_studi'  => 'required|string|max:255',
            'alamat_asli'    => 'required|string',
            'alamat_domisili'=> 'nullable|string',
            'nomor_telepon'  => 'required|string|max:20',
            'instagram'      => 'nullable|string|max:100',
            'alasan_gabung'  => 'required|string',
            'minat'          => 'required|string|max:100',
        ]);

        // upload foto dengan nama "Foto_NamaLengkap_NIM_timestamp.ext"
        if ($request->hasFile('foto_pendaftar')) {
            $file = $request->file('foto_pendaftar');
            $namaBersih = str_replace([' ', '/', '\\'], '_', $validated['nama_lengkap']);
            $namaFile = 'Foto_' . $namaBersih . '_' . $validated['nim'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cta', $namaFile, 'public');
            $validated['foto_pendaftar'] = $path;
        }

        ManageCTA::create($validated);

        // Set flag agar bisa akses halaman thanks
        session(['allow_thanks' => true]);

        return redirect()->route('cta.thanks')->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $cta = ManageCTA::findOrFail($id);

        $validated = $request->validate([
            'foto_pendaftar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_lengkap'   => 'required|string|max:255',
            'nim'            => 'required|string|max:20|unique:manage_c_t_a_s,nim,' . $cta->id,
            'angkatan'       => 'required|integer|min:2000|max:' . date('Y'),
            'program_studi'  => 'required|string|max:255',
            'alamat_asli'    => 'required|string',
            'alamat_domisili'=> 'nullable|string',
            'nomor_telepon'  => 'required|string|max:20',
            'instagram'      => 'nullable|string|max:100',
            'alasan_gabung'  => 'required|string',
            'minat'          => 'required|string|max:100',
        ]);

        // kalau upload foto baru
        if ($request->hasFile('foto_pendaftar')) {
            if ($cta->foto_pendaftar && Storage::disk('public')->exists($cta->foto_pendaftar)) {
                Storage::disk('public')->delete($cta->foto_pendaftar);
            }

            $file = $request->file('foto_pendaftar');
            $namaBersih = str_replace([' ', '/', '\\'], '_', $validated['nama_lengkap']);
            $namaFile = 'Foto_' . $namaBersih . '_' . $validated['nim'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cta', $namaFile, 'public');
            $validated['foto_pendaftar'] = $path;
        }

        $cta->update($validated);

        return redirect()->back()->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // dd($id);
        $cta = ManageCTA::findOrFail($id);

        // hapus foto jika ada
        if ($cta->foto_pendaftar && Storage::disk('public')->exists($cta->foto_pendaftar)) {
            Storage::disk('public')->delete($cta->foto_pendaftar);
        }

        $cta->delete();

        return redirect()->back()->with('success', 'Data pendaftar berhasil dihapus.');
    }

    /**
     * Export data to Excel.
     */

    public function export(Request $request)
    {
        $filterProdi = $request->query('filterProdi', 'all');
        $search = $request->query('search', '');

        return (new ManageCTAExport($filterProdi, $search))->export();
    }

    
    /**
        * Form Oprec Public
    */
    public function form()
    {
        $title = 'Form Pendaftaran Open Recruitment';

        // Ambil setting oprec
        $oprec = OprecSetting::first();

        $status = null;

        if ($oprec && (int)$oprec->is_active === 1) {
            $now = now();

            if ($oprec->start_at && $now->lt($oprec->start_at)) {
                $status = 'coming_soon';
            } elseif (
                (!$oprec->start_at || $now->gte($oprec->start_at)) &&
                (!$oprec->end_at || $now->lte($oprec->end_at))
            ) {
                $status = 'open';
            } else {
                $status = 'closed';
            }
        }

        // 🔥 KUNCI UTAMA
        if ($status !== 'open') {
            abort(404);
        }

        $settings = OprecSetting::firstOrCreate([], [
            'title' => 'Oprec UKMBSM',
        ]);

        return view('admin.bph.manajemen_konten.cta.form', compact('title', 'oprec', 'status', 'settings'));
    }

    // Submit Public
    public function submit(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'foto_pendaftar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'nama_lengkap'   => 'required|string|max:255',
            'nim'            => 'required|string|max:20|unique:manage_c_t_a_s,nim',
            'angkatan'       => 'required|integer|min:2000|max:' . date('Y'),
            'program_studi'  => 'required|string|max:255',
            'alamat_asli'    => 'required|string',
            'alamat_domisili'=> 'nullable|string',
            'nomor_telepon'  => 'required|string|max:20',
            'instagram'      => 'nullable|string|max:100',
            'alasan_gabung'  => 'required|string',
            'minat'          => 'required|string|max:100',
        ]);

        // upload foto dengan nama "Foto_NamaLengkap_NIM_timestamp.ext"
        if ($request->hasFile('foto_pendaftar')) {
            $file = $request->file('foto_pendaftar');
            $namaBersih = str_replace([' ', '/', '\\'], '_', $validated['nama_lengkap']);
            $namaFile = 'Foto_' . $namaBersih . '_' . $validated['nim'] . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('cta', $namaFile, 'public');
            $validated['foto_pendaftar'] = $path;
        }

        ManageCTA::create($validated);

        // Set flag agar bisa akses halaman thanks
        session(['allow_thanks' => true]);

        return redirect()->route('cta.thanks')->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    /**
        * Thanks Oprec Public
    */
    public function thanks()
    {
        $user = Auth::user(); // null kalau belum login

        // Jika tidak login → wajib punya session flag
        if (!$user && !session('allow_thanks')) {
            return redirect()->route('cta.form');
        }

        // Kalau login dan role termasuk bph, dpo, pembina, administrator → boleh langsung
        if ($user && in_array($user->role, ['bph', 'dpo', 'pembina', 'administrator'])) {
            // biarkan lanjut
        } else {
            // Kalau user publik → hapus session biar tidak bisa akses ulang
            session()->forget('allow_thanks');
        }

        $title = 'Terima Kasih Calon Anggota UKMBSM ITERA';

        $settings = OprecSetting::first();

        return view('admin.bph.manajemen_konten.cta.thanks', compact('title', 'settings'));
    }

    // public function setting Oprec CTA
    public function storeSetting(Request $request)
    {
        dd($request->all());
        $data = $request->validate([
            'title'        => 'nullable|string|max:255',
            'is_active'    => 'required|boolean',
            'start_at'     => 'nullable|date',
            'end_at'       => 'nullable|date|after_or_equal:start_at',
            'wa_group_link' => 'nullable|url',
        ]);

        $data['is_active'] = (bool) $request->input('is_active', 1);

        OprecSetting::create($data);

        return redirect()->back()->with('success', 'Pengaturan Oprec berhasil ditambahkan.');
    }

    public function updateSetting(Request $request, $id)
    {
        // dd($request->all());

        $setting = OprecSetting::findOrFail($id);

        $data = $request->validate([
            'title'         => 'nullable|string|max:255',
            'is_active'     => 'required|boolean',
            'start_at'      => 'nullable|date',
            'end_at'        => 'nullable|date|after_or_equal:start_at',
            'wa_group_link' => 'nullable|url',
        ]);

        $data['is_active'] = (bool) $request->input('is_active', 1);

        $setting->update($data);

        return redirect()->back()->with('success', 'Pengaturan Oprec berhasil diperbarui.');
    }

}
