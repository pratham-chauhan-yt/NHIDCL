$(document).ready(function () {
    $('.js-select2').select2();

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/document-management/sharing` : null;

    // Function to fetch users
    function fetchUsers(shareType) {
        let $userSelect = $('#ref_users_id');

        if (!shareType) {
            $userSelect.empty().append('<option value="">Select User</option>').trigger('change');
            return;
        }

        $.ajax({
            url: `${finalUrl}/create`, // ✅ adjust route name
            type: "GET",
            data: { share_type: shareType },
            beforeSend: function () {
                $userSelect.empty()
                    .append('<option value="">Loading...</option>')
                    .trigger('change');
            },
            success: function (response) {
                $userSelect.empty().append('<option value="">Select User</option>');

                if (response.users && response.users.length > 0) {
                    $.each(response.users, function (i, user) {
                        $userSelect.append(new Option(`${user.name} (${user.email})`, user.id));
                    });
                } else {
                    $userSelect.append('<option value="">No users found</option>');
                }

                $userSelect.trigger('change'); // refresh Select2
            },
            error: function (xhr) {
                $userSelect.empty()
                    .append('<option value="">Error loading users</option>')
                    .trigger('change');
            }
        });
    }

    // On Share Type change
    $('#share_type').on('change', function () {
        fetchUsers($(this).val());
    });

    // ✅ Auto-fetch if share_type already has a value (e.g. edit mode)
    let initialShareType = $('#share_type').val();
    if (initialShareType) {
        fetchUsers(initialShareType);
    }

    const columnConfigs = {
        "Shared-Documents": [
            {
                data: null,
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1
            },
            { data: "title", name: "title" },
            { data: "remark", name: "remark" },
            { data: "share_type", name: "share_type" },
            { data: "shared_with", name: "shared_with", orderable: true, searchable: true },
            { data: "created_at", name: "created_at" },
            { data: "file", orderable: false, searchable: false },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "approved_by", name: "approved_by", orderable: true, searchable: true },
        ]
    };

    const tableIdMap = {
        "Shared-Documents": "Shared-DocumentsTable"
    };

    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");

        if (!columnConfigs[render] || !tableIdMap[render]) {
            console.warn(`No config found for tab: ${render}`);
            return;
        }

        DataTableManager.init(
            render,
            DataTableManager.addActionCols(render, [...columnConfigs[render]], tableIdMap),
            tableIdMap,
            finalUrl,
            "GET"
        );
    });

    initializePopovers = function () {
        $('[data-popover]').each(function () {
            const targetEl = $(this)[0];
            const triggerEl = $(this).prev('[data-popover-target]')[0];
            const options = {
                placement: 'left',
                triggerType: 'hover',
                offset: 5,
                opacity: 0
            };

            if (targetEl && triggerEl) {
                new Popover(targetEl, triggerEl, options);
            }
        });
    };

    initializePopovers();
    // Attach popover init to ALL datatables on draw
    $.each(tableIdMap, function (key, tableId) {
        $('#' + tableId).DataTable().on('draw', function () {
            initializePopovers();
        });
    });

    initValidation("#share-document-form", {
        title: { required: true, minlength: 3 },
        upload_doc: { required: true, extension: "pdf", filesize: 40 * 1024 * 1024 },
        upload_doc_url: { required: true },
        remark: { maxlength: 255 },
        share_type: { required: true },
        ref_users_id: { required: true }
    }, {
        title: {
            required: "Please enter the title",
            minlength: "Title must be at least 3 characters"
        },
        upload_doc: {
            required: "Please upload a document",
            extension: "Only PDF files are allowed",
            filesize: "File size must not exceed 40 MB"
        },
        upload_doc_url: "Please upload a document",
        remark: { maxlength: "Remark must not exceed 255 characters" },
        share_type: "Please select how to share the document",
        ref_users_id: "Please select a user"
    });

    initFileUpload({
        inputSelector: ".upload_doc",
        allowedTypes: ["application/pdf"],
        allowedExt: ["pdf"],                // optional fallback
        allowedTypesText: "PDF",
        maxSize: 40 * 1024 * 1024,           // 40 MB
        maxSizeText: "40MB",
        formDataKey: "upload_doc",
        uploadUrl: "document-management/storeSharedDocument",
        viewUrl: "document-management/viewSharedFiles",
        pathName: "uploads/document-management/shared/",
        sectionClass: ".attachment_section_doc",
        hideClass: ".hide_upload_doc_btn",
        hiddenInput: "#upload_doc_url",
        viewClass: "report_preview_support_photo",
        removeClass: "report_remove_doc",
        prefix: "doc",
        single: true                        // keep only one preview (default)
    });

});
