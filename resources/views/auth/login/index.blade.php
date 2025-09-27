<x-auth.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    <!-- Full page container dengan background navy denim gradient -->
    <div
        class="max-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center p-4 relative overflow-hidden">

        <!-- Denim texture overlay -->
        <div class="absolute inset-0 opacity-10 bg-gradient-to-br from-blue-800/20 via-slate-800/30 to-indigo-800/20">
        </div>

        <!-- Musical background overlay dengan navy theme -->
        <div class="absolute inset-0 opacity-20">
            <div class="absolute top-10 left-10 text-6xl lg:text-8xl text-blue-300 rotate-12 animate-pulse">♪</div>
            <div class="absolute top-20 right-16 text-4xl lg:text-6xl text-indigo-300 -rotate-45 animate-bounce">♫</div>
            <div class="absolute top-1/3 left-1/4 text-5xl lg:text-7xl text-slate-300 rotate-45">♩</div>
            <div class="absolute bottom-32 right-20 text-3xl lg:text-5xl text-blue-400 -rotate-12 animate-pulse">♬</div>
            <div class="absolute top-1/2 left-8 text-4xl lg:text-6xl text-indigo-400 rotate-90">🎵</div>
            <div class="absolute bottom-20 left-1/3 text-5xl lg:text-7xl text-slate-400 -rotate-30">🎼</div>
            <div class="absolute top-2/3 right-1/4 text-4xl lg:text-6xl text-blue-300 rotate-15 animate-bounce">♪</div>
        </div>

        <!-- Main login container - Desktop: 2 columns, Mobile: 2 rows -->
        <div class="w-full max-w-sm sm:max-w-md lg:max-w-6xl xl:max-w-7xl mx-auto relative z-10">
            <!-- Desktop Layout: Side by side -->
            <div class="flex flex-col lg:grid lg:grid-cols-2 lg:gap-12 xl:gap-16 lg:items-center lg:min-h-[600px]">

                <!-- Left side: Logo and header section (Desktop) / Top section (Mobile) -->
                <div class="text-center lg:text-left mb-8 lg:mb-0 order-1 lg:order-1 lg:pr-8">
                    <!-- Logo dengan navy denim style -->
                    <div
                        class="mx-auto lg:mx-0 w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 xl:w-32 xl:h-32 
                               bg-gradient-to-br from-slate-700 via-blue-800 to-indigo-900 
                               rounded-3xl flex items-center justify-center mb-6 lg:mb-6 
                               shadow-2xl shadow-blue-900/50 border border-slate-600/30
                               hover:scale-105 transition-all duration-500 ease-out">
                        <div class="text-white font-bold text-2xl sm:text-3xl lg:text-4xl xl:text-5xl drop-shadow-lg">🎵
                        </div>
                    </div>

                    <!-- App name and description dengan navy styling -->
                    <div class="lg:space-y-4">
                        <h1
                            class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-bold 
                                   bg-gradient-to-r from-blue-200 via-slate-100 to-indigo-200 
                                   bg-clip-text text-transparent mb-2 lg:mb-3 
                                   drop-shadow-lg tracking-tight leading-tight">
                            UKM BSM ITERA
                        </h1>
                        <p
                            class="text-base sm:text-lg lg:text-xl xl:text-2xl 
                                  text-slate-300 font-semibold tracking-wide">
                            Music Community Portal
                        </p>

                        <!-- Desktop only: Additional description -->
                        <div class="hidden lg:block mt-6 space-y-4">
                            <p class="text-slate-300 text-lg xl:text-xl leading-relaxed font-light">
                                Bergabunglah dengan komunitas musik terbesar di ITERA
                            </p>
                            <div class="flex items-center space-x-4 justify-center lg:justify-start">
                                <span
                                    class="text-2xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎸</span>
                                <span
                                    class="text-2xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎤</span>
                                <span
                                    class="text-2xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎵</span>
                                <span
                                    class="text-2xl hover:scale-110 transition-transform duration-300 cursor-pointer">🎼</span>
                            </div>
                            <!-- Decorative line -->
                            <div
                                class="w-20 h-1 bg-gradient-to-r from-blue-400 to-indigo-400 rounded-full mx-auto lg:mx-0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right side: Login form card (Desktop) / Bottom section (Mobile) -->
                <div class="order-2 lg:order-2 lg:justify-self-center lg:w-full lg:max-w-md xl:max-w-lg">
                    <div
                        class="bg-gradient-to-br from-slate-100 via-white to-blue-50 
                                rounded-[1.5rem] shadow-2xl shadow-slate-900/50 
                                p-6 sm:p-8 lg:p-8 xl:p-10 relative overflow-hidden
                                border border-slate-200/50 backdrop-blur-sm
                                hover:shadow-3xl transition-all duration-500">

                        <!-- Denim texture pada form -->
                        <div
                            class="absolute inset-0 bg-gradient-to-br from-slate-50/80 via-transparent to-blue-50/60 rounded-[1.5rem]">
                        </div>

                        <!-- Navy decorative elements -->
                        <div
                            class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-slate-700 via-blue-800 to-indigo-900 rounded-t-[1.5rem]">
                        </div>
                        <div
                            class="absolute -top-1 -left-1 w-6 h-6 bg-gradient-to-br from-blue-400 to-indigo-600 rounded-full opacity-60">
                        </div>
                        <div
                            class="absolute -top-1 -right-1 w-4 h-4 bg-gradient-to-br from-slate-400 to-blue-600 rounded-full opacity-40">
                        </div>

                        <!-- Form header -->
                        <div class="text-center mb-6 relative z-10">
                            <h2
                                class="text-lg sm:text-xl lg:text-2xl font-bold 
                                       bg-gradient-to-r from-slate-700 via-blue-800 to-indigo-900 
                                       bg-clip-text text-transparent mb-2">
                                MASUK AKUN
                            </h2>
                        </div>

                        <!-- Error messages dengan navy theme -->
                        @if ($errors->any())
                            <div
                                class="bg-gradient-to-r from-red-50 to-red-100 text-red-800 p-3 mb-6 
                                        rounded-xl border-l-4 border-red-500 shadow-lg relative z-10">
                                <div class="flex items-center text-sm">
                                    <span class="mr-2 text-base">⚠️</span>
                                    {{ $errors->first() }}
                                </div>
                            </div>
                        @endif

                        <!-- Success messages dengan navy theme -->
                        @if (session('success'))
                            <div
                                class="bg-gradient-to-r from-green-50 to-emerald-100 text-green-800 p-3 mb-6 
                                        rounded-xl border-l-4 border-green-500 shadow-lg relative z-10">
                                <div class="flex items-center text-sm">
                                    <span class="mr-2 text-base">✅</span>
                                    {{ session('success') }}
                                </div>
                            </div>
                        @endif

                        <!-- Login form -->
                        <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5 relative z-10">
                            @csrf

                            <!-- Email field dengan navy styling -->
                            <div class="group">
                                <label
                                    class="block text-sm sm:text-base lg:text-lg font-bold 
                                             text-slate-700 mb-2 group-focus-within:text-blue-800 
                                             transition-colors duration-300">
                                    Email:
                                </label>
                                <div class="relative">
                                    <input type="email" name="email"
                                        class="w-full px-3 py-3 sm:py-4 
                                               text-sm sm:text-base lg:text-lg text-slate-800 
                                               bg-gradient-to-r from-slate-50 to-blue-50 
                                               border-0 border-b-3 border-slate-300 
                                               focus:outline-none focus:border-blue-700 focus:bg-white
                                               transition-all duration-500 ease-out
                                               placeholder-slate-500 rounded-t-lg
                                               hover:bg-white hover:shadow-md"
                                        placeholder="Isikan email disini" required autocomplete="email">
                                    <div
                                        class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-700 
                                                transition-all duration-500 group-focus-within:w-full rounded-full">
                                    </div>
                                </div>
                            </div>

                            <!-- Password field dengan navy styling -->
                            <div class="group">
                                <label
                                    class="block text-sm sm:text-base lg:text-lg font-bold 
                                             text-slate-700 mb-2 group-focus-within:text-blue-800 
                                             transition-colors duration-300">
                                    Password:
                                </label>
                                <div class="relative">
                                    <input type="password" name="password"
                                        class="w-full px-3 py-3 sm:py-4 
                                               text-sm sm:text-base lg:text-lg text-slate-800 
                                               bg-gradient-to-r from-slate-50 to-blue-50 
                                               border-0 border-b-3 border-slate-300 
                                               focus:outline-none focus:border-blue-700 focus:bg-white
                                               transition-all duration-500 ease-out
                                               placeholder-slate-500 rounded-t-lg
                                               hover:bg-white hover:shadow-md"
                                        placeholder="Isikan password disini" required autocomplete="current-password">
                                    <div
                                        class="absolute bottom-0 left-0 w-0 h-1 bg-gradient-to-r from-blue-600 to-indigo-700 
                                                transition-all duration-500 group-focus-within:w-full rounded-full">
                                    </div>
                                </div>
                            </div>

                            <!-- Disclaimer text dengan navy theme -->
                            <p
                                class="text-xs sm:text-sm lg:text-base text-slate-600 text-center 
                                      leading-relaxed mt-4 font-medium">
                                Satu Langkah Lagi Menuju Komunitas Musik Impianmu
                            </p>

                            <!-- Submit button dengan navy denim style -->
                            <button type="submit"
                                class="w-full bg-gradient-to-r from-slate-700 via-blue-800 to-indigo-900 
                                       text-white py-3 sm:py-4 rounded-2xl 
                                       font-bold text-base sm:text-lg lg:text-xl 
                                       shadow-2xl shadow-blue-900/50
                                       hover:shadow-3xl hover:from-slate-800 hover:via-blue-900 hover:to-indigo-950
                                       transition-all duration-500 ease-out 
                                       transform hover:scale-[1.02] active:scale-[0.98]
                                       border border-slate-600/30
                                       relative overflow-hidden group">
                                <span class="relative z-10">Masuk</span>
                                <div
                                    class="absolute inset-0 bg-gradient-to-r from-blue-600/20 to-indigo-600/20 
                                            transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left">
                                </div>
                            </button>

                            <!-- Forgot password link dengan navy theme -->
                            <div class="text-center mt-4">
                                <a href="{{ route('password.request') }}"
                                    class="text-slate-600 hover:text-blue-800 text-sm sm:text-base lg:text-lg 
                                           font-semibold hover:underline transition-all duration-300
                                           hover:scale-105 inline-block">
                                    Lupa password
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Bottom register link -->
                <div class="text-center mt-6 lg:col-span-2 order-3 lg:order-3">
                    <p class="text-sm sm:text-base text-slate-300 font-medium">
                        Belum punya akun?
                        <a href="{{ route('register') }}"
                            class="text-blue-300 font-bold hover:text-white hover:underline 
                                   hover:scale-105 transition-all duration-300 inline-block ml-1">
                            Register
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <!-- Enhanced custom styles untuk desktop responsiveness dan navy denim theme -->
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap');

            * {
                font-family: 'Inter', sans-serif;
            }

            @media (min-width: 768px) {
                .min-h-screen {
                    min-height: 100vh;
                }
            }

            @media (min-width: 1024px) {
                .min-h-screen>div {
                    max-width: 1200px;
                }

                /* Desktop grid proportional sizing */
                .lg\:grid-cols-2 {
                    grid-template-columns: 1fr 1fr;
                }
            }

            @media (min-width: 1280px) {
                .min-h-screen>div {
                    max-width: 1400px;
                }
            }

            /* Enhanced focus styles untuk better UX */
            input:focus {
                box-shadow: 0 4px 20px rgba(59, 130, 246, 0.15);
                transform: translateY(-1px);
            }

            /* Smooth transitions untuk semua elemen */
            * {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Custom border-b-3 class */
            .border-b-3 {
                border-bottom-width: 3px;
            }

            /* Enhanced hover effects */
            .group:hover .group-hover\:scale-105 {
                transform: scale(1.05);
            }

            /* Custom shadow classes */
            .shadow-3xl {
                box-shadow: 0 35px 60px -12px rgba(0, 0, 0, 0.25),
                    0 0 0 1px rgba(255, 255, 255, 0.1);
            }

            /* Custom scrollbar untuk desktop dengan navy theme */
            @media (min-width: 768px) {
                ::-webkit-scrollbar {
                    width: 10px;
                }

                ::-webkit-scrollbar-track {
                    background: linear-gradient(to bottom, #1e293b, #334155);
                }

                ::-webkit-scrollbar-thumb {
                    background: linear-gradient(to bottom, #3b82f6, #4338ca);
                    border-radius: 5px;
                    border: 2px solid #1e293b;
                }

                ::-webkit-scrollbar-thumb:hover {
                    background: linear-gradient(to bottom, #2563eb, #3730a3);
                }
            }

            /* Animasi background */
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0px) rotate(0deg);
                }

                33% {
                    transform: translateY(-10px) rotate(5deg);
                }

                66% {
                    transform: translateY(10px) rotate(-5deg);
                }
            }

            .animate-bounce {
                animation: bounce 3s infinite;
            }

            .animate-pulse {
                animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }

            /* Glass effect untuk card */
            .backdrop-blur-sm {
                backdrop-filter: blur(4px);
            }

            /* Responsive text sizing yang lebih smooth */
            @media (max-width: 640px) {
                .text-responsive {
                    font-size: clamp(0.875rem, 2.5vw, 1rem);
                }
            }

            @media (min-width: 641px) and (max-width: 1024px) {
                .text-responsive {
                    font-size: clamp(1rem, 2.8vw, 1.125rem);
                }
            }

            @media (min-width: 1025px) {
                .text-responsive {
                    font-size: clamp(1.125rem, 1.5vw, 1.25rem);
                }
            }

            /* Enhanced mobile experience */
            @media (max-width: 768px) {
                .mobile-padding {
                    padding: 1.5rem;
                }
            }
        </style>
</x-auth.layouts>
