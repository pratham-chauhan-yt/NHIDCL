@extends('layouts.dashboard')

@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4">
        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
            <div class="">Edit KPI: <b>{{ $kpi->kpi_name }}</b></div>

            @if (session('success'))
                <div style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px; margin-bottom:10px;">
                    {{ session('success') }}
                </div>
            @endif
        </div>

       <form action="{{ route('employee-management.kpi.update', $kpi->id) }}" method="POST">
            @csrf
            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                <div>
                 <label for="kpi_name" class="form-label">KPI Name</label>
            <input type="text" name="kpi_name" id="kpi_name" value="{{ $kpi->kpi_name }}" class="form-control" required>
                </div>


                <div class="form-group">
                    <label for="status" class="required-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        @foreach ($statuses as $status)
                            <option value="{{ $status->id }}" {{ $kpi->ref_status_id == $status->id ? 'selected' : '' }}>
                                {{ $status->type }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="button_flex_cust_form mt-3">
                <button type="submit" class="hover-effect-btn fill_btn">Update</button>
          
                     <a href="{{ route('employee-management.kpi.index', $kpi->nhidcl_ems_employee_appraisal_cycle_id) }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
