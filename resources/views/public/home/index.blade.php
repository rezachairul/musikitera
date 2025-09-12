<x-public.layouts>
    <x-slot:title>{{ $title }}</x-slot:title>

    {{-- HERO SECTION --}}
    <section class="bg-gray-50 py-16 text-center">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">🎶 #AsikinAja 🎶</h1>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto">
            Ruang Kreativitas & Harmoni di 
            <span class="font-medium text-gray-800">UKM Bidang Seni Musik ITERA</span> 🎶  
            Tempat nada, suara, dan rasa berpadu jadi harmoni.
        </p>
    </section>

    {{-- COUNTER SECTION --}}
    <section id="counter" class="bg-white py-16">
        <div class="max-w-6xl mx-auto grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div>
                <h2 class="counter text-4xl font-bold text-green-600" data-target="120">0</h2>
                <p class="text-gray-600">Anggota Aktif</p>
            </div>
            <div>
                <h2 class="counter text-4xl font-bold text-green-600" data-target="15">0</h2>
                <p class="text-gray-600">Badan Pengurus</p>
            </div>
            <div>
                <h2 class="counter text-4xl font-bold text-green-600" data-target="30">0</h2>
                <p class="text-gray-600">Karya Musik</p>
            </div>
            <div>
                <h2 class="counter text-4xl font-bold text-green-600" data-target="5">0</h2>
                <p class="text-gray-600">Kolaborasi</p>
            </div>
        </div>
    </section>

    {{-- GALLERY SECTION --}}
    <section class="py-12">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-semibold text-center mb-8">Galeri Kegiatan</h2>

            <!-- Swiper -->
            <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/164821/pexels-photo-164821.jpeg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/210922/pexels-photo-210922.jpeg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/164745/pexels-photo-164745.jpeg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/164716/pexels-photo-164716.jpeg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery4">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/7096/people-woman-coffee-meeting.jpg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery5">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/167446/pexels-photo-167446.jpeg"
                            class="rounded-lg shadow mx-auto w-full aspect-[16/9] object-cover" alt="gallery6">
                    </div>
                </div>

                <!-- Navigation -->
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <!-- Pagination -->
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </section>

    {{-- ABOUT HIGHLIGHT SECTION --}}
    <section class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-semibold text-center mb-8">Highlight Kegiatan</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
                @for ($i = 1; $i <= 12; $i++)
                    <div class="p-6 bg-white rounded-lg shadow hover:shadow-lg transition">
                        <img src="https://picsum.photos/400/250?random={{ $i }}" 
                            class="rounded-lg mb-4 w-full h-40 object-cover" 
                            alt="highlight{{ $i }}">
                        <h3 class="font-bold text-lg mb-2">Kegiatan {{ $i }}</h3>
                        <p class="text-gray-600 text-sm">
                        Deskripsi singkat kegiatan ke-{{ $i }} yang dilakukan UKM Musik ITERA.
                        </p>
                    </div>
                @endfor

            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-12 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="text-2xl font-semibold mb-8">Apa Kata Mereka?</h2>

            <!-- Wrapper -->
            <div class="relative w-full overflow-x-hidden">
            <!-- Track yang bergerak -->
            <div class="flex gap-6 animate-marquee">
                
                <!-- Card Dummy (10 data) -->
                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=1" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">user_123</span>
                </div>
                <p class="text-sm text-gray-700">
                    Seru banget ikut UKM Musik, bisa ketemu teman baru!
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=2" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">musiklover</span>
                </div>
                <p class="text-sm text-gray-700">
                    Latihan rutin bikin skill main gitar makin mantap.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=3" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">melody_girl</span>
                </div>
                <p class="text-sm text-gray-700">
                    Acara panggungnya keren, pengalaman tak terlupakan!
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=4" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">drummerboy</span>
                </div>
                <p class="text-sm text-gray-700">
                    Main bareng band bikin tambah percaya diri di panggung.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=5" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">vocalqueen</span>
                </div>
                <p class="text-sm text-gray-700">
                    Workshop vokal bener-bener nambah skill nyanyi aku!
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=6" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">keyboardman</span>
                </div>
                <p class="text-sm text-gray-700">
                    Jadi bisa improvisasi lebih bebas setelah sering latihan.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=7" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">basshero</span>
                </div>
                <p class="text-sm text-gray-700">
                    Seru main bass bareng anak-anak, bikin groove makin solid.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=8" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">soundmaster</span>
                </div>
                <p class="text-sm text-gray-700">
                    Belajar mixing & sound system jadi pengalaman baru.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=9" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">acousticguy</span>
                </div>
                <p class="text-sm text-gray-700">
                    Nongkrong akustikan bikin suasana makin asik.
                </p>
                </div>

                <div class="flex-shrink-0 w-64 bg-white border border-gray-300 shadow-lg rounded-xl p-4">
                <div class="flex items-center gap-3 mb-3">
                    <img src="https://i.pravatar.cc/50?img=10" class="w-10 h-10 rounded-full border" />
                    <span class="font-semibold">ukmlovers</span>
                </div>
                <p class="text-sm text-gray-700">
                    Bangga jadi bagian dari UKM Musik ITERA 🎶
                </p>
                </div>

            </div>
            </div>
        </div>
    </section>

    <style>
        @keyframes marquee {
        0%   { transform: translateX(40%); }
        100% { transform: translateX(-40%); }
        }
        .animate-marquee {
        width: max-content;
        animation: marquee 40s linear infinite;
        }
    </style>

</x-public.layouts>
