$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl ? `${websiteUrl}/audit-management` : null;

    $("#audit_query_table").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
            },
            { data: "letter_no", name: "letter_no" },
            { data: "letter_date", name: "letter_date" },
            { data: "subject", name: "subject" },
            { data: "created_by", name: "created_by" },
            { data: "status", name: "status" },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });
});

$(document).ready(function () {
    let formId = $("#createAuditPara").length
        ? "#createAuditPara"
        : "#edit-auditPara";

    $(formId).validate({
        ignore: [],
        rules: {
            audit_para_year: {
                required: true,
            },
            para_letter_no: {
                required: true,
            },
            title: {
                required: true,
                maxlength: 250,
            },
            brief_para: {
                required: true,
                maxlength: 500,
            },
            query_type: {
                required: true,
            },
            ref_part_id: {
                required: true,
            },
            office: {
                required: true,
            },
            department: {
                required: true,
            },
            assign_to: {
                required: true,
            },
            para_pdf_file: {
                required: true,
                extension: "pdf",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("error-message");

            if (element.attr("name") === "para_pdf_file") {
                $("#pdf_para_file-error").html("");
                error.appendTo("#pdf_para_file-error");
            } else {
                error.insertAfter(element);
            }
        },

        submitHandler: function (form) {
            form.submit();
        },
    });
});

// Show letter no onchange of audit year
$("#audit_para_year").on("change", function () {
    const year = $(this).val();
    const $letterNo = $("#para_letter_no");

    $letterNo.html('<option value="">Loading...</option>');

    if (year) {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute("content");
        $.ajax({
            url: `${websiteUrl}/audit-management/get-letterNo`,
            type: "GET",
            data: { year: year },
            success: function (data) {
                $letterNo
                    .empty()
                    .append('<option value="">Select Letter No.</option>');
                $.each(data, function (index, item) {
                    $letterNo.append(
                        '<option value="' +
                            item.id +
                            '">' +
                            item.letter_no +
                            "</option>"
                    );
                });
            },
            error: function (data) {
                $letterNo.html('<option value="">Failed to load</option>');
            },
        });
    } else {
        $letterNo.html('<option value="">Select Letter No.</option>');
    }
});

// Upload audit Para Files
$(document).on("change", ".upload_para_pdf, .upload_para_word", function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/audit-management/upload/para`
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

    if ($this.hasClass("upload_para_pdf")) {
        fileType = "pdf";
        extString = "pdf";
        inputName = "pdf_file";
    } else if ($this.hasClass("upload_para_word")) {
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
                            ? ".attachment_section_upload_para_pdf"
                            : ".attachment_section_upload_para_word"
                    )
                    .find(".upload_cust")
                    .hide();

                $this
                    .closest(
                        fileType === "pdf"
                            ? ".attachment_section_upload_para_pdf"
                            : ".attachment_section_upload_para_word"
                    )
                    .find(
                        fileType === "pdf" ? ".uploaded_pdf" : ".uploaded_word"
                    )
                    .val(fileUrl);

                $this.siblings('input[type="hidden"]').val(response.file_name);
                let section = $this.closest(
                    fileType === "pdf"
                        ? ".attachment_section_upload_para_pdf"
                        : ".attachment_section_upload_para_word"
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

// Reupload the file
$(document).on("click", ".reupload-btn", function () {
    const $this = $(this);
    // Determine which section we're in: PDF or Word
    let section = null,
        fileInput = null,
        uploadCust = null,
        uploadedInput = null;
    if ($this.closest(".attachment_section_upload_para_pdf").length) {
        section = $this.closest(".attachment_section_upload_para_pdf");
        fileInput = section.find(".upload_para_pdf");
        uploadCust = section.find(".upload_cust");
        uploadedInput = section.find(".uploaded_para_pdf");
    } else if ($this.closest(".attachment_section_upload_para_word").length) {
        section = $this.closest(".attachment_section_upload_para_word");
        fileInput = section.find(".upload_para_word");
        uploadCust = section.find(".upload_cust");
        uploadedInput = section.find(".uploaded_para_word");
    } else {
        return;
    }

    fileInput.val("").show();
    uploadCust.show();
    section.find("#temp").remove();
    uploadedInput.val("");
    section.find('input[type="hidden"]').val("");
});

// show assign user on change of department
$(document).on("change", 'select[name="department"]', function () {
    const departmentId = $(this).val();
    const $assignTo = $('select[name="assign_to"]');
    $assignTo.html('<option value="">Loading...</option>');
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");

    if (departmentId) {
        $.ajax({
            url: `${websiteUrl}/audit-management/get-users-by-department`,
            type: "GET",
            data: { department_id: departmentId },
            success: function (data) {
                $assignTo
                    .empty()
                    .append('<option value="">Select Candidate</option>');
                $.each(data, function (index, user) {
                    $assignTo.append(
                        `<option value="${user.id}">${user.name} (${user.email})</option>`
                    );
                });
            },
            error: function () {
                $assignTo.html(
                    '<option value="">Failed to load users</option>'
                );
            },
        });
    } else {
        $assignTo.html('<option value="">Select Candidate</option>');
    }
});
