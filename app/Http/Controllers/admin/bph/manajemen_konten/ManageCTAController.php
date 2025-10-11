<?php

namespace App\Http\Controllers\admin\bph\manajemen_konten;

use Illuminate\Http\Request;

use App\Exports\ManageCTAExport;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\admin\bph\manajemen_konten\ManageCTA;

class ManageCTAController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title   = 'Data Pendaftar CTA';
        $search  = $request->input('search', '');
        $filterProdi = $request->query('filterProdi', 'all');
        $perPage = $request->query('perPage', 10);

        // pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageCTA::query();

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
            return view('admin.bph.cta.partials.table_body', compact('ctas'))->render();
        }

        return view('admin.bph.cta.index', compact('title', 'ctas', 'programStudis', 'filterProdi'));
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
            $path = $file->storeAs('foto_pendaftar', $namaFile, 'public');
            $validated['foto_pendaftar'] = $path;
        }

        ManageCTA::create($validated);

        return redirect()->route('manage-cta.index')->with('success', 'Data pendaftar berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(ManageCTA $manageCTA)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ManageCTA $manageCTA)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
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
            $path = $file->storeAs('foto_pendaftar', $namaFile, 'public');
            $validated['foto_pendaftar'] = $path;
        }

        $cta->update($validated);

        return redirect()->route('manage-cta.index')->with('success', 'Data pendaftar berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cta = ManageCTA::findOrFail($id);

        // hapus foto jika ada
        if ($cta->foto_pendaftar && Storage::disk('public')->exists($cta->foto_pendaftar)) {
            Storage::disk('public')->delete($cta->foto_pendaftar);
        }

        $cta->delete();

        return redirect()->route('manage-cta.index')->with('success', 'Data pendaftar berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $filterProdi = $request->query('filterProdi', 'all');
        $search = $request->query('search', '');

        return (new ManageCTAExport($filterProdi, $search))->export();
    }

}
