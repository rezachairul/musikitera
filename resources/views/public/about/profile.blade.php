<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>About - UKM Seni Musik ITERA</x-slot:title>

    <div class="bg-white min-h-screen font-sans">

        <section class="relative py-24 overflow-hidden">
            <div class="absolute inset-0 flex flex-col justify-center gap-4 opacity-[0.03] pointer-events-none">
                @for ($i = 0; $i < 5; $i++)
                    <div class="h-[2px] w-full bg-[#0A192F]"></div>
                @endfor
            </div>

            <div class="max-w-7xl mx-auto px-6 relative z-10">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-flex items-center gap-3 mb-6">
                            <span class="h-[2px] w-8 bg-[#E63946]"></span>
                            <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Profile</span>
                        </div>
                        <h1 class="text-5xl md:text-7xl font-black text-[#0A192F] leading-[0.9] uppercase mb-8">
                            Sound of <br><span class="text-[#457B9D]">Innovation.</span>
                        </h1>
                    </div>
                    <div class="relative">
                        <div class="absolute -left-6 top-0 bottom-0 w-[4px] bg-[#E63946]"></div>
                        <p class="text-xl text-slate-600 leading-relaxed font-medium">
                            <span class="text-[#0A192F] font-bold">UKM Seni Musik ITERA</span> adalah wadah kreativitas
                            mahasiswa Institut Teknologi Sumatera dalam mengeksplorasi harmoni, teknik, dan ekspresi
                            melalui nada. Kami percaya bahwa musik adalah bahasa universal yang menyatukan sains dan
                            seni.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section class="py-20 bg-slate-50">
            <div class="max-w-7xl mx-auto px-6">
                <div class="grid md:grid-cols-2 gap-12">
                    <div class="bg-white p-10 rounded-2xl shadow-sm border-b-4 border-[#0A192F]">
                        <div class="w-12 h-12 bg-[#0A192F] text-white flex items-center justify-center rounded-lg mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#0A192F] uppercase mb-4 tracking-tight">Visi</h3>
                        <p class="text-slate-600 font-medium leading-relaxed">
                            Menjadi pusat pengembangan bakat musik mahasiswa yang unggul, berintegritas, dan mampu
                            berkontribusi dalam melestarikan serta memajukan budaya musik di lingkungan kampus dan
                            nasional.
                        </p>
                    </div>

                    <div class="bg-white p-10 rounded-2xl shadow-sm border-b-4 border-[#E63946]">
                        <div class="w-12 h-12 bg-[#E63946] text-white flex items-center justify-center rounded-lg mb-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-black text-[#0A192F] uppercase mb-4 tracking-tight">Misi</h3>
                        <ul class="space-y-3 text-slate-600 font-medium">
                            <li class="flex items-start gap-3">
                                <span class="text-[#E63946] font-bold">01.</span> Menyelenggarakan pelatihan musik rutin
                                bagi anggota.
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#E63946] font-bold">02.</span> Menciptakan ruang kolaborasi kreatif
                                antar musisi ITERA.
                            </li>
                            <li class="flex items-start gap-3">
                                <span class="text-[#E63946] font-bold">03.</span> Aktif berpartisipasi dalam kegiatan
                                internal dan eksternal kampus.
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <div class="py-12 border-t border-slate-100 text-center">
            <div class="flex justify-center gap-2 mb-4">
                @for ($i = 0; $i < 3; $i++)
                    <div class="w-1 h-1 bg-[#E63946] rounded-full"></div>
                @endfor
            </div>
            <p class="text-slate-300 text-[10px] font-black tracking-[0.8em] uppercase">Building Harmonies Since 201X
            </p>
        </div>
    </div>

    <style>
        @keyframes eq {

            0%,
            100% {
                height: 40%;
            }

            50% {
                height: 100%;
            }
        }

        .animate-eq-slow {
            animation: eq 1.2s ease-in-out infinite;
        }

        .animate-eq-fast {
            animation: eq 0.8s ease-in-out infinite;
        }

        /* Custom Scrollbar for better aesthetic */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: #0A192F;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #E63946;
        }
    </style>
</x-public.layouts>
