<!-- Modal Update Data -->
@foreach ($galeris as $galeri)
    <div id="UpdateModal-{{ $galeri->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update Galeri -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="UpdateForm-{{ $galeri->id }}" method="POST" action="{{ route('manage-galeri.update', $galeri->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div class="col-span-1">
                            <label for="edit_title_{{ $galeri->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Judul
                            </label>
                            <input type="text" name="title" id="edit_title_{{ $galeri->id }}" value="{{ old('title', $galeri->title) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Masukan judul galeri" required>
                            @error('title')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Kegiatan -->
                        <div class="col-span-1">
                            <label for="edit_kegiatan_date_{{ $galeri->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Kegiatan
                            </label>
                            <input type="date" name="kegiatan_date" id="edit_kegiatan_date_{{ $galeri->id }}" value="{{ old('kegiatan_date',$galeri->kegiatan_date ) }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0">
                            @error('kegiatan_date')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi (full width) -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_description_{{ $galeri->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Deskripsi
                            </label>
                            <textarea name="description" id="edit_description_{{ $galeri->id }}" rows="3"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:border-blue-500 focus:ring-0"
                                placeholder="Masukan deskripsi galeri">{{ old('description', $galeri->description ) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="image_input_{{ $galeri->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Foto <span class="text-xs text-gray-500">(JPG, JPEG, PNG • Maks 2MB)</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <!-- Preview lama -->
                                <div id="currentImagePreview-{{ $galeri->id }}">
                                    @if($galeri->image)
                                        <img src="{{ asset('storage/'.$galeri->image) }}" alt="Foto"
                                            class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                    @else
                                        <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <!-- Upload baru -->
                                 <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                     <label for="image_input_{{ $galeri->id }}" class="cursor-pointer flex flex-col items-center">
                                         <svg xmlns="http://www.w3.org/2000/svg" class="size-12 text-gray-300 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909M3.75 19.5h16.5a1.5 1.5 0 0 0 1.5-1.5V6A1.5 1.5 0 0 0 20.25 4.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 1.5 0 0 0 1.5 1.5Z" />
                                         </svg>
                                         <span class="text-xs text-gray-500">Klik untuk upload</span>
                                     </label>
                                 </div>

                                <!-- File input -->
                                <input id="image_input_{{ $galeri->id }}" name="image" type="file"
                                    accept=".jpg,.jpeg,.png"
                                    class="hidden preview-edit-input"
                                    data-id="{{ $galeri->id }}">
                            </div>
                            <p id="image-error-{{ $galeri->id }}" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $galeri->id }}')"
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
            <button onclick="closeUpdateModal('{{ $galeri->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

