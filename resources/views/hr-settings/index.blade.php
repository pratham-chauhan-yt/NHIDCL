@extends('layouts.dashboard')
@section('dashboard_content')
<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('HR Settings') }}</div>
        </div>
        <div class="inner_page_dash__">
            <div class="dashbord_main_content_rigt">
                <div class="second_cust">
                    <div class="card sticky-top" style="top:30px">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <a href="javascript:void(0);" class="list-group-item active">Leave Type</a>
                            <a href="javascript:void(0);" class="list-group-item">Department</a>
                            <a href="javascript:void(0);" class="list-group-item">Designation</a>
                            <a href="javascript:void(0);" class="list-group-item">Leave Type</a>
                        </div>
                    </div>
                </div>
                <div class="one_cut">
                    <div class="card">
                        <div class="card-body" id="leaveTypeFormContainer" style="display:none;">
                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                                <div>Leave Type</div>
                            </div>
                            <form class="form_grid_cust" method="POST" id="leaveTypeForm">
                                @csrf
                                <input type="hidden" name="_method" id="method" value="POST">
                                <div class="form-input">
                                    <label class="require-label">Leave Type</label>
                                    <input type="text" name="leave_type" id="leave_type" value="{{ old('leave_type') }}" class="form-control form-control-sm" required>
                                </div>
                                <div class="button_flex_cust_form">
                                    <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">{{ __('Submit') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="card-body table-border-style">
                            <div class="top_heading_dash__">
                                <div class="main_hed">
                                    <h4 class="text-[24px] py-[10px] font-semibold text-black">Leave Type</h4>
                                </div>
                                <div class="plain_dlfex bg_elips_ic">
                                    <button class="hover-effect-btn border_btn" type="button" onclick="formContainer()">{{ __('Create Leave Type') }}
                                    </button>
                                </div>
                            </div>
                            <table class="data_bg_table cust_table__ table_sparated" id="leaveTypeTable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Leave Type</th>
                                        <th>Days/Year</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@push('scripts')
    @include('master-settings.js.datatable-init')
    @include('master-settings.js.delete-confirmation')
    @include('master-settings.js.form-handler')
    <script>
        function formContainer(isEdit = false, leaveTypeId = null) {
            handleFormToggle('leaveTypeFormContainer', 'leaveTypeForm', isEdit, leaveTypeId, {
                fieldMap: {
                    'leave_type': 'leave_type'
                },
                idField: 'leave_type_id'
            });
        }
        handleFormSubmit('leaveTypeForm', '#leaveTypeTable', 'leaveTypeFormContainer');
    </script>
@endpush