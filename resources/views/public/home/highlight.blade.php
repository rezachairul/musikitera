<section class="py-16 bg-white relative overflow-hidden">
    {{-- Background Texture --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
        style="background-image: url('https://www.transparenttextures.com/patterns/denim.png');"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        {{-- Header Section --}}
        <div class="text-center mb-10">
            <div class="inline-flex items-center justify-center gap-3 mb-2">
                <span class="h-[1px] w-6 bg-[#E63946]"></span>
                <span class="text-[#457B9D] text-[9px] font-black uppercase tracking-[0.4em]">The Spotlight</span>
                <span class="h-[1px] w-6 bg-[#E63946]"></span>
            </div>
            <h2 class="text-3xl md:text-4xl font-black text-[#0A192F] uppercase tracking-tighter">
                Highlight <span class="text-[#457B9D]">Kegiatan</span>
            </h2>
        </div>

        {{-- Grid Highlights - Kompak --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @forelse ($highlights as $i => $highlight)
                <div class="group relative bg-[#0A192F] rounded-2xl overflow-hidden shadow-lg transition-all duration-500 h-[280px] animate-fade-up"
                    style="animation-delay: {{ ($i + 1) * 0.1 }}s; animation-fill-mode: both;">

                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $highlight->poster) }}"
                        class="w-full h-full object-cover opacity-70 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700 grayscale group-hover:grayscale-0"
                        alt="Highlight {{ $highlight->nama_kegiatan }}">

                    {{-- Denim Overlay --}}
                    <div class="absolute inset-0 opacity-20 mix-blend-overlay pointer-events-none group-hover:opacity-0 transition-opacity"
                        style="background-image: url('https://www.transparenttextures.com/patterns/denim.png');"></div>

                    {{-- Gradient Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-[#0A192F] via-[#0A192F]/40 to-transparent"></div>

                    {{-- Content --}}
                    <div class="absolute inset-0 p-6 flex flex-col justify-end">
                        <div class="overflow-hidden mb-2">
                            <span
                                class="inline-block px-2 py-0.5 bg-[#E63946] text-white text-[8px] font-black tracking-widest uppercase transform -translate-x-full group-hover:translate-x-0 transition-transform duration-500">
                                {{ $highlight->kategori }} • {{ $highlight->time_label }}
                            </span>
                        </div>

                        <h3 class="text-white font-black text-xl uppercase tracking-tighter leading-none mb-2">
                            <span class="text-[#457B9D]">{{ $highlight->nama_kegiatan }}</span>
                        </h3>
                        <h4 class="text-slate-200 text-sm font-medium mb-2">{{ \Carbon\Carbon::parse($highlight->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($highlight->tanggal_selesai)->format('d M Y') }} | {{ $highlight->lokasi }}</h4>

                        {{-- Deskripsi pendek --}}
                        <p
                            class="text-slate-300 text-[11px] leading-snug opacity-0 group-hover:opacity-100 transition-opacity duration-500 line-clamp-2 mb-4">
                            {{ str($highlight->deskripsi)->limit(50) }}
                        </p>

                        {{-- Link --}}
                        <a href="#"
                            class="inline-flex items-center gap-2 text-white text-[9px] font-black uppercase tracking-widest hover:text-[#E63946] transition-colors opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            View Event
                            <span class="w-4 h-[1px] bg-current"></span>
                        </a>
                    </div>

                    {{-- Decorative Number (Lebih kecil) --}}
                    <div
                        class="absolute top-2 right-4 text-white/5 font-black text-5xl select-none group-hover:text-[#E63946]/10 transition-colors">
                        0{{ $i + 1 }}
                    </div>
                </div>
            @empty
                <p class="col-span-full text-center text-gray-500 italic">Tidak ada kegiatan yang di-highlight saat ini.</p>
            @endforelse
        </div>
    </div>
</section>
