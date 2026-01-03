{{-- resources/views/public/announcements/show.blade.php --}}
<x-public.layouts>
    <x-slot:title>{{ $announcement['judul'] ?? 'Detail Pengumuman' }}</x-slot:title>

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Background Element: Music Lines --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.02] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- BREADCRUMB & BACK BUTTON --}}
            <div class="mb-10 flex items-center justify-between">
                <a href="/pengumuman"
                    class="group flex items-center gap-3 text-[#0A192F] font-black text-xs uppercase tracking-widest">
                    <span
                        class="w-10 h-10 rounded-full border-2 border-slate-100 flex items-center justify-center group-hover:bg-[#E63946] group-hover:border-[#E63946] group-hover:text-white transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" />
                        </svg>
                    </span>
                    Kembali ke Warta
                </a>
                <span class="hidden md:block text-slate-300 text-[10px] font-black uppercase tracking-[0.5em]">Musik
                    Untuk Semua</span>
            </div>

            <div class="grid lg:grid-cols-12 gap-16">

                {{-- MAIN CONTENT (Left - 8 Columns) --}}
                <div class="lg:col-span-8">
                    <article>
                        {{-- Meta --}}
                        <div class="flex items-center gap-4 mb-6">
                            <span
                                class="px-4 py-1.5 bg-[#457B9D]/10 text-[#457B9D] text-[10px] font-black uppercase tracking-widest rounded-lg">
                                {{ $announcement['category'] ?? 'Event' }}
                            </span>
                            <span
                                class="text-slate-400 text-[10px] font-bold uppercase">{{ $announcement['date'] ?? '04 Januari 2026' }}</span>
                        </div>

                        {{-- Title --}}
                        <h1
                            class="text-4xl md:text-6xl font-black text-[#0A192F] uppercase tracking-tighter leading-[0.9] mb-10">
                            {{ $announcement['judul'] ?? 'Open Recruitment: Kabinet Daniswara 2026' }}
                        </h1>

                        {{-- Main Image --}}
                        <div class="relative rounded-[2.5rem] overflow-hidden mb-12 shadow-2xl">
                            <img src="{{ $announcement['image'] ?? 'https://images.unsplash.com/photo-1514525253361-bee8718a342b?auto=format&fit=crop&q=80&w=1200' }}"
                                alt="Main Cover" class="w-full aspect-video object-cover">
                            <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/20 to-transparent"></div>
                        </div>

                        {{-- Article Body --}}
                        <div class="prose prose-slate max-w-none">
                            <p class="text-xl text-slate-600 leading-relaxed font-medium mb-6 italic">
                                "Sinergi dalam melodi, bergerak dalam harmoni. Kami mengundang seluruh insan kreatif
                                ITERA untuk menjadi bagian dari perjalanan besar ini."
                            </p>

                            <div class="text-slate-700 leading-relaxed space-y-6 text-lg">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum ante ipsum primis
                                    in faucibus orci luctus et ultrices posuere cubilia curae; Sed efficitur, leo vel
                                    varius scelerisque, diam enim fffringilla diam, a finibus erat sem ut tellus.</p>

                                <h3 class="text-2xl font-black text-[#0A192F] uppercase tracking-tight mt-10">
                                    Persyaratan Umum</h3>
                                <ul class="list-disc pl-6 space-y-2">
                                    <li>Mahasiswa aktif ITERA (Semua Jurusan).</li>
                                    <li>Memiliki minat tinggi di bidang seni musik atau manajemen organisasi.</li>
                                    <li>Berkomitmen penuh selama satu periode kepengurusan.</li>
                                    <li>Mampu bekerja sama dalam tim (Musik Untuk Semua!).</li>
                                </ul>

                                <div class="bg-slate-50 p-8 rounded-3xl border-l-8 border-[#E63946] my-10">
                                    <p class="font-bold text-[#0A192F] mb-2 uppercase tracking-widest text-sm">Penting:
                                    </p>
                                    <p class="italic text-slate-600">Pendaftaran ditutup pada tanggal 20 Januari 2026.
                                        Pastikan seluruh berkas telah diunggah melalui portal resmi UKMBSM.</p>
                                </div>

                                <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                    fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa
                                    qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                        </div>

                        {{-- Share / Footer Article --}}
                        <div
                            class="mt-16 pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-6">
                            <div class="flex items-center gap-4">
                                <span
                                    class="text-[10px] font-black uppercase text-slate-400 tracking-widest">Bagikan:</span>
                                <div class="flex gap-2">
                                    <button
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center hover:bg-[#457B9D] hover:text-white transition-all text-slate-400">FB</button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center hover:bg-[#E63946] hover:text-white transition-all text-slate-400">IG</button>
                                    <button
                                        class="w-10 h-10 rounded-full bg-slate-50 flex items-center justify-center hover:bg-[#0A192F] hover:text-white transition-all text-slate-400">WA</button>
                                </div>
                            </div>
                            <div class="text-[10px] font-black text-[#E63946] uppercase tracking-[0.3em]">
                                #MusikUntukSemua</div>
                        </div>
                    </article>
                </div>

                {{-- SIDEBAR / PREVIEW OTHER (Right - 4 Columns) --}}
                <div class="lg:col-span-4">
                    <div class="sticky top-24 space-y-10">

                        {{-- Section Heading --}}
                        <div>
                            <h3
                                class="text-xs font-black text-[#0A192F] uppercase tracking-[0.4em] mb-6 flex items-center gap-3">
                                <span class="w-2 h-2 bg-[#E63946] rounded-full animate-pulse"></span>
                                Pengumuman Lainnya
                            </h3>

                            <div class="space-y-8">
                                @php
                                    $others = [
                                        [
                                            'judul' => 'Workshop Produksi Musik Digital 2026',
                                            'date' => '02 Jan 2026',
                                            'img' =>
                                                'https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?q=80&w=400',
                                        ],
                                        [
                                            'judul' => 'Update Inventaris Alat Musik Studio B',
                                            'date' => '30 Des 2025',
                                            'img' =>
                                                'https://images.unsplash.com/photo-1511379938547-c1f69419868d?q=80&w=400',
                                        ],
                                        [
                                            'judul' => 'Hasil Audisi Vokal Grup Angkatan 2025',
                                            'date' => '25 Des 2025',
                                            'img' =>
                                                'https://images.unsplash.com/photo-1516280440614-37939bbacd81?q=80&w=400',
                                        ],
                                    ];
                                @endphp

                                @foreach ($others as $item)
                                    <a href="#" class="group flex gap-4 items-start">
                                        <div class="w-24 h-20 rounded-2xl overflow-hidden flex-shrink-0 shadow-sm">
                                            <img src="{{ $item['img'] }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div class="flex-1">
                                            <h4
                                                class="text-sm font-black text-[#0A192F] uppercase leading-tight group-hover:text-[#457B9D] transition-colors line-clamp-2">
                                                {{ $item['judul'] }}
                                            </h4>
                                            <p class="text-[10px] text-slate-400 font-bold mt-2 uppercase">
                                                {{ $item['date'] }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>

                        {{-- PROMO BOX / CALL TO ACTION --}}
                        <div class="bg-[#0A192F] p-8 rounded-[2rem] relative overflow-hidden group">
                            <div
                                class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform">
                                <svg width="120" height="120" viewBox="0 0 24 24" fill="white">
                                    <path
                                        d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" />
                                </svg>
                            </div>
                            <p class="text-[#E63946] text-[10px] font-black uppercase tracking-widest mb-2">Join Our
                                Community</p>
                            <h4 class="text-white text-xl font-black uppercase tracking-tighter mb-4">Ingin karyamu
                                didengar?</h4>
                            <p class="text-white/60 text-xs leading-relaxed mb-6 italic">Karena melodi terbaik lahir
                                dari kebersamaan. Musik Untuk Semua.</p>
                            <a href="#"
                                class="inline-block w-full py-3 bg-white text-[#0A192F] text-center text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-[#457B9D] hover:text-white transition-all">Hubungi
                                Kami</a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-public.layouts>
