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
    if (pageName === "Knowledgebase") {
        loadTable("knowledgebase query", "#knowledgebaseTable");
    }
}
const websiteMeta = document.querySelector('meta[name="website-url"]');
const websiteUrl = websiteMeta?.getAttribute("content");
const finalUrl = websiteUrl ? `${websiteUrl}/query-management/knowledge-base` : null;
window.loadTable = function (status = null, tableId = "") {
    $(tableId).DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: finalUrl,
            // data: {
            //     status: status,
            // },
        },
        columns: columnsForTable,
    });
};

$(document).ready(function () {
    loadTable();
    document
        .getElementById("defaultOpen")
        ?.addEventListener("click", function () {
            loadTable();
        });
});

// Define the dynamic columns for the DataTable
let columnsForTable = [];

columnsForTable = [
    {
        data: "DT_RowIndex",
        name: "DT_RowIndex",
        orderable: false,
        searchable: false,
    },
    { data: "query_id", name: "query_id" },
    { data: "title", name: "title" },
    { data: "meta_title", name: "meta_title" },
    { data: "created_at", name: "created_at" },
    { data: "created_by", name: "created_by" },
    {
        data: "action",
        name: "action",
        orderable: false,
        searchable: false,
    },
];

// Add Knowledgebase Query
$(document).ready(function () {
    let formId = $("#knowledgeBaseQueryForm").length
        ? "#knowledgeBaseQueryForm"
        : "#editKnowledgeBaseQueryForm";
    $(formId).validate({
        rules: {
            title: {
                required: true,
                maxlength: 150,
            },
            meta_title: {
                required: true,
                maxlength: 60,
            },
            description: {
                required: true,
                maxlength: 250,
            },
            meta_description: {
                required: true,
                maxlength: 160,
            },
        },
        messages: {
            title: {
                required: "Please enter the Title",
                maxlength: "Character limit of 150 exceeded",
            },
            description: {
                required: "Please enter the Description",
                maxlength: "Character limit of 250 exceeded",
            },
            meta_title: {
                required: "Please enter the Meta Title",
                maxlength: "Character limit of 60 exceeded",
            },
            meta_description: {
                required: "Please enter the Meta Description",
                maxlength: "Character limit of 160 exceeded",
            },
        },
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

// Upload Knowledgebase Query Files
$(document).on("change", ".upload_knowledgebase_file", function () {
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
        image: ["image/jpeg", "image/png"],
    };

    let fileType = null;
    let ext = "";
    const input_name = "upload_knowledgebase_file";

    if (allowedTypes.pdf.includes(file.type)) {
        fileType = "pdf";
        ext = "pdf";
    } else if (allowedTypes.image.includes(file.type)) {
        fileType = "image";
        ext = "jpg, jpeg, png";
    } else {
        showError(
            "Invalid File Type",
            "Only PDF or image files (jpg, jpeg, png) are allowed."
        );
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
    formData.append("file_path", "uploads/qms-knowladgebase-file/");
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
                $("#uploaded_knowledgebase_file").val(fileUrl);
                $("#knowledgebase_file").val(response.file_name);
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
