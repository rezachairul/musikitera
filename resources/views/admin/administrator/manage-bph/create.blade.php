<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg  xmlns="http://www.w3.org/2000/svg"  fill="none"  viewBox="0 0 24 24"  stroke-width="1.5"  stroke="currentColor"  class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create -->
        <form id="addJabatanForm" method="POST" action="{{ route('manage-bph.store') }}">
            @csrf

            <!-- Nama Jabatan -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                    Nama Jabatan
                </label>
                <input type="text" name="nama" id="nama"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Contoh: Ketua Umum, Sekretaris Umum 1, dsb."
                    required>
                <p class="text-xs text-gray-500 mt-1">
                    Nama Jabatan Tidak Boleh Disingkat. Contoh: Ketua Umum, Sekretaris Umum 1, dsb.
                </p>
            </div>

            <!-- Jenis Jabatan -->
            <div class="mb-4">
                <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                    Jenis Jabatan
                </label>
                <select name="jenis" id="jenis"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                    required>
                    <option value="">-- Pilih Jenis Jabatan --</option>
                    <option value="ketum">Ketua Umum</option>
                    <option value="sekjen">Sekretaris Jenderal</option>
                    <option value="sekum">Sekretaris Umum</option>
                    <option value="bendum">Bendahara Umum</option>
                    <option value="kadep">Kepala Departemen</option>
                    <option value="sekdep">Sekretaris Departemen (opsional)</option>
                    <option value="kadiv">Kepala Divisi</option>
                    <option value="sekdiv">Sekretaris Divisi (opsional)</option>
                    <option value="staff">Staff</option>
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Jenis menentukan posisi & aturan struktur jabatan.
                </p>
            </div>

            <!-- Parent Jabatan -->
            <div class="mb-4">
                <label for="parent_id" class="block text-sm font-medium text-gray-700 mb-2">
                    Parent Jabatan
                </label>
                <select name="parent_id" id="parent_id"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg
                        focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm">

                    <option value="">-- Tidak Ada (jabatan paling atas) --</option>

                    @foreach ($parentJabatans as $parent)
                        <option value="{{ $parent->id }}">
                            {{ str_repeat('— ', $parent->level - 1) }}{{ $parent->nama }}
                        </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">
                    Pilih parent untuk membentuk struktur organisasi.
                </p>
            </div>

            <!-- Urutan -->
            <div class="mb-4">
                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                    Urutan
                </label>
                <input type="number" name="urutan" id="urutan" min="0"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    placeholder="Urutan tampilan (semakin kecil, semakin atas)">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <button type="button" onclick="closeAddModal()"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <!-- Icon X -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>

                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    <!-- Icon Save -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
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
