@extends('layouts.dashboard')

@section('dashboard_content')


<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Appraisal Management') }}</div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]" id="permissionContainer">
        <h4 class="text-[24px] py-[10px] font-semibold">Appraisal List</h4>

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
                        <a href="{{ route('employee-management.appraisal.cycle.edit', $cycle->id) }}"
                            class="btn btn-sm btn-outline-warning me-1">
                            <i class="fa fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('employee-management.kpi.index', $cycle->id) }}" class="btn btn-sm btn-outline-primary">
                            View/Add KPI
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