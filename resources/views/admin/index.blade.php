<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">
    <!-- Navbar -->
    <nav class="bg-blue-500 text-white p-4 flex justify-between items-center">
        <h1 class="text-lg font-bold">Dashboard</h1>
        <form action="{{ route('login.logout') }}" method="POST">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-3 py-1 rounded">Logout</button>
        </form>
    </nav>

    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center">
        <div class="bg-white p-8 rounded shadow-md w-full max-w-lg text-center">
            <h2 class="text-2xl font-bold mb-4">Selamat datang, {{ auth()->user()->name }}</h2>
            <p class="text-gray-700">Ini adalah dashboard dummy menggunakan Tailwind CSS.</p>
        </div>
    </main>
</body>
</html>
