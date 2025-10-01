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

// Untuk EDIT (bisa banyak form, cukup panggil fungsi ini di onchange)
function EditPreviewDoc(id) {
    handlePreview(
        document.getElementById(`file-${id}`),
        document.getElementById(`filePreview-${id}`),
        document.getElementById(`previewContent-${id}`),
        document.getElementById(`fileError-${id}`)
    );
}
