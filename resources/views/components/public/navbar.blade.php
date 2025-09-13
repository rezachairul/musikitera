<nav class="bg-white shadow sticky top-0 z-50">
    <div class="w-full max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-between">
        {{-- Logo + Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM" class="h-10 w-10 object-contain">
            <a href="/" class="text-lg font-bold text-gray-800">UKMBSM ITERA</a>
        </div>

        {{-- Menu --}}
        <div class="hidden md:flex space-x-6 font-medium relative">

            <!-- Home -->
            <a href="/" class="text-gray-700 hover:text-yellow-600">Home</a>

            <!-- Tentang Kami -->
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Tentang Kami
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M19 9l-7 7-7-7" />
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

            <!-- Galeri -->
            <a href="/galeri" class="text-gray-700 hover:text-yellow-600">Galeri</a>

            <!-- Berita -->
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Berita
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 pt-2 hidden w-52 bg-white shadow-lg rounded-lg group-hover:flex flex-col dropdown-menu animate-fadeIn">
                    <a href="/pengumuman" class="block px-4 py-2 hover:bg-yellow-100 first:rounded-t-lg">Pengumuman Penting</a>
                    <a href="/kegiatan" class="block px-4 py-2 hover:bg-yellow-100">Kegiatan</a>
                    <a href="/dokumen" class="block px-4 py-2 hover:bg-yellow-100 last:rounded-b-lg">Dokumen</a>
                </div>
            </div>

            <!-- Kontak -->
            <div class="group relative">
                <button class="text-gray-700 hover:text-yellow-600 flex items-center gap-1">
                    Kontak
                    <svg class="w-4 h-4 transition-transform group-hover:rotate-180" 
                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" 
                            stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
                <div class="absolute right-0 pt-2 hidden w-40 bg-white shadow-lg rounded-lg group-hover:flex flex-col dropdown-menu animate-fadeIn">
                    <a href="/kontak/internal" class="block px-4 py-2 hover:bg-yellow-100 first:rounded-t-lg">Internal</a>
                    <a href="/kontak/eksternal" class="block px-4 py-2 hover:bg-yellow-100 last:rounded-b-lg">Eksternal</a>
                </div>
            </div>
        </div>
    </div>
</nav>
