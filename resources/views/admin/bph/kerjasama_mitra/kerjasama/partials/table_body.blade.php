@forelse ($kerjasamas as $key => $kerjasama)
<tr class="hover:bg-gray-50 text-left text-xs">
    <!-- No -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $kerjasamas->firstItem() + $key }}
    </td>

    <!-- Poster -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($kerjasama->poster)
            <img src="{{ asset('storage/kerjasama/poster/' . $kerjasama->poster) }}" 
                alt="Poster Kerjasama" 
                class="w-16 h-12 object-cover rounded-md shadow-sm">
        @else
            <span class="text-gray-400 italic">No Image</span>
        @endif
    </td>

    <!-- Judul Kerjasama -->
    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-900">
        {{ $kerjasama->judul_kerjasama }}
    </td>

    <!-- Jenis Kerjasama -->
    @php
        switch ($kerjasama->jenis_kerjasama) {
            case 'MoU':
                $jenisClass = 'bg-blue-100 text-blue-800';
                break;
            case 'MoA':
                $jenisClass = 'bg-green-100 text-green-800';
                break;
            case 'Event':
                $jenisClass = 'bg-amber-100 text-amber-800';
                break;
            case 'Proyek':
                $jenisClass = 'bg-purple-100 text-purple-800';
                break;
            case 'Sponsorship':
                $jenisClass = 'bg-pink-100 text-pink-800';
                break;
            default:
                $jenisClass = 'bg-gray-100 text-gray-700';
        }
    @endphp

    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-xs rounded-full {{ $jenisClass }}">
            {{ $kerjasama->jenis_kerjasama }}
        </span>
    </td>

    <!-- Mitra / Organisasi -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($kerjasama->is_from_mitra && $kerjasama->mitra)
            <span class="text-gray-900 font-medium">{{ $kerjasama->mitra->nama_mitra }}</span>
        @elseif(!$kerjasama->is_from_mitra)
            <span class="text-gray-700">{{ $kerjasama->nama_organisasi }}</span>
        @else
            <span class="text-gray-400 italic">Tidak diketahui</span>
        @endif
    </td>

    <!-- Status -->
    @php
        switch ($kerjasama->status) {
            case 'rencana':
                $statusClass = 'bg-gray-100 text-gray-800';
                break;
            case 'berjalan':
                $statusClass = 'bg-blue-100 text-blue-800';
                break;
            case 'selesai':
                $statusClass = 'bg-green-100 text-green-800';
                break;
            default:
                $statusClass = 'bg-gray-100 text-gray-800';
        }
    @endphp

    <td class="px-6 py-4 whitespace-nowrap">
        <span class="px-2 py-1 text-xs rounded-full {{ $statusClass }}">
            {{ ucfirst($kerjasama->status) }}
        </span>
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        {{ ucfirst($kerjasama->tanggal_mulai) }}
    </td>

    <td class="px-6 py-4 whitespace-nowrap">
        {{ ucfirst($kerjasama->tanggal_selesai) }}
    </td>

    <!-- Dokumen -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($kerjasama->file_dokumen)
            <a href="{{ asset('storage/kerjasama/dokumen/' . $kerjasama->file_dokumen) }}" 
            target="_blank" 
            class="text-blue-600 hover:underline">
                {{ $kerjasama->file_dokumen }}
            </a>
            <p class="text-xs text-gray-400">
                {{ number_format($kerjasama->file_dokumen_size / 1024, 1) }} KB
            </p>
        @else
            <span class="text-gray-400 italic">No File</span>
        @endif
    </td>

    <!-- Link Dokumentasi -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($kerjasama->link_dokumentasi)
            @php
                $url = $kerjasama->link_dokumentasi;
                $icon = 'globe';
                $name = 'Lihat Link';
                $color = 'text-blue-600';

                if (str_contains($url, 'youtube.com') || str_contains($url, 'youtu.be')) {
                    $icon = 'youtube';
                    $name = 'YouTube';
                    $color = 'text-red-600';
                } elseif (str_contains($url, 'instagram.com')) {
                    $icon = 'instagram';
                    $name = 'Instagram';
                    $color = 'text-pink-600';
                } elseif (str_contains($url, 'tiktok.com')) {
                    $icon = 'tiktok';
                    $name = 'TikTok';
                    $color = 'text-gray-800';
                } elseif (str_contains($url, 'drive.google.com')) {
                    $icon = 'drive';
                    $name = 'Google Drive';
                    $color = 'text-green-600';
                } elseif (str_contains($url, 'whatsapp.com') || str_contains($url, 'wa.me')) {
                    $icon = 'whatsapp';
                    $name = 'WhatsApp';
                    $color = 'text-green-500';
                }
            @endphp

            <a href="{{ $url }}" target="_blank" 
            class="flex items-center space-x-2 font-medium {{ $color }}">
            
            {{-- SVG ICON --}}
            @switch($icon)
                @case('youtube')
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a2.974 2.974 0 00-2.095-2.103C19.5 3.5 12 3.5 12 3.5s-7.5 0-9.403.583a2.974 2.974 0 00-2.095 2.103C0 8.098 0 12 0 12s0 3.902.502 5.814a2.974 2.974 0 002.095 2.103C4.5 20.5 12 20.5 12 20.5s7.5 0 9.403-.583a2.974 2.974 0 002.095-2.103C24 15.902 24 12 24 12s0-3.902-.502-5.814zM9.75 15.5v-7l6.25 3.5-6.25 3.5z"/>
                    </svg>
                    @break

                @case('instagram')
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0122 7.75v8.5A5.75 5.75 0 0116.25 22h-8.5A5.75 5.75 0 012 16.25v-8.5A5.75 5.75 0 017.75 2zm8.75 2a1 1 0 110 2 1 1 0 010-2zM12 7a5 5 0 110 10 5 5 0 010-10z"/>
                    </svg>
                    @break

                @case('tiktok')
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.75 2a1 1 0 011 1v.25c0 2.071 1.679 3.75 3.75 3.75h.25a1 1 0 011 1V9c0 6.075-4.925 11-11 11S2 15.075 2 9a1 1 0 011-1h.25C5.321 8 7 6.321 7 4.25V4a1 1 0 011-1h4.75z"/>
                    </svg>
                    @break

                @case('drive')
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2l4.5 8H7.5L12 2zm-6.5 9h13L22 20H2l3.5-9z"/>
                    </svg>
                    @break

                @case('whatsapp')
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20.52 3.48A11.87 11.87 0 0012 0C5.38 0 0 5.38 0 12c0 2.12.55 4.18 1.6 6L0 24l6.22-1.6A11.93 11.93 0 0012 24c6.62 0 12-5.38 12-12 0-3.19-1.24-6.19-3.48-8.52zM12 21.5c-1.96 0-3.88-.52-5.56-1.5l-.4-.23-3.68.95.98-3.58-.25-.43A9.45 9.45 0 012.5 12c0-5.25 4.25-9.5 9.5-9.5s9.5 4.25 9.5 9.5-4.25 9.5-9.5 9.5zm4.48-7.22c-.25-.13-1.48-.73-1.71-.82-.23-.08-.4-.12-.57.13s-.65.82-.8.99c-.15.17-.3.2-.55.07-.25-.13-1.06-.39-2.02-1.2-.74-.65-1.25-1.46-1.4-1.71-.15-.25-.02-.38.11-.5.12-.12.25-.3.37-.45.12-.15.17-.25.25-.42.08-.17.04-.32-.02-.45-.07-.13-.57-1.37-.78-1.87-.2-.48-.41-.42-.57-.43h-.48c-.17 0-.45.06-.68.32-.23.26-.9.88-.9 2.15s.92 2.49 1.05 2.67c.13.17 1.8 2.75 4.38 3.85.61.26 1.08.42 1.45.54.61.19 1.16.16 1.6.1.49-.07 1.48-.6 1.69-1.18.21-.58.21-1.08.15-1.18-.06-.1-.23-.16-.48-.29z"/>
                    </svg>
                    @break

                @default
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm5.93 6h-3.31a15.26 15.26 0 010 8h3.31a7.963 7.963 0 000-8zm-5.93 0h-2.02a13.27 13.27 0 000 8h2.02a13.27 13.27 0 000-8zM8.38 8H5.07a7.963 7.963 0 000 8h3.31a15.26 15.26 0 010-8z"/>
                    </svg>
            @endswitch

            <span>{{ $name }}</span>
            </a>
        @else
            <span class="text-gray-400 italic">Tidak ada link</span>
        @endif
    </td>

    <!-- Aksi -->
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
        <div class="flex justify-center items-center h-full space-x-2">
            <!-- Edit Button -->
            <button
                onclick="openUpdateModal('{{ $kerjasama->id }}')"
                class="text-amber-600 hover:text-amber-900 p-1 rounded hover:bg-amber-50" 
                title="Edit">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" 
                     class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
            </button>

            <!-- Delete Button -->
            <button
                onclick="openDeleteModal('{{ $kerjasama->id }}')"
                class="text-red-600 hover:text-red-900 p-1 rounded hover:bg-red-50"
                title="Delete">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" 
                     viewBox="0 0 24 24" stroke-width="1.5" 
                     stroke="currentColor" class="size-5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                </svg>
            </button>
        </div>
    </td>
</tr>

@empty
<tr class="hover:bg-gray-50">
    <td colspan="7" class="px-6 py-4 text-center text-gray-500 italic">
        <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
            @if ($kerjasamas->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                <!-- Icon Data Kosong -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-400 mb-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span class="text-blue-500 font-medium">Belum ada data yang tersedia di sini.</span>

            @elseif ($kerjasamas->isEmpty() && request()->filled('search'))
                <!-- Icon Pencarian -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                </svg>
                <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>

            @elseif ($kerjasamas->isEmpty() && request()->filled('filter'))
                <!-- Icon Filter -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2l-7 8v5a1 1 0 01-2 0v-5l-7-8V4z" />
                </svg>
                <span class="text-red-500 font-medium">Data tidak tersedia untuk filter yang dipilih.</span>
            @endif
        </div>
    </td>
</tr>
@endforelse