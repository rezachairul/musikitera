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

        <!-- Form Create Pengumuman -->
        <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
            <form method="POST" action="{{ route('manage-pengumuman.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Judul Pengumuman -->
                    <div class="md:col-span-2">
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Pengumuman</label>
                        <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan judul pengumuman" required>
                        @error('judul') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Sifat Pengumuman -->
                    <div>
                        <label for="sifat" class="block text-sm font-medium text-gray-700 mb-2">Sifat Pengumuman</label>
                        <select name="sifat" id="sifat"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                            <option value="umum" {{ old('sifat')=='umum' ? 'selected' : '' }}>Umum</option>
                            <option value="internal" {{ old('sifat')=='internal' ? 'selected' : '' }}>Internal</option>
                            <option value="penting" {{ old('sifat')=='penting' ? 'selected' : '' }}>Penting</option>
                            <option value="rahasia" {{ old('sifat')=='rahasia' ? 'selected' : '' }}>Rahasia</option>
                        </select>
                        @error('sifat') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tanggal Pengumuman -->
                    <div>
                        <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengumuman</label>
                        <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman" value="{{ old('tanggal_pengumuman') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                        @error('tanggal_pengumuman') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Isi Pengumuman -->
                    <div class="md:col-span-2">
                        <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi Pengumuman</label>
                        <textarea name="isi" id="isi" rows="4"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Tulis isi pengumuman di sini...">{{ old('isi') }}</textarea>
                        @error('isi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Gambar (Poster / Banner) -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poster / Gambar (opsional)</label>
                        <div class="flex items-center gap-4">
                            <!-- Upload Box -->
                            <div class="flex flex-col items-center justify-center w-40 h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <label for="gambar" class="cursor-pointer flex flex-col items-center">
                                    <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span id="upload-text" class="text-xs text-gray-500">Klik untuk upload</span>
                                </label>
                            </div>

                            <!-- Preview Box -->
                            <div id="photo-preview" class="hidden">
                                <img id="preview-img" class="w-40 h-28 object-cover rounded-lg shadow-md border" />
                            </div>
                        </div>
                        <input id="gambar" type="file" name="gambar" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(this)">
                        <p id="foto-error" class="text-sm text-red-600 hidden mt-1"></p>
                    </div>

                    <!-- File Dokumen (Lampiran opsional) -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran Dokumen (PDF/Word/Excel/PPT)</label>

                        <input type="file" id="file" name="file_dokumen" class="w-full border rounded-lg px-3 py-2" 
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                        <p id="fileError" class="text-sm text-red-600 hidden mt-1"></p>

                        <div id="filePreview" class="hidden mt-2 border rounded-lg p-2">
                            <div id="previewContent"></div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="status" id="status"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                            <option value="draft" {{ old('status')=='draft' ? 'selected' : '' }}>Draft</option>
                            <option value="publish" {{ old('status')=='publish' ? 'selected' : '' }}>Publikasikan</option>
                            <option value="arsip" {{ old('status')=='arsip' ? 'selected' : '' }}>Arsipkan</option>
                        </select>
                        @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-8">
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
