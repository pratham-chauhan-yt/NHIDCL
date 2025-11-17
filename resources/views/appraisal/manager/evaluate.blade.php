@extends('layouts.dashboard')

@section('dashboard_content')


<link href="{{ asset('public/css/bootstrap1.min.css') }}" rel="stylesheet">
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>

<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Manager Appraisal Evaluation') }}</div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]">

        <h4 class="text-[24px] py-[10px] font-semibold">
            Evaluate Employee (Name & Email : {{ $employee->name }} - {{ $employee->email }}) — (Cycle Name : {{ $cycle->cycle_name }})
        </h4>

        {{-- ✅ Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ✅ If No KPIs --}}
        @if($kpis->isEmpty())
            <div class="alert alert-warning">No active KPIs found for this cycle.</div>
        @else
        <form id="managerEvaluateForm" method="POST" action="{{ route('employee-management.manager.storeRating') }}">
            @csrf
            <input type="hidden" name="employee_id" value="{{ $employeeId }}">
            <input type="hidden" name="cycle_id" value="{{ $cycleId }}">

            <table class="table table-bordered align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>KPI Name</th>
                        <th>Employee Self-Rating</th>
                        <th>Manager Rating (1–5)</th>
                        <!-- <th>Manager Comment</th> -->
                    </tr>
                </thead>
                <tbody>
                    @foreach($kpis as $index => $kpi)
                        @php
                            $selfRating = $ratings[$kpi->kpi_name]->self_rating ?? '-';
                            $selfComment = $ratings[$kpi->kpi_name]->comment ?? 'No comment';
                        @endphp

                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                {{ $kpi->kpi_name }}
                                <input type="hidden" name="ratings[{{ $kpi->id }}][goal_title]" value="{{ $kpi->kpi_name }}">
                            </td>
                            <td>
                                <strong>{{ $selfRating }}</strong><br>
                                <small class="text-muted">{{ $selfComment }}</small>
                            </td>
                            <td>
                                <select name="ratings[{{ $kpi->id }}][manager_rating]" class="form-select form-select-sm" required>
                                    <option value="">Select</option>
                                    @for($i = 1; $i <= 5; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                           {{--   <td>
                              <input type="text" class="form-control form-control-sm" name="ratings[{{ $kpi->id }}][comment]" placeholder="Add your comment">
                            </td>--}}
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="text-end mt-3">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk"></i> Save Evaluation
                </button>
            </div>
        </form>
        @endif

    </div>
</section>

<script>
$(function() {
    $('#managerEvaluateForm').on('submit', function() {
        $('button[type=submit]').prop('disabled', true).text('Saving...');
    });
});
</script>

@endsection
