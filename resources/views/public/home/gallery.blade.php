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

        <div class="swiper gallery-kegiatan-swiper">
            <div class="swiper-wrapper">
                @forelse ($galeris as $item)
                    <div class="swiper-slide">
                        <div class="group relative overflow-hidden rounded-2xl bg-[#112240] border border-white/5">
                            <div class="h-[300px] w-full relative overflow-hidden">
                                <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover grayscale group-hover:grayscale-0 group-hover:scale-110 transition-all duration-700" alt="{{ $item->title }}">
                                <div class="absolute inset-0 opacity-20 mix-blend-overlay pointer-events-none" style="background-image: url('https://www.transparenttextures.com/patterns/denim.png');"></div>
                                <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-transparent to-transparent opacity-80"></div>
                            </div>

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
                    <p class="text-white">Belum ada galeri.</p>
                @endforelse
            </div>

            <div class="swiper-pagination gallery-pagi !static mt-8"></div>
        </div>
    </div>

    <style>
        .gallery-kegiatan-swiper {
            width: 100%;
            overflow: hidden;
            position: relative;
        }

        /* JANGAN override display / width swiper */
        .gallery-kegiatan-swiper .swiper-slide {
            height: auto;
        }

        .gallery-kegiatan-swiper .swiper-slide > div {
            width: 100%;
            height: 100%;
        }

        /* pagination */
        .gallery-pagi {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 6px;
        }

        .gallery-pagi .swiper-pagination-bullet {
            width: 25px;
            height: 3px;
            border-radius: 0;
            background: rgba(255, 255, 255, 0.25);
            opacity: 1;
        }

        .gallery-pagi .swiper-pagination-bullet-active {
            background: #E63946 !important;
            width: 50px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bsmGallery = new Swiper('.gallery-kegiatan-swiper', {
                slidesPerView: 3,
                slidesPerGroup: 1,
                spaceBetween: 20,
                loop: true,
                grabCursor: true,
                centeredSlides: false,

                breakpoints: {
                    0: {
                        slidesPerView: 1,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                },

                navigation: {
                    nextEl: '#next-gallery',
                    prevEl: '#prev-gallery',
                },
                pagination: {
                    el: '.gallery-pagi',
                    clickable: true,
                },
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: false,
                },
            });
        });
    </script>

</section>
