<x-public.layouts>
    <x-slot:title>Alumni</x-slot:title>

    <section class="bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Dekorasi Garis Musik (Background) --}}
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-[0.03] pointer-events-none">
            <svg viewBox="0 0 100 100" class="w-full h-full text-[#0A192F]">
                <path d="M0 20 L100 20 M0 30 L100 30 M0 40 L100 40 M0 50 L100 50 M0 60 L100 60" fill="none"
                    stroke="currentColor" stroke-width="0.5" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">

            {{-- HEADER --}}
            <div class="mb-12 md:mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Hall of Fame
                    </span>
                </div>

                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Alumni <span class="text-[#457B9D]">UKM Seni Musik</span> ITERA
                </h1>

                <p class="mt-4 text-slate-500 max-w-2xl text-sm md:text-base font-medium leading-relaxed">
                    Daftar alumni UKMBSM ITERA dari berbagai angkatan. Jejak langkah dan kontribusi yang membangun
                    harmoni seni di kampus tercinta.
                </p>
            </div>

            {{-- FILTER BOX --}}
            <div class="bg-slate-50 p-6 md:p-8 rounded-3xl mb-12 border border-slate-100 shadow-sm">
                <form method="GET" class="grid md:grid-cols-12 gap-4">
                    <div class="md:col-span-7">
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-[#457B9D] mb-2 px-1">Cari
                            Nama</label>
                        <input type="text" name="q" value="{{ request('q') }}"
                            placeholder="Contoh: Budi Darmawan"
                            class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm focus:ring-2 focus:ring-[#457B9D] focus:border-transparent transition-all">
                    </div>

                    <div class="md:col-span-2">
                        <label
                            class="block text-[10px] font-black uppercase tracking-widest text-[#457B9D] mb-2 px-1">Tahun
                            Lulus</label>
                        <input type="text" name="tahun" value="{{ request('tahun') }}" placeholder="2024"
                            class="w-full rounded-xl border-slate-200 bg-white px-4 py-3 text-sm focus:ring-2 focus:ring-[#457B9D] focus:border-transparent transition-all text-center">
                    </div>

                    <div class="md:col-span-3 flex items-end gap-2">
                        <button type="submit"
                            class="flex-1 rounded-xl bg-[#0A192F] text-white px-4 py-3 text-xs font-black uppercase tracking-widest hover:bg-[#E63946] transition-colors duration-300 shadow-lg shadow-blue-900/10">
                            Filter
                        </button>

                        <a href="{{ url()->current() }}"
                            class="rounded-xl border-2 border-slate-200 bg-white text-slate-500 p-3 hover:text-[#E63946] hover:border-[#E63946] transition-all">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </a>
                    </div>
                </form>
            </div>

            {{-- INFO COUNT --}}
            <div class="mb-6 flex items-center justify-between border-b border-slate-100 pb-4">
                <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">
                    Menampilkan
                    <span class="text-[#0A192F]">{{ $alumnis->firstItem() ?? 0 }}–{{ $alumnis->lastItem() ?? 0 }}</span>
                    dari <span class="text-[#0A192F]">{{ $alumnis->total() ?? 0 }}</span> Personel
                </div>
            </div>

            {{-- GRID LIST --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse ($alumnis as $alumni)
                    @php
                        $nama = $alumni->anggota->nama ?? 'Tanpa Nama';
                        $initials = collect(explode(' ', $nama))
                            ->filter()
                            ->take(2)
                            ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
                            ->join('');
                    @endphp

                    <div
                        class="group bg-white rounded-2xl border border-slate-100 p-6 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 relative overflow-hidden">
                        {{-- Hover Accent Line --}}
                        <div
                            class="absolute left-0 top-0 bottom-0 w-0 group-hover:w-1.5 bg-[#E63946] transition-all duration-300">
                        </div>

                        <div class="flex gap-5 items-start">
                            {{-- Avatar Placeholder --}}
                            <div class="flex-shrink-0">
                                <div
                                    class="h-16 w-16 rounded-2xl bg-[#457B9D] flex items-center justify-center font-black text-white text-xl shadow-inner group-hover:bg-[#0A192F] transition-colors">
                                    {{ $initials ?: 'A' }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex flex-col gap-1">
                                    @if ($alumni->tahun_lulus)
                                        <span
                                            class="w-fit text-[9px] font-black px-2 py-0.5 rounded bg-[#E63946] text-white uppercase tracking-widest">
                                            Class of {{ $alumni->tahun_lulus }}
                                        </span>
                                    @endif

                                    <h2
                                        class="text-lg font-black text-[#0A192F] truncate leading-tight group-hover:text-[#457B9D] transition-colors">
                                        {{ $nama }}
                                    </h2>
                                </div>

                                <div class="mt-4 relative">
                                    <svg class="absolute -top-2 -left-2 h-4 w-4 text-slate-100 group-hover:text-red-50 transition-colors"
                                        fill="currentColor" viewBox="0 0 32 32">
                                        <path
                                            d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
                                    </svg>

                                    @if ($alumni->quote)
                                        <p
                                            class="text-sm text-slate-500 font-medium leading-relaxed italic line-clamp-3 pl-4">
                                            {{ $alumni->quote }}
                                        </p>
                                    @else
                                        <p class="text-xs text-slate-300 italic pl-4">
                                            No testimonial shared.
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full py-12 px-6 rounded-3xl border-2 border-dashed border-slate-200 flex flex-col items-center justify-center text-center">
                        <div
                            class="h-16 w-16 bg-slate-50 rounded-full flex items-center justify-center mb-4 text-slate-300">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-sm font-black text-[#0A192F] uppercase tracking-widest">Data Tidak Ditemukan
                        </h3>
                        <p class="text-xs text-slate-400 mt-1">Gunakan kata kunci atau tahun yang berbeda.</p>
                    </div>
                @endforelse
            </div>

            {{-- PAGINATION --}}
            <div class="mt-16 alumni-pagination">
                {{ $alumnis->links() }}
            </div>

        </div>
    </section>

    <style>
        /* Styling untuk pagination agar selaras dengan tema */
        .alumni-pagination nav {
            justify-content: center;
        }

        .alumni-pagination span[aria-current="page"]>span {
            background-color: #0A192F !important;
            border-color: #0A192F !important;
        }

        .alumni-pagination a:hover {
            color: #E63946 !important;
        }
    </style>
</x-public.layouts>
