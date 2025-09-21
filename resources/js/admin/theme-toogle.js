const toggleBtn = document.getElementById('dark-toggle');
const sunIcon   = document.getElementById('icon-sun');
const moonIcon  = document.getElementById('icon-moon');

function toggleIcons(hide, show) {
  hide.classList.remove('show');
  hide.classList.add('rotate-out');

  hide.addEventListener('transitionend', () => {
    hide.classList.add('hidden');
    hide.classList.remove('rotate-out');

    show.classList.remove('hidden');
    requestAnimationFrame(() => {
      show.classList.add('show'); // smooth masuk
    });
  }, { once: true });
}

toggleBtn.addEventListener('click', () => {
  if (!sunIcon.classList.contains('hidden')) {
    toggleIcons(sunIcon, moonIcon);
  } else {
    toggleIcons(moonIcon, sunIcon);
  }
});
