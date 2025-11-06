$(document).ready(function () {
    const initDataTable = (selector, ajaxUrl, columns) => {
        if ($(selector).length && typeof ajaxUrl !== 'undefined') {
            // Destroy existing DataTable if initialized
            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }
            $(selector).DataTable({
                processing: true,
                serverSide: true,
                ajax: ajaxUrl,
                columns: columns
            });
        }
    };

    // Attendance Table Columns
    const attendanceColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'purpose', name: 'purpose' },
        { data: 'address', name: 'address' },
        { data: 'no_of_days', name: 'no_of_days' },
        { data: 'date_range', name: 'date_range' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'checker', name: 'checker' },
        { data: 'checker_remark', name: 'checker_remark' },
        { data: 'approver', name: 'approver' },
        { data: 'approver_remark', name: 'approver_remark' },
        { data: 'action', name: 'action' }
    ];

    // HR Attendance Table Columns
    const hrAttendanceColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'division', name: 'division' },
        { data: 'purpose', name: 'purpose' },
        { data: 'address', name: 'address' },
        { data: 'no_of_days', name: 'no_of_days' },
        { data: 'date_range', name: 'date_range' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'checker', name: 'checker' },
        { data: 'checker_remark', name: 'checker_remark' },
        { data: 'approver', name: 'approver' },
        { data: 'approver_remark', name: 'approver_remark' }
    ];

    // Leave Table Columns
    const leaveColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'purpose', name: 'purpose' },
        { data: 'address', name: 'address' },
        { data: 'no_of_days', name: 'no_of_days' },
        { data: 'date_range', name: 'date_range' },
        { data: 'prefix_date_range', name: 'prefix_date_range' }, // new column added in correct position
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'checker', name: 'checker' },
        { data: 'checker_remark', name: 'checker_remark' },
        { data: 'approver', name: 'approver' },
        { data: 'approver_remark', name: 'approver_remark' },
        { data: 'action', name: 'action' }
    ];

    // HR Leave Table Columns
    const hrLeaveColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'division', name: 'division' },
        { data: 'purpose', name: 'purpose' },
        { data: 'address', name: 'address' },
        { data: 'no_of_days', name: 'no_of_days' },
        { data: 'date_range', name: 'date_range' },
        { data: 'prefix_date_range', name: 'prefix_date_range' }, // new column added in correct position
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'checker', name: 'checker' },
        { data: 'checker_remark', name: 'checker_remark' },
        { data: 'approver', name: 'approver' },
        { data: 'approver_remark', name: 'approver_remark' },
    ];

    // Claim Expense Table Columns
    const claimColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'purpose', name: 'purpose' },
        { data: 'amount', name: 'amount' },
        { data: 'claim_date', name: 'claim_date' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'action', name: 'action' }
    ];

    // Self Service Table Columns
    const serviceColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'request_type', name: 'request_type' },
        { data: 'request_details', name: 'request_details' },
        { data: 'submission_date', name: 'submission_date' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'action', name: 'action' }
    ];

    // Exit Interview Table Columns
    const interviewColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'reason', name: 'reason' },
        { data: 'resign_date', name: 'resign_date' },
        { data: 'last_wdays', name: 'last_wdays' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'action', name: 'action' }
    ];

    // Exit Interview Employee Table Columns
    const interviewEmployeeColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'division', name: 'division' },
        { data: 'reason', name: 'reason' },
        { data: 'resign_date', name: 'resign_date' },
        { data: 'last_wdays', name: 'last_wdays' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'action', name: 'action' }
    ];

    // Resign Employee Table Columns
    const resignInterviewColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'users', name: 'users' },
        { data: 'department', name: 'department' },
        { data: 'reason', name: 'reason' },
        { data: 'resign_date', name: 'resign_date' },
        { data: 'last_wdays', name: 'last_wdays' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'action', name: 'action' }
    ];

    // HR Policy Table Columns
    const policyTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'title', name: 'title' },
        { data: 'department', name: 'department' },
        { data: 'policy_date', name: 'policy_date' },
        { data: 'users', name: 'users' },
        { data: 'action', name: 'action' }
    ];

    // Claim Expense Employee Table Columns
    const claimEmployeeColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'purpose', name: 'purpose' },
        { data: 'amount', name: 'amount' },
        { data: 'claim_date', name: 'claim_date' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'users', name: 'users' },
        { data: 'action', name: 'action' }
    ];

    // Self Service Employee Table Columns
    const serviceEmployeeColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'request_type', name: 'request_type' },
        { data: 'request_details', name: 'request_details' },
        { data: 'submission_date', name: 'submission_date' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'users', name: 'users' },
        { data: 'action', name: 'action' }
    ];

    // Assign Asset Table Columns
    const assetTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name_of_asset', name: 'name_of_asset' },
        { data: 'total', name: 'total' },
        { data: 'alloted', name: 'alloted' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'remark', name: 'remark' },
        { data: 'users', name: 'users' },
        { data: 'department', name: 'department' },
        { data: 'action', name: 'action' }
    ];

    // Total Asset Employee Table Columns
    const assetTotalTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name_of_asset', name: 'name_of_asset' },
        { data: 'total', name: 'total' },
        { data: 'alloted', name: 'alloted' },
        { data: 'status', name: 'status', className: 'text-center' },
        { data: 'remark', name: 'remark' },
        { data: 'users', name: 'users' },
        { data: 'department', name: 'department' },
        {
            data: 'created_by', 
            name: 'created_by',
            render: function(data, type, row) {
                return data && data.name ? data.name : data; 
            }
        }
    ];

    // Total Asset Employee Table Columns
    const employeeAssetTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name_of_asset', name: 'name_of_asset' },
        { data: 'department', name: 'department' },
        { data: 'total', name: 'total' },
        { data: 'alloted', name: 'alloted' },
        { data: 'status', name: 'status', className: 'text-center' },
        {
            data: 'created_by', 
            name: 'created_by',
            render: function(data, type, row) {
                return data && data.name ? data.name : data; 
            }
        },
        { data: 'remark', name: 'remark' },
    ];

    // Initialize each table with respective columns
    // Conditionally initialize each table
    if (typeof attendanceUrl !== 'undefined') {
        initDataTable('#attendanceTable', attendanceUrl, attendanceColumns);
    }

    if (typeof hrAttendanceDataUrl !== 'undefined') {
        initDataTable('#hrAttendanceTable', hrAttendanceDataUrl, hrAttendanceColumns);
    }

    if (typeof leaveDataUrl !== 'undefined') {
        initDataTable('#leaveDataTable', leaveDataUrl, leaveColumns);
    }

    if (typeof hrLeaveDataUrl !== 'undefined') {
        initDataTable('#hrLeaveDataTable', hrLeaveDataUrl, hrLeaveColumns);
    }

    if (typeof claimDataUrl !== 'undefined') {
        initDataTable('#claimDataTable', claimDataUrl, claimColumns);
    }

    if (typeof claimEmployeeDataUrl !== 'undefined') {
        initDataTable('#claimEmployeeDataTable', claimEmployeeDataUrl, claimEmployeeColumns);
    }

    if (typeof serviceDataUrl !== 'undefined') {
        initDataTable('#serviceDataTable', serviceDataUrl, serviceColumns);
    }

    if (typeof serviceEmployeeDataUrl !== 'undefined') {
        initDataTable('#serviceEmployeeDataTable', serviceEmployeeDataUrl, serviceEmployeeColumns);
    }

    if (typeof interviewExitUrl !== 'undefined') {
        initDataTable('#interviewTableData', interviewExitUrl, interviewColumns);
    }

    if (typeof interviewEmployeeExitUrl !== 'undefined') {
        initDataTable('#exitEmployeeDataTable', interviewEmployeeExitUrl, interviewEmployeeColumns);
    }

    if (typeof resignEmployeeUrl !== 'undefined') {
        initDataTable('#resignTableData', resignEmployeeUrl, resignInterviewColumns);
    }

    if (typeof policyDataUrl !== 'undefined') {
        initDataTable('#hrPolicyDataTable', policyDataUrl, policyTableColumns);
    }

    if (typeof assetDataUrl !== 'undefined') {
        initDataTable('#assetTableData', assetDataUrl, assetTableColumns);
    }

    if (typeof assetTotalDataUrl !== 'undefined') {
        initDataTable('#assetTotalTableData', assetTotalDataUrl, assetTotalTableColumns);
    }

    if (typeof EmployeeAssetUrl !== 'undefined') {
        initDataTable('#employeeAssetDataTable', EmployeeAssetUrl, employeeAssetTableColumns);
    }

    $('.payment_proof_file').on('change', function () {
        var $this = $(this);

        if ($this[0].files[0].type !== 'application/pdf') {
            Swal.fire('Warning', 'Please select a valid PDF file only!', 'warning');
            $this.val("");
            return false;
        }

        if ($this[0].files[0].size > 2000000) {
            Swal.fire('Warning', 'File size should not exceed 2MB!', 'warning');
            $this.val("");
            return false;
        }

        var formData = new FormData();
        var file = $this[0].files[0];
        formData.append('payment_proof_file', file);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formData.append('_token', csrfToken);

        const websiteUrl = document.querySelector('meta[name="website-url"]')?.getAttribute('content');
        const uploadUrl = `${websiteUrl}/employee-management/upload/files`;
        const viewUrlBase = `${websiteUrl}/employee-management/view/files`;
        const filePath = 'uploads/employee-management/payment/';

        $.ajax({
            url: uploadUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    const fileName = encodeURIComponent(response.file_name);
                    const pathName = encodeURIComponent(filePath);
                    const viewUrl = `${viewUrlBase}?pathName=${pathName}&fileName=${fileName}`;

                    $("#payment_proof_txt").val(viewUrl);
                    $("#payment_proof").val(response.file_name);

                    $this.parents('.attachment_payment_proof').find('.hide_upload_photos').hide();
                    $this.parents('.attachment_payment_proof').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_payment_proof').siblings('.attachment_payment_proof').show();

                    $('.attachment_payment_proof').append(`
                        <div class="uploaded-preview">
                            <a target="_blank" href="${viewUrl}" class="focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>
                            <a href="javascript:void(0);" class="focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 attach_file_remove text-red" 
                            data-name="${response.file_name}" data-path="${filePath}">
                                Remove
                            </a>
                        </div>
                    `);
                } else {
                    Swal.fire('Info', response.message, 'info');
                    $this.val("");
                }
            },
            error: function (xhr, status, error) {
                console.error("Upload error:", error);
            }
        });
    });

    $(document).on('click', '.attach_file_remove', function () {
        const $this = $(this);
        const fileName = $this.attr("data-name");
        const filePath = $this.attr("data-path");
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const websiteUrl = document.querySelector('meta[name="website-url"]')?.getAttribute('content');
        const deleteUrl = `${websiteUrl}/employee-management/delete/file`;

        $.ajax({
            url: deleteUrl,
            type: 'POST',
            data: {
                _token: csrfToken,
                file_name: fileName,
                path_name: filePath
            },
            success: function (response) {
                if (response.status) {
                    // Clear fields
                    $("#payment_proof_txt").val('');
                    $("#payment_proof").val('');

                    // Reset the file input
                    const fileInput = $('.payment_proof_file');
                    fileInput.val('');
                    fileInput[0].type = '';  // Force reset
                    fileInput[0].type = 'file';

                    // Show upload UI again
                    $this.closest('.attachment_payment_proof').find('.hide_upload_photos').show();

                    // Remove preview
                    $this.closest('.uploaded-preview').remove();
                } else {
                    Swal.fire('Error', response.message, 'error');
                }
            },
            error: function (xhr, status, error) {
                console.error("Delete error:", error);
            }
        });
    });

    $('#division').on('change', function () {
        let divisionId = $(this).val();
        const loader = document.querySelector(".loader");
        if (divisionId) {
            loader.style.display = "block";
            $.ajax({
                url: userDivisionUrl,
                type: "GET",
                data: { division_id: divisionId },
                success: function (response) {
                    $('#assign').empty().append('<option value="">--- Choose Asset Assign Employee ---</option>');
                    $.each(response.users, function (key, user) {
                        $('#assign').append(`<option value="${user.id}">${user.name} (${user.email})</option>`);
                    });
                    loader.style.display = "none";
                },
                error: function () {
                    loader.style.display = "none";
                    Swal.fire('Info', "Unable to fetch users", 'info');
                    $this.val("");
                    return false;
                }
            });
        } else {
            $('#assign').html('<option value="">--- Choose Asset Assign Employee ---</option>');
            loader.style.display = "none";
        }
    });


    $("#hrAssignAssetForms").on("submit", function (e) {
        let isValid = true;
        $(".error-message").remove();

        function showError(input, message) {
            isValid = false;
            if (input.next(".error-message").length === 0) {
                input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
            } else {
                input.next(".error-message").text(message);
            }
        }

        $(this).find("input, select, textarea").each(function () {
            let input = $(this);
            let val = input.val().trim();
            let type = input.data("validate");

            if (type === "required" && val === "") {
                showError(input, input.data("error") || "This field is required.");
            }
            if (type === "number" && (val === "" || isNaN(val))) {
                showError(input, input.data("error") || "Please enter a valid number.");
            }
            if (type === "file" && this.files.length === 0) {
                showError(input, input.data("error") || "Please upload a file.");
            }
        });

        if (!isValid) {
            e.preventDefault(); // stop only if invalid
        }
    });

    $("#FormValidations").on("submit", function (e) {
        let isValid = true;
        $(".error-message").remove();

        function showError(input, message) {
            isValid = false;
            if (input.next(".error-message").length === 0) {
                input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
            } else {
                input.next(".error-message").text(message);
            }
        }

        $(this).find("input, select, textarea").each(function () {
            let input = $(this);
            let val = input.val().trim();
            let type = input.data("validate");

            if (type === "required" && val === "") {
                showError(input, input.data("error") || "This field is required.");
            }
            if (type === "number" && (val === "" || isNaN(val))) {
                showError(input, input.data("error") || "Please enter a valid number.");
            }
            if (type === "file" && this.files.length === 0) {
                showError(input, input.data("error") || "Please upload a file.");
            }
        });

        if (!isValid) {
            e.preventDefault(); // stop only if invalid
        }
    });

});