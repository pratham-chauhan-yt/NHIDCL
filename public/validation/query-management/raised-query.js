// Raised Query table
$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/query-management/raised-query`
        : null;

    $("#raisedQueryTable").DataTable({
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
            { data: "query_type", name: "query_type" },
            { data: "title", name: "title" },
            { data: "query_type", name: "query_type" },
            { data: "created_at", name: "created_at" },
            { data: "query_raised_by", name: "query_raised_by" },
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

// Summernote editor
$(document).ready(function () {
    $("#description").summernote({
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

// Query Reply form
$(document).ready(function () {
    const $form = $("#queryReplyForm");

    // if (!$form.length) {
    //     console.warn("Form #queryReplyForm not found!");
    //     return;
    // }

    $form.validate({
        ignore: [],
        rules: {
            description: {
                required: true,
                maxlength: 300,
            },
        },
        messages: {
            description: {
                required: "Please enter the Remark",
                maxlength: "Character limit of 300 exceeded",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("error-message text-red-600 text-sm mt-1 block");
            if (element.next(".error-message").length === 0) {
                error.insertAfter(element);
            }
        },
        submitHandler: function (form) {
            form.submit();
        },
    });
});

// Upload Reply Query Files
$(document).on("change", ".upload_reply_file", function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/query-management/upload-file`
        : null;
    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute("content");
    let $this = $(this);
    let file = $this[0].files[0];
    if (!file) return;
    const allowedTypes = {
        pdf: ["application/pdf"],
    };

    let fileType = null;
    let ext = "";
    const input_name = "upload_reply_file";

    if (allowedTypes.pdf.includes(file.type)) {
        fileType = "pdf";
        ext = "pdf";
    } else {
        showError("Invalid File Type", "Only PDF files are allowed.");
        $this.val("");
        return false;
    }

    const maxSize = 2 * 1024 * 1024;
    if (file.size > maxSize) {
        showError(
            "File Too Large",
            `Please upload a ${fileType.toUpperCase()} file smaller than 2 MB.`
        );
        $this.val("");
        return false;
    }
    const formData = new FormData();
    formData.append(input_name, file); // The actual file
    formData.append("ext", ext); // File extension info
    formData.append("input_file_name", input_name);
    formData.append("file_path", "uploads/qms-reply-file/");
    formData.append("_token", csrfToken);

    $.ajax({
        url: finalUrl,
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === true) {
                const fileUrl = `${websiteUrl}/query-management/view-file/?pathName=${response.file_path}&fileName=${response.file_name}`;
                $("#uploaded_reply_file").val(fileUrl);
                $("#reply_file").val(response.file_name);
                $this.hide();
                $this.closest("label.upload_cust").hide();
                $this.closest(".flex").find("#temp").remove();
                $this.closest(".flex").after(`
                    <div id="temp" class="my-3">
                        <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>
                        <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="" data-name="${response.file_name}">Re-upload</a>
                    </div>
                `);
            } else {
                showError(
                    "Upload Failed",
                    response.message || "An error occurred."
                );
                $this.val("");
            }
        },
        error: function () {
            showError(
                "Server Error",
                "Could not upload the file. Please try again."
            );
            $this.val("");
        },
    });
});

// Re upload File
$(document).on("click", ".reupload-btn", function () {
    const $this = $(this);
    const section = $this.closest(".flex");
    const fileInput = section.find(".upload_knowledge_file");
    const uploadCust = section.find("label.upload_cust");
    const uploadedInput = section.find("#uploaded_knowledge_file");
    const hiddenInput = section.find("#knowledge_file");

    fileInput.val("").show();
    uploadCust.show();
    uploadedInput.val("");
    hiddenInput.val("");

    section.find("#temp").remove();
});

// Query Replied Table
$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const encryptedId = document.getElementById("query").dataset.id;
    const finalUrl = websiteUrl ? `${websiteUrl}/query-management/query-details/${encryptedId }` : null;
    console.log(finalUrl);
    $("#queryRepliedTable").DataTable({
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
            { data: "message", name: "message" },
            { data: "file", name: "file" },
            { data: "replied_by", name: "replied_by" },
            { data: "replied_date", name: "replied_date" },
        ],
    });
});

// Show fill reply msg
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
