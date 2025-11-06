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
                element.attr("name") === "uploaded_doc_url"
            ) {
                $("#upload_doc_err").html(error);
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
            form.submit();
        },
    });
}

/**
 * Custom rules (reusable everywhere)
 */
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
