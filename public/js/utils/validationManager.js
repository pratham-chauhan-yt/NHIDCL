function initValidation(formSelector, rules, messages) {
    if (!$(formSelector).length) return;

    $(formSelector).validate({
        rules: rules,
        messages: messages,
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("error-message");

            if (element.hasClass("js-select2")) {
                $("#" + element.attr("id") + "_err").html(error);
            } else if (
                element.attr("type") === "file" ||
                element.attr("name").endsWith("_url")
            ) {
                let name = element.attr("name");
                let baseName = name.replace("_url", ""); // remove trailing "_url" if present
                let errorId = baseName + "_err";

                if ($("#" + errorId).length) {
                    $("#" + errorId).html(error);
                } else {
                    error.insertAfter(element);
                }
            } else {
                let errorId = element.attr("id") + "_err";
                if ($("#" + errorId).length) {
                    $("#" + errorId).html(error);
                } else {
                    error.insertAfter(element);
                }
            }
        },
        submitHandler: function (form) {
            return (
                form.submit()
            );
        },
        highlight: function (element) {
            const $el = $(element);
            if ($el.hasClass("js-select2")) {
                $el.next(".select2")
                    .find(".select2-selection")
                    .addClass("select2-error");
            } else if (
                $el.is("input") ||
                $el.is("textarea") ||
                $el.is("select")
            ) {
                $el.addClass("error");
            }
        },

        unhighlight: function (element) {
            const $el = $(element);

            if ($el.hasClass("js-select2")) {
                $el.next(".select2")
                    .find(".select2-selection")
                    .removeClass("select2-error");
            } else if (
                $el.is("input") ||
                $el.is("textarea") ||
                $el.is("select")
            ) {
                $el.removeClass("error");
            }
        },
    });
    $(".js-select2").on("change", function () {
        $(this).valid();
    });
}

/**
 * Custom rules (reusable everywhere)
 */

$.validator.addMethod(
    "lengthRange",
    function (value, element, param) {
        if (this.optional(element)) return true;
        const [min, max] = param;
        const len = value.length;
        return len >= min && len <= max;
    },
    function (param, element) {
        return param[0] === param[1]
            ? `Please enter exactly ${param[0]} characters.`
            : `Please enter between ${param[0]} and ${param[1]} characters.`;
    }
);

$.validator.addMethod(
    "strictEmail",
    function (value, element) {
        if (this.optional(element)) return true;
        return /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/i.test(value);
    },
    "Please enter a valid email address"
);

// Usage: emailDomain: ["nhidcl.com", "nic.in"]
$.validator.addMethod(
    "emailDomain",
    function (value, element, allowedDomains) {
        if (!value) return true;

        const basicEmailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!basicEmailPattern.test(value)) return false;

        const domain = value.split("@").pop().toLowerCase();

        return allowedDomains.map((d) => d.toLowerCase()).includes(domain);
    },
    function (allowedDomains, element) {
        const domainList = allowedDomains.join(", ");
        return `Please enter a valid official email (allowed: ${domainList})`;
    }
);

$.validator.addMethod(
    "filesize",
    function (value, element, param) {
        if (this.optional(element) || !element.files.length) return true;
        return element.files[0].size <= param;
    },
    "File size must not exceed {0} bytes"
);

$.validator.addMethod(
    "noFutureDate",
    function (value, element) {
        if (!value) return true;
        let inputDate = new Date(value);
        let today = new Date();
        inputDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        return inputDate <= today;
    },
    "Date cannot be in the future"
);

$.validator.addMethod(
    "greaterThan",
    function (value, element, param) {
        if (!value) return true;
        let startDate = new Date($(param).val());
        let endDate = new Date(value);
        if (isNaN(startDate.getTime()) || isNaN(endDate.getTime())) return true;
        return endDate >= startDate;
    },
    "End date must be greater than or equal to start date"
);

// dateLimit: "past" or dateLimit: ["today", "future"]
$.validator.addMethod(
    "dateLimit",
    function (value, element, param) {
        if (!value) return true; // Skip empty fields (handled by 'required')

        // Parse and normalize input date & today’s date
        const inputDate = new Date(value);
        const today = new Date();

        if (isNaN(inputDate)) return false; // Invalid date format
        inputDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);

        // Normalize params
        const params = Array.isArray(param) ? param : [param];

        const allowPast = params.includes("past");
        const allowToday = params.includes("today");
        const allowFuture = params.includes("future");

        // Date logic
        const isToday = inputDate.getTime() === today.getTime();
        const isPast = inputDate < today;
        const isFuture = inputDate > today;

        // Check valid case
        return (
            (allowToday && isToday) ||
            (allowPast && isPast) ||
            (allowFuture && isFuture)
        );
    },
    function (param, element) {
        // Handle single or multiple parameters
        const params = Array.isArray(param) ? param : [param];

        // Message mappings
        const messages = {
            past: "a past date",
            today: "today’s date",
            future: "a future date",
        };

        // Construct user-friendly text
        const allowedText = params.map((p) => messages[p] || p).join(" or ");
        return `Please select ${allowedText} only`;
    }
);
