<x-admin.administrator.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-8">
        <!-- Admin -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-amber-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-amber-300 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Admin</h2>
            <p class="text-sm text-gray-500">Manajemen sistem dan pengguna</p>
        </div>

        <!-- Badan Pengurus -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200
                    flex flex-col items-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-blue-600">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-blue-600 mb-3">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8.25V18a2.25 2.25 0 0 0 2.25 2.25h13.5A2.25 2.25 0 0 0 21 18V8.25m-18 0V6a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 6v2.25m-18 0h18M5.25 6h.008v.008H5.25V6ZM7.5 6h.008v.008H7.5V6Zm2.25 0h.008v.008H9.75V6Z" />
                    </svg>
            <h2 class="text-lg font-semibold text-gray-800">Badan Pengurus</h2>
            <p class="text-sm text-gray-500">Pelaksana utama organisasi</p>
        </div>

        <!-- Dewan Pengawas -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-green-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-green-600 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v17.25m0 0c-1.472 0-2.882.265-4.185.75M12 20.25c1.472 0 2.882.265 4.185.75M18.75 4.97A48.416 48.416 0 0 0 12 4.5c-2.291 0-4.545.16-6.75.47m13.5 0c1.01.143 2.01.317 3 .52m-3-.52 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.988 5.988 0 0 1-2.031.352 5.988 5.988 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L18.75 4.971Zm-16.5.52c.99-.203 1.99-.377 3-.52m0 0 2.62 10.726c.122.499-.106 1.028-.589 1.202a5.989 5.989 0 0 1-2.031.352 5.989 5.989 0 0 1-2.031-.352c-.483-.174-.711-.703-.59-1.202L5.25 4.971Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Dewan Pengawas</h2>
            <p class="text-sm text-gray-500">Mengawasi jalannya organisasi</p>
        </div>

        <!-- Pembina -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-purple-600">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-purple-600 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M11.48 3.499a.562.562 0 0 1 1.04 0l2.125 5.111a.563.563 0 0 0 .475.345l5.518.442c.499.04.701.663.321.988l-4.204 3.602a.563.563 0 0 0-.182.557l1.285 5.385a.562.562 0 0 1-.84.61l-4.725-2.885a.562.562 0 0 0-.586 0L6.982 20.54a.562.562 0 0 1-.84-.61l1.285-5.386a.562.562 0 0 0-.182-.557l-4.204-3.602a.562.562 0 0 1 .321-.988l5.518-.442a.563.563 0 0 0 .475-.345L11.48 3.5Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Pembina</h2>
            <p class="text-sm text-gray-500">Memberi arahan dan bimbingan</p>
        </div>
    </div>

    <!-- Table -->
    <div class="p-8 rounded-xl shadow-md w-full max-w-screen text-center justify-center border border-gray-200">
        
    </div>
</x-admin.administrator.layouts>
