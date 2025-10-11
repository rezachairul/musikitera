<!-- Modal Update Data -->
@foreach ($ctas as $cta)
    <div id="UpdateModal-{{ $cta->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update CTA -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="editForm" method="POST" action="{{ route('manage-cta.update', $cta->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Foto -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_foto_pendaftar_input{{ $cta->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto Pendaftar <span class="text-xs text-gray-500">(JPG, JPEG, PNG • Maks 2MB)</span>
                            </label>

                            <div class="flex items-center space-x-4">
                                <!-- Preview lama -->
                                <div id="currentImagePreview-{{ $cta->id }}">
                                    @if($cta->foto_pendaftar)
                                        <img src="{{ asset('storage/' . $cta->foto_pendaftar) }}" alt="Foto"class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                    @else
                                        <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <!-- Upload baru -->
                                <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                    <label for="foto_pendaftar_input_{{ $cta->id }}" class="cursor-pointer flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <span class="text-xs text-gray-500">Klik untuk upload baru</span>
                                    </label>
                                </div>

                                <!-- File input -->
                                <input id="foto_pendaftar_input_{{ $cta->id }}" name="foto_pendaftar" type="file" 
                                    accept=".jpg,.jpeg,.png"
                                    class="hidden preview-edit-input" 
                                    data-id="{{ $cta->id }}"
                                    >
                            </div>
                            <p id="image-error-{{ $cta->id }}" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>

                        <!-- Nama Lengkap -->
                        <div>
                            <label for="edit_nama_lengkap" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input type="text" name="nama_lengkap" id="edit_nama_lengkap"
                                value="{{ old('nama_lengkap', $cta->nama_lengkap) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- NIM -->
                        <div>
                            <label for="edit_nim" class="block text-sm font-medium text-gray-700">NIM</label>
                            <input type="text" name="nim" id="edit_nim"
                                value="{{ old('nim', $cta->nim) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Angkatan -->
                        <div>
                            <label for="edit_angkatan" class="block text-sm font-medium text-gray-700">Angkatan</label>
                            <input type="number" name="angkatan" id="edit_angkatan"
                                value="{{ old('angkatan', $cta->angkatan) }}"
                                min="2000" max="{{ date('Y') }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Program Studi -->
                        <div>
                            <label for="edit_program_studi" class="block text-sm font-medium text-gray-700">Program Studi</label>
                            <input type="text" name="program_studi" id="edit_program_studi"
                                value="{{ old('program_studi', $cta->program_studi) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Alamat Asli -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_alamat_asli" class="block text-sm font-medium text-gray-700">Alamat Asli</label>
                            <textarea name="alamat_asli" id="edit_alamat_asli" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>{{ old('alamat_asli', $cta->alamat_asli) }}</textarea>
                        </div>

                        <!-- Alamat Domisili -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_alamat_domisili" class="block text-sm font-medium text-gray-700">Alamat Domisili</label>
                            <textarea name="alamat_domisili" id="edit_alamat_domisili" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">{{ old('alamat_domisili', $cta->alamat_domisili) }}</textarea>
                        </div>

                        <!-- Nomor Telepon -->
                        <div>
                            <label for="edit_nomor_telepon" class="block text-sm font-medium text-gray-700">Nomor Telepon</label>
                            <input type="text" name="nomor_telepon" id="edit_nomor_telepon"
                                value="{{ old('nomor_telepon', $cta->nomor_telepon) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>

                        <!-- Instagram -->
                        <div>
                            <label for="edit_instagram" class="block text-sm font-medium text-gray-700">Instagram</label>
                            <input type="text" name="instagram" id="edit_instagram"
                                value="{{ old('instagram', $cta->instagram) }}"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>

                        <!-- Alasan Gabung -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_alasan_gabung" class="block text-sm font-medium text-gray-700">Alasan Gabung</label>
                            <textarea name="alasan_gabung" id="edit_alasan_gabung" rows="3"
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>{{ old('alasan_gabung', $cta->alasan_gabung) }}</textarea>
                        </div>

                        <!-- Minat -->
                        <div>
                            <label for="edit_minat" class="block text-sm font-medium text-gray-700">Minat</label>
                            <input type="text" name="minat" id="edit_minat"
                                value="{{ old('minat', $cta->minat) }}"
                                placeholder="Contoh: Gitar, Vokal, Soundman..."
                                class="mt-1 block w-full border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500"
                                required>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $cta->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

