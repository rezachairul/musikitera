<!-- Layouts Administrator -->

<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKMBSM ITERA | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">

    <!-- SwiperJS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
</head>

<body class="h-screen overflow-hidden">
    <div class="flex h-screen">
        {{-- Sidebar --}}
        <x-admin.administrator.sidebar></x-admin.administrator.sidebar>

        {{-- Right content (navbar + main + footer) --}}
        <div class="flex flex-col flex-1 overflow-hidden">
            
            {{-- Navbar --}}
            <x-admin.administrator.navbar></x-admin.administrator.navbar>

            {{-- Main --}}
            <main class="flex-1 overflow-y-auto p-6">
                {{-- Header --}}
                <x-admin.administrator.header>{{ $title }}</x-admin.administrator.header>

                {{-- Pages --}}
                <div class="mt-6">
                    {{ $slot }}
                </div>
            </main>

            {{-- Footer --}}
            <x-admin.administrator.footer></x-admin.administrator.footer>
        </div>
    </div>
</body>

</html>