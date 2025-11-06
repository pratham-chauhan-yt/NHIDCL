@extends('layouts.dashboard')

@section('dashboard_content')
<div class="row">
    <div class="col-12">
        @include('breadcrumb.index')
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card" id="tasksList">
            <div class="card-header border-0">
                <div class="d-flex align-items-center">
                    <h5 class="card-title mb-0 flex-grow-1">Users List</h5>
                    <div class="flex-shrink-0">
                        <a class="btn btn-danger add-btn" href="{{ route('usermanagement.create') }}">
                            <i class="ri-add-line align-bottom me-1"></i> Add New User
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body border border-dashed border-end-0 border-start-0">
                <form>
                    <div class="row g-3">
                        <div class="col-xxl-5 col-sm-12">
                            <div class="search-box">
                                <input type="text" class="form-control search bg-light border-light" placeholder="Search for tasks or something...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">From</span>
                                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div class="input-group">
                                <span class="input-group-text" id="inputGroup-sizing-default">To</span>
                                <input type="date" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
                            </div>
                        </div>

                        <div class="col-xxl-2 col-sm-4">
                            <div class="input-light">
                                <select class="form-control" data-choices data-choices-search-false name="choices-single-default" id="idStatus">
                                    <option value="">Status</option>
                                    <option value="all" selected>All</option>
                                    <option value="New">New</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Inprogress">Inprogress</option>
                                    <option value="Completed">Completed</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xxl-1 col-sm-4">
                            <button type="button" class="btn btn-primary w-100" onclick="SearchData();">Filters</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="card-body">
                <div class="table-responsive table-card mb-4">
                    <table class="table align-middle table-nowrap mb-0" id="dt_table" width="100%">
                        <thead class="table-light text-muted">
                            <tr>
                                <th class="sort">#</th>
                                <th class="sort">Name</th>
                                <th class="sort">Email</th>
                                <th class="sort">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#dt_table').DataTable({
        dom: 'Blfrtip',
        lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
        processing: true,
        serverSide: true,
        bDestroy: true,
        bFilter: false,
        ajax: {
            url: '{{ route("usermanagement.index") }}',
            type: 'get',
            data: function (d) {
                d.url = '{{ route("usermanagement.index") }}';
                d.search_text = $('#search_text').val();
                d.start_date = $('#start_date').val();
                d.end_date = $('#end_date').val();
                d.department = $('#department').val();
                d.designation = $('#designation').val();
                d.sub_department = $('#sub_department').val();
                // d.status = $('#idStatus').val();
            }
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false },
            { data: 'name', name: 'name', orderable: false },
            { data: 'email', name: 'email', orderable: false },
            { data: 'action', name: 'action' }
        ],
        buttons: []
    });

    $(document).on('click', '.deletedata', function() {
        var id = $(this).attr('data-id');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "#".replace(':id', id),
                    method: "GET",
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(result) {
                        Swal.fire('Deleted!', 'Record Deleted Successfully.', 'success');
                        setTimeout(function() {
                            location.reload();
                        }, 1000);
                    }
                });
            }
        });
    });

    $("#filterButton").click(function() {
        table.draw();
    });

    document.getElementById('clearButton').addEventListener('click', function() {
        window.location.reload();
    });

</script>
@endpush
