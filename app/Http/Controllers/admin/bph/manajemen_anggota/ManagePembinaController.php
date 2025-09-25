<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use Illuminate\Http\Request;
use App\Exports\ManagePembinaExport;
use App\Http\Controllers\Controller;
use App\Models\admin\bph\ManagePembina;
use Illuminate\Support\Facades\Storage;

class ManagePembinaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title    = 'Pembina';
        $search   = $request->input('search', '');
        $filter   = $request->query('filter', 'all');
        $perPage  = $request->query('perPage', 10); // ✅ perbaikan

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManagePembina::query();

        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama', 'like', "%{$word}%")
                            ->orWhere('nip_nidn', 'like', "%{$word}%") // ✅ fix typo
                            ->orWhere('jabatan', 'like', "%{$word}%")
                            ->orWhere('awal_periode', 'like', "%{$word}%")
                            ->orWhere('akhir_periode', 'like', "%{$word}%")
                            ->orWhere('program_studi', 'like', "%{$word}%");
                    });
                }
            });
        }

        $query->orderBy('awal_periode', 'asc');

        // Paginate
        $manage_pembinas = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Hitung total pembina
        $totalPembina = $query->count();
        // AJAX response
        if ($request->ajax()) {
            return view(
                'admin.bph.manajemen_anggota.pembina.partials.table_body',
                compact('title', 'manage_pembinas', 'totalPembina')
            )->render();
        }

        // Return ke halaman index
        return view('admin.bph.manajemen_anggota.pembina.index', compact('title', 'manage_pembinas', 'totalPembina'));
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
        // dd($request->all(), $request->file('foto'));

        $validated = $request->validate([
            'nama'         => 'required|string|max:255',
            'nip_nidn'     => 'required|string|max:50|unique:manage_pembinas,nip_nidn',
            'jabatan'      => 'required|string|max:100',
            'awal_periode'  => 'nullable|date',
            'akhir_periode' => 'nullable|date|after_or_equal:awal_periode',
            'program_studi'=> 'nullable|string|max:100',
            'kontak'       => 'nullable|string|max:100',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Simpan foto jika ada
        if ($request->hasFile('foto')) {
            $ext = $request->file('foto')->getClientOriginalExtension();
            $filename = \Illuminate\Support\Str::slug($request->nama) . '.' . $ext;

            $path = $request->file('foto')->storeAs('pembina', $filename, 'public');
            $validated['foto'] = $path;
        }

        ManagePembina::create($validated);

        return redirect()->back()->with('success', 'Data pembina berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all(), $request->file('foto'));
        $pembina = ManagePembina::findOrFail($id);

        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'nip_nidn'      => 'required|string|max:50|unique:manage_pembinas,nip_nidn,' . $pembina->id,
            'jabatan'       => 'required|string|max:100',
            'awal_periode'  => 'nullable|date',
            'akhir_periode' => 'nullable|date|after_or_equal:awal_periode',
            'program_studi' => 'nullable|string|max:100',
            'kontak'        => 'nullable|string|max:100',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Kalau ada foto baru, hapus lama dan simpan baru
        if ($request->hasFile('foto')) {
            // hapus foto lama (jika ada)
            if ($pembina->foto && Storage::disk('public')->exists($pembina->foto)) {
                Storage::disk('public')->delete($pembina->foto);
            }

            $ext = $request->file('foto')->getClientOriginalExtension();
            $filename = \Illuminate\Support\Str::slug($request->nama) . '.' . $ext;

            $path = $request->file('foto')->storeAs('pembina', $filename, 'public');
            $validated['foto'] = $path;
        }

        $pembina->update($validated);

        return redirect()->back()->with('success', 'Data pembina berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $pembina = ManagePembina::findOrFail($id);

        // Hapus foto kalau ada
        if ($pembina->foto && Storage::exists($pembina->foto)) {
            Storage::delete($pembina->foto);
        }

        // Hapus data pembina
        $pembina->delete();

        return redirect()->back()->with('success', 'Data pembina beserta foto berhasil dihapus.');
    }

     public function export(Request $request)
    {
        $search = $request->query('search'); // kalau mau dipakai buat filter nama/email

        return (new ManagePembinaExport( $search))->export();
    }
}
