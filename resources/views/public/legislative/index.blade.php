<x-public.layouts>
    <x-slot:title>Dewan Pengawas</x-slot:title>

    <section class="bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="mb-10">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Dewan Pengawas
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Dewan Pengawas Organisasi (DPO)
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Dewan Pengawas Organisasi (DPO) bertugas mengawasi jalannya kabinet yang sedang berlangsung
                    agar tetap sesuai dengan arah organisasi, tertib administrasi, dan dapat dipertanggungjawabkan.
                </p>
            </div>

            {{-- TUPOKSI DPO --}}
            <div class="rounded-3xl border border-slate-200 bg-slate-50 p-6 md:p-8 mb-14">
                <h2 class="text-xl md:text-2xl font-semibold text-slate-900">
                    Tugas Pokok & Fungsi
                </h2>

                <ul class="mt-5 grid md:grid-cols-2 gap-4 text-sm text-slate-700 leading-relaxed">
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span>
                        <span>
                            <b>Mengawasi kabinet aktif</b> dalam pelaksanaan program kerja dan agenda organisasi.
                        </span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span>
                        <span>
                            <b>Meninjau dan mengevaluasi laporan</b> kegiatan serta pertanggungjawaban kabinet.
                        </span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span>
                        <span>
                            <b>Memberikan rekomendasi dan arahan</b> sebagai bahan perbaikan kinerja kabinet.
                        </span>
                    </li>
                    <li class="flex gap-3">
                        <span class="mt-1 h-2 w-2 rounded-full bg-blue-600"></span>
                        <span>
                            <b>Melakukan persetujuan (approval)</b> terhadap hal-hal tertentu yang bersifat strategis.
                        </span>
                    </li>
                </ul>

                <p class="mt-6 text-sm text-slate-600 max-w-4xl">
                    Dengan peran tersebut, DPO menjadi penyeimbang agar kabinet dapat berjalan efektif
                    tanpa keluar dari nilai, aturan, dan tujuan UKMBSM ITERA.
                </p>
            </div>

            @php
                /**
                 * Dummy data — nanti idealnya dari Controller
                 */
                $currentKabinet = [
                    'id' => 1,
                    'nama' => 'Kabinet Daniswara 2025/2026',
                    'periode' => '2025 - 2026',
                    'cover' => 'https://via.placeholder.com/1200x500.png?text=Kabinet+Aktif',
                    'route_detail' => 'public.kabinet.show',
                ];

                $pastKabinets = [
                    [
                        'id' => 2,
                        'nama' => 'Kabinet Daniswara 2024/2025',
                        'periode' => '2024 - 2025',
                        'route_detail' => 'public.kabinet.show',
                    ],
                    [
                        'id' => 3,
                        'nama' => 'Kabinet Daniswara 2023/2024',
                        'periode' => '2023 - 2024',
                        'route_detail' => 'public.kabinet.show',
                    ],
                ];
            @endphp

            {{-- KABINET AKTIF (HIGHLIGHT) --}}
            @php
                $currentDetailUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_detail'])
                    ? route($currentKabinet['route_detail'], $currentKabinet['id'])
                    : '#';
            @endphp

            <div
                class="rounded-3xl p-[2px] bg-gradient-to-br from-blue-500/60 via-sky-400/50 to-indigo-500/60 shadow-[0_18px_45px_rgba(15,23,42,0.18)] mb-12">
                <div class="bg-white rounded-3xl overflow-hidden">
                    <div class="relative">
                        <img src="{{ $currentKabinet['cover'] }}" alt="{{ $currentKabinet['nama'] }}"
                            class="w-full h-[220px] md:h-[300px] object-cover">

                        <div class="absolute top-4 left-4 flex gap-2">
                            <span class="text-[11px] px-3 py-1 rounded-full bg-blue-600 text-white font-semibold">
                                Kabinet Aktif
                            </span>
                            <span
                                class="text-[11px] px-3 py-1 rounded-full bg-slate-950/80 text-slate-50 border border-blue-400/70">
                                {{ $currentKabinet['periode'] }}
                            </span>
                        </div>

                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent">
                        </div>

                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white text-2xl md:text-3xl font-bold">
                                {{ $currentKabinet['nama'] }}
                            </h3>
                        </div>
                    </div>

                    <div class="p-6 md:p-7 flex items-center justify-between flex-wrap gap-4">
                        <p class="text-sm text-slate-700">
                            Kabinet yang sedang berada dalam masa pengawasan Dewan Pengawas Organisasi.
                        </p>

                        <a href="{{ $currentDetailUrl }}"
                            class="inline-flex items-center rounded-xl bg-slate-900 text-white px-5 py-3 text-sm font-semibold hover:bg-slate-800 transition">
                            Lihat Detail →
                        </a>
                    </div>
                </div>
            </div>

            {{-- KABINET LAMA --}}
            <div>
                <p class="text-[10px] font-bold tracking-[0.3em] uppercase text-slate-500 mb-3">
                    Arsip Kabinet
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($pastKabinets as $kabinet)
                        @php
                            $detailUrl = \Illuminate\Support\Facades\Route::has($kabinet['route_detail'])
                                ? route($kabinet['route_detail'], $kabinet['id'])
                                : '#';
                        @endphp

                        <div
                            class="rounded-2xl border border-slate-200 p-5 flex items-center justify-between hover:border-blue-300 hover:shadow-[0_10px_30px_rgba(37,99,235,0.12)] transition">
                            <div>
                                <p class="text-[11px] text-slate-500">
                                    {{ $kabinet['periode'] }}
                                </p>
                                <h4 class="mt-1 text-base font-semibold text-slate-900">
                                    {{ $kabinet['nama'] }}
                                </h4>
                            </div>

                            <a href="{{ $detailUrl }}"
                                class="text-sm font-semibold text-blue-700 hover:text-blue-800">
                                Lihat Detail →
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
</x-public.layouts>
