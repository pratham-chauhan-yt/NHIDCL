@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Leave Type') }}</div>
                <div class="plain_dlfex bg_elips_ic">
                    <button class="hover-effect-btn border_btn" type="button" onclick="formContainer()">{{ __('Create Leave Type') }}</button>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__" id="leaveTypeFormContainer" style="display: none;">
            <div class="my-4 ">
                <div>
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Create Leave Type</div>
                    </div>
                    <form class="form_grid_cust" method="POST" id="leaveTypeForm">
                        @csrf
                        <input type="hidden" name="_method" id="method" value="POST">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Leave Type Name</label>
                                <input type="text" name="leave_type" value="{{ old('leave_type') }}" id="leave_type" required>
                            </div>
                            @error('leave_type')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">{{ __('Submit') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__ mt-[20px]" id="permissionContainer" data-route-url="{{ route('leave.type.index') }}">
            <h4 class="text-[24px] py-[10px] font-semibold">Leave Type List</h4>
            <table id="leaveTypeTable" class="data_bg_table cust_table__ table_sparated  table-auto text-wrap cell-border stripe">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Leave Type</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>

        </div>
    </section>
@endsection
@push('scripts')
    @include('master-settings.js.datatable-init')
    @include('master-settings.js.delete-confirmation')
    @include('master-settings.js.form-handler')

    <script>
        $(document).ready(function () {
            initDataTable('#leaveTypeTable', "{{ route('leave.type.index') }}", [
                {
                    data: 'leave_type',
                    name: 'leave_type'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
            ]);
        });
        function formContainer(isEdit = false, departmentId = null) {
            handleFormToggle('leaveTypeFormContainer', 'leaveTypeForm', isEdit, departmentId, {
                updateUrl: "{{ route('leave.type.update', ':id') }}",
                editUrl: "{{ route('leave.type.edit', ':id') }}",
                storeUrl: "{{ route('leave.type.store') }}",
                fieldMap: { 'leave_type': 'leave_type' },
                idField: 'id'
            });
        }

        handleFormSubmit('leaveTypeForm', '#leaveTypeTable', 'leaveTypeFormContainer');
    </script>
@endpush