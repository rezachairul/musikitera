<x-admin.bph.layouts>
<x-slot:title>Kelola {{ $title }}</x-slot:title>

{{-- ================= PROFIL STUDIO (SINGLE ENTRY) ================= --}}
<div class="max-w-5xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-md mt-6">
    <h1 class="text-xl font-semibold text-gray-800 mb-6">
        Profil Studio Musik
    </h1>

    <form action="{{ $studio ? route('manage-studio-musik.update', $studio->id) : route('manage-studio-musik.store') }}" 
          method="POST">
        @csrf
        @if($studio) @method('PUT') @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">Nama Studio</label>
                <input type="text" name="nama_studio" required
                    value="{{ old('nama_studio', $studio->nama_studio ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Nama Studio">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Deskripsi" required>{{ old('deskripsi', $studio->deskripsi ?? '') }}</textarea>
            </div>

            {{-- Jam --}}
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Weekday Open</label>
                <input type="time" name="weekday_open" value="{{ old('weekday_open', $studio->weekday_open ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Nama" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Weekday Close</label>
                <input type="time" name="weekday_close" value="{{ old('weekday_close', $studio->weekday_close ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Nama" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Weekend Open</label>
                <input type="time" name="weekend_open" value="{{ old('weekend_open', $studio->weekend_open ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Nama" required>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Weekend Close</label>
                <input type="time" name="weekend_close" value="{{ old('weekend_close', $studio->weekend_close ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="Masukan Nama" required>
            </div>

            {{-- Lokasi --}}
            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-3">
                    Lokasi Studio
                </label>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Ruang</label>
                        <input type="text" name="ruang" value="{{ old('ruang', $studio->ruang ?? '') }}" placeholder="Masukkan Ruang" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Lantai</label>
                        <input type="text" name="lantai" value="{{ old('lantai', $studio->lantai ?? '') }}" placeholder="Masukkan Lantai" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Gedung</label>
                        <input type="text" name="gedung" value="{{ old('gedung', $studio->gedung ?? '') }}" placeholder="Masukkan Gedung" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    </div>

                    <div>
                        <label class="block text-sm text-gray-600 mb-1">Lokasi</label>
                        <input type="text" name="lokasi" value="{{ old('lokasi', $studio->lokasi ?? '') }}" placeholder="Masukkan Lokasi" required class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500" >
                    </div>
                </div>
            </div>
        </div>

        <div class="flex justify-end mt-6">
            <button class="bg-blue-600 text-white px-4 py-2 rounded-lg pointer-hover hover:bg-blue-700 transition-colors duration-200">
                {{ $studio ? 'Update Profil Studio Musik' : 'Simpan Profil Studio Musik' }}
            </button>
        </div>
    </form>
</div>

<!-- Table Management Area -->
<div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
        <!-- Header -->
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Kelola Fasilitas Studio Musik</h2>
            <p class="text-gray-600 mt-1 text-sm">
                Data Fasilitas Studio Musik disusun agar lebih teratur dan mudah diakses. <br>
                Fasilitas Studio adalah energi yang membuat organisasi terus hidup.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="flex flex-col sm:flex-row gap-2">
            <!-- Create -->
            <button onclick="openAddModal()" class="w-full sm:w-auto bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors duration-200 flex items-center justify-center">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Create Facility
            </button>

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
                    data-url="{{ route('manage-studio-musik.index') }}"
                    data-target="studioMusikTableBody"
                    placeholder="Search {{ $title }}..." 
                    class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <!-- Filters -->
            <div class="flex gap-3 w-full sm:w-2/3">
                <!-- By Role -->
                <select
                    id="filter-select"
                    name="filter"
                    data-url="{{ route('manage-studio-musik.index') }}"
                    data-target="studioMusikTableBody"
                    class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">

                    <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>
                        -- All Status --
                    </option>
                    <option value="active" {{ request('filter') == 'active' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="inactive" {{ request('filter') == 'inactive' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>


                <!-- By Per-Page -->
                <select
                    id="perpage-select"
                    name="perPage"
                    data-url="{{ route('manage-studio-musik.index') }}"
                    data-target="studioMusikTableBody"
                    class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="all" {{ request('perPage') == 'all' ? 'selected' : '' }}>-- All {{ $title }} Page --</option>
                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10 {{ $title }} per page</option>
                    <option value="25" {{ request('perPage') == 25 ? 'selected' : '' }}>25 {{ $title }} per page</option>
                    <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50 {{ $title }} per page</option>
                    <option alue="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100 {{ $title }} per page</option>
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
                                Foto
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Nama
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Deskripsi
                            </th>
                             <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Urutan
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody id="studioMusikTableBody" class="bg-white divide-y divide-gray-200">
                        @include ('admin.bph.tentang_ukmbsm.studio_musik.partials.table_body')
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="7" class="px-6 py-3 text-sm text-gray-700">
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                    <span>Total Fasilitas: {{ $total_facilities['all'] }}<span class="font-semibold"></span></span>
                                    <div class="flex flex-wrap gap-4 text-sm">
                                    </div>
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
            <span class="font-medium">{{ $facilities->firstItem() ?? 0 }}</span> 
            sampai 
            <span class="font-medium">{{ $facilities->lastItem() ?? 0 }}</span> 
            dari 
            <span class="font-medium">{{ $facilities->total() }}</span> Fasilitas Studio Musik.
        </div>

        <!-- Tombol Pagination -->
        <div class="flex justify-center sm:justify-end">
            <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">

                {{-- Tombol Sebelumnya --}}
                @if ($facilities->onFirstPage())
                    <span
                        class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </span>
                @else
                    <a href="{{ $facilities->previousPageUrl() }}" 
                    class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                        <span class="hidden sm:inline">Sebelumnya</span>
                    </a>
                @endif

                {{-- Tombol Angka Halaman --}}
                @foreach ($facilities->links()->elements[0] ?? [] as $page => $url)
                    @if ($page == $facilities->currentPage())
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
                @if ($facilities->hasMorePages())
                    <a href="{{ $facilities->nextPageUrl() }}" 
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

@include('admin.bph.tentang_ukmbsm.studio_musik.create')
@include('admin.bph.tentang_ukmbsm.studio_musik.update')
@include('admin.bph.tentang_ukmbsm.studio_musik.delete')

</x-admin.bph.layouts>
