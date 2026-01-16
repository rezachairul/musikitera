<!-- Modal Edit Data -->
@foreach ($alumnis as $alumni)
    <div id="UpdateModal-{{ $alumni->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form Update Anggota Aktif -->
            <form id="editForm-{{ $alumni->id }}" method="POST" action="{{ route('manage-alumni.update', $alumni->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Pilih Alumni -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Alumni</label>
                        <select name="anggota_id"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm"
                            required>
                            <option value="">-- Pilih Alumni --</option>
                            @foreach (\App\Models\admin\bph\manajemen_anggota\AnggotaAktif::where('status','graduate')->get() as $anggota)
                                <option value="{{ $anggota->id }}"
                                    {{ old('anggota_id', $alumni->anggota_id) == $anggota->id ? 'selected' : '' }}>
                                    {{ $anggota->nama }} ({{ $anggota->nia }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Tahun Lulus -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tahun Lulus</label>
                        <input type="number" name="tahun_lulus"
                            value="{{ old('tahun_lulus', $alumni->tahun_lulus) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- Pekerjaan -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Pekerjaan</label>
                        <input type="text" name="pekerjaan"
                            value="{{ old('pekerjaan', $alumni->pekerjaan) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <span class="text-xs text-red-500">Kosongkan jika tidak ada</span>
                    </div>

                    <!-- LinkedIn -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">LinkedIn</label>
                        <input type="text" name="url"
                            value="{{ old('url', $alumni->url) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <span class="text-xs text-red-500">Kosongkan jika tidak ada</span>
                    </div>

                    <!-- Quote -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Quote / Kesan</label>
                        <textarea name="quote" rows="3"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">{{ old('quote', $alumni->quote) }}</textarea>
                    </div>

                    <!-- Upload Foto -->
                    <div class="md:col-span-2">
                        <label for="foto_input" class="block text-sm font-medium text-gray-700 mb-2">
                            Foto Alumni <br>
                            <span class="text-xs text-gray-500">(Kosongkan jika tidak diganti)</span>
                        </label>

                        <div class="flex items-center space-x-4">
                            <!-- Foto Lama -->
                            <div id="currentImagePreview-{{ $alumni->id }}">
                                @if($alumni->foto)
                                <img src="{{ asset('storage/'.$alumni->foto) }}" alt="Foto" class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                @else
                                <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                @endif
                            </div>

                            <!-- Upload area -->
                            <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                <label for="foto_input_{{ $alumni->id }}" class="cursor-pointer flex flex-col items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z" />
                                    </svg>
                                    <span class="text-xs text-gray-500">Klik untuk upload baru</span>
                                </label>
                            </div>

                            <input id="foto_input_{{ $alumni->id }}" name="foto" type="file" accept=".jpg,.jpeg,.png" class="hidden preview-edit-input" data-id="{{ $alumni->id }}" onchange="previewEditImage(this)">
                        </div>
                        <p id="image-error" class="mt-2 text-sm text-red-600 hidden"></p>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="flex justify-end space-x-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $alumni->id }}')"
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
            <button onclick="closeUpdateModal('{{ $alumni->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

