<!-- Modal Update Data -->
@foreach ($links as $link)
    <div id="UpdateModal-{{ $link->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update Link -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="editForm" method="POST" action="{{ route('manage-link.update', $link->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Link -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="nama_link" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Link
                            </label>
                            <input type="text" name="nama_link" id="nama_link" 
                                value="{{ old('nama_link', $link->nama_link) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Contoh: Grup WA Oprec 2025" required>
                            @error('nama_link')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="url" class="block text-sm font-medium text-gray-700 mb-2">
                                URL Link
                            </label>
                            <input type="url" name="url" id="url" 
                                value="{{ old('url', $link->url) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="https://contoh.com/link" required>
                            @error('url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">
                                Kategori
                            </label>
                            <select name="kategori" id="kategori"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach (App\Models\admin\bph\manajemen_konten\Link::getKategoriList() as $key => $label)
                                    <option value="{{ $key }}" {{ old('kategori', $link->kategori) == $key ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endforeach
                            </select>
                            @error('kategori')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi (Opsional)
                            </label>
                            <textarea name="deskripsi" id="deskripsi" rows="3"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Tambahkan keterangan singkat...">{{ old('deskripsi', $link->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                                Status
                            </label>
                            <div class="flex items-center space-x-4">
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="1" 
                                        {{ old('status', $link->status) == 1 ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Aktif</span>
                                </label>
                                <label class="flex items-center">
                                    <input type="radio" name="status" value="0" 
                                        {{ old('status', $link->status) == 0 ? 'checked' : '' }}
                                        class="text-blue-600 focus:ring-blue-500 border-gray-300">
                                    <span class="ml-2 text-sm text-gray-700">Nonaktif</span>
                                </label>
                            </div>
                            @error('status')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeEditModal()"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                            Perbarui
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $link->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

