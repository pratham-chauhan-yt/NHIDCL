$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/trainer/application` : null;

    // $('#trainer-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: finalUrl,
    //     },
    //     columns: [
    //         {
    //             data: null,
    //             name: 'serial_no',
    //             orderable: false,
    //             searchable: false,
    //             render: function (data, type, row, meta) {
    //                 return meta.row + meta.settings._iDisplayStart + 1;
    //             }
    //         },
    //         {
    //             data: 'name',
    //             name: 'name'
    //         },
    //         {
    //             data: 'employee_no',
    //             name: 'employee_no'
    //         },
    //         {
    //             data: 'designation',
    //             name: 'designation'
    //         },
    //         {
    //             data: 'department',
    //             name: 'department'
    //         },
    //         {
    //             data: 'pay_scale',
    //             name: 'pay_scale'
    //         },
    //         {
    //             data: 'date',
    //             name: 'date'
    //         },
    //         {
    //             data: 'created_at',
    //             name: 'created_at'
    //         },
    //         {
    //             data: 'action',
    //             name: 'action',
    //             orderable: false,
    //             searchable: false
    //         }
    //     ]
    // });
});


$(document).ready(function () {


    let formId = $('#add-trainer').length ? '#add-trainer' : '#edit-trainer';

    $(formId).validate({
        rules: {
            attendee_name: {
                required: true,
                maxlength: 100
            },
            attendee_email: {
                required: true,
                email: true,
                maxlength: 150
            },
            attendee_contact: {
                required: true,
                maxlength: 10,
                digits: true
            },
            attendee_profile_picture: {
                required: true
            },
            attendee_company: {
                required: true,
                maxlength: 150
            },
            attendee_role: {
                required: true,
                maxlength: 100
            },
            checkin_time: {
                required: true,
                maxlength: 20
            },
            checkout_time: {
                required: true,
                maxlength: 20
            },

            // Trainer Fields
            trainer_name: {
                required: true,
                maxlength: 100
            },
            trainer_designation: {
                required: true,
                maxlength: 100
            },
            trainer_contact: {
                required: true,
                maxlength: 10,
                digits: true
            },
            trainer_qualification: {
                required: true,
                maxlength: 100
            },
            trainer_time_availability: {
                required: true,
                maxlength: 100
            },

            // Session Fields
            session_name: {
                required: true,
                maxlength: 150
            },
            session_date: {
                required: true,
                maxlength: 50
            },
            location: {
                required: true,
                maxlength: 150
            },
            session_agenda: {
                required: true,
                maxlength: 250
            },
            session_registration: {
                required: true,
                maxlength: 150
            },
            status: {
                required: true,
                maxlength: 50
            },
            cost_details: {
                required: true,
                maxlength: 10,
                number: true
            },
            training_material: {
                required: true,
                maxlength: 200
            },
            upcoming_training: {
                required: true,
                maxlength: 200
            }
        },

        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('error-message');
            error.insertAfter(element);
        },
        submitHandler: function (form) {

            alert(222);
            form.submit();
        }
    });
});










