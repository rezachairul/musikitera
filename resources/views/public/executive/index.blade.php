{{-- resources/views/public/executive/index.blade.php --}}
<x-public.layouts>
    <x-slot:title>Badan Pengurus</x-slot:title>

    <section class="bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Music Staff Background Decoration --}}
        <div class="absolute top-0 right-0 w-1/4 h-full opacity-[0.03] pointer-events-none">
            <svg viewBox="0 0 100 100" class="w-full h-full text-[#0A192F]">
                <path d="M0 10 L100 10 M0 20 L100 20 M0 30 L100 30 M0 40 L100 40 M0 50 L100 50" fill="none"
                    stroke="currentColor" stroke-width="0.5" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            {{-- HEADER --}}
            <div class="mb-12 md:mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Executive Board
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Struktur <span class="text-[#457B9D]">Kepengurusan</span>
                </h1>

                <p class="mt-4 text-slate-500 max-w-3xl text-sm md:text-base font-medium leading-relaxed">
                    Halaman ini menampilkan kabinet terbaru yang sedang menjabat dan arsip kepengurusan sebelumnya.
                    Seluruh informasi detail mengenai visi, misi, hingga struktur organisasi dapat diakses melalui
                    profil kabinet.
                </p>
            </div>

            @php
                // Logika data tetap sama sesuai permintaan Anda
                $currentKabinet = [
                    'id' => 1,
                    'nama' => 'Kabinet Daniswara 2025/2026',
                    'periode' => '2025 - 2026',
                    'tagline' => 'Berkarya, Bertumbuh, Berdampak',
                    'cover' =>
                        'https://images.unsplash.com/photo-1527529482837-4698179dc6ce?auto=format&fit=crop&q=80&w=1200',
                    'deskripsi' =>
                        'Kabinet terbaru yang sedang berjalan. Fokus pada konsolidasi organisasi, penguatan program kerja, dan regenerasi kader melalui pendekatan yang harmonis untuk menciptakan dampak yang nyata.',
                    'route_detail' => 'public.kabinet.show',
                ];

                $pastKabinets = [
                    [
                        'id' => 2,
                        'nama' => 'Kabinet Daniswara 2024/2025',
                        'periode' => '2024 - 2025',
                        'cover' =>
                            'https://images.unsplash.com/photo-1514525253361-bee8718a342b?auto=format&fit=crop&q=80&w=800',
                        'deskripsi' =>
                            'Kabinet periode sebelumnya dengan fokus pengembangan talent dan ekspansi kolaborasi eksternal.',
                        'route_detail' => 'public.kabinet.show',
                    ],
                    [
                        'id' => 3,
                        'nama' => 'Kabinet Daniswara 2023/2024',
                        'periode' => '2023 - 2024',
                        'cover' =>
                            'https://images.unsplash.com/photo-1459749411177-042180ce673c?auto=format&fit=crop&q=80&w=800',
                        'deskripsi' =>
                            'Kabinet arsip yang menekankan peningkatan kualitas event dan internalisasi budaya organisasi yang inklusif.',
                        'route_detail' => 'public.kabinet.show',
                    ],
                ];
            @endphp

            {{-- CURRENT KABINET (HIGHLIGHT) --}}
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-[#457B9D] to-[#E63946] rounded-[2rem] blur opacity-25 group-hover:opacity-40 transition duration-1000">
                </div>

                <div class="relative bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-2xl">
                    <div class="grid lg:grid-cols-2">
                        {{-- Image Part --}}
                        <div class="relative h-[300px] lg:h-auto overflow-hidden">
                            <img src="{{ $currentKabinet['cover'] }}" alt="{{ $currentKabinet['nama'] }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/80 via-transparent to-transparent lg:bg-gradient-to-r">
                            </div>

                            <div class="absolute top-6 left-6 flex flex-col gap-2">
                                <span
                                    class="w-fit text-[10px] font-black px-3 py-1 rounded-full bg-[#E63946] text-white uppercase tracking-widest shadow-lg">
                                    Active Cabinet
                                </span>
                                <span
                                    class="w-fit text-[10px] font-black px-3 py-1 rounded-full bg-white/90 text-[#0A192F] border border-slate-200 uppercase tracking-widest">
                                    {{ $currentKabinet['periode'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Content Part --}}
                        <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                            <h2
                                class="text-3xl md:text-5xl font-black text-[#0A192F] tracking-tighter leading-none mb-3">
                                {{ $currentKabinet['nama'] }}
                            </h2>
                            <p class="text-[#E63946] font-bold text-base md:text-lg uppercase tracking-[0.2em] mb-8">
                                "{{ $currentKabinet['tagline'] }}"
                            </p>

                            <div class="h-[2px] w-12 bg-slate-200 mb-8"></div>

                            <p class="text-slate-600 leading-relaxed mb-10 font-medium text-base md:text-lg">
                                {{ $currentKabinet['deskripsi'] }}
                            </p>

                            @php
                                $detailUrl = \Illuminate\Support\Facades\Route::has($currentKabinet['route_detail'])
                                    ? route($currentKabinet['route_detail'], $currentKabinet['id'])
                                    : '#';
                            @endphp

                            <a href="{{ $detailUrl }}"
                                class="group/btn inline-flex items-center justify-between rounded-2xl bg-[#0A192F] text-white px-8 py-5 text-sm font-black uppercase tracking-[0.2em] hover:bg-[#E63946] transition-all duration-300 shadow-xl shadow-blue-900/20">
                                <span>Lihat Detail Kabinet</span>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 ml-4 group-hover/btn:translate-x-2 transition-transform"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- PAST KABINETS (ARCHIVE) --}}
            <div class="mt-24">
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-10 border-b border-slate-100 pb-6">
                    <div>
                        <span class="text-[#E63946] text-[10px] font-black uppercase tracking-[0.4em]">Historical
                            Archive</span>
                        <h2 class="mt-2 text-3xl font-black text-[#0A192F] uppercase tracking-tighter">
                            Kabinet <span class="text-[#457B9D]">Terdahulu</span>
                        </h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    @foreach ($pastKabinets as $kabinet)
                        @php
                            $pastDetailUrl = \Illuminate\Support\Facades\Route::has($kabinet['route_detail'])
                                ? route($kabinet['route_detail'], $kabinet['id'])
                                : '#';
                        @endphp

                        <div
                            class="group bg-white rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-xl transition-all duration-500">
                            <div class="relative h-56 overflow-hidden">
                                <img src="{{ $kabinet['cover'] }}" alt="{{ $kabinet['nama'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-colors">
                                </div>
                                <span
                                    class="absolute top-4 left-4 text-[10px] font-black px-3 py-1 rounded-full bg-white text-[#0A192F] border border-slate-200 uppercase tracking-widest shadow-sm">
                                    {{ $kabinet['periode'] }}
                                </span>
                            </div>

                            <div class="p-8">
                                <h3
                                    class="text-xl font-black text-[#0A192F] mb-3 group-hover:text-[#457B9D] transition-colors">
                                    {{ $kabinet['nama'] }}
                                </h3>
                                <p class="text-sm text-slate-500 leading-relaxed font-medium line-clamp-2 mb-6">
                                    {{ $kabinet['deskripsi'] }}
                                </p>

                                <a href="{{ $pastDetailUrl }}"
                                    class="inline-flex items-center text-[10px] font-black uppercase tracking-widest text-[#E63946] hover:text-[#0A192F] transition-colors">
                                    Lihat Detail
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                    </svg>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>
</x-public.layouts>
