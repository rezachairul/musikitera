<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>


    {{-- ================= Card Oprec Setting ================= --}}
    <div class="max-w-5xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-md mt-6">
        <div class="flex items-center gap-2 mb-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72 m.94 3.198.001.031c0 .225-.012.447-.037.666 A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584 A6.062 6.062 0 0 1 6 18.719 m12 0a5.971 5.971 0 0 0-.941-3.197 m0 0A5.995 5.995 0 0 0 12 12.75 a5.995 5.995 0 0 0-5.058 2.772 m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477 m.94-3.197a5.971 5.971 0 0 0-.94 3.197 M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0 Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0 Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h1 class="text-xl font-semibold text-gray-800">
                Open Recruitment Setting
            </h1>
        </div>        

        <form action="{{ $settings ? route('manage-cta.setting.update', $settings->id) : route('manage-cta.setting.store') }}" method="POST">
            @csrf
            @if($settings) @method('PUT') @endif
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- TITLE OPREC --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">Judul Oprec</label>
                <input type="text" name="title" value="{{ old('title', $settings->title) }}" placeholder="Contoh: Open Recruitment UKMBSM 2026" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-gray-400 mt-1">
                    Judul ini akan tampil di halaman /oprec
                </p>
            </div>

                {{-- STATUS OPREC --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Status Oprec</label>
                    <select name="is_active"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="1" {{ old('is_active', $settings->is_active) == 1 ? 'selected' : '' }}>
                            Dibuka
                        </option>
                        <option value="0" {{ old('is_active', $settings->is_active) == 0 ? 'selected' : '' }}>
                            Ditutup
                        </option>
                    </select>
                </div>

                {{-- LINK WA GROUP --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Link Grup WhatsApp</label>
                    <input type="url" name="wa_group_link"
                        value="{{ old('wa_group_link', $settings->wa_group_link) }}"
                        placeholder="https://chat.whatsapp.com/..."
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                </div>

                {{-- START AT --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Tanggal Mulai</label>
                    <input type="datetime-local" name="start_at"
                        value="{{ old('start_at', optional($settings->start_at)->format('Y-m-d\TH:i')) }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">
                        Digunakan untuk countdown "Segera Dibuka"
                    </p>
                </div>

                {{-- END AT --}}
                <div>
                    <label class="block text-sm font-medium mb-2">Tanggal Ditutup</label>
                    <input type="datetime-local" name="end_at"
                        value="{{ old('end_at', optional($settings->end_at)->format('Y-m-d\TH:i')) }}"
                        class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <p class="text-xs text-gray-400 mt-1">
                        Setelah waktu ini, tombol otomatis jadi "Ditutup"
                    </p>
                </div>

            </div>

            <div class="flex justify-end mt-6">
                <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition font-semibold">
                    Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>

    <!-- Table Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
            <!-- Header -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">
                    Call To Action (CTA) berisi data pendaftar <br> Oprec UKM Seni Musik ITERA.
                    Admin dapat meninjau, menambah, mengubah, <br> atau menghapus data pendaftar di sini.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="flex flex-col sm:flex-row gap-2">
                <!-- Create -->
                <button onclick="openAddModal()" class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Create {{ $title }}
                </button>
    
                <!-- Export -->
                 <a href="{{ route('manage-cta.export', [
                        'search' => request()->get('search')
                    ]) }}" class="w-full sm:w-auto bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                    </svg>
                    Export Excel
                </a>
            </div>
        </div>

        <!-- Search, Filter & Per Page -->
        <div class="mb-4">
            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">                
                
                <!-- Search -->
                <div class="relative w-full sm:w-1/2">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m21 21-5.197-5.197m0 0 
                                A7.5 7.5 0 1 0 5.196 5.196 
                                a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </div>
                    <input 
                        type="search" 
                        id="search-input"
                        value="{{ request('search') }}"
                        data-url="{{ route('manage-cta.index') }}"
                        data-target="ManageCTATableBody"
                        placeholder="Cari {{ $title }}..." 
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filter Program Studi -->
                <div class="w-full sm:w-1/4">
                    <select
                        id="filter-select"
                        name="filterProdi"
                        data-url="{{ route('manage-cta.index') }}"
                        data-target="ManageCTATableBody"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('filterProdi') == 'all' ? 'selected' : '' }}>Semua Program Studi</option>
                        @foreach ($programStudis as $program_studi)
                            <option value="{{ $program_studi }}" {{ request('filterProdi') == $program_studi ? 'selected' : '' }}>
                                {{ $program_studi }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Per Page -->
                <div class="w-full sm:w-1/4">
                    <select
                        id="perpage-select"
                        name="perPage"
                        data-url="{{ route('manage-cta.index') }}"
                        data-target="ManageCTATableBody"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>Semua {{ $title }}</option>
                        <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 / halaman</option>
                        <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 / halaman</option>
                        <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 / halaman</option>
                        <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100 / halaman</option>
                    </select>
                </div>

            </div>
        </div>

        <!-- Table -->
        <div class="overflow-x-auto -mx-3 sm:mx-0">
            <div class="min-w-full inline-block align-middle">
                <div class="overflow-hidden border border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    No
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Foto Pendaftar
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nama Lengkap
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    NIM
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Angkatan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Program Studi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alamat Asal
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Domisili Saat Ini
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Nomor Telepon/WhatsApp
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Instagram
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Alasan Bergabung
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Minat
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="ManageCTATableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.bph.manajemen_konten.cta.partials.table_body')
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="13" class="px-6 py-3 text-sm text-gray-700">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                        <span>Total {{$title}}: <span class="font-semibold">{{ $totalAll }}</span></span>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <!-- Pagination -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6 gap-4 pt-4">
            <!-- Info jumlah data -->
            <div class="text-sm text-gray-500 text-center sm:text-left">
                Menampilkan 
                <span class="font-medium">{{ $ctas->firstItem() }}</span> 
                sampai 
                <span class="font-medium">{{ $ctas->lastItem() }}</span> 
                dari 
                <span class="font-medium">{{ $ctas->total() }}</span> {{ $title }}
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    {{-- Tombol Sebelumnya --}}
                    @if ($ctas->onFirstPage())
                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $ctas->previousPageUrl() }}" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Sebelumnya
                        </a>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($ctas->getUrlRange(1, $ctas->lastPage()) as $page => $url)
                        @if ($page == $ctas->currentPage())
                            <span class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $url }}" 
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                {{ $page }}
                            </a>
                        @endif
                    @endforeach

                    {{-- Tombol Selanjutnya --}}
                    @if ($ctas->hasMorePages())
                        <a href="{{ $ctas->nextPageUrl() }}" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Selanjutnya
                        </a>
                    @else
                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                            Selanjutnya
                        </span>
                    @endif
                </nav>

            </div>
        </div>
    </div>

    <!-- Modals -->
    @include('admin.bph.manajemen_konten.cta.create')
    @include('admin.bph.manajemen_konten.cta.update')
    @include('admin.bph.manajemen_konten.cta.delete')

</x-admin.bph.layouts>
