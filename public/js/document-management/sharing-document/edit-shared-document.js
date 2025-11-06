$(document).ready(function () {
    $('.js-select2').select2();

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/document-management/sharing` : null;

    function fetchUsers(shareType, selectedUserId = null) {
        let $userSelect = $('#ref_users_id');

        if (!shareType) {
            $userSelect.empty().append('<option value="">Select User</option>').trigger('change');
            return;
        }

        $.ajax({
            url: `${finalUrl}/create`,
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

                    if (selectedUserId) {
                        $userSelect.val(selectedUserId).trigger('change');
                    }
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
    let selectedUserId = $('#ref_users_id').data('selected-user') || null;
    if (initialShareType) {
        fetchUsers(initialShareType, selectedUserId);
    }

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

    // If there's an existing uploaded document, show preview and hide upload button
    if ($('#upload_doc_url').val())
        $('.attachment_section_doc').find('.hide_upload_doc_btn').hide();

    initFileUpload({
        inputSelector: ".upload_doc",
        allowedTypes: ["application/pdf"],
        allowedExt: ["pdf"],
        allowedTypesText: "PDF",
        maxSize: 40 * 1024 * 1024,
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
        single: true
    });

});
