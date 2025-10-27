<x-admin.bph.layouts>
    <x-slot:title>Kelola {{ $title }}</x-slot:title>

    <div class="max-w-5xl mx-auto bg-white p-6 md:p-10 rounded-lg shadow-md mt-6">
        <h1 class="text-xl font-semibold text-gray-800 mb-6">
            Profil Organisasi
        </h1>

        <form action="{{ $profile ? route('manage-profile.update', $profile->id) : route('manage-profile.store') }}" 
              method="POST" enctype="multipart/form-data">
            @csrf
            @if($profile)
                @method('PUT')
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Nama Organisasi -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Organisasi</label>
                    <input type="text" name="nama" value="{{ old('nama', $profile->nama ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                        placeholder="Masukkan nama organisasi" required>
                </div>

                <!-- Tagline -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                    <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline ?? '') }}"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                        placeholder="Contoh: Bersama Membangun Negeri">
                </div>

                <!-- Deskripsi -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
                    <textarea name="deskripsi" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                        placeholder="Tulis deskripsi organisasi...">{{ old('deskripsi', $profile->deskripsi ?? '') }}</textarea>
                </div>

                <!-- Alamat -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                    <textarea name="alamat" rows="2"
                        class="w-full px-3 py-2 border border-gray-300 rounded-lg"
                        placeholder="Masukkan alamat organisasi">{{ old('alamat', $profile->alamat ?? '') }}</textarea>
                </div>

                <!-- Wrapper Semua Kontak -->                        
                <!-- ================= Kontak Internal ================= -->
                <div class="space-y-3 w-full md:pl-6">
                    <h3 class="font-semibold text-gray-800 text-center">Kontak Internal</h3>
                    <div id="kontak-internal" class="space-y-2">
                        <div class="flex items-center gap-2">
                        <input type="text" name="kontak_internal_nama[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                            placeholder="Nama">
                        <input type="text" name="kontak_internal_no[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                            placeholder="08xxx">
                        </div>
                    </div>
                    <button type="button" id="add-internal"
                        class="block text-sm text-blue-600 hover:underline text-center mx-auto">
                        + Tambah Kontak Internal
                    </button>
                </div>

                <!-- ================= Kontak Eksternal ================= -->
                <div class="space-y-3 w-full md:pr-6">
                    <h3 class="font-semibold text-gray-800 text-center">Kontak Eksternal</h3>
                    <div id="kontak-eksternal" class="space-y-2">
                        <div class="flex items-center gap-2">
                        <input type="text" name="kontak_eksternal_nama[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                            placeholder="Nama">
                        <input type="text" name="kontak_eksternal_no[]"
                            class="flex-1 px-3 py-2 border border-gray-300 rounded-lg"
                            placeholder="08xxx">
                        </div>
                    </div>
                    <button type="button" id="add-eksternal"
                        class="block text-sm text-blue-600 hover:underline text-center mx-auto">
                        + Tambah Kontak Eksternal
                    </button>
                </div>

                <!-- Foto -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Foto Profile</label>
                    @if(isset($profile->foto))
                        <img src="{{ asset('storage/'.$profile->foto) }}" class="w-32 h-32 mb-2 rounded-lg object-cover">
                    @endif
                    <input type="file" name="foto" accept="image/*"
                        class="w-full text-sm border border-gray-300 rounded-lg">
                </div>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                    {{ $profile ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>

    <script>
        // Fungsi buat field dengan tombol hapus
        function createContactField(type) {
            const div = document.createElement('div');
            div.classList.add('flex', 'items-center', 'gap-2', 'mb-2');

            div.innerHTML = `
                <input type="text" name="kontak_${type}_nama[]" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg" placeholder="Nama">
                <input type="text" name="kontak_${type}_no[]" class="w-1/2 px-3 py-2 border border-gray-300 rounded-lg" placeholder="08xxx">
                <button type="button" class="text-red-500 hover:text-red-700 font-bold remove-field">×</button>
            `;
            return div;
        }

        // Tambah kontak internal
        document.getElementById('add-internal').addEventListener('click', function () {
            const field = createContactField('internal');
            document.getElementById('kontak-internal').appendChild(field);
        });

        // Tambah kontak eksternal
        document.getElementById('add-eksternal').addEventListener('click', function () {
            const field = createContactField('eksternal');
            document.getElementById('kontak-eksternal').appendChild(field);
        });

        // Event hapus field
        document.addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-field')) {
                e.target.parentElement.remove();
            }
        });
    </script>

</x-admin.bph.layouts>
