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

        <!-- Form Create Kegiatan -->
        <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
            <form method="POST" action="{{ route('manage-kegiatan.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Kegiatan -->
                    <div>
                        <label for="nama_kegiatan" class="block text-sm font-medium text-gray-700 mb-2">Nama Kegiatan</label>
                        <input type="text" name="nama_kegiatan" id="nama_kegiatan" value="{{ old('nama_kegiatan') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan nama kegiatan" required>
                        @error('nama_kegiatan') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" id="kategori"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="Internal" {{ old('kategori')=='Internal' ? 'selected' : '' }}>Internal</option>
                            <option value="Eksternal" {{ old('kategori')=='Eksternal' ? 'selected' : '' }}>Eksternal</option>
                            <option value="Latihan Rutin" {{ old('kategori')=='Latihan Rutin' ? 'selected' : '' }}>Latihan Rutin</option>
                        </select>
                        @error('kategori') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0" required>
                        @error('tanggal_mulai') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                        @error('tanggal_selesai') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jam Mulai -->
                    <div>
                        <label for="jam_mulai" class="block text-sm font-medium text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" id="jam_mulai" value="{{ old('jam_mulai') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                        @error('jam_mulai') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Jam Selesai -->
                    <div>
                        <label for="jam_selesai" class="block text-sm font-medium text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" id="jam_selesai" value="{{ old('jam_selesai') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                        @error('jam_selesai') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Lokasi -->
                    <div class="md:col-span-2">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-2">Lokasi</label>
                        <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan lokasi kegiatan">
                        @error('lokasi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="md:col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                            placeholder="Masukkan deskripsi kegiatan">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Poster (Image) -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Poster / Foto</label>

                        <div class="flex items-center gap-4">
                            <!-- Upload Box -->
                            <div class="flex flex-col items-center justify-center w-40 h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                <label for="poster" class="cursor-pointer flex flex-col items-center">
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

                        <input id="poster" type="file" name="poster" class="hidden" accept=".jpg,.jpeg,.png" onchange="previewImage(this)">
                        <p id="foto-error" class="text-sm text-red-600 hidden mt-1"></p>
                    </div>

                    <!-- Lampiran (File) -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran (PDF/Word/Excel/PPT)</label>
                        <input type="file" id="file" name="lampiran" class="w-full border rounded-lg px-3 py-2" 
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
                            <option value="published" {{ old('status')=='published' ? 'selected' : '' }}>Dipublikasikan</option>
                            <option value="done" {{ old('status')=='done' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Highlight -->
                    <div class="flex items-center space-x-2 mt-6">
                        <input type="checkbox" name="is_highlight" id="is_highlight" value="1" {{ old('is_highlight') ? 'checked' : '' }}>
                        <label for="is_highlight" class="text-sm text-gray-700">Tandai sebagai kegiatan unggulan</label>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-8">
                    <button onclick="closeAddModal()"
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
