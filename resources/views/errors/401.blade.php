<!-- Unauthorized (belum login / tidak terautentikasi) -->
<x-errors.layouts>
    <x-slot:title>{{ $title ?? 'Error Page' }}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-yellow-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-yellow-600">401</h1>
            <p class="text-xl text-gray-700 mt-4">Ups, kamu belum login! 🎵</p>
            <p class="text-gray-500 mt-2">Untuk menikmati musik, silakan login dulu 😉</p>
            <a href="{{ route('login') }}" 
            class="mt-6 inline-block px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 transition">
                Login Sekarang
            </a>
        </div>
    </div>
</x-errors.layouts>