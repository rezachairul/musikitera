<section class="py-20 bg-slate-50 relative overflow-hidden">
    {{-- Background Motif Halus --}}
    <div class="absolute inset-0 opacity-[0.03] pointer-events-none"
        style="background-image: url('https://www.transparenttextures.com/patterns/denim.png');"></div>

    <div class="max-w-7xl mx-auto px-6 relative z-10">
        {{-- Header --}}
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center gap-3 mb-2">
                <span class="h-[1px] w-8 bg-[#E63946]"></span>
                <span class="text-[#457B9D] text-[10px] font-black uppercase tracking-[0.5em]">Voice of Members</span>
                <span class="h-[1px] w-8 bg-[#E63946]"></span>
            </div>
            <h2 class="text-3xl font-black text-[#0A192F] uppercase tracking-tighter">
                Apa Kata <span class="text-[#457B9D]">Mereka?</span>
            </h2>
        </div>

        <div class="testimonial-safe-wrapper relative w-full overflow-hidden py-4">

            <div
                class="absolute inset-y-0 left-0 w-20 md:w-40 z-20 pointer-events-none bg-gradient-to-r from-slate-50 to-transparent">
            </div>
            <div
                class="absolute inset-y-0 right-0 w-20 md:w-40 z-20 pointer-events-none bg-gradient-to-l from-slate-50 to-transparent">
            </div>

            <div class="flex gap-6 animate-marquee-fixed hover:pause-marquee w-max">
                @php
                    $testis = [
                        ['u' => 'user_123', 'i' => '1', 't' => 'Seru banget ikut UKM Musik, bisa ketemu teman baru!'],
                        ['u' => 'musiklover', 'i' => '2', 't' => 'Latihan rutin bikin skill main gitar makin mantap.'],
                        [
                            'u' => 'melody_girl',
                            'i' => '3',
                            't' => 'Acara panggungnya keren, pengalaman tak terlupakan!',
                        ],
                        ['u' => 'drummerboy', 'i' => '4', 't' => 'Main bareng band bikin tambah percaya diri.'],
                        ['u' => 'vocalqueen', 'i' => '5', 't' => 'Workshop vokal bener-bener nambah skill nyanyi!'],
                    ];
                    // Gabungkan 3x agar animasi seamless tanpa jeda kosong
                    $all_testis = array_merge($testis, $testis, $testis);
                @endphp

                @foreach ($all_testis as $item)
                    <div
                        class="w-72 flex-shrink-0 bg-white border border-slate-200 p-5 rounded-2xl shadow-sm hover:border-[#E63946]/30 transition-colors">
                        <div class="flex items-center gap-3 mb-3">
                            <img src="https://i.pravatar.cc/100?img={{ $item['i'] }}"
                                class="w-10 h-10 rounded-full border border-slate-100" />
                            <div>
                                <h4 class="font-bold text-[#0A192F] text-xs uppercase">{{ $item['u'] }}</h4>
                                <div class="flex text-[#E63946]">
                                    @for ($s = 0; $s < 5; $s++)
                                        <svg class="w-2 h-2 fill-current" viewBox="0 0 24 24">
                                            <path
                                                d="M12 .587l3.668 7.568 8.332 1.151-6.064 5.828 1.48 8.279-7.416-3.967-7.417 3.967 1.481-8.279-6.064-5.828 8.332-1.151z" />
                                        </svg>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        <p class="text-slate-600 text-xs leading-relaxed italic">
                            "{{ $item['t'] }}"
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <style>
        /* Definisi Animasi yang Terisolasi */
        @keyframes marquee-scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-288px * 5 - 1.5rem * 5));
            }

            /* 288px adalah lebar w-72 */
        }

        .animate-marquee-fixed {
            animation: marquee-scroll 25s linear infinite;
        }

        .hover-pause-marquee:hover {
            animation-play-state: paused;
        }

        /* Pastikan tidak ada scrollbar liar */
        .testimonial-safe-wrapper {
            mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
            -webkit-mask-image: linear-gradient(to right, transparent, black 15%, black 85%, transparent);
        }
    </style>
</section>
