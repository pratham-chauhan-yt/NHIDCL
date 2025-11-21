$(document).ready(function () {
    const initDataTable = (selector, ajaxUrl, columns) => {
        if ($(selector).length && typeof ajaxUrl !== "undefined") {
            // Destroy existing DataTable if initialized
            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }
            $(selector).DataTable({
                processing: true,
                serverSide: true,
                ajax: ajaxUrl,
                columns: columns,
            });
        }
    };

    // Attendance Table Columns
    const userViewColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "name", name: "name" },
        { data: "email", name: "email" },
        { data: "mobile", name: "mobile" },
        { data: "date_of_birth", name: "date_of_birth" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action" },
    ];

    // Attendance Table Columns
    const applicantLogColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "name", name: "name" },
        { data: "datetime", name: "datetime" },
        { data: "ip_address", name: "ip_address" },
        { data: "latitude", name: "latitude" },
        { data: "longitude", name: "longitude" },
        { data: "status", name: "status" },
        { data: "comment", name: "comment" },
        { data: "viewfile", name: "viewfile" },
    ];

    // Conditionally initialize each table
    if (typeof usersDataUrl !== "undefined") {
        initDataTable("#usersTable", usersDataUrl, userViewColumns);
    }

    // Conditionally initialize each table
    if (typeof applicantLogDataUrl !== "undefined") {
        initDataTable("#applicantLogDataTable", applicantLogDataUrl, applicantLogColumns);
    }
});

$(document).ready(function () {
    $(document).on("change", ".file-uploader", function () {
        const $this = $(this);
        const file = this.files[0];
        if (!file) return;

        const fileType = $this.data("type") || "pdf";
        const maxSize = parseInt($this.data("max-size")) || 2000000;
        const inputId = $this.data("input-id");
        const previewWrapper = $this.data("preview-wrapper");
        const hiddenInput = $this.data("hidden-input");

        let uploadUrl = $this.data("upload-url");
        let viewUrl = $this.data("view-url");

        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, ""); // remove trailing slash

        if (websiteUrl && uploadUrl) {
            uploadUrl = `${websiteUrl}/${uploadUrl.replace(/^\/+/, "")}`; // remove leading slash from uploadUrl
        }

        if (websiteUrl && viewUrl) {
            viewUrl = `${websiteUrl}/${viewUrl.replace(/^\/+/, "")}`; // remove leading slash from viewUrl
        }

        // Validate file type
        if (file.type !== `application/${fileType}`) {
            Swal.fire(
                "Warning",
                `Only ${fileType.toUpperCase()} files are allowed.`,
                "warning"
            );
            $this.val("");
            return;
        }

        // Validate size
        if (file.size > maxSize) {
            Swal.fire("Warning", "File size should not exceed 2MB.", "warning");
            $this.val("");
            return;
        }

        // Prepare formData
        const formData = new FormData();
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
        formData.append("_token", csrfToken);
        formData.append($this.attr("name"), file);

        $.ajax({
            url: uploadUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                if (response.status) {
                    const fileName = encodeURIComponent(response.file_name);
                    const pathName = encodeURIComponent(
                        "uploads/recruitment/advertisement/"
                    );
                    const fileUrl = `${viewUrl}?pathName=${pathName}&fileName=${fileName}`;

                    let new_advertisement_file = $("#new_advertisement_file");

                    // If you want encoded path+fileName
                    new_advertisement_file.val(pathName + fileName);

                    
                    $(`#${inputId}`).val(fileUrl);
                    $(`#${hiddenInput}`).val(response.file_name);

                    const previewHtml = `
                        <div class="uploaded-preview">
                            <a href="${fileUrl}" target="_blank" class="bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600">View Document</a>
                            <a href="javascript:void(0);" class="reupload-btn text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2"
                               data-input-id="${inputId}" data-wrapper-id="${previewWrapper}" data-hidden-input="${hiddenInput}">
                               Re-upload
                            </a>
                        </div>
                    `;
                    $(`#${previewWrapper}`).html(previewHtml);
                    $this.closest(".hide_upload_photos").hide();
                } else {
                    Swal.fire(
                        "Error",
                        response.message || "Upload failed.",
                        "error"
                    );
                    $this.val("");
                }
            },
            error: function (xhr, status, error) {
                console.error("Upload failed:", error);
                Swal.fire(
                    "Error",
                    "Unexpected error occurred during file upload.",
                    "error"
                );
                $this.val("");
            },
        });
    });

    // Handle re-upload button
    $(document).on("click", ".reupload-btn", function () {
        const inputId = $(this).data("input-id");
        const wrapperId = $(this).data("wrapper-id");
        const hiddenInput = $(this).data("hidden-input");

        $(`#${inputId}`).val("");
        $(`#${hiddenInput}`).val("");
        $(`#${wrapperId}`).html("");

        // Also reveal upload button if hidden
        $(this)
            .closest(".attachment_section_photos")
            .find(".hide_upload_photos")
            .show();
    });

    $(document).on("change", ".advertisement_id", function () {
        let $this = $(this);
        let advertisementId = $this.val();
        const loader = document.querySelector(".loader");
        if (!advertisementId) return;
        loader.style.display = "block";
        let formData = "advertisementId=" + encodeURIComponent(advertisementId);
        let url = window.location.href;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                if (response.status === true && Array.isArray(response.data)) {
                    let $postSelect = $("#postId");
                    $postSelect.empty(); // clear previous options
                    $postSelect.append(
                        '<option value="">Choose posts</option>'
                    );

                    response.data.forEach(function (post) {
                        $postSelect.append(
                            '<option value="' +
                                post.id +
                                '">' +
                                post.post_name +
                                "</option>"
                        );
                    });
                } else {
                    Swal.fire(
                        "Info",
                        response.message || "Something went wrong",
                        "info"
                    );
                    $("#postId").html('<option value="">Choose posts</option>'); // reset options
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });

    // If you use Select2, keep this so select changes always bubble to 'change'
    $(document).on("select2:select select2:clear", ".js-single", function () {
        $(this).trigger("change");
    });

    $(document).on("click", ".page-link", function (e) {
        e.preventDefault();
        const page = $(this).data("page");
        if (page) {
            fetchCandidates(page);
        }
    });

    // Handle select change and input change
    $(document).on(
        "change",
        "#candidateFilterForm select, #candidateFilterForm input:not([type=checkbox])",
        function () {
            fetchCandidates();
        }
    );

    let typingTimer; // global or higher scope variable
    const typingDelay = 1000; // 1 seconds

    // Handle typing in inputs (except checkbox)
    $(document).on(
        "keyup",
        "#candidateFilterForm input:not([type=checkbox])",
        function () {
            clearTimeout(typingTimer); // reset timer
            typingTimer = setTimeout(() => {
                fetchCandidates();
            }, typingDelay);
        }
    );

    // Optional: cancel if still typing
    $(document).on(
        "keydown",
        "#candidateFilterForm input:not([type=checkbox])",
        function () {
            clearTimeout(typingTimer);
        }
    );

    // Reusable function
    function fetchCandidates(page = 1) {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, "");

        const $form = $("#candidateFilterForm");

        const advertisementId = $form.find("[name='advertisementId']").val();
        const postId = $form.find("[name='postId']").val();

        const formData = {
            advertisementId: advertisementId,
            postId: postId,
            status: 1,
            name_filter: $form.find("#name_filter").val(),
            email_filter: $form.find("#email_filter").val(),
            mobile_filter: $form.find("#mobile_filter").val(),
            gate_registartion_filter: $form.find("#gate_registartion_filter").val(),
            gate_year_filter: $form.find("#gate_year_filter").val(),
            gate_score_filter: $form.find("#gate_score_filter").val(),
            age_filter: $form.find("#age_filter").val(),
            category_filter: $form.find("#category_filter").val(),
            percentile_filter: $form.find("#percentile_filter").val(),
            gender_filter: $form.find("#gender_filter").val(),
            marital_status_filter: $form.find("#marital_status_filter").val(),
            pwbd_filter: $form.find("#pwbd_filter").val(),
            page: page // added for pagination
        };

        if (!advertisementId || !postId) return;

        const loader = document.querySelector(".loader");
        loader.style.display = "block";

        const url = window.location.href.replace(/\/+$/, "") + "/candidate";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                const $tableBody = $("#postDataTable tbody").empty();

                if (response.status === true && Array.isArray(response.data)) {
                    document.getElementById("total_vacancy_count").innerHTML =
                        response.total;
                    if (!response.data.length) {
                        $tableBody.append(
                            '<tr><td colspan="10">No data found</td></tr>'
                        );
                        $("#paginationContainer").html("");
                        return;
                    }

                    response.data.forEach(function (post, index) {
                        const expiryString = post.advertisement?.expiry_datetime ?? '';
                        let allowEditBtn = '';

                        if (expiryString) {
                            // Parse expiry datetime properly (Laravel usually returns in "YYYY-MM-DD HH:mm:ss" format)
                            const expiry = new Date(expiryString.replace(' ', 'T')); // converts to valid ISO string
                            const now = new Date();

                            if (expiry.getTime() > now.getTime()) {
                                allowEditBtn = `<a href="javascript:void(0);" class="btn btn-default btn-sm bg-blue-700 allow-edit-btn" data-id="${post?.id ?? '0'}">Allow Edit</a>`;
                            }
                        }
                        $tableBody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${post.users?.name ?? ""}</td>
                                <td>${post.users?.email ?? ""}</td>
                                <td>${post.users?.mobile ?? ""}</td>
                                <td>${post.gatescore?.[0]?.gate_registration_number ?? ""}</td>
                                <td>${post.gatescore?.[0]?.gate_score ?? ""}</td>
                                <td>${post.application?.[0]?.caste?.caste ?? ""}</td>
                                <td>${post.status?.status ?? ""}</td>
                                <td>
                                    <a href="${websiteUrl}/recruitment-portal/applicant/profile/view/${post.nhidcl_recruitment_posts_id}/${encodeURIComponent(post.users?.users_id)}" class="btn btn-default btn-sm bg-blue-700" target="_blank">View Profile</a>
                                </td>
                                <td>${allowEditBtn}</td>
                            </tr>
                        `);
                    });

                    // render pagination
                    renderPagination(response.currentPage, response.lastPage);
                } else {
                    Swal.fire("Info", response.message || "Something went wrong", "info");
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    }

    function renderPagination(currentPage, lastPage) {
        const $pagination = $("#paginationContainer");
        $pagination.empty();

        if (lastPage <= 1) return;

        let html = `<nav><ul class="pagination justify-content-center">`;

        // Previous button
        html += `<li class="page-item ${currentPage === 1 ? "disabled" : ""}">
                    <a href="#" class="page-link" data-page="${currentPage - 1}">Previous</a>
                </li>`;

        // Page numbers
        for (let i = 1; i <= lastPage; i++) {
            html += `<li class="page-item ${i === currentPage ? "active" : ""}">
                        <a href="#" class="page-link" data-page="${i}">${i}</a>
                    </li>`;
        }

        // Next button
        html += `<li class="page-item ${currentPage === lastPage ? "disabled" : ""}">
                    <a href="#" class="page-link" data-page="${currentPage + 1}">Next</a>
                </li>`;

        html += `</ul></nav>`;
        $pagination.html(html);
    }



    $(document).on("change", ".assesment_ads_id", function () {
        let $this = $(this);
        let advertisementId = $this.val();
        const loader = document.querySelector(".loader");
        if (!advertisementId) return;
        loader.style.display = "block";
        let formData = "advertisementId=" + encodeURIComponent(advertisementId);
        let url = window.location.href;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                if (response.status === true && Array.isArray(response.data)) {
                    let $postSelect = $("#assesment_post_id");
                    $postSelect.empty(); // clear previous options
                    $postSelect.append(
                        '<option value="">Choose posts</option>'
                    );

                    response.data.forEach(function (post) {
                        $postSelect.append(
                            '<option value="' +
                                post.id +
                                '">' +
                                post.post_name +
                                "</option>"
                        );
                    });
                } else {
                    Swal.fire(
                        "Info",
                        response.message || "Something went wrong",
                        "info"
                    );
                    $("#assesment_post_id").html(
                        '<option value="">Choose advertisement posts</option>'
                    ); // reset options
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });

    $(document).on("change", ".assesment_posts_id", function () {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, ""); // remove trailing slash
        let $this = $(this);
        let postId = $this.val();
        const loader = document.querySelector(".loader");
        if (!postId) return;
        loader.style.display = "block";
        let advertisementId = document.getElementById("assesmentadsId").value;
        let formData =
            "advertisementId=" +
            encodeURIComponent(advertisementId) +
            "&postId=" +
            encodeURIComponent(postId) +
            "&status=3";
        let url = window.location.href + "/candidate";

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                if (response.status === true && Array.isArray(response.data)) {
                    // Clear previous rows
                    let $tableBody = $("#assesmentDataTable tbody");
                    $tableBody.empty();
                    if (response.data.length === 0) {
                        $tableBody.append(
                            '<tr><td colspan="6">No data found</td></tr>'
                        );
                    } else {
                        response.data.forEach(function (post, index) {
                            $tableBody.append(
                                `<tr>
                                    <td>${index + 1}</td>
                                    <td>${post.users?.name ?? "-"}</td>
                                    <td>${post.users?.email ?? "-"}</td>
                                    <td>${post.users?.mobile ?? "-"}</td>
                                    <td>${
                                        post.gatescore?.[0]
                                            ?.gate_registration_number ?? "-"
                                    }</td>
                                    <td>${
                                        post.gatescore?.[0]?.gate_score ?? "-"
                                    }</td>
                                    <td>${
                                        post.gatescore?.[0]?.gate_percentile ??
                                        "-"
                                    }</td>
                                    <td>${post.status?.status ?? "-"}</td>
                                    <td>
                                        <a href="${websiteUrl}/recruitment-portal/applicant/profile/view/${encodeURIComponent(
                                    post.users?.users_id
                                )}" class="btn btn-default btn-sm bg-blue-700" target="_blank">View Profile</a>
                                    </td>
                                    <td>
                                        <div class="flex items-center">
                                            <input type="checkbox" name="application[]" id="application${
                                                index + 1
                                            }" value="${
                                    post.id
                                }" class="checkbox-class">
                                        </div>
                                    </td>
                                </tr>`
                            );
                        });
                    }
                } else {
                    Swal.fire(
                        "Info",
                        response.message || "Something went wrong",
                        "info"
                    );
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });

    $(document).on("change", ".selection_ads_id", function () {
        let $this = $(this);
        let advertisementId = $this.val();
        const loader = document.querySelector(".loader");
        if (!advertisementId) return;
        loader.style.display = "block";
        let formData = "advertisementId=" + encodeURIComponent(advertisementId);
        let url = window.location.href;

        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                if (response.status === true && Array.isArray(response.data)) {
                    let $postSelect = $("#selection_post_id");
                    $postSelect.empty(); // clear previous options
                    $postSelect.append(
                        '<option value="">Choose advertisement posts</option>'
                    );

                    response.data.forEach(function (post) {
                        $postSelect.append(
                            '<option value="' +
                                post.id +
                                '">' +
                                post.post_name +
                                "</option>"
                        );
                    });
                } else {
                    Swal.fire(
                        "Info",
                        response.message || "Something went wrong",
                        "info"
                    );
                    $("#selection_post_id").html(
                        '<option value="">Choose advertisement posts</option>'
                    ); // reset options
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });

    $(document).on("change", ".selection_post_id", function () {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, ""); // remove trailing slash
        let $this = $(this);
        let postId = $this.val();
        const loader = document.querySelector(".loader");
        if (!postId) return;
        loader.style.display = "block";
        let advertisementId = document.getElementById("selectionadsId").value;
        let formData =
            "advertisementId=" +
            encodeURIComponent(advertisementId) +
            "&postId=" +
            encodeURIComponent(postId) +
            "&status=4";
        let url = window.location.href + "/candidate";
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                loader.style.display = "none";
                if (response.status === true && Array.isArray(response.data)) {
                    // Clear previous rows
                    let $tableBody = $("#selectionDataTable tbody");
                    $tableBody.empty();
                    if (response.data.length === 0) {
                        $tableBody.append(
                            '<tr><td colspan="6">No data found</td></tr>'
                        );
                    } else {
                        let interviewDropdown = "";
                        let interviewStatuses = response.interview;
                        let applicationStatuses = response.application;

                        // Step 2: Loop through applications and append rows
                        response.data.forEach(function (post, index) {
                            let interviewStatusId =
                                post.interview?.nhidcl_application_status_id ||
                                "";
                            let interviewId = post.interview?.id || "";
                            let disabled =
                                interviewStatusId == 11 ||
                                interviewStatusId == 12
                                    ? "disabled"
                                    : "";
                            let interviewDropdown = `<select name="interview_status" id="interview_status_${interviewId}" data-app-id="${interviewId}" class="interview_status" ${disabled}>`;

                            interviewStatuses.forEach(function (item) {
                                let selected =
                                    item.id == interviewStatusId
                                        ? "selected"
                                        : "";
                                interviewDropdown += `<option value="${item.id}" ${selected}>${item.status}</option>`;
                            });
                            interviewDropdown += "</select>";

                            let applicationDropdown = "";
                            if (
                                interviewStatusId == 10 ||
                                interviewStatusId == 12 ||
                                post.nhidcl_application_status_id == 6 ||
                                post.nhidcl_application_status_id == 7 ||
                                post.nhidcl_application_status_id == 8
                            ) {
                                applicationDropdown =
                                    post.status?.status ?? "-";
                            } else {
                                let applicationId = post.id || "";
                                let applicationdisabled =
                                    interviewStatusId == 10 ||
                                    interviewStatusId == 12 ||
                                    post.nhidcl_application_status_id == 6 ||
                                    post.nhidcl_application_status_id == 7 ||
                                    post.nhidcl_application_status_id == 8
                                        ? "disabled"
                                        : "";
                                applicationDropdown = `<select name="application_status" id="application_status_${applicationId}" data-app-id="${applicationId}" class="application_status" ${applicationdisabled}>`;

                                applicationStatuses.forEach(function (items) {
                                    let selected =
                                        items.id == interviewStatusId
                                            ? "selected"
                                            : "";
                                    applicationDropdown += `<option value="${items.id}" ${selected}>${items.status}</option>`;
                                });
                                applicationDropdown += "</select>";
                            }

                            $tableBody.append(
                                `<tr>
                                    <td>${index + 1}</td>
                                    <td>${post.users?.name ?? "-"}</td>
                                    <td>${post.users?.email ?? "-"}</td>
                                    <td>${post.users?.mobile ?? "-"}</td>
                                    <td>${
                                        post.gatescore?.[0]
                                            ?.gate_registration_number ?? "-"
                                    }</td>
                                    <td>${
                                        post.gatescore?.[0]?.gate_score ?? "-"
                                    }</td>
                                    <td>${
                                        post.gatescore?.[0]?.gate_percentile ??
                                        "-"
                                    }</td>
                                    <td>
                                        <div class="form-input">
                                            ${applicationDropdown}
                                        </div>
                                    </td>
                                    <td>
                                        ${
                                            post.resume_file
                                                ? `<a href="${websiteUrl}/recruitment-portal/advertisement/view/files?pathName=${encodeURIComponent(
                                                      post.resume_path
                                                  )}&fileName=${encodeURIComponent(
                                                      post.resume_file
                                                  )}" class="bg-blue-700 hover:bg-blue-800 rounded-lg text-sm px-5 py-2.5 dark:bg-blue-600" target="_blank">
                                                View
                                            </a>`
                                                : "No File"
                                        }
                                    </td>
                                    <td>
                                        <div class="form-input">
                                            ${interviewDropdown}
                                        </div>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"> <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                            </svg>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="javascript:void(0);"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>`
                            );
                        });
                    }
                } else {
                    Swal.fire(
                        "Info",
                        response.message || "Something went wrong",
                        "info"
                    );
                }
            },
            error: function (xhr, status, error) {
                loader.style.display = "none";
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });

    $(document).on("change", ".interview_status", function (e) {
        e.preventDefault();
        e.stopPropagation();
        let $this = $(this);
        let statusId = $this.val();
        let interviewId = $this.data("app-id"); // Get interview ID from data attribute
        const statusText = $this.find("option:selected").text();
        let postUrl = window.location.href + "/interview/status";

        if (!statusId) return;

        // If status is Passed or Failed (IDs 11 or 12), show confirmation with remarks
        if (statusId == 11 || statusId == 12) {
            Swal.fire({
                title: `Are you sure to mark as ${statusText}?`,
                input: "textarea",
                inputLabel: "Remarks (required)",
                inputPlaceholder: "Enter remarks here...",
                inputAttributes: {
                    "aria-label": "Enter remarks here",
                },
                showCancelButton: true,
                confirmButtonText: "Yes, Submit",
                cancelButtonText: "Cancel",
                inputValidator: (value) => {
                    if (!value) {
                        return "Remarks are required!";
                    }
                },
            }).then((result) => {
                if (result.isConfirmed) {
                    let remarks = result.value;

                    // Send update via AJAX
                    $.ajax({
                        url: postUrl, // your backend endpoint
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr(
                                "content"
                            ),
                            interview_id: interviewId,
                            status_id: statusId,
                            remarks: remarks,
                        },
                        success: function (res) {
                            if (res.status) {
                                Swal.fire(
                                    "Success",
                                    res.message ||
                                        "Interview status updated successfully!",
                                    "success"
                                );
                                $this.prop("disabled", true);
                            } else {
                                Swal.fire(
                                    "Error",
                                    res.message || "Something went wrong.",
                                    "error"
                                );
                            }
                        },
                        error: function (xhr) {
                            let errorMsg = "Failed to update interview status.";
                            if (xhr.responseJSON?.message) {
                                errorMsg = xhr.responseJSON.message;
                            }
                            Swal.fire("Error", errorMsg, "error");
                        },
                    });
                } else {
                    // Reset selection if cancelled
                    $this.val("").trigger("change.select2");
                }
            });
        } else {
            Swal.fire("Info", "Status updated to: " + statusText, "info");
        }
        return false;
    });

    $(document).on("change", ".application_status", function (e) {
        e.preventDefault();
        e.stopPropagation();
        let $this = $(this);
        let applicationStatusId = $this.val();
        let applicationId = $this.data("app-id"); // Get application ID from data attribute
        const statusText = $this.find("option:selected").text();
        let postUrl = window.location.href + "/application/status";

        if (!applicationStatusId) return;

        if (![1, 2, 3, 4].includes(parseInt(applicationStatusId))) {
            Swal.fire({
                title: `Are you sure to mark as ${statusText}?`,
                html: `
                    <textarea name="remarks" id="remarks" class="form-control" placeholder="Enter remarks here..."></textarea>
                    ${
                        applicationStatusId == 7
                            ? `
                        <input type="file" name="offer_letter" id="offer_letter" class="form-control" accept=".pdf,.doc,.docx" />
                        <input type="date" name="joining_date" id="joining_date" class="form-control" />
                    `
                            : ""
                    }
                `,
                showCancelButton: true,
                confirmButtonText: "Yes, Submit",
                cancelButtonText: "Cancel",
                focusConfirm: false,
                preConfirm: () => {
                    const popup = Swal.getPopup();
                    const remarks = popup
                        .querySelector("#remarks")
                        ?.value?.trim();

                    if (!remarks) {
                        Swal.showValidationMessage("Remarks are required!");
                        return false;
                    }

                    if (applicationStatusId == 7) {
                        const offerLetter =
                            popup.querySelector("#offer_letter")?.files?.[0];
                        const joiningDate =
                            popup.querySelector("#joining_date")?.value;

                        if (!offerLetter) {
                            Swal.showValidationMessage(
                                "Offer Letter is required!"
                            );
                            return false;
                        }

                        if (!joiningDate) {
                            Swal.showValidationMessage(
                                "Joining Date is required!"
                            );
                            return false;
                        }

                        return {
                            remarks,
                            offer_letter: offerLetter,
                            joining_date: joiningDate,
                        };
                    }
                    return { remarks };
                },
            }).then((result) => {
                if (!result.isConfirmed) {
                    $this.val("").trigger("change.select2");
                    return;
                }

                const data = result.value;
                const formData = new FormData();
                formData.append(
                    "_token",
                    $('meta[name="csrf-token"]').attr("content")
                );
                formData.append("application_id", applicationId);
                formData.append("status_id", applicationStatusId);
                formData.append("remarks", data.remarks);

                if (applicationStatusId == 7) {
                    formData.append("offer_letter", data.offer_letter);
                    formData.append("joining_date", data.joining_date);
                }

                // Send update via AJAX
                $.ajax({
                    url: postUrl,
                    method: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function (res) {
                        if (res.status) {
                            Swal.fire(
                                "Success",
                                res.message ||
                                    "Application status updated successfully!",
                                "success"
                            );
                            $this.prop("disabled", true);
                        } else {
                            Swal.fire(
                                "Error",
                                res.message || "Something went wrong.",
                                "error"
                            );
                        }
                    },
                    error: function (xhr) {
                        let errorMsg = "Failed to update application status.";
                        if (xhr.responseJSON?.message) {
                            errorMsg = xhr.responseJSON.message;
                        }
                        Swal.fire("Error", errorMsg, "error");
                    },
                });
            });
        } else {
            Swal.fire("Info", "Status updated to: " + statusText, "info");
        }
        return false;
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const groups = {
        first: {
            radios: document.querySelectorAll(
                'input[name="priority_choice_first"]'
            ),
            hidden: document.getElementById("priority_choice_first_states"),
        },
        second: {
            radios: document.querySelectorAll(
                'input[name="priority_choice_second"]'
            ),
            hidden: document.getElementById("priority_choice_second_states"),
        },
        third: {
            radios: document.querySelectorAll(
                'input[name="priority_choice_three"]'
            ),
            hidden: document.getElementById("priority_choice_three_states"),
        },
    };

    function getSelected(group) {
        return document.querySelector(
            `input[name="priority_choice_${group}"]:checked`
        );
    }

    function validateChoices() {
        let selected = {
            first: getSelected("first"),
            second: getSelected("second"),
            third: getSelected("three"),
        };

        // Check for duplicates dynamically
        const pairs = [
            ["first", "second"],
            ["first", "third"],
            ["second", "third"],
        ];

        for (const [a, b] of pairs) {
            if (
                selected[a] &&
                selected[b] &&
                selected[a].value === selected[b].value
            ) {
                Swal.fire(
                    "Info",
                    `Priority ${a} and Priority ${b} cannot be the same group`,
                    "info"
                );
                selected[b].checked = false;
                selected[b] = null;
            }
        }

        // Update hidden inputs
        for (const key in groups) {
            groups[key].hidden.value = selected[key]
                ? selected[key].dataset.stateId
                : "";
        }
    }

    // Attach listeners in one loop
    Object.values(groups).forEach((group) => {
        group.radios.forEach((radio) =>
            radio.addEventListener("change", validateChoices)
        );
    });
});

function confirmShortlistSwal() {
    // Check if at least one checkbox is selected
    let checked = $("input[name='application[]']:checked").length > 0;
    let remarks = $("#remarks").val().trim();

    if (!checked) {
        Swal.fire(
            "Warning",
            "Please select at least one application.",
            "warning"
        );
        return;
    }

    if (remarks === "") {
        Swal.fire("Warning", "Remarks are required.", "warning");
        return;
    }

    // Confirmation
    Swal.fire({
        title: "Are you sure?",
        text: "You are about to generate the shortlist.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, generate it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form manually
            $("#candidateFilterForm").submit();
        }
    });
}

function confirmAssessmentSwal() {
    // Check if at least one checkbox is selected
    let checked = $("input[name='application[]']:checked").length > 0;
    let assesment = $("input[name='assesment']:checked").length > 0;
    let remarks = $("#assesment_remarks").val().trim();

    if (!checked) {
        Swal.fire(
            "Warning",
            "Please select at least one application.",
            "warning"
        );
        return;
    }

    if (!assesment) {
        Swal.fire(
            "Warning",
            "Please choose at least one Schedule assessment type.",
            "warning"
        );
        return;
    }

    if (remarks === "") {
        Swal.fire("Warning", "Remarks are required.", "warning");
        return;
    }

    // Confirmation
    Swal.fire({
        title: "Are you sure?",
        text: "You are about to generate assessment for candidate.",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, generate it!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Submit form manually
            $("#candidateAssessmentForm").submit();
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const exportBtn = document.getElementById("exportSelectionData");
    if (!exportBtn) return;
    exportBtn.addEventListener("click", function (e) {
        e.preventDefault();

        // Get filter values
        const advertisementId =
            parseInt(document.getElementById("advertisementId")?.value) || 0;
        const postId = parseInt(document.getElementById("postId")?.value) || 0;
        const name = $("#name_filter").val().trim();
        const email = $("#email_filter").val().trim();
        const mobile = $("#mobile_filter").val().trim();
        const gateRegNumber = $("#gate_registartion_filter").val().trim();
        const gateYear = $("#gate_year_filter").val().trim();
        const gateScore = $("#gate_score_filter").val().trim();
        const age = $("#age_filter").val().trim();
        const category = $("#category_filter").val().trim();
        const gender = $("#gender_filter").val().trim();
        const marital = $("#marital_status_filter").val().trim();
        const pwbd = $("#pwbd_filter").val().trim();

        // Validations
        if (!advertisementId) {
            Swal.fire("Warning", "Please select advertisement.", "warning");
            return;
        }

        if (!postId) {
            Swal.fire(
                "Warning",
                "Please select advertisement post.",
                "warning"
            );
            return;
        }
        $("#loader").show();
        // Build export URL with query params
        const queryParams = new URLSearchParams({
            advertisement_id: advertisementId,
            post_id: postId,
            name: name,
            email: email,
            mobile: mobile,
            gate_reg_number: gateRegNumber,

            gate_year: gateYear,
            gate_score: gateScore,
            age: age,
            category: category,
            gender: gender,
            marital: marital,
            pwbd: pwbd,
        }).toString();
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, ""); // remove trailing slash
        window.location.href =
            websiteUrl +
            `/recruitment-portal/export/selection/data?${queryParams}`;
        // Hide loader after 5 seconds
        setTimeout(() => {
            $("#loader").hide();
        }, 5000);
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const maritalStatus = document.getElementById("marital_status");
    const spouseWrapper = document.getElementById("spouse_name_wrapper");
    if(maritalStatus){
        function toggleSpouseField() {
            if (maritalStatus.value === "Married") {
                spouseWrapper.style.display = "block";
            } else {
                spouseWrapper.style.display = "none";
                document.getElementById("spouse_name").value = ""; // clear if hidden
            }
        }

        // On page load
        toggleSpouseField();
        // On change
        maritalStatus.addEventListener("change", toggleSpouseField);
    }
});

$(document).ready(function() {
    // Use delegated event binding
    $(document).on('click', '.allow-edit-btn', function() {
        let applicationId = $(this).data('id');
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta
            ?.getAttribute("content")
            ?.replace(/\/+$/, ""); // remove trailing slash

        Swal.fire({
            title: 'Allow Edit',
            html: `
                <textarea id="remarks" class="form-control" rows="3" placeholder="Remarks (optional)"></textarea>
                <input type="file" id="attachment" class="form-control" accept="application/pdf">
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            preConfirm: () => {
                const remarks = Swal.getPopup().querySelector('#remarks').value;
                const fileInput = Swal.getPopup().querySelector('#attachment');
                const file = fileInput.files[0];

                if (!file) {
                    Swal.showValidationMessage('Attachment is required (PDF)');
                    return false;
                } else if (file.type !== 'application/pdf') {
                    Swal.showValidationMessage('Only PDF files are allowed');
                    return false;
                }

                return { remarks: remarks, file: file };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                let formData = new FormData();
                const csrfToken = $('meta[name="csrf-token"]').attr("content");
                formData.append('remarks', result.value.remarks);
                formData.append('attachment', result.value.file);
                formData.append('application_id', applicationId);

                $.ajax({
                    url: websiteUrl+'/recruitment-portal/update-application-status', // Laravel route
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    success: function(response) {
                        if(response.status === 'success'){
                            Swal.fire('Success', response.message, 'success');
                            location.reload();
                        } else {
                            Swal.fire('Error', response.message, 'error');
                        }
                    },
                    error: function(xhr) {
                        let errMsg = 'Something went wrong!';
                        if(xhr.status === 422){
                            // Validation errors
                            errMsg = Object.values(xhr.responseJSON.message).flat().join('<br>');
                        }
                        Swal.fire('Error', errMsg, 'error');
                    }
                });
            }
        });
    });
});
document.querySelectorAll('.dropdown-submenu').forEach(function (element) {
    element.addEventListener('mouseenter', function (e) {
        let submenu = this.querySelector('.dropdown-menu');
        if (submenu) submenu.classList.add('show');
    });

    element.addEventListener('mouseleave', function (e) {
        let submenu = this.querySelector('.dropdown-menu');
        if (submenu) submenu.classList.remove('show');
    });
});