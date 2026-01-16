<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4">
    <div class="bg-white p-5 rounded-xl shadow-lg w-full max-w-2xl max-h-[90vh] flex flex-col relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create Kabinet -->
        <div class="px-6 pb-6 overflow-y-auto">
            <form id="addForm" method="POST" action="{{ route('manage-kabinet.store') }}" enctype="multipart/form-data">
                @csrf
    
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    
                    <!-- Nama Kabinet -->
                    <div>
                        <label for="nama_kabinet" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Kabinet
                        </label>
                        <input type="text" name="nama_kabinet" id="nama_kabinet"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Kabinet Arunika" required>
                    </div>
    
                    <!-- Status Kabinet -->
                    <div>
                        <span class="block text-sm font-medium text-gray-700 mb-2">
                            Status Kabinet
                        </span>
    
                        <div class="flex items-center gap-6 mt-1">
    
                            <!-- Aktif -->
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="1" class="hidden peer" checked>
                                <span class="w-5 h-5 rounded-full border-2 border-gray-300
                                            peer-checked:border-green-600 peer-checked:bg-green-600 transition"></span>
                                <span class="ml-2 text-sm text-gray-700">Aktif</span>
                            </label>
    
                            <!-- Tidak Aktif -->
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="is_active" value="0" class="hidden peer">
                                <span class="w-5 h-5 rounded-full border-2 border-gray-300
                                            peer-checked:border-red-600 peer-checked:bg-red-600 transition"></span>
                                <span class="ml-2 text-sm text-gray-700">Tidak Aktif</span>
                            </label>
    
                        </div>
                    </div>
    
                    <!-- Periode Awal -->
                    <div>
                        <label for="periode_awal" class="block text-sm font-medium text-gray-700 mb-2">
                            Periode Awal
                        </label>
                        <input type="number" name="periode_awal" id="periode_awal"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg
                                focus:ring-2 focus:ring-blue-500"
                            placeholder="2024" min="2000" max="2100" required>
                    </div>
    
                    <!-- Periode Akhir -->
                    <div>
                        <label for="periode_akhir" class="block text-sm font-medium text-gray-700 mb-2">
                            Periode Akhir
                        </label>
                        <input type="number" name="periode_akhir" id="periode_akhir"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg
                                focus:ring-2 focus:ring-blue-500"
                            placeholder="2025" min="2000" max="2100" required>
                    </div>
    
                    <!-- Logo Kabinet -->
                    <div data-preview-wrapper>
                        <label for="logo_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Logo Kabinet <br>
                            <span class="text-xs text-gray-500">(PNG, JPG, WebP • Maks 2MB)</span>
                        </label>
    
                        <div class="flex items-center space-x-4">
    
                            <!-- Preview -->
                            <div data-preview-box class="hidden">
                                <img data-preview-img alt="Preview" class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                            </div>
    
                            <!-- Upload area -->
                            <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
    
                                <label for="logo_input" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <span data-upload-text class="text-xs text-gray-500">
                                        Upload Logo
                                    </span>
                                </label>
                            </div>
    
                            <!-- Input -->
                            <input id="logo_input" name="logo" type="file" accept=".png,.jpg,.jpeg,.webp" class="hidden" onchange="previewImage(this)">
                        </div>
    
                        <p data-error-msg class="hidden text-xs text-red-500 mt-1"></p>
                    </div>
    
                    <!-- Banner Kabinet -->
                    <div data-preview-wrapper class="md:col-span-2">
                        <label for="banner_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Banner Kabinet <br>
                            <span class="text-xs text-gray-500">Ukuran 1200×400 px</span>
                        </label>
    
                        <div class="flex flex-col space-y-3">
    
                            <!-- Upload area -->
                            <div class="flex flex-col items-center justify-center h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
    
                                <label for="banner_input" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
    
                                    <span data-upload-text class="text-sm text-gray-500">
                                        Klik untuk upload banner
                                    </span>
                                </label>
                            </div>
    
                            <!-- Preview -->
                            <div data-preview-box class="hidden">
                                <img data-preview-img class="w-full max-h-48 object-cover rounded-lg border shadow-sm">
                            </div>
    
                            <p data-error-msg class="hidden text-xs text-red-500"></p>
    
                            <!-- Input -->
                            <input id="banner_input" name="banner" type="file" accept=".png,.jpg,.jpeg,.webp" class="hidden" onchange="previewImage(this)">
                        </div>
                    </div>
    
                    <!-- Deskripsi Kabinet (Full Width) -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                            Deskripsi Kabinet
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="4" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-justify" placeholder="Tuliskan gambaran singkat, visi, atau semangat kabinet..."></textarea>
                    </div>
    
                </div>
    
                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeAddModal()" class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>

        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
