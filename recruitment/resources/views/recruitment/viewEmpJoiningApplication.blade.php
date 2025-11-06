@extends('layouts.dashboard')
@section('dashboard_content')

<div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View/joinee Employee</div>
            <div class="plain_dlfex bg_elips_ic">
            <a href="{{ route('recruitment.employeeJoiningApplication') }}"><button class="hover-effect-btn fill_btn" type="button">Add Joinee Employee
            </button></a>
        </div>
        </div>
    </div>
            <div class="container inner_page_dash__ mt-[20px]">
                <h4 class="text-[24px] py-[10px] font-semibold">joinee Employee Lists</h4>
                    <table class="data_bg_table cust_table__ table_sparated" id="empTable">
                            <thead class="">
                                <tr>
                                <th class="text-center">Sl no</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Employment Type</th>
                                    <th class="text-center">Mobile No</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Gender</th>
                                    <th class="text-center">Designation</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                    </table>
            </div>
@endsection
@push('scripts')

<script src="{{ asset('js/chart-loader.js') }}"></script>
<script src="{{ asset('js/custom.js') }}"></script>

<!-- #cdn datatables files -->
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- #cdn -->

<script>

$(document).ready(function() {


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

            $('#empTable').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                bDestroy: true,
                bFilter: true,
                processing: true,
                serverSide: true,

    ajax: {
        url: '{{ route('recruitment.viewEmpJoiningApplication') }}',  // Correct route URL
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
        {data: 'first_name', name: 'first_name', orderable: false},
        {data: 'employment_type', name: 'employment_type', orderable: false},
        {data: 'mobile_number', name: 'mobile_number', orderable: false},
        {data: 'email_address', name: 'email_address', orderable: false},
        {data: 'gender', name: 'gender', orderable: false},
        {data: 'current_designation', name: 'current_designation', orderable: false},
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
