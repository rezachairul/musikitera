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
            <form id="editForm-{{ $alumni->id }}" method="POST" action="{{ route('manage-alumni.update', $alumni->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="edit_nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                        <input type="text" name="nama" id="edit_nama"
                            value="{{ old('nama', $alumni->nama) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- NIM -->
                    <div>
                        <label for="edit_nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                        <input type="text" name="nim" id="edit_nim"
                            value="{{ old('nim', $alumni->nim) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- Angkatan Kampus -->
                    <div>
                        <label for="edit_angkatan" class="block text-sm font-medium text-gray-700 mb-2">Angkatan Kampus</label>
                        <input type="number" name="angkatan" id="edit_angkatan"
                            value="{{ old('angkatan', $alumni->angkatan) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- Prodi -->
                    <div>
                        <label for="edit_prodi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                        <input type="text" name="prodi" id="edit_prodi"
                            value="{{ old('prodi', $alumni->prodi) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- Nomor Urut -->
                    <div>
                        <label for="edit_nomor_urut" class="block text-sm font-medium text-gray-700 mb-2">Nomor Urut</label>
                        <input type="number" name="nomor_urut" id="edit_nomor_urut"
                            value="{{ old('nomor_urut', $alumni->nomor_urut) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <!-- Angkatan UKM -->
                    <div>
                        <label for="edit_angkatan_ukm" class="block text-sm font-medium text-gray-700 mb-2">Angkatan UKM</label>
                        <input type="number" name="angkatan_ukm" id="edit_angkatan_ukm"
                            value="{{ old('angkatan_ukm', $alumni->angkatan_ukm) }}"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Pendiri -->
                    <div>
                        <span class="block text-sm font-medium text-gray-700 mb-2">Pendiri</span>
                        <div class="flex items-center gap-6">
                            <!-- Ya -->
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="pendiri" value="1" id="edit_pendiri_yes"
                                    class="hidden peer"
                                    {{ old('pendiri', $alumni->pendiri) == 1 ? 'checked' : '' }}>
                                <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                            peer-checked:border-blue-600 peer-checked:bg-blue-600 transition"></span>
                                <span class="ml-2 text-sm text-gray-700">Ya</span>
                            </label>
                            <!-- Tidak -->
                            <label class="flex items-center cursor-pointer">
                                <input type="radio" name="pendiri" value="0" id="edit_pendiri_no"
                                    class="hidden peer"
                                    {{ old('pendiri', $alumni->pendiri) == 0 ? 'checked' : '' }}>
                                <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                            peer-checked:border-red-600 peer-checked:bg-red-600 transition"></span>
                                <span class="ml-2 text-sm text-gray-700">Tidak</span>
                            </label>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="edit_status" class="block text-sm font-medium text-gray-700 mb-2">Status Perkuliahan</label>
                        <select name="status" id="edit_status"
                            class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                            <option value="on_going" {{ old('status', $alumni->status) == 'on_going' ? 'selected' : '' }}>On Going</option>
                            <option value="graduate" {{ old('status', $alumni->status) == 'graduate' ? 'selected' : '' }}>Graduate</option>
                            <option value="drop_out" {{ old('status', $alumni->status) == 'drop_out' ? 'selected' : '' }}>Drop Out</option>
                            <option value="exit" {{ old('status', $alumni->status) == 'exit' ? 'selected' : '' }}>Exit</option>
                        </select>
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

