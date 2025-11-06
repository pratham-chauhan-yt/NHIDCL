@extends('layouts.dashboard')

@section('dashboard_content')

    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View/Post</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{route('recruitment.post')}}"><button class="hover-effect-btn fill_btn" type="button">Create Post
                </button></a>
            </div>
        </div>
    </div>
            <div class="container inner_page_dash__ mt-[20px]">
                <h4 class="text-[24px] py-[10px] font-semibold">Post Lists</h4>
                    <table class="data_bg_table cust_table__ table_sparated" id="posttable">
                            <thead class="">
                                <tr>
                                    <th>Sl no</th>
                                    <th>Advertisement Year</th>
                                    <th>Post Name</th>
                                    <th>Post Requirement</th>
                                    <th>Post Eligibility</th>
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
            $('#posttable').DataTable({
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                bDestroy: true,
                bFilter: true,
                processing: true,
                serverSide: true,

    ajax: {
        url: '{{ route('recruitment.postList') }}',  // Correct route URL
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
        {data: 'advertisement_year', name: 'advertisement_year', orderable: false},
        {data: 'post_name', name: 'post_name', orderable: false},
        {data: 'post_requirement', name: 'post_requirement', orderable: false},
        {data: 'post_eligibility', name: 'post_eligibility', orderable: false},
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
