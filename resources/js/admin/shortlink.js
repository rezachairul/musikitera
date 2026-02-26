function generateSlug(length = 6) {
    const chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let slug = '';
    for (let i = 0; i < length; i++) {
        slug += chars.charAt(Math.floor(Math.random() * chars.length));
    }

    const input = document.getElementById('slugInput');
    if (input) {
        input.value = slug;
    }
}

function enableEditSlug() {
    const input = document.getElementById('slugInput');
    if (input) {
        input.removeAttribute('readonly');
        input.focus();
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const btnGenerate = document.getElementById('btnGenerateSlug');
    const btnEdit = document.getElementById('btnEditSlug');

    if (btnGenerate) {
        btnGenerate.addEventListener('click', function () {
            generateSlug();
        });
    }

    if (btnEdit) {
        btnEdit.addEventListener('click', function () {
            enableEditSlug();
        });
    }
});