{{-- resources/views/public/executive/index.blade.php --}}
<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Badan Pengurus</x-slot:title>

    <section class="bg-white py-16 md:py-24 relative overflow-hidden font-sans">
        {{-- BACKGROUND ELEMENT: Full Music Staff Lines (Consistent with History/Alumni) --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="execStaff" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32 M0 40 L100 40" stroke="#0A192F"
                            stroke-width="0.5" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#execStaff)" />
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
                // Data tetap sama sesuai permintaan Anda
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

            {{-- CURRENT KABINET (HIGHLIGHT with Glassmorphism) --}}
            <div class="relative group">
                <div
                    class="absolute -inset-1 bg-gradient-to-r from-[#457B9D] to-[#E63946] rounded-[2.5rem] blur opacity-20 group-hover:opacity-40 transition duration-1000">
                </div>

                <div
                    class="relative bg-white/80 backdrop-blur-xl rounded-[2.5rem] overflow-hidden border border-white shadow-2xl">
                    <div class="grid lg:grid-cols-2">
                        {{-- Image Part --}}
                        <div class="relative h-[350px] lg:h-auto overflow-hidden">
                            <img src="{{ $currentKabinet['cover'] }}" alt="{{ $currentKabinet['nama'] }}"
                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-1000">

                            <div
                                class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/90 via-[#0A192F]/20 to-transparent lg:bg-gradient-to-r">
                            </div>

                            <div class="absolute top-8 left-8 flex flex-col gap-3">
                                <span
                                    class="w-fit text-[10px] font-black px-4 py-1.5 rounded-full bg-[#E63946] text-white uppercase tracking-widest shadow-xl">
                                    Active Cabinet
                                </span>
                                <span
                                    class="w-fit text-[10px] font-black px-4 py-1.5 rounded-full bg-white/90 backdrop-blur-md text-[#0A192F] border border-white/50 uppercase tracking-widest shadow-sm">
                                    {{ $currentKabinet['periode'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Content Part --}}
                        <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center relative">
                            <h2
                                class="text-4xl md:text-5xl font-black text-[#0A192F] tracking-tighter leading-none mb-4">
                                {{ $currentKabinet['nama'] }}
                            </h2>
                            <p class="text-[#E63946] font-bold text-base md:text-lg uppercase tracking-[0.2em] mb-8">
                                "{{ $currentKabinet['tagline'] }}"
                            </p>

                            <div class="h-[3px] w-16 bg-[#457B9D] mb-8 rounded-full"></div>

                            <p class="text-slate-600 leading-relaxed mb-10 font-medium text-base md:text-lg">
                                {{ $currentKabinet['deskripsi'] }}
                            </p>

                            <a href="/pengurus/kabinet"
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
            <div class="mt-28">
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-12 border-b border-slate-100 pb-8">
                    <div>
                        <span class="text-[#E63946] text-[10px] font-black uppercase tracking-[0.4em]">Historical
                            Archive</span>
                        <h2 class="mt-2 text-3xl font-black text-[#0A192F] uppercase tracking-tighter">
                            Kabinet <span class="text-[#457B9D]">Terdahulu</span>
                        </h2>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    @foreach ($pastKabinets as $kabinet)
                        @php
                            $pastDetailUrl = \Illuminate\Support\Facades\Route::has($kabinet['route_detail'])
                                ? route($kabinet['route_detail'], $kabinet['id'])
                                : '#';
                        @endphp

                        <div
                            class="group bg-white/60 backdrop-blur-md rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 relative">
                            {{-- Hover Accent Line --}}
                            <div
                                class="absolute left-0 top-0 bottom-0 w-0 group-hover:w-2 bg-[#E63946] transition-all duration-300 z-20">
                            </div>

                            <div class="relative h-64 overflow-hidden">
                                <img src="{{ $kabinet['cover'] }}" alt="{{ $kabinet['nama'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                                <div
                                    class="absolute inset-0 bg-[#0A192F]/20 group-hover:bg-transparent transition-colors duration-500">
                                </div>
                                <span
                                    class="absolute top-6 left-6 text-[10px] font-black px-4 py-1.5 rounded-full bg-white text-[#0A192F] border border-slate-100 uppercase tracking-widest shadow-lg">
                                    {{ $kabinet['periode'] }}
                                </span>
                            </div>

                            <div class="p-10">
                                <h3
                                    class="text-2xl font-black text-[#0A192F] mb-4 group-hover:text-[#457B9D] transition-colors">
                                    {{ $kabinet['nama'] }}
                                </h3>
                                <p class="text-slate-500 leading-relaxed font-medium mb-8">
                                    {{ $kabinet['deskripsi'] }}
                                </p>

                                <a href="{{ $pastDetailUrl }}"
                                    class="inline-flex items-center text-[11px] font-black uppercase tracking-widest text-[#E63946] hover:text-[#0A192F] transition-colors group/link">
                                    Explore Archive
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 ml-2 group-hover/link:translate-x-2 transition-transform"
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
