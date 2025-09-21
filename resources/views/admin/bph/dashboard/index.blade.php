<x-admin.bph.layouts>
    <x-slot:title>Dashboard {{ $title }}</x-slot:title>

    <div class="p-8 rounded-xl shadow-md w-full max-w-screen text-center justify-center border border-gray-200 mb-8">
        <h2 class="text-3xl font-bold mb-4">
            Selamat datang, {{ auth()->user()->name }}
        </h2>
        <p class="leading-relaxed">
            Dashboard ini adalah ruang untuk berkarya.  
            Dengan semangat <span class="font-semibold">keharmonisan</span>, mari terus menciptakan musik yang menyatukan perbedaan.  
        </p>
    </div>

    <!-- Dummy Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        <!-- Card 1 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Kegiatan Mendatang</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                Latihan rutin bulan ini akan diadakan setiap hari Sabtu, pukul 16.00 di Gedung Serbaguna.
            </p>
        </div>

        <!-- Card 2 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Data Anggota</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                Total Anggota Aktif: <span class="font-bold">120</span><br>
                Anggota Baru Semester Ini: <span class="font-bold">15</span>
            </p>
        </div>

        <!-- Card 3 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Pengumuman</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                Rekruitmen panitia acara Dies Natalis UKMBSM dibuka mulai minggu depan.
            </p>
        </div>

        <!-- Card 4 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Statistik Kegiatan</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                Jumlah Kegiatan Semester Ini: <span class="font-bold">8</span><br>
                Rata-rata Kehadiran: <span class="font-bold">85%</span>
            </p>
        </div>

        <!-- Card 5 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Keuangan</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm">
                Saldo Kas Saat Ini: <span class="font-bold">Rp 5.200.000</span><br>
                Pemasukan Terakhir: Sponsorship Event Akustik.
            </p>
        </div>

        <!-- Card 6 -->
        <div class="p-6 bg-white dark:bg-gray-800 rounded-xl shadow-md border border-gray-200">
            <h3 class="text-lg font-semibold mb-2">Inspirasi Musik</h3>
            <p class="text-gray-600 dark:text-gray-300 text-sm italic">
                "Musik adalah bahasa universal yang mampu menyatukan hati manusia."
            </p>
        </div>
    </div>
</x-admin.bph.layouts>
