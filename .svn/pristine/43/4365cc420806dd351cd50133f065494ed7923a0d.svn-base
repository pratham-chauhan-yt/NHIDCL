@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Edit Asset Details</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            @include('components.alert')
            <div id="Home" class="tabcontent" style="display: block;">
                <form action="" method="post" class="form_grid_cust" id="hrAssignAssetForms">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Name of asset</label>
                            <input type="text" name="name_of_asset" id="name_of_asset" value="{{ old('name_of_asset', $assignasset->name_of_asset ?? '') }}" placeholder="Name of asset" data-validate="required" data-error="Please enter name of assets.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">No. of assets</label>
                            <input type="number" name="total_assets" id="total_assets" value="{{ old('total_assets', $assignasset->total_assets ?? '') }}" placeholder="Enter number of assets" data-validate="required" data-error="Please enter total number od assets.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Division</label>
                            <select name="ref_department_id" id="ref_department_id" data-validate="required" data-error="Please choose employee division.">
                                <option value="">--- Choose Employee Division ---</option>
                                @foreach($department as $division)
                                    <option value="{{ $division->id }}" {{ $assignasset->ref_department_id == $division->id ? 'selected' : '' }}>{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="required-label">Assign to</label>
                            <select name="ref_users_id" id="ref_users_id" data-validate="required" data-error="Please choose assign assets employee.">
                                <option value="">--- Choose Asset Assign Employee ---</option>
                                @foreach($users as $userdata)
                                <option value="{{ $userdata->id }}" {{ $assignasset->ref_users_id == $userdata->id ? 'selected' : '' }}>{{ $userdata->name }} ({{ $userdata->email }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Status</label>
                            <select name="ref_status_id" id="ref_status_id" data-validate="required" data-error="Please assets status.">
                                <option value="">--- Choose Asset Status ---</option>
                                @foreach($status as $statusdata)
                                <option value="{{ $statusdata->id }}" {{ $assignasset->ref_status_id == $statusdata->id ? 'selected' : '' }}>{{ $statusdata->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label>Asset Return Date</label>
                            <input type="date" name="returned_date" id="returned_date" value="{{ old('returned_date', $assignasset->returned_date ?? '') }}" placeholder="Enter assets return date">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Remark</label>
                            <textarea name="remark" id="remark" rows="3" placeholder="Remark" data-validate="required" data-error="Please enter remarks.">{{ old('remark', $assignasset->remark ?? '') }}</textarea>
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
@push('scripts')
<script>
    const userDivisionUrl = "{{ route('employee-management.get.users.by.division') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush