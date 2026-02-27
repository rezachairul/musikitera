<section class="py-20 bg-[#0A192F] relative overflow-hidden">
    @php
        $oprec = $oprec ?? null;

        $status = null;
        if ($oprec && $oprec->is_active) {
            if (now()->lt($oprec->start_at)) {
                $status = 'coming_soon';
            } elseif (now()->between($oprec->start_at, $oprec->end_at)) {
                $status = 'open';
            } else {
                $status = 'closed';
            }
        }
    @endphp

    <div class="absolute inset-0 opacity-10 pointer-events-none" style="filter: url(#denim-noise-cta);">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
            <filter id="denim-noise-cta">
                <feTurbulence type="fractalNoise" baseFrequency="0.65" numOctaves="3" stitchTiles="stitch" />
                <feColorMatrix type="saturate" values="0" />
            </filter>
            <rect width="100%" height="100%" fill="white" />
        </svg>
    </div>

    <div class="max-w-4xl mx-auto px-6 relative z-10 text-center">
        {{-- Little Label --}}
        <div class="inline-flex items-center gap-3 mb-6">
            <span class="h-[1px] w-6 bg-[#E63946]"></span>
            <span class="text-[#A8DADC] text-[10px] font-black uppercase tracking-[0.4em]">Stay Connected</span>
            <span class="h-[1px] w-6 bg-[#E63946]"></span>
        </div>

        {{-- Flexible Headline --}}
        <h2 class="text-4xl md:text-6xl font-black text-white uppercase tracking-tighter leading-none mb-8">
            Jangan Sampai <br>
            <span class="text-transparent" style="-webkit-text-stroke: 1px #457B9D">Ketinggalan Info</span>
        </h2>

        <p class="text-slate-400 text-base md:text-lg mb-10 max-w-xl mx-auto leading-relaxed">
            Info recruitment, jadwal latihan bareng, hingga jadwal manggung terbaru semua kami update melalui media
            sosial. Pastikan kamu sudah follow untuk info lebih lanjut!
        </p>

        {{-- Buttons --}}
        <div class="flex flex-col items-center gap-6">

            {{-- Top Buttons (2 Cols) --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                {{-- Instagram --}}
                <a href="https://www.instagram.com/musikitera/" target="_blank"
                    class="group relative px-8 py-4 bg-[#E63946] rounded-xl overflow-hidden transition-all duration-300 hover:scale-105 active:scale-95 shadow-xl text-center">
                    <span class="relative z-10 text-white font-black uppercase tracking-widest flex items-center justify-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 fill-current" viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                        Follow Instagram
                    </span>
                </a>

                {{-- Hubungi Kami --}}
                <a href="mailto:official@ukmbsmitera.com"
                    class="px-8 py-4 bg-white/5 border border-white/10 rounded-xl text-white font-black uppercase tracking-widest hover:bg-white/10 transition-all text-center">
                    Hubungi Kami
                </a>
            </div>

            {{-- Bottom Center: Open Recruitment --}}
            @if($oprec && $oprec->is_active)
                @if($status === 'coming_soon')
                    <div class="px-10 py-4 border border-yellow-400/30 bg-yellow-400/10 rounded-xl text-yellow-300 font-black uppercase tracking-widest text-center">
                        Open Recruitment (Segera Dibuka)
                        <div class="text-xs font-normal mt-1" id="oprec-countdown"
                            data-start="{{ \Carbon\Carbon::parse($oprec->start_at)->timestamp }}">
                        </div>
                    </div>

                @elseif($status === 'open')
                    <a href="{{ route('cta.form') }}" target="_blank"
                        class="px-10 py-4 bg-[#1D3557] border border-[#457B9D] rounded-xl text-white font-black uppercase tracking-widest hover:bg-[#27496D] transition-all">
                        Open Recruitment (Dibuka)
                    </a>

                @elseif($status === 'closed')
                    <div class="px-10 py-4 border border-gray-500/30 bg-gray-500/10 rounded-xl text-gray-400 font-black uppercase tracking-widest cursor-not-allowed text-center">
                        Open Recruitment (Ditutup)
                    </div>
                @endif
            @endif

        </div>

    </div>

    {{-- Watermark --}}
    <div
        class="absolute -bottom-10 right-10 text-[10rem] font-black text-white/[0.03] select-none pointer-events-none uppercase">
        UKMBSM ITERA
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const el = document.getElementById("oprec-countdown");
            if (!el) return;

            const startTimestamp = parseInt(el.dataset.start) * 1000;

            function updateCountdown() {
                const now = new Date().getTime();
                const diff = startTimestamp - now;

                if (diff <= 0) {
                    el.innerHTML = "Segera Dibuka";
                    return;
                }

                const days = Math.floor(diff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((diff / (1000 * 60 * 60)) % 24);
                const minutes = Math.floor((diff / (1000 * 60)) % 60);

                el.innerHTML = `Dibuka dalam ${days}h ${hours}j ${minutes}m`;
            }

            updateCountdown();
            setInterval(updateCountdown, 60000);
        });
    </script>
</section>
