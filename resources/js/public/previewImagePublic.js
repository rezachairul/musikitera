/**
 * =============================
 * Preview & Validasi Foto (Versi PUBLIC)
 * =============================
 * Dipakai untuk form publik seperti Oprec UKMBSM, pendaftaran, dll.
 */

function previewImagePublic(input) {
    const previewContainer = document.getElementById("photo-preview-public");
    const previewImg = document.getElementById("preview-img-public");
    const errorMsg = document.getElementById("foto-error-public");
    const uploadText = document.getElementById("upload-text-public");

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // ✅ Validasi ukuran maksimum (2MB)
        if (file.size > 2 * 1024 * 1024) {
            showError("Ukuran foto lebih dari 2MB, silakan pilih ulang.");
            resetPreview();
            return;
        }

        // ✅ Validasi format file
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        if (!allowedTypes.includes(file.type)) {
            showError("Format tidak valid! Hanya JPG, JPEG, atau PNG yang diperbolehkan.");
            resetPreview();
            return;
        }

        // ✅ Bersihkan pesan error jika valid
        clearError();

        // ✅ Tampilkan preview gambar
        const reader = new FileReader();
        reader.onload = function (e) {
            previewImg.src = e.target.result;
            previewContainer.classList.remove("hidden");
            uploadText.textContent = "Ganti foto";
        };
        reader.readAsDataURL(file);

    } else {
        // Jika input dikosongkan
        resetPreview();
        clearError();
    }

    // =============================
    // Fungsi bantu
    // =============================

    function showError(message) {
        errorMsg.textContent = message;
        errorMsg.classList.remove("hidden");
    }

    function clearError() {
        errorMsg.textContent = "";
        errorMsg.classList.add("hidden");
    }

    function resetPreview() {
        previewImg.src = "";
        previewContainer.classList.add("hidden");
        uploadText.textContent = "Klik untuk upload";
        input.value = "";
    }
}

// ✅ Daftarkan ke window agar bisa dipanggil via onchange di HTML
window.previewImagePublic = previewImagePublic;
