function openRemarkModal(renewId, actionType) {
    $('#modal_renew_id').val(renewId);
    $('#modal_action').val(actionType);
    $('#modal_remark').val('');
    $('#remarkModal').removeClass('hidden').addClass('flex');
}

function closeRemarkModal() {
    $('#remarkModal').addClass('hidden').removeClass('flex');
}


$(document).ready(function () {
    // const websiteMeta = document.querySelector('meta[name="website-url"]');
    // const websiteUrl = websiteMeta?.getAttribute('content');
    // const finalUrl = websiteUrl ? `${websiteUrl}/task-management` : null;

    // let status = 'pending';
    // $('.tablink').click(function () {
    //     status = $(this).text().trim().toLowerCase();
    //     $('#task-management-table').DataTable().ajax.reload();
    // });

    // alert(1);

    // $('#task-management-table').DataTable({
    //     processing: true,
    //     serverSide: true,
    //     ajax: {
    //         url: finalUrl,
    //         data: function (d) {
    //             d.status = status;
    //         }
    //     },
    //     columns: [{
    //         data: null,
    //         name: 'serial_no',
    //         orderable: false,
    //         searchable: false,
    //         render: function (data, type, row, meta) {
    //             return meta.row + meta.settings._iDisplayStart + 1;
    //         }
    //     },
    //     {
    //         data: 'task_id',
    //         name: 'task_id'
    //     },
    //     {
    //         data: 'task_name',
    //         name: 'task_name'
    //     },
    //     {
    //         data: 'due_date',
    //         name: 'due_date'
    //     },
    //     {
    //         data: 'pending',
    //         name: 'pending'
    //     },
    //     {
    //         data: 'repeat_interval',
    //         name: 'repeat_interval'
    //     },
    //     {
    //         data: 'status',
    //         name: 'status'
    //     },
    //     {
    //         data: 'priority_name',
    //         name: 'priority_name'
    //     },
    //     {
    //         data: 'assigned_to',
    //         name: 'assigned_to'
    //     },
    //     {
    //         data: 'action',
    //         name: 'action'
    //     },
    //     ]
    // });

    //console.log(2123);
});

$(document).ready(function () {

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/bank-guarantee-management-system/verifier` : null;



    let tab = 'verification_pending';

    $('.tablink').click(function () {
        tab = $(this).text().trim().toLowerCase().replace(/\s+/g, "_");

        $('#verifier-table').DataTable().ajax.reload();

    });

    //console.log(tab);


    $('#verifier-table').DataTable({
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
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ]
    });
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


$(document).on('click', '.referback-btn, .verify-btn', function () {

    let actionType = $(this).hasClass('referback-btn') ? 'referback' : 'verify';

    console.log('Button clicked:', actionType);

    const modal = $('.custom-modal');

    const overlay = $('#bg-modal-overlay');

    const form = $('#bg-form');

    const action = $(this).data('action');

    form.attr('action', action);

    $('#remarks').val('');

    $('.error-message').hide();

    modal.show();

    overlay.show();

    $('#closeModal, #bg-modal-overlay').on('click', function () {
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


