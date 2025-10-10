<!-- Modal Update Data -->
@foreach ($kerjasamas as $kerjasama)
    <div id="UpdateModal-{{ $kerjasama->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update Kerjasama -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="editForm-{{ $kerjasama->id }}" method="POST" action="{{ route('manage-kerjasama.update', $kerjasama->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Sumber Kerjasama -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Sumber Kerjasama</label>
                            <div class="flex items-center space-x-6">
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="is_from_mitra" value="1"
                                        class="text-blue-600 focus:ring-blue-500"
                                        {{ old('is_from_mitra', $kerjasama->is_from_mitra) == '1' ? 'checked' : '' }}>
                                    <span>Dari Mitra Terdaftar</span>
                                </label>
                                <label class="flex items-center space-x-2">
                                    <input type="radio" name="is_from_mitra" value="0"
                                        class="text-blue-600 focus:ring-blue-500"
                                        {{ old('is_from_mitra', $kerjasama->is_from_mitra) == '0' ? 'checked' : '' }}>
                                    <span>Dari Organisasi Lain</span>
                                </label>
                            </div>
                            @error('is_from_mitra')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilih Mitra -->
                        <div id="edit-mitra-section-{{ $kerjasama->id }}" class="{{ $kerjasama->is_from_mitra ? '' : 'hidden' }}">
                            <label for="edit_mitra_id_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Pilih Mitra</label>
                            <select id="edit_mitra_id_{{ $kerjasama->id }}" name="mitra_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                <option value="">-- Pilih Mitra --</option>
                                @foreach ($mitras as $mitra)
                                    <option value="{{ $mitra->id }}" {{ old('mitra_id', $kerjasama->mitra_id) == $mitra->id ? 'selected' : '' }}>
                                        {{ $mitra->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mitra_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Organisasi -->
                        <div id="edit-organisasi-section-{{ $kerjasama->id }}" class="{{ $kerjasama->is_from_mitra ? 'hidden' : '' }}">
                            <label for="edit_nama_organisasi_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Nama Organisasi</label>
                            <input type="text" name="nama_organisasi" id="edit_nama_organisasi_{{ $kerjasama->id }}"
                                value="{{ old('nama_organisasi', $kerjasama->nama_organisasi) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Masukan nama organisasi">
                            @error('nama_organisasi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Judul Kerjasama -->
                        <div class="col-span-2">
                            <label for="edit_judul_kerjasama_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Judul Kerjasama</label>
                            <input type="text" name="judul_kerjasama" id="edit_judul_kerjasama_{{ $kerjasama->id }}"
                                value="{{ old('judul_kerjasama', $kerjasama->judul_kerjasama) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                            @error('judul_kerjasama')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Kerjasama -->
                        <div>
                            <label for="edit_jenis_kerjasama_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Jenis Kerjasama</label>
                            <select id="edit_jenis_kerjasama_{{ $kerjasama->id }}" name="jenis_kerjasama"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @foreach (['MoU', 'MoA', 'Event', 'Proyek', 'Sponsorship', 'Lainnya'] as $jenis)
                                    <option value="{{ $jenis }}" {{ old('jenis_kerjasama', $kerjasama->jenis_kerjasama) == $jenis ? 'selected' : '' }}>
                                        {{ $jenis }}
                                    </option>
                                @endforeach
                            </select>
                            @error('jenis_kerjasama')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="edit_status_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="edit_status_{{ $kerjasama->id }}" name="status"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                @foreach (['rencana', 'berjalan', 'selesai'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $kerjasama->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal -->
                        <div>
                            <label for="edit_tanggal_mulai_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai_{{ $kerjasama->id }}"
                                value="{{ old('tanggal_mulai', $kerjasama->tanggal_mulai) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                        </div>

                        <div>
                            <label for="edit_tanggal_selesai_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai_{{ $kerjasama->id }}"
                                value="{{ old('tanggal_selesai', $kerjasama->tanggal_selesai) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200">
                        </div>

                        <!-- File Dokumen -->
                        <div class="col-span-2">
                            <label for="edit_file_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                File Dokumen
                            </label>

                            <input
                            type="file" id="edit_file-{{ $kerjasama->id }}" name="lampiran" 
                            class="w-full border rounded-lg px-3 py-2" 
                            accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" 
                            onchange="EditPreviewDoc('{{ $kerjasama->id }}')">

                            <p id="edit_fileError-{{ $kerjasama->id }}" class="text-sm text-red-600 hidden mt-1"></p>

                            <!-- PREVIEW AREA -->
                            <div id="filePreview-{{ $kerjasama->id }}" 
                                class="mt-2 border rounded-lg p-2 {{ $kerjasama->file_dokumen_path ? '' : 'hidden' }}">
                                
                                <p class="text-sm text-gray-600 mb-2 font-semibold">Preview:</p>

                                <!-- Preview Lama -->
                                <div id="oldPreviewContent-{{ $kerjasama->id }}"
                                    class="border rounded-lg p-3 bg-gray-50 {{ $kerjasama->file_dokumen_path ? '' : 'hidden' }}">
                                    @if($kerjasama->file_dokumen_path && pathinfo($kerjasama->file_dokumen_path, PATHINFO_EXTENSION) === 'pdf')
                                        <iframe 
                                            src="{{ asset('storage/' . $kerjasama->file_dokumen_path) }}" 
                                            class="w-full h-96 border rounded-lg">
                                        </iframe>
                                    @elseif($kerjasama->file_dokumen_path)
                                        <p class="text-sm text-gray-700">
                                            {{ basename($kerjasama->file_dokumen_path) }}
                                        </p>
                                    @endif
                                </div>
                                
                                <!-- Preview Baru -->
                                <div id="previewContent-{{ $kerjasama->id }}" class="border rounded-lg p-3 bg-gray-50 hidden"></div>
                            </div>
                        </div>

                        <!-- Poster -->
                        <div class="col-span-2">
                            <label for="edit_poster_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Poster / Foto Dokumentasi
                            </label>

                            <div class="flex items-center gap-4">
                                <!-- Upload Box -->
                                <div class="flex flex-col items-center justify-center w-40 h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                    <label for="poster-{{ $kerjasama->id }}" class="cursor-pointer flex flex-col items-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span id="upload-text-{{ $kerjasama->id }}" class="text-xs text-gray-500">Klik untuk update poster</span>
                                    </label>
                                </div>

                                <!-- Preview Box -->
                                <div id="currentImagePreview-{{ $kerjasama->id }}">
                                    @if($kerjasama->poster)
                                        <img src="{{ asset('storage/kerjasama/poster/' . $kerjasama->poster) }}" 
                                            class="w-40 h-28 object-cover rounded-lg shadow-md border" />
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada poster</p>
                                    @endif
                                </div>
                            </div>

                            <input 
                                id="poster-{{ $kerjasama->id }}" 
                                type="file" 
                                name="poster" 
                                class="hidden preview-edit-input" 
                                data-id="{{ $kerjasama->id }}" 
                                accept=".jpg,.jpeg,.png">

                            <p id="image-error-{{ $kerjasama->id }}" class="text-sm text-red-600 hidden mt-1"></p>
                        </div>

                        <!-- Link Dokumentasi -->
                        <div class="col-span-2">
                            <label for="edit_link_dokumentasi_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Link Dokumentasi</label>
                            <input type="url" name="link_dokumentasi" id="edit_link_dokumentasi_{{ $kerjasama->id }}"
                                value="{{ old('link_dokumentasi', $kerjasama->link_dokumentasi) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-span-2">
                            <label for="edit_deskripsi_{{ $kerjasama->id }}" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" id="edit_deskripsi_{{ $kerjasama->id }}" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-blue-200">{{ old('deskripsi', $kerjasama->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $kerjasama->id }}')"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-amber-600 rounded-lg hover:bg-amber-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $kerjasama->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

