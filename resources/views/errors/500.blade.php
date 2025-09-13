<!-- Internal Server Error (umum dipakai kalau ada bug di server) -->
<x-errors.layouts>
    <x-slot:title>{{ $title ?? 'Error Page' }}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-green-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-green-600">500</h1>
            <p class="text-xl text-gray-700 mt-4">Oops, ada kesalahan di server 🎹</p>
            <p class="text-gray-500 mt-2">Sepertinya ada nada yang patah, coba lagi nanti.</p>
            <a href="{{ url('/') }}" 
            class="mt-6 inline-block px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-errors.layouts>