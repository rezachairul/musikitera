{{-- resources/views/public/activity.blade.php --}}
<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Kegiatan UKM Seni Musik</x-slot:title>

    <div class="min-h-screen bg-white py-16 md:py-24 relative overflow-hidden">
        {{-- Background Element: Garis Musik (Staff Lines) Full Page --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff-full-activity" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff-full-activity)" />
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
                                <img src="{{ asset('storage/' . $act->poster) }}" alt="{{ $act->nama_kegiatan }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div
                                    class="absolute inset-0 bg-[#0A192F]/20 group-hover:bg-transparent transition-colors">
                                </div>
                            </div>

                            {{-- Text Content --}}
                            <div class="flex-1">
                                <div class="mb-4 flex items-center justify-between md:justify-start gap-4">
                                    @php
                                        $icons = [
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m9 9 10.5-3m0 6.553v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 1 1-.99-3.467l2.31-.66a2.25 2.25 0 0 0 1.632-2.163Zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 0 1-1.632 2.163l-1.32.377a1.803 1.803 0 0 1-.99-3.467l2.31-.66A2.25 2.25 0 0 0 9 15.553Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m3.75 7.5 16.5-4.125M12 6.75c-2.708 0-5.363.224-7.948.655C2.999 7.58 2.25 8.507 2.25 9.574v9.176A2.25 2.25 0 0 0 4.5 21h15a2.25 2.25 0 0 0 2.25-2.25V9.574c0-1.067-.75-1.994-1.802-2.169A48.329 48.329 0 0 0 12 6.75Zm-1.683 6.443-.005.005-.006-.005.006-.005.005.005Zm-.005 2.127-.005-.006.005-.005.005.005-.005.005Zm-2.116-.006-.005.006-.006-.006.005-.005.006.005Zm-.005-2.116-.006-.005.006-.005.005.005-.005.005ZM9.255 10.5v.008h-.008V10.5h.008Zm3.249 1.88-.007.004-.003-.007.006-.003.004.006Zm-1.38 5.126-.003-.006.006-.004.004.007-.006.003Zm.007-6.501-.003.006-.007-.003.004-.007.006.004Zm1.37 5.129-.007-.004.004-.006.006.003-.004.007Zm.504-1.877h-.008v-.007h.008v.007ZM9.255 18v.008h-.008V18h.008Zm-3.246-1.87-.007.004L6 16.127l.006-.003.004.006Zm1.366-5.119-.004-.006.006-.004.004.007-.006.003ZM7.38 17.5l-.003.006-.007-.003.004-.007.006.004Zm-1.376-5.116L6 12.38l.003-.007.007.004-.004.007Zm-.5 1.873h-.008v-.007h.008v.007ZM17.25 12.75a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Zm0 4.5a.75.75 0 1 1 0-1.5.75.75 0 0 1 0 1.5Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.114 5.636a9 9 0 0 1 0 12.728M16.463 8.288a5.25 5.25 0 0 1 0 7.424M6.75 8.25l4.72-4.72a.75.75 0 0 1 1.28.53v15.88a.75.75 0 0 1-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.009 9.009 0 0 1 2.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                                            </svg>',
                                            '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="m15.75 10.5 4.72-4.72a.75.75 0 0 1 1.28.53v11.38a.75.75 0 0 1-1.28.53l-4.72-4.72M4.5 18.75h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25h-9A2.25 2.25 0 0 0 2.25 7.5v9a2.25 2.25 0 0 0 2.25 2.25Z" />
                                            </svg>',
                                        ];

                                        $randomIcon = $icons[array_rand($icons)];
                                    @endphp

                                    <div class="p-3 bg-slate-50 rounded-2xl text-[#0A192F] group-hover:bg-[#E63946] group-hover:text-white transition-all duration-300">
                                        <!-- Icons -->
                                        {!! $randomIcon !!}
                                    </div>
                                    <span class="text-[10px] font-black uppercase tracking-[0.3em] text-slate-400 group-hover:text-[#457B9D]">
                                        {{ $act->kategori }} • {{ $act->time_label }}
                                    </span>
                                </div>
                                <h3 class="text-2xl font-black text-[#0A192F] uppercase tracking-tighter mb-3">
                                    {{ $act->nama_kegiatan}}
                                </h3>
                                <h4 class="text-slate-700 text-sm font-medium mb-2">{{ \Carbon\Carbon::parse($act->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($act->tanggal_selesai)->format('d M Y') }} | {{ $act->lokasi }}</h4>
                                <p class="text-slate-500 text-sm text-justify leading-relaxed mb-4 mt-4">
                                    {{ $act->deskripsi }}
                                </p>
                                <div
                                    class="h-1 w-12 bg-slate-100 group-hover:w-24 group-hover:bg-[#E63946] transition-all duration-500">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <!-- Jika Tidak ada Kegiatan -->
                @php
                    $visibleActivities = $activities->whereNotIn('status', ['draft']);
                @endphp

                @if ($visibleActivities->isEmpty())
                    <div class="col-span-1 md:col-span-2 text-center py-12">
                        <p class="text-slate-500 italic">Tidak ada kegiatan yang tersedia saat ini.</p>
                    </div>
                @endif
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
