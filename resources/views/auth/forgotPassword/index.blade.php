{{-- resources/views/auth/forgot-password.blade.php --}}
<x-auth.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>{{ $title ?? 'Forgot Password' }}</x-slot:title>

    <section
        class="min-h-screen w-full bg-[#0A192F] flex items-center justify-center p-4 md:p-6 relative overflow-hidden font-sans">

        {{-- BACKGROUND ELEMENT: Floating Musical Notes --}}
        <div class="absolute inset-0 pointer-events-none overflow-hidden">
            <div class="absolute top-[15%] left-[10%] text-4xl text-slate-700/30 animate-pulse rotate-12">♪</div>
            <div class="absolute top-[25%] right-[15%] text-5xl text-blue-900/40 animate-bounce delay-700 -rotate-12">♫
            </div>
            <div class="absolute bottom-[30%] left-[5%] text-7xl text-slate-800/20 rotate-45">🎼</div>
            <div class="absolute top-1/2 right-[10%] text-3xl text-indigo-900/30 animate-pulse delay-300">♬</div>
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
                <div class="mb-8 transform hover:scale-105 transition-transform duration-500">
                    <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKM BSM"
                        class="w-24 h-24 object-contain">
                </div>

                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-12 bg-[#457B9D]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Account Recovery
                    </span>
                </div>

                <h1 class="text-6xl font-black text-white uppercase tracking-tighter leading-tight mb-6">
                    RESET <br><span class="text-[#457B9D]">PASSWORD.</span>
                </h1>

                <p class="text-slate-400 text-lg font-medium max-w-md leading-relaxed">
                    Jangan khawatir, masukkan email Anda dan kami akan mengirimkan tautan untuk memulihkan akun Anda.
                </p>
            </div>

            {{-- SISI KANAN: Form Card (Compact Style) --}}
            <div class="w-full max-w-md mx-auto">
                <div
                    class="bg-white/5 backdrop-blur-xl rounded-[2rem] p-7 md:p-10 shadow-2xl border border-white/10 relative">

                    {{-- Header Form dengan Logo Kecil (Mobile) --}}
                    <div class="mb-8 text-center lg:text-left">
                        <div class="lg:hidden flex justify-center mb-6">
                            <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo"
                                class="w-16 h-16 object-contain">
                        </div>

                        <span
                            class="text-[#457B9D] text-[10px] font-black uppercase tracking-[0.3em] block mb-2">Security</span>
                        <h2 class="text-2xl md:text-3xl font-black text-white uppercase tracking-tight">Lupa Password
                        </h2>
                        <div class="w-12 h-1 bg-[#E63946] mt-3 mx-auto lg:mx-0"></div>
                    </div>

                    {{-- Session Status (Success Alert) --}}
                    @if (session('status'))
                        <div
                            class="mb-6 p-4 rounded-2xl bg-emerald-500/10 border-l-4 border-emerald-500 text-emerald-200 text-xs font-black italic">
                            ✅ {{ session('status') }}
                        </div>
                    @endif

                    {{-- Error Alert --}}
                    @error('email')
                        <div
                            class="mb-6 p-4 rounded-2xl bg-red-500/10 border-l-4 border-[#E63946] text-red-200 text-xs font-black italic">
                            ⚠️ {{ $message }}
                        </div>
                    @enderror

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label
                                class="block mb-2 text-[10px] font-black text-slate-300 uppercase tracking-widest text-center lg:text-left">
                                Email Address
                            </label>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required
                                autofocus placeholder="name@itera.ac.id"
                                class="w-full px-6 py-4 rounded-2xl text-sm bg-[#0A192F] border border-slate-700 focus:border-[#457B9D] focus:outline-none transition-all duration-300 font-bold text-white placeholder:text-slate-600">
                        </div>

                        <button type="submit"
                            class="w-full py-4 bg-[#457B9D] hover:bg-white hover:text-[#0A192F] text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] transition-all duration-300 transform active:scale-95 shadow-lg shadow-blue-900/30">
                            Kirim Link Reset
                        </button>
                    </form>

                    <div class="mt-8 pt-6 border-t border-white/10 text-center">
                        <a href="{{ route('login') }}"
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-[#457B9D] transition-colors">
                            ← Kembali ke Login
                        </a>
                    </div>
                </div>

                <p class="text-center mt-8 text-slate-500 text-[10px] font-black uppercase tracking-[0.3em]">
                    &copy; {{ date('Y') }} UKMBSM ITERA
                </p>
            </div>
        </div>
    </section>
</x-auth.layouts>
