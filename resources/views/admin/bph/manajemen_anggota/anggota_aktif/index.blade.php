<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-8">
        <!-- Graduate -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-emerald-600">
            <!-- Icon: Graduation Cap -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-emerald-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Graduate: {{ $totals['graduate'] }}</h2>
            <p class="text-sm text-gray-500">Lulus dari ITERA</p>
        </div>

        <!-- On Going -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-blue-600">
            <!-- Icon: Book Open -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-blue-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">On Going: {{ $totals['on_going'] }}</h2>
            <p class="text-sm text-gray-500">Masih Aktif Perkuliahan</p>
        </div>

        <!-- Drop Out -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-red-600">
            <!-- Icon: Out -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-red-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Drop Out: {{ $totals['drop_out'] }}</h2>
            <p class="text-sm text-gray-500">Keluar dari ITERA</p>
        </div>

        <!-- Exit -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-amber-600">
            <!-- Icon: exclamation-triangle -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-amber-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Exit: {{ $totals['exit'] }}</h2>
            <p class="text-sm text-gray-500">Dikeluarkan dari UKMBSM</p>
        </div>
    </div>


    <!-- Table Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
            <!-- Header -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>
                <p class="text-gray-600 mt-1 text-sm">
                    Data {{ $title }} disusun agar lebih teratur dan mudah diakses. <br>
                    Setiap anggota adalah energi yang membuat organisasi terus hidup.
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
                 <a href="{{ route('anggota-aktif.export', [
                    'filter' => request()->get('filter', 'all'),
                    'search' => request()->get('search')
                ]) }}" class="w-full sm:w-auto bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition-colors duration-200 flex items-center justify-center">
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
                        data-url="{{ route('anggota-aktif.index') }}"
                        data-target="anggotaAktifTableBody"
                        placeholder="Search {{ $title }}..." 
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filters -->
                <div class="flex gap-3 w-full sm:w-2/3">
                    <!-- By Role -->
                    <select
                        id="filter-select"
                        name="filter"
                        data-url="{{ route('anggota-aktif.index') }}"
                        data-target="anggotaAktifTableBody"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>-- All Status --</option>
                        <option value="graduate" {{ request('filter') == 'graduate' ? 'selected' : '' }}>Graduate</option>
                        <option value="on_going" {{ request('filter') == 'on_going' ? 'selected' : '' }}>Aktif Perkuliahan</option>
                        <option value="drop_out" {{ request('filter') == 'drop_out ' ? 'selected' : '' }}>Drop Out</option>
                        <option value="exit" {{ request('filter') == 'exit' ? 'selected' : '' }}>Exit</option>
                    </select>

                    <!-- By Per-Page -->
                    <select
                        id="perpage-select"
                        name="perPage"
                        data-url="{{ route('anggota-aktif.index') }}"
                        data-target="anggotaAktifTableBody"
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
                                    Nama
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
                                    NIA
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Status Perkuliahan
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="anggotaAktifTableBody" class="bg-white divide-y divide-gray-200">
                            @include ('admin.bph.manajemen_anggota.anggota_aktif.partials.table_body')
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="8" class="px-6 py-3 text-sm text-gray-700">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                        <span>Total Anggota: {{ $totals['all'] }}<span class="font-semibold"></span></span>
                                        <div class="flex flex-wrap gap-4 text-sm">
                                            <span>Lulus: <span class="font-semibold">{{ $totals['graduate'] }}</span></span>
                                            <span>Aktif Perkuliahan: <span class="font-semibold">{{ $totals['on_going'] }}</span></span>
                                            <span>Drop Out: <span class="font-semibold">{{ $totals['drop_out'] }}</span></span>
                                            <span>Exit: <span class="font-semibold">{{ $totals['exit'] }}</span></span>
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
                sampai 
                dari
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">

                    {{-- Tombol Sebelumnya --}}
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                        <a href="#" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>

                    {{-- Tombol Angka Halaman --}}
                            <span
                                class="px-3 py-2 text-sm font-semibold text-white bg-blue-600 border border-blue-600 rounded-lg">
                                
                            </span>
                            <a href="#" 
                            class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                                
                            </a>

                    {{-- Tombol Selanjutnya --}}
                        <a href="#" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <span class="hidden sm:inline">Selanjutnya</span>
                        </a>
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <span class="hidden sm:inline">Selanjutnya</span>
                        </span>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modals -->
     @include('admin.bph.manajemen_anggota.anggota_aktif.create')
     @include('admin.bph.manajemen_anggota.anggota_aktif.update')
     @include('admin.bph.manajemen_anggota.anggota_aktif.delete')
    

</x-admin.bph.layouts>
