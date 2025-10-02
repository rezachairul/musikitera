function handlePreview(fileInput, previewWrapper, previewContent, errorMsg) {
    const file = fileInput.files[0];

    // Reset dulu
    errorMsg.classList.add('hidden');
    errorMsg.textContent = "";

    if (file) {
        // Validasi ukuran file (5MB)
        if (file.size > 5 * 1024 * 1024) {
            errorMsg.textContent = "🎵 File ini terlalu 'berat nadanya'... Maksimal 5MB biar harmoninya tetap pas!";
            errorMsg.classList.remove('hidden');
            fileInput.value = ""; // reset input
            previewWrapper.classList.add('hidden');
            previewContent.innerHTML = "";
            return;
        }

        const fileType = file.type;
        previewWrapper.classList.remove('hidden');
        previewContent.innerHTML = "";

        if (fileType === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            previewContent.innerHTML = `
                <iframe src="${fileURL}" class="w-full h-96 border rounded-lg"></iframe>
            `;
        } else {
            previewContent.innerHTML = `
                <div class="flex items-center gap-3">
                    <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 2a2 2 0 00-2 2v12a2
                        2 0 002 2h12a2 2 0 002-2V7.414a2 2 0
                        00-.586-1.414l-4.414-4.414A2 2 0
                        0011.586 1H4zm5 9l-1.5 4-1.5-4H4l2.5
                        7h2L11 11H9z"/>
                    </svg>
                    <div>
                        <p class="text-sm font-medium text-gray-800">${file.name}</p>
                        <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                    </div>
                </div>
            `;
        }
    } else {
        previewWrapper.classList.add('hidden');
        previewContent.innerHTML = "";
    }
}

// Untuk CREATE (default 1 input)
document.getElementById('file').addEventListener('change', function (e) {
    handlePreview(
        e.target,
        document.getElementById('filePreview'),
        document.getElementById('previewContent'),
        document.getElementById('fileError')
    );
});

function EditPreviewDoc(id) {
    const input = document.getElementById(`edit_file-${id}`);
    const previewWrapper = document.getElementById(`filePreview-${id}`);
    const previewContent = document.getElementById(`previewContent-${id}`);
    const oldPreview = document.getElementById(`oldPreviewContent-${id}`);
    const errorMsg = document.getElementById(`edit_fileError-${id}`);

    if (!input || !previewWrapper || !previewContent || !errorMsg) return;

    const file = input.files[0];

    // Reset error & preview baru
    errorMsg.classList.add("hidden");
    errorMsg.textContent = "";
    previewContent.innerHTML = "";   // <<< selalu kosongkan dulu
    previewContent.classList.add("hidden");

    if (!file) {
        if (oldPreview) oldPreview.classList.remove("hidden");
        return;
    }

    // Ada file baru → sembunyikan preview lama
    if (oldPreview) oldPreview.classList.add("hidden");

    // Validasi ukuran (max 5MB)
    if (file.size > 5 * 1024 * 1024) {
        errorMsg.textContent = "File terlalu besar, maksimal 5MB.";
        errorMsg.classList.remove("hidden");
        input.value = "";
        if (oldPreview) oldPreview.classList.remove("hidden");
        return;
    }

    // Validasi tipe
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
        if (oldPreview) oldPreview.classList.remove("hidden");
        return;
    }

    // Kalau valid → tampilkan preview baru
    previewWrapper.classList.remove("hidden");

    const fileURL = URL.createObjectURL(file); // <<< langsung pakai URL.createObjectURL lebih cepat

    if (file.type === "application/pdf") {
        previewContent.innerHTML = `
            <iframe src="${fileURL}" class="w-full h-96 border rounded-lg"></iframe>
        `;
    } else {
        previewContent.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-8 h-8 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M4 2a2 2 0 00-2 2v12a2
                    2 0 002 2h12a2 2 0 002-2V7.414a2 2 0
                    00-.586-1.414l-4.414-4.414A2 2 0
                    0011.586 1H4zm5 9l-1.5 4-1.5-4H4l2.5
                    7h2L11 11H9z"/>
                </svg>
                <div>
                    <p class="text-sm font-medium text-gray-800">${file.name}</p>
                    <p class="text-xs text-gray-500">${(file.size / 1024).toFixed(2)} KB</p>
                </div>
            </div>
        `;
    }

    previewContent.classList.remove("hidden");
}
