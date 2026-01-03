<x-public.layouts>
    <x-slot:title>Sejarah - UKM Seni Musik ITERA</x-slot:title>

    <section class="bg-white py-24 overflow-hidden font-sans">
        <div class="max-w-6xl mx-auto px-6">

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
                // Data Dummy - Nanti diganti dengan data asli dan path foto asli
                $sejarah = [
                    [
                        'year' => '201X',
                        'title' => 'The Foundation',
                        'title_id' => 'Babak Awal Terbentuk',
                        'desc' => 'Para pendiri berkumpul, menyatukan visi untuk membangun fondasi musik di kampus.',
                        // Ganti dengan path foto aslimu nanti, misal: asset('img/sejarah/foto1.jpg')
                        'photo_url' => 'https://via.placeholder.com/800x600/0A192F/457B9D?text=FOTO+ASLI+KEGIATAN+1',
                    ],
                    [
                        'year' => '201X',
                        'title' => 'Campus Resonance',
                        'title_id' => 'Eksistensi Kampus',
                        'desc' => 'Mulai mengisi panggung-panggung besar di ITERA, menjadi detak jantung setiap acara.',
                        'photo_url' => 'https://via.placeholder.com/800x600/457B9D/E63946?text=FOTO+ASLI+KEGIATAN+2',
                    ],
                    [
                        'year' => '202X',
                        'title' => 'Beyond Borders',
                        'title_id' => 'Panggung Nasional',
                        'desc' => 'Membawa bendera ITERA berkompetisi di luar kampus dan meraih prestasi.',
                        'photo_url' => 'https://via.placeholder.com/800x600/E63946/0A192F?text=FOTO+ASLI+KEGIATAN+3',
                    ],
                ];
            @endphp

            <div class="relative">
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
                                    class="text-slate-600 leading-relaxed text-base md:text-lg font-medium bg-white bg-opacity-80 p-4 md:p-0 rounded-lg">
                                    {{ $item['desc'] }}
                                </p>
                            </div>

                            <div
                                class="w-full lg:w-7/12 flex {{ $index % 2 == 0 ? 'justify-start lg:order-2' : 'justify-end lg:order-1' }} relative h-[300px] md:h-[400px] items-center">

                                <div
                                    class="absolute z-10 w-4/5 h-full bg-[#0A192F] rounded-2xl shadow-xl border-r-4 border-[#457B9D] flex items-center p-6 overflow-hidden
                                     {{ $index % 2 == 0 ? 'left-0' : 'right-0' }}">
                                    <div
                                        class="absolute bottom-4 left-6 text-[#457B9D] text-[10px] font-black tracking-[0.3em] uppercase rotate-90 origin-bottom-left">
                                        Archive Evidence
                                    </div>
                                    <div class="absolute top-0 right-10 h-full w-1 bg-[#E63946]/20"></div>
                                </div>

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

            <div class="mt-40 flex flex-col items-center justify-center gap-4">
                <div class="h-16 w-[2px] bg-gradient-to-b from-[#E63946] to-transparent"></div>
                <p class="text-[#0A192F] text-[10px] font-black tracking-[0.5em] uppercase">Terus Mencipta Sejarah</p>
            </div>

        </div>
    </section>

    <style>
        /* CSS untuk Animasi Scroll */

        /* State Awal (Sebelum discroll ke area ini) */
        .history-card {
            opacity: 0;
            /* Geser sedikit ke bawah */
            transform: translateY(50px);
            transition: all 1s cubic-bezier(0.22, 1, 0.36, 1);
        }

        /* Sembunyikan foto di belakang folder pada awalnya */
        .history-card .photo-slide-item {
            opacity: 0;
            transform: scale(0.95);
        }

        /* State Saat Terlihat (Is Visible) - Ditambahkan oleh JS */
        .history-card.is-visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Saat visible, foto muncul dan bergeser keluar dari folder */
        .history-card.is-visible .photo-slide-item {
            opacity: 1;
            transform: scale(1);
            /* Trik CSS: Menggunakan variabel CSS untuk arah geser berbeda
               tergantung posisi (kiri/kanan).
               Nilai default 100px, nanti di-override di media query mobile.
            */
            --slide-distance: 120px;
        }

        /* Logika geser kiri/kanan berdasarkan urutan genap/ganjil */
        .history-card[data-index-parity="even"].is-visible .photo-slide-item {
            /* Item genap geser ke kanan */
            transform: translateX(var(--slide-distance)) rotate(2deg);
        }

        .history-card[data-index-parity="odd"].is-visible .photo-slide-item {
            /* Item ganjil geser ke kiri (nilai negatif) */
            transform: translateX(calc(var(--slide-distance) * -1)) rotate(-2deg);
        }


        /* Responsif untuk Mobile */
        @media (max-width: 1024px) {
            .history-card.is-visible .photo-slide-item {
                /* Jarak geser lebih kecil di layar kecil */
                --slide-distance: 50px;
            }

            /* Di mobile, teks mungkin menumpuk, kita beri background agar terbaca */
            .history-card .bg-white.bg-opacity-80 {
                backdrop-filter: blur(5px);
                box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.history-card');

            // Tambahkan atribut data-index-parity untuk membantu CSS
            cards.forEach((card, index) => {
                card.setAttribute('data-index-parity', index % 2 === 0 ? 'even' : 'odd');
            });

            // Intersection Observer untuk mendeteksi scroll
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        // Tambahkan class is-visible saat elemen masuk layar
                        entry.target.classList.add('is-visible');
                        // Opsional: Hentikan observasi setelah terlihat sekali
                        // observer.unobserve(entry.target); 
                    }
                });
            }, {
                threshold: 0.25 // Memicu saat 25% elemen terlihat
            });

            cards.forEach(card => observer.observe(card));
        });
    </script>
</x-public.layouts>
