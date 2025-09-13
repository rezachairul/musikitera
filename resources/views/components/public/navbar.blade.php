<nav class="bg-white shadow sticky top-0 z-50">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
        {{-- Logo + Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM" class="h-10 w-10 object-contain">
            <a href="/" class="text-lg font-bold text-gray-800">UKMBSM ITERA</a>
        </div>

        {{-- Hamburger Button (mobile only) --}}
        <!-- Toggle Button -->
        <button id="menu-toggle" class="md:hidden focus:outline-none relative w-8 h-8">
            <!-- Icon Hamburger -->
            <svg id="icon-hamburger" xmlns="http://www.w3.org/2000/svg"
                class="absolute inset-0 h-8 w-8 text-gray-700 transition-all duration-300 ease-in-out"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6h16M4 12h16M4 18h16" />
            </svg>

            <!-- Icon X -->
            <svg id="icon-close" xmlns="http://www.w3.org/2000/svg"
                class="absolute inset-0 h-8 w-8 text-gray-700 opacity-0 scale-75 transition-all duration-300 ease-in-out"
                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        {{-- Menu Desktop --}}
        <div class="hidden md:flex space-x-6 font-medium relative">
            <a href="/" class="text-gray-700 hover:text-yellow-600">Home</a>

            {{-- Tentang Kami --}}
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Tentang Kami
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 pt-2 hidden w-52 bg-white shadow-lg rounded-lg group-hover:flex flex-col dropdown-menu animate-fadeIn">
                    <a href="/profil" class="block px-4 py-2 hover:bg-yellow-100 first:rounded-t-lg">Profil</a>
                    <a href="/sejarah" class="block px-4 py-2 hover:bg-yellow-100">Sejarah</a>
                    <a href="/pengurus" class="block px-4 py-2 hover:bg-yellow-100">Badan Pengurus</a>
                    <a href="/pengawas" class="block px-4 py-2 hover:bg-yellow-100">Dewan Pengawas</a>
                    <a href="/studio" class="block px-4 py-2 hover:bg-yellow-100 last:rounded-b-lg">Studio Musik</a>
                </div>
            </div>

            <a href="/galeri" class="text-gray-700 hover:text-yellow-600">Galeri</a>

            {{-- Berita --}}
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Berita
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 pt-2 hidden w-52 bg-white shadow-lg rounded-lg group-hover:flex flex-col dropdown-menu animate-fadeIn">
                    <a href="/pengumuman" class="block px-4 py-2 hover:bg-yellow-100 first:rounded-t-lg">Pengumuman Penting</a>
                    <a href="/kegiatan" class="block px-4 py-2 hover:bg-yellow-100">Kegiatan</a>
                    <a href="/dokumen" class="block px-4 py-2 hover:bg-yellow-100 last:rounded-b-lg">Dokumen</a>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Kontak
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 pt-2 hidden w-40 bg-white shadow-lg rounded-lg group-hover:flex flex-col dropdown-menu animate-fadeIn">
                    <a href="/kontak/internal" class="block px-4 py-2 hover:bg-yellow-100 first:rounded-t-lg">Internal</a>
                    <a href="/kontak/eksternal" class="block px-4 py-2 hover:bg-yellow-100 last:rounded-b-lg">Eksternal</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Mobile Menu --}}
    <div id="mobile-menu" class="hidden md:hidden bg-white shadow-inner px-4 py-3 space-y-2 font-medium">
        <a href="/" class="block py-2 text-gray-700 hover:text-yellow-600">Home</a>

        <details class="group">
            <summary class="flex justify-between items-center py-2 cursor-pointer text-gray-700 hover:text-yellow-600">
                Tentang Kami
                <svg class="w-4 h-4 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="pl-4 flex flex-col space-y-1">
                <a href="/profil" class="block py-1 text-gray-600 hover:text-yellow-600">Profil</a>
                <a href="/sejarah" class="block py-1 text-gray-600 hover:text-yellow-600">Sejarah</a>
                <a href="/pengurus" class="block py-1 text-gray-600 hover:text-yellow-600">Badan Pengurus</a>
                <a href="/pengawas" class="block py-1 text-gray-600 hover:text-yellow-600">Dewan Pengawas</a>
                <a href="/studio" class="block py-1 text-gray-600 hover:text-yellow-600">Studio Musik</a>
            </div>
        </details>

        <a href="/galeri" class="block py-2 text-gray-700 hover:text-yellow-600">Galeri</a>

        <details class="group">
            <summary class="flex justify-between items-center py-2 cursor-pointer text-gray-700 hover:text-yellow-600">
                Berita
                <svg class="w-4 h-4 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="pl-4 flex flex-col space-y-1">
                <a href="/pengumuman" class="block py-1 text-gray-600 hover:text-yellow-600">Pengumuman Penting</a>
                <a href="/kegiatan" class="block py-1 text-gray-600 hover:text-yellow-600">Kegiatan</a>
                <a href="/dokumen" class="block py-1 text-gray-600 hover:text-yellow-600">Dokumen</a>
            </div>
        </details>

        <details class="group">
            <summary class="flex justify-between items-center py-2 cursor-pointer text-gray-700 hover:text-yellow-600">
                Kontak
                <svg class="w-4 h-4 group-open:rotate-180 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </summary>
            <div class="pl-4 flex flex-col space-y-1">
                <a href="/kontak/internal" class="block py-1 text-gray-600 hover:text-yellow-600">Internal</a>
                <a href="/kontak/eksternal" class="block py-1 text-gray-600 hover:text-yellow-600">Eksternal</a>
            </div>
        </details>
    </div>
</nav>
