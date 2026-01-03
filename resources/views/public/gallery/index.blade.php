{{-- resources/views/public/gallery/index.blade.php --}}
<x-public.layouts>
    <x-slot:title>Gallery</x-slot:title>

    @php
        // PINDAHKAN ATAU PASTIKAN DATA INI ADA DI SINI JIKA BELUM DARI CONTROLLER
        $galleries = [
            [
                'id' => 1,
                'title' => 'Konser Akustik Malam Minggu',
                'description' => 'Penampilan akustik yang memukau di malam minggu dengan berbagai genre musik',
                'image' =>
                    'https://images.unsplash.com/photo-1514525253361-bee8718a342b?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-11-15',
            ],
            [
                'id' => 2,
                'title' => 'Workshop Vokal Teknik',
                'description' => 'Pelatihan teknik vokal dasar hingga advanced bersama vocal coach profesional',
                'image' =>
                    'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-11-10',
            ],
            [
                'id' => 3,
                'title' => 'Pentas Seni Kampus 2024',
                'description' => 'Kolaborasi seni tahunan antar UKM di gedung serbaguna kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1459749411177-042180ce673c?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-11-05',
            ],
            [
                'id' => 4,
                'title' => 'Latihan Rutin Band',
                'description' => 'Sesi latihan mingguan untuk persiapan konser dan pengembangan skill',
                'image' =>
                    'https://images.unsplash.com/photo-1511735111819-9a3f7709049c?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-11-01',
            ],
            [
                'id' => 5,
                'title' => 'Open Mic Session',
                'description' => 'Panggung terbuka bagi semua anggota untuk eksplorasi dan berbagi karya',
                'image' =>
                    'https://images.unsplash.com/photo-1508700115892-45ecd05ae2ad?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-28',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            [
                'id' => 6,
                'title' => 'Recording Session',
                'description' => 'Proses rekaman single terbaru di studio musik kampus',
                'image' =>
                    'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&q=80&w=800',
                'kegiatan_date' => '2024-10-22',
            ],
            // ... Tambahkan data lainnya jika perlu
        ];
    @endphp

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Music Staff Background --}}
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-[0.03] pointer-events-none">
            <svg viewBox="0 0 100 100" class="w-full h-full text-[#0A192F]">
                <path d="M0 10 L100 10 M0 20 L100 20 M0 30 L100 30 M0 40 L100 40 M0 50 L100 50" fill="none"
                    stroke="currentColor" stroke-width="0.5" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            {{-- HEADER --}}
            <div class="mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Visual Rhythm</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Galeri <span class="text-[#457B9D]">Simfoni</span>
                </h1>
                <p class="mt-4 text-slate-500 max-w-2xl text-sm md:text-base font-medium leading-relaxed">
                    Setiap jepretan adalah nada yang tertangkap. Koleksi momen perjalanan kreatif dan panggung ekspresi
                    UKM Seni Musik ITERA.
                </p>
            </div>

            {{-- DYNAMIC BENTO GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-12 gap-6 auto-rows-[180px]">
                @forelse ($galleries as $index => $item)
                    @php
                        $classes = [
                            'lg:col-span-6 lg:row-span-2',
                            'lg:col-span-3 lg:row-span-1',
                            'lg:col-span-3 lg:row-span-1',
                            'lg:col-span-3 lg:row-span-2',
                            'lg:col-span-6 lg:row-span-1',
                            'lg:col-span-3 lg:row-span-1',
                        ];
                        $gridClass = $classes[$index % 6];
                    @endphp

                    <div
                        class="{{ $gridClass }} group relative overflow-hidden rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 cursor-pointer">
                        <img src="{{ $item['image'] }}" alt="{{ $item['title'] }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        <div
                            class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
                            <div
                                class="transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                                <span
                                    class="text-[#E63946] text-[10px] font-black uppercase tracking-widest mb-2 block">
                                    {{ \Carbon\Carbon::parse($item['kegiatan_date'])->format('d M Y') }}
                                </span>
                                <h3 class="text-white text-lg font-black uppercase tracking-tighter leading-none mb-2">
                                    {{ $item['title'] }}
                                </h3>
                                <p class="text-white/70 text-xs font-medium line-clamp-2 leading-relaxed">
                                    {{ $item['description'] }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-12 py-20 text-center">
                        <p class="text-slate-400 font-medium">Belum ada dokumentasi tersedia.</p>
                    </div>
                @endforelse
            </div>

            {{-- LOAD MORE --}}
            <div class="mt-20 text-center">
                <button
                    class="group relative inline-flex items-center gap-4 px-12 py-5 bg-[#0A192F] rounded-2xl overflow-hidden transition-all hover:bg-[#E63946]">
                    <span class="relative z-10 text-white text-xs font-black uppercase tracking-[0.3em]">Muat Simfoni
                        Lainnya</span>
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 text-white relative z-10 group-hover:rotate-90 transition-transform duration-500"
                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</x-public.layouts>
