<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">|
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 0 0-3.7-3.7 48.678 48.678 0 0 0-7.324 0 4.006 4.006 0 0 0-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 0 0 3.7 3.7 48.656 48.656 0 0 0 7.324 0 4.006 4.006 0 0 0 3.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3-3 3" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create Kerjasama -->
        <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
            <form id="addForm" method="POST" action="{{ route('manage-kerjasama.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    <!-- Apakah dari Mitra -->
                    <div class="col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Kerjasama</label>
                        <div class="flex items-center space-x-6">
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="is_from_mitra" value="1" 
                                    class="text-blue-600 focus:ring-blue-500" 
                                    {{ old('is_from_mitra') == '1' ? 'checked' : '' }} required>
                                <span>Dari Mitra Terdaftar</span>
                            </label>
                            <label class="flex items-center space-x-2">
                                <input type="radio" name="is_from_mitra" value="0" 
                                    class="text-blue-600 focus:ring-blue-500" 
                                    {{ old('is_from_mitra') == '0' ? 'checked' : '' }}>
                                <span>Dari Organisasi Lain</span>
                            </label>
                        </div>
                        @error('is_from_mitra')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pilih Mitra -->
                    <div id="mitra-section" class="hidden">
                        <label for="mitra_id" class="block text-sm font-medium text-gray-700 mb-2">Pilih Mitra</label>
                        <select id="mitra_id" name="mitra_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <option value="">-- Pilih Mitra --</option>
                            @foreach ($mitras as $mitra)
                                <option value="{{ $mitra->id }}" {{ old('mitra_id') == $mitra->id ? 'selected' : '' }}>
                                    {{ $mitra->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('mitra_id')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nama Organisasi -->
                    <div id="organisasi-section" class="hidden">
                        <label for="nama_organisasi" class="block text-sm font-medium text-gray-700 mb-2">Nama Organisasi</label>
                        <input type="text" name="nama_organisasi" id="nama_organisasi" value="{{ old('nama_organisasi') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Masukan nama organisasi">
                        @error('nama_organisasi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Judul Kerjasama -->
                    <div class="col-span-2">
                        <label for="judul_kerjasama" class="block text-sm font-medium text-gray-700 mb-2">Judul Kerjasama</label>
                        <input type="text" name="judul_kerjasama" id="judul_kerjasama" value="{{ old('judul_kerjasama') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Masukan judul kerjasama" required>
                        @error('judul_kerjasama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis Kerjasama -->
                    <div>
                        <label for="jenis_kerjasama" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kerjasama</label>
                        <select id="jenis_kerjasama" name="jenis_kerjasama"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            required>
                            <option value="">-- Pilih Jenis --</option>
                            <option value="MoU" {{ old('jenis_kerjasama') == 'MoU' ? 'selected' : '' }}>MoU</option>
                            <option value="MoA" {{ old('jenis_kerjasama') == 'MoA' ? 'selected' : '' }}>MoA</option>
                            <option value="Event" {{ old('jenis_kerjasama') == 'Event' ? 'selected' : '' }}>Event</option>
                            <option value="Proyek" {{ old('jenis_kerjasama') == 'Proyek' ? 'selected' : '' }}>Proyek</option>
                            <option value="Sponsorship" {{ old('jenis_kerjasama') == 'Sponsorship' ? 'selected' : '' }}>Sponsorship</option>
                            <option value="Lainnya" {{ old('jenis_kerjasama') == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                        </select>
                        @error('jenis_kerjasama')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            required>
                            <option value="">-- Pilih Status --</option>
                            <option value="rencana" {{ old('status') == 'rencana' ? 'selected' : '' }}>Rencana</option>
                            <option value="berjalan" {{ old('status') == 'berjalan' ? 'selected' : '' }}>Berjalan</option>
                            <option value="selesai" {{ old('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                        @error('status')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Mulai -->
                    <div>
                        <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            required>
                        @error('tanggal_mulai')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tanggal Selesai -->
                    <div>
                        <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                        <input type="date" name="tanggal_selesai" id="tanggal_selesai" value="{{ old('tanggal_selesai') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        @error('tanggal_selesai')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- File Dokumen -->
                    <div class="col-span-2">
                        <label for="file_dokumen" class="block text-sm font-medium text-gray-700 mb-2">
                            File Dokumen <span class="text-xs text-gray-500">(PDF/DOCX maks. 2MB)</span>
                        </label>
                        <input type="file" name="file_dokumen" id="file" 
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" required>

                        <!-- Pesan error -->
                        <p id="fileError" class="mt-2 text-sm text-red-500 hidden"></p>
                        
                        <!-- Preview -->
                        <div id="filePreview" class="mt-4 hidden">
                            <p class="text-sm text-gray-600 mb-2 font-semibold">Preview:</p>
                            <div id="previewContent" class="border rounded-lg p-3 bg-gray-50"></div>
                        </div>                    
                    </div>

                    <!-- Poster -->
                    <div class="col-span-2">
                        <label for="poster_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Poster / Foto Dokumentasi <span class="text-xs text-gray-500">(JPG, PNG maks. 2MB)</span>
                        </label>
                        <div class="flex items-center space-x-4">
                            <!-- Preview -->
                            <div id="photo-preview" class="hidden">
                                <img id="preview-img" src="" alt="Preview"
                                    class="w-32 h-32 object-cover rounded-lg border shadow-sm">
                            </div>

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

                    <!-- Link Dokumentasi -->
                    <div class="col-span-2">
                        <label for="link_dokumentasi" class="block text-sm font-medium text-gray-700 mb-2">Link Dokumentasi</label>
                        <input type="url" name="link_dokumentasi" id="link_dokumentasi" value="{{ old('link_dokumentasi') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="https://example.com">
                        @error('link_dokumentasi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            placeholder="Tuliskan deskripsi kerjasama">{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
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

<script>
    // 🟢 Tampilkan input berdasarkan sumber mitra
    document.querySelectorAll('input[name="is_from_mitra"]').forEach(radio => {
        radio.addEventListener('change', () => toggleMitraSection());
    });

    function toggleMitraSection() {
        const isFromMitra = document.querySelector('input[name="is_from_mitra"]:checked')?.value === '1';
        document.getElementById('mitra-section').classList.toggle('hidden', !isFromMitra);
        document.getElementById('organisasi-section').classList.toggle('hidden', isFromMitra);
    }

    toggleMitraSection();
</script>