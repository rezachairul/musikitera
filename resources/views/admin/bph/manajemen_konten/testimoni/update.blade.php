<!-- Modal Update Data -->
@foreach ($testimonis as $testimoni)
    <div id="UpdateModal-{{ $testimoni->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update Testimoni -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="updateForm" method="POST" action="{{ route('manage-testimoni.update', $testimoni->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Pilih Anggota -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="anggota_id" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Anggota (Alumni/Anggota Aktif)
                            </label>
                            <select name="anggota_id" id="anggota_id"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0" required>
                                <option value="">-- Pilih Anggota --</option>
                                @foreach ($anggotaAktif as $anggota)
                                    <option value="{{ $anggota->id }}"
                                        {{ (old('anggota_id', $testimoni->anggota_id) == $anggota->id) ? 'selected' : '' }}>
                                        {{ $anggota->nama }} - {{ $anggota->prodi }}
                                    </option>
                                @endforeach
                            </select>
                            @error('anggota_id')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div>
                            <label for="foto_input" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto <span class="text-xs text-gray-500">(JPG, JPEG, PNG • Maks 2MB)</span>
                            </label>

                            <div class="flex items-center space-x-4">
                                <!-- Preview lama -->
                                <div id="currentImagePreview-{{ $testimoni->id }}">
                                    @if($manage_testimoni->foto)
                                        <img src="{{ asset('storage/'.$manage_testimoni->foto) }}" alt="Foto"class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                    @else
                                        <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <!-- Upload baru -->
                                <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                    <label for="foto_input_{{ $manage_testimoni->id }}" class="cursor-pointer flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <span class="text-xs text-gray-500">Klik untuk upload baru</span>
                                    </label>
                                </div>

                                <!-- File input -->
                                <input id="foto_input_{{ $manage_testimoni->id }}" name="foto" type="file"  accept=".jpg,.jpeg,.png" class="hidden preview-edit-input"  data-id="{{ $manage_testimoni->id }}" onchange="previewEditImage(this)">
                            </div>

                            <p id="image-error" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>

                        <!-- Kesan -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="kesan" class="block text-sm font-medium text-gray-700 mb-2">
                                Kesan
                            </label>
                            <textarea name="kesan" id="kesan" rows="3"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                required>{{ old('kesan', $testimoni->kesan) }}</textarea>
                            @error('kesan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pesan -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">
                                Pesan
                            </label>
                            <textarea name="pesan" id="pesan" rows="3"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">{{ old('pesan', $testimoni->pesan) }}</textarea>
                            @error('pesan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeEditModal()"
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
            <button onclick="closeUpdateModal('{{ $testimoni->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

