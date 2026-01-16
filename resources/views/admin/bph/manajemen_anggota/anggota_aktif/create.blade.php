<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg  xmlns="http://www.w3.org/2000/svg"  fill="none"  viewBox="0 0 24 24"  stroke-width="1.5"  stroke="currentColor"  class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create Anggota Aktif -->
        <form id="addForm" method="POST" action="{{ route('anggota-aktif.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Nama -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" name="nama" id="nama"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukan Nama" required>
                </div>

                <!-- NIM -->
                <div>
                    <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
                    <input type="text" name="nim" id="nim"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukan NIM" required>
                </div>

                <!-- Angkatan Kampus -->
                <div>
                    <label for="angkatan" class="block text-sm font-medium text-gray-700 mb-2">Angkatan Kampus</label>
                    <input type="number" name="angkatan" id="angkatan"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="contoh: 2023" required>
                </div>

                <!-- Prodi -->
                <div>
                    <label for="prodi" class="block text-sm font-medium text-gray-700 mb-2">Program Studi</label>
                    <input type="text" name="prodi" id="prodi"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukan Prodi" required>
                </div>

                <!-- Nomor Urut -->
                <div>
                    <label for="nomor_urut" class="block text-sm font-medium text-gray-700 mb-2">Nomor Urut</label>
                    <input type="number" name="nomor_urut" id="nomor_urut"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="Nomor urut di UKM" required>
                </div>

                <!-- Angkatan UKM -->
                <div>
                    <label for="angkatan_ukm" class="block text-sm font-medium text-gray-700 mb-2">Angkatan UKM</label>
                    <input type="number" name="angkatan_ukm" id="angkatan_ukm"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500"
                        placeholder="contoh: 6">
                    <small class="text-gray-500">Akan otomatis jadi romawi</small>
                </div>

                <!-- Pendiri -->
                <div>
                    <span class="block text-sm font-medium text-gray-700 mb-2">Pendiri</span>
                    <div class="flex items-center gap-6">
                        
                        <!-- Ya -->
                        <label class="flex items-center cursor-pointer">
                        <input type="radio" name="pendiri" value="1"
                                class="hidden peer">
                        <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                    peer-checked:border-blue-600 peer-checked:bg-blue-600 transition"></span>
                        <span class="ml-2 text-sm text-gray-700">Ya</span>
                        </label>

                        <!-- Tidak -->
                        <label class="flex items-center cursor-pointer">
                        <input type="radio" name="pendiri" value="0"
                                class="hidden peer">
                        <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center 
                                    peer-checked:border-red-600 peer-checked:bg-red-600 transition"></span>
                        <span class="ml-2 text-sm text-gray-700">Tidak</span>
                        </label>

                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status Perkuliahan</label>
                    <select name="status" id="status"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 text-sm">
                        <option value="on_going">On Going</option>
                        <option value="graduate">Graduate</option>
                        <option value="drop_out">Drop Out</option>
                        <option value="exit">Exit</option>
                    </select>
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Batal
                </button>
                <button type="submit"
                    class="px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </div>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
