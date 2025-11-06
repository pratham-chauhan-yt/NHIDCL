$(document).ready(function () {
    $('.js-select2').select2();

    let documentType = $('#ref_type_of_document_id').select2('data')[0]?.text.trim() || '';
    function toggleFields() {
        documentType = $('#ref_type_of_document_id').select2('data')[0]?.text.trim() || '';

        const fields = {
            issue_date: $('#field_issue_date'),
            type: $('#field_type'),
            department: $('#field_department'),
            year: $('#field_year'),
            tag_user: $('#field_tag_user')
        };

        // Config for each document type → fields to hide + whether file_number is required
        const config = {
            'Circular': { hide: ['type', 'tag_user', 'year'], fileRequired: true },
            'Policy': { hide: ['type', 'department', 'tag_user', 'year'], fileRequired: false },
            'SOP': { hide: ['type', 'tag_user', 'year'], fileRequired: false },
            'Other': { hide: ['type', 'department', 'issue_date', 'tag_user'], fileRequired: false },
            'default': { hide: ['year'], fileRequired: true }
        };

        // Get config for current type, fallback to default
        const { hide, fileRequired } = config[documentType] || config['default'];

        // Show all fields and make them required
        $.each(fields, (_, field) => {
            field.show().find('select, input').prop('required', true);
            fields.tag_user.find('select').prop('required', false); // tag_user is never required
        });

        // Hide configured fields and remove required
        hide.forEach(key => {
            fields[key].hide().find('select, input').prop('required', false);
        });

        // Toggle file_number required label
        $('#file_number_label').toggleClass('required-label', fileRequired);
    }

    // Bind + init
    $('#ref_type_of_document_id').on('change', toggleFields);
    toggleFields();

    initValidation("#upload-document-form", {
        ref_type_of_document_id: { required: true },
        title: { required: true, minlength: 3 },
        file_number: {
            required: function () {
                return (documentType === "Circular" || documentType === "Office Order");
            }
        },
        issue_date: {
            required: function () { return $("#field_issue_date").is(":visible"); },
            date: true,
            noFutureDate: true
        },
        ref_type_id: { required: function () { return $("#field_type").is(":visible"); } },
        ref_department_id: { required: function () { return $("#field_department").is(":visible"); } },
        year: { required: function () { return $("#field_year").is(":visible"); } },
        upload_doc: { required: true },
        upload_doc_url: { required: true }
    }, {
        ref_type_of_document_id: "Please select the document type",
        title: {
            required: "Please enter the title",
            minlength: "Title must be at least 3 characters"
        },
        file_number: "File number is required for Circular and Office Order",
        issue_date: {
            required: "Issue date is required",
            date: "Please enter a valid date",
            noFutureDate: "Issue date cannot be a future date"
        },
        ref_type_id: "Please select the type",
        ref_department_id: "Please select the department",
        year: "Please select the year",
        upload_doc: "Please upload a document",
        upload_doc_url: "Please upload a document"
    });

    initFileUpload({
        inputSelector: ".upload_doc",
        allowedTypes: ["application/pdf"],
        allowedExt: ["pdf"],                // optional fallback
        allowedTypesText: "PDF",
        maxSize: 20 * 1024 * 1024,           // 20 MB
        maxSizeText: "20MB",
        formDataKey: "upload_doc",
        uploadUrl: "document-management/storeDocument",
        viewUrl: "document-management/viewFiles",
        pathName: "uploads/document-management/upload/",
        sectionClass: ".attachment_section_upload_doc",
        hideClass: ".hide_upload_doc_btn",
        hiddenInput: "#upload_doc_url",
        viewClass: "report_preview_support_photo",
        removeClass: "report_remove_doc",
        prefix: "upload_doc",
        single: true                        // keep only one preview (default)
    });
});
