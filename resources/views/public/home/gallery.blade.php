<section class="py-16 bg-[#0A192F] relative overflow-hidden">

    <div class="absolute inset-0 opacity-10 pointer-events-none" style="filter: url(#denim-noise-gallery);">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
            <filter id="denim-noise-gallery">
                <feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch" />
                <feColorMatrix type="saturate" values="0" />
            </filter>
            <rect width="100%" height="100%" fill="white" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        {{-- Header Galeri --}}
        <div class="flex items-end justify-between mb-10">
            <div>
                <div class="flex items-center gap-3 mb-2">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#A8DADC] text-[10px] font-black uppercase tracking-[0.4em]">
                        Visual Archive
                    </span>
                </div>
                <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter">
                    Galeri <span class="text-transparent" style="-webkit-text-stroke: 1px #457B9D">Kegiatan</span>
                </h2>
            </div>

            {{-- Tombol Navigasi --}}
            <div class="flex gap-2">
                <button id="prev-gallery"
                    class="w-10 h-10 bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#E63946] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
                <button id="next-gallery"
                    class="w-10 h-10 bg-white/5 border border-white/10 flex items-center justify-center text-white hover:bg-[#E63946] transition-all">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            </div>
        </div>

        {{-- Galeri Slider --}}
        <div class="relative overflow-hidden">
            <div 
                id="gallery-track"
                class="flex transition-transform duration-700 ease-in-out gap-8"
            >
                @forelse ($galeris as $item)
                    <div class="gallery-item shrink-0 w-full sm:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1.33rem)]">
                        <div class="group relative rounded-2xl bg-[#112240] border border-white/5 overflow-hidden">
                            
                            {{-- Image --}}
                            <div class="h-[300px] w-full relative overflow-hidden">
                                <img 
                                    src="{{ asset('storage/' . $item->image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover grayscale 
                                        group-hover:grayscale-0 
                                        group-hover:scale-110 
                                        transition-all duration-700"
                                >
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-transparent to-transparent opacity-80"></div>
                            </div>

                            {{-- Overlay Text --}}
                            <div class="absolute inset-0 flex flex-col justify-end p-6">
                                <span class="text-[#E63946] text-[9px] font-black uppercase tracking-widest mb-1">
                                    {{ \Illuminate\Support\Str::upper(\Illuminate\Support\Str::slug($item->title, ' ')) }}
                                </span>
                                <h3 class="text-white text-base font-bold uppercase tracking-tighter">
                                    {{ $item->title }}
                                </h3>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-white/70 py-10 w-full">
                        Belum ada galeri kegiatan.
                    </p>
                @endforelse
            </div>
        </div>
    </div>

    <script>
        const track = document.getElementById('gallery-track');
        const prevBtn = document.getElementById('prev-gallery');
        const nextBtn = document.getElementById('next-gallery');

        let index = 0;

        function itemsPerView() {
            if (window.innerWidth >= 1024) return 3;
            if (window.innerWidth >= 640) return 2;
            return 1;
        }

        function slideGallery() {
            const itemWidth = track.children[0].offsetWidth + 32; // gap-8 = 32px
            track.style.transform = `translateX(-${index * itemWidth}px)`;
        }

        nextBtn.addEventListener('click', () => {
            const maxIndex = track.children.length - itemsPerView();
            if (index < maxIndex) {
                index++;
                slideGallery();
            }
        });

        prevBtn.addEventListener('click', () => {
            if (index > 0) {
                index--;
                slideGallery();
            }
        });

        window.addEventListener('resize', () => {
            index = 0;
            slideGallery();
        });
    </script>

</section>
