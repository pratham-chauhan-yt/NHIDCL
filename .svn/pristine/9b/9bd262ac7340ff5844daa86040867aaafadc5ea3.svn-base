@extends('layouts.dashboard')

@section('dashboard_content')

<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('View User / Employee') }}</div>

        </div>
    </div>


                 <div class="container inner_page_dash__ mt-[20px]">

                        <h4 class="text-[24px] py-[10px] font-semibold">Employee List</h4>

                        <table id="employeeTable" class="data_bg_table cust_table__ table_sparated selection-table">


                            <thead>
                                <tr>
                                    <th class="text-center">Sl no</th>
                                    <th class="text-center">Name</th>
                                    {{-- <th>Qualification</th> --}}
                                    <th class="text-center">Designation</th>
                                    {{-- <th>Employee Type</th>
                                    <th>Date of Joining</th> --}}
                                    {{-- <th>Date Completion of Tenure</th> --}}
                                    {{-- <th>Category</th>
                                    <th>Date of Birth</th>
                                    <th>Date of Retirement from government</th> --}}
                                    <th class="text-center">Employee Code</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Contact Number</th>
                                    {{-- <th>Parent Department</th> --}}
                                    {{-- <th>Place of Posting</th>
                                    <th>Date of Posting</th>
                                    <th>Record of Previous Postings</th> --}}
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Last Activity Time</th>
                                    {{-- <th>Account Status</th> --}}
                                    {{-- <th>Office Type</th> --}}
                                    {{-- <th>State</th> --}}
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-left">
                            </tbody>
                        </table>
                    </div>
</section>

@endsection
@push('scripts')

<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>

<script>

$(document).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            $('#employeeTable').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                bDestroy: true,
                bFilter: true,
                processing: true,
                serverSide: true,
                // buttons: [
                //     {
                //         extend: 'csvHtml5',
                //         text: '<i class="fa fa-file-csv text-primary"> CSV</i>',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]  // Specify columns for CSV export
                //         }
                //     },
                //     {
                //         extend: 'pdfHtml5',
                //         orientation: 'landscape',
                //         pageSize: 'A3',
                //         text: '<i class="fa fa-file-pdf text-primary"> PDF</i>',
                //         exportOptions: {
                //             columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21]
                //         }
                //     }
                // ],
    ajax: {
        url: '{{ route('user-emp.view') }}',  // Correct route URL
        type: 'GET',
        data: function(d) {
            d._token = "{{ csrf_token() }}";  // CSRF token
        },
        dataSrc: function(json) {
                console.log(json); // Check the data response in the console
                return json.data; // Ensure 'data' is returned in the format DataTables expects
            }
    },
    columns: [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
        {data: 'name', name: 'name', orderable: false},
        // {data: 'last_name', name: 'last_name', orderable: false},
        {data: 'qualification', name: 'qualification', orderable: false},
        // {data: 'designation_id', name: 'designation_id', orderable: false},
        // {data: 'employee_type', name: 'employee_type', orderable: false},
        // {data: 'date_of_joining', name: 'date_of_joining', orderable: false},
        // {data: 'date_completion_tenure', name: 'date_completion_tenure', orderable: false},
        // {data: 'category', name: 'category', orderable: false},
        // {data: 'date_of_birth', name: 'date_of_birth', orderable: false},
        // {data: 'date_of_retirement', name: 'date_of_retirement', orderable: false},
        {data: 'employee_code', name: 'employee_code', orderable: false},
        {data: 'email', name: 'email', orderable: false},
        {data: 'contact_number', name: 'contact_number', orderable: false},
        // {data: 'parent_department_id', name: 'parent_department_id', orderable: false},
        // {data: 'place_of_posting', name: 'place_of_posting', orderable: false},
        // {data: 'date_of_posting', name: 'date_of_posting', orderable: false},
        // {data: 'record_previous_posting', name: 'record_previous_posting', orderable: false},
        {data: 'department_id', name: 'department_id', orderable: false},
        {data: 'role_id', name: 'role_id', orderable: false},
        {data: 'last_activity_time', name: 'last_activity_time', orderable: false},
        // {data: 'userid_status', name: 'userid_status', orderable: false},
        // {data: 'office_type', name: 'office_type', orderable: false},
        // {data: 'state_id', name: 'state_id', orderable: false},
        {data: 'action', name: 'action', orderable: false, searchable: false}
    ],
    initComplete: function () {
        var btns = $('.dt-button');
        btns.removeClass('dt-button');
    },
});
    // Event listener for the filter button to redraw the table
    $(document).on('click', '#filter_data', function(e) {
        table.draw();
        e.preventDefault();
    });
});


    </script>

    {{-- Delete script  --}}
    <script type="text/javascript">
        function confirmDelete(id) {
            Swal.fire({
                title: "{!! __('Are you sure?') !!}",
                text: "{!! __('You won\'t be able to revert this!') !!}",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: "{!! __('Cancel') !!}",
                confirmButtonText: "{!! __('Yes, delete it!') !!}",
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form if confirmed
                    document.getElementById('delete-form-' + id).submit();
                }
            })
        }
    </script>
@endpush
