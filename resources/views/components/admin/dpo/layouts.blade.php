<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>UKMBSM ITERA | {{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">

    </head>

    <body class="h-screen overflow-hidden">
        <div class="flex h-screen">
            {{-- Sidebar --}}
            <x-admin.bph.sidebar></x-admin.bph.sidebar>

            {{-- Right content (navbar + main + footer) --}}
            <div class="flex flex-col flex-1 overflow-hidden">

                {{-- Navbar --}}
                <x-admin.bph.navbar></x-admin.bph.navbar>

                {{-- Main --}}
                <main class="flex-1 overflow-y-auto p-6">
                    {{-- Header --}}
                    <x-admin.bph.header>{{ $title }}</x-admin.bph.header>

                    {{-- Pages --}}
                    <div class="mt-6">
                        {{ $slot }}
                    </div>
                </main>

                {{-- Footer --}}
                <x-admin.bph.footer></x-admin.bph.footer>
            </div>
        </div>
    </body>

</html>
