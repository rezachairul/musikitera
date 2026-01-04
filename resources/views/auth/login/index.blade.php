{{-- resources/views/auth/login.blade.php --}}
<x-auth.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- Custom Animation for Ocean Effect --}}
    <style>
        @keyframes oceanFloat {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-20px) rotate(-4deg);
            }

            66% {
                transform: translateY(10px) rotate(4deg);
            }
        }

        .animate-ocean {
            animation: oceanFloat 8s ease-in-out infinite;
        }

        .delay-1 {
            animation-delay: 1s;
        }

        .delay-2 {
            animation-delay: 2s;
        }

        .delay-3 {
            animation-delay: 3s;
        }

        .duration-slow {
            animation-duration: 12s;
        }
    </style>

    <section
        class="min-h-screen w-full bg-[#0A192F] flex items-center justify-center p-4 md:p-6 relative overflow-hidden font-sans">

        {{-- BACKGROUND ELEMENT: Floating Musical Notes (Ocean Style) --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            {{-- Notasi disebar dengan ukuran dan transparansi berbeda --}}
            <div class="absolute top-[10%] left-[10%] text-6xl text-slate-700/20 animate-ocean duration-slow">♪</div>
            <div class="absolute top-[25%] right-[15%] text-5xl text-blue-900/30 animate-ocean delay-1">♫</div>
            <div class="absolute bottom-[15%] left-[20%] text-8xl text-slate-800/20 animate-ocean delay-2 duration-slow">
                🎼</div>
            <div class="absolute top-[50%] right-[5%] text-4xl text-indigo-900/20 animate-ocean delay-3">♬</div>
            <div
                class="absolute bottom-[10%] right-[25%] text-6xl text-slate-700/20 animate-ocean delay-1 duration-slow">
                ♩</div>
            <div class="absolute top-[40%] left-[5%] text-3xl text-slate-700/10 animate-ocean delay-2">♭</div>
            <div class="absolute bottom-[40%] right-[30%] text-4xl text-blue-900/20 animate-ocean delay-3 duration-slow">
                ♮</div>
        </div>

        {{-- Background Glow Accents --}}
        <div
            class="absolute top-[-20%] left-[-20%] w-[50%] h-[50%] bg-[#457B9D]/20 rounded-full blur-[150px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-20%] right-[-20%] w-[50%] h-[50%] bg-[#E63946]/10 rounded-full blur-[150px] pointer-events-none">
        </div>

        <div class="max-w-5xl w-full grid lg:grid-cols-2 gap-10 lg:gap-16 items-center relative z-10">

            {{-- SISI KIRI: Branding --}}
            <div class="hidden lg:block">
                {{-- Logo Utama Desktop --}}
                <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKM BSM"
                        class="w-24 h-24 object-contain">
                </div>

                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-12 bg-[#457B9D]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Music Community Portal
                    </span>
                </div>

                <h1 class="text-6xl font-black text-white uppercase tracking-tighter leading-tight mb-6">
                    UKM BSM <br><span class="text-[#457B9D]">ITERA</span>
                </h1>

                <p class="text-slate-400 text-lg font-medium max-w-md leading-relaxed">
                    Selamat datang di Portal Komunitas Musik ITERA. Masuk untuk mulai berkolaborasi dan berkarya.
                </p>
            </div>

            {{-- SISI KANAN: Form Card --}}
            <div class="w-full max-w-md mx-auto">
                <div
                    class="bg-white/5 backdrop-blur-xl rounded-[2rem] p-7 md:p-10 shadow-2xl border border-white/10 relative">

                    {{-- Header Form --}}
                    <div class="mb-8 text-center lg:text-left">
                        <div class="lg:hidden flex justify-center mb-6">
                            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo"
                                class="w-16 h-16 object-contain border-b border-white/10 pb-2">
                        </div>

                        <span
                            class="text-[#457B9D] text-[10px] font-black uppercase tracking-[0.3em] block mb-2">Authentication</span>
                        <h2 class="text-3xl font-black text-white uppercase tracking-tight">Login Member</h2>
                        <div class="w-12 h-1 bg-[#E63946] mt-3 mx-auto lg:mx-0"></div>
                    </div>

                    {{-- Alerts --}}
                    @if ($errors->any())
                        <div
                            class="mb-6 p-4 rounded-2xl bg-red-500/10 border-l-4 border-[#E63946] text-red-200 text-xs">
                            <span class="font-black italic">⚠️ {{ $errors->first() }}</span>
                        </div>
                    @endif

                    @if (session('success'))
                        <div
                            class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-200 text-xs">
                            <span class="font-black italic">✅ {{ session('success') }}</span>
                        </div>
                    @endif

                    {{-- Form --}}
                    <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-5">
                        @csrf
                        <div>
                            <label
                                class="block mb-2 text-[10px] font-black text-slate-300 uppercase tracking-widest">Email
                                Address</label>
                            <input type="email" name="email" required placeholder="name@itera.ac.id"
                                class="w-full px-6 py-3.5 rounded-2xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                        </div>

                        <div>
                            <div class="flex justify-between mb-2">
                                <label
                                    class="text-[10px] font-black text-slate-300 uppercase tracking-widest">Password</label>
                                <a href="{{ route('password.request') }}"
                                    class="text-[9px] font-black text-[#457B9D] uppercase hover:text-[#E63946] transition-colors">Lupa?</a>
                            </div>
                            <input type="password" name="password" required placeholder="••••••••"
                                class="w-full px-6 py-3.5 rounded-2xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                        </div>

                        <button type="submit"
                            class="w-full py-4 mt-2 bg-[#457B9D] hover:bg-white hover:text-[#0A192F] text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 transform active:scale-95 shadow-lg shadow-blue-900/30">
                            Masuk Sekarang
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-white/10 text-center">
                        <p class="text-[11px] text-slate-400 font-bold uppercase tracking-tight">
                            Belum terdaftar?
                            <a href="{{ route('register') }}"
                                class="text-[#E63946] hover:text-white transition-colors ml-1">
                                Buat Akun Baru
                            </a>
                        </p>
                    </div>
                </div>

                <p class="text-center mt-8 text-slate-500 text-[9px] font-black uppercase tracking-[0.3em]">
                    &copy; 2026 UKM BSM ITERA
                </p>
            </div>
        </div>
    </section>
</x-auth.layouts>
