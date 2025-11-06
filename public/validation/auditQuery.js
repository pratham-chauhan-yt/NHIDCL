function openPage(pageName, elmnt, color) {
    var tabcontent = document.getElementsByClassName("tabcontent");
    for (var i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    var tablinks = document.querySelectorAll(".tab_custom_c button");
    tablinks.forEach(function (btn) {
        btn.classList.remove("active");
    });
    document.getElementById(pageName).style.display = "block";
    elmnt.classList.add("active");
    if (pageName === "Dropped") {
        loadAuditTable("5", "#audit_dropped_query_table");
    } else if (pageName === "Pending") {
        loadAuditTable(null, "#audit_query_table");
    }
}

// Get the user role from hidden input
const userRole = document.getElementById("user_role")?.value;

// Define the dynamic columns for the DataTable
let columnsForTable = [];

if (userRole === "1") {
    columnsForTable = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: true,
        },
        { data: "audit_query", name: "audit_query" },
        { data: "letter_no", name: "letter_no" },
        { data: "letter_date", name: "letter_date" },
        { data: "pending", name: "pending" },
        { data: "status", name: "status" },
        {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
        },
    ];
} else {
    columnsForTable = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        { data: "letter_no", name: "letter_no" },
        { data: "letter_date", name: "letter_date" },
        { data: "subject", name: "subject" },
        { data: "created_by", name: "createdBy.name" },
        { data: "status", name: "status" },
        {
            data: "action",
            name: "action",
            orderable: false,
            searchable: false,
        },
    ];
}

// Read base URL from meta tag
const websiteMeta = document.querySelector('meta[name="website-url"]');
const websiteUrl = websiteMeta?.getAttribute("content");
const finalUrl = websiteUrl ? `${websiteUrl}/audit-management` : null;

// Define loadAuditTable globally
window.loadAuditTable = function (
    status = null,
    tableId = "#audit_query_table"
) {
    $(tableId).DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: finalUrl,
            data: {
                status: status,
            },
        },
        columns: columnsForTable,
    });
};

$(document).ready(function () {
    // Auto-trigger the table load
    loadAuditTable();

    // If you have tabs/buttons triggering it:
    document
        .getElementById("defaultOpen")
        ?.addEventListener("click", function () {
            loadAuditTable();
        });
});

$(document).ready(function () {
    let formId = $("#createAuditQuery").length
        ? "#createAuditQuery"
        : "#edit-auditQuery";
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/audit-management/check-letter-no`
        : null;

    $.validator.addMethod(
        "yearRangeFormat",
        function (value, element) {
            if (this.optional(element)) return true;
            return /^\d{4}-\d{4}$/.test(value);
        },
        "Please enter the year range in YYYY-YYYY format."
    );

    $.validator.addMethod(
        "yearRangeSequence",
        function (value, element) {
            if (this.optional(element)) return true;
            var years = value.split("-");
            var startYear = parseInt(years[0], 10);
            var endYear = parseInt(years[1], 10);
            return endYear === startYear + 1;
        },
        "The second year must be exactly one greater than the first."
    );

    $.validator.addMethod(
        "dateAfterLetter",
        function (value, element, params) {
            const letterDate = new Date($(params).val());
            const inputDate = new Date(value);
            return (
                !isNaN(letterDate) &&
                !isNaN(inputDate) &&
                inputDate >= letterDate
            );
        },
        "Date must be on or after the Letter Date."
    );
    $.validator.addMethod(
        "dateAfterFrom",
        function (value, element, params) {
            const fromDate = new Date($(params).val());
            const toDate = new Date(value);
            return !isNaN(fromDate) && !isNaN(toDate) && toDate >= fromDate;
        },
        "To Date must be the same or after From Date."
    );

    $(formId).validate({
        ignore: [],
        rules: {
            subject: {
                required: true,
                maxlength: 500,
            },
            letter_no: {
                required: true,
                remote: {
                    url: finalUrl,
                    type: "post",
                    data: {
                        letter_no: function () {
                            return $("#letter_no").val();
                        },
                        _token: function () {
                            return $('meta[name="csrf-token"]').attr("content");
                        },
                    },
                },
            },
            letter_date: {
                required: true,
            },
            from_date: {
                required: true,
                date: true,
                dateAfterLetter: "#letter_date",
            },
            to_date: {
                required: true,
                date: true,
                dateAfterLetter: "#letter_date",
                dateAfterFrom: "#from_date",
            },
            location: {
                required: true,
            },
            audit_year: {
                required: true,
                yearRangeFormat: true,
                yearRangeSequence: true,
            },
            audit_level: {
                required: true,
            },
            audit_type: {
                required: true,
            },
            pdf_file: {
                required: true,
                extension: "pdf",
            },
        },
        messages: {
            subject: {
                required: "Please enter the subject",
                maxlength: "Character limit of 500 exceeded",
            },
            letter_no: {
                required: "Please enter the letter number",
                remote: "This letter number already exists",
            },
            from_date: {
                required: "Please select a start date",
                date: "Please enter a valid date",
                dateAfterLetter: "From Date cannot be before Letter Date.",
            },
            to_date: {
                required: "Please select a end date",
                date: "Please enter a valid date",
                dateAfterLetter: "To Date cannot be before Letter Date.",
                dateAfterFrom: "To Date cannot be before From Date.",
            },
            pdf_file: {
                required: "Please upload a PDF file",
                extension: "Only PDF files are allowed",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("error-message");
            if (element.attr("name") === "pdf_file") {
                error.appendTo("#pdf_file-error");
            } else {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});

// Upload audit Files
$(document).on("change", ".upload_pdf, .upload_word", function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/audit-management/upload`
        : null;

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute("content");

    let $this = $(this);
    let file = $this[0].files[0];
    if (!file) return;

    // Define allowed types and size limits
    const allowedFileTypes = {
        pdf: ["application/pdf"],
        word: [
            "application/msword",
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        ],
    };
    const sizeLimits = {
        pdf: 2 * 1024 * 1024, // 2 MB
        word: 2 * 1024 * 1024, // 2 MB
    };

    // Detect file type based on input class
    let fileType = null;
    let extString = "";
    let inputName = "";

    if ($this.hasClass("upload_pdf")) {
        fileType = "pdf";
        extString = "pdf";
        inputName = "pdf_file";
    } else if ($this.hasClass("upload_word")) {
        fileType = "word";
        extString = "doc,docx";
        inputName = "word_file";
    } else {
        // Unknown input type, exit
        return;
    }

    // Validate file type
    if (!allowedFileTypes[fileType].includes(file.type)) {
        showError(
            "Invalid File Type",
            fileType === "pdf"
                ? "Only PDF files are allowed."
                : "Only Word files (.doc, .docx) are allowed."
        );
        $this.val("");
        return false;
    }

    if (file.size > sizeLimits[fileType]) {
        showError(
            "File size too large",
            `Please select a ${fileType.toUpperCase()} file smaller than 2 MB!`
        );
        $this.val("");
        return false;
    }

    // Prepare form data
    let formData = new FormData();
    formData.append(inputName, file);
    formData.append("ext", extString);
    formData.append("input_name", inputName);
    formData.append("_token", csrfToken);

    $.ajax({
        url: finalUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === true) {
                let fileUrl = `${websiteUrl}/audit-management/view/files/?pathName=${response.file_path}&fileName=${response.file_name}`;

                $this.hide();
                $this
                    .closest(
                        fileType === "pdf"
                            ? ".attachment_section_upload_pdf"
                            : ".attachment_section_upload_word"
                    )
                    .find(".upload_cust")
                    .hide();

                $this
                    .closest(
                        fileType === "pdf"
                            ? ".attachment_section_upload_pdf"
                            : ".attachment_section_upload_word"
                    )
                    .find(
                        fileType === "pdf" ? ".uploaded_pdf" : ".uploaded_word"
                    )
                    .val(fileUrl);

                $this.siblings('input[type="hidden"]').val(response.file_name);
                let section = $this.closest(
                    fileType === "pdf"
                        ? ".attachment_section_upload_pdf"
                        : ".attachment_section_upload_word"
                );
                section.find("#temp").remove();
                section.append(`
                    <div id="temp" class="my-3">
                        <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>
                        <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="" data-name="${response.file_name}">Re-upload</a>
                    </div>
                `);
            } else {
                showError("Upload Failed", response.message);
                $this.val("");
            }
        },
    });
});

// Re upload File
$(document).on("click", ".reupload-btn, .reupload-word-btn", function () {
    const $this = $(this);
    // Determine which section we're in: PDF or Word
    let section = null,
        fileInput = null,
        uploadCust = null,
        uploadedInput = null;
    if ($this.closest(".attachment_section_upload_pdf").length) {
        section = $this.closest(".attachment_section_upload_pdf");
        fileInput = section.find(".upload_pdf");
        uploadCust = section.find(".upload_cust");
        uploadedInput = section.find(".uploaded_pdf");
    } else if ($this.closest(".attachment_section_upload_word").length) {
        section = $this.closest(".attachment_section_upload_word");
        fileInput = section.find(".upload_word");
        uploadCust = section.find(".upload_cust");
        uploadedInput = section.find(".uploaded_word");
    } else {
        return;
    }

    fileInput.val("").show();
    uploadCust.show();
    section.find("#temp").remove();
    uploadedInput.val("");
    section.find('input[type="hidden"]').val("");
});
