@extends('layouts.dashboard')

@section('dashboard_content')
<link href="{{ asset('public/css/bootstrap1.min.css') }}" rel="stylesheet">
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Employees Appraisal List') }}</div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]" id="permissionContainer">
        <h4 class="text-[24px] py-[10px] font-semibold">Employees Appraisal List</h4>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

    <table id="hrEmployeeTable" class="table table-bordered mt-4">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Email</th>
                <th>Cycle Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($employees as $index => $emp)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $emp->employee_name }}</td>
                    <td>{{ $emp->email }}</td>
                    <td>{{ $emp->cycle_name }}</td>
                    <td>
                        <a href="{{ route('employee-management.hr.evaluate', [$emp->employee_id, $emp->cycle_id]) }}"
                           class="btn btn-sm btn-outline-primary">
                           <i class="fa-solid fa-star"></i> Evaluate
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="5" class="text-center text-muted">No employees pending for HR evaluation.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

</section>

{{-- ✅ Datatable --}}
<script>
    $(document).ready(function() {
        $('#hrEmployeeTable').DataTable({
            pageLength: 10,
            ordering: true,
            searching: true
        });
    });
</script>
@endsection
