<!-- Modal Edit Data -->
@foreach ($manage_dokumens as $manage_dokumen)
    <div id="UpdateModal-{{ $manage_dokumen->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative max-h-screen overflow-y-auto">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form Update Dokumen -->
            <form id="editForm-{{ $manage_dokumen->id }}" method="POST" 
                action="{{ route('manage-dokumen.update', $manage_dokumen->id) }}" 
                enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Grid 2 Kolom -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Judul -->
                    <div>
                        <label for="edit_judul-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">Judul Dokumen</label>
                        <input type="text" name="judul" id="edit_judul-{{ $manage_dokumen->id }}"
                            value="{{ $manage_dokumen->judul }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="Masukan judul dokumen" required>
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="edit_kategori-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="kategori" id="edit_kategori-{{ $manage_dokumen->id }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Kategori --</option>
                            <option value="SOP" {{ $manage_dokumen->kategori == 'SOP' ? 'selected' : '' }}>SOP</option>
                            <option value="MoU" {{ $manage_dokumen->kategori == 'MoU' ? 'selected' : '' }}>MoU</option>
                            <option value="Format" {{ $manage_dokumen->kategori == 'Format' ? 'selected' : '' }}>Format</option>
                        </select>
                    </div>

                    <!-- Tahun Terbit -->
                    <div>
                        <label for="edit_year_published-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">Tahun Terbit</label>
                        <input type="number" name="year_published" id="edit_year_published-{{ $manage_dokumen->id }}"
                            value="{{ $manage_dokumen->year_published }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            placeholder="contoh: 2023" min="1900" max="{{ date('Y') }}">
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="edit_is_active-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select name="is_active" id="edit_is_active-{{ $manage_dokumen->id }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <option value="1" {{ $manage_dokumen->is_active ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ !$manage_dokumen->is_active ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                </div>

                <!-- Deskripsi --> 
                <div class="mt-6">
                    <label for="edit_deskripsi-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" id="edit_deskripsi-{{ $manage_dokumen->id }}" rows="3"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukan deskripsi singkat dokumen">{{ $manage_dokumen->deskripsi }}</textarea>
                </div>

                <!-- Upload File -->
                <div class="mt-6">
                    <label for="edit_file-{{ $manage_dokumen->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                        Upload File (opsional)
                    </label>
                    <input type="file" name="file" id="edit_file-{{ $manage_dokumen->id }}" 
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        onchange="EditPreviewDoc('{{ $manage_dokumen->id }}')">

                    <!-- Pesan error -->
                    <p id="edit_fileError-{{ $manage_dokumen->id }}" class="mt-2 text-sm text-red-500 hidden"></p>
                    
                    <!-- Preview -->
                    <div id="filePreview-{{ $manage_dokumen->id }}" class="mt-4 {{ $manage_dokumen->file ? '' : 'hidden' }}">
                        <p class="text-sm text-gray-600 mb-2 font-semibold">Preview:</p>
                        <div id="previewContent-{{ $manage_dokumen->id }}" class="border rounded-lg p-3 bg-gray-50">
                            @if($manage_dokumen->file && pathinfo($manage_dokumen->file, PATHINFO_EXTENSION) === 'pdf')
                                <iframe src="{{ asset('storage/dokumen/'.$manage_dokumen->file) }}" class="w-full h-96 border rounded-lg"></iframe>
                            @elseif($manage_dokumen->file)
                                <p class="text-sm text-gray-700">{{ $manage_dokumen->file }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $manage_dokumen->id }}')"
                        class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                        Batal
                    </button>
                    <button type="submit"
                        class="px-4 py-2 text-sm text-white bg-amber-600 rounded-lg hover:bg-amber-700">
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $manage_dokumen->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

