@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#add-task-management").validate({
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
                errorPlacement: function(error, element) {
                    error.addClass('error-message');
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });

        $(document).ready(function() {
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
                errorPlacement: function(error, element) {
                    error.addClass('error-message');
                    error.insertAfter(element);
                },
                submitHandler: function(form) {
                    $('#remarks').val(quill.root.innerHTML);
                    form.submit();
                }
            });
        });


        $(document).on('change', '.upload_attachment', function() {

            let $this = $(this);

            let file = $this[0].files[0];

            if (!allowedFileTypes.includes(file.type)) {

                showError("Invalid File Type",
                    "Only PDF, Word, Excel, and image files (JPG, PNG, etc.) are allowed");

                $(this).val("");

                return false;
            }


            console.log(file.size);
            console.log(imageSize);
            if (file.size > imageSize) {

                showError("File size large", "Please select 2 MB PDF only!");

                $this.val("");

                return false;
            }

            let formData = new FormData();

            formData.append('attachment', file);

            formData.append('type', file.type);

            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('task-management.upload') }}",
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('/uploads/task-management/');
                        let url =
                            "{{ route('task-management.view') }}?pathName=:pathName&fileName=:fileName";
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let fileUrl = url;

                        console.log(response);
                        console.log(fileUrl);

                        $this.hide();
                        $this.closest('.attachment_section_upload_attachment').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_upload_attachment').find(
                            '.uploaded_attachment').val(fileUrl);
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



        $(document).ready(function() {


            $('#ref_task_source_id').on('change', function() {

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
    </script>
@endpush
