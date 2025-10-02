<!-- Modal Update Data -->
@foreach ($kegiatans as $kegiatan)
    <div id="UpdateModal-{{ $kegiatan->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update kegiatan -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="UpdateForm-{{ $kegiatan->id }}" method="POST" 
                    action="{{ route('manage-kegiatan.update', $kegiatan->id) }}" 
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Kegiatan -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_nama_kegiatan_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kegiatan
                            </label>
                            <input type="text" name="nama_kegiatan" id="edit_nama_kegiatan_{{ $kegiatan->id }}" 
                                value="{{ old('nama_kegiatan', $kegiatan->nama_kegiatan) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                                        focus:border-blue-500 focus:ring-0"
                                placeholder="Masukan nama kegiatan" required>
                            @error('nama_kegiatan')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="col-span-1">
                            <label for="edit_kategori_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori
                            </label>
                            <select name="kategori" id="edit_kategori_{{ $kegiatan->id }}" 
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                                        focus:border-blue-500 focus:ring-0">
                                <option value="">-- Pilih Kategori --</option>
                                <option value="Internal" {{ old('kategori', $kegiatan->kategori) == 'Internal' ? 'selected' : '' }}>Internal</option>
                                <option value="Eksternal" {{ old('kategori', $kegiatan->kategori) == 'Eksternal' ? 'selected' : '' }}>Eksternal</option>
                                <option value="Latihan Rutin" {{ old('kategori', $kegiatan->kategori) == 'Latihan Rutin' ? 'selected' : '' }}>Latihan Rutin</option>
                            </select>
                            @error('kategori')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="col-span-1">
                            <label for="edit_lokasi_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Lokasi
                            </label>
                            <input type="text" name="lokasi" id="edit_lokasi_{{ $kegiatan->id }}" 
                                value="{{ old('lokasi', $kegiatan->lokasi) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                                        focus:border-blue-500 focus:ring-0"
                                placeholder="Masukan lokasi kegiatan">
                            @error('lokasi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="col-span-1">
                            <label for="edit_tanggal_mulai_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai
                            </label>
                            <input type="date" name="tanggal_mulai" id="edit_tanggal_mulai_{{ $kegiatan->id }}" 
                                value="{{ old('tanggal_mulai', $kegiatan->tanggal_mulai) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('tanggal_mulai')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="col-span-1">
                            <label for="edit_tanggal_selesai_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Selesai
                            </label>
                            <input type="date" name="tanggal_selesai" id="edit_tanggal_selesai_{{ $kegiatan->id }}" 
                                value="{{ old('tanggal_selesai', $kegiatan->tanggal_selesai) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('tanggal_selesai')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Mulai -->
                        <div class="col-span-1">
                            <label for="edit_jam_mulai_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Mulai
                            </label>
                            <input type="time" name="jam_mulai" id="edit_jam_mulai_{{ $kegiatan->id }}" 
                                value="{{ old('jam_mulai', $kegiatan->jam_mulai) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('jam_mulai')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jam Selesai -->
                        <div class="col-span-1">
                            <label for="edit_jam_selesai_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Jam Selesai
                            </label>
                            <input type="time" name="jam_selesai" id="edit_jam_selesai_{{ $kegiatan->id }}" 
                                value="{{ old('jam_selesai', $kegiatan->jam_selesai) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('jam_selesai')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_deskripsi_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="deskripsi" id="edit_deskripsi_{{ $kegiatan->id }}" rows="3"
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                    placeholder="Masukan deskripsi kegiatan">{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Poster -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Poster
                            </label>
                            <div class="flex items-center space-x-4">
                                @if($kegiatan->poster)
                                    <img src="{{ asset('storage/'.$kegiatan->poster) }}" 
                                        class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                @else
                                    <p class="text-gray-500 text-sm">Belum ada poster</p>
                                @endif
                                <input type="file" name="poster" accept=".jpg,.jpeg,.png"
                                    class="w-full text-sm text-gray-700">
                            </div>
                            @error('poster')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lampiran -->
                        <div class="col-span-1 md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Lampiran (Proposal / Rundown)
                            </label>
                            <input type="file" name="lampiran" accept=".pdf,.doc,.docx"
                                class="w-full text-sm text-gray-700">
                            @if($kegiatan->lampiran)
                                <p class="text-xs text-gray-500 mt-1">File saat ini: 
                                    <a href="{{ asset('storage/'.$kegiatan->lampiran) }}" target="_blank" class="text-blue-600 hover:underline">
                                        {{ basename($kegiatan->lampiran) }}
                                    </a>
                                </p>
                            @endif
                            @error('lampiran')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1">
                            <label for="edit_status_{{ $kegiatan->id }}" 
                                class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <select name="status" id="edit_status_{{ $kegiatan->id }}" 
                                    class="w-full px-3 py-2 border border-gray-200 rounded-lg 
                                        focus:border-blue-500 focus:ring-0">
                                <option value="draft" {{ old('status', $kegiatan->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                <option value="published" {{ old('status', $kegiatan->status) == 'published' ? 'selected' : '' }}>Dipublikasikan</option>
                                <option value="done" {{ old('status', $kegiatan->status) == 'done' ? 'selected' : '' }}>Selesai</option>
                            </select>
                            @error('status')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Highlight -->
                        <div class="col-span-1 flex items-center mt-6">
                            <input type="checkbox" name="is_highlight" id="edit_is_highlight_{{ $kegiatan->id }}" 
                                value="1" {{ old('is_highlight', $kegiatan->is_highlight) ? 'checked' : '' }}
                                class="h-4 w-4 text-blue-600 border-gray-300 rounded">
                            <label for="edit_is_highlight_{{ $kegiatan->id }}" 
                                class="ml-2 block text-sm text-gray-700">
                                Tandai sebagai Highlight
                            </label>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $kegiatan->id }}')"
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
            <button onclick="closeUpdateModal('{{ $kegiatan->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

