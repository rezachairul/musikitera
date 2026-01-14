<!-- Navbar Administrator -->

<nav class="bg-white shadow sticky top-0 z-50">
  <div class="w-full max-w-7xl mx-auto px-4 md:px-6 py-3 flex items-center justify-end space-x-6">

    <!-- Notif -->
    <div class="relative group">
      <button class="focus:outline-none hover:text-yellow-600 flex items-center gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967  0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967  0 0 1-2.312 6.022c1.733.64 3.56 1.085  5.455 1.31m5.714 0a24.255 24.255  0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0" />
        </svg>
      </button>

      <!-- Dropdown Notif -->
      <div
        class="absolute right-0 mt-2 w-52 bg-white shadow-lg rounded-lg p-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
        <p class="text-sm text-gray-500">Tidak ada notifikasi</p>
      </div>
    </div>

    <!-- Dark / Light Mode -->
    <button id="dark-toggle" class="focus:outline-none relative w-6 h-6">
      <!-- Light Mode -->
      <svg id="icon-sun" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute inset-0 size-6 block icon-transition">
        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386-1.591 1.591M21  12h-2.25m-.386 6.364-1.591-1.591M12  18.75V21m-4.773-4.227-1.591 1.591M5.25  12H3m4.227-4.773L5.636 5.636M15.75  12a3.75 3.75 0 1 1-7.5 0 3.75  3.75 0 0 1 7.5 0Z" />
      </svg>

      <!-- Dark Mode -->
      <svg id="icon-moon" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute inset-0 size-6 hidden icon-transition">
        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.72 9.72 0 0 1  18 15.75c-5.385 0-9.75-4.365-9.75-9.75  0-1.33.266-2.597.748-3.752A9.753  9.753 0 0 0 3 11.25C3 16.635  7.365 21 12.75 21a9.753  9.753 0 0 0 9.002-5.998Z" />
      </svg>
    </button>

    <!-- Profile -->
    <div class="relative group">
      <button class="focus:outline-none flex items-center space-x-2">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0  12 15.75a7.488 7.488 0 0 0-5.982  2.975m11.963 0a9 9 0 1 0-11.963  0m11.963 0A8.966 8.966 0 0 1  12 21a8.966 8.966 0 0 1-5.982-2.275M15  9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
        </svg>
      </button>

      <!-- Dropdown Profile -->
      <div
        class="absolute right-0 mt-2 w-64 bg-white shadow-lg rounded-lg opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
        <div class="px-4 py-3 border-b space-y-2">
          <!-- Name -->
          <div class="flex items-center gap-2 text-gray-700">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-yellow-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
            </svg>
            <p class="text-sm font-semibold">{{ Auth::user()->name }}</p>
          </div>

          <!-- Email -->
          <div class="flex items-center gap-2 text-gray-500">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-blue-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />
            </svg>
            <p class="text-xs">{{ Auth::user()->email }}</p>
          </div>

          <!-- Role -->
           @php
              $roleLabels = [
                  'admin'   => ['label' => 'Administrator', 'color' => 'text-red-700'],
                  'bph'     => ['label' => 'Badan Pengurus', 'color' => 'text-blue-700'],
                  'dpo'     => ['label' => 'Dewan Pengawas', 'color' => 'text-green-700'],
                  'pembina' => ['label' => 'Pembina', 'color' => 'text-yellow-700'],
              ];

              $userRole = Auth::user()->role;
              $roleData = $roleLabels[$userRole] ?? ['label' => ucfirst($userRole), 'color' => 'bg-gray-100 text-gray-700'];
          @endphp
          <div class="flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5 text-green-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959  11.959 0 0 1 3.598 6 11.99 11.99 0 0 0  3 9.749c0 5.592 3.824 10.29 9  11.623 5.176-1.332 9-6.03  9-11.622 0-1.31-.21-2.571-.598-3.751h-.152 c-3.196 0-6.1-1.248-8.25-3.285Z" />
            </svg>
            <span class="text-xs px-2 py-0.5 rounded-full font-medium {{ $roleData['color'] }}">
              {{ $roleData['label'] }}
            </span>
          </div>
        </div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button 
            type="submit"
            class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 rounded-b-lg">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6A2.25 2.25 0 0 0 5.25 5.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H3" />
            </svg>
            Logout
          </button>
        </form>
      </div>
    </div>
  </div>
</nav>
