document.addEventListener("DOMContentLoaded", function () {
    // ===============================
    // ADD MODAL HANDLER
    // ===============================
    const addModal = document.getElementById("AddModal");
    const addForm = addModal?.querySelector("#addForm");

    window.openAddModal = function () {
        if (addModal) {
            addModal.classList.remove("hidden");
            addModal.classList.add("flex");
            document.body.classList.add("overflow-hidden");
        }
    };

    window.closeAddModal = function () {
        if (addModal) {
            addModal.classList.add("hidden");
            addModal.classList.remove("flex");
            document.body.classList.remove("overflow-hidden");
            if (addForm) addForm.reset();
        }
    };

    // Klik di luar untuk tutup add modal
    addModal?.addEventListener("click", function (e) {
        if (e.target === addModal) closeAddModal();
    });

    // ===============================
    // UPDATE MODAL HANDLER
    // ===============================
    window.openUpdateModal = function (id) {
        const modal = document.getElementById(`UpdateModal-${id}`);
        if (modal) {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");

            // Klik di luar konten modal untuk close
            modal.addEventListener("click", function handler(e) {
                if (e.target === modal) {
                    closeUpdateModal(id);
                    modal.removeEventListener("click", handler); // biar event nggak dobel
                }
            });
        }
    };

    window.closeUpdateModal = function (id) {
        const modal = document.getElementById(`UpdateModal-${id}`);
        if (modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            document.body.classList.remove("overflow-hidden");
        }
    };

    // ===============================
    // DELETE MODAL HANDLER
    // ===============================
    window.openDeleteModal = function (id) {
        const modal = document.getElementById(`DeleteModal-${id}`);
        if (modal) {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
            document.body.classList.add("overflow-hidden");
        }
    };

    window.closeDeleteModal = function (id) {
        const modal = document.getElementById(`DeleteModal-${id}`);
        if (modal) {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
            document.body.classList.remove("overflow-hidden");
        }
    };

    // Klik di luar modal untuk close
    document.querySelectorAll('[id^="DeleteModal-"]').forEach((modal) => {
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.classList.add("hidden");
                modal.classList.remove("flex");
                document.body.classList.remove("overflow-hidden");
            }
        });
    });

    // ===============================
    // GLOBAL ESC KEY HANDLER
    // ===============================
    document.addEventListener("keydown", function (e) {
        if (e.key === "Escape") {
            // Tutup add modal
            closeAddModal?.();

            // Tutup semua update modal yang sedang terbuka
            document
                .querySelectorAll('[id^="UpdateModal-"]')
                .forEach((modal) => {
                    if (!modal.classList.contains("hidden")) {
                        modal.classList.add("hidden");
                        modal.classList.remove("flex");
                        document.body.classList.remove("overflow-hidden");
                    }
                });

            // Tutup semua delete modal yang sedang terbuka
            document
                .querySelectorAll('[id^="DeleteModal-"]')
                .forEach((modal) => {
                    if (!modal.classList.contains("hidden")) {
                        modal.classList.add("hidden");
                        modal.classList.remove("flex");
                        document.body.classList.remove("overflow-hidden");
                    }
                });
        }
    });
});
