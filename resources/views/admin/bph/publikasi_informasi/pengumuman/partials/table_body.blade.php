@forelse ($pengumumans as $key => $pengumuman)
<tr class="hover:bg-gray-50 text-left text-xs">
        <!-- No -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $pengumumans->firstItem() + $key }}
    </td>

    <!-- Judul Pengumuman -->
    <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800">
        {{ $pengumuman->judul }}
    </td>

    <!-- Sifat Pengumuman -->
    <td class="px-6 py-4 whitespace-nowrap capitalize">
        {{ $pengumuman->sifat }}
    </td>

    <!-- Tanggal Pengumuman -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ \Carbon\Carbon::parse($pengumuman->tanggal_pengumuman)->format('d M Y') }}
    </td>

    <!-- Isi Pengumuman -->
    <td class="px-6 py-4 max-w-xs truncate" title="{{ $pengumuman->isi }}">
        {{ Str::limit(strip_tags($pengumuman->isi), 80, '...') }}
    </td>

    <!-- Gambar (Poster) -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($pengumuman->gambar_path)
            <img src="{{ asset('storage/' . $pengumuman->gambar_path) }}" 
                alt="Poster pengumuman" 
                class="w-16 h-12 object-cover rounded-md border shadow">
        @else
            <span class="text-gray-400 italic">No Image</span>
        @endif
    </td>

    <!-- Lampiran Dokumen -->
    <td class="px-6 py-4 whitespace-nowrap">
        @if ($pengumuman->file_dokumen_path)
            <div class="flex flex-col">
                <a href="{{ asset('storage/' . $pengumuman->file_dokumen_path) }}" 
                target="_blank"
                class="text-blue-600 hover:underline">
                {{ basename($pengumuman->file_dokumen) }}
                </a>
                <span class="text-xs text-gray-500">
                    {{ $pengumuman->file_dokumen_type }} · 
                    {{ number_format($pengumuman->file_dokumen_size / 1024, 1) }} KB
                </span>
            </div>
        @else
            <span class="text-gray-400 italic">Tidak ada file</span>
        @endif
    </td>

    <!-- Status -->
    <td class="px-6 py-4 whitespace-nowrap">
        @php
            $statusColor = [
                'draft' => 'bg-gray-200 text-gray-700',
                'publish' => 'bg-green-200 text-green-700',
                'arsip' => 'bg-yellow-100 text-yellow-700',
            ][$pengumuman->status] ?? 'bg-gray-100 text-gray-700';
        @endphp
        <span class="px-2 py-1 rounded-lg text-xs font-semibold {{ $statusColor }}">
            {{ ucfirst($pengumuman->status) }}
        </span>
    </td>

    <!-- Dibuat Oleh -->
    <td class="px-6 py-4 whitespace-nowrap">
        {{ $pengumuman->user->name ?? '—' }}
    </td>

    <!-- Aksi -->
    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-center align-middle">
        <div class="flex justify-center items-center h-full space-x-2">
            <!-- Edit Button -->
            <button
                onclick="openUpdateModal('{{ $pengumuman->id }}')"
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
                onclick="openDeleteModal('{{ $pengumuman->id }}')"
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
    <td colspan="10" class="px-6 py-4 text-center text-gray-500 italic">
        <div class="flex flex-col items-center justify-center text-sm text-gray-500 space-y-1">
            @if ($pengumumans->isEmpty() && !request()->filled('search') && !request()->filled('filter'))
                <!-- Icon Data Kosong -->
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-400 mb-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                </svg>
                <span class="text-blue-500 font-medium">Belum ada data yang tersedia di sini.</span>

            @elseif ($pengumumans->isEmpty() && request()->filled('search'))
                <!-- Icon Pencarian -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 mb-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21 21l-4.35-4.35M10.5 17a6.5 6.5 0 100-13 6.5 6.5 0 000 13z" />
                </svg>
                <span class="text-yellow-600 font-medium">Tidak ditemukan hasil pencarian yang cocok.</span>

            @elseif ($pengumumans->isEmpty() && request()->filled('filter'))
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