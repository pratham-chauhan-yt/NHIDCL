// Raised Query table
$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");

    initFileUpload({
        inputSelector: ".upload_doc",
        allowedTypes: ["application/pdf"],
        allowedExt: ["pdf"], // optional fallback
        allowedTypesText: "PDF",
        maxSize: 2 * 1024 * 1024, // 2 MB
        maxSizeText: "2MB",
        formDataKey: "upload_doc",
        uploadUrl: "query-management/upload-file",
        viewUrl: "query-management/view-file",
        pathName: "uploads/qms-reply-file/",
        sectionClass: ".attachment_section_upload_doc",
        hideClass: ".hide_upload_doc_btn",
        hiddenInput: "#upload_doc_url",
        viewClass: "report_preview_support_photo",
        removeClass: "report_remove_doc",
        prefix: "upload_doc",
        single: true,
    });

    // Query Replied Table
    const encryptedId = document.getElementById("query").dataset.id;
    const queryDetailsUrl = websiteUrl
        ? `${websiteUrl}/query-management/query-details/${encryptedId}`
        : null;
    const table = $("#queryRepliedTable").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: queryDetailsUrl,
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

    // Handle show-more click to display full message in Swal
    $("#queryRepliedTable tbody").on("click", ".show-more", function () {
        const tr = $(this).closest("tr");
        const row = table.row(tr);
        const htmlEncoded = row.data().full_message;
        const decodedHtml = $("<textarea/>").html(htmlEncoded).text();

        Swal.fire({
            title: "Reply/Comment",
            html: `<div class="quill-rendered">${decodedHtml}</div>`,
            showCloseButton: true,
            showConfirmButton: false,
            allowOutsideClick: false,
            customClass: {
                popup: "swal-wide",
                title: "custom-title",
            },
            didOpen: () => {
                document.querySelector(".custom-title").style.fontSize =
                    "1.2em";
                const renderedContainer = Swal.getHtmlContainer();
                if (renderedContainer) {
                    renderedContainer.querySelectorAll("img").forEach((img) => {
                        img.style.cursor = "pointer";
                        img.addEventListener("click", () => {
                            window.open(
                                img.src,
                                "_blank",
                                "noopener,noreferrer"
                            );
                        });
                    });
                }
            },
        });
    });

    // Quill Editor Initialization
    const quill = new Quill("#editor-container", {
        modules: {
            toolbar: [
                [{ font: [] }, { size: [] }],
                ["bold", "italic", "underline", "strike"],
                [{ color: [] }, { background: [] }],
                [{ script: "sub" }, { script: "super" }],
                [{ header: "1" }, { header: "2" }, "blockquote", "code-block"],
                [
                    { list: "ordered" },
                    { list: "bullet" },
                    { indent: "-1" },
                    { indent: "+1" },
                ],
                [{ direction: "rtl" }, { align: [] }],
                ["link", "image"],
                ["clean"],
            ],
        },
        placeholder: "Type your reply here...",
        theme: "snow",
    });

    let toolbar = quill.getModule("toolbar");
    toolbar.addHandler("image", () => {
        const input = document.createElement("input");
        input.setAttribute("type", "file");
        input.setAttribute("accept", "image/*");
        input.click();

        input.onchange = function () {
            const finalUrl = websiteUrl
                ? `${websiteUrl}/query-management/upload-file`
                : "/query-management/upload-file";

            const csrfMeta = document.querySelector('meta[name="csrf-token"]');
            const csrfToken = csrfMeta?.getAttribute("content");

            const file = input.files[0];
            if (!file) return;

            // Allowed image types
            const allowedTypes = {
                image: [
                    "image/jpeg",
                    "image/png",
                    "image/jpg",
                    "image/gif",
                    "image/webp",
                ],
            };

            let fileType = null;
            let ext = "";

            if (allowedTypes.image.includes(file.type)) {
                fileType = "image";
                ext = file.type.split("/")[1];
            } else {
                showError(
                    "Invalid File Type",
                    "Only JPG, PNG, GIF, or WEBP images are allowed."
                );
                return false;
            }

            // Max 2 MB size limit
            const maxSize = 2 * 1024 * 1024;
            if (file.size > maxSize) {
                showError(
                    "File Too Large",
                    "Please upload an image smaller than 2 MB."
                );
                return false;
            }

            const formData = new FormData();
            formData.append("upload_reply_file", file);
            formData.append(
                "ext",
                JSON.stringify(["jpeg", "jpg", "png", "gif", "webp"])
            );
            formData.append("folderPath", "uploads/quill-images/");
            formData.append("inputName", "upload_reply_file");
            formData.append("_token", csrfToken);

            $.ajax({
                url: finalUrl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log(response);
                    if (response.status === true) {
                        const imageUrl = `${websiteUrl}/query-management/view-file/?pathName=${response.file_path}&fileName=${response.file_name}`;
                        const range = quill.getSelection(true);
                        quill.insertEmbed(range.index, "image", imageUrl);
                        showSuccess(
                            "Image Uploaded",
                            "Your image has been inserted successfully."
                        );
                    } else {
                        showError(
                            "Upload Failed",
                            response.message || "An error occurred."
                        );
                    }
                },
                error: function (xhr) {
                    console.error("Upload error:", xhr.responseJSON?.message);
                    showError(
                        "Server Error",
                        xhr.responseJSON?.message ||
                            "Could not upload the image. Please try again."
                    );
                },
            });
        };
    });

    let clickedAction = null;
    $("button[type=submit]").on("click", function () {
        clickedAction = $(this).val(); // store the clicked button value
    });

    $("#queryReplyForm").validate({
        ignore: [],
        rules: {
            description: {
                required: function () {
                    const plainText = quill.getText().trim();
                    return plainText.length <= 2;
                },
            },
        },
        messages: {
            description: {
                // required: "Please enter a reply/comment with a minimum of 3 characters.",
                required: "Please enter at least 3 characters.",
            },
        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass("error-message text-red-600 text-sm mt-1 block");
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            document.querySelector("input[name=description]").value =
                quill.root.innerHTML;
            if (clickedAction) {
                $("<input>")
                    .attr({
                        type: "hidden",
                        name: "action",
                        value: clickedAction,
                    })
                    .appendTo(form);
            }
            form.submit();
        },
    });
});
