<x-public.layouts>
    <x-slot:title>Sejarah</x-slot:title>

    <section class="bg-white py-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- header section --}}
            <div class="mb-12">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Sejarah
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Perjalanan UKM Seni Musik ITERA
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Berikut adalah rangkaian cerita singkat mengenai perjalanan UKM Seni Musik ITERA
                    dari awal berdiri hingga berkembang seperti sekarang. Isi masih
                    berupa dummy text untuk sementara.
                </p>
            </div>

            @php
                $sejarah = [
                    [
                        'heading' => 'Babak Awal Terbentuknya UKM',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Fusce dignissim, magna a dapibus feugiat, urna dui posuere elit, 
                            vitae condimentum lorem metus in lorem. Curabitur vitae tortor 
                            id justo ultricies cursus. Sed nec diam sed lorem gravida semper.',
                    ],
                    [
                        'heading' => 'Mulai Aktif di Kegiatan Kampus',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Integer mattis nisl sed ultricies malesuada. Donec interdum, 
                            lorem a placerat viverra, velit dui ullamcorper arcu, ac 
                            porttitor ipsum magna et mauris.',
                    ],
                    [
                        'heading' => 'Mewarnai Panggung dan Kompetisi Musik',
                        'desc' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. 
                            Vivamus sagittis, metus ac laoreet posuere, lorem risus condimentum 
                            orci, sit amet vulputate ipsum purus at nibh. Suspendisse potenti.',
                    ],
                ];
            @endphp

            <div class="space-y-16">
                @foreach ($sejarah as $index => $item)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-center border-t border-slate-200 pt-10
                               history-item"
                        data-index="{{ $index }}">
                        {{-- kiri: teks --}}
                        <div>
                            <h2 class="text-xl md:text-2xl font-semibold text-slate-900 mb-3">
                                {{ $item['heading'] }}
                            </h2>
                            <p class="text-sm md:text-base text-slate-600 leading-relaxed">
                                {{ $item['desc'] }}
                            </p>
                        </div>

                        {{-- kanan: kotak foto dummy --}}
                        <div class="flex justify-center md:justify-end">
                            <div
                                class="w-full md:w-80 h-48 md:h-56
                                       rounded-2xl border border-sky-100 bg-slate-50
                                       shadow-sm flex items-center justify-center
                                       text-slate-400 text-xs tracking-wide
                                       transition-transform duration-300 hover:-translate-y-1">
                                Foto Kegiatan / Poster Musik
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    {{-- ANIMASI SCROLL UNTUK SEJARAH --}}
    <style>
        .history-item {
            opacity: 0;
            transform: translateX(60px);
            filter: blur(6px);
            transition:
                opacity 0.7s ease-out,
                transform 0.7s ease-out,
                filter 0.7s ease-out;
        }

        .history-item.history-item-visible {
            opacity: 1;
            transform: translateX(0);
            filter: blur(0);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const items = document.querySelectorAll('.history-item');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        el.classList.add('history-item-visible');
                        observer.unobserve(el);
                    }
                });
            }, {
                threshold: 0.2
            });

            items.forEach((item, index) => {
                item.style.transitionDelay = `${index * 0.3}s`;
                observer.observe(item);
            });
        });
    </script>
</x-public.layouts>
