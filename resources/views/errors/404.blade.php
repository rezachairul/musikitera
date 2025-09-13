<!-- Not Found (halaman tidak ditemukan) -->
<x-errors.layouts>
    <x-slot:title>{{ $title ?? 'Error Page' }}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-blue-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-blue-600">404</h1>
            <p class="text-xl text-gray-700 mt-4">Halaman Tidak Ditemukan 🎧</p>
            <p class="text-gray-500 mt-2">Sepertinya nada ini hilang, coba kembali ke beranda.</p>
            <a href="{{ url('/') }}" 
            class="mt-6 inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-errors.layouts>