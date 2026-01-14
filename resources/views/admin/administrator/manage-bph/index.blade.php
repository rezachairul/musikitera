<!-- Manage BPH Administrator -->

<x-admin.administrator.layouts
    :title="$title"
    :description="$description"
    :author="$author"
    >
    <x-slot:title>Kelola {{ $title }}</x-slot:title>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 p-8">
        <!-- Admin -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-amber-600">
            <!-- Icon: Computer-Dekstop -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-amber-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 17.25v1.007a3 3 0 0 1-.879 2.122L7.5 21h9l-.621-.621A3 3 0 0 1 15 18.257V17.25m6-12V15a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 15V5.25m18 0A2.25 2.25 0 0 0 18.75 3H5.25A2.25 2.25 0 0 0 3 5.25m18 0V12a2.25 2.25 0 0 1-2.25 2.25H5.25A2.25 2.25 0 0 1 3 12V5.25" />
            </svg>

            <h2 class="text-lg font-semibold text-gray-800">Admin</h2>
            <p class="text-sm text-gray-500">Jumlah <strong>{{ $totals['admin'] }}</strong></p>
        </div>

        <!-- Badan Pengurus -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-blue-600">
            <!-- Icon: Home-Modern -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-blue-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Badan Pengurus</h2>
            <p class="text-sm text-gray-500">Jumlah <strong>{{ $totals['bph'] }}</strong></p>
        </div>

        <!-- Dewan Pengawas -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-green-600">
            <!-- Icon: Eye -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-green-500 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Dewan Pengawas</h2>
            <p class="text-sm text-gray-500">Jumlah <strong>{{ $totals['dpo'] }}</strong></p>
        </div>

        <!-- Pembina -->
        <div class="bg-white p-6 rounded-xl shadow-md border border-gray-200 
                    flex flex-col items-center text-center transition-all duration-300 
                    hover:scale-105 hover:shadow-lg hover:border-purple-600">
            <!-- Icon: Building-Library -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-12 text-purple-600 mb-3">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z" />
            </svg>
            <h2 class="text-lg font-semibold text-gray-800">Pembina</h2>
            <p class="text-sm text-gray-500">Jumlah <strong>{{ $totals['pembina'] }}</strong></p>
        </div>
    </div>

    <!-- Table Management Area -->
    <div class="bg-white rounded-xl border border-gray-200 p-3 sm:p-6 m-3 sm:m-6 shadow-sm">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 sm:mb-6 gap-3 sm:gap-2">
            <!-- Header -->
            <div>
                <h2 class="text-lg font-semibold text-gray-900">Kelola {{ $title }}</h2>                
                <p class="text-gray-600 mt-1 text-sm">
                    Setiap {{ $title }} adalah bintang kecil. <br>
                    Susun mereka, dan biarkan website ini bersinar lebih terang.
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
                 <a href="{{ route('manage-user.export', [
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
                        data-url="{{ route('manage-user.index') }}"
                        data-target="userTableBody"
                        placeholder="Search {{ $title }}..." 
                        class="w-full border border-gray-300 rounded-lg pl-10 pr-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <!-- Filters -->
                <div class="flex gap-3 w-full sm:w-2/3">
                    <!-- By Role -->
                    <select
                        id="filter-select"
                        name="filter"
                        data-url="{{ route('manage-user.index') }}"
                        data-target="userTableBody"
                        class="border border-gray-300 rounded-lg px-3 py-2 w-1/2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="all" {{ request('filter') == 'all' ? 'selected' : '' }}>-- All Role --</option>
                        <option value="admin" {{ request('filter') == 'admin' ? 'selected' : '' }}>Administrator</option>
                        <option value="bph" {{ request('filter') == 'bph' ? 'selected' : '' }}>Badan Pengurus</option>
                        <option value="dpo" {{ request('filter') == 'dpo ' ? 'selected' : '' }}>Dewan Pengawas</option>
                        <option value="pembina" {{ request('filter') == 'pembina' ? 'selected' : '' }}>Pembina</option>
                    </select>

                    <!-- By Per-Page -->
                    <select
                        id="perpage-select"
                        name="perPage"
                        data-url="{{ route('manage-user.index') }}"
                        data-target="userTableBody"
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
                                    Name
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Email
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Role
                                </th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody id="userTableBody" class="bg-white divide-y divide-gray-200">
                            @include ('admin.administrator.manage-user.partials.table_body')
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="5" class="px-6 py-3 text-sm text-gray-700">
                                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                                        <span>Total Users: <span class="font-semibold">{{ $totals['all'] }}</span></span>
                                        <div class="flex flex-wrap gap-4 text-sm">
                                            <span>Administrator: <span class="font-semibold">{{ $totals['admin'] }}</span></span>
                                            <span>BPH: <span class="font-semibold">{{ $totals['bph'] }}</span></span>
                                            <span>DPO: <span class="font-semibold">{{ $totals['dpo'] }}</span></span>
                                            <span>Pembina: <span class="font-semibold">{{ $totals['pembina'] }}</span></span>
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
                {{ $users->firstItem() ?? 0 }} 
                sampai 
                {{ $users->lastItem() ?? 0 }} 
                dari 
                {{ $users->total() }} {{ $title }}
            </div>

            <!-- Tombol Pagination -->
            <div class="flex justify-center sm:justify-end">
                <nav class="inline-flex space-x-1 sm:space-x-2" aria-label="Pagination">

                    {{-- Tombol Sebelumnya --}}
                    @if ($users->onFirstPage())
                        <span
                            class="px-3 py-2 text-sm font-medium text-gray-400 bg-gray-100 border border-gray-300 rounded-lg cursor-not-allowed flex items-center gap-1">
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </span>
                    @else
                        <a href="{{ $users->previousPageUrl() }}" 
                        class="px-3 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 flex items-center gap-1">
                            <span class="hidden sm:inline">Sebelumnya</span>
                        </a>
                    @endif

                    {{-- Tombol Angka Halaman --}}
                    @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                        @if ($page == $users->currentPage())
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
                    @if ($users->hasMorePages())
                        <a href="{{ $users->nextPageUrl() }}" 
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

    <!-- Modals -->
    @include('admin.administrator.manage-user.create')
    @include('admin.administrator.manage-user.update')
    @include('admin.administrator.manage-user.delete')

</x-admin.administrator.layouts>
