document.getElementById('file').addEventListener('change', function (e) {
    const file = e.target.files[0];
    const previewWrapper = document.getElementById('filePreview');
    const previewContent = document.getElementById('previewContent');

    if (file) {
        const fileType = file.type;
        previewWrapper.classList.remove('hidden');
        previewContent.innerHTML = "";

        // Preview PDF langsung
        if (fileType === "application/pdf") {
            const fileURL = URL.createObjectURL(file);
            previewContent.innerHTML = `
                <iframe src="${fileURL}" class="w-full h-96 border rounded-lg"></iframe>
            `;
        } else {
            // Untuk file Word, Excel, PPT: tampilkan nama & size saja
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
});
