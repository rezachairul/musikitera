<!-- Modal Delete -->
@foreach($pengumumans as $pengumuman)
    <div id="DeleteModal-{{ $pengumuman->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
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

                <!-- Detail pengumuman (Delete Confirmation) -->
                <div class="bg-red-50 w-full border-2 border-red-500 rounded-lg p-4 text-sm text-red-700 space-y-3">
                    <div class="flex items-start text-left space-x-4">
                        <!-- Poster -->
                        <div class="w-24 h-24 rounded-lg overflow-hidden border">
                            @if ($pengumuman->gambar)
                                <img src="{{ asset('storage/' . $pengumuman->gambar_path) }}" 
                                    alt="Poster Pengumuman" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-200 text-gray-400 text-xs">
                                    Tidak Ada Gambar
                                </div>
                            @endif
                        </div>

                        <!-- Info utama -->
                        <div class="flex flex-col space-y-1">
                            <p><span class="font-semibold">Judul:</span> {{ $pengumuman->judul }}</p>
                            <p><span class="font-semibold">Sifat:</span> {{ ucfirst($pengumuman->sifat) }}</p>
                            <p>
                                <span class="font-semibold">Status:</span>
                                <span class="px-2 py-0.5 rounded text-white text-xs
                                    {{ $pengumuman->status === 'draft' ? 'bg-gray-500' : '' }}
                                    {{ $pengumuman->status === 'publish' ? 'bg-green-600' : '' }}
                                    {{ $pengumuman->status === 'arsip' ? 'bg-blue-600' : '' }}">
                                    {{ ucfirst($pengumuman->status) }}
                                </span>
                            </p>
                            <p>
                                <span class="font-semibold">Tanggal Pengumuman:</span>
                                {{ $pengumuman->tanggal_pengumuman 
                                    ? \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->translatedFormat('d M Y')
                                    : '-' }}
                            </p>
                        </div>
                    </div>

                    <!-- Isi pengumuman -->
                    <div class="pt-3 border-t border-red-300">
                        <p class="font-semibold mb-1">Isi Pengumuman:</p>
                        <div class="bg-white border rounded p-2 text-gray-800">
                            {!! nl2br(e($pengumuman->isi ?? '-')) !!}
                        </div>
                    </div>

                    <!-- Lampiran -->
                    <div class="pt-3 border-t border-red-300">
                        <p class="font-semibold mb-1">Lampiran:</p>
                        @if ($pengumuman->file_dokumen)
                            <a href="{{ asset('storage/' . $pengumuman->file_dokumen_path) }}" 
                            target="_blank" 
                            class="text-blue-600 underline">
                                {{ $pengumuman->file_dokumen }}
                            </a>
                        @else
                            <span class="text-gray-500">Tidak ada lampiran</span>
                        @endif
                    </div>

                    <!-- Dibuat oleh -->
                    <div class="pt-3 border-t border-red-300 text-gray-600 text-xs">
                        <p>Dibuat oleh: {{ $pengumuman->user->name ?? 'Tidak diketahui' }}</p>
                        <p>Dibuat pada: {{ $pengumuman->created_at->translatedFormat('d M Y H:i') }}</p>
                    </div>
                </div>

                <!-- Form Hapus -->
                <form id="deleteForm-{{ $pengumuman->id }}" method="POST" action="{{ route('manage-pengumuman.destroy', $pengumuman->id ) }}">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center space-x-3 mt-4">
                        <!-- Tombol Batal -->
                        <button type="button" onclick="closeDeleteModal('{{ $pengumuman->id }}')"
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
            <button onclick="closeDeleteModal('{{ $pengumuman->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach