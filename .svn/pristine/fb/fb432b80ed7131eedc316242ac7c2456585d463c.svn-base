$(document).ready(function () {
    $(".js-select2").select2();

    initValidation("#saveExternalEmployeeForm", {
        name: { required: true, minlength: 3 },
        email: { required: true, strictEmail: true },
        mobile: { required: true, digits: true, lengthRange: [10, 10] },
        designation: { required: true, minlength: 2 },
        department: { required: true, minlength: 2 },
        ref_state_master_id: { required: true },
        address: { required: true, minlength: 3 },
        is_active: { required: true },
    });
});
