// resources/js/admin/shortlink_copy.js

document.addEventListener('click', async (e) => {
    const btn = e.target.closest('.copy-shortlink');
    if (!btn) return; // klik bukan tombol copy

    const url = btn.dataset.url;
    if (!url) return;

    try {
        await navigator.clipboard.writeText(url);

        // feedback visual
        btn.classList.add('text-green-600');
        setTimeout(() => {
            btn.classList.remove('text-green-600');
        }, 1200);

        console.log('Copied:', url);
    } catch (error) {
        console.error('Copy failed:', error);
        alert('Gagal menyalin link');
    }
});