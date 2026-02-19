{{-- resources/views/public/studio.blade.php --}}
<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Studio Musik</x-slot:title>

    <div class="bg-white min-h-screen font-sans">

        {{-- 1. HEADER / HERO --}}
        <section class="relative py-20 overflow-hidden">
            <div class="absolute inset-0 flex flex-col justify-center gap-4 opacity-[0.03] pointer-events-none">
                @for ($i = 0; $i < 5; $i++)
                    <div class="h-[2px] w-full bg-[#0A192F]"></div>
                @endfor
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid lg:grid-cols-2 gap-12 items-start">
                    <div>
                        <div class="inline-flex items-center gap-3 mb-6">
                            <span class="h-[2px] w-8 bg-[#E63946]"></span>
                            <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Fasilitas
                                Utama</span>
                        </div>
                        <h1 class="text-4xl md:text-6xl font-black text-[#0A192F] leading-tight uppercase mb-6">
                            Studio Musik <br><span class="text-[#457B9D]">UKMBSM ITERA</span>
                        </h1>

                        {{-- Tombol SOP --}}
                        <div class="mt-8 flex flex-wrap gap-4">
                            <a href="{{ url('/files/sop-studio-musik-itera.pdf') }}"
                                class="inline-flex items-center px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest
                                     bg-[#0A192F] text-white hover:bg-[#E63946] transition-all duration-300 shadow-lg">
                                Download SOP Pemakaian
                            </a>
                            <a href="{{ url('/sop-studio-musik') }}"
                                class="inline-flex items-center px-6 py-3 rounded-full text-xs font-black uppercase tracking-widest
                                     border-2 border-[#0A192F] text-[#0A192F] hover:bg-[#0A192F] hover:text-white transition-all duration-300">
                                Lihat SOP Online
                            </a>
                        </div>
                    </div>

                    <div class="relative pt-2">
                        <div class="absolute -left-6 top-0 bottom-0 w-[4px] bg-[#E63946]"></div>
                        <div class="space-y-4 text-slate-600 font-medium leading-relaxed text-justify">
                            <p>
                                {{ $studio->deskripsi ?? 
                                'Studio Musik UKMBSM ITERA merupakan fasilitas unggulan yang digunakan sebagai ruang latihan, eksplorasi, dan pengembangan kreativitas musik mahasiswa Institut Teknologi Sumatera.' }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- 2. INFO LOKASI & JAM BUKA --}}
        <section class="py-12 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Lokasi --}}
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border-b-4 border-[#0A192F] transition-transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-2 bg-[#0A192F] rounded-lg text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <h2 class="text-sm font-black tracking-[0.2em] uppercase text-[#0A192F]">Lokasi Studio</h2>
                        </div>
                        <p class="text-base font-bold text-slate-900 mb-1">
                            Ruang {{ $studio->ruang ?? 'D301' }}, Gedung {{ $studio->gedung ?? 'D' }}, Lantai {{ $studio->lantai ?? '3' }}.
                        </p>
                        <p class="text-sm text-slate-500 font-medium leading-relaxed">
                            {{ $studio->lokasi }}.
                        </p>
                    </div>

                    {{-- Jam Buka --}}
                    <div
                        class="bg-white p-8 rounded-2xl shadow-sm border-b-4 border-[#E63946] transition-transform hover:-translate-y-1">
                        <div class="flex items-center gap-4 mb-4">
                            <div class="p-2 bg-[#E63946] rounded-lg text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <h2 class="text-sm font-black tracking-[0.2em] uppercase text-[#E63946]">Jam Buka Studio
                            </h2>
                        </div>
                        <ul class="text-sm text-slate-700 space-y-2 font-medium">
                            <li class="flex justify-between border-b border-slate-50 pb-1">
                                <span>Senin – Jumat</span>
                                <span class="font-bold text-[#0A192F]">{{ substr($studio->weekday_open, 0,5) ?? '00:00' }} – {{ substr($studio->weekday_close, 0, 5) ?? '00:00' }} WIB</span>
                            </li>
                            <li class="flex justify-between border-b border-slate-50 pb-1">
                                <span>Sabtu - Minggu</span>
                                <span class="font-bold text-[#0A192F]">{{ substr($studio->weekend_open, 0, 5) ?? '00:00' }} – {{ substr($studio->weekend_close, 0, 5) ?? '00:00' }} WIB</span>
                            </li>
                            <li class="text-[10px] text-slate-400 italic mt-2">
                                *Jadwal dapat menyesuaikan agenda kegiatan UKMBSM / By Request.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. CAROUSEL FASILITAS --}}
        <section class="py-24">
            <div class="max-w-7xl mx-auto px-6">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <h2 class="text-3xl font-black text-[#0A192F] uppercase tracking-tighter">
                            Fasilitas & <span class="text-[#E63946]">Suasana</span>
                        </h2>
                        <p class="text-[#457B9D] font-bold tracking-[0.2em] uppercase text-xs mt-2">Explore Our Workspace
                        </p>
                    </div>

                    <div class="flex gap-3">
                        <button id="studio-prev"
                            class="h-12 w-12 flex items-center justify-center rounded-full border-2 border-slate-200 text-[#0A192F] hover:border-[#E63946] hover:text-[#E63946] transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <button id="studio-next"
                            class="h-12 w-12 flex items-center justify-center rounded-full border-2 border-slate-200 text-[#0A192F] hover:border-[#E63946] hover:text-[#E63946] transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                </div>

                <div id="studio-carousel"  class="flex gap-6 overflow-x-auto scroll-smooth snap-x snap-mandatory pb-6 no-scrollbar">
                    @forelse ($facilities as $index => $facility)
                        <div class="snap-start min-w-[260px] md:min-w-[320px]">
                            {{-- SHADOW WRAPPER --}}
                            <div
                                class="group rounded-xl transition-all duration-300 hover:shadow-xl hover:-translate-y-1">

                                {{-- CARD --}}
                                <div class="bg-white rounded-xl border border-slate-100 overflow-hidden">

                                    {{-- IMAGE --}}
                                    <div class="relative h-44 md:h-48 overflow-hidden">
                                        @if ($facility->image)
                                            <img
                                                src="{{ asset('storage/' . $facility->image) }}"
                                                alt="{{ $facility->nama }}"
                                                class="absolute inset-0 w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                            >
                                            <div class="absolute inset-0 bg-black/35"></div>
                                        @else
                                            <div
                                                class="absolute inset-0 bg-gradient-to-br from-[#0A192F] via-[#457B9D] to-[#E63946] opacity-65">
                                            </div>
                                        @endif

                                        <div
                                            class="relative z-10 h-full flex items-center justify-center text-white/70 text-[9px] font-black uppercase tracking-[0.25em]">
                                            Fasilitas {{ $index + 1 }}
                                        </div>
                                    </div>

                                    {{-- CONTENT --}}
                                    <div class="p-5">
                                        <p class="text-[9px] font-black text-[#457B9D] uppercase tracking-[0.25em] mb-1">
                                            Workspace
                                        </p>
                                        <h3
                                            class="text-lg font-bold text-[#0A192F] group-hover:text-[#E63946] transition-colors duration-300">
                                            {{ $facility->nama }}
                                        </h3>
                                        <p class="mt-2 text-xs text-slate-500 leading-relaxed line-clamp-3">
                                            {{ $facility->deskripsi }}
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="w-full py-16 text-center">
                            <p class="text-xs text-slate-400 italic">
                                Belum ada fasilitas yang tersedia saat ini.
                            </p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </div>

    <style>
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        @keyframes eq {

            0%,
            100% {
                height: 20%;
            }

            50% {
                height: 100%;
            }
        }

        .animate-eq-slow {
            animation: eq 1.2s ease-in-out infinite;
        }

        .animate-eq-fast {
            animation: eq 0.7s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const track = document.getElementById('studio-carousel');
            const prevBtn = document.getElementById('studio-prev');
            const nextBtn = document.getElementById('studio-next');

            if (!track) return;

            const scrollAmount = 432; // card width + gap

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
