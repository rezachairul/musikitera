// =============================
// Preview uploaded image + Validasi
// =============================
function previewImage(input) {
    const preview = document.getElementById("preview-img");
    const previewContainer = document.getElementById("photo-preview");
    const errorMsg = document.getElementById("foto-error"); // <p id="foto-error">
    const uploadText = document.getElementById("upload-text"); // span teks di bawah ikon

    if (input.files && input.files[0]) {
        const file = input.files[0];

        // ✅ Validasi ukuran (max 2MB)
        if (file.size > 2 * 1024 * 1024) {
            errorMsg.textContent = "Foto lebih dari 2MB, silakan pilih ulang.";
            errorMsg.classList.remove("hidden");

            input.value = ""; // reset input
            preview.src = "";
            previewContainer.classList.add("hidden");
            uploadText.textContent = "Klik untuk upload";
            return;
        }

        // ✅ Validasi format file
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        if (!allowedTypes.includes(file.type)) {
            errorMsg.textContent = "Format tidak valid! Hanya JPG, JPEG, PNG.";
            errorMsg.classList.remove("hidden");

            input.value = ""; // reset input
            preview.src = "";
            previewContainer.classList.add("hidden");
            uploadText.textContent = "Klik untuk upload";
            return;
        }

        // ✅ Bersihkan error jika valid
        errorMsg.textContent = "";
        errorMsg.classList.add("hidden");

        // ✅ Preview gambar
        const reader = new FileReader();
        reader.onload = function (e) {
            preview.src = e.target.result;
            previewContainer.classList.remove("hidden");
            uploadText.textContent = "Ganti Foto"; // ubah teks
        };
        reader.readAsDataURL(file);
    } else {
        // Kalau file dihapus
        preview.src = "";
        previewContainer.classList.add("hidden");
        uploadText.textContent = "Klik untuk upload";

        errorMsg.textContent = "";
        errorMsg.classList.add("hidden");
    }
}

function previewEditImage(event, id) {
    const file = event.target.files[0];
    const previewContainer = document.getElementById(`currentImagePreview-${id}`);

    if (file) {
        // ✅ Validasi ukuran
        if (file.size > 2 * 1024 * 1024) {
            alert("Foto lebih dari 2MB, silakan pilih ulang.");
            event.target.value = ""; // reset input
            previewContainer.innerHTML = `<p class="text-red-500 text-sm">Tidak ada gambar</p>`;
            return;
        }

        // ✅ Validasi format
        const allowedTypes = ["image/jpeg", "image/jpg", "image/png"];
        if (!allowedTypes.includes(file.type)) {
            alert("Format tidak valid! Hanya JPG, JPEG, PNG.");
            event.target.value = ""; // reset input
            previewContainer.innerHTML = `<p class="text-red-500 text-sm">Tidak ada gambar</p>`;
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewContainer.innerHTML = `<img src="${e.target.result}" 
                                              alt="Preview" 
                                              class="w-32 h-32 object-cover rounded">`;
        };
        reader.readAsDataURL(file);
    } else {
        previewContainer.innerHTML = `<p class="text-gray-500 text-sm">Tidak ada gambar</p>`;
    }
}

window.previewImage = previewImage;
window.previewEditImage = previewEditImage;