<nav class="bg-white shadow sticky top-0 z-50">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
        {{-- Logo + Nama + Tagline --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM"
                class="h-12 w-12 object-contain">
            <div class="flex flex-col leading-tight">
                <a href="/" class="text-xl font-black text-[#0A192F] tracking-tighter uppercase">UKMBSM ITERA</a>
                <a href="/" class="text-[10px] font-black text-[#E63946] tracking-[0.3em] uppercase mt-0.5">
                    #AsikinAja
                </a>
            </div>
        </div>

        {{-- Hamburger Button (MOBILE) --}}
        <button id="nav-menu-toggle" class="md:hidden focus:outline-none relative w-8 h-8" type="button"
            aria-controls="nav-mobile-menu" aria-expanded="false">
            <svg id="nav-icon-hamburger" class="absolute inset-0 h-8 w-8 text-gray-700 transition-all duration-300"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg id="nav-icon-close"
                class="absolute inset-0 h-8 w-8 text-gray-700 opacity-0 scale-75 transition-all duration-300"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex items-center space-x-8 text-[11px] font-black uppercase tracking-widest relative">
            <a href="/" class="text-[#0A192F] hover:text-[#E63946] transition-colors">Home</a>

            {{-- Tentang Kami --}}
            <div class="group relative py-2">
                <button class="text-[#0A192F] group-hover:text-[#E63946] flex items-center gap-1 transition-colors">
                    Tentang Kami
                    <svg class="w-3 h-3 transition-transform group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 top-full hidden w-64 pt-4 group-hover:flex flex-col animate-fadeIn z-50">
                    <div
                        class="bg-white shadow-[0_15px_40px_rgba(0,0,0,0.15)] rounded-xl border-t-4 border-[#E63946] overflow-hidden">
                        <a href="/profil"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Profil
                        </a>
                        <a href="/sejarah"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Sejarah
                        </a>
                        <a href="/pengurus"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Badan Pengurus
                        </a>
                        <a href="/pengawas"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Dewan Pengawas
                        </a>
                        <a href="/alumni"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Alumni
                        </a>
                        <a href="/studio"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Studio Musik
                        </a>
                    </div>
                </div>
            </div>

            <a href="/galeri" class="text-[#0A192F] hover:text-[#E63946] transition-colors">Galeri</a>

            {{-- Berita --}}
            <div class="group relative py-2">
                <button class="text-[#0A192F] group-hover:text-[#E63946] flex items-center gap-1 transition-colors">
                    Berita
                    <svg class="w-3 h-3 transition-transform group-hover:rotate-180" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 top-full hidden w-56 pt-4 group-hover:flex flex-col animate-fadeIn z-50">
                    <div
                        class="bg-white shadow-[0_15px_40px_rgba(0,0,0,0.15)] rounded-xl border-t-4 border-[#E63946] overflow-hidden">
                        <a href="/pengumuman"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Pengumuman Penting
                        </a>
                        <a href="/kegiatan"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Kegiatan
                        </a>
                        <a href="/dokumen"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Dokumen
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="group relative py-2">
                <button
                    class="bg-[#0A192F] text-white px-5 py-2 rounded-full hover:bg-[#E63946] transition-all shadow-md">
                    Kontak
                </button>
                <div class="absolute right-0 top-full hidden w-44 pt-4 group-hover:flex flex-col animate-fadeIn z-50">
                    <div
                        class="bg-white shadow-[0_15px_40px_rgba(0,0,0,0.15)] rounded-xl border-t-4 border-[#E63946] overflow-hidden">
                        <a href="/kontak/internal"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  border-b border-slate-50 hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Internal
                        </a>
                        <a href="/kontak/eksternal"
                            class="block px-6 py-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#0A192F]
                                  hover:bg-slate-50 hover:text-[#E63946] transition-all duration-200">
                            Eksternal
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MENU MOBILE: SIDEBAR --}}
    <div id="nav-mobile-backdrop"
        class="fixed inset-0 bg-black/40 opacity-0 pointer-events-none transition-opacity duration-300 md:hidden"></div>

    <div id="nav-mobile-menu"
        class="fixed inset-y-0 right-0 w-72 max-w-[80%] bg-white shadow-2xl transform translate-x-full
                transition-transform duration-300 md:hidden flex flex-col text-[11px] font-black uppercase tracking-[0.25em] text-[#0A192F]">

        {{-- header sidebar --}}
        <div class="flex items-center justify-between px-4 py-3 border-b border-slate-100">
            <span class="text-xs tracking-[0.3em] text-slate-500">Menu</span>
            <button type="button" id="nav-mobile-close" class="p-1 text-slate-600" aria-label="Close menu">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <div class="px-4 py-4 space-y-3 overflow-y-auto">

            <a href="/" class="block py-2 border-b border-slate-100">Home</a>

            {{-- Tentang Kami mobile --}}
            <div>
                <button type="button" class="w-full flex items-center justify-between py-2 border-b border-slate-100"
                    data-submenu-toggle="nav-mobile-about-menu">
                    <span>Tentang Kami</span>
                    <svg class="w-3 h-3 transition-transform" data-submenu-icon="nav-mobile-about-menu"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="nav-mobile-about-menu" class="mt-1 ml-3 space-y-1 hidden">
                    <a href="/profil" class="block py-1 text-[10px] tracking-[0.25em]">Profil</a>
                    <a href="/sejarah" class="block py-1 text-[10px] tracking-[0.25em]">Sejarah</a>
                    <a href="/pengurus" class="block py-1 text-[10px] tracking-[0.25em]">Badan Pengurus</a>
                    <a href="/pengawas" class="block py-1 text-[10px] tracking-[0.25em]">Dewan Pengawas</a>
                    <a href="/alumni" class="block py-1 text-[10px] tracking-[0.25em]">Alumni</a>
                    <a href="/studio" class="block py-1 text-[10px] tracking-[0.25em]">Studio Musik</a>
                </div>
            </div>

            <a href="/galeri" class="block py-2 border-b border-slate-100">Galeri</a>

            {{-- Berita mobile --}}
            <div>
                <button type="button" class="w-full flex items-center justify-between py-2 border-b border-slate-100"
                    data-submenu-toggle="nav-mobile-news-menu">
                    <span>Berita</span>
                    <svg class="w-3 h-3 transition-transform" data-submenu-icon="nav-mobile-news-menu" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="nav-mobile-news-menu" class="mt-1 ml-3 space-y-1 hidden">
                    <a href="/pengumuman" class="block py-1 text-[10px] tracking-[0.25em]">Pengumuman Penting</a>
                    <a href="/kegiatan" class="block py-1 text-[10px] tracking-[0.25em]">Kegiatan</a>
                    <a href="/dokumen" class="block py-1 text-[10px] tracking-[0.25em]">Dokumen</a>
                </div>
            </div>

            {{-- Kontak mobile --}}
            <div>
                <button type="button" class="w-full flex items-center justify-between py-2 border-b border-slate-100"
                    data-submenu-toggle="nav-mobile-contact-menu">
                    <span>Kontak</span>
                    <svg class="w-3 h-3 transition-transform" data-submenu-icon="nav-mobile-contact-menu"
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div id="nav-mobile-contact-menu" class="mt-1 ml-3 space-y-1 hidden">
                    <a href="/kontak/internal" class="block py-1 text-[10px] tracking-[0.25em]">Internal</a>
                    <a href="/kontak/eksternal" class="block py-1 text-[10px] tracking-[0.25em]">Eksternal</a>
                </div>
            </div>

        </div>
    </div>
</nav>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.2s ease-out forwards;
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleBtn = document.getElementById('nav-menu-toggle');
        const closeBtn = document.getElementById('nav-mobile-close');
        const mobileMenu = document.getElementById('nav-mobile-menu');
        const backdrop = document.getElementById('nav-mobile-backdrop');
        const iconHamburger = document.getElementById('nav-icon-hamburger');
        const iconClose = document.getElementById('nav-icon-close');
        const body = document.body;

        if (!toggleBtn || !mobileMenu || !backdrop || !iconHamburger || !iconClose) return;

        function isMenuOpen() {
            return !mobileMenu.classList.contains('translate-x-full');
        }

        function openMenu() {
            if (isMenuOpen()) return;
            mobileMenu.classList.remove('translate-x-full');
            backdrop.classList.remove('opacity-0', 'pointer-events-none');
            iconHamburger.classList.add('opacity-0', 'scale-75');
            iconClose.classList.remove('opacity-0', 'scale-75');
            body.classList.add('overflow-hidden');
            toggleBtn.setAttribute('aria-expanded', 'true');
        }

        function closeMenu() {
            if (!isMenuOpen()) return;
            mobileMenu.classList.add('translate-x-full');
            backdrop.classList.add('opacity-0', 'pointer-events-none');
            iconHamburger.classList.remove('opacity-0', 'scale-75');
            iconClose.classList.add('opacity-0', 'scale-75');
            body.classList.remove('overflow-hidden');
            toggleBtn.setAttribute('aria-expanded', 'false');
        }

        toggleBtn.addEventListener('click', () => {
            if (isMenuOpen()) closeMenu();
            else openMenu();
        });

        if (closeBtn) closeBtn.addEventListener('click', closeMenu);
        backdrop.addEventListener('click', closeMenu);

        // Tutup menu kalau klik link di dalam sidebar
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', closeMenu);
        });

        // ESC untuk tutup
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeMenu();
        });

        // Toggle submenu (Tentang Kami / Berita / Kontak)
        document.querySelectorAll('[data-submenu-toggle]').forEach(btn => {
            btn.addEventListener('click', () => {
                const targetId = btn.getAttribute('data-submenu-toggle');
                if (!targetId) return;
                const submenu = document.getElementById(targetId);
                const icon = document.querySelector(`[data-submenu-icon="${targetId}"]`);
                if (!submenu) return;

                const hidden = submenu.classList.contains('hidden');
                submenu.classList.toggle('hidden', !hidden);
                if (icon) icon.classList.toggle('rotate-180', hidden);
            });
        });
    });
</script>
