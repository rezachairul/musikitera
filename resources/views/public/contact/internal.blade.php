<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Contact - Civitas ITERA Only</x-slot:title>

    {{-- Container Utama: Background Kertas Full 1 Halaman --}}
    <div class="relative min-h-screen bg-white py-8 md:py-16 overflow-hidden font-sans">

        {{-- Background Element: Garis Musik (Staff Lines) Full Page --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff-full" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff-full)" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 relative z-10">
            <div
                class="group bg-white rounded-[2.5rem] md:rounded-[3rem] shadow-2xl shadow-slate-200 border border-slate-100 overflow-hidden transition-all duration-700">

                {{-- Header Section --}}
                <div
                    class="px-6 md:px-12 py-4 md:py-6 border-b border-slate-50 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white/80 backdrop-blur-sm">
                    <div class="flex items-center gap-3">
                        <div class="relative flex h-3 w-3">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#457B9D] opacity-20"></span>
                            <span class="relative inline-flex rounded-full h-3 w-3 bg-[#0A192F]"></span>
                        </div>
                        <span
                            class="text-[10px] md:text-[11px] font-black tracking-[0.3em] md:tracking-[0.4em] text-[#457B9D] uppercase leading-none">
                            Civitas ITERA Only // Internal Track
                        </span>
                    </div>
                    <div
                        class="text-[9px] md:text-[10px] font-bold text-slate-300 tracking-widest uppercase italic text-center sm:text-right">
                        Music Unit Station // Institut Teknologi Sumatera
                    </div>
                </div>

                <div class="p-6 md:p-12">
                    <div
                        class="flex flex-col lg:flex-row items-center lg:items-start gap-8 lg:gap-0 transition-all duration-700">

                        {{-- Visual Animation (Vinyl & Box) --}}
                        <div
                            class="relative flex items-center justify-center lg:justify-start transition-all duration-700 ease-in-out w-full sm:w-[320px] lg:group-hover:w-[480px] shrink-0">
                            {{-- Square Box (Navy) --}}
                            <div
                                class="relative z-20 w-64 h-64 sm:w-80 sm:h-80 bg-[#0A192F] rounded-3xl shadow-2xl flex flex-col items-center justify-center border-4 border-white overflow-hidden shrink-0">
                                <h3
                                    class="text-white font-black text-2xl sm:text-3xl uppercase tracking-tighter z-10 italic">
                                    SERANA</h3>
                                <p
                                    class="text-[#457B9D] text-xs sm:text-sm font-bold tracking-[0.2em] mt-2 z-10 uppercase">
                                    For Revenge</p>
                                {{-- Equalizer --}}
                                <div class="absolute bottom-6 sm:bottom-8 flex gap-1.5 h-6 items-end z-10">
                                    <div class="w-1 bg-[#E63946] h-2 animate-bounce"></div>
                                    <div class="w-1 bg-[#457B9D] h-5 animate-bounce [animation-delay:0.2s]"></div>
                                    <div class="w-1 bg-white h-3 animate-bounce [animation-delay:0.4s]"></div>
                                    <div class="w-1 bg-[#E63946] h-6 animate-bounce [animation-delay:0.1s]"></div>
                                </div>
                            </div>
                            {{-- Vinyl --}}
                            <div
                                class="absolute z-10 left-1/2 -translate-x-1/2 lg:translate-x-0 lg:left-10 w-56 h-56 sm:w-72 sm:h-72 bg-[#121212] rounded-full border-[8px] sm:border-[10px] border-[#1a1a1a] shadow-xl transition-all duration-700 ease-in-out lg:group-hover:left-44 lg:group-hover:rotate-180 flex items-center justify-center">
                                <div
                                    class="w-16 h-16 sm:w-24 sm:h-24 rounded-full border-[1px] border-white/5 flex items-center justify-center">
                                    <div class="w-4 h-4 bg-[#E63946] rounded-full border border-white/10"></div>
                                </div>
                            </div>
                        </div>

                        {{-- Text & Contact Cards --}}
                        <div
                            class="flex-1 w-full lg:ml-10 flex flex-col justify-center transition-all duration-700 text-center lg:text-left">
                            <div class="max-w-xl mx-auto lg:mx-0">
                                <div class="flex flex-col items-center md:flex-row gap-4 mb-4 md:mb-6">
                                    <span
                                        class="text-[9px] md:text-[10px] font-black bg-[#0A192F] text-white px-3 py-1 rounded-full uppercase tracking-[0.2em] shrink-0">Internal
                                        Channel</span>
                                    <div class="h-[1px] w-full md:flex-1 bg-slate-100"></div>
                                </div>

                                <h2
                                    class="text-3xl md:text-5xl font-black text-[#0A192F] mb-4 md:mb-6 tracking-tighter leading-[0.9]">
                                    HUBUNGI<br class="hidden sm:block"> <span class="text-[#457B9D]">KAMI.</span></h2>

                                <p class="text-base md:text-lg text-slate-500 font-medium leading-relaxed mb-8">
                                    Punya ide kolaborasi atau ingin berbagi cerita musikmu?
                                    <span class="text-[#0A192F] font-bold">Suaramu adalah nada bagi kami.</span>
                                </p>

                                <div class="grid grid-cols-1 gap-3">
                                    {{-- Email & Instagram --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <a href="mailto:musikitera@gmail.com"
                                            class="p-4 rounded-2xl bg-slate-50 border-2 border-transparent hover:border-[#457B9D] hover:bg-white hover:shadow-lg transition-all flex items-center gap-4 group/item">
                                            <div
                                                class="p-2 bg-white rounded-lg shadow-sm text-[#457B9D] group-hover/item:bg-[#457B9D] group-hover/item:text-white transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <p
                                                    class="text-[8px] font-bold text-[#457B9D] uppercase tracking-widest">
                                                    Email Official</p>
                                                <h4 class="text-[#0A192F] font-bold text-sm">musikitera@gmail.com</h4>
                                            </div>
                                        </a>

                                        <a href="https://instagram.com/musikitera" target="_blank"
                                            class="p-4 rounded-2xl bg-slate-50 border-2 border-transparent hover:border-[#457B9D] hover:bg-white hover:shadow-lg transition-all flex items-center gap-4 group/item">
                                            <div
                                                class="p-2 bg-white rounded-lg shadow-sm text-[#457B9D] group-hover/item:bg-[#457B9D] group-hover/item:text-white transition-colors">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M7.5 2A5.5 5.5 0 002 7.5v9A5.5 5.5 0 007.5 22h9a5.5 5.5 0 005.5-5.5v-9A5.5 5.5 0 0016.5 2h-9zm0 2h9A3.5 3.5 0 0120 7.5v9a3.5 3.5 0 01-3.5 3.5h-9A3.5 3.5 0 014 16.5v-9A3.5 3.5 0 017.5 4zm9.75 1.25a.75.75 0 100 1.5.75.75 0 000-1.5zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z" />
                                                </svg>
                                            </div>
                                            <div class="text-left">
                                                <p
                                                    class="text-[8px] font-bold text-[#457B9D] uppercase tracking-widest">
                                                    Instagram</p>
                                                <h4 class="text-[#0A192F] font-bold text-sm">@musikitera</h4>
                                            </div>
                                        </a>
                                    </div>

                                    {{-- WhatsApp (Warna Konsisten Navy/Blue) --}}
                                    @forelse($kontakInternal as $item)
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item['no']) }}" target="_blank"
                                        class="p-4 rounded-2xl bg-slate-50 border-2 border-transparent hover:border-[#0A192F] hover:bg-white hover:shadow-lg transition-all flex items-center gap-4 group/item">
                                        <div
                                            class="p-2 bg-white rounded-lg shadow-sm text-[#0A192F] group-hover/item:bg-[#0A192F] group-hover/item:text-white transition-colors">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.412-.003 6.557-5.338 11.892-11.893 11.892-1.997-.001-3.951-.5-5.688-1.448l-6.309 1.656zm6.224-3.82c1.516.903 3.132 1.39 4.819 1.391 5.068 0 9.191-4.123 9.194-9.192.001-2.454-.954-4.759-2.687-6.493-1.728-1.734-4.032-2.69-6.486-2.69-5.068 0-9.192 4.123-9.194 9.191-.001 1.677.452 3.308 1.311 4.743l-.99 3.613 3.702-.971zm10.551-7.258c-.283-.141-1.674-.827-1.933-.922-.259-.094-.448-.141-.637.141-.188.283-.73.922-.896 1.11-.165.188-.33.212-.613.071-.283-.141-1.194-.44-2.276-1.408-.841-.75-1.408-1.676-1.573-1.959-.165-.283-.018-.435.124-.575.127-.126.283-.33.424-.495.141-.165.188-.283.283-.47.094-.188.047-.353-.024-.494-.071-.141-.637-1.532-.872-2.097-.229-.55-.47-.474-.637-.483-.164-.008-.353-.01-.542-.01s-.495.071-.754.353c-.259.283-.989.966-.989 2.356s1.013 2.734 1.154 2.922c.141.188 1.993 3.044 4.828 4.267.674.29 1.2.463 1.61.593.678.215 1.294.185 1.782.112.544-.081 1.674-.684 1.91-1.344.235-.659.235-1.226.165-1.344-.07-.118-.259-.188-.542-.329z" />
                                            </svg>
                                        </div>
                                        <div class="text-left">
                                            <p class="text-[8px] font-bold text-[#0A192F] uppercase tracking-widest">
                                                WhatsApp // {{ $item['nama'] ?? '-' }}
                                            </p>
                                            <h4 class="text-[#0A192F] font-bold text-sm">{{ $item['no'] ?? '-' }}</h4>
                                        </div>
                                    </a>
                                    @empty
                                        <p class="text-gray-500">Belum ada kontak eksternal.</p>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Player Footer --}}
                <div
                    class="px-6 md:px-12 py-6 md:py-8 bg-slate-50 border-t border-slate-100 flex flex-col md:flex-row items-center justify-between gap-6">
                    <div class="flex flex-col sm:flex-row items-center gap-6 md:gap-8">
                        <div class="flex items-center gap-4">
                            <button class="text-slate-300 hover:text-[#0A192F] transition"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M6 18V6h2v12H6zm3.5-6L18 6v12l-8.5-6z" />
                                </svg></button>
                            <button
                                class="w-10 h-10 md:w-12 md:h-12 bg-[#0A192F] text-white rounded-full flex items-center justify-center hover:bg-[#E63946] hover:scale-105 transition shadow-lg shadow-slate-200"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 md:h-6 md:w-6 ml-1"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z" />
                                </svg></button>
                            <button class="text-slate-300 hover:text-[#0A192F] transition"><svg
                                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor"
                                    viewBox="0 0 24 24">
                                    <path d="M16 18V6h2v12h-2zM6 18l8.5-6L6 6v12z" />
                                </svg></button>
                        </div>
                        <div class="hidden sm:block">
                            <div class="flex items-center gap-3 mb-1">
                                <span class="text-[10px] font-black text-[#0A192F]">03:42</span>
                                <div class="w-32 md:w-48 h-[2px] bg-slate-200 rounded-full relative">
                                    <div class="absolute top-0 left-0 h-full w-1/3 bg-[#E63946]"></div>
                                </div>
                                <span class="text-[10px] font-black text-slate-400">05:12</span>
                            </div>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <p class="text-[9px] md:text-[10px] font-black text-[#457B9D] uppercase tracking-widest mb-1">
                            Up Next</p>
                        <p class="text-xs md:text-sm font-bold text-[#0A192F] tracking-tight italic">Penyayaan — For
                            Revenge</p>
                    </div>
                </div>
            </div>

            <p
                class="text-center mt-8 text-[9px] md:text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em] md:tracking-[0.6em] px-4">
                Official Contact Channel // Unit Kegiatan Mahasiswa Seni Musik ITERA
            </p>
        </div>
    </div>
</x-public.layouts>
