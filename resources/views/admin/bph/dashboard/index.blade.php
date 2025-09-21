<x-admin.bph.layouts>
    <x-slot:title>Dashboard {{ $title }}</x-slot:title>

    <!-- Header Section -->
    <div class="p-8 rounded-2xl shadow-md w-full max-w-screen text-center justify-center border border-gray-200 mb-8 bg-gradient-to-r from-indigo-500 to-purple-500 text-white">
        <h2 class="text-3xl font-bold mb-4">
            Selamat datang, {{ auth()->user()->name }}
        </h2>
        <p class="leading-relaxed max-w-2xl mx-auto">
            Dashboard ini adalah ruang untuk berkarya.  
            Dengan semangat <span class="font-semibold">keharmonisan</span>, mari terus menciptakan musik yang menyatukan perbedaan.  
        </p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 p-8">

        <!-- Anggota Aktif -->
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col items-center text-center
                    transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="bg-red-100 text-red-500 p-3 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5V4H2v16h5v2h10v-2z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Total Anggota Aktif</h2>
            <p class="text-gray-700 font-bold text-3xl mt-2">120</p>
        </div>

        <!-- Alumni -->
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col items-center text-center
                    transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="bg-blue-100 text-blue-500 p-3 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 11c0 2.21-1.79 4-4 4s-4-1.79-4-4 
                    1.79-4 4-4 4 1.79 4 4zm0 0h0a4 4 0 100-8 4 4 0 000 8z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Total Alumni</h2>
            <p class="text-gray-700 font-bold text-3xl mt-2">85</p>
        </div>

        <!-- Badan Pengurus -->
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col items-center text-center
                    transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="bg-green-100 text-green-500 p-3 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.21 0 4.293.573 
                    6.121 1.573M15 11a3 3 0 100-6 3 3 0 000 6z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Total Badan Pengurus</h2>
            <p class="text-gray-700 font-bold text-3xl mt-2">25</p>
        </div>

        <!-- Kegiatan -->
        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col items-center text-center
                    transition-all duration-300 hover:scale-105 hover:shadow-xl">
            <div class="bg-yellow-100 text-yellow-500 p-3 rounded-full mb-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 
                    9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-lg font-semibold text-gray-800">Total Kegiatan</h2>
            <p class="text-gray-700 font-bold text-3xl mt-2">32</p>
        </div>

        <!-- tambahin juga untuk pendaftar, karya, penyewa, mitra -->
    </div>
</x-admin.bph.layouts>
