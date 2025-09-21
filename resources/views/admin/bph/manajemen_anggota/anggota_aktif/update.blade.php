<!-- Modal Edit Data -->
@foreach($anggota_aktifs as $anggota_aktif)
<div id="UpdateModal-{{ $anggota_aktif->id }}" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            </svg>

            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Update -->
        <form method="POST" action="{{ route('anggota-aktif.update', $anggota_aktif->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Nama -->
            <div class="mb-4">
                <label for="name-{{ $anggota_aktif->id }}" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="name" id="name-update-{{ $anggota_aktif->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ $anggota_aktif->name }}" required>
            </div>
            <!-- Role -->
            <div class="mb-4">
                <label for="role-{{ $anggota_aktif->id }}" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="role-update-{{ $anggota_aktif->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin" {{ $anggota_aktif->role == 'admin' ? 'selected' : '' }}>Administrator</option>
                    <option value="bph" {{ $anggota_aktif->role == 'bph' ? 'selected' : '' }}>Badan Pengurus</option>
                    <option value="dpo" {{ $anggota_aktif->role == 'dpo' ? 'selected' : '' }}>Dewan Pengawas</option>
                    <option value="pembina" {{ $anggota_aktif->role == 'pembina' ? 'selected' : '' }}>Pembina</option>
                </select>
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email-{{ $anggota_aktif->id }}" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email-update-{{ $anggota_aktif->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    value="{{ $anggota_aktif->email }}" required>
            </div>
            <!-- Password (Optional / Kosongkan jika tidak diubah) -->
            <div class="mb-4">
                <label for="password-{{ $anggota_aktif->id }}" class="block text-sm font-medium text-gray-700 mb-2">Password (kosongkan jika tidak diubah)</label>
                <input type="password" name="password" id="password-{{ $anggota_aktif->id }}"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukan password baru">
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <!-- Tombol Batal -->
                <button type="button" onclick="closeUpdateModal('{{ $anggota_aktif->id }}')"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <!-- Icon X -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>

                <!-- Tombol Update -->
                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-white bg-amber-600 rounded-lg hover:bg-amber-700 transition">
                    <!-- Icon Update -->
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0  3.181 3.183a8.25 8.25 0 0 0 13.803-3.7M4.031 9.865a8.25 8.25 0 0 1  13.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Update
                </button>
            </div>
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    const nameUpdate = document.getElementById('name-update-{{ $anggota_aktif->id }}');
                    const roleUpdate = document.getElementById('role-update-{{ $anggota_aktif->id }}');
                    const emailUpdate = document.getElementById('email-update-{{ $anggota_aktif->id }}');

                    function generateEmailUpdate() {
                        const nameValue = nameUpdate.value.trim().split(" ")[0].toLowerCase();
                        const roleValue = roleUpdate.value;
                        if (nameValue && roleValue) {
                            emailUpdate.value = `${nameValue}.${roleValue}@ukmbsm.itera.ac.id`;
                        } else {
                            emailUpdate.value = '';
                        }
                    }

                    // Event ketika modal dibuka → trigger update email
                    const observer = new MutationObserver(() => {
                        if (!nameUpdate || !roleUpdate) return;
                        generateEmailUpdate();
                    });

                    const modal = document.getElementById('UpdateModal-{{ $anggota_aktif->id }}');
                    if (modal) {
                        observer.observe(modal, {
                            attributes: true,
                            attributeFilter: ['class']
                        });
                    }

                    nameUpdate.addEventListener('input', generateEmailUpdate);
                    roleUpdate.addEventListener('change', generateEmailUpdate);
                });
            </script>
        </form>

        <!-- Tombol X di pojok -->
        <button onclick="closeUpdateModal('{{ $anggota_aktif->id }}')" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
@endforeach
