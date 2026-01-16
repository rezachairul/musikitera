<?php

namespace App\Http\Controllers\admin\bph\manajemen_anggota;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Models\admin\bph\manajemen_anggota\ManageKabinet;

class ManageKabinetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title       = 'Kabinet Kepengurusan';
        $decription  = '';
        $keywords    = '';
        $author      = 'UKMBSM ITERA';

        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all'); // all | active | archived
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search)
            ? preg_split('/\s+/', (string) $search)
            : [];

        $query = ManageKabinet::query();

        // Search
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama_kabinet', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%")
                        ->orWhere('periode_awal', 'like', "%{$word}%")
                        ->orWhere('periode_akhir', 'like', "%{$word}%");
                    });
                }
            });
        }

        // Filter status kabinet
        if ($filter === 'active') {
            $query->where('is_active', true);
        } elseif ($filter === 'archived') {
            $query->where('is_active', false);
        }

        // Urutan:
        // 1. Kabinet aktif paling atas
        // 2. Periode terbaru
        $query->orderByDesc('is_active')
            ->orderByDesc('periode_awal');

        // Pagination
        $kabinets = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // Total kabinet (buat badge/filter UI)
        $totals = [
            'active'   => ManageKabinet::where('is_active', true)->count(),
            'archived' => ManageKabinet::where('is_active', false)->count(),
        ];
        $totals['all'] = $totals['active'] + $totals['archived'];

        // Label & badge style
        $statusLabels = [
            'active' => [
                'label' => 'Aktif',
                'color' => 'bg-green-100 text-green-700 border border-green-300',
            ],
            'archived' => [
                'label' => 'Arsip',
                'color' => 'bg-gray-100 text-gray-700 border border-gray-300',
            ],
        ];

        // ⚡ AJAX response
        if ($request->ajax()) {
            return view('admin.bph.manajemen_anggota.kabinet.partials.table_body',compact('kabinets', 'statusLabels'))->render();
        }

        return view(
            'admin.bph.manajemen_anggota.kabinet.index', compact( 'title', 'decription', 'keywords', 'author', 'kabinets', 'statusLabels', 'totals', 'filter' )
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $validated = $request->validate([
            'nama_kabinet'   => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'periode_awal'   => 'required|integer|min:2000',
            'periode_akhir'  => 'required|integer|gte:periode_awal',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'banner'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
            'is_active'      => 'nullable|boolean',
        ]);

        // Kalau kabinet ini mau aktif, nonaktifkan yang lain
        if (!empty($validated['is_active']) && $validated['is_active']) {
            ManageKabinet::where('is_active', true)->update(['is_active' => false]);
        }

        // bikin slug nama kabinet (biar aman buat nama file)
        $namaKabinetSlug = Str::slug($validated['nama_kabinet']);

        // ===== Upload logo =====
        if ($request->hasFile('logo')) {
            $ext = $request->file('logo')->getClientOriginalExtension();
            $fileName = 'logo_kabinet_' . $namaKabinetSlug . '.' . $ext;

            $validated['logo'] = $request->file('logo')
                ->storeAs('kabinet/logo', $fileName, 'public');
        }

        // ===== Upload banner =====
        if ($request->hasFile('banner')) {
            $ext = $request->file('banner')->getClientOriginalExtension();
            $fileName = 'banner_kabinet_' . $namaKabinetSlug . '.' . $ext;

            $validated['banner'] = $request->file('banner')
                ->storeAs('kabinet/banner', $fileName, 'public');
        }

        ManageKabinet::create($validated);

        return back()->with('success', 'Kabinet berhasil ditambahkan.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());

        $manageKabinet = ManageKabinet::findOrFail($id);

        $validated = $request->validate([
            'nama_kabinet'   => 'required|string|max:255',
            'deskripsi'      => 'nullable|string',
            'periode_awal'   => 'required|integer|min:2000',
            'periode_akhir'  => 'required|integer|gte:periode_awal',
            'logo'           => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'banner'         => 'nullable|image|mimes:png,jpg,jpeg,webp|max:4096',
            'is_active'      => 'nullable|boolean',
        ]);

        // Kalau kabinet ini di-set aktif,
        // nonaktifkan kabinet lain (kecuali dirinya sendiri)
        if (!empty($validated['is_active']) && $validated['is_active']) {
            ManageKabinet::where('id', '!=', $manageKabinet->id)
                ->where('is_active', true)
                ->update(['is_active' => false]);
        }

        // slug nama kabinet
        $namaKabinetSlug = Str::slug($validated['nama_kabinet']);

        // ==== Update Logo =====
        if ($request->hasFile('logo')) {

            // hapus logo lama kalau ada
            if ($manageKabinet->logo && Storage::disk('public')->exists($manageKabinet->logo)) {
                Storage::disk('public')->delete($manageKabinet->logo);
            }

            $ext = $request->file('logo')->getClientOriginalExtension();
            $fileName = 'logo_kabinet_' . $namaKabinetSlug . '.' . $ext;

            $validated['logo'] = $request->file('logo')
                ->storeAs('kabinet/logo', $fileName, 'public');
        }

        // ===== Update Banner =====
        if ($request->hasFile('banner')) {

            // hapus banner lama kalau ada
            if ($manageKabinet->banner && Storage::disk('public')->exists($manageKabinet->banner)) {
                Storage::disk('public')->delete($manageKabinet->banner);
            }

            $ext = $request->file('banner')->getClientOriginalExtension();
            $fileName = 'banner_kabinet_' . $namaKabinetSlug . '.' . $ext;

            $validated['banner'] = $request->file('banner')
                ->storeAs('kabinet/banner', $fileName, 'public');
        }

        // update data
        $manageKabinet->update($validated);

        return back()->with('success', 'Kabinet berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        dd($id);
        $manageKabinet = ManageKabinet::findOrFail($id);

        if ($manageKabinet->is_active) {
            return back()->with('error', 'Kabinet aktif tidak boleh dihapus.');
        }

        $manageKabinet->delete();

        return back()->with('success', 'Kabinet berhasil dihapus.');
    }
}
