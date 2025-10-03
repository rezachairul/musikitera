
// ==================================
// DEKLARASI GLOBAL (PENTING!)
// ==================================
// Pastikan baris ini ada di luar fungsi, di bagian paling atas script JS kamu
let currentObjectURL = {}; 

// ==================================
// Untuk UPDATE (Sudah Diperbaiki)
// ==================================
function EditPreviewDoc(id) {
    const input = document.getElementById(`edit_file-${id}`);
    const previewWrapper = document.getElementById(`filePreview-${id}`);
    const previewContent = document.getElementById(`previewContent-${id}`);
    const oldPreview = document.getElementById(`oldPreviewContent-${id}`);
    const errorMsg = document.getElementById(`edit_fileError-${id}`);

    // Tambahkan pengecekan ini untuk mencegah error jika elemen tidak ditemukan
    if (!input || !previewWrapper || !previewContent || !oldPreview || !errorMsg) {
        console.error(`Elemen preview tidak lengkap untuk ID: ${id}`);
        return;
    }

    // 1. Bersihkan URL objek lama jika ada
    if (currentObjectURL[id]) {
        URL.revokeObjectURL(currentObjectURL[id]);
        currentObjectURL[id] = null;
    }

    const file = input.files[0];

    // Reset error dan preview baru
    errorMsg.classList.add("hidden");
    errorMsg.textContent = "";
    previewContent.innerHTML = "";
    previewContent.classList.add("hidden");

    
    // ===================================
    // KASUS 1: Tidak ada file dipilih (Batalkan)
    // ===================================
    if (!file) {
        // Tampilkan preview lama (jika konten di dalamnya ada)
        if (oldPreview.children.length > 0) {
            oldPreview.classList.remove("hidden");
            previewWrapper.classList.remove("hidden");
        } else {
            // Jika tidak ada file lama, sembunyikan wrapper
            previewWrapper.classList.add("hidden");
        }
        return;
    }

    // ===================================
    // KASUS 2: Ada file baru dipilih
    // ===================================
    
    // **TINDAKAN PENTING:** Sembunyikan preview lama saat file baru dipilih
    oldPreview.classList.add("hidden");
    previewWrapper.classList.remove("hidden"); // Pastikan Wrapper utama Tampil

    // 2. Validasi Ukuran (Max 5MB) - Hanya ada satu blok validasi ukuran
    if (file.size > 5 * 1024 * 1024) {
        errorMsg.textContent = "File terlalu besar, maksimal 5MB.";
        errorMsg.classList.remove("hidden");
        input.value = ""; // Hapus file yang dipilih
        oldPreview.classList.remove("hidden"); // Kembalikan preview lama
        return;
    }

    // 3. Validasi Tipe File
    const allowedTypes = [
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "application/vnd.ms-powerpoint",
        "application/vnd.openxmlformats-officedocument.presentationml.presentation"
    ];

    if (!allowedTypes.includes(file.type)) {
        errorMsg.textContent = "Hanya file PDF, Word, Excel, dan PowerPoint yang diperbolehkan.";
        errorMsg.classList.remove("hidden");
        input.value = ""; // Bersihkan input file
        oldPreview.classList.remove("hidden"); // Kembalikan preview lama
        return;
    }

    // 4. Tampilkan Preview Baru
    const fileURL = URL.createObjectURL(file);
    currentObjectURL[id] = fileURL; // Simpan URL untuk pembersihan

    // Logic Tampilan Preview (PDF vs Non-PDF)
    if (file.type === "application/pdf") {
        previewContent.innerHTML = `
            <iframe src="${fileURL}" class="w-full h-96 border rounded-lg"></iframe>
        `;
    } else {
        // Tampilan untuk Word/Excel/PPT
        previewContent.innerHTML = `
            <div class="flex items-center gap-3 p-2">
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 2a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V7.414a2 2 0 00-.586-1.414l-4.414-4.414A2 2 0 0011.586 1H4zm5 9l-1.5 4-1.5-4H4l2.5 7h2L11 11H9z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-800">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                </div>
            </div>
        `;
    }

    // Pastikan preview baru tampil
    previewContent.classList.remove("hidden");
}