<!-- Modal Delete -->
@foreach($kegiatans as $kegiatan)
    <div id="DeleteModal-{{ $kegiatan->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
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

                <!-- Detail kegiatan (Delete Confirmation) -->
                <div class="bg-red-50 w-full border-2 border-red-500 rounded-lg p-4 text-sm text-red-700 space-y-3">
                    <div class="flex items-center text-left space-x-4">
                        <!-- Poster -->
                        <div class="w-20 h-20 rounded-lg overflow-hidden border">
                            @if ($kegiatan->poster)
                                <img src="{{ asset('storage/' . $kegiatan->poster) }}" 
                                    alt="Poster kegiatan" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                                    No Poster
                                </div>
                            @endif
                        </div>

                        <!-- Info utama -->
                        <div class="flex flex-col space-y-1">
                            <p><span class="font-semibold">Judul:</span> {{ $kegiatan->nama_kegiatan ?? '-' }}</p>
                            <p><span class="font-semibold">Kategori:</span> {{ $kegiatan->kategori ?? '-' }}</p>
                            <p>
                                <span class="font-semibold">Status:</span>
                                <span class="px-2 py-0.5 rounded text-white text-xs 
                                    {{ $kegiatan->status === 'draft' ? 'bg-gray-500' : '' }}
                                    {{ $kegiatan->status === 'published' ? 'bg-green-600' : '' }}
                                    {{ $kegiatan->status === 'done' ? 'bg-blue-600' : '' }}">
                                    {{ ucfirst($kegiatan->status) }}
                                </span>
                            </p>
                            <p><span class="font-semibold">Highlight:</span> 
                                @if($kegiatan->is_highlight)
                                    <span class="text-green-600 font-semibold">Ya</span>
                                @else
                                    <span class="text-gray-500">Tidak</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    <!-- Info tambahan -->
                    <div class="grid grid-cols-2 gap-2 pt-2">
                        <p><span class="font-light">Tanggal Mulai:</span> 
                            {{ $kegiatan->tanggal_mulai ? \Carbon\Carbon::parse($kegiatan->tanggal_mulai)->format('d M Y') : '-' }}
                        </p>
                        <p><span class="font-light">Tanggal Selesai:</span> 
                            {{ $kegiatan->tanggal_selesai ? \Carbon\Carbon::parse($kegiatan->tanggal_selesai)->format('d M Y') : '-' }}
                        </p>
                        <p><span class="font-light">Jam Mulai:</span> {{ $kegiatan->jam_mulai ?? '-' }}</p>
                        <p><span class="font-light">Jam Selesai:</span> {{ $kegiatan->jam_selesai ?? '-' }}</p>
                        <p class="col-span-2"><span class="font-semibold">Lokasi:</span> {{ $kegiatan->lokasi ?? '-' }}</p>

                        <p class="col-span-2"><span class="font-semibold">Lampiran:</span> 
                            @if ($kegiatan->lampiran_original)
                                <a href="{{ asset('storage/' . $kegiatan->lampiran_path) }}" target="_blank" class="text-blue-600 underline">
                                    {{ $kegiatan->lampiran_original }}
                                </a>
                            @else
                                <span class="text-gray-500">Tidak ada</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Form Hapus -->
                <form id="deleteForm-{{ $kegiatan->id }}" method="POST" action="{{ route('manage-kegiatan.destroy', $kegiatan->id ) }}">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center space-x-3 mt-4">
                        <!-- Tombol Batal -->
                        <button type="button" onclick="closeDeleteModal('{{ $kegiatan->id }}')"
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
            <button onclick="closeDeleteModal('{{ $kegiatan->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach