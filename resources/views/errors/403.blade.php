<!-- Forbidden (akses ditolak, misalnya user ga punya izin) -->
<x-errors.layouts>
    <x-slot:title>{{ $title ?? 'Error Page' }}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-red-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-red-600">403</h1>
            <p class="text-xl text-gray-700 mt-4">Akses Ditolak 🎤</p>
            <p class="text-gray-500 mt-2">Maaf, kamu tidak punya izin untuk masuk ke sini.</p>
            <a href="{{ url('/') }}" 
            class="mt-6 inline-block px-6 py-3 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-errors.layouts>