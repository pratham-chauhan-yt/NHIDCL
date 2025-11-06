function toggleFields() {
    const selected = document.getElementById('accept_or_refer').value;
    const remark = document.getElementById('remark_section');
    const acceptFields = document.getElementsByClassName('accept_fields');

    if (selected === 'Refer') {
        remark.style.display = 'block';
        for (let el of acceptFields) {
            el.style.display = 'none';
        }
    } else {
        remark.style.display = 'none';
        for (let el of acceptFields) {
            el.style.display = 'block';
        }
    }
}

document.addEventListener('DOMContentLoaded', function () {
    const acceptSelect = document.getElementById('accept_or_refer');
    if (acceptSelect) {
        toggleFields(); // Call initially
        acceptSelect.addEventListener('change', toggleFields); // Bind event only if element exists
    }
});


$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/bank-guarantee-management-system/finance/receive-refer` : null;

    let tab = 'receive_or_refer_back_bg';

    $('.tablink').click(function () {
        tab = $(this).text().trim().toLowerCase().replace(/\s+/g, "_");

        $('#receive-table').DataTable().ajax.reload();

    });

    $('#receive-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
            data: function (d) {
                d.tab = tab
            }
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





    $(document).ready(function () {
        let form = $('#taskStatusForm');

        // When modal is shown, inject the correct action URL
        $('#taskStatusModal').on('show.bs.modal', function (event) {
            let button = $(event.relatedTarget);
            let actionUrl = button.data('action');
            form.attr('action', actionUrl);

            // Reset form on every open
            form[0].reset();
            form.find('.is-invalid').removeClass('is-invalid');
        });

        // Simple client-side validation
        form.on('submit', function (e) {
            let isValid = true;

            let remarks = $('#remarks').val().trim();
            let status = $('#status').val();

            if (remarks.length < 5) {
                $('#remarks').addClass('is-invalid');
                isValid = false;
            } else {
                $('#remarks').removeClass('is-invalid');
            }

            if (!status) {
                $('#status').addClass('is-invalid');
                isValid = false;
            } else {
                $('#status').removeClass('is-invalid');
            }

            if (!isValid) {
                e.preventDefault(); // prevent form submit
            }
        });
    });
    $(document).on('click', '.referback-btn, .receive-btn', function () {

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

$(document).ready(function () {

// const websiteMeta = document.querySelector('meta[name="website-url"]');
// const websiteUrl = websiteMeta?.getAttribute('content');
// const finalUrl = websiteUrl ? `${websiteUrl}/bank-guarantee-management-system/finance` : null;

// // Default tab
// let tab = 'accept_or_refer_back_bg';

// // Initialize DataTable
// const table = $('#accept-table').DataTable({
//     processing: true,
//     serverSide: true,
//     ajax: {
//         url: finalUrl + '/accept-refer',
//         data: function (d) {
//             d.tab = tab;  //  Always send current tab value
//         }
//     },
//     columns: [
//         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
//         { data: 'bg_id', name: 'bg_id' },
//         { data: 'ref_no', name: 'ref_no' },
//         { data: 'sap_id', name: 'sap_id' },
//         { data: 'guarantee_type', name: 'guarantee_type' },
//         { data: 'state', name: 'state' },
//         { data: 'bg_no', name: 'bg_no' },
//         { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
//         { data: 'bg_valid_upto', name: 'bg_valid_upto' },
//         { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
//         { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
//         { data: 'action', name: 'action', orderable: false, searchable: false }
//     ]
// });

// // Handle tab click
// $('.tablink').on('click', function () {
//     tab = $(this).data('tab');   
//     table.ajax.reload();        
// });



//     $('#accepted-table').DataTable({
//         processing: true,
//         serverSide: true,
//         ajax: {
//             url: finalUrl + '/accepted',
//         },
//         columns: [
//             { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
//             { data: 'bg_id', name: 'bg_id' },
//             { data: 'ref_no', name: 'ref_no' },
//             { data: 'sap_id', name: 'sap_id' },
//             { data: 'guarantee_type', name: 'guarantee_type' },
//             { data: 'state', name: 'state' },
//             { data: 'bg_no', name: 'bg_no' },
//             { data: 'no_of_renew', name: 'no_of_renew', orderable: false, searchable: false },
//             { data: 'bg_valid_upto', name: 'bg_valid_upto' },
//             { data: 'track_status', name: 'track_status', orderable: false, searchable: false },
//             { data: 'track_claim_lodge', name: 'track_claim_lodge', orderable: false, searchable: false },
//             { data: 'action', name: 'action', orderable: false, searchable: false }
//         ]
//     });

const websiteMeta = document.querySelector('meta[name="website-url"]');
const websiteUrl = websiteMeta?.getAttribute('content');
const finalUrl = websiteUrl ? `${websiteUrl}/bank-guarantee-management-system/finance` : null;

// Detect which table is present on page
let tableId = null;
let ajaxUrl = null;
let tab = null;

if ($('#accept-table').length) {
    // Blade 1
    tableId = '#accept-table';
    tab = 'accept_or_refer_back_bg';
    ajaxUrl = finalUrl + '/accept-refer';
} else if ($('#accepted-table').length) {
    // Blade 2
    tableId = '#accepted-table';
    tab = 'accepted_bg';
    ajaxUrl = finalUrl + '/accepted';
}

if (tableId) {
    const table = $(tableId).DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: ajaxUrl,
            data: function (d) {
                d.tab = tab; // Send tab if required by backend
            }
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

    // Handle tab clicks (if available in blade)
    $('.tablink').on('click', function () {
        tab = $(this).data('tab');
        table.ajax.reload();
    });
}



$(document).on('click', '.return_to_contractor, .return_to_technical, .return_to_encashment, .return_to_claim_lodge', function () {
    const modal = $('#bg-receive-modal');
    const overlay = $('#bg-receive-modal-overlay');

    const actionUrl = $(this).data('action');
    const type = $(this).data('type');

    const isTechnical = $(this).hasClass('return_to_technical');
    const isEncashment = $(this).hasClass('return_to_encashment');
    const isContractor = $(this).hasClass('return_to_contractor');
    const isClaimlodge= $(this).hasClass('return_to_claim_lodge');

    console.log("Clicked:", type, $(this).attr('class'));

    // Reset sections
    $('#bg-remark-section, #bg-remark-ec-section, #bg-upload-section, #bg-remark-claim-lodge').hide();

    if (isTechnical) {
        $('#bg-action-title').text('Return to Technical');
        $('#bg-remark-section').show();
        $('#action_type').val('technical');
    } else if (isEncashment) {
        $('#bg-action-title').text('Send for Encashment');
        $('#bg-remark-ec-section').show();
        $('#action_type').val('encashment');
    } else if (isContractor) {
        $('#bg-action-title').text('Return to Contractor');
        $('#bg-upload-section').show();
        $('#action_type').val('contractor');
    } else if (isClaimlodge) {
        $('#bg-action-title').text('Send for Claim Lodge');
        $('#bg-remark-claim-lodge').show();
        $('#action_type').val('claimlodge');
    }

    // Show modal
    modal.show();
    overlay.show();

    // Close modal
    $('#closeModal, #bg-receive-modal-overlay').off('click').on('click', function () {
        modal.hide();
        overlay.hide();
    });

    const form = $('#bg-received-form');
    form.attr('action', actionUrl);

    // Validation
    form.off('submit').on('submit', function (e) {
        let valid = true;

        if (isTechnical) {
            const remarks = $('#remarks_tech').val().trim();
            if (remarks.length < 5) {
                $('#remarks_tech').next('.error-message').show();
                valid = false;
            } else {
                $('#remarks_tech').next('.error-message').hide();
            }
        }

        if (isEncashment) {
            const remarks = $('#remarks_encash').val().trim();
            if (remarks.length < 5) {
                $('#remarks_encash').next('.error-message').show();
                valid = false;
            } else {
                $('#remarks_encash').next('.error-message').hide();
            }
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});

// Track Status
$(document).on('click', '.track_status/', function () {
    const modal = $('#track-status-modal');
    const actionUrl = $(this).data('action');

    modal.show();
    $('#track-status-table tbody').empty();

    $.get(actionUrl, function (response) {
        if (response?.length > 0) {
            response.forEach((row, index) => {
                $('#track-status-table tbody').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.status}</td>
                        <td>${row.updated_by}</td>
                        <td>${row.verified_by || ''}</td>
                        <td>${row.reason || ''}</td>
                        <td>${row.receiving || ''}</td>
                        <td>${row.date}</td>
                    </tr>
                `);
            });
        } else {
            $('#track-status-table tbody').append(`
                <tr><td colspan="7" style="text-align:center;">No data available</td></tr>
            `);
        }
    });
});





});

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
});

$(document).on('click', '.reupload-btn', function () {
    const section = $(this).closest('.attachment_section_upload_attachment');
    section.find('.upload_attachment').click();
});




