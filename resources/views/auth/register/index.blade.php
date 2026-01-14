{{-- resources/views/auth/register.blade.php --}}
<x-auth.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>{{ $title }}</x-slot:title>

    <section
        class="min-h-screen w-full bg-[#0A192F] flex items-center justify-center p-4 md:p-6 relative overflow-hidden font-sans">

        {{-- BACKGROUND ELEMENT: Floating Musical Notes --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-[10%] left-[15%] text-4xl text-slate-700/30 animate-pulse rotate-12">♪</div>
            <div class="absolute top-[20%] right-[10%] text-5xl text-blue-900/40 animate-bounce delay-700 -rotate-12">♫
            </div>
            <div class="absolute bottom-[20%] left-[10%] text-7xl text-slate-800/20 rotate-45">🎼</div>
            <div class="absolute top-1/2 right-[5%] text-3xl text-indigo-900/30 animate-pulse delay-300">♬</div>
            <div class="absolute bottom-10 right-1/3 text-5xl text-slate-700/20 -rotate-30">♩</div>
        </div>

        {{-- Background Glow Accents --}}
        <div
            class="absolute top-[-20%] left-[-20%] w-[50%] h-[50%] bg-[#457B9D]/20 rounded-full blur-[150px] pointer-events-none">
        </div>
        <div
            class="absolute bottom-[-20%] right-[-20%] w-[50%] h-[50%] bg-[#E63946]/10 rounded-full blur-[150px] pointer-events-none">
        </div>

        <div class="max-w-5xl w-full grid lg:grid-cols-2 gap-10 lg:gap-16 items-center relative z-10">

            {{-- SISI KIRI: Branding (Desktop Only) --}}
            <div class="hidden lg:block">
                {{-- Logo Utama Desktop --}}
                <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKM BSM"
                        class="w-24 h-24 object-contain">
                </div>

                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-12 bg-[#457B9D]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Join the Community
                    </span>
                </div>

                <h1 class="text-5xl font-black text-white uppercase tracking-tighter leading-tight mb-4">
                    CREATE YOUR <br> <span class="text-[#457B9D]">ACCOUNT.</span>
                </h1>

                <p class="text-slate-400 text-base font-medium max-w-sm leading-relaxed">
                    Mulai perjalanan musikmu bersama UKM BSM ITERA. Daftarkan dirimu dan jadilah bagian dari karya kami.
                </p>
            </div>

            {{-- SISI KANAN: Form Card --}}
            <div class="w-full max-w-md mx-auto">
                <div
                    class="bg-white/5 backdrop-blur-xl rounded-[2rem] p-6 md:p-10 shadow-2xl border border-white/10 relative">

                    {{-- Header Form dengan Logo Kecil (Mobile Friendly) --}}
                    <div class="mb-6 text-center lg:text-left flex flex-col lg:flex-row items-center gap-4">
                        {{-- Logo Kecil untuk Mobile --}}
                        <div class="lg:hidden mb-2">
                            <img src="{{ asset('path/to/logo-bsm.png') }}" alt="Logo"
                                class="w-14 h-14 object-contain">
                        </div>

                        <div>
                            <span class="text-[#457B9D] text-[9px] font-black uppercase tracking-[0.3em] block mb-1">New
                                Member</span>
                            <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-tight">Register
                            </h2>
                            <div class="w-10 h-1 bg-[#E63946] mt-2 mx-auto lg:mx-0"></div>
                        </div>
                    </div>

                    {{-- Error Handling --}}
                    @if ($errors->any())
                        <div
                            class="mb-4 p-3 rounded-xl bg-red-500/10 border-l-4 border-[#E63946] text-red-200 text-[11px]">
                            <span class="font-black italic">⚠️ {{ $errors->first() }}</span>
                        </div>
                    @endif

                    <form action="{{ route('register.store') }}" method="POST" class="space-y-3">
                        @csrf

                        {{-- Name Field --}}
                        <div>
                            <label
                                class="block mb-1 text-[9px] font-black text-slate-300 uppercase tracking-widest">Full
                                Name</label>
                            <input type="text" name="name" required placeholder="Nama Lengkap"
                                class="w-full px-5 py-2.5 rounded-xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                        </div>

                        {{-- Email Field --}}
                        <div>
                            <label
                                class="block mb-1 text-[9px] font-black text-slate-300 uppercase tracking-widest">Email
                                Address</label>
                            <input type="email" name="email" required placeholder="name@itera.ac.id"
                                class="w-full px-5 py-2.5 rounded-xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                        </div>

                        {{-- Password Grid --}}
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label
                                    class="block mb-1 text-[9px] font-black text-slate-300 uppercase tracking-widest">Password</label>
                                <input type="password" name="password" required placeholder="••••"
                                    class="w-full px-5 py-2.5 rounded-xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                            </div>
                            <div>
                                <label
                                    class="block mb-1 text-[9px] font-black text-slate-300 uppercase tracking-widest">Confirm</label>
                                <input type="password" name="password_confirmation" required placeholder="••••"
                                    class="w-full px-5 py-2.5 rounded-xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 mt-2 bg-[#457B9D] hover:bg-white hover:text-[#0A192F] text-white rounded-xl font-black text-[11px] uppercase tracking-[0.2em] transition-all duration-300 transform active:scale-95 shadow-lg shadow-blue-900/30">
                            Register Now
                        </button>
                    </form>

                    <div class="mt-5 pt-4 border-t border-white/10 text-center">
                        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight">
                            Sudah punya akun?
                            <a href="{{ route('login') }}"
                                class="text-[#E63946] hover:text-white transition-colors ml-1">
                                Login
                            </a>
                        </p>
                    </div>
                </div>

                <p class="text-center mt-6 text-slate-500 text-[9px] font-black uppercase tracking-[0.3em]">
                    &copy; {{ date('Y') }} UKMBSM ITERA
                </p>
            </div>
        </div>
    </section>
</x-auth.layouts>
