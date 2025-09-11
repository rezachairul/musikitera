<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard UKMBSM ITERA</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    :root {
      --green-dark: #1f2e2b;
      --gold: #e1b21f;
      --white-soft: #e2e9e9;
    }
  </style>
</head>
<body class="bg-[var(--green-dark)] min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-[var(--green-dark)] text-[var(--white-soft)] border-b border-[var(--gold)] p-4 flex justify-between items-center">
    <div class="flex items-center space-x-3">
        <!-- Logo -->
        <img src="{{ asset('assets/img/logo/logo_ukm_bsm_itera.png') }}" alt="Logo UKM Bidang Seni Musik ITERA" class="h-10 w-10 rounded-full">
        <!-- Nama UKM -->
        <h1 class="text-xl font-bold tracking-wide">
            UKM Bidang Seni Musik ITERA
        </h1>
    </div>

    <!-- Tombol Logout -->
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit" class="bg-[var(--gold)] text-[var(--green-dark)] px-4 py-1 rounded hover:opacity-90 font-semibold transition">
        Logout
        </button>
    </form>
    </nav>


    <!-- Main Content -->
    <main class="flex-1 flex items-center justify-center p-6">
        <div class="bg-[var(--white-soft)] text-[var(--green-dark)] p-8 rounded-xl shadow-md w-full max-w-lg text-center border border-[var(--gold)]">
        <h2 class="text-3xl font-bold mb-4">
            Selamat datang, {{ auth()->user()->name }}
        </h2>
        <p class="leading-relaxed">
            Dashboard ini adalah ruang untuk berkarya.  
            Dengan semangat <span class="text-[var(--gold)] font-semibold">keharmonisan</span>, mari terus menciptakan musik yang menyatukan perbedaan.  
        </p>
        </div>
    </main>

</body>
</html>
