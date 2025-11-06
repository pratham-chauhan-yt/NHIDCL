$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const auditParaId = document.querySelector(
        'input[name="audit_para_table_id"]'
    )?.value;
    const finalUrl =
        websiteUrl && auditParaId
            ? `${websiteUrl}/audit-management/view-audit-para-details/${auditParaId}`
            : null;
    $("#para_details_table").DataTable({
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
            { data: "id", name: "id" },
            { data: "remark", name: "remark" },
            { data: "files", name: "files" },
            { data: "created_by", name: "created_by" },
            { data: "created_at", name: "created_at" },
        ],
    });
});

// const quill = new Quill("#reply-editor", {
//     modules: {
//         syntax: false,
//         toolbar: "#toolbar-container",
//     },
//     placeholder: "Write Here...",
//     theme: "snow",
// });

function format(d) {
    // `d` is the original data object for the row
    return (
        "<dl>" +
        "<dt>Full name:</dt>" +
        "<dd>" +
        d.name +
        "</dd>" +
        "<dt>Extension number:</dt>" +
        "<dd>" +
        d.extn +
        "</dd>" +
        "<dt>Extra info:</dt>" +
        "<dd>And any further details here (images etc)...</dd>" +
        "</dl>"
    );
}

let table = new DataTable("#example", {
    order: [[1, "asc"]],
    rowId: "id",
    stateSave: true,
});

table.on("click", "td.dt-control", function (e) {
    let tr = e.target.closest("tr");
    let row = table.row(tr);

    if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
    } else {
        // Open this row
        row.child(format(row.data())).show();
    }
});

// Add event listener for opening and closing details
table.on("click", "td.dt-control", function (e) {
    let tr = e.target.closest("tr");
    let row = table.row(tr);

    if (row.child.isShown()) {
        // This row is already open - close it
        row.child.hide();
    } else {
        // Open this row
        row.child(format(row.data())).show();
    }
});

// ClassicEditor.create(document.querySelector("#remark"))
//     .then((editor) => {
//         window.remarkEditor = editor; // optional: store reference for later use
//     })
//     .catch((error) => {
//         console.error("CKEditor error:", error);
//     });

// Submit Reply
$(document).ready(function () {
    let formId = $("#auditParaReply");

    $(formId).validate({
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("error-message");
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});

// Drop Para
$(document).on("click", "#dropParaBtn", function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/audit-management/drop-para`
        : null;
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute("content");
    console.log(finalUrl);
    const paraId = $(this).data("id");
    const status_id = $(this).data("status");
    $.ajax({
        url: finalUrl,
        method: "POST",
        data: {
            _token: csrfToken,
            id: paraId,
            status_id: status_id,
        },
        success: function (response) {
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Para dropped successfully!",
                confirmButtonText: "OK",
                showConfirmButton: true,
            });
        },
        error: function (xhr) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Failed to dropped Para.",
            });
            console.error(xhr.responseText);
        },
    });
});

// Upload reply file
$(document).on("change", ".upload_para_reply", function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/audit-management/upload/para/reply`
        : null;

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute("content");

    const $this = $(this);
    const file = this.files[0];
    if (!file) return;

    const allowedFileTypes = {
        pdf: ["application/pdf"],
    };
    const sizeLimits = {
        pdf: 2 * 1024 * 1024, // 2 MB
        word: 2 * 1024 * 1024, // 2 MB
    };

    // Detect file type based on input class
    let fileType = null;
    let extString = "";
    let inputName = "";

    if ($this.hasClass("upload_para_reply")) {
        fileType = "pdf";
        extString = "pdf";
        inputName = "pdf_file";
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

    // Prepare upload
    const formData = new FormData();
    formData.append("pdf_file", file);
    formData.append("ext", "pdf");
    formData.append("input_name", "pdf_file");
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
                            : ""
                    )
                    .find(".upload_cust")
                    .hide();

                $this
                    .closest(
                        fileType === "pdf"
                            ? ".attachment_section_upload_pdf"
                            : ""
                    )
                    .find(fileType === "pdf" ? ".uploaded_pdf" : "")
                    .val(fileUrl);

                $this.siblings('input[type="hidden"]').val(response.file_name);
                let section = $this.closest(
                    fileType === "pdf" ? ".attachment_section_upload_pdf" : ""
                );
                section.find("#temp").remove();
                section.append(`
                    <div id="temp" class="my-3">
                        <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>
                        <a href="javascript:void(0);" class="quick-btn reupload-para-reply focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="" data-name="${response.file_name}">Re-upload</a>
                    </div>
                `);
            } else {
                showError("Upload Failed", response.message);
                $this.val("");
            }
        },
        error: function () {
            showError("Upload Failed", "Something went wrong.");
            $this.val("");
        },
    });
});

$(document).on("click", ".reupload-para-reply", function () {
    const wrapper = $(this).closest(".reply-upload-wrapper");

    wrapper.find("#uploaded_para_reply").val("");
    wrapper.find("#para_reply_file").val("");
    wrapper.find(".upload_para_reply").val("");
    wrapper.find("label.upload_cust").show();
    wrapper.find("#para_reply_file_actions").remove();
});

$(document).on("click", ".show-more", function (e) {
    e.preventDefault();

    const fullMessage = $(this).data("fullmsg");

    Swal.fire({
        title: "Remark",
        html: fullMessage,
        confirmButtonText: "Close",
        customClass: {
            popup: "swal-wide",
        },
    });
});

// Summernote editor
$(document).ready(function () {
    $("#remark").summernote({
        height: 200,
        placeholder: "Write your note here...",

        toolbar: [
            ["style", ["style"]],
            ["font", ["bold", "italic", "underline", "clear"]],
            ["fontsize", ["fontsize"]],
            ["para", ["ul", "ol", "paragraph"]],
            ["insert", ["link"]],
            ["view", ["codeview"]],
        ],
    });
});
