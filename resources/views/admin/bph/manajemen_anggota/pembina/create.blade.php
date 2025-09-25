<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72 m.94 3.198.001.031c0 .225-.012.447-.037.666 A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584 A6.062 6.062 0 0 1 6 18.719 m12 0a5.971 5.971 0 0 0-.941-3.197 m0 0A5.995 5.995 0 0 0 12 12.75 a5.995 5.995 0 0 0-5.058 2.772 m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477 m.94-3.197a5.971 5.971 0 0 0-.94 3.197 M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0 Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0 Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create Pembina -->
        <div class="max-h-[80vh] overflow-y-auto px-1">
            <form id="addForm" method="POST" action="{{ route('manage-pembina.store') }}" enctype="multipart/form-data">
                @csrf
                @method('POST')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Beserta Gelar</label>
                        <input type="text" name="nama" id="nama"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukan Nama" required>
                    </div>

                    <!-- NIP/NIDN -->
                    <div>
                        <label for="nip_nidn" class="block text-sm font-medium text-gray-700 mb-2">NIP / NIDN</label>
                        <input type="text" name="nip_nidn" id="nip_nidn"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukan NIP atau NIDN" required>
                    </div>

                    <!-- Periode Awal -->
                    <div>
                        <label for="awal_periode" class="block text-sm font-medium text-gray-700 mb-2">
                            Periode Awal
                        </label>
                        <input type="date" name="awal_periode" id="awal_periode"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                    </div>

                    <!-- Periode Akhir -->
                    <div>
                        <label for="akhir_periode" class="block text-sm font-medium text-gray-700 mb-2">
                            Periode Akhir
                        </label>
                        <input type="date" name="akhir_periode" id="akhir_periode"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                    </div>

                    <!-- Jabatan di kampus-->
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                        <input type="text" name="jabatan" id="jabatan"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukan Jabatan" required>
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukan Program Studi">
                    </div>

                    <!-- Kontak -->
                    <div>
                        <label for="kontak" class="block text-sm font-medium text-gray-700 mb-2">Kontak</label>
                        <input type="text" name="kontak" id="kontak"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukan Email / No. HP">
                    </div>

                    <!-- Foto -->
                    <div>
                        <label for="foto_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto <span class="text-xs text-gray-500">(Format: JPG, JPEG, PNG • Maks 2MB)</span>
                        </label>

                        <div class="flex items-center space-x-4">
                            <!-- Preview -->
                            <div id="photo-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview" 
                                    class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                            </div>

                            <!-- Upload area -->
                            <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                <label for="foto_input" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                    </svg>
                                    <span id="upload-text" class="text-xs text-gray-500">Klik untuk upload</span>
                                </label>
                            </div>

                            <!-- File input (dipisah dari label) -->
                            <input id="foto_input" name="foto" type="file"
                                accept=".jpg,.jpeg,.png"
                                class="hidden"
                                onchange="previewImage(this)">
                        </div>

                        <!-- Pesan error -->
                        <p id="foto-error" class="mt-2 text-sm text-red-600 hidden"></p>
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
