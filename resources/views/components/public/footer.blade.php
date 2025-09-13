<footer class="bg-gray-900 text-gray-300 py-10 mt-12">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        
        {{-- Logo + Nama --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">UKMBSM ITERA</h3>
            <p class="text-sm text-gray-400">
                Unit Kegiatan Mahasiswa Bidang Seni Musik Institut Teknologi Sumatera.
            </p>
        </div>

        {{-- Kontak --}}
        <div>
            <h3 class="text-lg font-semibold text-white mb-3">Kontak</h3>
            <a href="https://maps.app.goo.gl/Yx3eQGQP61xPobyZ6">
                <p class="text-sm">
                    Ruang D301 | Gedung D Lantai 3<br>
                    Jl. Terusan Ryacudu No.2, Way Huwi, Kec. Jati Agung, Kabupaten Lampung Selatan, Lampung 35365
                </p>
            </a>
            <a href="mailto:musikitera@gmail.com">
                <p class="text-sm mt-1">Email: musikitera@gmail.com</p>
            </a>
        </div>
        
        {{-- Sosial Media --}}
        <div class="flex justify-center md:justify-start space-x-4">
            {{-- Instagram --}}
            <a href="https://instagram.com/musikitera" 
               class="hover:text-yellow-500" aria-label="Instagram" target="_blank" rel="noopener noreferrer">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7.5 2A5.5 5.5 0 002 7.5v9A5.5 5.5 0 007.5 22h9a5.5 5.5 0 005.5-5.5v-9A5.5 5.5 0 0016.5 2h-9zm0 2h9A3.5 3.5 0 0120 7.5v9a3.5 3.5 0 01-3.5 3.5h-9A3.5 3.5 0 014 16.5v-9A3.5 3.5 0 017.5 4zm9.75 1.25a.75.75 0 100 1.5.75.75 0 000-1.5zM12 7a5 5 0 100 10 5 5 0 000-10zm0 2a3 3 0 110 6 3 3 0 010-6z"/>
                </svg>
            </a>
            {{-- YouTube --}}
            <a href="https://www.youtube.com/@musikitera5519" 
               class="hover:text-yellow-500" aria-label="YouTube" target="_blank" rel="noopener noreferrer">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M21.8 8s-.2-1.5-.8-2.2a3 3 0 00-2.2-.8C16.8 5 12 5 12 5s-4.8 0-6.8.2c-.8.1-1.6.3-2.2.8-.6.7-.8 2.2-.8 2.2S2 9.6 2 11.3v1.4c0 1.7.2 3.3.2 3.3s.2 1.5.8 2.2c.6.5 1.4.7 2.2.8C7.2 19 12 19 12 19s4.8 0 6.8-.2c.8-.1 1.6-.3 2.2-.8.6-.7.8-2.2.8-2.2s.2-1.6.2-3.3v-1.4c0-1.7-.2-3.3-.2-3.3zM10 9.8l5.2 3.2-5.2 3.2V9.8z"/>
                </svg>
            </a>
            {{-- TikTok --}}
            <a href="https://www.tiktok.com/@musikitera" 
               class="hover:text-yellow-500" aria-label="TikTok" target="_blank" rel="noopener noreferrer">
                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12.44 2h3.21c.13 1.04.62 2 1.39 2.71.77.71 1.79 1.11 2.85 1.13v3.17a6.37 6.37 0 01-3.25-.9v6.58a6.5 6.5 0 11-6.5-6.5c.24 0 .47.02.7.05v3.29a3.27 3.27 0 103.27 3.27V2z"/>
                </svg>
            </a>
        </div>
    </div>

    {{-- Copyright --}}
    <div class="border-t border-gray-700 mt-8 pt-4 text-center text-sm text-gray-500">
        &copy; {{ date('Y') }} UKMBSM ITERA. All rights reserved.

        <div class="mt-2">
            Proyek ini dikembangkan oleh:
            <br>
            🐍 <a href="https://cobradev.vercel.app/" target="_blank" rel="noopener noreferrer" 
                  class="text-gray-400 hover:text-yellow-500 font-medium">CobraDev</a>
            &nbsp;|&nbsp;
            🌐 <a href="https://sigawariweb.netlify.app/" target="_blank" rel="noopener noreferrer" 
                  class="text-gray-400 hover:text-yellow-500 font-medium">Sigawari</a>
        </div>
    </div>
</footer>