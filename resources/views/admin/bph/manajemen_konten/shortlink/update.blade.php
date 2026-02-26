<!-- Modal Update Data -->
@foreach ($shortlinks as $shortlink)
    <div id="UpdateModal-{{ $shortlink->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
        <div class="bg-white rounded-xl shadow-lg w-full max-w-2xl p-6 relative">
            <!-- Header -->
            <div class="flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                </svg>
                <h2 class="text-lg font-semibold text-gray-800">Update {{ $title }}</h2>
            </div>

            <!-- Form Update Short Link -->
            <div class="max-h-[80vh] overflow-y-auto px-4 py-2">
                <form id="editForm" method="POST" action="{{ route('manage-shortlink.update', $shortlink->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        {{-- URL ASLI + GENERATE --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">URL Asli</label>
                            <div class="flex gap-2">
                                <input id="originalUrl-{{ $shortlink->id }}" type="url" name="original_url" required value="{{ old('original_url', $shortlink->original_url ?? '') }}" class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500" placeholder="https://drive.google.com/...">

                                <button type="button" id="btnGenerateSlug-{{ $shortlink->id }}" class="flex items-center gap-2 bg-gray-200 px-4 py-2 rounded-lg hover:bg-gray-300 whitespace-nowrap" >
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                                    </svg>
                                    <span>Generate</span>
                                </button>
                            </div>
                        </div>

                        {{-- GENERATE SLUG --}}
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-2">Short Link</label>

                            <div class="flex gap-2">
                                <div class="flex items-center w-full border border-gray-200 rounded-lg overflow-hidden">
                                    <span class="px-3 text-sm text-gray-500 bg-gray-50">
                                        {{ url('/r/') }}/
                                    </span>

                                    <input type="text" name="slug" id="slugInput-{{ $shortlink->id }}"
                                        value="{{ old('slug', $shortlink->slug ?? '') }}"
                                        class="flex-1 px-3 py-2 focus:outline-none"
                                        placeholder="slug-otomatis" readonly>
                                    
                                    <button type="button" id="btnEditSlug-{{ $shortlink->id }}" class="px-3 text-amber-500 hover:text-amber-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>

                        {{-- STATUS --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Status</label>

                            <select name="is_hidden"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                                <option value="0" {{ old('is_hidden', $shortlink->is_hidden ?? 0) == 0 ? 'selected' : '' }}>
                                    Aktif
                                </option>
                                <option value="1" {{ old('is_hidden', $shortlink->is_hidden ?? 0) == 1 ? 'selected' : '' }}>
                                    Hidden
                                </option>
                            </select>

                            {{-- Info status aktual --}}
                            <p class="text-xs mt-1
                                {{ $shortlink->status === 'expired' ? 'text-red-500' : 'text-gray-500' }}">
                                Status saat ini: 
                                <span class="font-semibold">{{ $shortlink->status_label }}</span>
                            </p>
                        </div>

                        {{-- EXPIRED DATE --}}
                        <div>
                            <label class="block text-sm font-medium mb-2">Expired Date (Opsional)</label>
                            <input type="date" name="expired_at"
                                value="{{ old('expired_at', isset($shortlink->expired_at) ? \Carbon\Carbon::parse($shortlink->expired_at)->format('Y-m-d') : '') }}"
                                class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500">
                            <p class="text-xs text-red-500 mt-1">
                                Kosongkan untuk default 3 bulan.
                            </p>
                        </div>

                    </div>

                    <!-- Script Generate Short Link by Slug-->
                    <script>
                        document.addEventListener('click', function (e) {

                            // GENERATE SLUG
                            if (e.target.closest('[id^="btnGenerateSlug-"]')) {
                                const btn = e.target.closest('button');
                                const id = btn.id.replace('btnGenerateSlug-', '');
                                const originalUrlInput = document.getElementById('originalUrl-' + id);
                                const slugInput = document.getElementById('slugInput-' + id);

                                if (!originalUrlInput || originalUrlInput.value.trim() === '') {
                                    return; // jangan alert, biar konsisten sama create (disable logic)
                                }

                                slugInput.value = generateSlug();
                                slugInput.setAttribute('readonly', true);
                            }

                            // EDIT SLUG
                            if (e.target.closest('[id^="btnEditSlug-"]')) {
                                const btn = e.target.closest('button');
                                const id = btn.id.replace('btnEditSlug-', '');
                                const slugInput = document.getElementById('slugInput-' + id);

                                slugInput.removeAttribute('readonly');
                                slugInput.focus();
                            }
                        });

                        document.addEventListener('input', function (e) {
                            if (e.target.id.startsWith('originalUrl-')) {
                                const id = e.target.id.replace('originalUrl-', '');
                                const btnGenerate = document.getElementById('btnGenerateSlug-' + id);

                                if (e.target.value.trim() === '') {
                                    btnGenerate.disabled = true;
                                    btnGenerate.classList.add('opacity-50', 'cursor-not-allowed');
                                } else {
                                    btnGenerate.disabled = false;
                                    btnGenerate.classList.remove('opacity-50', 'cursor-not-allowed');
                                }
                            }
                        });

                        function generateSlug(length = 6) {
                            const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                            let slug = '';
                            for (let i = 0; i < length; i++) {
                                slug += chars.charAt(Math.floor(Math.random() * chars.length));
                            }
                            return slug;
                        }
                    </script>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end space-x-2 mt-6">
                        <button type="button" onclick="closeUpdateModal('{{ $shortlink->id }}')"
                            class="px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200">
                            Batal
                        </button>
                        <button class="bg-amber-600 text-white px-4 py-2 rounded-lg hover:bg-amber-700 transition">
                            {{ isset($shortlink) ? 'Update Shortlink' : 'Simpan Shortlink' }}
                        </button>
                    </div>
                </form>
            </div>

            <!-- Tombol X di pojok -->
            <button onclick="closeUpdateModal('{{ $shortlink->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>
@endforeach

