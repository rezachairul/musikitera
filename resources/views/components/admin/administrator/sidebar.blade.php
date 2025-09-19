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
        <a href="{{ route('admin.administrator.dashboard.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
            </svg>
            <span class="font-medium text-gray-700 group-hover:text-amber-600 transition-colors">Dashboard</span>
        </a>

        <!-- Manage User -->
        <a href="{{ route('manage-user.index') }}" 
           class="flex items-center gap-3 px-3 py-2 rounded-md hover:bg-gray-100 transition-colors">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" 
                 stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <span class="font-medium text-gray-700 group-hover:text-amber-600 transition-colors">Manage User</span>
        </a>
    </nav>
</div>
