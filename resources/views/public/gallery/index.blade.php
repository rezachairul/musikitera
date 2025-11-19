<x-public.layouts>
    <x-slot:title>Gallery</x-slot:title>

    @php
        // Dummy data gallery - sesuai struktur database
        $galleries = [
            [
                'id' => 1,
                'title' => 'Konser Akustik Malam Minggu',
                'description' => 'Penampilan akustik yang memukau di malam minggu dengan berbagai genre musik',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-11-15',
            ],
            [
                'id' => 2,
                'title' => 'Workshop Vokal Teknik',
                'description' => 'Pelatihan teknik vokal dasar hingga advanced bersama vocal coach profesional',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-11-10',
            ],
            [
                'id' => 3,
                'title' => 'Pentas Seni Kampus 2024',
                'description' => 'Kolaborasi seni tahunan antar UKM di gedung serbaguna kampus',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-11-05',
            ],
            [
                'id' => 4,
                'title' => 'Latihan Rutin Band',
                'description' => 'Sesi latihan mingguan untuk persiapan konser dan pengembangan skill',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-11-01',
            ],
            [
                'id' => 5,
                'title' => 'Open Mic Session',
                'description' => 'Panggung terbuka bagi semua anggota untuk eksplorasi dan berbagi karya',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-28',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 7,
                'title' => 'Kolaborasi Antar UKM',
                'description' => 'Proyek kolaborasi musik dengan UKM Seni Tari dan Teater',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-18',
            ],
            [
                'id' => 8,
                'title' => 'Konser Tahunan 2024',
                'description' => 'Konser akbar tahunan dengan 15 penampilan dari berbagai genre',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-12',
            ],
            [
                'id' => 9,
                'title' => 'Jamming Session Santai',
                'description' => 'Sesi jamming informal untuk networking dan eksperimen musik',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-08',
            ],
            [
                'id' => 10,
                'title' => 'Persiapan Sound Check',
                'description' => 'Proses technical rehearsal dan sound check sebelum konser besar',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-10-05',
            ],
            [
                'id' => 11,
                'title' => 'Kelas Gitar Jazz',
                'description' => 'Workshop intensif teknik dan improvisasi gitar jazz',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-09-30',
            ],
            [
                'id' => 12,
                'title' => 'Backstage Moments',
                'description' => 'Momen behind the scenes persiapan dan keceriaan di backstage',
                'image' => asset('assets/img/dummy/dummy.png'),
                'kegiatan_date' => '2024-09-25',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

            {{-- Header --}}
            <div class="mb-10">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Galeri
                </span>
                <h2 class="mt-2 text-3xl md:text-4xl font-bold text-slate-900">
                    Galeri Seni
                </h2>
                <p class="mt-3 text-gray-600 max-w-2xl">
                    Koleksi dokumentasi momen, karya, dan perjalanan UKM Seni Musik ITERA.
                    Dari panggung sederhana hingga konser besar, semua punya cerita.
                </p>
            </div>

            {{-- Abstract Grid Layout --}}
            <div class="grid grid-cols-12 gap-4 auto-rows-[200px]">

                {{-- Item 1 - Large --}}
                <div
                    class="col-span-12 md:col-span-6 row-span-2 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[0]['image'] }}" alt="{{ $galleries[0]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="text-blue-400 text-sm font-semibold mb-2">
                                {{ \Carbon\Carbon::parse($galleries[0]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-xl font-bold mb-2">{{ $galleries[0]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[0]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 2 - Medium --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[1]['image'] }}" alt="{{ $galleries[1]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[1]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[1]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[1]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 3 - Medium --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[2]['image'] }}" alt="{{ $galleries[2]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[2]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[2]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[2]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 4 - Tall --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-2 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[3]['image'] }}" alt="{{ $galleries[3]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[3]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-base font-bold mb-2">{{ $galleries[3]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[3]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 5 - Medium --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[4]['image'] }}" alt="{{ $galleries[4]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[4]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[4]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[4]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 6 - Wide --}}
                <div
                    class="col-span-12 md:col-span-6 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[5]['image'] }}" alt="{{ $galleries[5]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[5]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-base font-bold mb-2">{{ $galleries[5]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[5]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 7 - Medium --}}
                <div
                    class="col-span-6 md:col-span-4 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[6]['image'] }}" alt="{{ $galleries[6]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[6]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[6]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[6]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 8 - Large --}}
                <div
                    class="col-span-12 md:col-span-5 row-span-2 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[7]['image'] }}" alt="{{ $galleries[7]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-6">
                            <div class="text-blue-400 text-sm font-semibold mb-2">
                                {{ \Carbon\Carbon::parse($galleries[7]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-xl font-bold mb-2">{{ $galleries[7]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[7]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 9 - Medium --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[8]['image'] }}" alt="{{ $galleries[8]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[8]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[8]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[8]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 10 - Tall --}}
                <div
                    class="col-span-6 md:col-span-4 row-span-2 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[9]['image'] }}" alt="{{ $galleries[9]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[9]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-base font-bold mb-2">{{ $galleries[9]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[9]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 11 - Medium --}}
                <div
                    class="col-span-6 md:col-span-3 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[10]['image'] }}" alt="{{ $galleries[10]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[10]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-sm font-bold mb-1">{{ $galleries[10]['title'] }}</h3>
                            <p class="text-gray-300 text-xs line-clamp-2">{{ $galleries[10]['description'] }}</p>
                        </div>
                    </div>
                </div>

                {{-- Item 12 - Wide --}}
                <div
                    class="col-span-12 md:col-span-5 row-span-1 group relative overflow-hidden rounded-2xl shadow-lg cursor-pointer">
                    <img src="{{ $galleries[11]['image'] }}" alt="{{ $galleries[11]['title'] }}"
                        class="w-full h-full object-cover transition-all duration-500 group-hover:scale-110 group-hover:blur-sm">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <div class="text-blue-400 text-xs font-semibold mb-1">
                                {{ \Carbon\Carbon::parse($galleries[11]['kegiatan_date'])->format('d M Y') }}
                            </div>
                            <h3 class="text-white text-base font-bold mb-2">{{ $galleries[11]['title'] }}</h3>
                            <p class="text-gray-300 text-sm line-clamp-2">{{ $galleries[11]['description'] }}</p>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Load More Button --}}
            <div class="mt-12 text-center">
                <button
                    class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors shadow-lg hover:shadow-xl">
                    Muat Lebih Banyak
                </button>
            </div>
        </div>

        {{-- Decorative Elements --}}
        <div
            class="fixed top-20 right-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none">
        </div>
        <div class="fixed bottom-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none"
            style="animation-delay: 2s;"></div>
    </div>
</x-public.layouts>
