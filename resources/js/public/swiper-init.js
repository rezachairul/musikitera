document.addEventListener("DOMContentLoaded", function () {
    // HERO SWIPER
    new Swiper(".heroSwiper", {
        loop: true,
        autoplay: {
            delay: 3000,
            disableOnInteraction: false,
        },
        effect: "fade",
        pagination: {
            el: ".hero-pagination",
            clickable: true,
        },
    });

    // GALLERY SWIPER
    new Swiper(".mySwiper", {
        loop: true,
        spaceBetween: 20,
        centeredSlides: true,
        speed: 800, // durasi transisi (default 300ms → ini lebih halus)
        autoplay: {
            delay: 2500,
            disableOnInteraction: false,
        },
        pagination: {
            el: ".gallery-pagination",
            clickable: true,
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        breakpoints: {
            640: { slidesPerView: 1 },
            768: { slidesPerView: 2 },
            1024: { slidesPerView: 3 },
        },
    });
});
