<footer class="bg-gray-900 text-gray-300 py-10 mt-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        
        {{-- Logo + Nama --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">UKMBSM ITERA</h3>
            <p class="text-sm text-gray-400">
                Unit Kegiatan Mahasiswa Bidang Seni Musik Institut Teknologi Sumatera.
            </p>
        </div>

        {{-- Kontak --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Kontak</h3>
            <p class="text-sm">Jl. Terusan Ryacudu, Way Huwi<br> Lampung Selatan</p>
            <p class="text-sm mt-1">Email: musikitera@gmail.com</p>
        </div>

        {{-- Sosial Media --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Ikuti Kami</h3>
            <div class="flex justify-center md:justify-start space-x-4">
                <a href="#" class="hover:text-yellow-500">Instagram</a>
                <a href="#" class="hover:text-yellow-500">YouTube</a>
                <a href="#" class="hover:text-yellow-500">Facebook</a>
            </div>
        </div>
    </div>

    <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} UKMBSM ITERA. All rights reserved.
    </div>
</footer>
