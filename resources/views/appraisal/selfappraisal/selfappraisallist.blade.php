@extends('layouts.dashboard')

@section('dashboard_content')
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->

<!-- jQuery + DataTables JS -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script> -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Self Appraisal list') }}</div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]" id="permissionContainer">
        <h4 class="text-[24px] py-[10px] font-semibold">Self Appraisal List</h4>

        {{-- ✅ Success Message --}}
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        {{-- ✅ Appraisal Table --}}
        <table id="appraisalTable" class="table table-bordered table-striped align-middle">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Cycle Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($allCycles as $index => $cycle)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $cycle->cycle_name }}</td>
                    <td>{{ \Carbon\Carbon::parse($cycle->start_date)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cycle->end_date)->format('d-m-Y') }}</td>
                    <td>
                        @foreach ($statuses as $status)
                        @if ($cycle->ref_status_id == $status->id)
                        {{ $status->type }}
                        @endif
                        @endforeach
                    </td>
                    <td>
                       
                        <a href="{{ route('employee-management.selfappraisal.selfappraisalform', $cycle->id) }}" class="btn btn-sm btn-outline-primary">
                           +Add 
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>

{{-- ✅ DataTable Activation --}}
<script>
    $(document).ready(function() {
        $('#appraisalTable').DataTable({
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            ordering: true,
            searching: true,
            language: {
                search: "Search Appraisal:",
                lengthMenu: "Show _MENU_ entries per page",
                info: "Showing _START_ to _END_ of _TOTAL_ records",
            }
        });
    });
</script>
@endsection