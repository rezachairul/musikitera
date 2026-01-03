<section class="relative h-screen w-full overflow-hidden bg-[#0A192F]">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <div class="swiper heroSwiper h-full w-full">
        <div class="swiper-wrapper">

            <div class="swiper-slide h-full w-full relative">
                <div class="absolute inset-0 bg-cover bg-center"
                    style="background-image: url('https://images.unsplash.com/photo-1501612780327-45045538702b?auto=format&fit=crop&q=80&w=1920');">
                    <div class="absolute inset-0 bg-gradient-to-r from-[#0A192F] via-[#0A192F]/60 to-transparent"></div>
                </div>

                <div class="relative h-full max-w-7xl mx-auto px-6 flex flex-col items-start justify-center z-10">
                    <div class="inline-flex items-center gap-3 mb-6">
                        <span class="h-[2px] w-12 bg-[#E63946]"></span>
                        <span class="text-[#A8DADC] text-xs font-black uppercase tracking-[0.5em]">The Sound of
                            ITERA</span>
                    </div>
                    <h1
                        class="text-6xl md:text-8xl font-black text-white uppercase tracking-tighter leading-[0.9] mb-8">
                        #Asikin<span class="text-[#E63946]">Aja</span>
                    </h1>
                    <p class="text-lg md:text-xl text-slate-300 max-w-xl font-medium leading-relaxed mb-10 italic">
                        Ruang kreativitas tempat nada, suara, dan rasa berpadu menjadi harmoni di UKM Seni Musik ITERA.
                    </p>
                    <div class="flex gap-4">
                        <a href="#"
                            class="px-8 py-4 bg-[#E63946] text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-white hover:text-[#0A192F] transition-all">Jelajahi
                            Karya</a>
                    </div>
                </div>
            </div>

            <div class="swiper-slide h-full w-full relative overflow-hidden group">
                {{-- Background image (random band photo) --}}
                <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10000ms] scale-110 group-[.swiper-slide-active]:scale-125"
                    style="background-image: url('https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&q=80&w=1920');">
                </div>

                <div class="absolute inset-0 bg-[#0A192F]/60"></div>
                <div class="absolute inset-0 bg-gradient-to-b from-transparent via-[#0A192F]/20 to-[#0A192F]"></div>
                <div
                    class="absolute inset-0 flex items-center justify-center opacity-[0.03] select-none pointer-events-none">
                    <h2 class="text-[25vw] font-black text-white leading-none uppercase tracking-tighter">UNIFIED</h2>
                </div>

                <div class="relative h-full max-w-7xl mx-auto px-6 py-20 flex items-center justify-center z-10">

                    {{-- Konten: Musik Untuk Semua (tanpa gambar samping) --}}
                    <div class="w-full max-w-3xl text-center">
                        <div class="mb-6 overflow-hidden">
                            <span
                                class="inline-block px-3 py-1 bg-[#E63946]/10 border border-[#E63946]/20 rounded-full text-[#E63946] text-[10px] font-black uppercase tracking-[0.5em] animate-pulse">
                                Community & Passion
                            </span>
                        </div>

                        <h1
                            class="text-5xl md:text-7xl lg:text-8xl font-black text-white uppercase tracking-tighter mb-6 leading-[0.9]">
                            Musik <br>
                            <span class="text-transparent"
                                style="-webkit-text-stroke: 1.5px rgba(255,255,255,0.4)">Untuk</span> <br>
                            <span class="text-[#457B9D] drop-shadow-[0_0_20px_rgba(69,123,157,0.3)]">Semua</span>
                        </h1>

                        <div class="relative py-6 mb-8 max-w-2xl mx-auto">
                            <p class="text-base md:text-lg text-slate-300 font-medium leading-relaxed italic">
                                "Tak peduli genre atau instrumenmu, kita bersama menciptakan karya dan merayakan musik
                                sebagai bahasa universal di kampus ITERA."
                            </p>
                        </div>

                        {{-- Tag Divisi dengan Style Badge Musik --}}
                        <div class="flex flex-wrap justify-center gap-3 opacity-80">
                            @foreach (['VOCAL', 'GUITAR', 'BASS', 'DRUM', 'KEYBOARD'] as $divisi)
                                <span
                                    class="px-4 py-1.5 bg-white/5 border border-white/10 rounded-full text-[10px] font-black text-blue-100 tracking-[0.2em] uppercase hover:bg-[#E63946] hover:border-[#E63946] hover:text-white transition-all duration-300 cursor-default">
                                    {{ $divisi }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="swiper-pagination hero-pagination !bottom-12"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <style>
        /* CSS UNTUK MENCEGAH TABRAKAN (Overlap) */
        .swiper-slide {
            opacity: 0 !important;
            /* Semua slide sembunyi */
            transition-property: opacity;
        }

        .swiper-slide-active {
            opacity: 1 !important;
            /* Hanya yang aktif yang muncul */
        }

        /* Custom Pagination */
        .hero-pagination .swiper-pagination-bullet {
            width: 30px;
            height: 3px;
            border-radius: 0;
            background: rgba(255, 255, 255, 0.2);
            opacity: 1;
            transition: all 0.5s;
        }

        .hero-pagination .swiper-pagination-bullet-active {
            background: #E63946 !important;
            width: 60px;
        }

        /* Slide utility (moved from inline <style>) */
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 4s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const swiper = new Swiper('.heroSwiper', {
                loop: true,
                effect: 'fade', // Gunakan efek Fade
                fadeEffect: {
                    crossFade: true // Ini kunci agar slide lama hilang total saat slide baru masuk
                },
                speed: 1200, // Durasi fading (1.2 detik)
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.hero-pagination',
                    clickable: true,
                },
            });
        });
    </script>
</section>
