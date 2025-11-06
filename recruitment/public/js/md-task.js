$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/task-management` : null;

    let status = 'pending'; // default
    $('.tablink').click(function () {
        status = $(this).text().trim().toLowerCase(); // pending or completed
        $('#task-management-table').DataTable().ajax.reload();
    });

    $('#task-management-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
            data: function (d) {
                d.status = status;
            }
        },
        columns: [{
            data: null,
            name: 'serial_no',
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            }
        },
        {
            data: 'task_id',
            name: 'task_id'
        },
        {
            data: 'task_name',
            name: 'task_name'
        },
        {
            data: 'due_date',
            name: 'due_date'
        },
        {
            data: 'pending',
            name: 'pending'
        },
        {
            data: 'repeat_interval',
            name: 'repeat_interval'
        },
        {
            data: 'status',
            name: 'status'
        },
        {
            data: 'priority_name',
            name: 'priority_name'
        },
        {
            data: 'assigned_to',
            name: 'assigned_to'
        },
        {
            data: 'action',
            name: 'action'
        },
        ]
    });
});

$(document).ready(function () {
    let formId = $('#add-task-management').length ? '#add-task-management' : '#edit-task-management';

    //  $("#add-task-management").validate({

    $(formId).validate({
        rules: {
            task_name: {
                required: true,
                noSpecialChars: true,
                maxlength: 255
            },
            ref_bucket_id: {
                required: true
            },
            division: {
                required: false,
                noSpecialChars: true,
                maxlength: 255
            },
            ref_priority_id: {
                required: true
            },
            start_date: {
                required: false,
                date: true,
                // currentOrFutureDate: true
            },
            due_date: {
                required: true,
                date: true,
                currentOrFutureDate: true
            },
            // ref_task_repeat_id: {
            //     required: true
            // },
            note: {
                required: false,
                maxlength: 500,
                noSpecialChars: true
            },
            ref_task_source_id: {
                required: true
            },
            assigned_to: {
                required: true
            }

        },
        messages: {
            task_name: {
                required: "Please enter the task name",
                maxlength: "Task name must not exceed 255 characters"
            },
            ref_bucket_id: {
                required: "Please select a bucket"
            },
            division: {
                required: "Please enter the division",
                maxlength: "Division must not exceed 255 characters"
            },
            ref_priority_id: {
                required: "Please select priority"
            },
            start_date: {
                required: "Please select the start date",
                date: "Please enter a valid date"
            },
            due_date: {
                required: "Please select the due date",
                date: "Please enter a valid date"
            },
            ref_task_repeat_id: {
                required: "Please select repeat"
            },
            note: {
                maxlength: "Note must not exceed 500 characters"
            },
            ref_task_source_id: {
                required: "Please select the source of the task"
            },
            assigned_to: {
                required: "Please select who to assign the task to"
            }
        },
        errorElement: 'div',
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

    $("#reply-task-management").validate({
        rules: {
            remarks: {
                required: true
            },
        },
        messages: {
            remarks: {
                required: "Please enter the remarks"
            }
        },
        errorElement: 'div',
        errorPlacement: function (error, element) {
            error.addClass('error-message');
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            $('#remarks').val(quill.root.innerHTML);
            form.submit();
        }
    });
});


$(document).on('change', '.upload_attachment', function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/task-management/upload` : null;
    const viewUrl = websiteUrl ? `${websiteUrl}/task-management/view` : null;

    const csrfMeta = document.querySelector('meta[name="csrf-token"]');
    const csrfToken = csrfMeta?.getAttribute("content");

    let $this = $(this);
    let file = $this[0].files[0];

    const allowedExtensions = [
        "jpg", "jpeg", "png", "webp",
        "pdf", "doc", "docx", "xls", "xlsx",
        "kml", "kmz"
    ];




    let fileType = file.type;
    let fileExt = file.name.split(".").pop().toLowerCase();

    if (!allowedFileTypes.includes(fileType) && !allowedExtensions.includes(fileExt)) {
        showError(
            "Invalid File Type",
            "Only PDF, Word, Excel, KML/KMZ, and image files (JPG, PNG, etc.) are allowed"
        );
        $this.val("");
        return false;
    }

    if (file.size > imageSize) {
        showError("File size large", "Please select 2 MB PDF only!");
        $this.val("");
        return false;
    }

    let formData = new FormData();
    formData.append('attachment', file);
    formData.append('type', file.type);
    formData.append("_token", csrfToken);

    $.ajax({
        url: finalUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            if (response.status === true) {
                let fileName = encodeURIComponent(response.file_name);
                let pathName = encodeURIComponent('/uploads/task-management/');

                // console.log(fileName);
                // console.log(pathName);

                let url = viewUrl + "?" +   "pathName=" + pathName + "&fileName=" + fileName;
                // url = url.replace('fileName', fileName);
                // url = url.replace('pathName', pathName);
                let fileUrl = url;

                // console.log(response);
                // console.log(url);
                // console.log(fileUrl);

                $this.hide();
                $this.closest('.attachment_section_upload_attachment').find('.upload_cust').hide();
                $this.closest('.attachment_section_upload_attachment').find('.uploaded_attachment').val(fileUrl);
                $this.siblings('input[type="hidden"]').val(response.file_name);

                let section = $this.closest('.attachment_section_upload_attachment');

                section.append(`
                        <div id="temp" class="my-3">
                            <a target="_blank" href="${fileUrl}" class="quick-btn view-btn  bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                            <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="" data-name="${response.file_name}">Re-upload</a>
                        </div>
                        `);

            } else {
                showError("Upload Failed", response.message);
                $this.val('');
            }
        }
    });
});

$(document).ready(function () {

    $('#ref_task_source_id').on('change', function () {

        const selectedText = $('#ref_task_source_id option:selected').text().trim().toLowerCase();

        if (selectedText === 'others') {
            $('#other_source_input_wrapper').show();
        } else {
            $('#other_source_input_wrapper').hide();
            $('input[name="other_task_source"]').val('');
        }
    });

    const selectedText = $('#ref_task_source_id option:selected').text().trim().toLowerCase();

    if ($('#ref_task_source_id').val() === 'Others') {
        $('#other_source_input_wrapper').show();
    }
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
$(document).on('click', '.mark-as-completed-btn', function () {
    const modal = $('#taskModal');
    const overlay = $('#taskModalOverlay');
    const form = $('#taskStatusForm');

    const action = $(this).data('action');
    form.attr('action', action);
    $('#remarks').val('');
    $('#status').val('');
    $('.error-message').hide();

    modal.show();
    overlay.show();

    $('#closeModal, #taskModalOverlay').on('click', function () {
        modal.hide();
        overlay.hide();
    });

    form.on('submit', function (e) {
        let valid = true;
        const remarks = $('#remarks').val().trim();
        const status = $('#status').val();

        if (remarks.length < 5) {
            $('#remarks').next('.error-message').show();
            valid = false;
        } else {
            $('#remarks').next('.error-message').hide();
        }

        if (!status) {
            $('#status').next('.error-message').show();
            valid = false;
        } else {
            $('#status').next('.error-message').hide();
        }

        if (!valid) {
            e.preventDefault();
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const ctx1 = document.getElementById("myChart1");
    const ctx2 = document.getElementById("myChart2");
    const ctx3 = document.getElementById("myChart3");

    if (ctx1) {
        const completed = parseInt(ctx1.dataset.completed);
        const inProgress = parseInt(ctx1.dataset.inProgress);
        const pending = parseInt(ctx1.dataset.pending);

        new Chart(ctx1, {
            type: "doughnut",
            data: {
                labels: ["Completed", "In Progress", "Pending"],
                datasets: [{
                    label: "Task Status",
                    backgroundColor: ["green", "blue", "orange"],
                    data: [completed, inProgress, pending],
                    borderWidth: 1,
                    pointStyle: 'circle'
                }],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            },
        });
    }

    if (ctx2) {
        const labels = JSON.parse(ctx2.dataset.priorityLabels || "[]");
        const completed = JSON.parse(ctx2.dataset.completed || "[]");
        const inProgress = JSON.parse(ctx2.dataset.inProgress || "[]");
        const pending = JSON.parse(ctx2.dataset.pending || "[]");

        new Chart(ctx2, {
            type: "bar",
            data: {
                labels: labels,
                datasets: [
                    {
                        label: "Completed",
                        data: completed,
                        backgroundColor: "green",
                    },
                    {
                        label: "In Progress",
                        data: inProgress,
                        backgroundColor: "blue",
                    },
                    {
                        label: "Pending",
                        data: pending,
                        backgroundColor: "orange",
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            },
        });
    }

    if (ctx3) {
        new Chart(ctx3, {
            type: "bar",
            data: {
                labels: [
                    "DGM-Assam", "DGM-Jammu", "DGM-Mizoram", "DGM-Nagaland", "DGM-Tripura",
                    "GM-Assam", "GM-Jammu", "GM-Mizoram", "GM-Nagaland", "GM-Tripura"
                ],
                datasets: [
                    {
                        label: "Completed",
                        data: [19, 43, 32, 33, 29, 14, 13, 12, 11, 10],
                        backgroundColor: "green",
                    },
                    {
                        label: "In Progress",
                        data: [75, 103, 157, 38, 142, 113, 104, 95, 86, 77],
                        backgroundColor: "blue",
                    },
                    {
                        label: "Not Started",
                        data: [45, 24, 67, 99, 35, 24, 27, 19, 21, 23],
                        backgroundColor: "orange",
                    },
                ],
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    }
                }
            },
        });
    }
});
