document.addEventListener("DOMContentLoaded", () => {
    const counters = document.querySelectorAll(".counter");
    let started = false; // biar ga jalan berkali-kali

    const startCounting = () => {
        counters.forEach((counter) => {
            const target = +counter.getAttribute("data-target");
            let count = 0;
            const increment = target / 100; // makin besar makin cepat

            const updateCounter = () => {
                if (count < target) {
                    count += increment;
                    counter.textContent = Math.ceil(count);
                    requestAnimationFrame(updateCounter);
                } else {
                    counter.textContent =
                        target + (counter.hasAttribute("data-plus") ? "+" : "");
                }
            };
            updateCounter();
        });
    };

    // Observer biar jalan pas kelihatan di layar
    const observer = new IntersectionObserver(
        (entries) => {
            if (entries.some((entry) => entry.isIntersecting)) {
                if (!started) {
                    startCounting();
                    started = true;
                }
            }
        },
        { threshold: 0.5 }
    );

    observer.observe(document.querySelector("#counter"));
});
