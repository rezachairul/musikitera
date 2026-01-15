<style>
.tree-container ul {
    display: flex;
    justify-content: center;
    gap: 2.5rem;
    margin-top: 2.5rem;
    padding: 0;
}

.tree-container li {
    list-style: none;
    text-align: center;
}

.tree-container ul ul {
    margin-top: 3rem;
}
</style>

<li>
    {{-- NODE CARD --}}
    <div class="
        inline-block px-5 py-3 rounded-2xl shadow-md border-b-4 text-center
        @class([
            'bg-[#0A192F] text-white border-[#E63946]' => $node->jenis === 'ketum',
            'bg-white border-[#457B9D]' => $node->jenis === 'sekjen',
            'bg-slate-100 border-slate-400' => in_array($node->jenis, ['sekum','bendum']),
            'bg-slate-200 border-slate-500' => in_array($node->jenis, ['kadep','sekdep']),
            'bg-slate-300 border-slate-600' => in_array($node->jenis, ['kadiv','sekdiv']),
            'bg-slate-50 border-slate-300' => $node->jenis === 'staff',
        ])
    ">
        <p class="text-[9px] font-black uppercase tracking-widest opacity-70">
            {{ strtoupper($node->jenis) }}
        </p>
        <h4 class="font-black uppercase tracking-tight text-sm">
            {{ $node->nama }}
        </h4>
    </div>

    @php
        $children = $node->children->sortBy('urutan');

        $sekumBendum = $children->whereIn('jenis', ['sekum','bendum']);
        $departemen  = $children->where('jenis', 'kadep');
        $divisi      = $children->where('jenis', 'kadiv');
        $staff       = $children->where('jenis', 'staff');
    @endphp

    {{-- KETUM → SEKJEN (VERTIKAL) --}}
    @if ($node->jenis === 'ketum' && $children->count())
        <ul class="flex flex-col items-center gap-6 mt-6">
            @foreach ($children as $child)
                @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $child])
            @endforeach
        </ul>

    {{-- SEKJEN (SEMUA CHILD, DIKELOMPOKKAN VISUAL) --}}
    @elseif ($node->jenis === 'sekjen')

        {{-- SEKUM & BENDUM --}}
        @if ($sekumBendum->count())
            <ul>
                @foreach ($sekumBendum as $sb)
                    @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $sb])
                @endforeach
            </ul>
        @endif

        {{-- DEPARTEMEN --}}
        @if ($departemen->count())
            <ul>
                @foreach ($departemen as $dep)
                    @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $dep])
                @endforeach
            </ul>
        @endif

        {{-- DIVISI --}}
        @if ($divisi->count())
            <ul>
                @foreach ($divisi as $div)
                    @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $div])
                @endforeach
            </ul>
        @endif

        {{-- STAFF --}}
        @if ($staff->count())
            <ul>
                @foreach ($staff as $st)
                    @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $st])
                @endforeach
            </ul>
        @endif

    {{-- DEFAULT (DEPARTEMEN → DIVISI → STAFF REAL CHILD) --}}
    @elseif ($children->count())
        <ul>
            @foreach ($children as $child)
                @include('admin.administrator.manage-bph.partials.tree-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
