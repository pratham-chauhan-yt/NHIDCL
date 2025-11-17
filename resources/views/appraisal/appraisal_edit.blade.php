@extends('layouts.dashboard')

@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4">
        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
            <div class="">Edit Appraisal Cycle</div>

            @if (session('success'))
                <div style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px; margin-bottom:10px;">
                    {{ session('success') }}
                </div>
            @endif
        </div>

        <form id="editAppraisalForm" action="{{ route('employee-management.appraisal.cycle.update', $cycle->id) }}" method="POST">
            @csrf
            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                <div>
                    <label class="required-label">Cycle Name</label>
                    <input id="cycle_name" name="cycle_name" type="text" maxlength="100" value="{{ $cycle->cycle_name }}" required>
                </div>

                <div>
                    <label class="">Start Date</label>
                    <input type="date" name="start_date" id="start_date" value="{{ $cycle->start_date }}" required>
                </div>

                <div>
                    <label class="">End Date</label>
                    <input type="date" name="end_date" id="end_date" value="{{ $cycle->end_date }}" required>
                </div>

                <div class="form-group">
                    <label for="status" class="required-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ $cycle->ref_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="button_flex_cust_form mt-3">
                <button type="submit" class="hover-effect-btn fill_btn">Update</button>
                <a href="{{ route('employee-management.appraisal.appraisallist') }}" class="btn btn-secondary ms-2">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
