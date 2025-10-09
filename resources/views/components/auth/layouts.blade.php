<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>MusikITERA | {{ $title }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
        
    </head>
    <body class="bg-gray-100 flex items-center justify-center h-screen">
        {{ $slot }}
    </body>
</html>
