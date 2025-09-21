// ===============================
// SEARCH & FILTER HANDLER
// ===============================
document.addEventListener("DOMContentLoaded", () => {
    const handleAjaxTable = (url, target, data) => {
        const targetElement = document.getElementById(target);
        if (!targetElement) return;

        const queryString = new URLSearchParams(data).toString();
        fetch(`${url}?${queryString}`, {
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
        })
            .then((response) => response.text())
            .then((html) => {
                targetElement.innerHTML = html;
            })
            .catch((error) => {
                console.error("AJAX load failed:", error);
            });
    };

    const attachAjaxHandlers = () => {
        const searchInput = document.querySelector(
            'input[type="search"][data-url]'
        );
        const filterSelects = document.querySelectorAll("select[data-url]");
        const paginationContainer = document.querySelector(
            '[aria-label="Pagination"]'
        );

        const gatherParams = () => {
            const params = {};

            if (searchInput) {
                params.search = searchInput.value.trim();
                params.url = searchInput.dataset.url;
                params.target = searchInput.dataset.target;
            }

            filterSelects.forEach((select) => {
                params[select.name] = select.value;
            });

            return params;
        };

        // Search
        if (searchInput) {
            searchInput.addEventListener(
                "input",
                debounce(() => {
                    const { url, target, ...data } = gatherParams();
                    handleAjaxTable(url, target, data);
                }, 400)
            );
        }

        // Filter / PerPage
        filterSelects.forEach((select) => {
            select.addEventListener("change", () => {
                const { url, target, ...data } = gatherParams();
                handleAjaxTable(url, target, data);
            });
        });

        // Pagination
        if (paginationContainer) {
            paginationContainer.addEventListener("click", (e) => {
                if (e.target.tagName === "A") {
                    e.preventDefault();
                    const pageUrl = new URL(e.target.href);
                    const { target } = gatherParams();
                    const data = Object.fromEntries(
                        pageUrl.searchParams.entries()
                    );
                    handleAjaxTable(pageUrl.pathname, target, data);
                }
            });
        }
    };

    // Debounce helper
    function debounce(func, wait) {
        let timeout;
        return (...args) => {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, args), wait);
        };
    }

    attachAjaxHandlers();
});
