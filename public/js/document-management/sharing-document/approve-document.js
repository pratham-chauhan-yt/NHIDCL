$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/document-management/sharing/` : null;

    const columnConfigs = {
        "Approval-Pending": [
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
            { data: "shared_by", name: "shared_by", orderable: true, searchable: true },
            { data: "created_at", name: "created_at" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "file", orderable: false, searchable: false },
            { data: "action", orderable: false, searchable: false }
        ],
        "Approved-Archive": [
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
            { data: "shared_by", name: "shared_by", orderable: true, searchable: true },
            { data: "created_at", name: "created_at" },
            { data: "status", name: "status", orderable: false, searchable: false },
            { data: "file", orderable: false, searchable: false },
        ]
    };

    const tableIdMap = {
        "Approval-Pending": "Approval-PendingTable",
        "Approved-Archive": "Approved-ArchiveTable"
    };

    DataTableManager.init('Approval-Pending', columnConfigs['Approval-Pending'], tableIdMap, finalUrl, "GET");
    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");
        DataTableManager.init(render, columnConfigs[render], tableIdMap, finalUrl, "GET");
    });

    initializePopovers = function () {
        $('[data-popover]').each(function () {
            const targetEl = $(this)[0];
            const triggerEl = $(this).prev('[data-popover-target]')[0];
            const options = {
                placement: 'left',
                triggerType: 'hover',
                offset: 5,
                opacity:0
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

    confirmApprove = function (id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "Do you want to approve this document?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#198754',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Approve',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                sendUpdateRequest(id, 3, '');
            }
        });
    }

    confirmReject = function (id) {
        Swal.fire({
            title: 'Reject Document?',
            text: "Enter your remark (optional).",
            input: 'text',
            inputPlaceholder: 'Enter remark...',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Reject',
            cancelButtonText: 'Cancel',
            preConfirm: (remark) => remark || '' // optional remark
        }).then((result) => {
            if (result.isConfirmed) {
                sendUpdateRequest(id, 4, result.value);
            }
        });
    };

    function sendUpdateRequest(id, statusId, remark = '') {
        $.ajax({
            url: `${finalUrl}update`,
            type: "PUT",
            data: {
                id: id,
                ref_status_id: statusId,
                approver_remark: remark,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: function (response) {
                Swal.fire({
                    icon: 'success',
                    title: response.success ? 'Success!' : 'Info',
                    text: response.message || 'Action completed.',
                    timer: 2000,
                    showConfirmButton: false
                });

                $('#Approval-PendingTable').DataTable().ajax.reload(null, false);
            },
            error: function (xhr) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: xhr.responseJSON?.message || 'Something went wrong. Please try again.'
                });
            }
        });
    }
});
