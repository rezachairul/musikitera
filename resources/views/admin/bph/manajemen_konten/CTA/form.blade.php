<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKMBSM ITERA | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
</head>

<body class="min-h-screen bg-gray-50 text-gray-800">
    <main class="max-w-4xl mx-auto py-10 px-6 bg-white shadow-lg rounded-2xl mt-6 mb-10">
        <!-- HEADER -->
        <header class="flex items-center justify-between mb-6 px-4">
            <!-- Logo kiri -->
            <div class="flex-shrink-0">
                <img src="{{ asset('assets/img/logo/internal/institusi/logo-itera.png') }}" 
                    alt="Logo ITERA" 
                    class="h-20 w-auto">
            </div>

            <!-- Teks tengah -->
            <div class="flex-1 text-center">
                <h1 class="text-2xl font-bold text-gray-800 tracking-wide">
                    {{ $title }}
                </h1>
                <p class="text-sm text-gray-600 mt-2 italic leading-snug">
                    Bergabunglah bersama 
                    <span class="font-semibold text-green-600">UKMBSM ITERA</span>!  
                    Tempatmu menyalakan semangat, mengalirkan nada, dan mengekspresikan jiwa lewat musik 🎶
                </p>
            </div>

            <!-- Logo kanan -->
            <div class="flex-shrink-0">
                <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" 
                    alt="Logo UKMBSM ITERA" 
                    class="h-20 w-auto">
            </div>
        </header>

        <!-- FORM -->
        <form id="addForm" method="POST" action="{{ route('manage-cta.store') }}" enctype="multipart/form-data">
            @csrf

            <!-- Bagian Awal: Foto + Identitas -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6 items-stretch">
                <!-- FOTO -->
                <div class="flex flex-col items-center h-full w-full">
                    <!-- Preview + Tombol Upload -->
                    <div class="flex items-center justify-center gap-6">
                        <!-- Preview Gambar -->
                        <div id="photo-preview-public" class="hidden">
                            <img id="preview-img-public" src="" alt="Preview"
                                class="w-48 h-64 object-cover rounded-xl border shadow-md">
                        </div>

                        <!-- Tombol Upload -->
                        <label for="foto_pendaftar_input"
                            class="flex flex-col items-center justify-center w-48 h-64 border-2 border-dashed border-gray-300 rounded-xl cursor-pointer hover:border-green-400 hover:bg-gray-50 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-10 h-10 text-gray-400 mb-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 
                                    1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 
                                    3.75h16.5a1.5 1.5 0 0 0 
                                    1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 
                                    1.5 0 0 0 2.25 6v12a1.5 
                                    1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                            </svg>
                            <span id="upload-text-public" class="text-sm text-gray-500 text-center px-3">
                                Klik untuk upload
                            </span>
                        </label>

                        <input id="foto_pendaftar_input" name="foto_pendaftar" type="file"
                            accept=".jpg,.jpeg,.png"
                            class="hidden"
                            onchange="previewImagePublic(this)">
                    </div>

                    <!-- Pesan Error -->
                    <p id="foto-error-public" class="text-xs text-red-600 mt-2 text-center hidden"></p>
                </div>



                <!-- Identitas -->
                <div class="space-y-4">
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap" value="{{ old('nama_lengkap') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" value="{{ old('program_studi') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>

                    <div>
                        <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                        <input type="number" name="angkatan" id="angkatan" value="{{ old('angkatan') }}" min="2000"
                            max="{{ date('Y') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                            required>
                    </div>
                </div>
            </div>

            <!-- Input Lanjutan -->
            <div class="space-y-5">
                <div>
                    <label for="alamat_asli" class="block text-sm font-medium text-gray-700">Alamat Asli</label>
                    <textarea name="alamat_asli" id="alamat_asli" rows="3"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                        required>{{ old('alamat_asli') }}</textarea>
                </div>

                <div>
                    <label for="alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili (opsional)</label>
                    <textarea name="alamat_domisili" id="alamat_domisili" rows="3"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">{{ old('alamat_domisili') }}</textarea>
                </div>

                <div>
                    <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                    <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                        required>
                </div>

                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram (opsional)</label>
                    <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500">
                </div>

                <div>
                    <label for="alasan_gabung" class="block text-sm font-medium text-gray-700">Alasan Gabung</label>
                    <textarea name="alasan_gabung" id="alasan_gabung" rows="3"
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                        required>{{ old('alasan_gabung') }}</textarea>
                </div>

                <div>
                    <label for="minat" class="block text-sm font-medium text-gray-700">Minat</label>
                    <input type="text" name="minat" id="minat" value="{{ old('minat') }}"
                        placeholder="Contoh: Gitar, Vokal, Soundman..."
                        class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-green-500 focus:border-green-500"
                        required>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-3 mt-8">
                <a href="{{ route('public.index') }}"
                    class="px-5 py-2 rounded-lg border border-red-500 text-red-500 font-medium hover:bg-red-500 hover:text-white transition">
                    Batal
                </a>
                <button type="submit"
                    class="px-5 py-2 rounded-lg border border-green-600 text-green-600 font-medium hover:bg-green-600 hover:text-white transition">
                    Simpan
                </button>
            </div>
        </form>

    </main>
    <!-- FOOTER -->
    <footer class="py-6 text-center text-sm text-gray-500 border-t border-gray-200 bg-gray-50 w-full">
        <div class="text-center text-xs text-gray-900">
            &copy; {{ date('Y') }} UKMBSM ITERA. All rights reserved.

            <div class="mt-1">
                Proyek ini dikembangkan oleh:
                <span class="block sm:inline">
                    🐍 <a href="https://cobradev.vercel.app/" target="_blank" 
                        class="text-gray-400 hover:text-yellow-500 font-medium">CobraDev</a>
                </span>
                &nbsp;|&nbsp;
                <span class="block sm:inline">
                    🌐 <a href="https://sigawariweb.netlify.app/" target="_blank" 
                        class="text-gray-400 hover:text-yellow-500 font-medium">Sigawari</a>
                </span>
            </div>
        </div>
    </footer>
</body>

</html>
