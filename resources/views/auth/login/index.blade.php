<x-auth.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

   <!-- Full page container dengan background navy denim gradient -->
    <div class="h-screen w-full bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center p-4 relative overflow-hidden">

        <!-- Denim texture overlay -->
        <div class="absolute inset-0 opacity-10 bg-gradient-to-br from-blue-800/20 via-slate-800/30 to-indigo-800/20"></div>

        <!-- Musical background overlay dengan navy theme -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 text-4xl lg:text-6xl text-blue-300 rotate-12 animate-pulse">♪</div>
            <div class="absolute top-20 right-16 text-3xl lg:text-5xl text-indigo-300 -rotate-45 animate-bounce">♫</div>
            <div class="absolute top-1/3 left-1/4 text-4xl lg:text-6xl text-slate-300 rotate-45">♩</div>
            <div class="absolute bottom-32 right-20 text-2xl lg:text-4xl text-blue-400 -rotate-12 animate-pulse">♬</div>
            <div class="absolute top-1/2 left-8 text-3xl lg:text-5xl text-indigo-400 rotate-90">🎵</div>
            <div class="absolute bottom-20 left-1/3 text-4xl lg:text-6xl text-slate-400 -rotate-30">🎼</div>
            <div class="absolute top-2/3 right-1/4 text-3xl lg:text-5xl text-blue-300 rotate-15 animate-bounce">♪</div>
        </div>

        <!-- Main login container - Desktop: 2 columns, Mobile: 2 rows -->
        <div class="w-full max-w-3xl mx-auto px-4 relative z-10 py-8 sm:py-10 lg:py-12">
            <!-- Desktop Layout: Side by side -->
            <div class="flex flex-col py-8 sm:py-10 lg:py-12 lg:grid lg:grid-cols-2 lg:gap-8 xl:gap-10 lg:items-center lg:min-h-[450px]">

            <!-- Left side: Logo and header section (Desktop) / Top section (Mobile) -->
            <div class="text-center lg:text-left mb-8 lg:mb-0 order-1 lg:order-1 lg:pr-6">
                <!-- Logo -->
                <div
                class="mx-auto lg:mx-0 w-16 h-16 sm:w-20 sm:h-20 lg:w-24 lg:h-24 
                        bg-gradient-to-br from-slate-700 via-blue-800 to-indigo-900 
                        rounded-2xl flex items-center justify-center mb-4 
                        shadow-xl shadow-blue-900/50 border border-slate-600/30
                        hover:scale-105 transition-all duration-500 ease-out">
                <div class="text-white font-bold text-xl sm:text-2xl lg:text-3xl drop-shadow-lg">🎵</div>
                </div>

                <!-- App name and description -->
                <div class="lg:space-y-3">
                <h1
                    class="text-xl sm:text-2xl lg:text-3xl font-bold 
                        bg-gradient-to-r from-blue-200 via-slate-100 to-indigo-200 
                        bg-clip-text text-transparent mb-2 
                        drop-shadow-lg tracking-tight leading-tight">
                    UKM BSM ITERA
                </h1>
                <p
                    class="text-sm sm:text-base lg:text-lg 
                        text-slate-300 font-semibold tracking-wide">
                    Music Community Portal
                </p>

                <!-- Desktop only: Additional description -->
                <div class="hidden lg:block mt-4 space-y-3">
                    <p class="text-slate-300 text-base leading-relaxed font-light">
                    Bergabunglah dengan komunitas musik terbesar di ITERA
                    </p>
                    <div class="flex items-center space-x-3 justify-center lg:justify-start">
                    <span class="text-xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎸</span>
                    <span class="text-xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎤</span>
                    <span class="text-xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎵</span>
                    <span class="text-xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎼</span>
                    </div>
                    <div class="w-16 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full mx-auto lg:mx-0"></div>
                </div>
                </div>
            </div>

            <!-- Right side: Login form card -->
            <div class="order-2 lg:order-2 lg:justify-self-center lg:w-full lg:max-w-sm xl:max-w-md">
                <div class="relative overflow-hidden p-4 sm:p-6 lg:p-6 rounded-xl border border-slate-200/50 backdrop-blur-sm bg-gradient-to-br from-slate-100 via-white to-blue-50  shadow-xl shadow-slate-900/50 hover:shadow-2xl transition-all duration-500">

                <!-- Decorative -->
                <div class="absolute inset-0 rounded-xl bg-gradient-to-br from-slate-50/80 via-transparent to-blue-50/60"></div>

                <!-- Form header -->
                <div class="text-center mb-4 relative z-10">
                    <h2 class="text-base sm:text-lg lg:text-xl font-bold bg-gradient-to-r from-slate-700 via-blue-800 to-indigo-900 bg-clip-text text-transparent">
                    MASUK AKUN
                    </h2>
                </div>

                <!-- Error -->
                @if ($errors->any())
                    <div class="relative z-10 mb-4 p-2 rounded-lg border-l-4 border-red-500 bg-gradient-to-r from-red-50 to-red-100 text-red-800 shadow">
                    <div class="flex items-center text-sm">
                        <span class="mr-2 text-base">⚠️</span>
                        {{ $errors->first() }}
                    </div>
                    </div>
                @endif

                <!-- Success -->
                @if (session('success'))
                    <div class="relative z-10 mb-4 p-2 rounded-lg border-l-4 border-green-500 bg-gradient-to-r from-green-50 to-emerald-100 text-green-800 shadow">
                    <div class="flex items-center text-sm">
                        <span class="mr-2 text-base">✅</span>
                        {{ session('success') }}
                    </div>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-4 relative z-10">
                    @csrf
                    
                    <!-- Email -->
                    <div class="group">
                    <label class="block mb-1 text-sm font-bold text-slate-700 group-focus-within:text-blue-800 transition-colors">
                        Email:
                    </label>
                    <div class="relative">
                        <input type="email" name="email" required autocomplete="email" placeholder="Isikan email disini" class="w-full px-3 py-2 rounded-md text-sm text-slate-800 bg-gradient-to-r from-slate-50 to-blue-50 border-0 border-b border-slate-300 placeholder-slate-500 hover:bg-white hover:shadow-md focus:outline-none focus:border-blue-700 focus:bg-white transition-all duration-500">
                        <div class="absolute bottom-0 left-0 w-0 h-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-700 transition-all duration-500 group-focus-within:w-full"></div>
                    </div>
                    </div>

                    <!-- Password -->
                    <div class="group">
                    <label class="block mb-1 text-sm font-bold text-slate-700 group-focus-within:text-blue-800 transition-colors">
                        Password:
                    </label>
                    <div class="relative">
                        <input type="password" name="password" required autocomplete="current-password" placeholder="Isikan password disini" class="w-full px-3 py-2 rounded-md text-sm text-slate-800 bg-gradient-to-r from-slate-50 to-blue-50 border-0 border-b border-slate-300 placeholder-slate-500 hover:bg-white hover:shadow-md focus:outline-none focus:border-blue-700 focus:bg-white transition-all duration-500">
                        <div class="absolute bottom-0 left-0 w-0 h-1 rounded-full bg-gradient-to-r from-blue-600 to-indigo-700 transition-all duration-500 group-focus-within:w-full"></div>
                    </div>
                    </div>

                    <!-- Disclaimer -->
                    <p class="mt-2 text-center text-xs text-slate-600 font-medium">
                    Satu Langkah Lagi Menuju Komunitas Musik Impianmu
                    </p>

                    <!-- Button -->
                    <button type="submit" class="relative w-full py-2 rounded-xl font-bold text-sm sm:text-base text-white bg-gradient-to-r from-slate-700 via-blue-800 to-indigo-900 shadow-xl shadow-blue-900/50 border border-slate-600/30 transition-all duration-500 transform hover:scale-[1.02] active:scale-[0.98] hover:from-slate-800 hover:via-blue-900 hover:to-indigo-950">
                    <span class="relative z-10">Masuk</span>
                    </button>

                    <!-- Forgot password -->
                    <div class="mt-2 text-center">
                    <a href="{{ route('password.request') }}" class="inline-block text-xs sm:text-sm font-semibold text-slate-600 hover:text-blue-800 hover:underline transition-all duration-300 hover:scale-105">
                        Lupa password
                    </a>
                    </div>
                </form>
                </div>
            </div>

            <!-- Bottom register link -->
            <div class="text-center lg:col-span-2 order-3 lg:order-3">
                <p class="text-xs sm:text-sm text-slate-300 font-medium">
                Belum punya akun?
                <a href="{{ route('register') }}" class="text-blue-300 font-bold hover:text-white hover:underline hover:scale-105 transition-all duration-300 inline-block ml-1">
                    Register
                </a>
                </p>
            </div>
            </div>
        </div>

    </div>
    
</x-auth.layouts>