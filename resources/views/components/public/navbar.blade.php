<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        {{-- Logo + Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM" class="h-10 w-10 object-contain">
            <a href="/" class="text-lg font-bold text-gray-800">UKMBSM ITERA</a>
        </div>

        {{-- Menu --}}
        <div class="hidden md:flex space-x-6 font-medium">
            <a href="/" class="text-gray-700 hover:text-yellow-600">Beranda</a>
            <a href="/profil" class="text-gray-700 hover:text-yellow-600">Profil</a>
            <a href="/berita" class="text-gray-700 hover:text-yellow-600">Berita</a>
            <a href="/galeri" class="text-gray-700 hover:text-yellow-600">Galeri</a>
            <a href="/kontak" class="text-gray-700 hover:text-yellow-600">Kontak</a>
        </div>
    </div>
</nav>
