
$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}bank-guarantee-management-system` : null;



    $('#bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#search-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/search',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#received-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/receive',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#encashed-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/encashment',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#claimlodge-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/claimlodge',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#finance-returend-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/finance-returned',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
    $('#archive-bg-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/archive',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

    $('#accepted-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl + '/bg/accepted',
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'bg_id', name: 'bg_id' },
            { data: 'ref_no', name: 'ref_no' },
            { data: 'sap_id', name: 'sap_id' },
            { data: 'guarantee_type', name: 'guarantee_type' },
            { data: 'state', name: 'state' },
            { data: 'bg_no', name: 'bg_no' },
            { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
            { data: 'bg_valid_upto', name: 'bg_valid_upto' },
            { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
            { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });

});


$(document).ready(function () {
    let formId = $('#add-bg').length ? '#add-bg' : '#edit-bg';

    $.validator.addMethod("greaterThanField", function (value, element, param) {
        if (!value) return true;
        let inputDate = new Date(value);
        let compareDate = new Date($(param).val());
        return !isNaN(compareDate) ? inputDate > compareDate : true;
    }, "Date must be after the compared date");

    $.validator.addMethod("greaterThanBgValid", function (value, element) {
        if (!value) return true;
        let claimDate = new Date(value);
        let bgValidDate = new Date($("[name='bg_valid_upto']").val());
        return !isNaN(bgValidDate) ? claimDate > bgValidDate : true;
    }, "Claim Expiry Date must be after BG Valid Up-to");

    $(formId).validate({
        rules: {
            nhidcl_bgm_project_details_id: { required: true },
            ref_guarantee_type_id: { required: true },
            agency_name: { required: true, maxlength: 255 },
            agency_mob_no: { required: true, maxlength: 10, number: true, validMobile: true },
            agency_email: { required: true, email: true, maxlength: 100 },
            agency_address: { required: true },

            bg_no: { required: true, maxlength: 100 },
            bank_name: { required: true, maxlength: 255 },

            issuing_bank_branch: { required: true, maxlength: 255 },
            issuing_bank_mob_no: { required: true, digits: true, maxlength: 10, validMobile: true },
            issuing_bank_email: { required: true, email: true, maxlength: 255 },
            issuing_bank_address: { required: true },

            operable_bank_mob_no: { required: true, maxlength: 10, validMobile: true },
            operable_bank_email: { required: true, email: true, maxlength: 255 },
            operable_bank_address: { required: true },
            operable_bank_branch: { required: true, maxlength: 255 },

            bg_amount: { required: true, number: true, validAmount: true },

            issue_date: { 
                required: true, 
                date: true 
            },

            bg_valid_upto: { 
                required: true, 
                date: true, 
                greaterThanField: "[name='issue_date']" 
            },

            claim_expiry_date: { 
                required: true, 
                date: true, 
                greaterThanField: "[name='issue_date']", 
                greaterThanBgValid: true 
            }
        },

        messages: {
            bg_valid_upto: {
                greaterThanField: "BG Valid Up-to must be after Issue Date"
            },
            claim_expiry_date: {
                greaterThanField: "Claim Expiry Date must be after Issue Date",
                greaterThanBgValid: "Claim Expiry Date must also be after BG Valid Up-to"
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



$(document).ready(function () {

    jQuery.validator.addMethod("greaterThan", function (value, element, param) {
        if (!value || !$(param).val()) {
            return true;
        }
        return new Date(value) > new Date($(param).val()); 
    }, "Must be greater than {0}");
    $("#renew-bg-form").validate({
        rules: {
            issue_date: "required",
            valid_upto: {
                required: true,
                greaterThan: "[name='issue_date']"
            },
            claim_expiry_date: {
                required: true,
                greaterThan: "[name='valid_upto']"
            },
            bg_file: "required", 
            is_renew: "required"
        },
        messages: {
            issue_date: "Issue date is required",
            valid_upto: {
                required: "Valid upto is required",
                greaterThan: "Valid Upto must be after Issue Date"
            },
            claim_expiry_date: {
                required: "Claim expiry date is required",
                greaterThan: "Claim Expiry Date must be after Valid Upto"
            },
            bg_file: "Please upload the file", 
            is_renew: "Select electronic/renew"
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


    $(document).on('click', '.receive-btn', function () {

        const modal = $('.custom-modal');

        let isReceive = $(this).hasClass('receive-btn');

        // Show the modal
        // $('#bg-receive-modal').show();

        // Update heading and label based on button clicked
        if (isReceive) {
            $('#bg-receive-modal h2').text('Receive BG');
            $('#bg-receive-modal label[for="remarks"]').text('Physical Location');
        } else {
            $('#bg-receive-modal h2').text('Refer Back BG');
            $('#bg-receive-modal label[for="remarks"]').text('Enter Refer Back Remark');
        }

        const overlay = $('#bg-receive-modal-overlay');

        const form = $('#bg-received-form');

        const action = $(this).data('action');

        form.attr('action', action);

        $('#remarks').val('');

        $('.error-message').hide();

        modal.show();

        overlay.show();

        $('#closeModal, #bg-receive-modal-overlay').on('click', function () {
            modal.hide();
            overlay.hide();
        });

        form.on('submit', function (e) {

            let valid = true;

            const remarks = $('#remarks').val().trim();

            if (remarks.length < 5) {
                $('#remarks').next('.error-message').show();
                valid = false;
            } else {
                $('#remarks').next('.error-message').hide();
            }

            if (!valid) {
                e.preventDefault();
            }
        });
    });
});

// $(document).on('change', '.upload_attachment', function () {
//     const uploadUrl = $('#uploadUrl').val();
//     const viewUrl = $('#viewUrl').val();
//     const csrfToken = $('meta[name="csrf-token"]').attr('content');

//     const $this = $(this);
//     const file = $this[0].files[0];

//     if (!file) return;

//     const allowedFileTypes = [
//         "application/pdf",
//         "application/msword",
//         "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
//         "application/vnd.ms-excel",
//         "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
//         "image/jpeg",
//         "image/png"
//     ];

//     const imageSize = 2 * 1024 * 1024; // 2 MB

//     if (!allowedFileTypes.includes(file.type)) {
//         showError("Invalid File Type", "Only PDF, Word, Excel, and image files are allowed");
//         $this.val("");
//         return;
//     }

//     if (file.size > imageSize) {
//         showError("File size too large", "Max size is 2 MB");
//         $this.val("");
//         return;
//     }

//     const formData = new FormData();
//     formData.append('bg_file', file);
//     formData.append('type', file.type);
//     formData.append('_token', csrfToken);

//     $.ajax({
//         url: uploadUrl,
//         type: 'POST',
//         data: formData,
//         processData: false,
//         contentType: false,
//         success: function (response) {
//             if (response.status === true) {
//                 const fileName = encodeURIComponent(response.file_name);
//                 const pathName = encodeURIComponent('/uploads/bg/');
//                 const fileUrl = `${viewUrl}?pathName=${pathName}&fileName=${fileName}`;

//                 $this.hide();
//                 $this.closest('.attachment_section_upload_attachment').find('.upload_cust').hide();
//                 $this.closest('.attachment_section_upload_attachment').find('.uploaded_attachment').val(fileUrl);
//                 $this.siblings('input[type="hidden"]').val(response.file_name);

//                 const section = $this.closest('.attachment_section_upload_attachment');

//                 const oldView = document.querySelector('.oldView');
//                 if (oldView) {
//                     oldView.remove();
//                 }

//                 section.append(`
//                     <div id="temp" class="my-3">
//                         <a target="_blank" href="${fileUrl}" style="color:green;"class="quick-btn view-btn">View</a>

//                     </div>
//                 `);
//             } else {
//                 showError("Upload Failed", response.message);
//                 $this.val('');
//             }
//         }
//     });
// });







$(document).on('change', '.upload_attachment', function () {
    const uploadUrl = $('#uploadUrl').val();
    const viewUrl = $('#viewUrl').val();
    const csrfToken = $('meta[name="csrf-token"]').attr('content');

    const $this = $(this);
    const file = $this[0].files[0];

    if (!file) return;

    const allowedFileTypes = [
        "application/pdf",
        "application/msword",
        "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
        "application/vnd.ms-excel",
        "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
        "image/jpeg",
        "image/png"
    ];

    const imageSize = 2 * 1024 * 1024; // 2 MB

    if (!allowedFileTypes.includes(file.type)) {
        showError("Invalid File Type", "Only PDF, Word, Excel, and image files are allowed");
        $this.val("");
        return;
    }

    if (file.size > imageSize) {
        showError("File size too large", "Max size is 2 MB");
        $this.val("");
        return;
    }

    const formData = new FormData();
    formData.append('bg_file', file);
    formData.append('type', file.type);
    formData.append('_token', csrfToken);

    $.ajax({
        url: uploadUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === true) {
                const fileName = encodeURIComponent(response.file_name);
                const pathName = encodeURIComponent('/uploads/bg/');

                const fileUrl = `${viewUrl}?pathName=${pathName}&fileName=${fileName}`;

                const section = $this.closest('.attachment_section_upload_attachment');

                section.find('.uploaded_attachment').val(fileUrl);
                section.find('input[type="hidden"][name="bg_file"]').val(response.file_name);

                section.find('.file-preview').remove();

                section.append(`
                    <div class="file-preview my-3">
                        <a target="_blank" href="${fileUrl}" class="quick-btn view-btn" style="color:green;">View</a>
                        <button type="button" class="quick-btn reupload-btn" style="margin-left:10px;color:red;">Re-upload</button>
                    </div>
                `);

                section.find('.upload_cust').hide();
                section.find('.upload_attachment').val("");

            } else {
                showError("Upload Failed", response.message);
                $this.val('');
            }
        },
        error: function () {
            showError("Upload Failed", "Something went wrong while uploading.");
        }
    });

    // $(document).on('click', '.reupload-btn', function () {
//     const section = $(this).closest('.attachment_section_upload_attachment');
//     section.find('.upload_attachment').click();
// });


});




