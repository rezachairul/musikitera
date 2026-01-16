// PreviewImage.js

// HYBRID PREVIEW IMAGE (CREATE)
function previewImage(input) {
    const file = input.files?.[0];
    if (!file) return;

    // VALIDASI (DIPAKAI SEMUA MODE)
    const maxSize = 2 * 1024 * 1024;
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

    // MODE MULTI (PAKAI DATA ATTRIBUTE)
    const wrapper = input.closest('[data-preview-wrapper]');
    if (wrapper) {
        const previewImg  = wrapper.querySelector('[data-preview-img]');
        const previewBox  = wrapper.querySelector('[data-preview-box]');
        const uploadText  = wrapper.querySelector('[data-upload-text]');
        const errorMsg    = wrapper.querySelector('[data-error-msg]');

        if (file.size > maxSize) {
            errorMsg.textContent = 'Gambar lebih dari 2MB.';
            errorMsg.classList.remove('hidden');
            input.value = '';
            previewBox.classList.add('hidden');
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            errorMsg.textContent = 'Format tidak valid.';
            errorMsg.classList.remove('hidden');
            input.value = '';
            previewBox.classList.add('hidden');
            return;
        }

        errorMsg.textContent = '';
        errorMsg.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            previewBox.classList.remove('hidden');
            if (uploadText) uploadText.textContent = 'Ganti Foto';
        };
        reader.readAsDataURL(file);
        return;
    }

    // MODE LEGACY (PAKAI ID)
    const preview          = document.getElementById('preview-img');
    const previewContainer = document.getElementById('photo-preview');
    const errorMsg         = document.getElementById('foto-error');
    const uploadText       = document.getElementById('upload-text');

    if (!preview || !previewContainer) return;

    if (file.size > maxSize) {
        errorMsg.textContent = 'Foto lebih dari 2MB, silakan pilih ulang.';
        errorMsg.classList.remove('hidden');
        input.value = '';
        preview.src = '';
        previewContainer.classList.add('hidden');
        uploadText.textContent = 'Klik untuk upload';
        return;
    }

    if (!allowedTypes.includes(file.type)) {
        errorMsg.textContent = 'Format tidak valid! (JPG / PNG / WebP)';
        errorMsg.classList.remove('hidden');
        input.value = '';
        preview.src = '';
        previewContainer.classList.add('hidden');
        uploadText.textContent = 'Klik untuk upload';
        return;
    }

    errorMsg.textContent = '';
    errorMsg.classList.add('hidden');

    const reader = new FileReader();
    reader.onload = e => {
        preview.src = e.target.result;
        previewContainer.classList.remove('hidden');
        uploadText.textContent = 'Ganti Foto';
    };
    reader.readAsDataURL(file);
}

// HYBRID PREVIEW EDIT (UPDATE)
function previewEditImage(input) {
    const file = input.files?.[0];
    if (!file) return;

    const maxSize = 2 * 1024 * 1024;
    const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];

    /* =========================
       MODE 1 — WRAPPER (MULTI)
    ========================= */
    const wrapper = input.closest('[data-edit-preview-wrapper]');
    if (wrapper) {
        const previewImg = wrapper.querySelector('[data-edit-preview-img]');
        const previewBox = wrapper.querySelector('[data-edit-preview-box]');
        const errorMsg   = wrapper.querySelector('[data-edit-error-msg]');
        const uploadText = wrapper.querySelector('[data-edit-upload-text]');

        if (!previewImg || !previewBox) return;

        // VALIDASI
        if (file.size > maxSize) {
            errorMsg.textContent = 'Gambar lebih dari 2MB.';
            errorMsg.classList.remove('hidden');
            input.value = '';
            return;
        }

        if (!allowedTypes.includes(file.type)) {
            errorMsg.textContent = 'Format tidak valid.';
            errorMsg.classList.remove('hidden');
            input.value = '';
            return;
        }

        errorMsg.textContent = '';
        errorMsg.classList.add('hidden');

        const reader = new FileReader();
        reader.onload = e => {
            previewImg.src = e.target.result;
            previewBox.classList.remove('hidden');
            if (uploadText) uploadText.textContent = 'Ganti Foto';
        };
        reader.readAsDataURL(file);

        return; // ⛔ STOP — jangan lanjut ke mode ID
    }

    /* =========================
       MODE 2 — LEGACY (ID)
    ========================= */
    const id = input.dataset.id;
    if (!id) return;

    const previewContainer = document.getElementById(`currentImagePreview-${id}`);
    const errorMsg = document.getElementById(`image-error-${id}`);

    if (!previewContainer) return;

    // VALIDASI
    if (file.size > maxSize) {
        if (errorMsg) {
            errorMsg.textContent = 'Gambar lebih dari 2MB.';
            errorMsg.classList.remove('hidden');
        }
        input.value = '';
        return;
    }

    if (!allowedTypes.includes(file.type)) {
        if (errorMsg) {
            errorMsg.textContent = 'Format tidak valid.';
            errorMsg.classList.remove('hidden');
        }
        input.value = '';
        return;
    }

    if (errorMsg) {
        errorMsg.textContent = '';
        errorMsg.classList.add('hidden');
    }

    const reader = new FileReader();
    reader.onload = e => {
        previewContainer.innerHTML = `
            <img src="${e.target.result}"
                 class="w-24 h-24 object-cover rounded-lg border shadow-sm">
        `;
    };
    reader.readAsDataURL(file);
}

// AUTO BIND (EDIT)
document.querySelectorAll('.preview-edit-input').forEach(input => {
    input.addEventListener('change', event => {
        previewEditImage(event, input.dataset.id);
    });
});

// GLOBAL
window.previewImage = previewImage;
window.previewEditImage = previewEditImage;