{{-- resources/views/public/executive/dpo_detail.blade.php --}}
<x-public.layouts>
    <x-slot:title>DPO Kabinet Daniswara 2025/2026</x-slot:title>

    @php
        // Data Dummy untuk Detail DPO
        $kabinetName = 'Daniswara';
        $periode = '2025/2026';

        $pimpinanDpo = [
            ['name' => 'Ahmad Fauzi', 'role' => 'Ketua DPO', 'image' => 'https://i.pravatar.cc/300?img=11'],
            ['name' => 'Siti Aminah', 'role' => 'Sekretaris DPO', 'image' => 'https://i.pravatar.cc/300?img=5'],
        ];

        $komisiDpo = [
            'Komisi I' => [
                'bidang' => 'Internal & Organisasi',
                'members' => [
                    ['name' => 'Budi Santoso', 'role' => 'Ketua Komisi', 'image' => 'https://i.pravatar.cc/300?img=12'],
                    ['name' => 'Rina Wijaya', 'role' => 'Anggota', 'image' => 'https://i.pravatar.cc/300?img=1'],
                ],
            ],
            'Komisi II' => [
                'bidang' => 'Program Kerja & Eksternal',
                'members' => [
                    ['name' => 'Diana Putri', 'role' => 'Ketua Komisi', 'image' => 'https://i.pravatar.cc/300?img=9'],
                    ['name' => 'Fajar Ramadhan', 'role' => 'Anggota', 'image' => 'https://i.pravatar.cc/300?img=13'],
                ],
            ],
            'Komisi III' => [
                'bidang' => 'Keuangan & Aset',
                'members' => [
                    ['name' => 'Eko Prasetyo', 'role' => 'Ketua Komisi', 'image' => 'https://i.pravatar.cc/300?img=14'],
                    ['name' => 'Gita Lestari', 'role' => 'Anggota', 'image' => 'https://i.pravatar.cc/300?img=2'],
                ],
            ],
            'Komisi IV' => [
                'bidang' => 'Hukum & Konstitusi',
                'members' => [
                    [
                        'name' => 'Hendra Kurnia',
                        'role' => 'Ketua Komisi',
                        'image' => 'https://i.pravatar.cc/300?img=15',
                    ],
                    ['name' => 'Indah Permata', 'role' => 'Anggota', 'image' => 'https://i.pravatar.cc/300?img=3'],
                ],
            ],
            'Komisi V' => [
                'bidang' => 'Media & Informasi',
                'members' => [
                    ['name' => 'Joko Susilo', 'role' => 'Ketua Komisi', 'image' => 'https://i.pravatar.cc/300?img=16'],
                    ['name' => 'Karin Amalia', 'role' => 'Anggota', 'image' => 'https://i.pravatar.cc/300?img=4'],
                ],
            ],
        ];
    @endphp

    <section class="bg-white py-16 md:py-24 relative overflow-hidden font-sans">
        {{-- BACKGROUND ELEMENT --}}
        <div class="absolute top-0 left-0 w-full h-full opacity-[0.03] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="legStaff" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32 M0 40 L100 40" stroke="#0A192F"
                            stroke-width="0.5" fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#legStaff)" />
            </svg>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            {{-- HEADER: Menampilkan Nama Kabinet yang Diawasi --}}
            <div class="mb-16 md:mb-20">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">
                        Supervisory Board Detail
                    </span>
                </div>

                <h1 class="text-4xl md:text-6xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    DPO Kabinet <span class="text-[#457B9D]">{{ $kabinetName }}</span>
                    <br><span class="text-2xl md:text-3xl font-light text-slate-400 italic">Periode
                        {{ $periode }}</span>
                </h1>
            </div>

            {{-- SECTION: PIMPINAN DPO --}}
            <div class="mb-24">
                <div class="flex items-center gap-4 mb-10">
                    <h2 class="text-xl font-black text-[#0A192F] uppercase tracking-tight whitespace-nowrap">Core
                        Leadership</h2>
                    <div class="h-[1px] w-full bg-slate-100"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-3xl">
                    @foreach ($pimpinanDpo as $leader)
                        <div
                            class="flex items-center gap-6 p-6 bg-slate-50 rounded-[2rem] border border-slate-100 group hover:bg-white hover:shadow-xl hover:border-[#457B9D] transition-all duration-500">
                            <div
                                class="w-24 h-24 rounded-2xl overflow-hidden shadow-lg transform group-hover:rotate-3 transition-transform">
                                <img src="{{ $leader['image'] }}"
                                    class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500"
                                    alt="">
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-[#E63946] uppercase tracking-widest mb-1">
                                    {{ $leader['role'] }}</p>
                                <h4 class="text-xl font-black text-[#0A192F] uppercase tracking-tight">
                                    {{ $leader['name'] }}</h4>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- SECTION: KOMISI 1 - 5 --}}
            <div class="space-y-24">
                @foreach ($komisiDpo as $komisiName => $data)
                    <div class="relative">
                        {{-- Commission Title --}}
                        <div class="mb-10">
                            <span
                                class="text-[#457B9D] text-xs font-black uppercase tracking-[0.3em] block mb-2">{{ $komisiName }}</span>
                            <h3 class="text-2xl font-black text-[#0A192F] uppercase tracking-tight">
                                {{ $data['bidang'] }}</h3>
                            <div class="w-16 h-1 bg-[#E63946] mt-3"></div>
                        </div>

                        {{-- Members Grid --}}
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                            @foreach ($data['members'] as $member)
                                <div class="group">
                                    <div
                                        class="relative aspect-[4/5] rounded-[1.5rem] overflow-hidden border-2 border-slate-100 mb-4 group-hover:border-[#457B9D] group-hover:-translate-y-2 transition-all duration-500 shadow-sm group-hover:shadow-xl">
                                        <img src="{{ $member['image'] }}"
                                            class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-700"
                                            alt="">
                                        <div
                                            class="absolute inset-0 bg-gradient-to-t from-[#0A192F]/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                        </div>
                                        <div
                                            class="absolute bottom-4 left-4 right-4 translate-y-4 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all">
                                            <p class="text-[8px] font-bold text-white uppercase tracking-widest">
                                                {{ $member['role'] }}</p>
                                        </div>
                                    </div>
                                    <h5
                                        class="font-black text-[#0A192F] text-sm uppercase tracking-tight group-hover:text-[#457B9D] transition-colors leading-tight">
                                        {{ $member['name'] }}</h5>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- FOOTER INFO --}}
            <div class="mt-32 p-10 bg-[#0A192F] rounded-[3rem] text-center relative overflow-hidden">
                <div
                    class="absolute top-0 right-0 w-64 h-64 bg-[#E63946] opacity-10 rounded-full -translate-y-1/2 translate-x-1/2">
                </div>
                <div class="relative z-10">
                    <p class="text-slate-400 text-sm font-medium mb-4">Halaman ini menampilkan struktur pengawasan resmi
                        untuk</p>
                    <h4 class="text-white text-2xl font-black uppercase tracking-widest">Kabinet {{ $kabinetName }}
                        {{ $periode }}</h4>
                    <div class="flex justify-center gap-4 mt-8">
                        <a href="#"
                            class="px-6 py-3 bg-white/10 hover:bg-white hover:text-[#0A192F] text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Lihat
                            Laporan Evaluasi</a>
                        <a href="#"
                            class="px-6 py-3 bg-[#E63946] hover:bg-white hover:text-[#E63946] text-white rounded-xl text-[10px] font-black uppercase tracking-widest transition-all">Hubungi
                            DPO</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-public.layouts>
