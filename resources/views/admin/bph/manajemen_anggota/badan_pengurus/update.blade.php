<!-- Modal Edit Data -->
@foreach ($badan_penguruses as $badan_pengurus)
    <div id="UpdateModal-{{ $badan_pengurus->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Edit {{ $title }}</h2>
            </div>

            <!-- Form Update Badan Pengurus -->
            <form method="POST" action="{{ route('manage-badan-pengurus.update', $badan_pengurus->id) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- Kabinet -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Kabinet</label>
                        <select id="kabinetSelectEdit" name="manage_kabinet_id" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Kabinet --</option>
                            @foreach($kabinets as $k)
                                <option value="{{ $k->id }}"
                                    data-active="{{ $k->is_active ? '1' : '0' }}"
                                    {{ old('manage_kabinet_id', $badan_pengurus->manage_kabinet_id) == $k->id ? 'selected' : '' }}>
                                    {{ $k->nama_kabinet }} ({{ $k->periode_awal }} - {{ $k->periode_akhir }})
                                    {{ $k->is_active ? ' • AKTIF' : '' }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Anggota -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Anggota</label>
                        <select name="anggota_aktif_id" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Anggota --</option>
                            @foreach($anggotas as $a)
                                <option value="{{ $a->id }}"
                                    {{ old('anggota_aktif_id', $badan_pengurus->anggota_aktif_id) == $a->id ? 'selected' : '' }}>
                                    {{ $a->nama }} | {{ $a->nim }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Jabatan</label>
                        <select id="jabatanSelectEdit" name="jabatan_id" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Pilih Jabatan --</option>
                            @foreach($jabatans as $j)
                                <option value="{{ $j->id }}"
                                    data-nama="{{ $j->nama }}"
                                    {{ old('jabatan_id', $badan_pengurus->jabatan_id) == $j->id ? 'selected' : '' }}>
                                    [Lv {{ $j->level }}] {{ strtoupper($j->jenis) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Nama Struktural -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama Struktural</label>
                        <input type="text" id="namaStrukturalEdit" readonly
                            value="{{ $badan_pengurus->jabatan->nama ?? '' }}"
                            class="w-full border rounded-lg px-3 py-2 bg-gray-100 text-gray-700 cursor-not-allowed">
                    </div>

                    <!-- Mulai Menjabat -->
                    <div>
                        <label class="block text-sm font-medium mb-1">Mulai Menjabat</label>
                        <input type="date" name="mulai_menjabat"
                            value="{{ old('mulai_menjabat', $badan_pengurus->mulai_menjabat) }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">
                    </div>

                    <!-- Selesai Menjabat -->
                    <div id="selesai-wrapper-edit">
                        <label class="block text-sm font-medium mb-1">Selesai Menjabat</label>
                        <input type="date" id="selesaiInputEdit" name="selesai_menjabat"
                            value="{{ old('selesai_menjabat', $badan_pengurus->selesai_menjabat) }}"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500">

                        <p class="text-xs text-gray-500 mt-1">
                            Wajib diisi jika kabinet sudah demisioner
                        </p>
                    </div>

                </div>

                <!-- Tombol -->
                <div class="flex justify-end gap-2 mt-6">
                    <button type="button" onclick="closeUpdateModal('{{ $badan_pengurus->id }}')"
                        class="px-4 py-2 rounded-lg bg-gray-100 hover:bg-gray-200 text-sm">
                        Batal
                    </button>

                    <button type="submit"
                        class="px-4 py-2 rounded-lg bg-amber-600 hover:bg-amber-700 text-white text-sm">
                        Update
                    </button>
                </div>
            </form>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $badan_pengurus->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                        d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const kabinetSelectEdit = document.getElementById('kabinetSelectEdit');
            const selesaiWrapperEdit = document.getElementById('selesai-wrapper-edit');
            const selesaiInputEdit = document.getElementById('selesaiInputEdit');

            const jabatanSelectEdit = document.getElementById('jabatanSelectEdit');
            const namaStrukturalEdit = document.getElementById('namaStrukturalEdit');

            function toggleSelesaiEdit() {
                const selected = kabinetSelectEdit.options[kabinetSelectEdit.selectedIndex];
                const isActive = selected?.dataset.active === "1";

                if (isActive) {
                    selesaiWrapperEdit.classList.add('hidden');
                    selesaiInputEdit.value = '';
                } else {
                    selesaiWrapperEdit.classList.remove('hidden');
                }
            }

            function setNamaEdit() {
                const opt = jabatanSelectEdit.options[jabatanSelectEdit.selectedIndex];
                namaStrukturalEdit.value = opt?.dataset.nama || '';
            }

            kabinetSelectEdit.addEventListener('change', toggleSelesaiEdit);
            jabatanSelectEdit.addEventListener('change', setNamaEdit);

            // trigger awal
            toggleSelesaiEdit();
            setNamaEdit();
        });
    </script>

@endforeach

