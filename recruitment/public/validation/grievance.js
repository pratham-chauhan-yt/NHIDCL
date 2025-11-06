$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/grievance/application` : null;

    $('#grievance-table').DataTable({
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
            {
                data: 'grievance_id',
                name: 'grievance_id'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'employee_no',
                name: 'employee_no'
            },
            {
                data: 'designation',
                name: 'designation'
            },
            {
                data: 'department',
                name: 'department'
            },
            {
                data: 'pay_scale',
                name: 'pay_scale'
            },
            {
                data: 'date',
                name: 'date'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ]
    });
});


$(document).ready(function () {

    let formId = $('#add-grievance').length ? '#add-grievance' : '#edit-grievance';

    $(formId).validate({
        rules: {
            name: {
                required: true,
                maxlength: 100
            },
            employee_no: {
                required: true,
                maxlength: 50
            },
            ref_designation_id: {
                required: true
            },
            grievance_reason: {
                required: true,
                maxlength: 1000
            },
            pay_scale: {
                required: true,
                number: true,
                max: 99999999.99
            },
            ref_department_id: {
                required: true
            },
            permanent_address: {
                required: true,
                maxlength: 1000
            },
            date: {
                required: true,
                date: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name can be up to 100 characters"
            },
            employee_no: {
                required: "Please enter your employee number",
                digits: "Employee number must be numeric",
                maxlength: "Employee number can be up to 20 digits"
            },
            ref_designation_id: {
                required: "Please select your designation",
                maxlength: "Designation can be up to 100 characters"
            },
            grievance_reason: {
                required: "Please describe your grievance briefly",
                minlength: "Minimum 5 characters required",
                maxlength: "Grievance can be up to 255 characters"
            },
            pay_scale: {
                required: "Please enter your pay scale",
                maxlength: "Pay scale can be up to 50 characters"
            },
            ref_department_id: {
                required: "Please select your department",
            },
            permanent_address: {
                required: "Please enter your Permanent address",
                maxlength: "Permanent address can be up to 1000 characters"
            },
            date: {
                required: "Please select a date",
                date: "Please enter a valid date"
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










