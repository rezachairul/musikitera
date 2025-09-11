<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MusikITERA | {{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">

        <!-- Icons -->

        <!-- SwiperJS CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    </head>

    <body>
        <div class="flex flex-col min-h-screen">
            {{-- Isi Halaman --}}

            <!-- Navbar -->
             <x-public.navbar></x-public.navbar>

            <!-- Main -->
            <main class="flex-grow">
                <!-- Header -->
                @if(!request()->routeIs('public.index'))
                    <x-public.header>{{ $title }}</x-public.header>
                @endif
                <!-- Pages -->
                <div class="max-w-7xl mx-auto px-6 py-10">
                    {{ $slot }}
                </div>
            </main>
            <!-- Footer -->
            <x-public.footer></x-public.footer>
        </div>

        <script>
            const swiper = new Swiper(".mySwiper", {
                loop: true,
                spaceBetween: 20,
                centeredSlides: true,
                autoplay: {
                    delay: 2500,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                breakpoints: {
                    640: { slidesPerView: 1 },
                    768: { slidesPerView: 2 },
                    1024: { slidesPerView: 3 },
                }
            });
        </script>
    </body>

</html>
