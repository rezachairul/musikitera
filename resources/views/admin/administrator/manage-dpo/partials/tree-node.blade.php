<style>
.tree-container ul {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 2rem;
    padding: 0;
}

.tree-container li {
    list-style: none;
    text-align: center;
}

.tree-container ul ul {
    margin-top: 2.5rem;
}
</style>

<li>
    {{-- NODE CARD --}}
    <div class="inline-block px-5 py-3 rounded-2xl shadow-md border-b-4 text-center
        @class([
            'bg-[#0A192F] text-white border-[#E63946]' => $node->jenis === 'koordinator',
            'bg-white border-[#457B9D]' => $node->jenis === 'sekretaris',
            'bg-slate-200 border-slate-400' => $node->jenis === 'komisi',
            'bg-slate-100 border-slate-300' => $node->jenis === 'staff',
        ])
    ">
        <p class="text-[9px] font-black uppercase tracking-widest opacity-70">
            {{ ucfirst($node->jenis) }}
        </p>
        <h4 class="font-black uppercase tracking-tight text-sm">
            {{ $node->nama }}
        </h4>
    </div>

    @php
        $sekretaris = $node->children->firstWhere('jenis', 'sekretaris');
        $komisis = $node->children->where('jenis', 'komisi')->sortBy('urutan');
    @endphp

    {{-- KHUSUS KOORDINATOR --}}
    @if ($node->jenis === 'koordinator')

        {{-- SEKRETARIS (SINGLE, KE BAWAH) --}}
        @if ($sekretaris)
            <ul>
                @include('admin.administrator.manage-dpo.partials.tree-node', ['node' => $sekretaris])
            </ul>
        @endif

        {{-- KOMISI (HORIZONTAL ROW) --}}
        @if ($komisis->count())
            <ul>
                @foreach ($komisis as $komisi)
                    <li>
                        @include('admin.administrator.manage-dpo.partials.tree-node', ['node' => $komisi])
                    </li>
                @endforeach
            </ul>
        @endif

    {{-- DEFAULT TREE NORMAL --}}
    @elseif ($node->children->count())
        <ul>
            @foreach ($node->children as $child)
                @include('admin.administrator.manage-dpo.partials.tree-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
