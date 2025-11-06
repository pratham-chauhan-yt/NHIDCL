@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Approve Apply Leave</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            @include('components.alert')
            <div id="Home" class="tabcontent" style="display: block;">
                <form action="" method="post" class="form_grid_cust">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Status</label>
                            <select name="ref_status_id" id="ref_status_id">
                                <option value="">--- Choose Asset Status ---</option>
                                @foreach($status as $statusdata)
                                <option value="{{ $statusdata->id }}" {{ $leaves->ref_status_id == $statusdata->id ? 'selected' : '' }}>{{ $statusdata->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Remark</label>
                            @if(auth()->user()->id == $leaves->ref_approver_id)
                            <input type="hidden" name="action" value="approved">
                            <textarea name="approver_remark" id="approver_remark" rows="3" placeholder="Remark" required>{{ old('approver_remark', $attendance->approver_remark ?? '') }}</textarea>
                            @endif
                            @if(auth()->user()->id == $leaves->ref_checker_id)
                            <input type="hidden" name="action" value="checked">
                            <textarea name="checker_remark" id="checker_remark" rows="3" placeholder="Remark" required>{{ old('checker_remark', $attendance->checker_remark ?? '') }}</textarea>
                            @endif
                            <small class="form-text text-muted text-red">
                                Remarks exceeding 500 characters will not be accepted.
                            </small>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn" name="submit" value="Submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection