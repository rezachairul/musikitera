<x-public.layouts>
    <x-slot:title>About</x-slot:title>

    <section id="about-wrapper"
        class="min-h-screen bg-white transition-all duration-1000 ease-out relative overflow-hidden">

        <!-- Animated Background Elements (hidden by default, shown on scroll) -->
        <div id="bg-elements"
            class="absolute inset-0 overflow-hidden pointer-events-none opacity-0 transition-opacity duration-1000">
            <!-- Floating gradient orbs -->
            <div
                class="absolute top-20 left-10 w-96 h-96 bg-gradient-to-br from-purple-500/20 via-pink-500/20 to-transparent rounded-full blur-3xl animate-float">
            </div>
            <div
                class="absolute bottom-20 right-10 w-80 h-80 bg-gradient-to-br from-cyan-500/20 via-blue-500/20 to-transparent rounded-full blur-3xl animate-float-delayed">
            </div>
            <div
                class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-gradient-to-br from-violet-500/10 via-fuchsia-500/10 to-transparent rounded-full blur-3xl animate-pulse-slow">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-6 py-20 relative z-10">

            <!-- Hero Section - Centered -->
            <div id="hero-content" class="text-center mb-16 animate-fade-in-up">
                <div class="inline-block mb-4">
                    <span
                        class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600 transition-all duration-700">
                        Tentang Kami
                    </span>
                </div>

                <h1
                    class="text-5xl md:text-7xl font-black tracking-tight mb-6 leading-tight text-slate-900 transition-all duration-700">
                    Pengurus UKM
                    <br>
                    Seni Musik ITERA
                </h1>

                <p
                    class="text-lg md:text-xl text-slate-700 max-w-3xl mx-auto leading-relaxed mb-4 transition-all duration-700">
                    Kepengurusan periode
                    <span class="font-bold text-blue-600">20XX / 20XX</span>
                </p>
                <p
                    class="text-base md:text-lg text-slate-600 max-w-2xl mx-auto leading-relaxed transition-all duration-700">
                    Tim yang menjaga ritme organisasi tetap harmonis,
                    mengatur kegiatan, dan mendukung kreativitas seluruh anggota.
                </p>

                <!-- Decorative sound wave -->
                <div class="flex justify-center gap-1 mt-8 items-end h-12">
                    <span class="w-1 bg-blue-500 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0s;"></span>
                    <span class="w-1 bg-blue-600 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.1s;"></span>
                    <span class="w-1 bg-blue-500 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.2s;"></span>
                    <span class="w-1 bg-blue-700 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.3s;"></span>
                    <span class="w-1 bg-blue-600 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.4s;"></span>
                    <span class="w-1 bg-blue-500 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.5s;"></span>
                    <span class="w-1 bg-blue-600 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.6s;"></span>
                    <span class="w-1 bg-blue-700 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.7s;"></span>
                    <span class="w-1 bg-blue-500 rounded-full animate-sound-wave transition-all duration-700"
                        style="animation-delay: 0.8s;"></span>
                </div>
            </div>

            @php
                $pengurus = [
                    ['jabatan' => 'Ketua', 'nama' => 'Nama Ketua Dummy'],
                    ['jabatan' => 'Wakil Ketua', 'nama' => 'Nama Wakil Dummy'],
                    ['jabatan' => 'Sekretaris', 'nama' => 'Nama Sekretaris Dummy'],
                    ['jabatan' => 'Bendahara', 'nama' => 'Nama Bendahara Dummy'],
                    ['jabatan' => 'Koordinator Acara', 'nama' => 'Nama Koordinator Dummy'],
                    ['jabatan' => 'Koordinator Latihan', 'nama' => 'Nama Koordinator Dummy'],
                ];
            @endphp

            <!-- Team Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-16">
                @foreach ($pengurus as $index => $item)
                    <div class="group animate-fade-in-up card-item" style="animation-delay: {{ $index * 0.1 }}s;">
                        <!-- Outer glow -->
                        <div
                            class="relative rounded-2xl p-[2px] bg-gradient-to-br from-blue-500/50 via-blue-600/50 to-blue-700/50 
                                    shadow-lg shadow-blue-500/0 hover:shadow-blue-500/50 hover:shadow-2xl
                                    transition-all duration-500 group-hover:scale-[1.02]">

                            <!-- Card content -->
                            <div
                                class="h-full rounded-2xl bg-white
                                        backdrop-blur-xl px-6 py-6 flex flex-col justify-between
                                        border border-slate-200 relative overflow-hidden transition-all duration-700">

                                <!-- Hover gradient effect -->
                                <div
                                    class="absolute inset-0 bg-gradient-to-br from-blue-500/0 via-blue-600/0 to-blue-700/0 
                                            group-hover:from-blue-500/5 group-hover:via-blue-600/5 group-hover:to-blue-700/5
                                            transition-all duration-500 rounded-2xl">
                                </div>

                                <div class="relative z-10">
                                    <div class="flex items-start justify-between gap-3 mb-4">
                                        <div class="flex-1">
                                            <p class="text-[10px] font-bold tracking-[0.25em] uppercase text-blue-600">
                                                {{ $item['jabatan'] }}
                                            </p>
                                            <p
                                                class="mt-2 text-xl font-bold text-slate-900 group-hover:text-blue-600 transition-all duration-300">
                                                {{ $item['nama'] }}
                                            </p>
                                            <p class="text-xs text-slate-500 mt-2">
                                                UKM Seni Musik ITERA
                                            </p>
                                        </div>
                                    </div>

                                    <!-- Animated equalizer bars -->
                                    <div class="mt-6 flex gap-1.5 items-end h-8">
                                        <span
                                            class="w-1.5 bg-blue-500 rounded-full transition-all duration-300 animate-equalizer-1"></span>
                                        <span
                                            class="w-1.5 bg-blue-600 rounded-full transition-all duration-300 animate-equalizer-2"></span>
                                        <span
                                            class="w-1.5 bg-blue-700 rounded-full transition-all duration-300 animate-equalizer-3"></span>
                                        <span
                                            class="w-1.5 bg-blue-500 rounded-full transition-all duration-300 animate-equalizer-4"></span>
                                        <span
                                            class="w-1.5 bg-blue-600 rounded-full transition-all duration-300 animate-equalizer-1"></span>
                                        <span
                                            class="w-1.5 bg-blue-700 rounded-full transition-all duration-300 animate-equalizer-2"></span>
                                        <span
                                            class="w-1.5 bg-blue-500 rounded-full transition-all duration-300 animate-equalizer-3"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </section>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(30px, -30px) rotate(5deg);
            }

            66% {
                transform: translate(-20px, 20px) rotate(-5deg);
            }
        }

        @keyframes float-delayed {

            0%,
            100% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(-30px, 30px) rotate(-5deg);
            }

            66% {
                transform: translate(20px, -20px) rotate(5deg);
            }
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.3;
                transform: scale(1);
            }

            50% {
                opacity: 0.5;
                transform: scale(1.1);
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes sound-wave {

            0%,
            100% {
                height: 20%;
            }

            50% {
                height: 100%;
            }
        }

        @keyframes equalizer-1 {

            0%,
            100% {
                height: 30%;
            }

            50% {
                height: 80%;
            }
        }

        @keyframes equalizer-2 {

            0%,
            100% {
                height: 50%;
            }

            50% {
                height: 100%;
            }
        }

        @keyframes equalizer-3 {

            0%,
            100% {
                height: 40%;
            }

            50% {
                height: 90%;
            }
        }

        @keyframes equalizer-4 {

            0%,
            100% {
                height: 60%;
            }

            50% {
                height: 70%;
            }
        }

        .animate-float {
            animation: float 20s ease-in-out infinite;
        }

        .animate-float-delayed {
            animation: float-delayed 25s ease-in-out infinite;
        }

        .animate-pulse-slow {
            animation: pulse-slow 8s ease-in-out infinite;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-sound-wave {
            animation: sound-wave 1.5s ease-in-out infinite;
        }

        .animate-equalizer-1 {
            animation: equalizer-1 1.2s ease-in-out infinite;
        }

        .animate-equalizer-2 {
            animation: equalizer-2 1.4s ease-in-out infinite;
        }

        .animate-equalizer-3 {
            animation: equalizer-3 1.1s ease-in-out infinite;
        }

        .animate-equalizer-4 {
            animation: equalizer-4 1.3s ease-in-out infinite;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const section = document.getElementById('about-wrapper');
            const bgElements = document.getElementById('bg-elements');
            const heroContent = document.getElementById('hero-content');
            const cardItems = document.querySelectorAll('.card-item');

            const handleScroll = () => {
                const y = window.scrollY || window.pageYOffset;

                if (y > 300) {
                    // Change to dark gradient background
                    section.classList.remove('bg-white');
                    section.classList.add('bg-gradient-to-b', 'from-slate-950', 'via-slate-900',
                        'to-slate-950');

                    // Show animated background elements
                    bgElements.classList.remove('opacity-0');
                    bgElements.classList.add('opacity-100');

                    // Change hero text colors to gradient
                    const heroTitle = heroContent.querySelector('h1');
                    const heroSubtitle = heroContent.querySelectorAll('p')[0];
                    const heroDesc = heroContent.querySelectorAll('p')[1];
                    const heroLabel = heroContent.querySelector('span');
                    const soundWaves = heroContent.querySelectorAll('.animate-sound-wave');

                    heroLabel.classList.remove('text-blue-600');
                    heroLabel.classList.add('bg-gradient-to-r', 'from-cyan-400', 'via-purple-400',
                        'to-pink-400', 'text-transparent', 'bg-clip-text');

                    heroTitle.classList.remove('text-slate-900');
                    heroTitle.classList.add('bg-gradient-to-r', 'from-white', 'via-purple-200', 'to-cyan-200',
                        'text-transparent', 'bg-clip-text');

                    heroSubtitle.classList.remove('text-slate-700');
                    heroSubtitle.classList.add('text-slate-300');
                    heroSubtitle.querySelector('span').classList.remove('text-blue-600');
                    heroSubtitle.querySelector('span').classList.add('text-transparent', 'bg-clip-text',
                        'bg-gradient-to-r', 'from-cyan-400', 'to-purple-400');

                    heroDesc.classList.remove('text-slate-600');
                    heroDesc.classList.add('text-slate-400');

                    soundWaves.forEach((wave, index) => {
                        wave.classList.remove('bg-blue-500', 'bg-blue-600', 'bg-blue-700');
                        if (index % 3 === 0) wave.classList.add('bg-gradient-to-t', 'from-cyan-500',
                            'to-purple-500');
                        else if (index % 3 === 1) wave.classList.add('bg-gradient-to-t',
                            'from-purple-500', 'to-pink-500');
                        else wave.classList.add('bg-gradient-to-t', 'from-cyan-500', 'to-pink-500');
                    });

                    // Change card styles to dark mode
                    cardItems.forEach(cardItem => {
                        const card = cardItem.querySelector('.rounded-2xl.bg-white');
                        const border = cardItem.querySelector('[class*="from-blue-500"]');
                        const jabatan = cardItem.querySelector(
                            '[class*="text-blue-600"]:first-of-type');
                        const nama = cardItem.querySelector('.text-slate-900');
                        const ukm = cardItem.querySelector('.text-slate-500');
                        const bars = cardItem.querySelectorAll('[class*="bg-blue-"]');

                        if (card) {
                            card.classList.remove('bg-white', 'border-slate-200');
                            card.classList.add('bg-gradient-to-br', 'from-slate-900/95',
                                'via-slate-800/95', 'to-slate-900/95', 'border-slate-700/50');
                        }

                        if (border) {
                            border.classList.remove('from-blue-500/50', 'via-blue-600/50',
                                'to-blue-700/50', 'shadow-blue-500/0', 'hover:shadow-blue-500/50');
                            border.classList.add('from-cyan-500/50', 'via-purple-500/50',
                                'to-pink-500/50', 'shadow-purple-500/25',
                                'hover:shadow-purple-500/50');
                        }

                        if (jabatan) {
                            jabatan.classList.remove('text-blue-600');
                            jabatan.classList.add('bg-gradient-to-r', 'from-cyan-400', 'to-purple-400',
                                'text-transparent', 'bg-clip-text');
                        }

                        if (nama) {
                            nama.classList.remove('text-slate-900', 'group-hover:text-blue-600');
                            nama.classList.add('text-white', 'group-hover:text-transparent',
                                'group-hover:bg-clip-text', 'group-hover:bg-gradient-to-r',
                                'group-hover:from-cyan-300', 'group-hover:to-purple-300');
                        }

                        if (ukm) {
                            ukm.classList.remove('text-slate-500');
                            ukm.classList.add('text-slate-400');
                        }

                        bars.forEach((bar, index) => {
                            bar.classList.remove('bg-blue-500', 'bg-blue-600', 'bg-blue-700');
                            if (index % 3 === 0) bar.classList.add('bg-gradient-to-t',
                                'from-cyan-500', 'to-cyan-400');
                            else if (index % 3 === 1) bar.classList.add('bg-gradient-to-t',
                                'from-purple-500', 'to-purple-400');
                            else bar.classList.add('bg-gradient-to-t', 'from-pink-500',
                                'to-pink-400');
                        });
                    });
                } else {
                    // Restore white background
                    section.classList.add('bg-white');
                    section.classList.remove('bg-gradient-to-b', 'from-slate-950', 'via-slate-900',
                        'to-slate-950');

                    // Hide animated background elements
                    bgElements.classList.add('opacity-0');
                    bgElements.classList.remove('opacity-100');

                    // Restore hero text colors
                    const heroTitle = heroContent.querySelector('h1');
                    const heroSubtitle = heroContent.querySelectorAll('p')[0];
                    const heroDesc = heroContent.querySelectorAll('p')[1];
                    const heroLabel = heroContent.querySelector('span');
                    const soundWaves = heroContent.querySelectorAll('.animate-sound-wave');

                    heroLabel.classList.add('text-blue-600');
                    heroLabel.classList.remove('bg-gradient-to-r', 'from-cyan-400', 'via-purple-400',
                        'to-pink-400', 'text-transparent', 'bg-clip-text');

                    heroTitle.classList.add('text-slate-900');
                    heroTitle.classList.remove('bg-gradient-to-r', 'from-white', 'via-purple-200',
                        'to-cyan-200', 'text-transparent', 'bg-clip-text');

                    heroSubtitle.classList.add('text-slate-700');
                    heroSubtitle.classList.remove('text-slate-300');
                    heroSubtitle.querySelector('span').classList.add('text-blue-600');
                    heroSubtitle.querySelector('span').classList.remove('text-transparent', 'bg-clip-text',
                        'bg-gradient-to-r', 'from-cyan-400', 'to-purple-400');

                    heroDesc.classList.add('text-slate-600');
                    heroDesc.classList.remove('text-slate-400');

                    soundWaves.forEach(wave => {
                        wave.classList.remove('bg-gradient-to-t', 'from-cyan-500', 'to-purple-500',
                            'from-purple-500', 'to-pink-500', 'from-cyan-500', 'to-pink-500');
                        const index = Array.from(soundWaves).indexOf(wave);
                        if (index % 3 === 0) wave.classList.add('bg-blue-500');
                        else if (index % 3 === 1) wave.classList.add('bg-blue-600');
                        else wave.classList.add('bg-blue-700');
                    });

                    // Restore card styles to light mode
                    cardItems.forEach(cardItem => {
                        const card = cardItem.querySelector('.rounded-2xl');
                        const border = cardItem.querySelector('[class*="from-"]');
                        const jabatan = cardItem.querySelector('[class*="uppercase"]');
                        const nama = cardItem.querySelector('.text-xl');
                        const ukm = cardItem.querySelector('.text-xs');
                        const bars = cardItem.querySelectorAll('[class*="animate-equalizer"]');

                        if (card && card.classList.contains('from-slate-900/95')) {
                            card.classList.add('bg-white', 'border-slate-200');
                            card.classList.remove('bg-gradient-to-br', 'from-slate-900/95',
                                'via-slate-800/95', 'to-slate-900/95', 'border-slate-700/50');
                        }

                        if (border) {
                            border.classList.add('from-blue-500/50', 'via-blue-600/50',
                                'to-blue-700/50', 'shadow-blue-500/0', 'hover:shadow-blue-500/50');
                            border.classList.remove('from-cyan-500/50', 'via-purple-500/50',
                                'to-pink-500/50', 'shadow-purple-500/25',
                                'hover:shadow-purple-500/50');
                        }

                        if (jabatan) {
                            jabatan.classList.add('text-blue-600');
                            jabatan.classList.remove('bg-gradient-to-r', 'from-cyan-400',
                                'to-purple-400', 'text-transparent', 'bg-clip-text');
                        }

                        if (nama) {
                            nama.classList.add('text-slate-900', 'group-hover:text-blue-600');
                            nama.classList.remove('text-white', 'group-hover:text-transparent',
                                'group-hover:bg-clip-text', 'group-hover:bg-gradient-to-r',
                                'group-hover:from-cyan-300', 'group-hover:to-purple-300');
                        }

                        if (ukm) {
                            ukm.classList.add('text-slate-500');
                            ukm.classList.remove('text-slate-400');
                        }

                        bars.forEach((bar, index) => {
                            bar.classList.remove('bg-gradient-to-t', 'from-cyan-500',
                                'to-cyan-400', 'from-purple-500', 'to-purple-400',
                                'from-pink-500', 'to-pink-400');
                            if (index % 3 === 0) bar.classList.add('bg-blue-500');
                            else if (index % 3 === 1) bar.classList.add('bg-blue-600');
                            else bar.classList.add('bg-blue-700');
                        });
                    });
                }
            };

            handleScroll();
            window.addEventListener('scroll', handleScroll);
        });
    </script>
</x-public.layouts>
