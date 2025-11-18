{{-- resources/views/public/studio.blade.php --}}
<x-public.layouts>
    <x-slot:title>Studio Musik</x-slot:title>

    <section id="studio-wrapper" class="bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">

            {{-- HEADER / HERO --}}
            <div class="mb-10 md:mb-14">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600 transition-all duration-700">
                    Studio Musik
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Studio Musik UKMBSM ITERA
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Studio Musik UKMBSM ITERA merupakan fasilitas unggulan yang dimiliki oleh Unit Kegiatan Mahasiswa
                    Bidang Seni Musik (UKMBSM) Institut Teknologi Sumatera, diresmikan pada 22 Februari 2018.
                </p>
                <p class="mt-2 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Studio ini tidak hanya menjadi ruang kreativitas bagi anggota UKMBSM, tetapi juga terbuka bagi
                    seluruh mahasiswa ITERA melalui prosedur peminjaman yang terorganisir. Selain studio, alat musik
                    yang tersedia juga dapat dipinjam untuk mendukung eksplorasi seni mahasiswa.
                </p>
                <p class="mt-2 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    UKMBSM terus aktif menggelar berbagai kegiatan, termasuk <span
                        class="font-semibold">Funcoustic</span>,
                    <span class="font-semibold">Coaching Clinic</span>, dan <span class="font-semibold">Sound
                        Engineering</span>,
                    menjadikan studio musik ini sebagai pusat pengembangan talenta musik di kampus.
                </p>

                {{-- tombol SOP --}}
                <div class="mt-6 flex flex-wrap gap-3">
                    <a href="{{ url('/files/sop-studio-musik-itera.pdf') }}"
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                              bg-blue-600 text-white hover:bg-blue-700 transition-colors">
                        Download SOP Pemakaian
                    </a>
                    <a href="{{ url('/sop-studio-musik') }}"
                        class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold
                              border border-blue-600 text-blue-600 hover:bg-blue-50 transition-colors">
                        Lihat SOP Online
                    </a>
                </div>
            </div>

            {{-- INFO LOKASI & JAM BUKA --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-14">
                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 px-5 py-5 md:px-6 md:py-6 shadow-sm">
                    <h2 class="text-sm font-semibold tracking-[0.18em] uppercase text-blue-700 mb-2">
                        Lokasi Studio
                    </h2>
                    <p class="text-base font-semibold text-slate-900">
                        Studio Musik UKMBSM ITERA
                    </p>
                    <p class="mt-1 text-sm text-slate-600 leading-relaxed">
                        Ruang D301, Gedung D Lantai 3<br>
                        Institut Teknologi Sumatera (ITERA), Lampung Selatan.
                    </p>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-slate-50/70 px-5 py-5 md:px-6 md:py-6 shadow-sm">
                    <h2 class="text-sm font-semibold tracking-[0.18em] uppercase text-blue-700 mb-2">
                        Jam Buka Studio
                    </h2>
                    <p class="text-sm text-slate-700">
                        *Jadwal dapat menyesuaikan agenda kegiatan UKMBSM.
                    </p>
                    <ul class="mt-2 text-sm text-slate-700 space-y-1.5">
                        <li><span class="font-semibold">Senin – Jumat</span> : 16.00 – 21.00 WIB</li>
                        <li><span class="font-semibold">Sabtu</span> : 10.00 – 21.00 WIB</li>
                        <li><span class="font-semibold">Minggu & Libur</span> : by request / sesuai kebijakan pengurus
                        </li>
                    </ul>
                </div>
            </div>

            {{-- CAROUSEL STUDIO / MUSIK --}}
            @php
                $slides = [
                    [
                        'title' => 'Ruang Studio Utama',
                        'desc' =>
                            'Ruang utama untuk latihan band, jamming, dan sesi rekaman sederhana. Dilengkapi drum set, ampli gitar & bass, serta sistem PA.',
                    ],
                    [
                        'title' => 'Peralatan Drum & Rhythm',
                        'desc' =>
                            'Set drum akustik dan perkusi yang siap dipakai untuk latihan intens maupun persiapan lomba.',
                    ],
                    [
                        'title' => 'Ruang Mixing & Sound',
                        'desc' =>
                            'Area pengaturan sound, mixer, dan monitoring yang digunakan dalam kegiatan pelatihan sound engineering.',
                    ],
                    [
                        'title' => 'Gitar, Bass & Keyboard',
                        'desc' =>
                            'Berbagai instrumen untuk menunjang kebutuhan aransemen musik, bisa dipinjam sesuai prosedur peminjaman.',
                    ],
                    [
                        'title' => 'Kegiatan Funcoustic & Coaching',
                        'desc' =>
                            'Studio juga digunakan sebagai tempat intimate gig, sesi coaching, dan sharing seputar musik.',
                    ],
                ];
            @endphp

            <div class="mb-4 flex items-center justify-between">
                <h2 class="text-lg md:text-xl font-semibold text-slate-900">
                    Fasilitas & Suasana Studio
                </h2>
                <div class="flex gap-2">
                    <button id="studio-prev"
                        class="h-8 w-8 flex items-center justify-center rounded-full border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs">
                        ‹
                    </button>
                    <button id="studio-next"
                        class="h-8 w-8 flex items-center justify-center rounded-full border border-slate-300 text-slate-600 hover:bg-slate-100 text-xs">
                        ›
                    </button>
                </div>
            </div>

            <div class="relative">
                {{-- track carousel --}}
                <div id="studio-carousel" class="flex gap-5 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-3">
                    @foreach ($slides as $index => $slide)
                        <div
                            class="group snap-start min-w-[260px] md:min-w-[320px] bg-white rounded-3xl border border-slate-200 shadow-sm
                                   hover:shadow-lg transition-shadow duration-300 overflow-hidden">
                            {{-- gambar dummy --}}
                            <div class="relative h-44 md:h-52 bg-slate-200 flex items-center justify-center">
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-500/40 via-sky-400/20 to-indigo-500/40">
                                </div>
                                <div class="relative z-10 text-white text-xs tracking-wide">
                                    Foto / Poster Studio {{ $index + 1 }}
                                </div>

                                {{-- overlay deskripsi saat hover --}}
                                <div
                                    class="absolute inset-0 bg-slate-950/70 opacity-0 group-hover:opacity-100
                                           transition-opacity duration-300 flex items-center justify-center px-4">
                                    <p class="text-xs md:text-sm text-slate-100 text-center leading-relaxed">
                                        {{ $slide['desc'] }}
                                    </p>
                                </div>
                            </div>

                            {{-- teks --}}
                            <div class="px-5 py-4">
                                <p class="text-[11px] font-semibold tracking-[0.18em] uppercase text-blue-600">
                                    Studio & Musik
                                </p>
                                <h3 class="mt-1 text-base md:text-lg font-semibold text-slate-900">
                                    {{ $slide['title'] }}
                                </h3>
                                <p class="mt-2 text-xs md:text-sm text-slate-600 leading-relaxed line-clamp-3">
                                    {{ $slide['desc'] }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('studio-carousel');
            const prevBtn = document.getElementById('studio-prev');
            const nextBtn = document.getElementById('studio-next');

            if (!track) return;

            const scrollAmount = 320; // px per klik (kira-kira 1 card)

            prevBtn?.addEventListener('click', () => {
                track.scrollBy({
                    left: -scrollAmount,
                    behavior: 'smooth'
                });
            });

            nextBtn?.addEventListener('click', () => {
                track.scrollBy({
                    left: scrollAmount,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</x-public.layouts>
