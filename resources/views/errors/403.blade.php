<x-errors.layouts>
    <x-slot:title>{{ $title ?? '403 - Akses Ditolak' }}</x-slot:title>

    <div class="min-h-screen flex items-center justify-center relative overflow-hidden"
        style="
            background-color: #050a1a; 
            background-image: 
                linear-gradient(rgba(5, 10, 26, 0.85), rgba(5, 10, 26, 0.85)),
                url('data:image/svg+xml,%3Csvg viewBox=%220 0 200 200%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cfilter id=%22noiseFilter%22%3E%3CfeTurbulence type=%22fractalNoise%22 baseFrequency=%220.8%22 numOctaves=%224%22 stitchTiles=%22stitch%22/%3E%3C/filter%3E%3Crect width=%22100%25%22 height=%22100%25%22 filter=%22url(%23noiseFilter)%22/%3E%3C/svg%3E'),
                repeating-linear-gradient(45deg, #0d1733 0, #0d1733 1px, transparent 0, transparent 50%);
            background-size: cover, 120px 120px, 2px 2px;
         ">

        {{-- Overlay Tekstur Kedalaman (Vignette) --}}
        <div class="absolute inset-0 pointer-events-none opacity-60"
            style="background: radial-gradient(circle, transparent 20%, #000 150%);"></div>

        <div class="relative z-10 text-center px-6 py-12 max-w-lg w-full">

            {{-- Frame Denim (Ala Saku Kemeja) --}}
            <div
                class="bg-black/20 backdrop-blur-sm border-2 border-dashed border-amber-700/50 p-10 rounded-xl shadow-2xl relative">

                {{-- Konten Utama --}}
                <h1 class="text-8xl font-black text-white italic tracking-tighter opacity-90"
                    style="text-shadow: 4px 4px 0px #b45309;">403</h1>

                <div class="h-1 w-full border-b-2 border-dashed border-amber-600/40 my-6"></div>

                <p class="text-2xl font-bold text-amber-500 uppercase tracking-widest italic">Akses Ditolak 🎤</p>
                <p class="text-blue-100/60 mt-4 leading-relaxed italic">
                    "We're just pretending..." <br>
                    Kamu mencoba masuk ke panggung yang salah. Kamu tidak punya izin di area ini.
                </p>

                {{-- Tombol Kembali --}}
                <a href="{{ url('/') }}"
                    class="mt-10 inline-block px-8 py-3 bg-amber-700 text-white font-black uppercase tracking-widest rounded-sm hover:bg-amber-600 transition-all transform hover:scale-105 shadow-xl border-b-4 border-amber-900">
                    Kembali Ke Backstage
                </a>

                {{-- Music Info --}}
                <div
                    class="mt-8 flex items-center justify-center gap-2 text-amber-600/40 text-[10px] uppercase font-bold tracking-[0.2em]">
                    <svg class="animate-pulse w-3 h-3" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12 3v10.55c-.59-.34-1.27-.55-2-.55-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4V7h4V3h-6z" />
                    </svg>
                    Now Playing: Just Pretend - Bad Omens
                </div>
            </div>
        </div>

        {{-- Audio Element --}}
        <audio id="bgMusic" loop>
            <source src="{{ asset('music/just-pretend.mp3') }}" type="audio/mpeg">
            Your browser does not support the audio element.
        </audio>
    </div>

</x-errors.layouts>
