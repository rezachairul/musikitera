<!-- Modal Update Data -->
@foreach ($pengumumans as $pengumuman)
    <div id="UpdateModal-{{ $pengumuman->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update pengumuman -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form method="POST" action="{{ route('manage-pengumuman.update', $pengumuman->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Judul Pengumuman -->
                        <div class="md:col-span-2">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Pengumuman</label>
                            <input type="text" name="judul" id="judul"
                                value="{{ old('judul', $pengumuman->judul) }}"
                                class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Masukkan judul pengumuman" required>
                            @error('judul') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Sifat Pengumuman -->
                        <div>
                            <label for="sifat" class="block text-sm font-medium text-gray-700 mb-2">Sifat Pengumuman</label>
                            <select name="sifat" id="sifat"
                                class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                                @foreach (['umum', 'internal', 'penting', 'rahasia'] as $sifat)
                                    <option value="{{ $sifat }}" {{ old('sifat', $pengumuman->sifat) == $sifat ? 'selected' : '' }}>
                                        {{ ucfirst($sifat) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sifat') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Tanggal Pengumuman -->
                        <div>
                            <label for="tanggal_pengumuman" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Pengumuman</label>
                            <input type="date" name="tanggal_pengumuman" id="tanggal_pengumuman"
                                value="{{ old('tanggal_pengumuman', $pengumuman->tanggal_pengumuman) }}"
                                class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('tanggal_pengumuman') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Isi Pengumuman -->
                        <div class="md:col-span-2">
                            <label for="isi" class="block text-sm font-medium text-gray-700 mb-2">Isi Pengumuman</label>
                            <textarea name="isi" id="isi" rows="4"
                                class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Tulis isi pengumuman di sini...">{{ old('isi', $pengumuman->isi) }}</textarea>
                            @error('isi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Gambar (gambar / Banner) -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">gambar / Gambar (opsional)</label>
                            
                            <div class="flex items-center gap-4">
                                <!-- Upload Box -->
                                <div class="flex flex-col items-center justify-center w-40 h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 transition">
                                    <label for="gambar-{{ $pengumuman->id }}" class="cursor-pointer flex flex-col items-center">
                                        <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                        <span id="upload-text-{{ $pengumuman->id }}" class="text-xs text-gray-500">Klik untuk update gambar</span>
                                    </label>
                                </div>

                                <!-- Preview Box -->
                                <div id="currentImagePreview-{{ $pengumuman->id }}">
                                    @if($pengumuman->gambar_path)
                                        <img src="{{ asset('storage/' . $pengumuman->gambar_path) }}" 
                                            class="w-40 h-28 object-cover rounded-lg shadow-md border" />
                                    @else
                                        <p class="text-gray-500 text-sm">Belum ada gambar</p>
                                    @endif
                                </div>
                            </div>

                            <input 
                                id="gambar-{{ $pengumuman->id }}" 
                                type="file" 
                                name="gambar" 
                                class="hidden preview-edit-input" 
                                data-id="{{ $pengumuman->id }}" 
                                accept=".jpg,.jpeg,.png">

                            <p id="image-error-{{ $pengumuman->id }}" class="text-sm text-red-600 hidden mt-1"></p>
                        </div>

                        <!-- File Dokumen (Lampiran opsional) -->
                        <div class="col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lampiran Dokumen (PDF/Word/Excel/PPT)</label>

                            <input 
                                type="file" id="edit_file-{{ $pengumuman->id }}" name="lampiran" 
                                class="w-full border rounded-lg px-3 py-2" 
                                accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx" 
                                onchange="EditPreviewDoc('{{ $pengumuman->id }}')">

                            <p id="edit_fileError-{{ $pengumuman->id }}" class="text-sm text-red-600 hidden mt-1"></p>

                            <!-- PREVIEW AREA -->
                            <div id="filePreview-{{ $pengumuman->id }}" 
                                class="mt-2 border rounded-lg p-2 {{ $pengumuman->file_dokumen_path ? '' : 'hidden' }}">
                                
                                <p class="text-sm text-gray-600 mb-2 font-semibold">Preview:</p>

                                <!-- Preview Lama -->
                                <div id="oldPreviewContent-{{ $pengumuman->id }}"
                                    class="border rounded-lg p-3 bg-gray-50 {{ $pengumuman->file_dokumen_path ? '' : 'hidden' }}">
                                    @if($pengumuman->file_dokumen_path && pathinfo($pengumuman->file_dokumen_path, PATHINFO_EXTENSION) === 'pdf')
                                        <iframe src="{{ asset('storage/'.$pengumuman->file_dokumen_path) }}" 
                                                class="w-full h-96 border rounded-lg"></iframe>
                                    @elseif($pengumuman->file_dokumen_path)
                                        <p class="text-sm text-gray-700">
                                            {{ $manage_dokumen->original_filename ?? basename($pengumuman->file_dokumen_path) }}
                                        </p>
                                    @endif
                                </div>
                                
                                <!-- Preview Baru -->
                                <div id="previewContent-{{ $pengumuman->id }}" class="border rounded-lg p-3 bg-gray-50 hidden"></div>
                            </div>
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select name="status" id="status"
                                class="w-full px-3 py-2 border rounded-lg focus:border-blue-500 focus:ring-0">
                                @foreach (['draft', 'publish', 'arsip'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $pengumuman->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('status') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>

                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $pengumuman->id }}')"
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
            <button onclick="closeUpdateModal('{{ $pengumuman->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

<!-- Script -->
 <script>
    
    // ==================================
    // DEKLARASI GLOBAL (PENTING!)
    // ==================================
    // Pastikan baris ini ada di luar fungsi, di bagian paling atas script JS kamu
    let currentObjectURL = {}; 

    // ==================================
    // Untuk UPDATE (Sudah Diperbaiki)
    // ==================================
    function EditPreviewDoc(id) {
        const input = document.getElementById(`edit_file-${id}`);
        const previewWrapper = document.getElementById(`filePreview-${id}`);
        const previewContent = document.getElementById(`previewContent-${id}`);
        const oldPreview = document.getElementById(`oldPreviewContent-${id}`);
        const errorMsg = document.getElementById(`edit_fileError-${id}`);

        // Tambahkan pengecekan ini untuk mencegah error jika elemen tidak ditemukan
        if (!input || !previewWrapper || !previewContent || !oldPreview || !errorMsg) {
            console.error(`Elemen preview tidak lengkap untuk ID: ${id}`);
            return;
        }

        // 1. Bersihkan URL objek lama jika ada
        if (currentObjectURL[id]) {
            URL.revokeObjectURL(currentObjectURL[id]);
            currentObjectURL[id] = null;
        }

        const file = input.files[0];

        // Reset error dan preview baru
        errorMsg.classList.add("hidden");
        errorMsg.textContent = "";
        previewContent.innerHTML = "";
        previewContent.classList.add("hidden");

        
        // ===================================
        // KASUS 1: Tidak ada file dipilih (Batalkan)
        // ===================================
        if (!file) {
            // Tampilkan preview lama (jika konten di dalamnya ada)
            if (oldPreview.children.length > 0) {
                oldPreview.classList.remove("hidden");
                previewWrapper.classList.remove("hidden");
            } else {
                // Jika tidak ada file lama, sembunyikan wrapper
                previewWrapper.classList.add("hidden");
            }
            return;
        }

        // ===================================
        // KASUS 2: Ada file baru dipilih
        // ===================================
        
        // **TINDAKAN PENTING:** Sembunyikan preview lama saat file baru dipilih
        oldPreview.classList.add("hidden");
        previewWrapper.classList.remove("hidden"); // Pastikan Wrapper utama Tampil

        // 2. Validasi Ukuran (Max 5MB) - Hanya ada satu blok validasi ukuran
        if (file.size > 5 * 1024 * 1024) {
            errorMsg.textContent = "File terlalu besar, maksimal 5MB.";
            errorMsg.classList.remove("hidden");
            input.value = ""; // Hapus file yang dipilih
            oldPreview.classList.remove("hidden"); // Kembalikan preview lama
            return;
        }

        // 3. Validasi Tipe File
        const allowedTypes = [
            "application/pdf",
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/vnd.ms-excel",
            "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
            "application/vnd.ms-powerpoint",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation"
        ];

        if (!allowedTypes.includes(file.type)) {
            errorMsg.textContent = "Hanya file PDF, Word, Excel, dan PowerPoint yang diperbolehkan.";
            errorMsg.classList.remove("hidden");
            input.value = ""; // Bersihkan input file
            oldPreview.classList.remove("hidden"); // Kembalikan preview lama
            return;
        }

        // 4. Tampilkan Preview Baru
        const fileURL = URL.createObjectURL(file);
        currentObjectURL[id] = fileURL; // Simpan URL untuk pembersihan

        // Logic Tampilan Preview (PDF vs Non-PDF)
        if (file.type === "application/pdf") {
            previewContent.innerHTML = `
                <iframe src="${fileURL}" class="w-full h-96 border rounded-lg"></iframe>
            `;
        } else {
            // Tampilan untuk Word/Excel/PPT
            previewContent.innerHTML = `
                <div class="flex items-center gap-3 p-2">
                    <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 0011.586 1H4zm5 9l-1.5 4-1.5-4H4l2.5 7h2L11 11H9z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-800">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                    </div>
                </div>
            `;
        }

        // Pastikan preview baru tampil
        previewContent.classList.remove("hidden");
    }
 </script>