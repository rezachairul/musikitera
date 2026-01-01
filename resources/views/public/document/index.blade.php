<x-public.layouts>
    <x-slot:title>Dokumen</x-slot:title>

    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            {{-- Header Section --}}
            <div class="text-center mb-10">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Dokumen
                </span>
                <p class="mt-3 text-gray-600">
                    Halaman ini memuat dokumen penting seperti panduan, proposal, dan laporan kegiatan
                    yang dapat diakses melalui Google Drive.
                </p>
            </div>

            @php
                // Dummy dokumen
                $documents = [
                    [
                        'title' => 'Panduan Umum Anggota UKM Seni Musik',
                        'summary' => 'Gambaran singkat mengenai hak, kewajiban, dan etika bagi anggota UKM.',
                        'description' =>
                            'Dokumen ini berisi penjelasan lengkap mengenai aturan dasar keanggotaan, tata tertib latihan, serta kebijakan internal yang harus dipahami oleh seluruh anggota.',
                        'drive_url' => 'https://drive.google.com/file/d/xxxxxxxxxxxxxxxxxxxx/view',
                    ],
                    [
                        'title' => 'Proposal Kegiatan Konser Akhir Tahun',
                        'summary' => 'Rancangan acara konser penutup tahun periode kepengurusan berjalan.',
                        'description' =>
                            'Meliputi konsep acara, susunan panitia, rundown singkat, kebutuhan peralatan, serta estimasi anggaran yang dibutuhkan untuk pelaksanaan konser akhir tahun.',
                        'drive_url' => 'https://drive.google.com/file/d/yyyyyyyyyyyyyyyyyyyy/view',
                    ],
                    [
                        'title' => 'Laporan Pertanggungjawaban Workshop Vokal',
                        'summary' => 'Ringkasan pelaksanaan workshop vokal beserta evaluasi dan rekomendasi.',
                        'description' =>
                            'Memuat data peserta, dokumentasi kegiatan, penilaian keberhasilan acara, dan masukan untuk penyelenggaraan workshop serupa di masa mendatang.',
                        'drive_url' => 'https://drive.google.com/file/d/zzzzzzzzzzzzzzzzzzzz/view',
                    ],
                ];
            @endphp

            {{-- Main Content --}}
            <div class="grid lg:grid-cols-3 gap-6">
                @foreach ($documents as $doc)
                    <article
                        class="group overflow-hidden rounded-2xl bg-white shadow-md hover:shadow-lg transition-all duration-300 flex flex-col justify-between p-6">
                        <div>
                            <h3
                                class="text-lg font-bold text-slate-900 mb-2 group-hover:text-blue-600 transition-colors line-clamp-2">
                                {{ $doc['title'] }}
                            </h3>
                            <p class="text-sm text-slate-700 mb-3 line-clamp-2">
                                {{ $doc['summary'] }}
                            </p>
                            <p class="text-sm text-slate-500 leading-relaxed line-clamp-3">
                                {{ $doc['description'] }}
                            </p>
                        </div>
                        <div class="mt-5">
                            <a href="{{ $doc['drive_url'] }}" target="_blank" rel="noopener"
                                class="inline-flex items-center justify-center gap-2 w-full px-4 py-2.5 rounded-xl bg-blue-600 text-white text-sm font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300 focus:ring-offset-1 transition-all">
                                Lihat di Drive
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path d="M14 3h7v7" />
                                    <path d="M10 14 21 3" />
                                    <path d="M5 5v16h16" />
                                </svg>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>

            {{-- Decorative Elements --}}
            <div
                class="fixed top-20 right-10 w-72 h-72 bg-blue-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none">
            </div>
            <div class="fixed bottom-20 left-10 w-72 h-72 bg-purple-200 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse pointer-events-none"
                style="animation-delay: 2s;"></div>
        </div>
    </div>
</x-public.layouts>
