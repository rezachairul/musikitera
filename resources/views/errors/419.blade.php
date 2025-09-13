<!-- Page Expired (biasanya karena CSRF token expired, sering kejadian kalau form lama ga di-submit) -->
<x-errors.layouts>
    <x-slot:title>{{ $title ?? 'Error Page' }}</x-slot:title>
    <div class="min-h-screen flex items-center justify-center bg-purple-50">
        <div class="text-center">
            <h1 class="text-6xl font-bold text-purple-600">419</h1>
            <p class="text-xl text-gray-700 mt-4">Page Expired 🎶</p>
            <p class="text-gray-500 mt-2">Sepertinya tempo-nya habis, silakan refresh halaman atau login lagi.</p>
            <a href="{{ route('login') }}" 
            class="mt-6 inline-block px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
                Login Kembali
            </a>
        </div>
    </div>
</x-errors.layouts>