$(document).ready(function () {
    $(".js-select2").select2();

    const sixteenYearsAgo = new Date();
    sixteenYearsAgo.setFullYear(sixteenYearsAgo.getFullYear() - 16);
    const formattedDate = sixteenYearsAgo.toISOString().split("T")[0];
    $("#date_of_birth").attr("max", formattedDate);

    let userType = $("#user_type").select2("data")[0]?.text.trim() || "";
    function toggleFields() {
        userType = $("#user_type").select2("data")[0]?.text.trim() || "";

        const fields = {
            ext_emp_company_id: $("#field_ext_emp_company_id"),
            ext_emp_designation_id: $("#field_ext_emp_designation_id"),
        };

        // Define visibility rules per user type
        const visibilityConfig  = {
            External: {
                hide: [],
            },
            Internal: { hide: ["ext_emp_company_id", "ext_emp_designation_id"] },
            default: { hide: ["ext_emp_company_id", "ext_emp_designation_id"] },
        };

        const { hide } = visibilityConfig[userType] || visibilityConfig["default"];

        $.each(fields, (_, field) => {
            field.show().find("select, input").prop("required", true);
        });

        hide.forEach((key) => {
            fields[key]?.hide().find("select, input").prop("required", false);
        });
    }

    toggleFields();
    $("#user_type").on("change", toggleFields);

    initValidation(
        "#createUserFrm",
        {
            name: { required: true, minlength: 3 },
            email: { required: true, strictEmail: true },
            official_email: { required: true, strictEmail: true, emailDomain: ["nhidcl.com", "nic.in", "gov.in"] },
            mobile: { required: true, digits: true, lengthRange: [10, 10] },
            status: { required: true },
            date_of_birth: { required: true, date: true, dateLimit: "past" },
            user_type: { required: true },
            ref_ext_emp_company_id: {
                required: function () {
                    return (
                        userType === "External" ||
                        $("#field_ext_emp_company_id").is(":visible")
                    );
                },
            },
            ref_ext_emp_designation_id: {
                required: function () {
                    return (
                        userType === "External" ||
                        $("#field_ext_emp_designation_id").is(":visible")
                    );
                },
            },
        },
    );
});
