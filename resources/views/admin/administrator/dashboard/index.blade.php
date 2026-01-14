<!-- Dashbaord Administrator -->

<x-admin.administrator.layouts
    :title="$title"
    :description="$description"
    :author="$author"
    >
    <x-slot:title>Dashboard {{ $title }}</x-slot:title>

    <div class="p-8 rounded-xl shadow-md w-full max-w-screen text-center justify-center border border-gray-200">
        <h2 class="text-3xl font-bold mb-4">
            Selamat datang, {{ auth()->user()->name }}
        </h2>
        <p class="leading-relaxed">
            Dashboard ini adalah ruang untuk berkarya.  
            Dengan semangat <span class="font-semibold">keharmonisan</span>, mari terus menciptakan musik yang menyatukan perbedaan.  
        </p>
    </div>
</x-admin.administrator.layouts>
