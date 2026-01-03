{{-- resources/views/public/executive/show.blade.php --}}
<x-public.layouts>
    <x-slot:title>Kabinet Daniswara - Struktur Organisasi</x-slot:title>

    <style>
        /* CSS Khusus untuk Tree Structure */
        .tree-container ul {
            padding-top: 20px;
            position: relative;
            transition: all 0.5s;
            display: flex;
            justify-content: center;
        }

        .tree-container li {
            float: left;
            text-align: center;
            list-style-type: none;
            position: relative;
            padding: 20px 5px 0 5px;
            transition: all 0.5s;
        }

        /* Garis penghubung horizontal */
        .tree-container li::before,
        .tree-container li::after {
            content: '';
            position: absolute;
            top: 0;
            right: 50%;
            border-top: 2px solid #cbd5e1;
            width: 50%;
            height: 20px;
        }

        .tree-container li::after {
            right: auto;
            left: 50%;
            border-left: 2px solid #cbd5e1;
        }

        /* Hilangkan garis untuk elemen tunggal/ujung */
        .tree-container li:only-child::after,
        .tree-container li:only-child::before {
            display: none;
        }

        .tree-container li:only-child {
            padding-top: 0;
        }

        .tree-container li:first-child::before,
        .tree-container li:last-child::after {
            border: 0 none;
        }

        .tree-container li:last-child::before {
            border-right: 2px solid #cbd5e1;
            border-radius: 0 5px 0 0;
        }

        .tree-container li:first-child::after {
            border-radius: 5px 0 0 0;
        }

        /* Garis vertikal ke bawah */
        .tree-container ul ul::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            border-left: 2px solid #cbd5e1;
            width: 0;
            height: 20px;
        }
    </style>

    {{-- HERO SECTION --}}
    <section class="bg-[#0A192F] pt-28 pb-16 relative overflow-hidden">
        <div class="absolute inset-0 opacity-5">
            <svg width="100%" height="100%">
                <rect width="100%" height="100%" fill="url(#grid)" />
            </svg>
            <defs>
                <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                    <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1" />
                </pattern>
            </defs>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 text-center">
            <span class="text-[#E63946] font-black tracking-[0.6em] text-[10px] uppercase block mb-4">Executive
                Hierarchy</span>
            <h1 class="text-5xl md:text-7xl font-black text-white uppercase tracking-tighter mb-2">Kabinet Daniswara
            </h1>
            <p class="text-slate-400 font-bold text-xl tracking-[0.3em]">PERIODE 2025/2026</p>
            <div
                class="mt-8 inline-block px-6 py-2 border border-white/10 rounded-full text-white/40 text-[9px] font-black uppercase tracking-widest">
                Musik Untuk Semua
            </div>
        </div>
    </section>

    {{-- ORGANIZATIONAL TREE --}}
    <section class="py-20 bg-slate-50 overflow-x-auto">
        <div class="min-w-[1000px] tree-container">
            <ul>
                <li>
                    {{-- TOP: KETUA UMUM --}}
                    <div
                        class="inline-block p-6 bg-[#0A192F] text-white rounded-2xl shadow-xl border-b-4 border-[#E63946]">
                        <p class="text-[9px] font-black text-[#E63946] uppercase tracking-widest mb-1">Ketua Umum</p>
                        <h4 class="font-black uppercase tracking-tight">Daffa Ahmad</h4>
                        <p class="text-[10px] opacity-50">UKMBSM-22-001</p>
                    </div>

                    <ul>
                        <li>
                            {{-- WAKIL KETUA --}}
                            <div class="inline-block p-5 bg-white border-2 border-slate-200 rounded-2xl shadow-sm">
                                <p class="text-[9px] font-black text-[#457B9D] uppercase tracking-widest mb-1">Wakil
                                    Ketua</p>
                                <h4 class="font-black text-[#0A192F] uppercase">Siti Sarah</h4>
                                <p class="text-[10px] text-slate-400">UKMBSM-22-014</p>
                            </div>

                            <ul>
                                {{-- DEPARTEMEN BRANCHES --}}
                                <li>
                                    <div
                                        class="p-4 bg-slate-200 rounded-xl text-[10px] font-black uppercase tracking-tighter text-slate-600">
                                        Sekretaris & Bendahara</div>
                                    <ul>
                                        <li>
                                            <div class="p-3 bg-white border border-slate-200 rounded-lg">
                                                <p class="text-[8px] font-bold text-slate-400 uppercase">Sekum</p>
                                                <p class="font-black text-[11px]">Rizky Ramadhan</p>
                                                <p class="text-[9px] text-slate-300">UKMBSM-23-045</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="p-3 bg-white border border-slate-200 rounded-lg">
                                                <p class="text-[8px] font-bold text-slate-400 uppercase">Benum</p>
                                                <p class="font-black text-[11px]">Amanda Putri</p>
                                                <p class="text-[9px] text-slate-300">UKMBSM-23-012</p>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                {{-- DEPARTEMEN UTAMA --}}
                                <li>
                                    <div
                                        class="p-4 bg-[#457B9D] rounded-xl text-[10px] font-black uppercase tracking-widest text-white shadow-lg shadow-[#457B9D]/20">
                                        Departemen Internal</div>
                                    <ul>
                                        <li>
                                            <div
                                                class="p-2 border-l-2 border-[#457B9D] text-[9px] font-bold text-slate-500 uppercase">
                                                Divisi PSDM</div>
                                        </li>
                                        <li>
                                            <div
                                                class="p-2 border-l-2 border-[#457B9D] text-[9px] font-bold text-slate-500 uppercase">
                                                Divisi Inventaris</div>
                                        </li>
                                    </ul>
                                </li>

                                <li>
                                    <div
                                        class="p-4 bg-[#0A192F] rounded-xl text-[10px] font-black uppercase tracking-widest text-white shadow-lg">
                                        Departemen Eksternal</div>
                                    <ul>
                                        <li>
                                            <div
                                                class="p-2 border-l-2 border-[#0A192F] text-[9px] font-bold text-slate-500 uppercase">
                                                Divisi Humas</div>
                                        </li>
                                        <li>
                                            <div
                                                class="p-2 border-l-2 border-[#0A192F] text-[9px] font-bold text-slate-500 uppercase">
                                                Divisi Media</div>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </section>

    {{-- LIST ANGGOTA PER DIVISI --}}
    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex items-center gap-4 mb-12">
                <h2 class="text-3xl font-black text-[#0A192F] uppercase tracking-tighter">Daftar Anggota</h2>
                <div class="flex-1 h-[2px] bg-slate-100"></div>
                <span class="text-[#E63946] text-[10px] font-black tracking-[0.3em] uppercase">Musik Untuk Semua</span>
            </div>

            @php
                $departments = [
                    'Internal' => [
                        'PSDM' => [
                            ['nama' => 'Andi Wijaya', 'kode' => 'UKMBSM-23-001'],
                            ['nama' => 'Budi Santoso', 'kode' => 'UKMBSM-23-005'],
                            ['nama' => 'Citra Lestari', 'kode' => 'UKMBSM-23-019'],
                        ],
                        'Inventaris' => [
                            ['nama' => 'Deni Setiawan', 'kode' => 'UKMBSM-24-002'],
                            ['nama' => 'Eka Rahma', 'kode' => 'UKMBSM-24-010'],
                        ],
                    ],
                    'Eksternal' => [
                        'Humas' => [
                            ['nama' => 'Fajar Pratama', 'kode' => 'UKMBSM-23-088'],
                            ['nama' => 'Gita Gutawa', 'kode' => 'UKMBSM-24-055'],
                        ],
                        'Media' => [
                            ['nama' => 'Hendra Kurnia', 'kode' => 'UKMBSM-23-022'],
                            ['nama' => 'Indah Permata', 'kode' => 'UKMBSM-24-011'],
                        ],
                    ],
                ];
            @endphp

            <div class="grid md:grid-cols-2 gap-12">
                @foreach ($departments as $deptName => $divisis)
                    <div class="space-y-8">
                        <h3 class="text-xl font-black text-white bg-[#0A192F] px-6 py-2 rounded-lg inline-block">Dept.
                            {{ $deptName }}</h3>

                        @foreach ($divisis as $divName => $members)
                            <div class="relative pl-6 border-l-4 border-slate-100">
                                <h4 class="text-[#457B9D] font-black uppercase text-xs tracking-widest mb-4">Divisi
                                    {{ $divName }}</h4>
                                <div class="bg-slate-50 rounded-2xl p-6 shadow-sm border border-slate-100">
                                    <table class="w-full text-left">
                                        <thead>
                                            <tr class="text-[10px] font-black text-slate-400 uppercase tracking-widest">
                                                <th class="pb-4">Nama Lengkap</th>
                                                <th class="pb-4 text-right">Kode</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-slate-200">
                                            @foreach ($members as $member)
                                                <tr class="group">
                                                    <td
                                                        class="py-3 text-sm font-bold text-[#0A192F] group-hover:text-[#E63946] transition-colors">
                                                        {{ $member['nama'] }}</td>
                                                    <td class="py-3 text-[11px] font-mono text-slate-500 text-right">
                                                        {{ $member['kode'] }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- SIGNATURE --}}
    <footer class="py-12 bg-slate-50 border-t border-slate-200 text-center">
        <p class="text-[9px] font-black text-slate-400 uppercase tracking-[1.5em]">MUSIK UNTUK SEMUA • UKMBSM ITERA</p>
    </footer>

</x-public.layouts>
