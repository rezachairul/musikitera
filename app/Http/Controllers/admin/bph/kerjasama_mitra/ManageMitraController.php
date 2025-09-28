<?php

namespace App\Http\Controllers\admin\bph\kerjasama_mitra;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Exports\ManageMitraExport;
use App\Http\Controllers\Controller;
use App\Models\admin\bph\kerjasama_mitra\ManageMitra;
use Illuminate\Support\Facades\Storage;

class ManageMitraController extends Controller
{
    /**
     * Tampilkan semua mitra (internal/eksternal)
     */
    public function index(Request $request)
    {
        $title   = 'Mitra';
        $search  = $request->input('search', '');
        $filter  = $request->query('filter', 'all');
        $perPage = $request->query('perPage', 10);

        // Pisahkan multi keyword search
        $keywords = !empty($search) ? preg_split('/\s+/', (string) $search) : [];

        $query = ManageMitra::query();

        // 🔍 Search
        if ($search) {
            $query->where(function ($q) use ($keywords) {
                foreach ($keywords as $word) {
                    $q->where(function ($q) use ($word) {
                        $q->where('name', 'like', "%{$word}%")
                        ->orWhere('type', 'like', "%{$word}%")
                        ->orWhere('sub_type', 'like', "%{$word}%");
                    });
                }
            });
        }

        // 🔍 Filter type
        $typeFilters    = ['internal', 'eksternal'];
        $subTypeFilters = ['institusi', 'ormawa_hmps', 'ormawa_ukm', 'ukmbs', 'komunitas'];

        if ($filter !== 'all') {
            if (in_array($filter, $typeFilters)) {
                $query->where('type', $filter);
            } elseif (in_array($filter, $subTypeFilters)) {
                $query->where('sub_type', $filter);
            }
        }

        // 📊 Hitung total mitra
        $totalMitras    = ManageMitra::count();
        $internalMitras = ManageMitra::where('type', 'internal')->count();
        $eksternalMitras= ManageMitra::where('type', 'eksternal')->count();

        // 📌 Urutan khusus
        $orderSubType = [
            'institusi'   => 1,
            'ormawa_hmps' => 2,
            'ormawa_ukm'  => 3,
            'ukmbs'       => 4,
            'komunitas'   => 5,
        ];

        $query->orderByRaw("
            CASE 
                WHEN type = 'internal' THEN 1
                WHEN type = 'eksternal' THEN 2
                ELSE 3
            END
        ")->orderByRaw("
            CASE sub_type
                WHEN 'institusi' THEN 1
                WHEN 'ormawa_hmps' THEN 2
                WHEN 'ormawa_ukm' THEN 3
                WHEN 'ukmbs' THEN 4
                WHEN 'komunitas' THEN 5
                ELSE 6
            END
        ")->orderBy('name', 'asc');

        // 📌 Pagination
        $mitras = $query->paginate(
            $perPage === 'all' ? $query->count() : (int) $perPage
        );

        // 📌 Mapping tambahan
        $mitras->getCollection()->transform(function ($mitra) {
            // ✅ Mapping Type
            $typeMap = [
                'internal'  => ['label' => 'Internal', 'badge' => 'bg-blue-100 text-blue-600'],
                'eksternal' => ['label' => 'Eksternal', 'badge' => 'bg-green-100 text-green-600'],
            ];

            $mitra->type_label = $typeMap[$mitra->type]['label'] ?? ucfirst($mitra->type);
            $mitra->type_badge = $typeMap[$mitra->type]['badge'] ?? 'bg-gray-100 text-gray-600';

            // ✅ Mapping Sub Type
            $subMap = [
                'institusi'     => ['label' => 'Institusi', 'badge' => 'bg-purple-100 text-purple-600'],
                'ormawa_hmps'   => ['label' => 'Ormawa HMPS', 'badge' => 'bg-pink-100 text-pink-600'],
                'ormawa_ukm'    => ['label' => 'Ormawa UKM', 'badge' => 'bg-yellow-100 text-yellow-600'],
                'komunitas'     => ['label' => 'Komunitas', 'badge' => 'bg-indigo-100 text-indigo-600'],
                'ukmbs'         => ['label' => 'UKMBS', 'badge' => 'bg-red-100 text-red-600'],
            ];

            $mitra->sub_label = $subMap[$mitra->sub_type]['label'] ?? ucfirst($mitra->sub_type);
            $mitra->sub_badge = $subMap[$mitra->sub_type]['badge'] ?? 'bg-gray-100 text-gray-600';

            // ✅ Mapping URL ke medsos
            $socials = [
                'instagram' => ['icon' => 'brand-instagram', 'color' => 'text-pink-500 hover:text-pink-600', 'name' => 'Instagram'],
                'youtube'   => ['icon' => 'brand-youtube', 'color' => 'text-red-500 hover:text-red-600', 'name' => 'YouTube'],
                'tiktok'    => ['icon' => 'brand-tiktok', 'color' => 'text-black hover:text-gray-700', 'name' => 'TikTok'],
                'whatsapp'  => ['icon' => 'brand-whatsapp', 'color' => 'text-green-500 hover:text-green-600', 'name' => 'WhatsApp'],
                'http'      => ['icon' => 'globe', 'color' => 'text-blue-500 hover:text-blue-600', 'name' => 'Website'],
            ];

            $mitra->social = collect($socials)->first(function ($data, $key) use ($mitra) {
                return str_contains($mitra->url, $key);
            }) ?? $socials['http'];

            return $mitra;
        });

        // AJAX response
        if ($request->ajax()) {
            return view( 'admin.bph.kerjasama_mitra.mitra.partials.table_body',
             compact('title', 'mitras', 'totalMitras', 'internalMitras', 'eksternalMitras') 
            )->render();
        }

        return view('admin.bph.kerjasama_mitra.mitra.index', compact( 'title', 'mitras', 'totalMitras', 'internalMitras', 'eksternalMitras' ));
    }

    /**
     * Simpan mitra baru
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:internal,eksternal',
            'sub_type'    => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:255',
            'url'         => 'nullable|url|max:255',
        ]);

        // validasi lanjutan sub_type
        if ($validated['type'] === 'internal') {
            $request->validate([
                'sub_type' => 'required|in:institusi,ormawa_hmps,ormawa_ukm',
            ]);
        } elseif ($validated['type'] === 'eksternal') {
            $request->validate([
                'sub_type' => 'required|in:komunitas,ukmbs',
            ]);
        }

        // simpan logo dengan nama sesuai name
        if ($request->hasFile('logo')) {
            $file      = $request->file('logo');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['name'], '-') . '.' . $ext;

            // simpan ke storage/app/public/mitra
            $path = $file->storeAs('mitra', $fileName, 'public');
            $validated['logo'] = $path;
        }

        ManageMitra::create($validated);

        return redirect()->back()->with('success', 'Mitra berhasil ditambahkan.');
    }
    
    /**
     * Update mitra
    */
    public function update(Request $request, $id)
    {
        $mitra = ManageMitra::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'type'        => 'required|in:internal,eksternal',
            'sub_type'    => 'nullable|string',
            'logo'        => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'description' => 'required|string|max:255',
            'url'         => 'nullable|url|max:255',
        ]);

        // validasi lanjutan sub_type
        if ($validated['type'] === 'internal') {
            $request->validate([
                'sub_type' => 'required|in:institusi,ormawa_hmps,ormawa_ukm',
            ]);
        } elseif ($validated['type'] === 'eksternal') {
            $request->validate([
                'sub_type' => 'required|in:komunitas,ukmbs',
            ]);
        }

        // update logo kalau ada file baru
        if ($request->hasFile('logo')) {
            // hapus logo lama
            if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
                Storage::disk('public')->delete($mitra->logo);
            }

            $file      = $request->file('logo');
            $ext       = $file->getClientOriginalExtension();
            $fileName  = Str::slug($validated['name'], '-') . '.' . $ext;

            $path = $file->storeAs('mitra', $fileName, 'public');
            $validated['logo'] = $path;
        }

        $mitra->update($validated);

        return redirect()->back()->with('success', 'Mitra berhasil diperbarui.');
    }

    /**
     * Hapus mitra
     */
    public function destroy($id)
    {
        $mitra = ManageMitra::findOrFail($id);

        if ($mitra->logo && Storage::disk('public')->exists($mitra->logo)) {
            Storage::disk('public')->delete($mitra->logo);
        }

        $mitra->delete();

        return redirect()->back()->with('success', 'Mitra berhasil dihapus.');
    }

    /**
     * Export mitra (contoh: CSV/Excel/PDF)
     */
    public function export(Request $request)
    {
        $type = $request->query('filter');
        $search = $request->query('search');

        if ($type === 'all' || empty($type)) {
            $type = null;
        }

        return (new ManageMitraExport($type, $search))->export();
    }
}
