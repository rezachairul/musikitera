{{-- resources/views/public/executive/index.blade.php --}}
<x-public.layouts>
    <x-slot:title>Dewan Pengawas</x-slot:title>

    <section class="bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="mb-10 md:mb-12">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Badan Pengurus
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Badan Pengurus Kabinet Daniswara
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Halaman ini menampilkan kabinet terbaru (aktif) dan kabinet-kabinet sebelumnya (arsip).
                    Kabinet terbaru akan ditandai sebagai kabinet saat ini dan memiliki akses cepat menuju
                    halaman Visi Misi, Struktur Organisasi, dan Daftar Anggota.
                </p>
            </div>

            @php
                /**
                 * NOTE:
                 * Nanti sebaiknya data di-pass dari Controller:
                 * - $currentKabinet (kabinet aktif)
                 * - $pastKabinets (koleksi kabinet lama)
                 */

                $currentKabinet = [
                    'id' => 1,
                    'nama' => 'Kabinet Daniswara 2025/2026',
                    'periode' => '2025 - 2026',
                    'tagline' => 'Berkarya, Bertumbuh, Berdampak',
                    'cover' => 'https://via.placeholder.com/1200x600.png?text=Kabinet+Terbaru',
                    'deskripsi' =>
                        'Kabinet terbaru yang sedang berjalan. Fokus pada konsolidasi organisasi, penguatan program kerja, dan regenerasi kader.',
                    // route placeholders
                    'route_visimisi' => 'public.kabinet.visimisi',
                    'route_struktur' => 'public.kabinet.struktur',
                    'route_anggota' => 'public.kabinet.anggota',
                    'route_detail' => 'public.kabinet.show',
                ];

                $pastKabinets = [
                    [
                        'id' => 2,
                        'nama' => 'Kabinet Daniswara 2024/2025',
                        'periode' => '2024 - 2025',
                        'cover' => 'https://via.placeholder.com/1200x600.png?text=Kabinet+2024/2025',
                        'deskripsi' =>
                            'Kabinet periode sebelumnya dengan fokus pengembangan talent dan ekspansi kolaborasi.',
                        'route_detail' => 'public.kabinet.show',
                    ],
                    [
                        'id' => 3,
                        'nama' => 'Kabinet Daniswara 2023/2024',
                        'periode' => '2023 - 2024',
                        'cover' => 'https://via.placeholder.com/1200x600.png?text=Kabinet+2023/2024',
                        'deskripsi' =>
                            'Kabinet arsip yang menekankan peningkatan kualitas event dan internalisasi budaya organisasi.',
                        'route_detail' => 'public.kabinet.show',
                    ],
                ];
            @endphp

            {{-- =========================
                 CURRENT KABINET (HIGHLIGHT)
                 ========================= --}}
            <div
                class="rounded-3xl p-[2px] bg-gradient-to-br from-blue-500/60 via-sky-400/50 to-indigo-500/60 shadow-[0_18px_45px_rgba(15,23,42,0.18)]">
                <div class="bg-white rounded-3xl overflow-hidden">
                    <div class="relative">
                        <img src="{{ $currentKabinet['cover'] }}" alt="{{ $currentKabinet['nama'] }}"
                            class="w-full h-[220px] md:h-[320px] object-cover">

                        {{-- badge current --}}
                        <div class="absolute top-4 left-4 flex items-center gap-2">
                            <span
                                class="text-[11px] px-3 py-1 rounded-full bg-blue-600 text-white font-semibold tracking-wide">
                                Kabinet Saat Ini
                            </span>
                            <span
                                class="text-[11px] px-3 py-1 rounded-full bg-slate-950/80 text-slate-50 border border-blue-400/70">
                                {{ $currentKabinet['periode'] }}
                            </span>
                        </div>

                        {{-- subtle overlay --}}
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-slate-950/45 via-slate-950/10 to-transparent">
                        </div>

                        {{-- title on image --}}
                        <div class="absolute bottom-4 left-4 right-4">
                            <h2 class="text-white text-2xl md:text-3xl font-bold tracking-tight">
                                {{ $currentKabinet['nama'] }}
                            </h2>
                            <p class="mt-1 text-white/85 text-sm md:text-base">
                                {{ $currentKabinet['tagline'] }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 md:p-8">
                        <p class="text-slate-700 max-w-4xl leading-relaxed">
                            {{ $currentKabinet['deskripsi'] }}
                        </p>

                        {{-- QUICK LINKS (pages to be made later) --}}
                        <div class="mt-7 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @php
                                // If routes not exist yet, fallback to '#'
                                $visimisiUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_visimisi'])
                                    ? route($currentKabinet['route_visimisi'], $currentKabinet['id'])
                                    : '#';

                                $strukturUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_struktur'])
                                    ? route($currentKabinet['route_struktur'], $currentKabinet['id'])
                                    : '#';

                                $anggotaUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_anggota'])
                                    ? route($currentKabinet['route_anggota'], $currentKabinet['id'])
                                    : '#';
                            @endphp

                            {{-- Visi Misi --}}
                            <a href="{{ $visimisiUrl }}"
                                class="group rounded-2xl border border-slate-200 p-5 hover:border-blue-300 hover:shadow-[0_14px_40px_rgba(37,99,235,0.15)] transition-all">
                                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-blue-600">
                                    Halaman
                                </p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-blue-700">
                                    Visi Misi Kabinet
                                </h3>
                                <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                                    Narasi arah gerak kabinet dan fokus program.
                                </p>
                                <p class="mt-4 text-sm font-semibold text-blue-700">
                                    Buka →
                                </p>
                            </a>

                            {{-- Struktur Organisasi --}}
                            <a href="{{ $strukturUrl }}"
                                class="group rounded-2xl border border-slate-200 p-5 hover:border-blue-300 hover:shadow-[0_14px_40px_rgba(37,99,235,0.15)] transition-all">
                                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-blue-600">
                                    Halaman
                                </p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-blue-700">
                                    Struktur Organisasi BPH
                                </h3>
                                <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                                    Tree organisasi untuk kabinet saat ini.
                                </p>
                                <p class="mt-4 text-sm font-semibold text-blue-700">
                                    Buka →
                                </p>
                            </a>

                            {{-- Daftar Anggota --}}
                            <a href="{{ $anggotaUrl }}"
                                class="group rounded-2xl border border-slate-200 p-5 hover:border-blue-300 hover:shadow-[0_14px_40px_rgba(37,99,235,0.15)] transition-all">
                                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-blue-600">
                                    Halaman
                                </p>
                                <h3 class="mt-2 text-lg font-semibold text-slate-900 group-hover:text-blue-700">
                                    Daftar Anggota
                                </h3>
                                <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                                    Tabel anggota kabinet dan jabatan.
                                </p>
                                <p class="mt-4 text-sm font-semibold text-blue-700">
                                    Buka →
                                </p>
                            </a>
                        </div>

                        {{-- Optional: detail kabinet --}}
                        @php
                            $detailUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_detail'])
                                ? route($currentKabinet['route_detail'], $currentKabinet['id'])
                                : '#';
                        @endphp

                        <div class="mt-7">
                            <a href="{{ $detailUrl }}"
                                class="inline-flex items-center justify-center rounded-xl bg-slate-900 text-white px-5 py-3 text-sm font-semibold hover:bg-slate-800 transition">
                                Lihat Detail Kabinet
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- =========================
                 PAST KABINETS (ARCHIVE)
                 ========================= --}}
            <div class="mt-12 md:mt-14">
                <div class="flex items-end justify-between gap-4 mb-5">
                    <div>
                        <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-slate-500">
                            Arsip
                        </p>
                        <h2 class="mt-2 text-2xl md:text-3xl font-bold text-slate-900">
                            Kabinet Lama
                        </h2>
                        <p class="mt-2 text-slate-600 text-sm md:text-base max-w-3xl">
                            Dokumentasi kabinet-kabinet sebelumnya. Tiap kabinet bisa punya halaman detailnya sendiri.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    @foreach ($pastKabinets as $kabinet)
                        @php
                            $pastDetailUrl = \Illuminate\Support\Facades\Route::has($kabinet['route_detail'])
                                ? route($kabinet['route_detail'], $kabinet['id'])
                                : '#';
                        @endphp

                        <div class="rounded-3xl p-[2px] bg-gradient-to-br from-slate-200 via-slate-100 to-slate-200">
                            <div class="bg-white rounded-3xl overflow-hidden border border-slate-100">
                                <div class="relative">
                                    <img src="{{ $kabinet['cover'] }}" alt="{{ $kabinet['nama'] }}"
                                        class="w-full h-[170px] md:h-[200px] object-cover">
                                    <span
                                        class="absolute top-3 left-3 text-[11px] px-3 py-1 rounded-full bg-white/90 text-slate-900 border border-slate-200">
                                        {{ $kabinet['periode'] }}
                                    </span>
                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-slate-950/30 via-transparent to-transparent">
                                    </div>
                                </div>

                                <div class="p-6">
                                    <h3 class="text-xl font-semibold text-slate-900">
                                        {{ $kabinet['nama'] }}
                                    </h3>
                                    <p class="mt-2 text-sm text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $kabinet['deskripsi'] }}
                                    </p>

                                    <div class="mt-5">
                                        <a href="{{ $pastDetailUrl }}"
                                            class="inline-flex items-center text-sm font-semibold text-blue-700 hover:text-blue-800">
                                            Lihat Detail →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
</x-public.layouts>
