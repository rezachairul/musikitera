{{-- resources/views/public/activity.blade.php --}}
<x-public.layouts>
    <x-slot:title>Kegiatan UKM Seni Musik</x-slot:title>

    @php
        $activities = [
            [
                'title' => 'Latihan Rutin',
                'subtitle' => 'THE DAILY RHYTHM',
                'description' =>
                    'Sesi asah skill mingguan untuk setiap divisi (vokal, gitar, bass, drum, keyboard). Di sini kita belajar teknik dasar hingga improvisasi bersama.',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" /></svg>',
                'image' =>
                    'https://images.unsplash.com/photo-1511735111819-9a3f7709049c?auto=format&fit=crop&q=80&w=800',
                'color' => '#457B9D',
            ],
            [
                'title' => 'Bahas Musik Bareng',
                'subtitle' => 'SHARING SESSION',
                'description' =>
                    'Ruang diskusi santai tentang teori musik, bedah lirik, hingga perkembangan industri musik terkini. Tempat bertukar referensi lagu!',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>',
                'image' =>
                    'https://images.unsplash.com/photo-1525362035658-c13005cc290c?auto=format&fit=crop&q=80&w=800',
                'color' => '#E63946',
            ],
            [
                'title' => 'Jamming Session',
                'subtitle' => 'FREE EXPRESSION',
                'description' =>
                    'Sesi improvisasi tanpa batasan. Gabungan antar divisi untuk menciptakan nada baru secara spontan di studio kebanggaan kita.',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.536 8.464a5 5 0 010 7.072m2.828-9.9a9 9 0 010 12.728M5.586 15H4a1 1 0 01-1-1v-4a1 1 0 011-1h1.586l4.707-4.707C10.923 3.663 12 4.109 12 5v14c0 .891-1.077 1.337-1.707.707L5.586 15z" /></svg>',
                'image' =>
                    'https://images.unsplash.com/photo-1514525253361-bee8718a342b?auto=format&fit=crop&q=80&w=800',
                'color' => '#0A192F',
            ],
            [
                'title' => 'Masterclass & Workshop',
                'subtitle' => 'SKILL UPGRADE',
                'description' =>
                    'Mengundang musisi profesional untuk berbagi ilmu teknis yang mendalam, mulai dari sound engineering hingga manajemen panggung.',
                'icon' =>
                    '<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" /></svg>',
                'image' =>
                    'https://images.unsplash.com/photo-1516280440614-37939bbacd81?auto=format&fit=crop&q=80&w=800',
                'color' => '#457B9D',
            ],
        ];
    @endphp

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Background Pattern --}}
        <div class="absolute top-0 right-0 w-1/3 h-full opacity-[0.02] pointer-events-none">
            <svg viewBox="0 0 100 100" class="w-full h-full text-[#0A192F]">
                <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="0.1" fill="none" />
                <circle cx="50" cy="50" r="30" stroke="currentColor" stroke-width="0.1" fill="none" />
                <circle cx="50" cy="50" r="20" stroke="currentColor" stroke-width="0.1" fill="none" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            {{-- HEADER --}}
            <div class="mb-20 text-center md:text-left">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Inside the Studio</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Ritme <span class="text-[#457B9D]">Harian</span>
                </h1>
                <p class="mt-6 text-slate-500 max-w-xl text-sm md:text-base font-medium leading-relaxed">
                    Lebih dari sekadar bermain alat musik, kami membangun komunitas lewat berbagai aktivitas kreatif
                    yang mengasah jiwa seni dan kebersamaan.
                </p>
            </div>

            {{-- ACTIVITIES GRID --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                @foreach ($activities as $act)
                    <div class="group relative">
                        <div class="flex flex-col md:flex-row gap-8 items-start">
                            {{-- Image Square --}}
                            <div
                                class="w-full md:w-48 h-48 flex-shrink-0 relative overflow-hidden rounded-[2.5rem] shadow-xl">
                                <img src="{{ $act['image'] }}" alt="{{ $act['title'] }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div
                                    class="absolute inset-0 bg-[#0A192F]/20 group-hover:bg-transparent transition-colors">
                                </div>
                            </div>

                            {{-- Text Content --}}
                            <div class="flex-1">
                                <div class="mb-4 flex items-center justify-between md:justify-start gap-4">
                                    <div
                                        class="p-3 bg-slate-50 rounded-2xl text-[#0A192F] group-hover:bg-[#E63946] group-hover:text-white transition-all duration-300">
                                        {!! $act['icon'] !!}
                                    </div>
                                    <span
                                        class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 group-hover:text-[#457B9D]">
                                        {{ $act['subtitle'] }}
                                    </span>
                                </div>
                                <h3 class="text-2xl font-black text-[#0A192F] uppercase tracking-tighter mb-3">
                                    {{ $act['title'] }}
                                </h3>
                                <p class="text-slate-500 text-sm leading-relaxed mb-4">
                                    {{ $act['description'] }}
                                </p>
                                <div
                                    class="h-1 w-12 bg-slate-100 group-hover:w-24 group-hover:bg-[#E63946] transition-all duration-500">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- CTA / JOIN SECTION --}}
            <div class="mt-32 p-12 bg-[#0A192F] rounded-[3rem] relative overflow-hidden text-center">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                        <defs>
                            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="0.5" />
                            </pattern>
                        </defs>
                        <rect width="100%" height="100%" fill="url(#grid)" />
                    </svg>
                </div>

                <div class="relative z-10">
                    <h2 class="text-3xl md:text-4xl font-black text-white uppercase tracking-tighter mb-6">
                        Ingin Menjadi Bagian dari <span class="text-[#A8DADC]">Simfoni</span> Kami?
                    </h2>
                    <p class="text-white/70 text-sm md:text-base max-w-2xl mx-auto mb-10 font-medium">
                        Apapun instrumenmu, atau bahkan jika kamu baru ingin mulai belajar, pintu studio kami selalu
                        terbuka untuk talenta baru.
                    </p>
                    <a href="#"
                        class="inline-flex items-center gap-4 px-10 py-5 bg-[#E63946] text-white rounded-2xl font-black uppercase tracking-widest hover:scale-105 hover:shadow-2xl hover:shadow-[#E63946]/40 transition-all">
                        Hubungi Pengurus
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-public.layouts>
