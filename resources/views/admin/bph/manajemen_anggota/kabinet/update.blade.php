<!-- Modal Update Data -->
@foreach ($kabinets as $kabinet)
    <div id="UpdateModal-{{ $kabinet->id }}" class="hidden fixed inset-0 z-50 bg-black/50 flex items-center justify-center px-4">
        <div class="bg-white p-5 rounded-xl shadow-lg w-full max-w-2xl max-h-[90vh] flex flex-col relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update kabinet -->
            <div class="px-6 pb-6 overflow-y-auto">
                <form id="UpdateForm-{{ $kabinet->id }}" method="POST" action="{{ route('manage-kabinet.update', $kabinet->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Kabinet -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Kabinet
                            </label>
                            <input type="text" name="nama_kabinet" value="{{ old('nama_kabinet', $kabinet->nama_kabinet) }}"
                                class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500" required>
                        </div>

                        <!-- Status Kabinet -->
                        <div>
                            <span class="block text-sm font-medium text-gray-700 mb-2">
                                Status Kabinet
                            </span>

                            <div class="flex gap-6 mt-1">
                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="is_active" value="1"
                                        class="hidden peer"
                                        {{ old('is_active', $kabinet->is_active) ? 'checked' : '' }}>
                                    <span class="w-5 h-5 rounded-full border-2 peer-checked:bg-green-600 peer-checked:border-green-600"></span>
                                    <span class="ml-2 text-sm">Aktif</span>
                                </label>

                                <label class="flex items-center cursor-pointer">
                                    <input type="radio" name="is_active" value="0"
                                        class="hidden peer"
                                        {{ !old('is_active', $kabinet->is_active) ? 'checked' : '' }}>
                                    <span class="w-5 h-5 rounded-full border-2 peer-checked:bg-red-600 peer-checked:border-red-600"></span>
                                    <span class="ml-2 text-sm">Tidak Aktif</span>
                                </label>
                            </div>
                        </div>

                        <!-- Periode -->
                        <div>
                            <label class="block text-sm mb-2">Periode Awal</label>
                            <input type="number" name="periode_awal" value="{{ old('periode_awal', $kabinet->periode_awal) }}" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>

                        <div>
                            <label class="block text-sm mb-2">Periode Akhir</label>
                            <input type="number" name="periode_akhir" value="{{ old('periode_akhir', $kabinet->periode_akhir) }}" class="w-full px-3 py-2 border rounded-lg" required>
                        </div>

                        <!-- Logo -->
                        <div data-edit-preview-wrapper>
                            <label class="block text-sm mb-2">Logo Kabinet</label>

                            <div class="flex gap-4 items-center">

                                <!-- Preview lama -->
                                <div data-edit-preview-box class="{{ $kabinet->logo ? '' : 'hidden' }}">
                                    @if($kabinet->logo)
                                        <img data-edit-preview-img src="{{ asset('storage/'.$kabinet->logo) }}"
                                            class="w-24 h-24 object-cover rounded-lg border">
                                    @endif
                                </div>

                                <!-- Upload -->
                                <label class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                    <span data-edit-upload-text class="text-xs text-gray-500">
                                        Ganti Logo
                                    </span>
                                    <input type="file" name="logo" accept="image/*" class="hidden" onchange="previewEditImage(this)">
                                </label>
                            </div>

                            <p data-edit-error-msg class="hidden text-xs text-red-500"></p>
                        </div>

                        <!-- Banner -->
                        <div data-edit-preview-wrapper class="md:col-span-2">
                            <label class="block text-sm mb-2">Banner Kabinet</label>

                            <div class="space-y-3">

                                <!-- Upload Banner -->
                                <label class="flex flex-col items-center justify-center h-28 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                    <span data-edit-upload-text class="text-sm text-gray-500">
                                        Ganti Banner
                                    </span>
                                    <input type="file" name="banner" accept="image/*" class="hidden" onchange="previewEditImage(this)">
                                </label>

                                <div data-edit-preview-box class="{{ $kabinet->banner ? '' : 'hidden' }}">
                                    @if($kabinet->banner)
                                        <img data-edit-preview-img src="{{ asset('storage/'.$kabinet->banner) }}" class="w-full max-h-48 object-cover rounded-lg border">
                                    @endif
                                </div>

                                <p data-edit-error-msg class="hidden text-xs text-red-500"></p>
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label class="block text-sm mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="w-full px-3 py-2 border rounded-lg">{{ old('deskripsi', $kabinet->deskripsi) }}</textarea>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $kabinet->id }}')" class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" class="px-4 py-2 text-sm text-white bg-amber-600 rounded-lg hover:bg-amber-700">
                            Update
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $kabinet->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach
