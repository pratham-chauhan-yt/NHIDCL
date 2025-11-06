$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/bank-guarantee-management-system/project` : null;

    $('#project-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
        },
        columns: [
            {
                data: null,
                name: 'serial_no',
                orderable: false,
                searchable: false,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            { data: 'project_id', name: 'project_id' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'job_no', name: 'job_no' },

            { data: 'upc_no', name: 'upc_no' },
            { data: 'project_name', name: 'project_name' },

            { data: 'project_type', name: 'project_type' },

            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
});


$(document).ready(function () {

    let formId = $('#add-project').length ? '#add-project' : '#edit-project';

    $(formId).validate({

        rules: {
            job_no: {
                required: true,
                maxlength: 100
            },
            upc_no: {
                required: true,
                maxlength: 100
            },
            project_name: {
                required: true,
                maxlength: 200
            },
            ref_project_type_id: {
                required: true
            },
            ref_state_id: {
                required: true
            },
            sap_id: {
                required: true,
                maxlength: 100
            }
        },
        messages: {
            job_no: {
                required: "Please enter Job No.",
                maxlength: "Job No. can’t exceed 100 characters."
            },
            upc_no: {
                required: "Please enter UPC No.",
                maxlength: "UPC No. can’t exceed 100 characters."
            },
            project_name: {
                required: "Please enter Project Name.",
                maxlength: "Project Name can’t exceed 200 characters."
            },
            ref_project_type_id: "Please select Project Type.",
            ref_state_id: "Please select Project State.",
            sap_id: {
                required: "Please enter SAP ID.",
                maxlength: "SAP ID can’t exceed 100 characters."
            }
        },

        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('error-message');
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});










