{{-- resources/views/public/gallery/index.blade.php --}}
<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Gallery</x-slot:title>

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Background Element: Garis Musik (Staff Lines) Full Page --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff-full-gallery" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff-full-gallery)" />
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
            <div id="gallery-container" data-page="1" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-12 gap-6 auto-rows-[180px]">
                @forelse ($galleries as $index => $gallery)
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

                    <div class="{{ $gridClass }} group relative overflow-hidden rounded-[2rem] bg-slate-50 border border-slate-100 shadow-sm hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 cursor-pointer">
                        <img src="{{ asset('storage/' . $gallery->image) }}" alt="{{ $gallery['title'] }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex flex-col justify-end p-8">
                            <div
                                class="transform translate-y-6 group-hover:translate-y-0 transition-transform duration-500">
                                <span
                                    class="text-[#E63946] text-[10px] font-black uppercase tracking-widest mb-2 block">
                                    {{ \Carbon\Carbon::parse($gallery['kegiatan_date'])->format('d M Y') }}
                                </span>
                                <h3 class="text-white text-lg font-black uppercase tracking-tighter leading-none mb-2">
                                    {{ $gallery['title'] }}
                                </h3>
                                <p class="text-white/70 text-xs font-medium line-clamp-2 leading-relaxed">
                                    {{ $gallery['description'] }}
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

            {{-- LOAD MORE & CLOSE --}}
            <div class="mt-20 text-center flex justify-center gap-6">
                {{-- LOAD MORE --}}
                @if ($galleries->hasMorePages())
                    <button id="load-more"
                        data-next-page="{{ $galleries->currentPage() + 1 }}"
                        class="group relative inline-flex items-center gap-4 px-12 py-5 bg-[#0A192F] rounded-2xl overflow-hidden transition-all hover:bg-[#E63946]">
                        <span class="relative z-10 text-white text-xs font-black uppercase tracking-[0.3em]">
                            Muat Simfoni Lainnya
                        </span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white relative z-10 group-hover:rotate-90 transition-transform duration-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                        </svg>
                    </button>
                @endif
                {{-- CLOSE --}}
                <button id="close-gallery"
                        style="display: none;"
                        class="group inline-flex items-center gap-4 px-12 py-5 bg-slate-200 rounded-2xl hover:bg-slate-300 transition-all">
                    <span class="text-[#0A192F] text-xs font-black uppercase tracking-[0.3em]">
                        Tutup Galeri
                    </span>
                </button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const loadMoreBtn = document.getElementById('load-more');
            const closeBtn = document.getElementById('close-gallery');
            const container = document.getElementById('gallery-container');

            if (!container || !loadMoreBtn) return;

            let currentPage = parseInt(loadMoreBtn.dataset.nextPage) || 2;
            let loading = false;

            // ===== LOAD MORE =====
            loadMoreBtn.addEventListener('click', function () {
                if (loading) return;
                loading = true;

                fetch(`?page=${currentPage}`)
                    .then(res => res.text())
                    .then(html => {
                        const doc = new DOMParser().parseFromString(html, 'text/html');
                        const newItems = doc.querySelectorAll('#gallery-container > div');

                        if (newItems.length === 0) {
                            loadMoreBtn.style.display = 'none';
                            return;
                        }

                        newItems.forEach(item => {
                            item.setAttribute('data-loaded', 'true'); // 🔥 PENANDA
                            container.appendChild(item);
                        });

                        closeBtn.style.display = 'inline-flex';
                        currentPage++;

                        // cek apakah masih ada load-more di page berikutnya
                        const nextBtn = doc.getElementById('load-more');
                        if (!nextBtn) {
                            loadMoreBtn.style.display = 'none';
                        }
                    })
                    .catch(err => console.error(err))
                    .finally(() => loading = false);
            });

            // ===== CLOSE / RESET =====
            closeBtn.addEventListener('click', function () {
                const loadedItems = container.querySelectorAll('[data-loaded="true"]');

                loadedItems.forEach(item => item.remove());

                // reset state
                currentPage = parseInt(loadMoreBtn.dataset.nextPage) || 2;
                loadMoreBtn.style.display = 'inline-flex';
                this.style.display = 'none';

                container.scrollIntoView({ behavior: 'smooth' });
            });
        });
    </script>
</x-public.layouts>
