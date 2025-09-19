const toggleBtn = document.getElementById('dark-toggle');
const sunIcon   = document.getElementById('icon-sun');
const moonIcon  = document.getElementById('icon-moon');

toggleBtn.addEventListener('click', () => {
  if (!sunIcon.classList.contains('hidden')) {
    // Sun keluar
    sunIcon.classList.add('rotate-out');
    sunIcon.addEventListener('transitionend', () => {
      sunIcon.classList.add('hidden');
      sunIcon.classList.remove('rotate-out');

      // Moon masuk
      moonIcon.classList.remove('hidden');
      moonIcon.classList.add('rotate-in');
      requestAnimationFrame(() => {
        moonIcon.classList.remove('rotate-in');
      });
    }, { once: true });
  } else {
    // Moon keluar
    moonIcon.classList.add('rotate-out');
    moonIcon.addEventListener('transitionend', () => {
      moonIcon.classList.add('hidden');
      moonIcon.classList.remove('rotate-out');

      // Sun masuk
      sunIcon.classList.remove('hidden');
      sunIcon.classList.add('rotate-in');
      requestAnimationFrame(() => {
        sunIcon.classList.remove('rotate-in');
      });
    }, { once: true });
  }
});