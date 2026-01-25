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
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-red-600">
            <div class="bg-red-100 text-red-500 group-hover:bg-red-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <!-- Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Anggota Aktif</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 120</p>
            </div>
        </div>

        <!-- Alumni -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-blue-600">
            <div class="bg-blue-100 text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Alumni</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 85</p>
            </div>
        </div>

        <!-- Badan Pengurus -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-green-600">
            <div class="bg-green-100 text-green-500 group-hover:bg-green-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Badan Pengurus</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 25</p>
            </div>
        </div>

        <!-- Kegiatan -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-yellow-600">
            <div class="bg-yellow-100 text-yellow-500 group-hover:bg-yellow-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H7.5a4.5 4.5 0 1 1 0-9h.75c.704 0 1.402-.03 2.09-.09m0 9.18c.253.962.584 1.892.985 2.783.247.55.06 1.21-.463 1.511l-.657.38c-.551.318-1.26.117-1.527-.461a20.845 20.845 0 0 1-1.44-4.282m3.102.069a18.03 18.03 0 0 1-.59-4.59c0-1.586.205-3.124.59-4.59m0 9.18a23.848 23.848 0 0 1 8.835 2.535M10.34 6.66a23.847 23.847 0 0 0 8.835-2.535m0 0A23.74 23.74 0 0 0 18.795 3m.38 1.125a23.91 23.91 0 0 1 1.014 5.395m-1.014 8.855c-.118.38-.245.754-.38 1.125m.38-1.125a23.91 23.91 0 0 0 1.014-5.395m0-3.46c.495.413.811 1.035.811 1.73 0 .695-.316 1.317-.811 1.73m0-3.46a24.347 24.347 0 0 1 0 3.46" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Kegiatan</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 32</p>
            </div>
        </div>

        <!-- Pendaftar -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-purple-600">
            <div class="bg-purple-100 text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <!-- placeholder icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Pendaftar</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 50</p>
            </div>
        </div>

        <!-- Karya -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-pink-600">
            <div class="bg-pink-100 text-pink-500 group-hover:bg-pink-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <!-- placeholder icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.75a6 6 0 0 0 6-6v-1.5m-6 7.5a6 6 0 0 1-6-6v-1.5m6 7.5v3.75m-3.75 0h7.5M12 15.75a3 3 0 0 1-3-3V4.5a3 3 0 1 1 6 0v8.25a3 3 0 0 1-3 3Z" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Karya</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 15</p>
            </div>
        </div>

        <!-- Penyewa -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-indigo-600">
            <div class="bg-indigo-100 text-indigo-500 group-hover:bg-indigo-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <!-- placeholder icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Penyewa</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: 20</p>
            </div>
        </div>

        <!-- Mitra -->
        <div class="group bg-white p-4 rounded-2xl shadow-md flex items-center space-x-4 transition-all duration-300 hover:scale-105 hover:shadow-xl border-2 border-transparent hover:border-teal-600">
            <div class="bg-teal-100 text-teal-500 group-hover:bg-teal-500 group-hover:text-white transition duration-300 p-3 rounded-full flex-shrink-0">
                <!-- placeholder icon -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12.75 3.03v.568c0 .334.148.65.405.864l1.068.89c.442.369.535 1.01.216 1.49l-.51.766a2.25 2.25 0 0 1-1.161.886l-.143.048a1.107 1.107 0 0 0-.57 1.664c.369.555.169 1.307-.427 1.605L9 13.125l.423 1.059a.956.956 0 0 1-1.652.928l-.679-.906a1.125 1.125 0 0 0-1.906.172L4.5 15.75l-.612.153M12.75 3.031a9 9 0 0 0-8.862 12.872M12.75 3.031a9 9 0 0 1 6.69 14.036m0 0-.177-.529A2.25 2.25 0 0 0 17.128 15H16.5l-.324-.324a1.453 1.453 0 0 0-2.328.377l-.036.073a1.586 1.586 0 0 1-.982.816l-.99.282c-.55.157-.894.702-.8 1.267l.073.438c.08.474.49.821.97.821.846 0 1.598.542 1.865 1.345l.215.643m5.276-3.67a9.012 9.012 0 0 1-5.276 3.67m0 0a9 9 0 0 1-10.275-4.835M15.75 9c0 .896-.393 1.7-1.016 2.25" />
                </svg>
            </div>
            <div class="text-left">
                <h2 class="text-sm font-semibold text-gray-800">Mitra</h2>
                <p class="text-gray-700 font-bold text-sm mt-1">Total: {{ $totalMitras }}</p>
            </div>
        </div>

    </div>

</x-admin.bph.layouts>
