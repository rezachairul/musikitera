<!-- Modal Delete -->
@foreach($badan_penguruses as $badan_pengurus)
    <div id="DeleteModal-{{ $badan_pengurus->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg p-6 max-w-md w-full text-center relative">
            <div class="flex flex-col items-center space-y-4">
                <!-- Header dengan Icon -->
                <div class="flex items-start gap-3 text-left">
                    <!-- Icon Warning -->
                    <div class="bg-red-100 text-red-600 rounded-full p-2 mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
                        </svg>
                    </div>

                    <!-- Teks Header -->
                    <div class="space-y-0.5">
                        <h2 class="text-xl font-semibold text-gray-800">Yakin ingin menghapus data ini?</h2>
                        <p class="text-gray-500 text-sm">Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                </div>

                <!-- Detail Badan Pengurus -->
                <div class="bg-gray-50 w-full border rounded-lg p-4 text-sm text-gray-700 space-y-2">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-1 text-left">

                        <p>
                            <span class="font-semibold text-gray-600">Nama Lengkap:</span><br>
                            {{ $badan_pengurus->anggota->nama }}
                        </p>
                        <p>
                            <span class="font-semibold text-gray-600">NIA:</span><br>
                            {{ $badan_pengurus->anggota->nia }}
                        </p>
                        <p>
                            <span class="font-semibold text-gray-600">Angkatan:</span><br>
                            {{ $badan_pengurus->anggota->angkatan }}
                        </p>
                        <p>
                            <span class="font-semibold text-gray-600">Kabinet:</span><br>
                            {{ $badan_pengurus->kabinet->nama_kabinet }}
                            ({{ $badan_pengurus->kabinet->periode_awal }} – {{ $badan_pengurus->kabinet->periode_akhir }})
                        </p>
                        <p>
                            <span class="font-semibold text-gray-600">Jabatan:</span><br>
                            {{ $badan_pengurus->jabatan->nama }}
                        </p>
                        <p>
                            <span class="font-semibold text-gray-600">Status Kepengurusan:</span><br>
                            @php $status = $statusLabels[$badan_pengurus->status]; @endphp
                            <span class="inline-block mt-1 px-2 py-1 text-xs rounded-lg {{ $status['color'] }}">
                                {{ $status['label'] }}
                            </span>
                        </p>

                    </div>
                </div>

                <!-- Form Hapus -->
                <form id="deleteForm-{{ $badan_pengurus->id }}" method="POST" action="{{ route('manage-badan-pengurus.destroy', $badan_pengurus->id ) }}">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center space-x-3 mt-4">
                        <!-- Tombol Batal -->
                        <button type="button" onclick="closeDeleteModal('{{ $badan_pengurus->id }}')"
                            class="flex items-center gap-1 px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                            <!-- Icon X -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Batal
                        </button>

                        <!-- Tombol Hapus -->
                        <button
                            type="submit"
                            class="flex items-center gap-1 px-4 py-2 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            <!-- Icon Trash -->
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5-4h4m-4 0a1 1 0 00-1 1v1h6V4a1 1 0 00-1-1m-4 0h4" />
                            </svg>
                            Hapus
                        </button>
                    </div>
                </form>
            </div>
            <!-- Tombol X -->
            <button onclick="closeDeleteModal('{{ $badan_pengurus->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach