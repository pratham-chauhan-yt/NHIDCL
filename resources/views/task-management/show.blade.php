@extends('layouts.dashboard')

@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Task Details</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <h1 class="candidat_cust-title">{{ $task_detail['task_name'] }} ({{ $task_detail['id'] }})</h1>
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <p>Priority: <br /><span class="text-red-500">{{ $task_detail['priority'] }}</span></p>
                        <p>Repeat: <br /><span>{{ $task_detail['repeat'] }}</span></p>
                        <p>Bucket: <br /><span>{{ $task_detail['bucket'] }}</span></p>
                        <p>Division: <br /><span>{{ $task_detail['division'] }}</span></p>
                        @php
                            use App\Enums\TaskStatus;

                            $status = $task_detail['status'] ?? null;
                            $statusLabel = $status && TaskStatus::tryFrom($status)
                                ? TaskStatus::from($status)->label()
                                : 'Pending';
                        @endphp

                        <p>Status: <br />
                            <span>{{ $statusLabel }}</span>
                        </p>
                        @if (!empty($task_detail->upload_attachment))
                            <p>
                                File: <br />
                                <a href="{{ asset($task_detail->upload_attachment) }}" target="_blank">
                                    <i class="fa fa-file-pdf mx-1" aria-hidden="true"></i> View File
                                </a>
                            </p>
                        @endif
                        <p>Start Date: <br /><span>{{ $task_detail['start_date'] }}</span></p>
                        <p>Due Date: <br /><span>{{ $task_detail['due_date'] }}</span></p>
                        <p>Assigned To: <br /><span>{{ $task_detail['assignedTo'] }}</span></p>
                    </div>
                    <hr class="my-3" />

                    <div class="table_over mt-4">
                        <p class="text-sm"><strong>Note:-</strong> <span class="text-gray-600">{{ $task_detail['note'] }}</span></p>
                        <h4 class="candidat_cust-title">List of Replies:-</h4>
                        <table class="cust_table__ table_sparated" id="replies-management-table">
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Remark/Comment</th>
                                    <th scope="col">File</th>
                                    <th scope="col">User (Reply By)</th>
                                    <th>Response Date</th>
                                </tr>
                            </thead>
                            <tbody class="">

                            </tbody>
                        </table>
                    </div>
                    @if($task_detail['status']!="completed")
                    <hr class="mt-5 mx-12 mr" />

                    <div class="border border-indigo-100 border-solid rounded-md shadow-xl mt-5 mx-4">
                        @include('components.alert')
                        <form class="form_grid_cust" action="{{ route('task-management.reply') }}" method="POST"
                            id="reply-task-management" enctype="multipart/form-data">

                            @csrf

                            <input type="hidden" name="nhidcl_mdtm_task_details_id" id="nhidcl_mdtm_task_details_id"
                                value="{{ old('nhidcl_mdtm_task_details_id', $task_detail['id']) }}">
                            <input type="hidden" name="remarks" id="remarks">
                            @error('remarks')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <div class="">
                                <label class="required-label">Remarks</label>
                                <textarea class="form-control textarea" name="remarks"></textarea>

                                @error('assigned_to')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>



                            <div class="inpus_cust_cs form_grid_dashboard_cust_ grid check_box_input grid-cols-1 mt-4 p-2">
                                <div class="">
                                    <div class="flex gap-[10px]">
                                        <input type="file" id="upload" class="upload" name="upload" name="attachment"
                                            placeholder="Upload multiple files" />
                                        <input type="text" class="hidden-img uploaded_attachment"
                                            placeholder="Upload Image" readonly>
                                        <input type="hidden" id="file" name="file" value="">

                                        <button type="submit" title="submit-button"
                                            class="hover-effect-btn border_btn">Submit</button>
                                    </div>
                                </div>
                                @error('file')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

@push('style_end')
    <link rel="stylesheet" href="{{ asset('public/css/quill.snow.css') }}">
@endpush



@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('#replies-management-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('task-management.replies', encryptId($task_detail['id'])) }}",
                columns: [{
                        data: null,
                        name: 'serial_no',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + meta.settings._iDisplayStart + 1;
                        }
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'remarks',
                        name: 'remarks'
                    },

                    {
                        data: 'file',
                        name: 'file',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            if (data) {
                                return `<a href="${data}" target="_blank">
                                    <i class="fa fa-file-pdf text-red-600"></i> View
                                </a>`;
                            }
                            return '';

                        }
                    },

                    {
                        data: 'created_by',
                        name: 'created_by'
                    },

                    {
                        data: 'created_at',
                        name: 'created_at'
                    }

                ]
            });
        });

        $(document).on('change', '.upload', function() {

            let $this = $(this);

            let file = $this[0].files[0];

            if (!allowedImageType.includes(file.type)) {

                showError("Invalid File Type", "Only PDF and image files (JPG, PNG, etc.) are allowed");

                $(this).val("");

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

                        $this.closest('.flex').find('.uploaded_attachment').val(fileUrl);

                        $this.siblings('input[type="hidden"]').val(response.file_name);

                    } else {
                        showError("Upload Failed", response.message);
                        $this.val('');
                    }
                }
            });
        });
    </script>
@endpush

@includeIf('task-management.script')
