<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between">
        {{-- Logo + Nama --}}
        <div class="flex items-center space-x-3">
            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKMBSM" class="h-10 w-10 object-contain">
            <a href="/" class="text-lg font-bold text-gray-800">UKMBSM ITERA</a>
        </div>

        {{-- Menu --}}
        <div class="hidden md:flex space-x-6 font-medium">
            <a href="/" class="text-gray-700 hover:text-yellow-600">Home</a>
            <a href="/profil" class="text-gray-700 hover:text-yellow-600">Profile</a>
            <a href="/about" class="text-gray-700 hover:text-yellow-600">About Us</a>
            <a href="/gallery" class="text-gray-700 hover:text-yellow-600">Gallery</a>
            <a href="/announcement" class="text-gray-700 hover:text-yellow-600">Announcement</a>
            <a href="/news" class="text-gray-700 hover:text-yellow-600">News</a>
            <a href="/contact" class="text-gray-700 hover:text-yellow-600">Contact</a>
        </div>
    </div>
</nav>
