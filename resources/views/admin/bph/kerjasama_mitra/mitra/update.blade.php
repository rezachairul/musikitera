<!-- Modal Update Data -->
@foreach ($mitras as $mitra)
    <div id="UpdateModal-{{ $mitra->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update mitra -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="editForm-{{ $mitra->id }}" method="POST" action="{{ route('manage-mitra.update', $mitra->id) }}" enctype="multipart/form-data"> 
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Mitra -->
                        <div>
                            <label for="edit_name_{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Nama Mitra
                            </label>
                            <input type="text" name="name" id="edit_name_{{ $mitra->id }}" 
                                value="{{ old('name', $mitra->name) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Masukan nama mitra" required>
                            @error('name')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- URL -->
                        <div>
                            <label for="url" class="block text-sm font-medium text-gray-700 mb-2">URL</label>
                            <input type="url" name="url" id="url"
                                value="{{ old('url', $mitra->url) }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm 
                                    focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="https://example.com">
                            @error('url')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Mitra -->
                        <div>
                            <label for="edit_type_{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-2">Jenis Mitra</label>
                            <select id="edit_type_{{ $mitra->id }}" name="type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="internal" {{ old('type', $mitra->type) == 'internal' ? 'selected' : '' }}>Internal</option>
                                <option value="eksternal" {{ old('type', $mitra->type) == 'eksternal' ? 'selected' : '' }}>Eksternal</option>
                            </select>
                            @error('type')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sub Jenis Mitra -->
                        <div>
                            <label for="edit_sub_type_{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                            <select id="edit_sub_type_{{ $mitra->id }}" name="sub_type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                required>
                                <option value="">-- Pilih Kategori --</option>
                                <!-- Akan diisi dinamis dengan JS -->
                            </select>
                            @error('sub_type')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="logo_input_{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-2">
                                Logo <span class="text-xs text-gray-500">(JPG, JPEG, PNG • Maks 2MB)</span>
                            </label>
                            <div class="flex items-center space-x-4">
                                <!-- Preview lama -->
                                <div id="currentImagePreview-{{ $mitra->id }}">
                                    @if($mitra->logo)
                                        <img src="{{ asset('storage/'.$mitra->logo) }}" alt="Foto"
                                            class="w-24 h-24 object-cover rounded-lg border shadow-sm">
                                    @else
                                        <p class="text-gray-500 text-sm">Tidak ada gambar</p>
                                    @endif
                                </div>

                                <!-- Upload baru -->
                                <div class="flex flex-col items-center justify-center w-32 h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-blue-400 hover:bg-gray-50 transition">
                                    <label for="logo_input_{{ $mitra->id }}" class="cursor-pointer flex flex-col items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-gray-300 mb-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 15.75 5.159-5.159a2.25 2.25 0 0 1 3.182 0l5.159 5.159m-1.5-1.5 
                                            1.409-1.409a2.25 2.25 0 0 1 3.182 0l2.909 2.909m-18 
                                            3.75h16.5a1.5 1.5 0 0 0 1.5-1.5V6a1.5 1.5 0 0 
                                            0-1.5-1.5H3.75A1.5 1.5 0 0 0 2.25 6v12a1.5 
                                            1.5 0 0 0 1.5 1.5Zm10.5-11.25h.008v.008h-.008V8.25Zm.375 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
                                        </svg>
                                        <span class="text-xs text-gray-500">Klik untuk upload baru</span>
                                    </label>
                                </div>

                                <!-- File input -->
                                <input id="logo_input_{{ $mitra->id }}" name="logo" type="file" 
                                    accept=".jpg,.jpeg,.png"
                                    class="hidden preview-edit-input" 
                                    data-id="{{ $mitra->id }}">
                            </div>
                            <p id="image-error-{{ $mitra->id }}" class="mt-2 text-sm text-red-600 hidden"></p>
                        </div>

                        <!-- Deskripsi -->
                        <div class="col-span-1 md:col-span-2">
                            <label for="edit_description_{{ $mitra->id }}" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                            <textarea name="description" id="edit_description_{{ $mitra->id }}" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Tuliskan deskripsi singkat mitra">{{ old('description', $mitra->description) }}</textarea>
                            @error('description')
                                <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tombol -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $mitra->id }}')"
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
            <button onclick="closeUpdateModal('{{ $mitra->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach


<script>
    document.addEventListener("DOMContentLoaded", () => {
    const options = {
        internal: [
            { value: "institusi", text: "Institusi" },
            { value: "ormawa_hmps", text: "Ormawa HMPS" },
            { value: "ormawa_ukm", text: "Ormawa UKM" },
        ],
        eksternal: [
            { value: "komunitas", text: "Komunitas" },
            { value: "ukmbs", text: "UKMBS" },
        ],
    };

    function updateSubTypeOptions(typeSelect, subTypeSelect, oldSubType = null) {
        subTypeSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
        if (options[typeSelect.value]) {
            options[typeSelect.value].forEach((opt) => {
                const option = document.createElement("option");
                option.value = opt.value;
                option.textContent = opt.text;
                if (oldSubType && oldSubType === opt.value) {
                    option.selected = true;
                }
                subTypeSelect.appendChild(option);
            });
        }
    }

    // Loop untuk semua pasangan select type/sub_type (baik create maupun update)
    document.querySelectorAll("select[id*='type_'], select#type").forEach(typeSelect => {
        // Cari pasangan sub_type (create pakai #sub_type, update pakai #edit_sub_type_{id})
        let subTypeSelect;
        if (typeSelect.id === "type") {
            subTypeSelect = document.getElementById("sub_type");
        } else {
            const id = typeSelect.id.replace("edit_type_", "");
            subTypeSelect = document.getElementById("edit_sub_type_" + id);
        }

        // Listener perubahan type
        typeSelect.addEventListener("change", function () {
            updateSubTypeOptions(typeSelect, subTypeSelect);
        });

        // Set default kalau ada value lama
        const oldType = typeSelect.dataset.old || typeSelect.value;
        const oldSubType = subTypeSelect.dataset.old || subTypeSelect.getAttribute("data-old");
        if (oldType) {
            typeSelect.value = oldType;
            updateSubTypeOptions(typeSelect, subTypeSelect, oldSubType);
        }
    });
});
</script>