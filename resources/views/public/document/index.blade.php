<x-public.layouts
    :title="$title"
    :description="$description"
    :keywords="$keywords"
    :author="$author"
    >
    <x-slot:title>Dokumen</x-slot:title>

    <div class="relative min-h-screen bg-white py-8 md:py-16 overflow-hidden font-sans">
        {{-- Background Element: Garis Musik (Staff Lines) Full Page --}}
        <div class="absolute inset-0 opacity-[0.05] pointer-events-none">
            <svg width="100%" height="100%" xmlns="http://www.w3.org/2000/svg">
                <defs>
                    <pattern id="staff-full-document" width="100" height="40" patternUnits="userSpaceOnUse">
                        <path d="M0 8 L100 8 M0 16 L100 16 M0 24 L100 24 M0 32 L100 32" stroke="#0A192F" stroke-width="1"
                            fill="none" />
                    </pattern>
                </defs>
                <rect width="100%" height="100%" fill="url(#staff-full-document)" />
            </svg>
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">

            {{-- HEADER SECTION --}}
            <div class="mb-16">
                <div class="inline-flex items-center gap-3 mb-4">
                    <span class="h-[2px] w-8 bg-[#E63946]"></span>
                    <span class="text-[#457B9D] text-xs font-black uppercase tracking-[0.4em]">Resource Center</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-[#0A192F] uppercase tracking-tighter leading-tight">
                    Pustaka <span class="text-[#457B9D]">Arsip</span>
                </h1>
                <p class="mt-4 text-slate-500 max-w-2xl text-sm md:text-base font-medium leading-relaxed">
                    Akses cepat ke seluruh berkas administratif, panduan operasional, dan dokumentasi tertulis UKM Seni
                    Musik ITERA melalui integrasi Google Drive.
                </p>
            </div>

            {{-- SEARCH & FILTER (Simplified) --}}
            <div class="flex flex-col md:flex-row gap-4 mb-12">
                <div class="relative flex-1">
                    <input type="text" placeholder="Cari judul dokumen..."
                        class="w-full pl-12 pr-6 py-4 rounded-2xl border-2 border-slate-100 bg-slate-50 text-slate-900 focus:bg-white focus:border-[#457B9D] transition-all outline-none">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5 absolute left-4 top-1/2 -translate-y-1/2 text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <div class="flex gap-2">
                    <button
                        class="px-6 py-4 bg-[#0A192F] text-white rounded-2xl text-xs font-black uppercase tracking-widest hover:bg-[#E63946] transition-colors">Semua</button>
                    <button
                        class="px-6 py-4 bg-white border-2 border-slate-100 text-slate-400 rounded-2xl text-xs font-black uppercase tracking-widest hover:border-[#457B9D] hover:text-[#457B9D] transition-all">Terbaru</button>
                </div>
            </div>

            {{-- DOCUMENT GRID --}}
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($documents as $doc)
                    <article
                        class="group bg-white rounded-[2rem] border-2 border-slate-100 p-8 hover:border-[#457B9D] hover:shadow-2xl hover:shadow-[#457B9D]/10 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">

                        {{-- HEADER META --}}
                        <div class="flex items-center justify-between mb-6 text-[11px] font-bold uppercase tracking-widest">
                            {{-- Created At (Left) --}}
                            <span class="text-slate-400">
                                {{ $doc->created_at?->format('d M Y') }}
                            </span>

                            {{-- Category (Right) --}}
                            <span
                                class="px-3 py-1 bg-slate-100 text-slate-500 rounded-lg group-hover:bg-[#457B9D] group-hover:text-white transition-colors">
                                {{ $doc->kategori ?? 'Tanpa Kategori' }}
                            </span>
                        </div>

                        {{-- FILE TYPE PREVIEW ICON --}}
                        <div class="flex items-center justify-center mb-6">
                            <div
                                class="w-20 h-24 rounded-xl bg-slate-50 border border-slate-100 flex flex-col items-center justify-center group-hover:scale-105 transition-transform relative">
                                {{-- Badge Type --}}
                                <span class="absolute -top-2 -right-2 {{ $doc->badge_color }} text-white text-[9px] font-black px-2 py-1 rounded-md shadow">
                                    {{ strtoupper($doc->file_type) }}
                                </span>

                                {{-- Icon File --}}
                                @switch($doc->icon_type)
                                    @case('pdf')
                                        {{-- ICON PDF --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                                        </svg>
                                        @break
                                    @case('doc')
                                        {{-- ICON DOC --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> 
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m2.25 0H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" /> 
                                        </svg>
                                        @break
                                    @case('xls')
                                        {{-- ICON XLS --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> 
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.375 19.5h17.25m-17.25 0a1.125 1.125 0 0 1-1.125-1.125M3.375 19.5h7.5c.621 0 1.125-.504 1.125-1.125m-9.75 0V5.625m0 12.75v-1.5c0-.621.504-1.125 1.125-1.125m18.375 2.625V5.625m0 12.75c0 .621-.504 1.125-1.125 1.125m1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125m0 3.75h-7.5A1.125 1.125 0 0 1 12 18.375m9.75-12.75c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125m19.5 0v1.5c0 .621-.504 1.125-1.125 1.125M2.25 5.625v1.5c0 .621.504 1.125 1.125 1.125m0 0h17.25m-17.25 0h7.5c.621 0 1.125.504 1.125 1.125M3.375 8.25c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125m17.25-3.75h-7.5c-.621 0-1.125.504-1.125 1.125m8.625-1.125c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125M12 10.875v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 10.875c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125M13.125 12h7.5m-7.5 0c-.621 0-1.125.504-1.125 1.125M20.625 12c.621 0 1.125.504 1.125 1.125v1.5c0 .621-.504 1.125-1.125 1.125m-17.25 0h7.5M12 14.625v-1.5m0 1.5c0 .621-.504 1.125-1.125 1.125M12 14.625c0 .621.504 1.125 1.125 1.125m-2.25 0c.621 0 1.125.504 1.125 1.125m0 1.5v-1.5m0 0c0-.621.504-1.125 1.125-1.125m0 0h7.5" /> 
                                        </svg>
                                        @break
                                    @case('ppt')
                                        {{-- ICON PPT --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> 
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" /> 
                                        </svg>
                                        @break
                                    @case('txt')
                                        {{-- ICON TXT --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> 
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" /> 
                                        </svg>
                                        @break
                                    @default
                                        {{-- ICON DEFAULT --}}
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6"> 
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" /> 
                                        </svg>
                                @endswitch                                
                            </div>
                        </div>

                        {{-- CONTENT --}}
                        <div class="flex-1">
                            <h3
                                class="text-lg font-black text-[#0A192F] uppercase tracking-tight leading-tight mb-3 group-hover:text-[#457B9D] transition-colors line-clamp-2">
                                {{ $doc->judul ?? 'Judul Tidak Tersedia' }}
                            </h3>

                            <p class="text-slate-500 text-sm leading-relaxed line-clamp-3 mb-8">
                                {{ $doc->deskripsi ?? 'Deskripsi Tidak Tersedia' }}
                            </p>
                        </div>

                        {{-- ACTION --}}
                        <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank"
                            class="flex items-center justify-center gap-3 w-full py-4 bg-slate-50 text-[#0A192F] text-xs font-black uppercase tracking-[0.2em] rounded-xl group-hover:bg-[#0A192F] group-hover:text-white transition-all duration-300">
                            Lihat Dokumen
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 transform group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                        </a>
                    </article>
                @endforeach
                <!-- Jika Tidak ada Dokumen -->
                @if ($documents->isEmpty())
                    <div class="col-span-full text-center py-12">
                        <p class="text-slate-500 text-lg">Tidak ada dokumen tersedia saat ini.</p>
                    </div>
                @endif
            </div>
    </div>
</x-public.layouts>
