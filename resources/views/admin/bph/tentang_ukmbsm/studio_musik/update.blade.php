@foreach ($facilities as $facility)
<!-- Modal Tambah Data -->
<div id="UpdateModal-{{ $facility->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg  xmlns="http://www.w3.org/2000/svg"  fill="none"  viewBox="0 0 24 24"  stroke-width="1.5"  stroke="currentColor"  class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah Fasilitas Studio Musik</h2>
        </div>

        <!-- Form Create Facilities -->
        <form id="UpdateForm-{{ $facility->id }}" method="POST" action="{{ route('manage-studio-musik.facilities.update', $facility->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Nama Fasilitas -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Nama Fasilitas
                    </label>
                    <input type="text" name="nama" value="{{ old('nama', $facility->nama) }}"
                        required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: Drum Set">
                </div>

                <!-- Urutan -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Urutan
                    </label>
                    <input type="number" name="urutan" value="{{ old('urutan', $facility->urutan) }}"
                        required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Contoh: 1" >
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" rows="3"
                        required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Deskripsi singkat fasilitas" >{{ old('deskripsi', $facility->deskripsi) }}</textarea>
                </div>

                <!-- Image -->
                <div class="col-span-1 md:col-span-2">
                    <label for="image_input" class="block text-sm font-medium text-gray-700 mb-2">
                        Foto <span class="text-xs text-gray-500">(Format: JPG, JPEG, PNG • Maks 2MB)</span>
                    </label>

                    <div class="flex items-center space-x-4">
                        <!-- Preview lama -->                        
                        <div id="currentImagePreview-{{ $facility->id }}">
                            @if($facility->image)
                                <img src="{{ asset('storage/'.$facility->image) }}" alt="Foto" class="w-32 h-32 object-cover rounded-lg border shadow-sm">
                            @else
                                <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                            @endif
                        </div>

                         <!-- Upload area baru -->
                        <div class="flex flex-col md:flex-row items-start md:items-center space-y-3 md:space-y-0 md:space-x-4">      
                            <label for="image_input-{{ $facility->id }}"
                                class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-300 mb-1"><path stroke-linecap="round" stroke-linejoin="round"d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                </svg>
                                <span class="text-xs text-gray-500">Klik untuk upload baru</span>
                            </label>
                        </div>

                        <!-- File input -->
                        <input id="image_input-{{ $facility->id }}" name="image" type="file" accept=".jpg,.jpeg,.png" class="hidden preview-edit-input" data-id="{{ $facility->id }}" onchange="previewEditImage(this)">
                                           
                        <!-- Error message -->
                        <p id="foto-error-{{ $facility->id }}" class="mt-2 text-sm text-red-600 hidden"></p>
                        @error('image')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>                       
                </div>

                <!-- Status -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</span>
                    <div class="flex items-center gap-6">
                        
                        <!-- Ya -->
                        <label class="flex items-center cursor-pointer">
                        <input type="radio" name="is_active" value="1" {{ old('is_active', $facility->is_active) == 1 ? 'checked' : '' }}
                                class="hidden peer" checked>
                        <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                    peer-checked:border-blue-600 peer-checked:bg-blue-600 transition"></span>
                        <span class="ml-2 text-sm text-gray-700">Aktif</span>
                        </label>

                        <!-- Tidak -->
                        <label class="flex items-center cursor-pointer">
                        <input type="radio" name="is_active" value="0" {{ old('is_active', $facility->is_active) == 0 ? 'checked' : '' }}
                                class="hidden peer">
                        <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                    peer-checked:border-red-600 peer-checked:bg-red-600 transition"></span>
                        <span class="ml-2 text-sm text-gray-700">Tidak Aktif</span>
                        </label>

                    </div>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button"
                        onclick="closeUpdateModal('{{ $facility->id }}')"
                        class="px-4 py-2 text-sm bg-gray-100 text-gray-600 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-amber-600 rounded-lg hover:bg-amber-700">
                    Update
                </button>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeUpdateModal('{{ $facility->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endforeach
