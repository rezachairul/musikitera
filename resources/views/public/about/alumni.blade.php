{{-- resources/views/public/alumni.blade.php --}}
<x-public.layouts>
    <x-slot:title>Alumni</x-slot:title>

    <section class="bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- HEADER --}}
            <div class="mb-10 md:mb-12">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600 transition-all duration-700">
                    Alumni
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Alumni UKM Seni Musik ITERA
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Kumpulan alumni UKMBSM ITERA yang pernah mengisi panggung, studio, dan berbagai
                    kegiatan musik kampus. Tampilan ini masih menggunakan data dummy, namun
                    didesain seolah kamu sedang memilih karakter di dalam sebuah game musik.
                </p>
            </div>

            @php
                // satu dummy alumni
                $dummy = [
                    'nama' => 'Nama Alumni Dummy',
                    'foto' => 'https://via.placeholder.com/300x400.png?text=Alumni',
                    'role' => 'Vokalis • Songwriter • Performer',
                    'tahun' => '2020',
                    'desc' =>
                        'Pernah aktif di berbagai panggung kampus, dari acara internal hingga festival kolaborasi antar UKM. Kini tetap berkarya di dunia musik dan kreatif.',
                ];

                // digandakan beberapa kali supaya kelihatan ramai
                $alumnis = array_fill(0, 7, $dummy);
            @endphp

            {{-- CAROUSEL ALUMNI --}}
            <div class="relative">
                <div id="alumni-track" class="no-scrollbar flex gap-5 overflow-x-auto scroll-smooth pb-3">
                    @foreach ($alumnis as $index => $alumni)
                        <div
                            class="alumni-card group relative snap-start
                                   min-w-[180px] md:min-w-[220px] lg:min-w-[240px]
                                   h-[240px] md:h-[300px] lg:h-[320px]  {{-- kurang lebih 3x4 --}}
                                   rounded-3xl p-[2px]
                                   bg-gradient-to-br from-blue-500/50 via-sky-400/40 to-indigo-500/60
                                   shadow-[0_18px_40px_rgba(15,23,42,0.18)]
                                   hover:shadow-[0_24px_60px_rgba(37,99,235,0.35)]
                                   transition-all duration-500 ease-out">
                            {{-- inner card --}}
                            <div
                                class="relative h-full w-full rounded-3xl bg-white
                                       shadow-sm flex flex-col overflow-hidden">

                                {{-- FOTO / POSTER (TOP 2/3) --}}
                                <div class="relative h-2/3">
                                    <div class="h-full w-full bg-slate-200">
                                        <img src="{{ $alumni['foto'] }}" alt="{{ $alumni['nama'] }}"
                                            class="h-full w-full object-cover">
                                    </div>

                                    {{-- tahun lulus badge --}}
                                    <span
                                        class="absolute top-3 left-3 text-[10px] px-2 py-0.5 rounded-full
                                               bg-slate-950/80 text-slate-50 border border-blue-400/80">
                                        {{ $alumni['tahun'] }}
                                    </span>

                                    {{-- woosh embun efek --}}
                                    <div class="card-woosh pointer-events-none absolute inset-0 overflow-hidden">
                                        <div class="card-woosh-inner"></div>
                                    </div>
                                </div>

                                {{-- INFO (BOTTOM 1/3) --}}
                                <div class="flex-1 px-4 py-3 flex flex-col justify-between">
                                    <div>
                                        <p class="text-[10px] font-semibold tracking-[0.25em] uppercase text-blue-600">
                                            Alumni
                                        </p>
                                        <h2
                                            class="mt-1 text-base md:text-lg font-semibold text-slate-900 leading-tight">
                                            {{ $alumni['nama'] }}
                                        </h2>
                                        <p class="mt-1 text-[11px] md:text-xs text-slate-500">
                                            {{ $alumni['role'] }}
                                        </p>
                                    </div>

                                    <p class="mt-2 text-[11px] md:text-xs text-slate-600 leading-relaxed line-clamp-3">
                                        {{ $alumni['desc'] }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <style>
        /* hilangkan scrollbar horizontal */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* animasi floating halus biar berasa kartu karakter */
        @keyframes alumniFloat {

            0%,
            100% {
                transform: translateY(2px);
            }

            50% {
                transform: translateY(-4px);
            }
        }

        .alumni-card {
            animation: alumniFloat 10s ease-in-out infinite;
            animation-play-state: paused;
        }

        .alumni-card:hover {
            animation-play-state: running;
        }

        /* efek woosh embun */
        .card-woosh-inner {
            position: absolute;
            top: 0;
            left: -120%;
            width: 60%;
            height: 100%;
            background: linear-gradient(120deg,
                    rgba(255, 255, 255, 0) 0%,
                    rgba(255, 255, 255, 0.75) 40%,
                    rgba(255, 255, 255, 0.95) 50%,
                    rgba(255, 255, 255, 0) 100%);
            filter: blur(4px);
            transform: skewX(-15deg);
            opacity: 0;
        }

        .alumni-card:hover .card-woosh-inner {
            animation: alumniWoosh 0.9s ease-out forwards;
        }

        @keyframes alumniWoosh {
            0% {
                transform: translateX(0) skewX(-15deg);
                opacity: 0;
            }

            20% {
                opacity: 0.5;
            }

            100% {
                transform: translateX(260%) skewX(-15deg);
                opacity: 0;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.getElementById('alumni-track');
            if (!track) return;

            const cards = track.children;
            if (!cards.length) return;

            let index = 0;

            const scrollToIndex = (i) => {
                const card = cards[i];
                if (!card) return;
                const cardRect = card.getBoundingClientRect();
                const trackRect = track.getBoundingClientRect();
                const offset = card.offsetLeft - trackRect.left - 8; // sedikit padding
                track.scrollTo({
                    left: offset,
                    behavior: 'smooth'
                });
            };

            // auto carousel setiap 4.5 detik
            setInterval(() => {
                index = (index + 1) % cards.length;
                scrollToIndex(index);
            }, 4500);
        });
    </script>
</x-public.layouts>
