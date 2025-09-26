document.addEventListener("DOMContentLoaded", () => {
    const typeSelect = document.getElementById("type");
    const subTypeSelect = document.getElementById("sub_type");

    const options = {
        internal: [
            { value: "institusi", text: "Institusi" },
            { value: "ormawa_hmps", text: "Ormawa HMPS" },
            { value: "ormawa_ukm", text: "Ormawa UKM" },
        ],
        eksternal: [
            { value: "komunitas", text: "Komunitas" },
            { value: "ukmbs", text: "UKMBS" },
        ],
    };

    function updateSubTypeOptions(type, oldSubType = null) {
        subTypeSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
        if (options[type]) {
            options[type].forEach((opt) => {
                const option = document.createElement("option");
                option.value = opt.value;
                option.textContent = opt.text;
                if (oldSubType && oldSubType === opt.value) {
                    option.selected = true;
                }
                subTypeSelect.appendChild(option);
            });
        }
    }

    // Event listener saat ganti type
    typeSelect.addEventListener("change", function () {
        updateSubTypeOptions(this.value);
    });

    // Set default berdasarkan old()
    const oldType = typeSelect.dataset.old;
    const oldSubType = subTypeSelect.dataset.old;

    if (oldType) {
        updateSubTypeOptions(oldType, oldSubType);
    }
});