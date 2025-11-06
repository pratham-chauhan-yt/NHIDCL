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
    const grievanceColumns = [
        //{ data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'grievance_id', name: 'grievance_id' },
        { data: 'title', name: 'title' },
        { data: 'name', name: 'name' },
        { data: 'employee_code', name: 'employee_code' },
        { data: 'type', name: 'type' },
        { data: 'date', name: 'date' },
        { data: 'ref_assign_users_id', name: 'ref_assign_users_id' },
        { data: 'status', name: 'status' },
        { data: 'action', name: 'action' }
    ];

    // Initialize each table with respective columns
    if (typeof grievanceDataUrl !== 'undefined') {
        initDataTable('#grievanceDataTable', grievanceDataUrl, grievanceColumns);
    }

    $('.upload_file').on('change', function () {
        let $this = $(this);
        let files = $this[0].files[0];
        let allowedTypes = [
            'application/pdf',
            'application/msword', // .doc
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document', // .docx
            'image/jpeg',
            'image/png',
            'image/jpg'
        ];

        if (!allowedTypes.includes(files.type)) {
            Swal.fire('Warning', 'Please select a valid file (PDF, DOC, DOCX, JPG, JPEG, PNG) only!', 'warning');
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
        formData.append('upload_file', file);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formData.append('_token', csrfToken);

        const websiteUrl = document.querySelector('meta[name="website-url"]')?.getAttribute('content');
        const uploadUrl = `${websiteUrl}/grievance-management/upload/files`;
        const viewUrlBase = `${websiteUrl}/grievance-management/view/files`;
        const filePath = 'uploads/grievance-management/documents/';

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

                    $("#upload_file_txt").val(viewUrl);
                    $("#upload_files").val(response.file_name);

                    $this.parents('.attachment_upload_file').find('.hide_upload_file').hide();
                    $this.parents('.attachment_upload_file').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_upload_file').siblings('.attachment_upload_file').show();

                    $('.attachment_upload_file').append(`
                        <div class="uploaded-preview">
                            <a target="_blank" href="${viewUrl}" class="focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
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
        const deleteUrl = `${websiteUrl}/grievance-management/delete/file`;

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
                    $("#upload_file_txt").val('');
                    $("#upload_files").val('');

                    // Reset the file input
                    const fileInput = $('.upload_file');
                    fileInput.val('');
                    fileInput[0].type = '';  // Force reset
                    fileInput[0].type = 'file';

                    // Show upload UI again
                    $this.closest('.attachment_upload_file').find('.hide_upload_file').show();

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