<!-- Modal Delete -->
@foreach($links as $link)
    <div id="DeleteModal-{{ $link->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
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

                <!-- Detail Link (untuk konfirmasi delete) -->
                <div class="bg-gray-50 w-full border-2 border-red-500 rounded-lg p-4 text-sm text-gray-700">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Nama Link -->
                        <div>
                            <p class="font-semibold text-gray-900">Nama Link:</p>
                            <p class="mt-1 break-words">{{ $link->nama_link }}</p>
                        </div>

                        <!-- URL -->
                        <div>
                            <p class="font-semibold text-gray-900">URL:</p>
                            <p class="mt-1">
                                <a href="{{ $link->url }}" target="_blank" 
                                class="text-blue-600 hover:underline break-words">
                                {{ $link->url }}
                                </a>
                            </p>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <p class="font-semibold text-gray-900">Kategori:</p>
                            <span class="inline-block mt-1 px-2 py-1 text-xs font-medium rounded-full border 
                                {{ $link->kategori_badge_color }}">
                                {{ $link->kategori_label }}
                            </span>
                        </div>

                        <!-- Status -->
                        <div>
                            <p class="font-semibold text-gray-900">Status:</p>
                            @if ($link->status)
                                <span class="inline-block mt-1 px-2 py-1 text-xs font-medium rounded-full border border-green-200 bg-green-100 text-green-800">
                                    Aktif
                                </span>
                            @else
                                <span class="inline-block mt-1 px-2 py-1 text-xs font-medium rounded-full border border-gray-200 bg-gray-100 text-gray-800">
                                    Nonaktif
                                </span>
                            @endif
                        </div>

                        <!-- Deskripsi (Lebar penuh) -->
                        <div class="md:col-span-2">
                            <p class="font-semibold text-gray-900">Deskripsi:</p>
                            <p class="mt-1">{{ $link->deskripsi ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Hapus -->
                <form id="deleteForm-{{ $link->id }}" method="POST" action="{{ route('manage-link.destroy', $link->id ) }}">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-center space-x-3 mt-4">
                        <!-- Tombol Batal -->
                        <button type="button" onclick="closeDeleteModal('{{ $link->id }}')"
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
            <button onclick="closeDeleteModal('{{ $link->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach