<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UKMBSM ITERA | {{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link id="favicon" rel="shortcut icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" type="image/x-icon">
</head>

<body class="min-h-screen bg-gradient-to-br from-green-50 via-white to-green-100 text-gray-800 flex flex-col items-center justify-center">
    <main class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden border border-green-100 mx-4">
        <!-- UCAPAN -->
         <section class="py-14 px-8 text-center relative overflow-hidden">
            <div class="absolute inset-0 opacity-10 bg-[url('{{ asset('assets/img/pattern/music-notes.svg') }}')] bg-cover bg-center"></div>
            
            <div class="relative z-10">
                <h2 class="text-4xl font-extrabold text-green-700 mb-4 animate-bounce">
                    🎉 Terima Kasih Telah Mendaftar! 🎶
                </h2>
                <p class="text-lg text-gray-700 max-w-2xl mx-auto leading-relaxed">
                    Kami sangat senang menyambutmu sebagai calon anggota <strong>UKMBSM ITERA</strong>!
                    Yuk, lanjutkan langkah pertamamu dengan bergabung ke grup WhatsApp calon anggota di bawah ini 👇
                </p>

                @if ($grupWA)
                    <div class="mt-10 flex flex-col items-center gap-4">
                        <!-- Button Gabung WA -->
                        <a href="{{ $grupWA->url }}" target="_blank"
                        class="inline-flex items-center gap-3 bg-green-600 hover:bg-green-700 text-white font-semibold text-lg px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.1-.472-.148-.672.149-.197.297-.771.967-.945 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.1-.198.05-.372-.025-.521-.074-.149-.671-1.616-.919-2.215-.242-.579-.487-.5-.672-.51-.173-.007-.372-.009-.571-.009-.198 0-.52.074-.793.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.1 3.204 5.088 4.487.711.306 1.265.489 1.697.626.713.227 1.36.195 1.872.118.571-.085 1.758-.719 2.006-1.413.247-.694.247-1.289.173-1.413-.074-.124-.272-.198-.571-.347z"/>
                            </svg>
                            Gabung Grup WhatsApp
                        </a>

                        <!-- Baris untuk tombol Salin & Kembali -->
                        <div class="flex flex-wrap justify-center items-center gap-3 mt-4">
                            <!-- Tombol Salin Link -->
                            <button 
                                onclick="copyWALink('{{ $grupWA->url }}')" 
                                class="inline-flex items-center gap-2 text-green-700 font-medium hover:text-green-900 transition text-sm border border-green-200 px-4 py-2 rounded-full bg-green-50 hover:bg-green-100"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16h8M8 12h8m-6 8h6a2 2 0 002-2V6a2 2 0 00-2-2h-5.5a1.5 1.5 0 01-1.5-1.5V2m0 0H6a2 2 0 00-2 2v14a2 2 0 002 2h2"/>
                                </svg>
                                Salin Link Grup
                            </button>

                            <!-- Tombol Kembali -->
                            <button onclick="history.back()" 
                                class="inline-flex items-center gap-2 border border-amber-300 text-amber-700 bg-amber-50 hover:bg-amber-100 hover:text-amber-900 px-4 py-2 rounded-full text-sm transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                                </svg>
                                Kembali
                            </button>
                        </div>

                        <p id="copy-notif" class="text-xs text-green-600 hidden">✅ Link berhasil disalin!</p>
                        <p class="text-sm text-gray-500 mt-2">
                            *Gunakan akun WhatsApp aktif agar mudah dihubungi oleh panitia penerimaan.
                        </p>
                    </div>
                @else
                    <p class="mt-10 text-gray-600 italic">
                        Link grup WhatsApp belum tersedia. Silakan tunggu informasi lebih lanjut dari panitia 🙏
                    </p>
                @endif
            </div>
        </section>
        

        <!-- FOOTER -->
        <footer class="py-6 text-center text-sm text-gray-500 border-t border-gray-200 bg-gray-50">
            &copy; {{ date('Y') }}
            <span class="font-semibold text-green-700">UKMBSM ITERA, </span>
            <span class="block sm:inline">
                🐍 <a href="https://cobradev.vercel.app/" target="_blank" 
                    class="text-gray-400 hover:text-yellow-500 font-medium">CobraDev</a>
            </span>
            <span class="block sm:inline">
                🌐 <a href="https://sigawariweb.netlify.app/" target="_blank" 
                    class="text-gray-400 hover:text-yellow-500 font-medium">Sigawari</a>
            </span>
            . All rights reserved.
        </footer>
    </main>

</body>
</html>