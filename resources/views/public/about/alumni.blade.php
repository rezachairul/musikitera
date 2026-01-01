<x-public.layouts>
    <x-slot:title>Alumni</x-slot:title>

    <section class="bg-white py-16 md:py-20">
        <div class="max-w-6xl mx-auto px-6">

            <div class="mb-8 md:mb-10">
                <span class="text-xs font-bold tracking-[0.3em] uppercase text-blue-600">
                    Alumni
                </span>

                <h1 class="mt-4 text-3xl md:text-4xl font-bold tracking-tight text-slate-900">
                    Alumni UKM Seni Musik ITERA
                </h1>

                <p class="mt-3 text-slate-600 max-w-3xl text-sm md:text-base leading-relaxed">
                    Daftar alumni UKMBSM ITERA dari berbagai angkatan. Tanpa foto, hanya nama, tahun lulus, dan
                    testimoni singkat.
                </p>
            </div>

            {{-- FILTER --}}
            <form method="GET" class="mb-8 grid md:grid-cols-12 gap-3">
                <div class="md:col-span-8">
                    <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama alumni…"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm">
                </div>

                <div class="md:col-span-2">
                    <input type="text" name="tahun" value="{{ request('tahun') }}" placeholder="Tahun lulus"
                        class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm">
                </div>

                <div class="md:col-span-2 flex gap-2">
                    <button
                        class="w-full rounded-xl bg-slate-900 text-white px-4 py-3 text-sm font-semibold hover:bg-slate-800">
                        Cari
                    </button>

                    <a href="{{ url()->current() }}"
                        class="w-full rounded-xl border border-slate-200 bg-white text-slate-900 px-4 py-3 text-sm font-semibold text-center hover:border-blue-300 hover:text-blue-700">
                        Reset
                    </a>
                </div>
            </form>

            {{-- INFO COUNT --}}
            <div class="mb-4 text-sm text-slate-600">
                Menampilkan
                <b class="text-slate-900">{{ $alumnis->firstItem() ?? 0 }}</b>–<b
                    class="text-slate-900">{{ $alumnis->lastItem() ?? 0 }}</b>
                dari <b class="text-slate-900">{{ $alumnis->total() ?? 0 }}</b> alumni
            </div>

            {{-- GRID LIST --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @forelse ($alumnis as $alumni)
                    @php
                        $nama = $alumni->anggota->nama ?? 'Tanpa Nama';
                        $initials = collect(explode(' ', $nama))
                            ->filter()
                            ->take(2)
                            ->map(fn($p) => mb_strtoupper(mb_substr($p, 0, 1)))
                            ->join('');
                    @endphp

                    <div class="rounded-3xl p-[1px] bg-gradient-to-br from-slate-200 via-slate-100 to-slate-200">
                        <div class="bg-white rounded-3xl border border-slate-100 p-5 flex gap-4">
                            <div class="flex-shrink-0">
                                <div
                                    class="h-14 w-14 rounded-2xl bg-slate-100 border border-slate-200 flex items-center justify-center font-bold text-slate-600">
                                    {{ $initials ?: 'A' }}
                                </div>
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-3">
                                    <h2 class="text-base md:text-lg font-semibold text-slate-900 truncate">
                                        {{ $nama }}
                                    </h2>

                                    @if ($alumni->tahun_lulus)
                                        <span class="text-[11px] px-3 py-1 rounded-full bg-slate-900/80 text-white">
                                            {{ $alumni->tahun_lulus }}
                                        </span>
                                    @endif
                                </div>

                                @if ($alumni->quote)
                                    <p class="mt-3 text-sm text-slate-600 leading-relaxed italic line-clamp-3">
                                        “{{ $alumni->quote }}”
                                    </p>
                                @else
                                    <p class="mt-3 text-sm text-slate-400 italic">
                                        Tidak ada testimoni.
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div
                        class="col-span-full rounded-2xl border border-slate-200 bg-slate-50 p-6 text-sm text-slate-700">
                        Belum ada data alumni yang ditampilkan.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $alumnis->links() }}
            </div>

        </div>
    </section>
</x-public.layouts>
