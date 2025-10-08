<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>
    <div class="flex flex-col md:flex-row items-center justify-center min-h-[70vh] px-6 md:px-12 gap-10">
        <!-- Kolom kiri: Gambar -->
        <div class="flex justify-center md:justify-end w-full md:w-1/2">
            <img 
                src="{{ asset('assets/img/dummy/coming_soon.png') }}" 
                alt="Coming Soon" 
                class="w-72 md:w-96 opacity-90 animate-pulse select-none"
            >
        </div>

        <!-- Kolom kanan: Teks -->
        <div class="flex flex-col items-center md:items-start text-center md:text-left space-y-4 w-full md:w-1/2">
            <h1 class="text-2xl font-semibold text-gray-800 dark:text-gray-900">
                Halaman Sedang Dalam Pengembangan
            </h1>

            <p class="text-gray-600 dark:text-gray-400 text-sm max-w-md leading-relaxed">
                Fitur ini masih dalam tahap pengembangan. Silakan kembali lagi nanti ya 👷‍♂️🎧
            </p>

            <a 
                href="{{ url()->previous() }}" 
                class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-1.5 rounded-md shadow hover:bg-blue-700 transition-all duration-300 text-sm"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5L8.25 12l7.5-7.5" />
                </svg>
                Kembali
            </a>
        </div>
    </div>    

</x-admin.bph.layouts>
