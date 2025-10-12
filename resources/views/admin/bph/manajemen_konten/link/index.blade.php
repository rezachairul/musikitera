<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>

    <!-- Table Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
            <!-- Header -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">
                    Daftar {{ strtolower($title) }} untuk mengatur berbagai tautan penting seperti formulir, <br>
                    media sosial, dan website organisasi.
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
                 <a href="{{ route('manage-link.export', [
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
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3 items-center">

                <!-- Kolom 1: Search -->
                <div class="relative w-full">
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
                        data-url="{{ route('manage-link.index') }}"
                        data-target="ManageLinkTableBody"
                        placeholder="Cari {{ $title }}..." 
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Kolom 2: Filter Kategori -->
                <div class="w-full">
                    <select
                        id="filter-input"
                        name="filterKategori"
                        data-url="{{ route('manage-link.index') }}"
                        data-target="ManageLinkTableBody"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('filterKategori') == 'all' ? 'selected' : '' }}>
                            Semua Kategori
                        </option>
                        @foreach ($kategoriList as $key => $label)
                            <option value="{{ $key }}" {{ request('filterKategori') == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Kolom 3: Per Page -->
                <div class="w-full">
                    <select
                        id="perpage-select"
                        name="perPage"
                        data-url="{{ route('manage-link.index') }}"
                        data-target="ManageLinkTableBody"
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
                                    Nama Link
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    URL
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Kategori
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Deskripsi
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="ManageLinkTableBody" class="bg-white divide-y divide-gray-200">
                            @include('admin.bph.manajemen_konten.link.partials.table_body')
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="7" class="px-6 py-3 text-sm text-gray-700">
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
                <span class="font-medium">{{ $links->firstItem() }}</span> 
                sampai 
                <span class="font-medium">{{ $links->lastItem() }}</span> 
                dari 
                <span class="font-medium">{{ $links->total() }}</span> {{ $title }}
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">
                    {{-- Tombol Sebelumnya --}}
                    @if ($links->onFirstPage())
                        <span class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed">
                            Sebelumnya
                        </span>
                    @else
                        <a href="{{ $links->previousPageUrl() }}" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Sebelumnya
                        </a>
                    @endif

                    {{-- Nomor Halaman --}}
                    @foreach ($links->getUrlRange(1, $links->lastPage()) as $page => $url)
                        @if ($page == $links->currentPage())
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
                    @if ($links->hasMorePages())
                        <a href="{{ $links->nextPageUrl() }}" 
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
    @include('admin.bph.manajemen_konten.link.create')
    @include('admin.bph.manajemen_konten.link.update')
    @include('admin.bph.manajemen_konten.link.delete')

</x-admin.bph.layouts>
