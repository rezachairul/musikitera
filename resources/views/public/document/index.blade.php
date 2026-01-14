<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Dokumen</x-slot:title>

    @php
        // Dummy dokumen
        $documents = [
            [
                'title' => 'Panduan Umum Anggota UKM Seni Musik',
                'category' => 'PEDOMAN',
                'summary' => 'Gambaran singkat mengenai hak, kewajiban, dan etika bagi anggota UKM.',
                'description' =>
                    'Dokumen ini berisi penjelasan lengkap mengenai aturan dasar keanggotaan, tata tertib latihan, serta kebijakan internal.',
                'drive_url' => 'https://drive.google.com/file/d/xxxxxxxx/view',
                'type' => 'PDF',
            ],
            [
                'title' => 'Proposal Kegiatan Konser Akhir Tahun',
                'category' => 'PROPOSAL',
                'summary' => 'Rancangan acara konser penutup tahun periode kepengurusan berjalan.',
                'description' =>
                    'Meliputi konsep acara, susunan panitia, rundown singkat, kebutuhan peralatan, serta estimasi anggaran.',
                'drive_url' => 'https://drive.google.com/file/d/yyyyyyyy/view',
                'type' => 'DOCX',
            ],
            [
                'title' => 'Laporan Pertanggungjawaban Workshop Vokal',
                'category' => 'LAPORAN',
                'summary' => 'Ringkasan pelaksanaan workshop vokal beserta evaluasi dan rekomendasi.',
                'description' =>
                    'Memuat data peserta, dokumentasi kegiatan, penilaian keberhasilan acara, dan masukan untuk masa mendatang.',
                'drive_url' => 'https://drive.google.com/file/d/zzzzzzzz/view',
                'type' => 'PDF',
            ],
            // Tambahkan dokumen lainnya...
        ];
    @endphp

    <div class="relative min-h-screen bg-white py-8 md:py-16 overflow-hidden font-sans">
        {{-- Background Element: Garis Musik (Staff Lines) Full Page --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff-full-document" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff-full-document)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- HEADER SECTION --}}
            <div class="mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Resource Center</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Pustaka <span class="text-[#457B9D]">Arsip</span>
                </h1>
                <p class="mt-4 text-slate-500 max-w-2xl text-sm md:text-base font-medium leading-relaxed">
                    Akses cepat ke seluruh berkas administratif, panduan operasional, dan dokumentasi tertulis UKM Seni
                    Musik ITERA melalui integrasi Google Drive.
                </p>
            </div>

            {{-- SEARCH & FILTER (Simplified) --}}
            <div class="flex flex-col md:flex-row gap-4 mb-12">
                <div class="relative flex-1">
                    <input type="text" placeholder="Cari judul dokumen..."
                        class="w-full pl-12 pr-6 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 text-slate-900 focus:bg-white focus:border-[#457B9D] transition-all outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-6 py-4 bg-[#0A192F] text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-[#E63946] transition-colors">Semua</button>
                    <button
                        class="px-6 py-4 bg-white border-2 border-slate-100 text-slate-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:border-[#457B9D] hover:text-[#457B9D] transition-all">Terbaru</button>
                </div>
            </div>

            {{-- DOCUMENT GRID --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($documents as $doc)
                    <article
                        class="group bg-white rounded-[2rem] border-2 border-slate-100 p-8 hover:border-[#457B9D] hover:shadow-2xl hover:shadow-[#457B9D]/10 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">

                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <span
                                    class="px-4 py-1.5 bg-slate-100 text-slate-500 text-[10px] font-black uppercase tracking-widest rounded-lg group-hover:bg-[#457B9D] group-hover:text-white transition-colors">
                                    {{ $doc['category'] }}
                                </span>
                                <div class="flex items-center gap-1">
                                    <span
                                        class="text-[10px] font-bold text-slate-400 uppercase tracking-tighter">{{ $doc['type'] }}</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-slate-300"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                            </div>

                            <h3
                                class="text-xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight mb-4 group-hover:text-[#457B9D] transition-colors line-clamp-2">
                                {{ $doc['title'] }}
                            </h3>

                            <p class="text-[#E63946] text-xs font-bold mb-3 uppercase tracking-wider italic">
                                {{ $doc['summary'] }}
                            </p>

                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8">
                                {{ $doc['description'] }}
                            </p>
                        </div>

                        <a href="{{ $doc['drive_url'] }}" target="_blank"
                            class="flex items-center justify-center gap-3 w-full py-4 bg-slate-50 text-[#0A192F] text-xs font-black uppercase tracking-[0.2em] rounded-xl group-hover:bg-[#0A192F] group-hover:text-white transition-all duration-300">
                            Buka di Drive
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </article>
                @endforeach
            </div>

            {{-- EMPTY STATE (Jika nanti dinamis) --}}
            @if (count($documents) == 0)
                <div class="py-20 text-center border-2 border-dashed border-slate-100 rounded-[2rem]">
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Arsip belum tersedia saat ini.
                    </p>
                </div>
            @endif

        </div>
    </div>
</x-public.layouts>
