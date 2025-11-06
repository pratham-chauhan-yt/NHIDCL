$(document).ready(function () {
    $(".js-select2").select2();

    const sixteenYearsAgo = new Date();
    sixteenYearsAgo.setFullYear(sixteenYearsAgo.getFullYear() - 16);
    const formattedDate = sixteenYearsAgo.toISOString().split("T")[0];
    $("#date_of_birth").attr("max", formattedDate);

    initValidation("#personalDetailsForm", {
        courtesy_title: { required: true },
        email: { required: true, strictEmail: true },
        mobile: { required: true, digits: true, lengthRange: [10, 10] },
        alternate_phone: { digits: true, lengthRange: [10, 10] },
        date_of_birth: { required: true, date: true, dateLimit: "past" },
        gender: { required: true },
        blood_group: { required: true },
        marital_status: { required: true },
        wedding_date: {
            required: function () {
                return (
                    $("#marital_status").select2("data")[0]?.text.trim() !==
                    "Single"
                );
            },
            date: true,
            dateLimit: "past",
        },
        country_of_birth: { required: true },
        place_of_birth: { required: true },
        religion: { required: true },
        nationality: { required: true },
        category: { required: true },
        ex_serviceman: { required: true },
        disability: { required: true },
        nature_of_disability: {
            required: function () {
                return (
                    $("#disability").select2("data")[0]?.text.trim() === "Yes"
                );
            },
        },
        current_address: { required: true, minlength: 10 },
        permanent_address: { required: true, minlength: 10 },
        emergency_contact_name: { required: true, minlength: 3 },
        emergency_contact_relationship: { required: true, minlength: 3 },
        emergency_contact_mobile: {
            required: true,
            digits: true,
            lengthRange: [10, 10],
        },
        emergency_contact_alternate_number: {
            required: true,
            digits: true,
            lengthRange: [10, 10],
        },
        emergency_contact_address: { required: true, minlength: 10 },
        nok_contact_name: { required: true, minlength: 3 },
        nok_contact_relationship: { required: true, minlength: 3 },
        nok_contact_mobile: {
            required: true,
            digits: true,
            lengthRange: [10, 10],
        },
        nok_contact_alternate_number: {
            required: true,
            digits: true,
            lengthRange: [10, 10],
        },
        nok_contact_address: { required: true, minlength: 10 },
        father_name: { required: true, minlength: 3 },
        father_dependent: { required: true },
        mother_name: { required: true, minlength: 3 },
        mother_dependent: { required: true },
        spouse_name: {
            required: function () {
                return (
                    $("#marital_status").select2("data")[0]?.text.trim() !==
                    "Single"
                );
            },
            minlength: 3,
        },
        spouse_dependent: {
            required: function () {
                return (
                    $("#marital_status").select2("data")[0]?.text.trim() !==
                    "Single"
                );
            },
        },
    });

    initValidation("#educationalDetailsForm", {
        examination: { required: true, minlength: 2 },
        institute_name: { required: true, minlength: 3 },
        university_board: { required: true, minlength: 3 },
        passing_year: { required: true },
        percentage_cgpa: { required: true, number: true, range: [0, 100] },
        marksheet_certificate: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        marksheet_certificate_url: { required: true },
    });

    initValidation("#workExperienceDetailsForm", {
        employer_name: { required: true, minlength: 2 },
        post_held: { required: true, minlength: 2, maxlength: 500 },
        from_date: { required: true, date: true, dateLimit: ["past", "today"] },
        to_date: {
            required: true,
            date: true,
            dateLimit: ["past", "today"],
            greaterThan: "#from_date",
        },
        job_description: { required: true, minlength: 10, maxlength: 500 },
        experience_certificate: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        experience_certificate_url: { required: true },
    });

    initValidation("#trainingDetailsForm", {
        name_of_training: { required: true, minlength: 2, maxlength: 255 },
        training_start_date: {
            required: true,
            date: true,
            dateLimit: ["past", "today"],
        },
        training_end_date: {
            required: true,
            date: true,
            dateLimit: ["past", "today"],
            greaterThan: "#training_start_date",
        },
        description: { required: true, minlength: 5, maxlength: 500 },
        certificate_expiry_date: { date: true, dateLimit: "future" },
        training_certificate: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        training_certificate_url: { required: true },
    });

    initValidation("#documentUploadForm", {
        passport_photo: {
            required: true,
            extension: "jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
        passport_photo_url: { required: true },
        signature: {
            required: true,
            extension: "jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
        signature_url: { required: true },
        resume: { required: true, extension: "pdf", filesize: 2 * 1024 * 1024 },
        resume_url: { required: true },
        pan_card: {
            required: true,
            extension: "pdf|jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
        pan_card_url: { required: true },
        aadhar_card: {
            required: true,
            extension: "pdf|jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
        aadhar_card_url: { required: true },
        address_proof: {
            required: true,
            extension: "pdf|jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
        address_proof_url: { required: true },
        marriage_certificate: {
            required: false,
            extension: "pdf|jpg|jpeg|png",
            filesize: 2 * 1024 * 1024,
        },
    });

    initValidation("#employerDetailsForm", {
        user_type: { required: true },
        official_email: {
            required: true,
            email: true,
            domainAllowed: ["nhidcl.com", "nic.in"],
        },
        ref_employee_type_id: { required: true },
        date_of_joining: {
            required: true,
            date: true,
            dateLimit: ["past", "today"],
        },
        ref_designation_id: { required: true },
        ref_department_id: { required: true },
        user_code: { required: true, minlength: 2, maxlength: 50 },
        level_id: { required: true },
        probation_period: { required: true, digits: true, range: [0, 24] },
        confirmation_date: {
            required: true,
            date: true,
            greaterThan: "#date_of_joining",
        },
        reporting_officer_id: { required: true },
        ref_posting_location_id: { required: true },
        salary_detail: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        salary_detail_url: { required: true },
        signed_offer_letter: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        signed_offer_letter_url: { required: true },
        nda_confidentiality_agreement: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        nda_confidentiality_agreement_url: { required: true },
        background_verification_report: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        background_verification_report_url: { required: true },
        disciplinary_status_report: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        disciplinary_status_report_url: { required: true },
        vigilance_clearance_report: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        vigilance_clearance_report_url: { required: true },
        medical_fitness_report: {
            required: true,
            extension: "pdf",
            filesize: 2 * 1024 * 1024,
        },
        medical_fitness_report_url: { required: true },
        // "role[]": { required: true },
    });

    $("#same_as_emergency_contact").on("change", function () {
        const isChecked = $(this).is(":checked");

        const fields = [
            "contact_name",
            "contact_relationship",
            "contact_mobile",
            "contact_alternate_number",
            "contact_address",
        ];

        fields.forEach(function (field) {
            const cVal = $(`#emergency_${field}`).val();
            const $nokField = $(`#nok_${field}`);

            if (isChecked) {
                $nokField.val(cVal).prop("readonly", true);
            } else {
                $nokField.prop("readonly", false);
            }
        });
    });

    /* ======================================================
       PERSONAL DETAILS TOGGLING LOGIC
       ====================================================== */

    const PERSONAL_FIELDS = {
        wedding_date: $("#field_wedding_date"),
        spouse_name: $("#field_spouse_name"),
        spouse_dependent: $("#field_spouse_dependent"),
    };

    const PERSONAL_CONFIG = {
        Single: { hide: ["wedding_date", "spouse_name", "spouse_dependent", "field_children_name", "field_children_dependent"] },
        Divorced: { hide: [] },
        Widowed: { hide: ["spouse_dependent"] },
        Married: { hide: [] },
        default: { hide: ["wedding_date", "spouse_name", "spouse_dependent", "field_children_name", "field_children_dependent"] },
    };

    $("#marital_status").on("change", function () {
        toggleFieldsByRules(PERSONAL_CONFIG, PERSONAL_FIELDS, this);
    });
    toggleFieldsByRules(PERSONAL_CONFIG, PERSONAL_FIELDS, "#marital_status");

    const DISABILITY_FIELDS = {
        nature_of_disability: $("#field_nature_of_disability"),
    };

    const DISABILITY_CONFIG = {
        Yes: { hide: [] },
        No: { hide: ["nature_of_disability"] },
        default: { hide: ["nature_of_disability"] },
    };

    $("#disability").on("change", function () {
        toggleFieldsByRules(DISABILITY_CONFIG, DISABILITY_FIELDS, this);
    });
    toggleFieldsByRules(DISABILITY_CONFIG, DISABILITY_FIELDS, "#disability");

     // ======================================================
    // DOCUMENT UPLOAD TOGGLING LOGIC
    // ======================================================

    const DOC_FIELDS = {
        marriage_certificate: $("#field_marriage_certificate")
    };

    const DOC_CONFIG = {
        "Married": { hide: [] },
        "Single": { hide: ["marriage_certificate"] },
        "Divorced": { hide: [] },
        "Widowed": { hide: [] },
        "default": { hide: ["marriage_certificate"] }
    };

    // Sync with Marital Status in Personal Tab
    $("#marital_status").on("change", function () {
        toggleFieldsByRules(DOC_CONFIG, DOC_FIELDS, this);
    });
    toggleFieldsByRules(DOC_CONFIG, DOC_FIELDS, "#marital_status");
});
