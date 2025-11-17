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

        <table id="appraisalTable" class="table table-bordered mt-3">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($listofemployee as $index => $emp)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $emp->name }}</td>
                        <td>{{ $emp->email }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary openCycleModal"
                                data-employee-id="{{ $emp->id }}"
                                data-employee-name="{{ $emp->name }}">
                                <i class="fa-solid fa-chart-line"></i> Evaluate
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-center">No employees found under you.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

<!-- Hidden input -->
<input type="hidden" id="selectedEmployeeId">

<!-- Modal -->
<div class="modal fade"
     id="selectCycleModal"
     tabindex="-1"
     aria-labelledby="selectCycleLabel"
     aria-hidden="true"
     data-bs-backdrop="false"
     data-bs-keyboard="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="selectCycleLabel">Select Appraisal Cycle</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        <select id="cycleSelect" class="form-select">
          <option value="">-- Select Cycle --</option>
          @foreach ($cycles as $cycle)
            <option value="{{ $cycle->id }}">{{ $cycle->cycle_name }}</option>
          @endforeach
        </select>
      </div>
      <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="confirmCycleBtn" class="btn btn-primary">Proceed</button>
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function() {
    $('#appraisalTable').DataTable({
        pageLength: 10,
        ordering: true,
        searching: true
    });

    // ✅ Modal open
    $(document).on('click', '.openCycleModal', function() {
        const empId = $(this).data('employee-id');
        const empName = $(this).data('employee-name');
        $('#selectedEmployeeId').val(empId);
        $('#selectCycleLabel').text(`Select Appraisal Cycle for ${empName}`);
        $('#selectCycleModal').modal('show');
    });

    // ✅ Proceed click
    $('#confirmCycleBtn').on('click', function() {
        const empId = $('#selectedEmployeeId').val();
        const cycleId = $('#cycleSelect').val();

        if (!cycleId) {
            alert('Please select an appraisal cycle first.');
            return;
        }

        const url = "{{ route('employee-management.manager.evaluate', [':empId', ':cycleId']) }}"
            .replace(':empId', empId)
            .replace(':cycleId', cycleId);
        window.location.href = url;
    });
});
</script>
@endsection
