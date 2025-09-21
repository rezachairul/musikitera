<!-- Modal Tambah Data -->
<div id="AddModal" class="hidden fixed inset-0 z-50 bg-black/50 items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg w-full max-w-lg p-6 relative">
        <!-- Header -->
        <div class="flex items-center gap-2 mb-4">
            <svg  xmlns="http://www.w3.org/2000/svg"  fill="none"  viewBox="0 0 24 24"  stroke-width="1.5"  stroke="currentColor"  class="size-6 text-gray-500">
                <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
            </svg>
            <h2 id="modalTitle" class="text-lg font-semibold text-gray-800">Tambah {{ $title }}</h2>
        </div>

        <!-- Form Create -->
        <form id="addForm" method="POST" action="{{ route('manage-user.store') }}" enctype="multipart/form-data">
            @csrf
            <!-- Nama -->
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                <input type="text" name="name" id="name"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Masukan Nama" required>
            </div>
            <!-- Role -->
            <div class="mb-4">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Role</label>
                <select name="role" id="role"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent text-sm"
                    required>
                    <option value="">-- Pilih Role --</option>
                    <option value="admin">Administrator</option>
                    <option value="bph">Badan Pengurus</option>
                    <option value="dpo">Dewan Pengawas</option>
                    <option value="pembina">Pembina</option>
                </select>
            </div>
            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" id="email" readonly
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Email akan terisi otomatis" required>
            </div>
            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                <input type="password" name="password" id="password"
                    class="w-full px-3 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="********" required>
            </div>

            <!-- Tombol -->
            <div class="flex justify-end space-x-2 mt-6">
                <!-- Tombol Batal -->
                <button type="button" onclick="closeAddModal()"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-gray-600 bg-gray-100 rounded-lg hover:bg-gray-200 transition">
                    <!-- Icon X -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                    Batal
                </button>

                <!-- Tombol Simpan -->
                <button type="submit"
                    class="flex items-center gap-1 px-4 py-2 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                    <!-- Icon Save -->
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13l4 4L19 7" />
                    </svg>
                    Simpan
                </button>
            </div>
            <!-- Script untuk mengisi email otomatis berdasarkan nama dan role -->
            <script>
                const nameInput = document.getElementById('name');
                const roleSelect = document.getElementById('role');
                const emailInput = document.getElementById('email');

                function generateEmail() {
                    const nameValue = nameInput.value.trim().split(" ")[0].toLowerCase(); // ambil nama depan
                    const roleValue = roleSelect.value;
                    if (nameValue && roleValue) {
                        emailInput.value = `${nameValue}.${roleValue}@ukmbsm.itera.ac.id`;
                    } else {
                        emailInput.value = '';
                    }
                }
                nameInput.addEventListener('input', generateEmail);
                roleSelect.addEventListener('change', generateEmail);
            </script>
        </form>
        <!-- Tombol X di pojok -->
        <button onclick="closeAddModal()" class="absolute top-3 right-3 text-gray-400 hover:text-gray-600">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>
</div>
