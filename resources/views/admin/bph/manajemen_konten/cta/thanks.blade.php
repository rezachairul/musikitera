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

        
                @php
                    $waLink = $settings->wa_group_link ?? null;
                    $isValidWALink = $waLink && $waLink !== 'https://chat.whatsapp.com/';
                @endphp

                @if($isValidWALink)
                    <div class="mt-10 flex flex-col items-center gap-4">
                        
                        <!-- Button Gabung WA -->
                        <a href="{{ $waLink }}" target="_blank"
                            class="inline-flex items-center gap-3 bg-green-600 hover:bg-green-700 text-white font-semibold text-lg px-6 py-3 rounded-full shadow-lg transition transform hover:scale-105">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp h-6 w-6" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                            Gabung Grup WhatsApp
                        </a>

                        <!-- Salin + Kembali -->
                        <div class="flex flex-wrap justify-center items-center gap-3 mt-4">
                            
                            <!-- Tombol Salin -->
                            <button 
                                type="button"
                                data-url="{{ $waLink }}"
                                class="copy-wa inline-flex items-center gap-2 text-green-700 font-medium hover:text-green-900 transition text-sm border border-green-200 px-4 py-2 rounded-full bg-green-50 hover:bg-green-100"
                                title="Salin link grup WhatsApp"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
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

                        <!-- Notifikasi Copy -->
                        <p id="copy-notif" class="text-xs text-green-600 hidden">✅ Link berhasil disalin!</p>

                        <p class="text-sm text-red-500 mt-2">
                            *Gunakan akun <span class="font-semibold">WhatsApp Aktif</span> agar mudah dihubungi oleh panitia penerimaan.
                        </p>
                    </div>
                @else
                    <!-- Jika Link Belum Diset Admin -->
                    <div class="mt-10 text-center">
                        <p class="text-gray-600 italic">
                            Link grup WhatsApp belum tersedia. Silakan tunggu informasi lebih lanjut dari panitia 🙏
                        </p>

                        <!-- Tetap kasih tombol kembali -->
                        <button onclick="history.back()" 
                            class="mt-4 inline-flex items-center gap-2 border border-amber-300 text-amber-700 bg-amber-50 hover:bg-amber-100 hover:text-amber-900 px-4 py-2 rounded-full text-sm transition">
                            ← Kembali
                        </button>
                    </div>
                @endif
            </div>
        </section>
        

        <!-- FOOTER -->
        <footer class="py-6 text-center text-sm text-gray-500 border-t border-gray-200 bg-gray-50">
            &copy; {{ date('Y') }}
            <span class="font-semibold text-green-700">UKMBSM ITERA, </span>
            Developed by

            <span class="block sm:inline">
                <a href="https://cobradev.vercel.app/" target="_blank" 
                    class="text-gray-400 hover:text-yellow-500 font-medium">CobraDev</a>
            </span>
            &nbsp;|&nbsp;
            <span class="block sm:inline">
                <a href="https://sigawariweb.netlify.app/" target="_blank" 
                    class="text-gray-400 hover:text-yellow-500 font-medium">Sigawari</a>
            </span>
            . All rights reserved.
        </footer>
    </main>


    <script>
        document.addEventListener('click', async (e) => {
            const btn = e.target.closest('.copy-wa');
            if (!btn) return;

            const url = btn.dataset.url;
            if (!url) return;

            try {
                await navigator.clipboard.writeText(url);
            } catch (error) {
                const tempInput = document.createElement('input');
                tempInput.value = url;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
            }

            const notif = document.getElementById('copy-notif');
            notif.classList.remove('hidden');
            setTimeout(() => notif.classList.add('hidden'), 2000);
        });
    </script>

</body>
</html>