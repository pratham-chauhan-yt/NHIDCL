@extends('layouts.dashboard')

@section('dashboard_content')

<link href="{{ asset('public/css/bootstrap1.min.css') }}" rel="stylesheet">

<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('HR Evaluation') }}</div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]" id="permissionContainer">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    HR Evaluation — 
                    <span class="fw-bold">{{ $employee->name ?? 'Unknown Employee' }}</span>
                    <small>(Cycle: {{ $cycle->cycle_name ?? 'N/A' }})</small>
                </h5>
                <a href="{{ url()->previous() }}" class="btn btn-light btn-sm">← Back</a>
            </div>

            <div class="card-body bg-light">
                {{-- ✅ Success message --}}
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fa fa-check-circle"></i> {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- ✅ Form --}}
                <form action="{{ route('employee-management.hr.storeRating') }}" method="POST">
                    @csrf
                    <input type="hidden" name="employee_id" value="{{ $employee->id }}">
                    <input type="hidden" name="cycle_id" value="{{ $cycle->id }}">

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th style="width: 25%">KPI Title</th>
                                    <th>Employee Rating</th>
                                    <th>Manager Rating</th>
                                    <th>HR Rating</th>
                                    <th>Comment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kpis as $kpi)
                                    @php
                                        $rating = $ratings[$kpi->kpi_name] ?? null;
                                    @endphp
                                    <tr>
                                        <td class="text-start">{{ $kpi->kpi_name }}</td>
                                        <td>
                                            <span class="badge bg-info text-dark">
                                                {{ $rating->self_rating ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning text-dark">
                                                {{ $rating->gm_rating ?? '-' }}
                                            </span>
                                        </td>
                                        <td>
                                            <select name="hr_rating[{{ $kpi->kpi_name }}]" class="form-select form-select-sm" required>
                                                <option value="">-- Select --</option>
                                                @for($i = 1; $i <= 5; $i++)
                                                    <option value="{{ $i }}" 
                                                        {{ isset($rating->hr_rating) && $rating->hr_rating == $i ? 'selected' : '' }}>
                                                        {{ $i }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" 
                                                   name="comment[{{ $kpi->kpi_name }}]" 
                                                   value="{{ $rating->comment ?? '' }}" 
                                                   class="form-control form-control-sm" 
                                                   placeholder="Add remark...">
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-success px-4">
                            <i class="fa fa-save"></i> Submit HR Ratings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection

@push('scripts')
<script src="{{ asset('public/js/bootstrap.bundle.min.js') }}"></script>
@endpush
