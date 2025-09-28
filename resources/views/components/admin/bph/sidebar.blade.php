<div class="w-64 bg-white shadow-lg text-gray-800 flex flex-col h-screen">
    {{-- Header (Logo + Nama + Tagline) --}}
    <div class="p-5 shrink-0">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" 
                 alt="Logo UKMBSM" 
                 class="h-12 w-12 object-contain">
            <div class="flex flex-col leading-tight">
                <a href="/" class="text-xl font-bold text-gray-800">UKMBSM ITERA</a>
                <a href="/" class="text-sm italic text-gray-600 tracking-wide">#AsikinAja</a>
            </div>
        </div>
    </div>

    {{-- Navigation (scrollable) --}}
    <nav class="flex-1 overflow-y-auto p-5 space-y-2" x-data="{ openMenu: null }">
        <!-- Dashboard -->
        <a href="{{ route('bph.dashboard.index') }}" 
           class="relative flex items-center gap-3 px-3 py-2 rounded-md transition-colors
           {{ request()->routeIs('bph.dashboard.index') ? 'bg-gray-200 text-amber-600' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md 
                {{ request()->routeIs('bph.dashboard.index') ? 'bg-amber-600' : '' }}">
            </span>
            <!-- Heroicon: Home -->
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75M4.5 10.5v9a1.5 1.5 0 001.5 1.5H9V15h6v6h3a1.5 1.5 0 001.5-1.5v-9"/>
            </svg>
            <span class="font-medium text-left">Dashboard</span>
        </a>

        <hr>

        <!-- Manajemen Anggota -->
        <div>
            <button @click="openMenu = (openMenu === 'anggota' ? null : 'anggota')" class="w-full flex items-center justify-between px-3 py-2 rounded-md transition-colors{{ request()->routeIs('anggota-*') || request()->routeIs('manage-badan-pengurus.*') || request()->routeIs('alumni.*') || request()->routeIs('manage-pembina.*') ? 'bg-gray-100 text-amber-600 font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
                <div class="flex items-center gap-3">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg>
                    <span class="font-medium text-left">Manajemen Anggota</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 transition-transform" 
                    :class="{ 'rotate-180': openMenu === 'anggota' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openMenu === 'anggota'" x-cloak class="ml-10 flex flex-col gap-1 mt-1">
                <a href="{{ route('anggota-aktif.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('anggota-aktif.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Anggota
                </a>
                <a href="{{ route('manage-badan-pengurus.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('manage-badan-pengurus.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Badan Pengurus
                </a>
                <a href="{{ route('manage-alumni.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('alumni.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Alumni
                </a>
                <a href="{{ route('manage-pembina.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('manage-pembina.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Pembina
                </a>
            </div>
        </div>
        
        <!-- Manajemen Konten -->
        <div>
            <button @click="openMenu = (openMenu === 'konten' ? null : 'konten')" class="w-full flex items-center justify-between px-3 py-2 rounded-md transition-colors {{ request()->routeIs('manage-hero.*') || request()->routeIs('profil.*') || request()->routeIs('layanan.*') || request()->routeIs('statistik.*') || request()->routeIs('galeri.*') || request()->routeIs('highlight.*') || request()->routeIs('testimoni.*') || request()->routeIs('cta-oprec.*') ? 'bg-gray-100 text-amber-600 font-medium' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
                
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
                    </svg>
                    <span class="font-medium text-left">Manajemen Konten</span>
                </div>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 transition-transform" :class="{ 'rotate-180': openMenu === 'konten' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openMenu === 'konten'" x-cloak class="ml-10 flex flex-col gap-1 mt-1">                
                <a href="{{ route('manage-hero.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('manage-hero.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Hero
                </a>

                <a href="{{ route('manage-profile.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('profil.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Profil Organisasi
                </a>

                <a href="{{ route('manage-layanan.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('layanan.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Layanan
                </a>

                <a href="{{ route('statistik.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('statistik.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Statistik Publik
                </a>

                <a href="{{ route('galeri.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('galeri.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Galeri Kegiatan
                </a>

                <a href="{{ route('highlight.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('highlight.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Highlight Kegiatan
                </a>

                <a href="{{ route('testimoni.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('testimoni.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Apa Kata Mereka
                </a>

                <a href="{{ route('cta-oprec.index') }}"
                    class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('cta-oprec.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    CTA Oprec
                </a>
            </div>
        </div>
        
        <!-- Publikasi dan Informasi -->
        <div>
            <button @click="openMenu = (openMenu === 'publikasi' ? null : 'publikasi')" class="w-full flex items-center justify-between px-3 py-2 rounded-md transition-colors {{ request()->routeIs('dokumen.*') || request()->routeIs('kegiatan.*') || request()->routeIs('pengumuman.*')  ? 'bg-gray-100 text-amber-600 font-medium'  : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
                <div class="flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                    </svg>
                    <span class="font-medium text-left">Publikasi dan Informasi</span>
                </div>
                
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 transition-transform" :class="{ 'rotate-180': openMenu === 'publikasi' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openMenu === 'publikasi'" x-cloak 
                class="ml-10 flex flex-col gap-1 mt-1">                
                <a href="{{ route('manage-dokumen.index') }}" class="px-3 py-1 rounded-md transition-colors  {{ request()->routeIs('dokumen.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Dokumen
                </a>
                <a href="{{ route('manage-kegiatan.index') }}" class="px-3 py-1 rounded-md transition-colors  {{ request()->routeIs('kegiatan.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Kegiatan
                </a>
                <a href="{{ route('manage-pengumuman.index') }}" class="px-3 py-1 rounded-md transition-colors  {{ request()->routeIs('pengumuman.*') ? 'text-amber-600 font-medium bg-gray-100' : 'text-gray-600 hover:text-amber-600' }}">
                    Pengumuman Penting
                </a>
            </div>
        </div>
        
        <!-- Kerjasama & Mitra -->
        <div>
            <button @click="openMenu = (openMenu === 'mitra' ? null : 'mitra')" class="w-full flex items-center justify-between px-3 py-2 rounded-md transition-colors{{ request()->routeIs('manage-mitra*') || request()->routeIs('manage-kerjasama.*') ? 'bg-gray-100 text-amber-600 font-semibold' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
                <div class="flex items-center gap-3">
                    <!-- icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                    </svg>
                    <span class="font-medium text-left">Kerjasama & Mitra</span>
                </div>
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 transition-transform" 
                    :class="{ 'rotate-180': openMenu === 'mitra' }" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>

            <div x-show="openMenu === 'mitra'" x-cloak class="ml-10 flex flex-col gap-1 mt-1">
                <a href="{{ route('manage-kerjasama.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('manage-kerjasama.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Kerjasama
                </a>
                <a href="{{ route('manage-mitra.index') }}" class="px-3 py-1 rounded-md transition-colors {{ request()->routeIs('manage-mitra.*')  ? 'bg-gray-200 text-amber-600 font-medium'  : 'text-gray-600 hover:text-amber-600' }}">
                    Mitra
                </a>
            </div>
        </div>
    </nav>
</div>
