<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create Badan Pengurus -->
        <form method="POST" action="{{ route('manage-badan-pengurus.store') }}">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                <!-- Kabinet -->
                <div>
                    <label class="block text-sm font-medium mb-1">Kabinet</label>
                    <select name="manage_kabinet_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Kabinet --</option>
                        @foreach($kabinets as $k)
                            <option value="{{ $k->id }}" data-active="{{ $k->is_active ? '1' : '0' }}" {{ old('manage_kabinet_id')==$k->id?'selected':'' }}>
                                {{ $k->nama_kabinet }} ({{ $k->periode_awal }} - {{ $k->periode_akhir }})
                                {{ $k->is_active ? ' • AKTIF' : '' }}
                            </option>
                        @endforeach
                    </select>
                    @error('manage_kabinet_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Anggota -->
                <div>
                    <label class="block text-sm font-medium mb-1">Anggota</label>
                    <select name="anggota_aktif_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($anggotas as $a)
                            <option value="{{ $a->id }}" {{ old('anggota_aktif_id')==$a->id?'selected':'' }}>
                                {{ $a->nama }} | {{ $a->nim }}
                            </option>
                        @endforeach
                    </select>
                    @error('anggota_aktif_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Jabatan -->
                <div>
                    <label class="block text-sm font-medium mb-1">Jabatan</label>
                    <select id="jabatanSelect" name="jabatan_id" required
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                        <option value="">-- Pilih Jabatan --</option>
                        @foreach($jabatans as $j)
                            <option value="{{ $j->id }}" data-nama="{{ $j->nama }}" data-level="{{ $j->level }}" {{ old('jabatan_id')==$j->id?'selected':'' }}>
                                [Lv {{ $j->level }}] {{ strtoupper($j->jenis) }}
                            </option>
                        @endforeach
                    </select>

                    @error('jabatan_id') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Nama Struktural -->
                <div>
                    <label class="block text-sm font-medium mb-1">Nama Struktural</label>
                    <input type="text" id="namaStruktural" name="nama_struktural" readonly
                        class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-700 cursor-not-allowed"
                        placeholder="Otomatis dari jabatan">
                </div>

                <!-- Mulai Menjabat -->
                <div>
                    <label class="block text-sm font-medium mb-1">Mulai Menjabat</label>
                    <input type="date" name="mulai_menjabat" value="{{ old('mulai_menjabat') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    @error('mulai_menjabat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Selesai Menjabat -->
                <div id="selesai-wrapper">
                    <label class="block text-sm font-medium mb-1">Selesai Menjabat</label>
                    <input type="date" name="selesai_menjabat" value="{{ old('selesai_menjabat') }}"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

                    <p class="text-xs text-gray-500 mt-1">
                        Wajib diisi jika kabinet sudah demisioner
                    </p>

                    @error('selesai_menjabat') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

            </div>

            <!-- Tombol -->
            <div class="flex justify-end gap-2 mt-6">
                <button type="button" onclick="closeAddModal()"
                    class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm">
                    Batal
                </button>

                <button type="submit"
                    class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Hide Field Input Selesai Menjabat
    const kabinetSelect = document.querySelector('select[name="manage_kabinet_id"]');
    const selesaiWrapper = document.getElementById('selesai-wrapper');
    const selesaiInput = document.querySelector('input[name="selesai_menjabat"]');

    // Nama Struktural
    const jabatanSelect = document.getElementById('jabatanSelect');
    const namaInput = document.getElementById('namaStruktural');

    // Function to toggle Selesai Menjabat field
    function toggleSelesai() {
        const selected = kabinetSelect.options[kabinetSelect.selectedIndex];
        const isActive = selected?.dataset.active === "1";

        if (isActive) {
            selesaiWrapper.classList.add('hidden');
            selesaiInput.value = '';
        } else {
            selesaiWrapper.classList.remove('hidden');
        }
    }

    kabinetSelect.addEventListener('change', toggleSelesai);

    // Function to set Nama Struktural based on selected Jabatan
    function setNama() {
        const opt = jabatanSelect.options[jabatanSelect.selectedIndex];
        const nama = opt?.dataset.nama || '';
        namaInput.value = nama;
    }

    jabatanSelect.addEventListener('change', setNama);

    // trigger pas load (buat old value)
    toggleSelesai();
    setNama();
});
</script>

