<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded shadow-md w-full max-w-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Login</h2>
        
        @if($errors->any())
            <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
                {{ $errors->first() }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login.authenticate') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block mb-1 font-medium">Email</label>
                <input type="email" name="email" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <div>
                <label class="block mb-1 font-medium">Password</label>
                <input type="password" name="password" class="w-full border px-3 py-2 rounded focus:outline-none focus:ring focus:border-blue-300" required>
            </div>
            <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition">Login</button>
        </form>

        <p class="mt-4 text-center text-sm">
            Belum punya akun? 
            <a href="{{ route('register') }}" class="text-blue-500 hover:underline">Register</a>
        </p>
    </div>
</body>
</html>
