<?php

namespace App\Http\Controllers\admin\bph\tentang_ukmbsm;

use Illuminate\Http\Request;
use App\Models\admin\bph\tentang_ukmbsm\ManageStudioMusik;
use App\Models\admin\bph\tentang_ukmbsm\ManageStudioFacilities;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ManageStudioMusikController extends Controller
{

    // Studio and Studio Facilities Methods
    public function index(Request $request)
    {
        $title = "Studio Musik";
        $decription = '';
        $keywords = '';
        $author = 'UKMBSM ITERA';

        $studio = ManageStudioMusik::first(); // SINGLE ENTRY

        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageStudioFacilities::query()->where('manage_studio_musik_id', $studio?->id);

        if ($search){
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('nama', 'like', "%{$word}%")
                        ->orWhere('deskripsi', 'like', "%{$word}%");
                    });
                }
            });
        }

        // filter status kalau bukan all
        if ($filter !== 'all') {
            $query->where('is_active', $filter === 'active' ? 1 : 0);
        }

        // Paginate
        $facilities = $query->orderBy('urutan')->paginate($perPage);

        // Total fasilitas
        $total_facilities = [
            'all' => $facilities->total(),
        ];

        // AJAX response
        if ($request->ajax()) {
            return view(
                'admin.bph.tentang_ukmbsm.studio_musik.partials.table_body',
                compact('facilities', 'total_facilities')
            )->render();
        }

        return view('admin.bph.tentang_ukmbsm.studio_musik.index', compact('title', 'studio', 'facilities', 'total_facilities'));
    }

    //  Studio Profile
    public function store(Request $request)
    {
        // dd($request->all());
        // cegah double studio
        if (ManageStudioMusik::exists()) {
            return back()->with('error', 'Profil studio sudah ada.');
        }

        $data = $request->validate([
            'nama_studio'     => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',

            'weekday_open'    => 'required',
            'weekday_close'   => 'required',
            'weekend_open'    => 'required',
            'weekend_close'   => 'required',

            'ruang'           => 'nullable|string|max:100',
            'lantai'          => 'nullable|string|max:50',
            'gedung'          => 'nullable|string|max:100',
            'lokasi'          => 'nullable|string|max:255',
        ]);

        ManageStudioMusik::create($data);

        return back()->with('success', 'Profil studio berhasil disimpan.');
    }

    public function update(Request $request, $id)
    {
        // dd($request->all()); 
        $studio = ManageStudioMusik::findOrFail($id);

        $data = $request->validate([
            'nama_studio'     => 'required|string|max:255',
            'deskripsi'       => 'nullable|string',

            'weekday_open'    => 'required',
            'weekday_close'   => 'required',
            'weekend_open'    => 'required',
            'weekend_close'   => 'required',

            'ruang'           => 'nullable|string|max:100',
            'lantai'          => 'nullable|string|max:50',
            'gedung'          => 'nullable|string|max:100',
            'lokasi'          => 'nullable|string|max:255',
        ]);

        $studio->update($data);

        return back()->with('success', 'Profil studio berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $studio = ManageStudioMusik::findOrFail($id);

        foreach ($studio->facilities as $item) {
            if ($item->image) {
                Storage::disk('public')->delete($item->image);
            }
        }

        $studio->facilities()->delete();
        $studio->delete();

        return back()->with('success', 'Studio berhasil dihapus.');
    }

    // Facilities Methods
    public function storeFacility(Request $request)
    {
        // dd($request->all());

        $data = $request->validate([
            'manage_studio_musik_id' => 'required|exists:manage_studio_musiks,id',
            'nama'        => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'urutan'      => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|in:0,1'
        ]);

        // === HANDLE IMAGE ===
        if ($request->hasFile('image')) {
            $file = $request->file('image');

            // slug nama fasilitas
            $namaSlug = Str::slug($data['nama']);

            // urutan (fallback kalau null)
            $urutan = $data['urutan'] ?? '0';

            // extension asli
            $ext = $file->getClientOriginalExtension();

            // nama file final
            $fileName = "{$namaSlug}-{$urutan}.{$ext}";

            // simpan
            $data['image'] = $file->storeAs(
                'studio-facilities',
                $fileName,
                'public'
            );
        }

        $data['is_active'] = (bool) $request->input('is_active', 1);

        ManageStudioFacilities::create($data);

        return back()->with('success', 'Fasilitas berhasil ditambahkan.');
    }

    public function updateFacility(Request $request, $id)
    {
        // dd($request->all());

        $facility = ManageStudioFacilities::findOrFail($id);

        $data = $request->validate([
            'nama'        => 'required|string|max:150',
            'deskripsi'   => 'nullable|string',
            'urutan'      => 'nullable|integer',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'is_active' => 'required|in:0,1'
        ]);

        // === HANDLE IMAGE UPDATE ===
        if ($request->hasFile('image')) {

            // hapus image lama kalau ada
            if ($facility->image && Storage::disk('public')->exists($facility->image)) {
                Storage::disk('public')->delete($facility->image);
            }

            $file = $request->file('image');

            // slug nama
            $namaSlug = Str::slug($data['nama']);

            // urutan fallback
            $urutan = $data['urutan'] ?? '0';

            // extension
            $ext = $file->getClientOriginalExtension();

            // nama file konsisten dengan create
            $fileName = "{$namaSlug}-{$urutan}.{$ext}";

            // simpan file
            $data['image'] = $file->storeAs(
                'studio-facilities',
                $fileName,
                'public'
            );
        }

        $data['is_active'] = (bool) $request->input('is_active', 1);

        $facility->update($data);

        return back()->with('success', 'Fasilitas berhasil diperbarui.');
    }

    public function destroyFacility($id)
    {
        $facility = ManageStudioFacilities::findOrFail($id);

        if ($facility->image) {
            Storage::disk('public')->delete($facility->image);
        }

        $facility->delete();

        return back()->with('success', 'Fasilitas berhasil dihapus.');
    }
}