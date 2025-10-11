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

        <!-- Form Create CTA -->
        <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
            <form id="addForm" method="POST" action="{{ route('manage-cta.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Foto -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="foto_pendaftar_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Pendaftar <span class="text-xs text-gray-500">(JPG, JPEG, PNG • Maks 2MB)</span>
                        </label>

                        <div class="flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-4">
                            <!-- Preview -->
                            <div id="photo-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview"
                                    class="w-32 h-32 object-cover rounded-lg border shadow-sm">
                            </div>

                            <!-- Upload area -->
                            <div
                                class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                <label for="foto_pendaftar_input"
                                    class="cursor-pointer flex flex-col items-center justify-center h-full w-full text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor"
                                        class="w-6 h-6 text-gray-300 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 
                                            1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 
                                            3.75h16.5a1.5 1.5 0 0 0 
                                            1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 
                                            1.5 0 0 0 2.25 6v12a1.5 
                                            1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Z" />
                                    </svg>
                                    <span id="upload-text" class="text-xs text-gray-500">Klik untuk upload</span>
                                </label>
                            </div>

                            <!-- File input -->
                            <input id="foto_pendaftar_input" name="foto_pendaftar" type="file" accept=".jpg,.jpeg,.png"
                                class="hidden" onchange="previewImage(this)">
                        </div>

                        <!-- Error Message -->
                        <p id="foto-error" class="mt-2 text-sm text-red-600 hidden"></p>
                        @error('foto_pendaftar')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" id="nama_lengkap"
                            value="{{ old('nama_lengkap') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('nama_lengkap')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIM -->
                    <div>
                        <label for="nim" class="block text-sm font-medium text-gray-700">NIM</label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('nim')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Angkatan -->
                    <div>
                        <label for="angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                        <input type="number" name="angkatan" id="angkatan" value="{{ old('angkatan') }}"
                            min="2000" max="{{ date('Y') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('angkatan')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Program Studi -->
                    <div>
                        <label for="program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                        <input type="text" name="program_studi" id="program_studi" value="{{ old('program_studi') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('program_studi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Asli -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="alamat_asli" class="block text-sm font-medium text-gray-700">Alamat Asli</label>
                        <textarea name="alamat_asli" id="alamat_asli" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>{{ old('alamat_asli') }}</textarea>
                        @error('alamat_asli')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alamat Domisili -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili (opsional)</label>
                        <textarea name="alamat_domisili" id="alamat_domisili" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat_domisili') }}</textarea>
                        @error('alamat_domisili')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                        <input type="text" name="nomor_telepon" id="nomor_telepon" value="{{ old('nomor_telepon') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('nomor_telepon')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Instagram -->
                    <div>
                        <label for="instagram" class="block text-sm font-medium text-gray-700">Instagram (opsional)</label>
                        <input type="text" name="instagram" id="instagram" value="{{ old('instagram') }}"
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                        @error('instagram')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Alasan Gabung -->
                    <div class="col-span-1 md:col-span-2">
                        <label for="alasan_gabung" class="block text-sm font-medium text-gray-700">Alasan Gabung</label>
                        <textarea name="alasan_gabung" id="alasan_gabung" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>{{ old('alasan_gabung') }}</textarea>
                        @error('alasan_gabung')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Minat -->
                    <div>
                        <label for="minat" class="block text-sm font-medium text-gray-700">Minat</label>
                        <input type="text" name="minat" id="minat" value="{{ old('minat') }}"
                            placeholder="Contoh: Gitar, Vokal, Soundman..."
                            class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('minat')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeAddModal()"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
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
