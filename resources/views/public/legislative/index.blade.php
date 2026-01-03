{{-- resources/views/public/executive/dpo.blade.php --}}
<x-public.layouts>
    <x-slot:title>Dewan Pengawas</x-slot:title>

    <section class="bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- BACKGROUND ELEMENT: Full Music Staff Lines (Consistent with Executive) --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="legStaff" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32 M0 40 L100 40" stroke="#0A192F"
                            stroke-width="0.5" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#legStaff)" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            {{-- HEADER --}}
            <div class="mb-12 md:mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Supervisory Board
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Dewan Pengawas <span class="text-[#457B9D]">Organisasi</span>
                </h1>

                <p class="mt-4 text-slate-500 max-w-3xl text-sm md:text-base font-medium leading-relaxed">
                    Dewan Pengawas Organisasi (DPO) memegang peran krusial sebagai penyeimbang, memastikan setiap
                    orkestrasi program kerja kabinet berjalan selaras dengan konstitusi dan tujuan besar organisasi.
                </p>
            </div>

            {{-- TUPOKSI DPO - Styled as a Musical Score Section --}}
            <div class="relative mb-20">
                <div class="absolute inset-0 bg-slate-50 rounded-[2rem] -rotate-1"></div>
                <div
                    class="relative bg-white border border-slate-100 rounded-[2rem] p-8 md:p-12 shadow-xl shadow-slate-200/50">
                    <div class="flex items-center gap-4 mb-10">
                        <div class="bg-[#0A192F] p-3 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                            </svg>
                        </div>
                        <h2 class="text-2xl font-black text-[#0A192F] uppercase tracking-tight">Tugas Pokok & Fungsi
                        </h2>
                    </div>

                    <div class="grid md:grid-cols-2 gap-x-12 gap-y-8">
                        @php
                            $tupoksi = [
                                [
                                    'title' => 'Pengawasan Kabinet',
                                    'desc' =>
                                        'Mengawal pelaksanaan program kerja agar tetap berada pada koridor visi dan misi yang telah disepakati.',
                                ],
                                [
                                    'title' => 'Evaluasi Laporan',
                                    'desc' =>
                                        'Meninjau secara kritis laporan pertanggungjawaban berkala untuk menjaga transparansi organisasi.',
                                ],
                                [
                                    'title' => 'Rekomendasi Strategis',
                                    'desc' =>
                                        'Memberikan arahan dan solusi konstruktif atas kendala yang dihadapi oleh pengurus aktif.',
                                ],
                                [
                                    'title' => 'Persetujuan Kebijakan',
                                    'desc' =>
                                        'Melakukan approval pada keputusan-keputusan krusial yang berdampak luas bagi masa depan organisasi.',
                                ],
                            ];
                        @endphp

                        @foreach ($tupoksi as $item)
                            <div class="flex gap-5 group">
                                <div
                                    class="flex-shrink-0 w-10 h-10 rounded-full border-2 border-slate-100 flex items-center justify-center font-black text-[#457B9D] group-hover:bg-[#457B9D] group-hover:text-white transition-all duration-300">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <h3 class="font-bold text-[#0A192F] mb-1">{{ $item['title'] }}</h3>
                                    <p class="text-sm text-slate-500 leading-relaxed font-medium">{{ $item['desc'] }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            @php
                $currentKabinet = [
                    'id' => 1,
                    'nama' => 'Kabinet Daniswara 2025/2026',
                    'periode' => '2025 - 2026',
                    'cover' =>
                        'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&q=80&w=1200',
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

            {{-- CURRENT KABINET UNDER SUPERVISION --}}
            <div class="mb-10">
                <span class="text-[#E63946] text-[10px] font-black uppercase tracking-[0.4em]">Active Supervision</span>
                <h2 class="mt-2 text-3xl font-black text-[#0A192F] uppercase tracking-tighter mb-8">Kabinet <span
                        class="text-[#457B9D]">Saat Ini</span></h2>

                <div class="relative group">
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-[#457B9D] to-[#E63946] rounded-[2rem] blur opacity-20">
                    </div>
                    <div class="relative bg-white rounded-[2rem] overflow-hidden border border-slate-100">
                        <div class="flex flex-col md:flex-row">
                            <div class="md:w-1/3 h-48 md:h-auto relative overflow-hidden">
                                <img src="{{ $currentKabinet['cover'] }}"
                                    class="absolute inset-0 w-full h-full object-cover" alt="">
                                <div class="absolute inset-0 bg-[#0A192F]/40"></div>
                            </div>
                            <div
                                class="p-8 md:p-10 flex-1 flex flex-col md:flex-row md:items-center justify-between gap-6">
                                <div>
                                    <span
                                        class="text-[10px] font-black px-3 py-1 rounded-full bg-slate-100 text-slate-500 uppercase tracking-widest mb-3 inline-block">
                                        {{ $currentKabinet['periode'] }}
                                    </span>
                                    <h3 class="text-2xl font-black text-[#0A192F] uppercase tracking-tight">
                                        {{ $currentKabinet['nama'] }}</h3>
                                    <p class="text-sm text-slate-500 mt-1 font-medium italic">Status: Dalam Masa
                                        Pengawasan Aktif</p>
                                </div>

                                <a href="/pengawas/contohpengawas"
                                    class="inline-flex items-center justify-center rounded-xl bg-[#0A192F] text-white px-6 py-4 text-[10px] font-black uppercase tracking-[0.2em] hover:bg-[#E63946] transition-all duration-300 whitespace-nowrap">
                                    Lihat Detail →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ARCHIVE LIST --}}
            <div class="mt-20">
                <div class="flex items-center gap-4 mb-8">
                    <h2 class="text-xl font-black text-[#0A192F] uppercase tracking-tight whitespace-nowrap">Riwayat
                        Pengawasan</h2>
                    <div class="h-[1px] w-full bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($pastKabinets as $kabinet)
                        @php
                            $detailUrl = \Illuminate\Support\Facades\Route::has($kabinet['route_detail'])
                                ? route($kabinet['route_detail'], $kabinet['id'])
                                : '#';
                        @endphp

                        <div
                            class="group flex items-center justify-between p-6 rounded-2xl border border-slate-100 bg-white hover:border-[#457B9D] hover:shadow-lg transition-all duration-300">
                            <div class="flex items-center gap-5">
                                <div
                                    class="w-12 h-12 rounded-xl bg-slate-50 flex items-center justify-center group-hover:bg-[#457B9D]/10 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6 text-slate-400 group-hover:text-[#457B9D]" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-[#457B9D] uppercase tracking-widest">
                                        {{ $kabinet['periode'] }}</p>
                                    <h4 class="text-base font-black text-[#0A192F]">{{ $kabinet['nama'] }}</h4>
                                </div>
                            </div>

                            <a href="/pengawas/contohpengawas"
                                class="p-2 rounded-full hover:bg-slate-50 text-[#E63946] transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
</x-public.layouts>
