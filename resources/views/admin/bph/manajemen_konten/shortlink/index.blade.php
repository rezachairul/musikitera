<x-admin.bph.layouts>
<x-slot:title>Kelola {{ $title }}</x-slot:title>

{{-- ================= Generate Short Link ================= --}}
<div class="max-w-5xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-md mt-6">
    <div class="flex items-center gap-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
        </svg>
        <h1 class="text-xl font-semibold text-gray-800">
            Generate Short Link
        </h1>
    </div>
    

    <form action="{{ isset($shortlink) ? route('manage-shortlink.update', $shortlink->id) : route('manage-shortlink.store') }}" method="POST">
        @csrf
        @if(isset($shortlink)) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            {{-- URL ASLI + GENERATE --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">URL Asli</label>
                <div class="flex gap-2">
                    <input id="originalUrl" type="url" name="original_url" required value="{{ old('original_url', $shortlink->original_url ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://drive.google.com/...">

                    <button type="button" id="btnGenerateSlug" class="flex items-center gap-2 bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 whitespace-nowrap" >
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                        </svg>
                        <span>Generate</span>
                    </button>
                </div>
            </div>

            {{-- GENERATE SLUG --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">Short Link</label>

                <div class="flex gap-2">
                    <div class="flex items-center w-full border border-gray-200 rounded-lg overflow-hidden">
                        <span class="px-3 text-sm text-gray-500 bg-gray-50">
                            {{ url('/r/') }}/
                        </span>

                        <input type="text" name="slug" id="slugInput"
                            value="{{ old('slug', $shortlink->slug ?? '') }}"
                            class="flex-1 px-3 py-2 focus:outline-none"
                            placeholder="slug-otomatis" readonly>
                        
                        <button type="button" id="btnEditSlug" class="px-3 text-amber-500 hover:text-amber-600">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            {{-- STATUS --}}
            <div>
                <label class="block text-sm font-medium mb-2">Status</label>
                <select name="is_hidden"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="0" {{ old('is_hidden', $shortlink->is_hidden ?? 0) == 0 ? 'selected' : '' }}>
                        Aktif
                    </option>
                    <option value="1" {{ old('is_hidden', $shortlink->is_hidden ?? 0) == 1 ? 'selected' : '' }}>
                        Hidden
                    </option>
                </select>
            </div>

            {{-- EXPIRED DATE --}}
            <div>
                <label class="block text-sm font-medium mb-2">Expired Date (Opsional)</label>
                <input type="date" name="expired_at"
                    value="{{ old('expired_at', isset($shortlink->expired_at) ? \Carbon\Carbon::parse($shortlink->expired_at)->format('Y-m-d') : '') }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                <p class="text-xs text-red-500 mt-1">
                    Kosongkan untuk default 3 bulan.
                </p>
            </div>

        </div>

        <div class="flex justify-end mt-6">
            <button
                class="{{ isset($shortlink) 
                    ? 'bg-amber-500 hover:bg-amber-600' 
                    : 'bg-blue-600 hover:bg-blue-700' 
                }} text-white px-4 py-2 rounded-lg transition">
                {{ isset($shortlink) ? 'Update Shortlink' : 'Simpan Shortlink' }}
            </button>
        </div>

        <!-- Script Generate Short Link by Slug-->
        <script>
            function generateSlug(length = 6) {
                const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                let slug = '';
                for (let i = 0; i < length; i++) {
                    slug += chars.charAt(Math.floor(Math.random() * chars.length));
                }

                const input = document.getElementById('slugInput');
                if (input) {
                    input.value = slug;
                }
            }

            function enableEditSlug() {
                const input = document.getElementById('slugInput');
                if (input) {
                    input.removeAttribute('readonly');
                    input.focus();
                }
            }

            document.addEventListener('DOMContentLoaded', function () {
                const btnGenerate = document.getElementById('btnGenerateSlug');
                const btnEdit = document.getElementById('btnEditSlug');
                const originalUrlInput = document.getElementById('originalUrl');

                // fungsi toggle enable/disable tombol generate
                function toggleGenerateButton() {
                    if (!originalUrlInput) return;

                    if (originalUrlInput.value.trim() === '') {
                        btnGenerate.disabled = true;
                        btnGenerate.classList.add('opacity-50', 'cursor-not-allowed');
                    } else {
                        btnGenerate.disabled = false;
                        btnGenerate.classList.remove('opacity-50', 'cursor-not-allowed');
                    }
                }

                // cek saat pertama load
                toggleGenerateButton();

                // cek saat user mengetik URL
                if (originalUrlInput) {
                    originalUrlInput.addEventListener('input', toggleGenerateButton);
                }

                if (btnGenerate) {
                    btnGenerate.addEventListener('click', function () {
                        if (!originalUrlInput || originalUrlInput.value.trim() === '') {
                            alert('URL Asli harus diisi dulu!');
                            return;
                        }
                        generateSlug();
                    });
                }

                if (btnEdit) {
                    btnEdit.addEventListener('click', function () {
                        enableEditSlug();
                    });
                }
            });
        </script>
    </form>    
</div>

<!-- Table Management Area -->
<div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
        <!-- Header -->
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Kelola Shortlink</h2>
            <p class="text-gray-600 mt-1 text-sm">
                Data Short Link disusun agar lebih teratur dan mudah diakses. <br>
                Shortlink adalah energi yang membuat organisasi terus hidup.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-2">
            <!-- Export -->
                <a href="#" class="w-full sm:w-auto bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5M16.5 12 12 16.5m0 0L7.5 12m4.5 4.5V3" />
                </svg>
                Export Excel
            </a>
        </div>
    </div>

    <!-- Filter dan Search -->
    <div>
        <div class="flex flex-col gap-3 mb-4 sm:flex-row sm:items-center sm:justify-between">
            <!-- Search -->
            <div class="relative w-full sm:w-1/3">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0 A7.5 7.5 0 1 0 5.196 5.196 a7.5 7.5 0 0 0 10.607 10.607Z" />
                    </svg>
                </div>
                <input 
                    type="search" 
                    id="search-input"
                    value="{{ request('search') }}"
                    data-url="{{ route('manage-shortlink.index') }}"
                    data-target="shortlinkTableBody"
                    placeholder="Search {{ $title }}..." 
                    class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Filters -->
            <div class="flex gap-3 w-full sm:w-2/3">
                <!-- By Status -->
                <select
                    id="filter-select"
                    name="filter"
                    data-url="{{ route('manage-shortlink.index') }}"
                    data-target="shortlinkTableBody"
                    class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>
                        -- All Status --
                    </option>
                    <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="hidden" {{ request('filter') == 'hidden' ? 'selected' : '' }}>
                        Hidden
                    </option>
                    <option value="expired" {{ request('filter') == 'expired' ? 'selected' : '' }}>
                        Expired
                    </option>
                </select>

                <!-- By Per-Page -->
                <select
                    id="perpage-select"
                    name="perPage"
                    data-url="{{ route('manage-shortlink.index') }}"
                    data-target="shortlinkTableBody"
                    class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>-- All {{ $title }} Page --</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 {{ $title }} per page</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 {{ $title }} per page</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 {{ $title }} per page</option>
                    <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100 {{ $title }} per page</option>
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
                                Short Link
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                URL Asli
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                             <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Expired
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Klik
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="shortlinkTableBody" class="bg-white divide-y divide-gray-200">
                        @include('admin.bph.manajemen_konten.shortlink.partials.table_body')
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="7" class="px-6 py-3 text-sm text-gray-700">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <span>
                                        Total Shortlink: 
                                        <span class="font-semibold">{{ $totalAll }}</span>
                                    </span>

                                    <span>
                                        Hasil Ditampilkan: 
                                        <span class="font-semibold">{{ $totalFiltered }}</span>
                                    </span>
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
            <span class="font-medium">{{ $shortlinks->firstItem() ?? 0 }}</span> 
            sampai 
            <span class="font-medium">{{ $shortlinks->lastItem() ?? 0 }}</span> 
            dari 
            <span class="font-medium">{{ $shortlinks->total() }}</span> Short Link.
        </div>

        <!-- Tombol Pagination -->
        <div class="flex justify-center sm:justify-end">
            <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">

                {{-- Tombol Sebelumnya --}}
                @if ($shortlinks->onFirstPage())
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </span>
                @else
                    <a href="{{ $shortlinks->previousPageUrl() }}" 
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </a>
                @endif

                {{-- Tombol Angka Halaman --}}
                @foreach ($shortlinks->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $shortlinks->currentPage())
                        <span
                            class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
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
                @if ($shortlinks->hasMorePages())
                    <a href="{{ $shortlinks->nextPageUrl() }}" 
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                        <span class="hidden sm:inline">Selanjutnya</span>
                    </a>
                @else
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                        <span class="hidden sm:inline">Selanjutnya</span>
                    </span>
                @endif
            </nav>
        </div>
    </div>   
</div>

@include('admin.bph.manajemen_konten.shortlink.create')
@include('admin.bph.manajemen_konten.shortlink.update')
@include('admin.bph.manajemen_konten.shortlink.delete')

</x-admin.bph.layouts>
