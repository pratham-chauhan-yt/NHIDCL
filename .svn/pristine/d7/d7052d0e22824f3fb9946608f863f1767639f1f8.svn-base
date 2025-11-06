function toggleFieldsByRules(configMap, fieldMap, selector) {
        const selectedText = $(selector).select2("data")[0]?.text.trim() || "";
        const config = configMap[selectedText] || configMap["default"];

        // Reset all fields: show + required
        $.each(fieldMap, (_, field) => {
            field
                .show()
                .find("select, input, textarea")
                .prop("required", true)
                .prop("disabled", false);
        });

        // Apply hide rules
        (config.hide || []).forEach((key) => {
            if (fieldMap[key]) {
                fieldMap[key]
                    .hide()
                    .find("select, input, textarea")
                    .prop("required", false)
                    .prop("disabled", true);
            }
        });

        // Handle custom “required” label toggling if any
        if (config.requiredLabels) {
            $.each(config.requiredLabels, (key, required) => {
                const label = $(`#${key}_label`);
                label.toggleClass("required-label", required);
            });
        }
    }
