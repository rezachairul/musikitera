<x-public.layouts>
    <x-slot:title>Pengumuman</x-slot:title>

    @php
        // Dummy data
        $announcements = collect([
            [
                'judul' => 'Workshop Gitar Jazz Pemula',
                'excerpt' => 'Belajar teknik dasar gitar jazz bersama pemateri berpengalaman...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '25 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Panggung Ekspresi Malam Jumat',
                'excerpt' => 'Sesi open mic untuk semua anggota, bawa karya terbaikmu...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '22 Nov 2025',
                'category' => 'Event',
            ],
            [
                'judul' => 'Latihan Umum Paduan Suara',
                'excerpt' => 'Persiapan penampilan konser akhir semester di gedung serbaguna...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '20 Nov 2025',
                'category' => 'Latihan',
            ],
            [
                'judul' => 'Kelas Produksi Musik Digital',
                'excerpt' => 'Kenalan dengan DAW, basic mixing, dan workflow produksi musik...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '18 Nov 2025',
                'category' => 'Workshop',
            ],
            [
                'judul' => 'Rekrutmen Panitia Konser Tahunan',
                'excerpt' => 'Dibuka kesempatan bagi anggota untuk bergabung di kepanitiaan...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '15 Nov 2025',
                'category' => 'Rekrutmen',
            ],
            [
                'judul' => 'PAGI PAGI',
                'excerpt' => 'Dibuka kesempatan bagi anggota untuk bergabung di kepanitiaan...',
                'image' => asset('assets/img/dummy/dummy.png'),
                'date' => '15 Nov 2025',
                'category' => 'Rekrutmen',
            ],
        ]);

        $perPage = 3;
        $currentPage = request('page', 1);
        $latest = $announcements->first();
        $others = $announcements->slice(1);
        $totalPages = ceil($others->count() / $perPage);
        $paginatedOthers = $others->slice(($currentPage - 1) * $perPage, $perPage);
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header Section --}}
            <div class="text-center mb-10">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Pengumuman
                </span>
                <p class="mt-3 text-gray-600">
                    Halaman ini memuat pengumuman penting seputar kegiatan, konser, workshop,
                    hingga panggung seni yang diselenggarakan oleh UKM Seni Musik ITERA.
                    Nantikan info terbaru di sini 🎤.
                </p>
            </div>

            {{-- Search Bar --}}
            <div class="max-w-md mx-auto mb-10">
                <form action="#" method="GET">
                    <div class="relative">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari pengumuman..."
                            class="w-full px-5 py-3 pr-12 rounded-xl border-2 border-slate-200 bg-white text-slate-900 placeholder:text-slate-400 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-100 transition-all">
                        <button type="submit"
                            class="absolute right-3 top-1/2 -translate-y-1/2 p-2 text-blue-900 hover:bg-blue-50 rounded-lg transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8" />
                                <line x1="21" y1="21" x2="16.65" y2="16.65" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

            {{-- Main Content --}}
            <div class="grid lg:grid-cols-5 gap-6">

                {{-- Latest Announcement (Left) --}}
                <div class="lg:col-span-2">
                    <article class="relative overflow-hidden rounded-2xl bg-white shadow-lg h-full">

                        {{-- Image --}}
                        <div class="relative h-72 overflow-hidden">
                            <img src="{{ $latest['image'] }}" alt="{{ $latest['judul'] }}"
                                class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent">
                            </div>

                            {{-- Category Badge --}}
                            <div class="absolute top-4 left-4">
                                <span
                                    class="px-3 py-1.5 bg-white/95 backdrop-blur-sm text-blue-600 text-xs font-semibold rounded-full">
                                    {{ $latest['category'] }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-6">
                            <div class="text-sm text-slate-500 mb-2">
                                {{ $latest['date'] }}
                            </div>
                            <h2 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2">
                                {{ $latest['judul'] }}
                            </h2>
                            <p class="text-slate-600 text-sm leading-relaxed mb-4 line-clamp-3">
                                {{ $latest['excerpt'] }}
                            </p>
                            <a href="#"
                                class="inline-flex items-center gap-2 text-blue-600 text-sm font-semibold hover:gap-3 transition-all">
                                Selengkapnya
                                <span>→</span>
                            </a>
                        </div>
                    </article>
                </div>

                {{-- Other Announcements with Pagination (Right) --}}
                <div class="lg:col-span-3">
                    <div class="space-y-4 mb-6">
                        @foreach ($paginatedOthers as $item)
                            <article
                                class="group overflow-hidden rounded-xl bg-white shadow-md hover:shadow-lg transition-all duration-300">
                                <div class="flex gap-4 p-4">
                                    {{-- Thumbnail --}}
                                    <div class="flex-shrink-0 w-28 h-28 overflow-hidden rounded-lg">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['judul'] }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-600 text-xs font-semibold rounded-md">
                                                {{ $item['category'] }}
                                            </span>
                                            <span class="text-xs text-slate-500">{{ $item['date'] }}</span>
                                        </div>
                                        <h3
                                            class="text-base font-bold text-slate-900 line-clamp-2 mb-2 group-hover:text-blue-600 transition-colors">
                                            {{ $item['judul'] }}
                                        </h3>
                                        <p class="text-sm text-slate-600 line-clamp-2">
                                            {{ $item['excerpt'] }}
                                        </p>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    {{-- Pagination --}}
                    @if ($totalPages > 1)
                        <div class="flex items-center justify-center gap-2">
                            {{-- Previous Button --}}
                            @if ($currentPage > 1)
                                <a href="?page={{ $currentPage - 1 }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-500 hover:text-blue-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="15 18 9 12 15 6"></polyline>
                                    </svg>
                                </span>
                            @endif

                            {{-- Page Info --}}
                            <span class="px-4 py-2 text-sm font-medium text-slate-700">
                                {{ $currentPage }} / {{ $totalPages }}
                            </span>

                            {{-- Next Button --}}
                            @if ($currentPage < $totalPages)
                                <a href="?page={{ $currentPage + 1 }}"
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-white border-2 border-slate-200 text-slate-700 hover:border-blue-500 hover:text-blue-600 transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </a>
                            @else
                                <span
                                    class="flex items-center justify-center w-10 h-10 rounded-lg bg-slate-100 text-slate-400 cursor-not-allowed">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round">
                                        <polyline points="9 18 15 12 9 6"></polyline>
                                    </svg>
                                </span>
                            @endif
                        </div>
                    @endif
                </div>
            </div>

            {{-- Decorative Elements --}}
            <div
                class="fixed top-20 right-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none">
            </div>
            <div class="fixed bottom-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 2s;"></div>
        </div>
    </div>
</x-public.layouts>
