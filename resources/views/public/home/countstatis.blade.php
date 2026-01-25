<section id="counter" class="bg-white py-24 relative overflow-hidden">
    {{-- Garis Dekoratif Industrial di bagian atas --}}
    <div class="absolute top-0 left-0 w-full h-[1px] bg-gradient-to-r from-transparent via-slate-200 to-transparent">
    </div>

    <div class="max-w-7xl mx-auto px-6">
        {{-- Header Section --}}
        <div class="text-center mb-20">
            <div class="inline-flex items-center justify-center gap-3 mb-4">
                <span class="h-[2px] w-8 bg-[#E63946]"></span>
                <span class="text-[#457B9D] text-[10px] font-black uppercase tracking-[0.5em]">Our Track Record</span>
                <span class="h-[2px] w-8 bg-[#E63946]"></span>
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter">
                Statistik <span class="text-[#457B9D]">BSM</span>
            </h2>
        </div>

        {{-- Grid Counter --}}
        <div class="grid grid-cols-2 md:grid-cols-4 gap-12 md:gap-8 relative">

            <div class="relative flex flex-col items-center">
                <div class="mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Members</div>
                <div class="flex items-baseline">
                    <h2 class="counter text-5xl md:text-7xl font-black text-[#E63946] tracking-tighter" data-target="{{ $totalAnggota }}">{
                        { $totalAnggota }}
                    </h2>
                    <span class="text-2xl font-black text-[#E63946] ml-1">+</span>
                </div>
                <p class="mt-4 text-xs font-black text-[#0A192F] uppercase tracking-[0.2em] opacity-60">Anggota</p>
                {{-- Divider Vertical (Hanya muncul di desktop) --}}
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 w-[1px] h-12 bg-slate-100"></div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Board Directors</div>
                <div class="flex items-baseline">
                    <h2 class="counter text-5xl md:text-7xl font-black text-[#0A192F] tracking-tighter" data-target="{{ $totalPengurus }}">
                        {{ $totalPengurus }}
                    </h2>
                </div>
                <p class="mt-4 text-xs font-black text-[#0A192F] uppercase tracking-[0.2em] opacity-60">Badan Pengurus</p>
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 w-[1px] h-12 bg-slate-100"></div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Music Catalog</div>
                <div class="flex items-baseline">
                    <h2 class="counter text-5xl md:text-7xl font-black text-[#E63946] tracking-tighter" data-target="30">
                        0
                    </h2>
                    <span class="text-2xl font-black text-[#E63946] ml-1">+</span>
                </div>
                <p class="mt-4 text-xs font-black text-[#0A192F] uppercase tracking-[0.2em] opacity-60">Karya Musik</p>
                <div class="hidden md:block absolute -right-4 top-1/2 -translate-y-1/2 w-[1px] h-12 bg-slate-100"></div>
            </div>

            <div class="relative flex flex-col items-center">
                <div class="mb-2 text-[10px] font-bold text-slate-400 uppercase tracking-widest">Global Partners</div>
                <div class="flex items-baseline">
                    <h2 class="counter text-5xl md:text-7xl font-black text-[#0A192F] tracking-tighter" data-target="{{ $totalMitras }}">
                        {{ $totalMitras }}
                    </h2>
                </div>
                <p class="mt-4 text-xs font-black text-[#0A192F] uppercase tracking-[0.2em] opacity-60">Kolaborasi</p>
            </div>

        </div>

        {{-- Garis Dekoratif Industrial di bagian bawah --}}
        <div class="mt-20 flex justify-center gap-1">
            <div class="w-12 h-1 bg-[#E63946]"></div>
            <div class="w-4 h-1 bg-slate-200"></div>
            <div class="w-2 h-1 bg-slate-100"></div>
        </div>
    </div>
</section>
