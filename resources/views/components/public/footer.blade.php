<footer class="footer-denim relative mt-16 border-t-4 border-dashed border-white/40 overflow-hidden">

    {{-- vignette + noise overlay --}}
    <div class="pointer-events-none absolute inset-0 opacity-70 mix-blend-soft-light footer-denim-noise"></div>

    {{-- double stitch (white) --}}
    <div class="absolute top-1 left-0 w-full border-t border-white/40"></div>
    <div class="absolute top-2 left-0 w-full border-t border-white/20"></div>

    <div
        class="relative z-10 max-w-7xl mx-auto px-6 py-14 grid grid-cols-1 md:grid-cols-3 gap-10 text-center md:text-left text-slate-100">

        {{-- Logo + Nama --}}
        <div class="space-y-4">
            <div class="inline-block">
                <h3
                    class="text-3xl font-black uppercase tracking-tighter italic text-slate-50 drop-shadow-[0_4px_10px_rgba(0,0,0,0.7)]">
                    UKMBSM <span class="text-sky-300">ITERA</span>
                </h3>
                <div class="mt-1 h-[2px] w-full border-b-2 border-dashed border-white/70"></div>
            </div>

            <p class="text-sm text-slate-200/80 leading-relaxed font-medium">
                Unit Kegiatan Mahasiswa Bidang Seni Musik<br>
                <span class="text-slate-200/60 italic">Institut Teknologi Sumatera.</span>
            </p>

            {{-- rivets kiri-kanan --}}
            <div class="flex justify-center md:justify-start gap-3 pt-2">
                @foreach ([1, 2] as $i)
                    <div
                        class="w-4 h-4 rounded-full bg-gradient-to-br from-slate-200 to-slate-500 shadow-lg border border-slate-900 flex items-center justify-center">
                        <div class="w-1.5 h-1.5 rounded-full bg-slate-700"></div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Kontak --}}
        <div>
            <h3
                class="mb-6 flex items-center justify-center md:justify-start gap-2 text-sm font-bold uppercase tracking-[0.2em] text-sky-200">
                <span class="h-[2px] w-6 bg-white/60"></span> Kontak
            </h3>

            <div class="space-y-5 text-slate-100/90">
                <a href="https://maps.app.goo.gl/TQbgMF4HGSsdEwsY7" target="_blank"
                    class="group flex flex-col items-center md:flex-row md:items-start md:gap-4 hover:text-sky-200 transition-colors">
                    <div
                        class="p-2.5 bg-slate-950/70 rounded-md border border-white/20 group-hover:border-white/60 transition-colors shadow-inner">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 110-5 2.5 2.5 0 010 5z" />
                        </svg>
                    </div>
                    <div class="mt-2 md:mt-0 text-center md:text-left">
                        <span class="block text-sm font-semibold tracking-wide">Studio Musik ITERA</span>
                        <span class="text-[11px] text-slate-200/60 leading-snug uppercase tracking-[0.18em]">
                            Ruang D301, Gedung D Lantai 3
                        </span>
                    </div>
                </a>

                <a href="mailto:musikitera@gmail.com"
                    class="group mt-3 flex items-center justify-center md:justify-start gap-4 hover:text-sky-200 transition-colors">
                    <div
                        class="p-2.5 bg-slate-950/70 rounded-md border border-white/20 group-hover:border-white/60 transition-colors shadow-inner">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
                        </svg>
                    </div>
                    <span class="text-sm font-medium">musikitera@gmail.com</span>
                </a>
            </div>
        </div>

        {{-- Sosial Media --}}
        <div>
            <h3
                class="mb-6 flex items-center justify-center md:justify-start gap-2 text-sm font-bold uppercase tracking-[0.2em] text-sky-200">
                <span class="h-[2px] w-6 bg-white/60"></span> Media Sosial
            </h3>

            <div class="grid grid-cols-3 md:flex md:flex-col gap-4">
                @foreach ([
        [
            'url' => 'https://instagram.com/musikitera',
            'name' => 'Instagram',
            'icon' => 'M7.5 2A5.5 5.5 0 002 7.5v9A5.5 5.5 0 007.5 22h9a5.5 5.5 0 005.5-5.5v-9A5.5 5.5 0 0016.5 2h-9zm0 2h9A3.5 3.5 0 0120 7.5v9a3.5 3.5 0 01-3.5 3.5h-9A3.5 3.5 0 014 16.5v-9A3.5 3.5 0 017.5 4zm9.75 1.25a.75.75 0 100 1.5.75.75 0 000-1.5zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z',
        ],
        [
            'url' => 'https://www.youtube.com/@musikitera5519',
            'name' => 'YouTube',
            'icon' => 'M21.8 8s-.2-1.5-.8-2.2a3 3 0 00-2.2-.8C16.8 5 12 5 12 5s-4.8 0-6.8.2c-.8.1-1.6.3-2.2.8-.6.7-.8 2.2-.8 2.2S2 9.6 2 11.3v1.4c0 1.7.2 3.3.2 3.3s.2 1.5.8 2.2c.6.5 1.4.7 2.2.8C7.2 19 12 19 12 19s4.8 0 6.8-.2c.8-.1 1.6-.3 2.2-.8.6-.7.8-2.2.8-2.2s.2-1.6.2-3.3v-1.4c0-1.7-.2-3.3-.2-3.3zM10 9.8l5.2 3.2-5.2 3.2V9.8z',
        ],
        [
            'url' => 'https://www.tiktok.com/@musikitera',
            'name' => 'TikTok',
            'icon' => 'M12.44 2h3.21c.13 1.04.62 2 1.39 2.71.77.71 1.79 1.11 2.85 1.13v3.17a6.37 6.37 0 01-3.25-.9v6.58a6.5 6.5 0 11-6.5-6.5c.24 0 .47.02.7.05v3.29a3.27 3.27 0 103.27 3.27V2z',
        ],
    ] as $social)
                    <a href="{{ $social['url'] }}" target="_blank"
                        class="flex flex-col md:flex-row items-center gap-2 text-slate-100/80 hover:text-sky-200 transition-colors group">
                        <svg class="w-6 h-6 md:w-5 md:h-5 group-hover:scale-110 transition-transform"
                            fill="currentColor" viewBox="0 0 24 24">
                            <path d="{{ $social['icon'] }}" />
                        </svg>
                        <span
                            class="text-[10px] md:text-sm font-semibold uppercase tracking-[0.18em] md:tracking-normal md:normal-case">
                            {{ $social['name'] }}
                        </span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Bottom strip --}}
    <div class="relative border-top border-white/15 bg-slate-950/90 py-8 text-center px-4">

        {{-- “kancing” tengah = logo BSM --}}
        <div
            class="absolute -top-10 left-1/2 -translate-x-1/2 w-14 h-14 rounded-full bg-gradient-to-br from-slate-100 to-slate-500 border-2 border-slate-950 shadow-xl flex items-center justify-center">
            <div
                class="w-10 h-10 rounded-full bg-slate-950/90 border border-white/30 flex items-center justify-center overflow-hidden">
                <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM"
                    class="w-8 h-8 object-contain">
            </div>
        </div>

        <div class="text-[10px] text-slate-300/40 uppercase tracking-[0.32em] font-black">
            © {{ date('Y') }} UKMBSM ITERA • All Rights Reserved
        </div>

        <div class="mt-4 flex flex-wrap justify-center items-center gap-x-4 gap-y-2 text-xs">
            <span class="text-slate-300/30 italic">Maintained by:</span>
            <a href="https://cobradev.vercel.app/" target="_blank"
                class="font-semibold tracking-[0.18em] text-sky-200 hover:text-slate-50 transition-colors underline decoration-dotted underline-offset-4">
                COBRADEV
            </a>
            <span class="w-1 h-1 rounded-full bg-white/40"></span>
            <a href="https://sigawariweb.netlify.app/" target="_blank"
                class="font-semibold tracking-[0.18em] text-sky-200 hover:text-slate-50 transition-colors underline decoration-dotted underline-offset-4">
                SIGAWARI
            </a>
        </div>
    </div>
</footer>

<style>
    .footer-denim {
        /* navy denim base */
        background-color: #020617;
        background-image:
            linear-gradient(145deg, rgba(15, 23, 42, 0.97), rgba(2, 6, 23, 0.98)),
            repeating-linear-gradient(135deg, #020617 0, #020617 2px, #020617 2px, #0b1120 4px);
        background-blend-mode: overlay;
    }

    .footer-denim-noise {
        background-image:
            radial-gradient(circle at 0 0, rgba(148, 163, 184, 0.25) 0, transparent 55%),
            radial-gradient(circle at 100% 100%, rgba(15, 23, 42, 0.9) 0, transparent 55%),
            url("data:image/svg+xml,%3Csvg viewBox='0 0 160 160' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.5'/%3E%3C/svg%3E");
        background-size: cover, cover, 220px 220px;
    }
</style>
