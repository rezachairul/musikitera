<x-public.layouts>
    <x-slot:title>Sejarah - UKM Seni Musik ITERA</x-slot:title>

    <section class="bg-white py-24 overflow-hidden font-sans relative">
        {{-- BACKGROUND ELEMENT: Music Staff Lines --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="historyStaff" width="100" height="60" patternUnits="userSpaceOnUse">
                        <path d="M0 12 L100 12 M0 24 L100 24 M0 36 L100 36 M0 48 L100 48 M0 60 L100 60" stroke="#0A192F"
                            stroke-width="1" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#historyStaff)" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            {{-- HEADER SECTION --}}
            <div class="mb-24 relative text-center lg:text-left">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-1 w-10 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">The Visual History</span>
                </div>

                <h1 class="text-5xl md:text-7xl font-black tracking-tighter text-[#0A192F] uppercase leading-[0.85]">
                    Journey <span class="text-[#457B9D]">&</span> <br>
                    <span class="italic font-light text-slate-400">Milestones.</span>
                </h1>

                <p
                    class="mt-8 text-slate-600 max-w-2xl text-base md:text-lg leading-relaxed font-medium mx-auto lg:mx-0">
                    Dokumentasi visual perjalanan <span class="text-[#0A192F] font-bold">UKM Seni Musik ITERA</span>.
                    Setiap foto menyimpan cerita dedikasi dari masa ke masa.
                </p>
            </div>

            @php
                $sejarah = [
                    [
                        'year' => '201X',
                        'title' => 'The Foundation',
                        'title_id' => 'Babak Awal Terbentuk',
                        'desc' => 'Para pendiri berkumpul, menyatukan visi untuk membangun fondasi musik di kampus.',
                        'photo_url' => 'https://images.unsplash.com/photo-1511671782779-c97d3d27a1d4?q=80&w=800',
                    ],
                    [
                        'year' => '201X',
                        'title' => 'Campus Resonance',
                        'title_id' => 'Eksistensi Kampus',
                        'desc' => 'Mulai mengisi panggung-panggung besar di ITERA, menjadi detak jantung setiap acara.',
                        'photo_url' => 'https://images.unsplash.com/photo-1470225620780-dba8ba36b745?q=80&w=800',
                    ],
                    [
                        'year' => '202X',
                        'title' => 'Beyond Borders',
                        'title_id' => 'Panggung Nasional',
                        'desc' => 'Membawa bendera ITERA berkompetisi di luar kampus dan meraih prestasi.',
                        'photo_url' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=800',
                    ],
                    [
                        'year' => '202X',
                        'title' => 'Beyond Borders',
                        'title_id' => 'Panggung Nasional',
                        'desc' => 'Membawa bendera ITERA berkompetisi di luar kampus dan meraih prestasi.',
                        'photo_url' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=800',
                    ],
                    [
                        'year' => '202X',
                        'title' => 'Beyond Borders',
                        'title_id' => 'Panggung Nasional',
                        'desc' => 'Membawa bendera ITERA berkompetisi di luar kampus dan meraih prestasi.',
                        'photo_url' => 'https://images.unsplash.com/photo-1501386761578-eac5c94b800a?q=80&w=800',
                    ],
                ];
            @endphp

            <div class="relative">
                {{-- TIMELINE VERTICAL LINE --}}
                <div
                    class="absolute left-0 lg:left-1/2 transform lg:-translate-x-1/2 top-0 h-full w-[2px] bg-slate-100 hidden md:block">
                    <div
                        class="sticky top-1/2 h-4 w-4 rounded-full bg-[#E63946] -left-[7px] border-4 border-white shadow-sm">
                    </div>
                </div>

                <div class="space-y-48 md:space-y-60">
                    @foreach ($sejarah as $index => $item)
                        <div class="history-card relative flex flex-col lg:flex-row items-center gap-16 group"
                            data-index="{{ $index }}">

                            {{-- TEXT SIDE --}}
                            <div
                                class="w-full lg:w-5/12 {{ $index % 2 == 0 ? 'lg:text-right lg:order-1' : 'lg:text-left lg:order-2' }} z-20 relative">
                                <div class="mb-2">
                                    <span
                                        class="text-6xl md:text-7xl font-black text-[#0A192F]/10 block group-hover:text-[#E63946]/10 transition-colors duration-500">
                                        {{ $item['year'] }}
                                    </span>
                                </div>

                                <h2
                                    class="text-2xl md:text-3xl font-black text-[#0A192F] mb-2 uppercase tracking-tight">
                                    {{ $item['title'] }}
                                </h2>
                                <p
                                    class="text-[#457B9D] text-sm font-bold uppercase tracking-widest mb-6 border-b-2 border-[#E63946] inline-block pb-1">
                                    {{ $item['title_id'] }}
                                </p>

                                <p
                                    class="text-slate-600 leading-relaxed text-base md:text-lg font-medium bg-white/50 backdrop-blur-sm p-4 md:p-0 rounded-lg">
                                    {{ $item['desc'] }}
                                </p>
                            </div>

                            {{-- PHOTO SIDE --}}
                            <div
                                class="w-full lg:w-7/12 flex {{ $index % 2 == 0 ? 'justify-start lg:order-2' : 'justify-end lg:order-1' }} relative h-[300px] md:h-[400px] items-center">

                                {{-- Folder/Frame Background --}}
                                <div
                                    class="absolute z-10 w-4/5 h-full bg-[#0A192F] rounded-2xl shadow-xl border-r-4 border-[#457B9D] flex items-center p-6 overflow-hidden
                                     {{ $index % 2 == 0 ? 'left-0' : 'right-0' }}">
                                    <div
                                        class="absolute bottom-4 left-6 text-[#457B9D] text-[10px] font-black tracking-[0.3em] uppercase rotate-90 origin-bottom-left">
                                        Archive Evidence
                                    </div>
                                    <div class="absolute top-0 right-10 h-full w-1 bg-[#E63946]/20"></div>
                                </div>

                                {{-- Sliding Photo --}}
                                <div
                                    class="photo-slide-item absolute z-30 w-4/5 h-[90%] bg-slate-200 rounded-xl shadow-2xl overflow-hidden border-4 border-white transition-all duration-1000 ease-in-out
                                            {{ $index % 2 == 0 ? 'left-8 group-hover:left-[20%] group-hover:rotate-2' : 'right-8 group-hover:right-[20%] group-hover:-rotate-2' }}">

                                    <div
                                        class="absolute top-4 right-4 bg-[#E63946] text-white text-[8px] font-bold px-2 py-1 uppercase tracking-widest z-10">
                                        Dokumentasi ASLI
                                    </div>

                                    <img src="{{ $item['photo_url'] }}" alt="{{ $item['title_id'] }}"
                                        class="w-full h-full object-cover hover:scale-110 transition-transform duration-700">
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>

            {{-- ENDING SECTION --}}
            <div class="mt-40 flex flex-col items-center justify-center gap-4">
                <div class="h-16 w-[2px] bg-gradient-to-b from-[#E63946] to-transparent"></div>
                <p class="text-[#0A192F] text-[10px] font-black tracking-[0.5em] uppercase">Terus Mencipta Sejarah</p>
                <span class="text-slate-300 text-[8px] font-bold tracking-[0.2em] uppercase">Musik Untuk Semua</span>
            </div>

        </div>
    </section>

    <style>
        /* CSS untuk Animasi Scroll */
        .history-card {
            opacity: 0;
            transform: translateY(50px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        .history-card .photo-slide-item {
            opacity: 0;
            transform: scale(0.95);
        }

        .history-card.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        .history-card.is-visible .photo-slide-item {
            opacity: 1;
            transform: scale(1);
            --slide-distance: 120px;
        }

        .history-card[data-index-parity="even"].is-visible .photo-slide-item {
            transform: translateX(var(--slide-distance)) rotate(2deg);
        }

        .history-card[data-index-parity="odd"].is-visible .photo-slide-item {
            transform: translateX(calc(var(--slide-distance) * -1)) rotate(-2deg);
        }

        @media (max-width: 1024px) {
            .history-card.is-visible .photo-slide-item {
                --slide-distance: 50px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.history-card');

            cards.forEach((card, index) => {
                card.setAttribute('data-index-parity', index % 2 === 0 ? 'even' : 'odd');
            });

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-visible');
                    }
                });
            }, {
                threshold: 0.25
            });

            cards.forEach(card => observer.observe(card));
        });
    </script>
</x-public.layouts>
