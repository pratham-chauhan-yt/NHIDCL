@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Grievance Application</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            @include('components.alert')
            <div class="table-responsive">
                <div class="table_over">
                    <form class="form_grid_cust" action="{{ route('grievance-management.grievance.store') }}" method="post" id="FormValidations">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Please enter full name" data-validate="required" data-error="Please enter full name.">
                            </div>
                            <div class="form-input">
                                <label class="required-label">Employee No.</label>
                                <input type="text" name="employee_code" id="employee_code" value="{{ old('employee_code') }}" placeholder="Enter your employee code" data-validate="required" data-error="Please enter employee code.">
                            </div>
                            <div class="form-input">
                                <label class="required-label">Designation</label>
                                <select name="ref_designation_id" id="ref_designation_id" class="form-select" data-validate="required" data-error="Please choose your designation.">
                                    <option value="">{{ __('--- Please select designation ---') }}</option>
                                    @foreach($designation as $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Department</label>
                                <select  name="ref_department_id" id="ref_department_id" class="form-select" data-validate="required" data-error="Please enter your designation.">
                                    <option value="">{{ __('--- Please select department ---') }}</option>
                                    @foreach($department as $val)
                                    <option value="{{ $val->id }}">{{ $val->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Pay Scale </label>
                                <input type="text" name="pay_scale" id="pay_scale" value="{{ old('pay_scale') }}" placeholder="Pay Scale" data-validate="required" data-error="Please enter your pay scale.">
                            </div>
                            <div class="form-input">
                                <label class="required-label">Dated </label>
                                <input type="date" name="date" id="date" value="{{ old('date') }}" data-validate="required" data-error="Please choose date.">
                            </div>
                            <div class="form-input">
                                <label class="required-label">Grievance Title </label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" placeholder="Enter grievance title" data-validate="required" data-error="Please enter grievance title.">
                            </div>
                            <div class="form-input">
                                <label class="required-label">Choose Type</label>
                                <select name="type" data-validate="required" data-error="Please choose grievance type.">
                                    <option value="">----- Choose grievance type -----</option>
                                    <option value="sexual_harassment">Sexual Harassment</option>
                                    <option value="workplace_issue">Workplace Issue</option>
                                    <option value="salary_compensation">Salary Compensation</option>
                                </select>
                            </div>
                            <div class="form-input attachment_upload_file">
                                <label class="required-label">Attach relevant/supporting documents (if any)</label>
                                <div class="flex gap-[10px]">
                                    <input id="upload_file_txt" name="upload_file_txt" type="text" class="upload_file_txt" placeholder="Upload documents" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_file cursor-pointer"> Upload File
                                    <input id="upload_file" name="upload_file" type="file" class="hidden upload_file">
                                    </label>
                                    <input type="hidden" name="upload_files" id="upload_files">
                                </div>
                                <small class="text-red">
                                    Max size: 2MB | Allowed types: PDF, Word (.doc, .docx), jpg, png.
                                </small>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Grievance &amp; Reason in brief </label>
                                <textarea name="message" id="message" cols="4" placeholder="Grievance &amp; Reason in brief" data-validate="required" data-error="Please enter grievance reason in brief.">{{ old('message') }}</textarea>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Address</label>
                                <textarea name="address" id="address" cols="4" placeholder="Permanent Address" data-validate="required" data-error="Please enter your address.">{{ old('address') }}</textarea>
                            </div>
                        </div>
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    const grievanceDataUrl = "{{ route('grievance-management.grievance.index') }}";
</script>
<script src="{{asset('public/js/grievance-management.js')}}"></script>
@endpush