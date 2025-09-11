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
                        <img src="https://images.pexels.com/photos/164821/pexels-photo-164821.jpeg" class="rounded-lg shadow mx-auto" alt="gallery1">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/210922/pexels-photo-210922.jpeg" class="rounded-lg shadow mx-auto" alt="gallery2">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/164745/pexels-photo-164745.jpeg" class="rounded-lg shadow mx-auto" alt="gallery3">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/164716/pexels-photo-164716.jpeg" class="rounded-lg shadow mx-auto" alt="gallery4">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/7096/people-woman-coffee-meeting.jpg" class="rounded-lg shadow mx-auto" alt="gallery5">
                    </div>
                    <div class="swiper-slide">
                        <img src="https://images.pexels.com/photos/167446/pexels-photo-167446.jpeg" class="rounded-lg shadow mx-auto" alt="gallery6">
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
            <div class="grid md:grid-cols-2 gap-6">
                <div class="p-6 bg-white rounded-lg shadow">
                    <img src="https://images.pexels.com/photos/713149/pexels-photo-713149.jpeg" class="rounded-lg mb-4" alt="highlight2">
                    <h3 class="font-bold text-lg mb-2">Konser Akhir Tahun</h3>
                    <p class="text-gray-600 text-sm">Penampilan spektakuler dari anggota UKM Bidang Musik ITERA dalam konser akhir tahun.</p>
                </div>
                <div class="p-6 bg-white rounded-lg shadow">
                    <img src="https://images.pexels.com/photos/713149/pexels-photo-713149.jpeg" class="rounded-lg mb-4" alt="highlight2">
                    <h3 class="font-bold text-lg mb-2">Workshop Vokal</h3>
                    <p class="text-gray-600 text-sm">Pelatihan vokal intensif bersama pelatih profesional untuk mengasah kemampuan anggota.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CTA SECTION --}}
    <section class="py-12">
        <div class="max-w-5xl mx-auto px-6 text-center">
            <h2 class="text-2xl font-semibold mb-8">Apa Kata Mereka?</h2>
            <blockquote class="italic text-gray-700">
                “Bergabung di UKM Musik ITERA adalah pengalaman yang luar biasa. 
                Tidak hanya bermain musik, tapi juga membangun keluarga baru.”
            </blockquote>
            <p class="mt-4 font-semibold text-green-600">— Mahasiswa ITERA</p>
        </div>
    </section>

</x-public.layouts>
