<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>

    <div class="max-w-5xl mx-auto mt-8 space-y-6">

        {{-- ================= CARD VISI ================= --}}
        @if($visi)
            <div class="bg-white rounded-xl shadow p-6 border-l-4 border-blue-600">
                <h2 class="text-lg font-semibold text-gray-800 mb-2">Visi Saat Ini</h2>
                <p class="text-gray-700 leading-relaxed">
                    {{ $visi->visi }}
                </p>
            </div>
        @endif


        {{-- ================= FORM VISI & MISI ================= --}}
        <div class="bg-white rounded-xl shadow-md p-6 md:p-8">
            <h1 class="text-xl font-semibold text-gray-800 mb-6">
                {{ $visi ? 'Edit Visi & Misi' : 'Tambah Visi & Misi' }}
            </h1>

            <form action="{{ $visi ? route('manage-visi-misi.update', $visi->id) : route('manage-visi-misi.store') }}"
                  method="POST">
                @csrf
                @if($visi)
                    @method('PUT')
                @endif

                {{-- ================= INPUT VISI ================= --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Visi
                    </label>
                    <textarea name="visi" rows="3"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring focus:ring-blue-200"
                        placeholder="Masukkan visi organisasi..."
                        required>{{ old('visi', $visi->visi ?? '') }}</textarea>
                </div>


                {{-- ================= MISI ================= --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-3">
                        Misi
                    </label>

                    <div id="misi-wrapper" class="space-y-3">

                        @php
                            $oldMisi = old('misi');
                            $dataMisi = $oldMisi ?? ($visi->misis ?? []);
                        @endphp

                        @if(!empty($dataMisi) && count($dataMisi) > 0)
                            @foreach($dataMisi as $item)
                                <div class="flex items-start gap-2">
                                    <input type="text" name="misi[]"
                                        value="{{ is_object($item) ? $item->misi : $item }}"
                                        class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                                        placeholder="Masukkan misi..."
                                        required>
                                    <button type="button"
                                        class="remove-misi text-red-500 hover:text-red-700 font-bold text-lg">
                                        ×
                                    </button>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-start gap-2">
                                <input type="text" name="misi[]"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                                    placeholder="Masukkan misi..."
                                    required>
                            </div>
                        @endif

                    </div>

                    <button type="button" id="add-misi"
                        class="mt-3 text-sm text-blue-600 hover:underline">
                        + Tambah Misi
                    </button>
                </div>


                {{-- ================= BUTTON ================= --}}
                <div class="flex justify-end mt-8">
                    <button type="submit"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-md shadow hover:bg-blue-700 transition">
                        {{ $visi ? 'Update Visi & Misi' : 'Simpan Visi & Misi' }}
                    </button>
                </div>
            </form>
        </div>

    </div>


    {{-- ================= SCRIPT MISI ================= --}}
    <script>
        const wrapper = document.getElementById('misi-wrapper');
        const addBtn = document.getElementById('add-misi');

        function createMisiField() {
            const div = document.createElement('div');
            div.className = 'flex items-start gap-2';
            div.innerHTML = `
                <input type="text" name="misi[]"
                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                    placeholder="Masukkan misi..." required>
                <button type="button"
                    class="remove-misi text-red-500 hover:text-red-700 font-bold text-lg">×</button>
            `;
            return div;
        }

        addBtn.addEventListener('click', function () {
            wrapper.appendChild(createMisiField());
        });

        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-misi')) {
                e.target.parentElement.remove();
            }
        });
    </script>

</x-admin.bph.layouts>
