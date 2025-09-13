// Navbar toggle script
document.addEventListener("DOMContentLoaded", () => {
    const toggleBtn = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    const iconHamburger = document.getElementById("icon-hamburger");
    const iconClose = document.getElementById("icon-close");

    toggleBtn.addEventListener("click", () => {
        mobileMenu.classList.toggle("hidden");

        // Animasi switch icon
        if (iconHamburger.classList.contains("icon-active")) {
            iconHamburger.classList.remove("icon-active");
            iconHamburger.classList.add("icon-inactive");

            iconClose.classList.remove("icon-inactive");
            iconClose.classList.add("icon-active");
        } else {
            iconHamburger.classList.remove("icon-inactive");
            iconHamburger.classList.add("icon-active");

            iconClose.classList.remove("icon-active");
            iconClose.classList.add("icon-inactive");
        }
    });

    // Set default state
    iconHamburger.classList.add("icon-active");
    iconClose.classList.add("icon-inactive");
});
