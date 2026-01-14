<!-- Sidebar Administrator -->

<div class="w-64 bg-white shadow-lg text-gray-800 flex flex-col p-5">
    {{-- Logo + Nama + Tagline --}}
    <div class="flex items-center space-x-3 mb-8">
        <!-- Logo -->
        <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" 
             alt="Logo UKMBSM" 
             class="h-12 w-12 object-contain">

        <!-- Nama + Tagline -->
        <div class="flex flex-col leading-tight">
            <a href="/" class="text-xl font-bold text-gray-800">UKMBSM ITERA</a>
            <a href="/" class="text-sm italic text-gray-600 tracking-wide">#AsikinAja</a>
        </div>
    </div>

    {{-- Navigation --}}
    <nav class="flex flex-col gap-2">
        <!-- Dashboard -->
        <a href="{{ route('dashboard.index') }}" class="relative flex items-center gap-3 px-3 py-2 rounded-md transition-colors
                  {{ request()->is('administrator/dashboard') ? 'bg-gray-200 text-amber-600' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
            <!-- Border kiri indikator aktif -->
            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md {{ request()->is('administrator/dashboard') ? 'bg-amber-600' : '' }}"></span>

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="font-medium ml-2 transition-colors">Dashboard</span>
        </a>

        <!-- Manage User -->
        <a href="{{ route('manage-user.index') }}" class="relative flex items-center gap-3 px-3 py-2 rounded-md transition-colors
                {{ request()->is('administrator/manage-user*') ? 'bg-gray-200 text-amber-600' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md {{ request()->is('administrator/manage-user*') ? 'bg-amber-600' : '' }}"></span>

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span class="font-medium ml-2 transition-colors">Manage Users</span>
        </a>

        <!-- Manage Struktur Badan Pengurus -->
        <a href="{{ route('manage-bph.index') }}" class="relative flex items-center gap-3 px-3 py-2 rounded-md transition-colors
                {{ request()->is('administrator/manage-bph*') ? 'bg-gray-200 text-amber-600' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md {{ request()->is('administrator/manage-bph*') ? 'bg-amber-600' : '' }}"></span>

            <!-- Icon -->
             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205 3 1m1.5.5-1.5-.5M6.75 7.364V3h-3v18m3-13.636 10.5-3.819" />
            </svg>
            <span class="font-medium ml-2 transition-colors">Manage BPH</span>
        </a>

        <!-- Manage Struktur Dewan Pengawas -->
        <a href="{{ route('manage-dpo.index') }}" class="relative flex items-center gap-3 px-3 py-2 rounded-md transition-colors
                {{ request()->is('administrator/manage-dpo*') ? 'bg-gray-200 text-amber-600' : 'text-gray-700 hover:bg-gray-100 hover:text-amber-600' }}">
            <span class="absolute inset-y-0 left-0 w-1 rounded-tr-md rounded-br-md {{ request()->is('administrator/manage-dpo*') ? 'bg-amber-600' : '' }}"></span>

            <!-- Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
            </svg>

            <span class="font-medium ml-2 transition-colors">Manage DPO</span>
        </a>
    </nav>

</div>
