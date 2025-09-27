document.addEventListener("DOMContentLoaded", () => {
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

    function updateSubTypeOptions(typeSelect, subTypeSelect, oldSubType = null) {
        subTypeSelect.innerHTML = '<option value="">-- Pilih Kategori --</option>';
        if (options[typeSelect.value]) {
            options[typeSelect.value].forEach((opt) => {
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

    // Loop untuk semua pasangan select type/sub_type (baik create maupun update)
    document.querySelectorAll("select[id*='type_'], select#type").forEach(typeSelect => {
        // Cari pasangan sub_type (create pakai #sub_type, update pakai #edit_sub_type_{id})
        let subTypeSelect;
        if (typeSelect.id === "type") {
            subTypeSelect = document.getElementById("sub_type");
        } else {
            const id = typeSelect.id.replace("edit_type_", "");
            subTypeSelect = document.getElementById("edit_sub_type_" + id);
        }

        // Listener perubahan type
        typeSelect.addEventListener("change", function () {
            updateSubTypeOptions(typeSelect, subTypeSelect);
        });

        // Set default kalau ada value lama
        const oldType = typeSelect.dataset.old || typeSelect.value;
        const oldSubType = subTypeSelect.dataset.old || subTypeSelect.getAttribute("data-old");
        if (oldType) {
            typeSelect.value = oldType;
            updateSubTypeOptions(typeSelect, subTypeSelect, oldSubType);
        }
    });
});