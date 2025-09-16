<!-- Highlight kegiatan UKMBSM ITERA -->
<section class="py-12 bg-gray-100">
    <div class="max-w-7xl mx-auto px-6">
        <h2 class="text-2xl font-semibold text-center mb-8">Highlight Kegiatan</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 1; $i <= 6; $i++)
                <div 
                    class="relative group rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-2 hover:scale-105 animate-fade-up"
                    style="animation-delay: {{ $i * 0.1 }}s; animation-fill-mode: both;"
                >
                    {{-- Background Image --}}
                    <img src="https://picsum.photos/400/250?random={{ $i }}" 
                        class="w-full h-56 object-cover" 
                        alt="highlight{{ $i }}">

                    {{-- Overlay dengan slide dari kiri --}}
                    <div class="absolute inset-0 bg-green-700/85 flex flex-col justify-center items-center text-center px-4
                                transform -translate-x-full opacity-0
                                group-hover:translate-x-0 group-hover:opacity-100 
                                transition duration-500 ease-in-out">
                        
                        <h3 class="text-white font-bold text-lg mb-2">Kegiatan {{ $i }}</h3>
                        <p class="text-white text-sm mb-4">
                            Deskripsi singkat kegiatan ke-{{ $i }} yang dilakukan UKMBSM ITERA.
                        </p>
                        <a href="#"
                            class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-white text-green-700 text-sm font-medium hover:bg-gray-200 transition">
                            Selengkapnya 
                            <span>→</span>
                        </a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
</section>