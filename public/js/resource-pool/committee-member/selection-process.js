
$(document).ready(function() {
    $('.js-single').select2();
    let storedCandidates = {}; // Stores all selections & remarks across pagination

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    let finalUrl = websiteUrl ? `${websiteUrl}/list-of-candidate-for-committee-member` : null;

    let candidateTable = $('#candidateTable').DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
            type: "POST",
            data: function(d) {
                d.shortlistId = $('#shortlistId').val();
                d.requisitionId = $('#requisitionId').val();
                d._token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            },
        },
        language: {
            emptyTable: "<div class='text-center text-gray-600 font-semibold'>No data found.</div>"
        },
        columns: [{
                data: null,
                render: (data, type, row, meta) => meta.row + meta.settings._iDisplayStart + 1,
                orderable: false
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'email',
                name: 'email'
            },
            {
                data: 'status',
                name: 'status'
            },
            {
                data: 'view-profile',
                name: 'view-profile',
                orderable: false,
                searchable: false
            },
            {
                data: 'select',
                name: 'select',
                orderable: false,
                searchable: false,
                render: (data, type, row) => {
                    let isChecked = data.checked ? 'checked' : '';
                    let isDisabled = data.disabled ? 'disabled' : '';
                    let isStored = storedCandidates[row.id]?.selected;

                    return `<input type="checkbox" class="select-input" id="${row.id}" data-id="${row.id}" ${isStored !== undefined ? (isStored ? 'checked' : '') : isChecked} ${isDisabled}>`;
                }
            },
            {
                data: 'remark',
                name: 'remark',
                orderable: false,
                searchable: false,
                render: (data, type, row) => {
                    let remarkValue = data.remark ?? ''; //  Use backend raw data
                    let isDisabled = data.disabled ? 'disabled' : '';
                    let isStored = storedCandidates[row.id]?.remark;

                    return `<input type="text" class="border p-1 rounded w-full remark-input" data-id="${row.id}" value="${isStored !== undefined ? isStored : remarkValue}" placeholder="Write your remark..." ${isDisabled}>`;
                }
            },
        ]
    });

    //  Store selection when checkbox is checked/unchecked and Store remark when input changes
    $(document).on('change', '.select-input, .remark-input', function() {
        let userId = $(this).data('id');
        if (!storedCandidates[userId]) storedCandidates[userId] = {};

        // Find the checkbox and input field for the same user
        let checkbox = $('.select-input[data-id="' + userId + '"]');
        let remarkInput = $('.remark-input[data-id="' + userId + '"]');

        // Update both values in storedCandidates
        storedCandidates[userId].selected = checkbox.prop('checked') ? true : false;
        storedCandidates[userId].remark = remarkInput.val().trim() || null; // Store null if empty
    });

    //  Restore selections & remarks when table is redrawn (pagination, sorting, etc.)
    candidateTable.on('draw', function() {
        $('.remark-input').each(function() {
            let userId = $(this).data('id');

            if (storedCandidates[userId]?.remark !== undefined) {
                $(this).val(storedCandidates[userId].remark);
            }
        });

        $('.select-input').each(function() {
            let userId = $(this).data('id');
            isStored = storedCandidates[userId]?.selected;

            if (isStored !== undefined) {
                $(this).prop('checked', isStored ?? false);
            }
        });
    });

    // Fetch shortlist codes dynamically when requisition ID changes
    $('#requisitionId').on('change', function() {
        let requisitionId = $(this).val();
        let shortlistDropdown = $('#shortlistId').html(
            '<option value="">Select shortlist code</option>');

        if (requisitionId) {
            let finalUrl = websiteUrl ? `${websiteUrl}/committee-member/selection-process` : null;
            $.ajax({
                url: finalUrl,
                type: "GET",
                data: {
                    requisitionId: requisitionId,
                    _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                success: function(response) {
                    if (response.success && response.shortlists.length > 0) {
                        response.shortlists.forEach(function(shortlist, index) {
                            let disabled = shortlist.ref_shortlist_status_id ==
                                3 ? "disabled" : "";
                            shortlistDropdown.append(
                                `<option value="${shortlist.id}" ${disabled}>${shortlist.id} - Shortlist ${index + 1}</option>`
                            );
                        });
                    } else {
                        candidateTable.clear().draw();
                        shortlistDropdown.html(
                            '<option value="">No shortlist found</option>');
                    }
                },
                error: function() {
                    console.log("Error fetching shortlist codes.");
                    candidateTable.clear().draw();
                    shortlistDropdown.html(
                        '<option value="">No shortlist found</option>');
                }
            });
        } else {
            candidateTable.clear().draw();
            shortlistDropdown.html(
                '<option value="">No shortlist found</option>');
        }
    });

    // Reload table when both `requisitionId` and `shortlistId` are selected
    $('#shortlistId').on('change', function() {
        if ($('#requisitionId').val() && $('#shortlistId').val()) {
            remarksData = {};
            selectionData = {};
            candidateTable.ajax.reload();
        } else {
            candidateTable.clear().draw();
        }
    });


    // Save Draft: Send all stored selections & remarks
    $('#saveDraftBtn').on('click', function() {
        let requisitionId = $('#requisitionId').val();
        let shortlistId = $('#shortlistId').val();

        if (!requisitionId || !shortlistId) {
            Swal.fire('Error!', 'Please select a requisition and shortlist first.', 'error');
            return;
        }

        if (document.querySelector('.remark-input').disabled) {
            return;
        }

        let selectedCandidates = Object.entries(storedCandidates).map(([id, data]) => ({
            id: id,
            selected: data.selected ?? false, // If not set, store as false
            remark: data.remark ?? null
        }));

        $('#loader').show();

        let finalUrl = websiteUrl ? `${websiteUrl}/save-draft-shortlist-for-committee-member` : null;

        $.ajax({
            url: finalUrl,
            type: "POST",
            data: {
                requisitionId: requisitionId,
                shortlistId: shortlistId,
                candidates: selectedCandidates,
                _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            success: function(response) {
                location.reload(true);
                $('#loader').hide();
                Swal.fire('Success!', 'Draft saved successfully!', 'success');
            },
            error: function(xhr) {
                $('#loader').hide();
                Swal.fire('Error!',
                    'Shortlist already exists or contains invalid data. Please contact the admin for assistance.',
                    'error');
            }
        });
    });

    // Generate Shortlist: Send all stored selections & remarks
    $('#generateShortlist').on('click', function() {
        let requisitionId = $('#requisitionId').val();
        let shortlistId = $('#shortlistId').val();

        if (!requisitionId || !shortlistId) {
            Swal.fire('Error!', 'Please select a requisition and shortlist first.', 'error');
            return;
        }

        if (document.querySelector('.remark-input').disabled) {
            return;
        }

        Swal.fire({
            title: "Are you sure you want submit this shortlist?",
            text: "You won't be able to revert this!",
            icon: "warning",
            allowOutsideClick: false,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Submit"
        }).then((result) => {
            if (result.isConfirmed) {
                $('#loader').show();

                let selectedCandidates = Object.entries(storedCandidates).map(([id,
                    data
                ]) => ({
                    id: id,
                    selected: data.selected ??
                        false, // If not set, store as false
                    remark: data.remark ?? null
                }));

                let finalUrl = websiteUrl ? `${websiteUrl}/generate-shortlist-for-committee-member` : null;

                $.ajax({
                    url: finalUrl,
                    type: "POST",
                    data: {
                        requisitionId: requisitionId,
                        shortlistId: shortlistId,
                        candidates: selectedCandidates,
                        _token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    success: function(response) {
                        location.reload(true);
                        $('#loader').hide();
                        Swal.fire('Success!',
                            'Shortlist has been generated successfully!',
                            'success');
                    },
                    error: function(xhr) {
                        $('#loader').hide();
                        Swal.fire('Error!',
                            'Shortlist already exists or contains invalid data. Please contact the admin for assistance.',
                            'error');
                    }
                });
            }
        });
    });

});
