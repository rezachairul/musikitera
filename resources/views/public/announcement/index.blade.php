<x-public.layouts>
    <x-slot:title>Pengumuman</x-slot:title>

    @php
        // Dummy data tetap sama, hanya gambar diarahkan ke Unsplash agar visual lebih "hidup"
        $announcements = collect([
            [
                'judul' => 'Workshop Gitar Jazz Pemula',
                'excerpt' =>
                    'Belajar teknik dasar gitar jazz bersama pemateri berpengalaman dari industri musik nasional...',
                'image' =>
                    'https://images.unsplash.com/photo-1510915361894-db8b60106cb1?auto=format&fit=crop&q=80&w=800',
                'date' => '25 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Panggung Ekspresi Malam Jumat',
                'excerpt' => 'Sesi open mic untuk semua anggota, bawa karya terbaikmu dan tunjukkan bakatmu...',
                'image' =>
                    'https://images.unsplash.com/photo-1501612780327-45045538702b?auto=format&fit=crop&q=80&w=800',
                'date' => '22 Nov 2025',
                'category' => 'Event',
            ],
            [
                'judul' => 'Latihan Umum Paduan Suara',
                'excerpt' => 'Persiapan penampilan konser akhir semester di gedung serbaguna kampus ITERA...',
                'image' =>
                    'https://images.unsplash.com/photo-1527529482837-459821950b41?auto=format&fit=crop&q=80&w=800',
                'date' => '20 Nov 2025',
                'category' => 'Latihan',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik profesional...',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
        ]);

        $perPage = 3;
        $currentPage = request('page', 1);
        $latest = $announcements->first();
        $others = $announcements->slice(1);
        $totalPages = ceil($others->count() / $perPage);
        $paginatedOthers = $others->slice(($currentPage - 1) * $perPage, $perPage);

        $limit = 3;
        $start = max(1, $currentPage - floor($limit / 2));
        $end = min($totalPages, $start + $limit - 1);

        // Geser start jika end sudah mentok di total halaman
        if ($end - $start + 1 < $limit) {
            $start = max(1, $end - $limit + 1);
        }
    @endphp

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Background Element: Music Lines --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.02] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- HEADER SECTION --}}
            <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-8">
                <div class="max-w-2xl">
                    <div class="inline-flex items-center gap-3 mb-4">
                        <span class="h-[2px] w-8 bg-[#E63946]"></span>
                        <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Bulletin Board</span>
                    </div>
                    <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                        Warta <span class="text-[#457B9D]">Musik</span>
                    </h1>
                </div>

                {{-- Search Bar: Capsule Style --}}
                <div class="w-full md:w-80">
                    <form action="#" method="GET" class="relative group">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari pengumuman..."
                            class="w-full pl-6 pr-14 py-4 rounded-full border-2 border-slate-100 bg-slate-50 text-slate-900 focus:bg-white focus:border-[#457B9D] focus:ring-4 focus:ring-[#457B9D]/10 outline-none transition-all duration-300">
                        <button type="submit"
                            class="absolute right-2 top-1/2 -translate-y-1/2 p-3 bg-[#0A192F] text-white rounded-full hover:bg-[#E63946] transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <circle cx="11" cy="11" r="8" stroke-width="2.5" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" stroke-width="2.5"
                                    stroke-linecap="round" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="grid lg:grid-cols-12 gap-10">

                {{-- LATEST / FEATURED (Left) --}}
                <div class="lg:col-span-5">
                    <div class="sticky top-10">
                        <article class="group relative overflow-hidden rounded-[2.5rem] bg-[#0A192F] shadow-2xl">
                            <div class="aspect-[4/5] relative overflow-hidden">
                                <img src="{{ $latest['image'] }}" alt="{{ $latest['judul'] }}"
                                    class="w-full h-full object-cover opacity-80 group-hover:scale-105 transition-transform duration-700 group-hover:blur-[2px]">

                                {{-- Overlay --}}
                                <div
                                    class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/40 to-transparent">
                                </div>

                                {{-- Badge --}}
                                <div class="absolute top-8 left-8">
                                    <span
                                        class="px-5 py-2 bg-[#E63946] text-white text-[10px] font-black uppercase tracking-widest rounded-full">
                                        {{ $latest['category'] }}
                                    </span>
                                </div>

                                {{-- Content --}}
                                <div class="absolute bottom-0 left-0 p-10">
                                    <p class="text-white/60 text-xs font-bold mb-3 tracking-widest uppercase">
                                        {{ $latest['date'] }}</p>
                                    <h2
                                        class="text-3xl font-black text-white uppercase tracking-tighter leading-tight mb-4 group-hover:text-[#A8DADC] transition-colors">
                                        {{ $latest['judul'] }}
                                    </h2>
                                    <p class="text-white/70 text-sm leading-relaxed mb-6 line-clamp-3">
                                        {{ $latest['excerpt'] }}
                                    </p>
                                    <a href="/pengumuman/contohpengumuman"
                                        class="inline-flex items-center gap-3 text-white font-black text-xs uppercase tracking-widest group/link">
                                        Baca Selengkapnya
                                        <span class="w-8 h-[2px] bg-white group-hover/link:w-12 transition-all"></span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>

                {{-- OTHERS / LIST (Right) --}}
                <div class="lg:col-span-7 flex flex-col justify-between">
                    <div class="space-y-6">
                        @foreach ($paginatedOthers as $item)
                            <article
                                class="group relative bg-white border-b-2 border-slate-100 hover:border-[#457B9D] transition-all duration-300 pb-6">
                                <div class="flex flex-col sm:flex-row gap-6">
                                    {{-- Thumbnail --}}
                                    <div
                                        class="w-full sm:w-40 h-32 flex-shrink-0 rounded-2xl overflow-hidden relative shadow-md">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['judul'] }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        <div
                                            class="absolute inset-0 bg-[#0A192F]/10 group-hover:bg-transparent transition-colors">
                                        </div>
                                    </div>

                                    {{-- Info --}}
                                    <div class="flex-1">
                                        <div class="flex items-center gap-3 mb-2">
                                            <span
                                                class="text-[#E63946] text-[10px] font-black uppercase tracking-widest">{{ $item['category'] }}</span>
                                            <span class="w-1 h-1 bg-slate-300 rounded-full"></span>
                                            <span
                                                class="text-slate-400 text-[10px] font-bold uppercase">{{ $item['date'] }}</span>
                                        </div>
                                        <h3
                                            class="text-xl font-black text-[#0A192F] uppercase tracking-tighter mb-2 group-hover:text-[#457B9D] transition-colors">
                                            {{ $item['judul'] }}
                                        </h3>
                                        <p class="text-slate-500 text-sm line-clamp-2 leading-relaxed">
                                            {{ $item['excerpt'] }}
                                        </p>
                                    </div>

                                    {{-- Play-like Icon button --}}
                                    <div class="hidden sm:flex items-center">
                                        <a href="/pengumuman/contohpengumuman"
                                            class="w-12 h-12 rounded-full border-2 border-slate-100 flex items-center justify-center group-hover:bg-[#457B9D] group-hover:border-[#457B9D] transition-all">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-5 w-5 text-slate-300 group-hover:text-white transition-colors"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5l7 7-7 7" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- CUSTOM PAGINATION (Sliding Window 3 Numbers) --}}
                    @if ($totalPages > 1)
                        <div class="mt-12 flex items-center justify-start gap-4">

                            {{-- Tombol Previous --}}
                            <a href="?page={{ max(1, $currentPage - 1) }}"
                                class="w-12 h-12 flex items-center justify-center rounded-xl border-2 border-slate-100 text-[#0A192F] hover:bg-slate-50 transition-all {{ $currentPage == 1 ? 'opacity-30 pointer-events-none' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 19l-7-7 7-7" />
                                </svg>
                            </a>

                            <div class="flex gap-2">
                                {{-- Loop hanya dari $start sampai $end --}}
                                @for ($i = $start; $i <= $end; $i++)
                                    <a href="?page={{ $i }}"
                                        class="w-12 h-12 flex items-center justify-center rounded-xl font-black text-xs transition-all {{ $currentPage == $i ? 'bg-[#0A192F] text-white shadow-lg shadow-[#0A192F]/20' : 'bg-white border-2 border-slate-100 text-slate-400 hover:border-[#457B9D] hover:text-[#457B9D]' }}">
                                        {{ str_pad($i, 2, '0', STR_PAD_LEFT) }}
                                    </a>
                                @endfor
                            </div>

                            {{-- Tombol Next --}}
                            <a href="?page={{ min($totalPages, $currentPage + 1) }}"
                                class="w-12 h-12 flex items-center justify-center rounded-xl border-2 border-slate-100 text-[#0A192F] hover:bg-slate-50 transition-all {{ $currentPage == $totalPages ? 'opacity-30 pointer-events-none' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-public.layouts>
