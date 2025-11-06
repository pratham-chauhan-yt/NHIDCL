@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Master Settings - Application Status') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ URL::previous() }}"><button class="hover-effect-btn fill_btn" type="button">{{ __('Back') }}
                    </button></a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__" id="applicationStatusFormContainer" style="display: none;">
        <div class="my-4 ">
            <div>
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Add Application Status</div>
                </div>
                <form class="form_grid_cust" method="POST" id="applicationStatusForm">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Status Name</label>
                            <input type="text" class="" name="status" value="{{ old('status') }}" id="status" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Status Type</label>
                            <select name="type" id="type" required>
                                <option value=""> --- Choose application status type --- </option>
                                <option value="application">Application</option>
                                <option value="interview">Interview</option>
                                <option value="offerletter">Offer Letter</option>
                            </select>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit"
                            id="submitButton">{{ __('Create') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>

    <div class="inner_page_dash__ mt-[20px]">
        <div class="top_heading_dash__">
            <div class="main_hed">
                <h4 class="text-[24px] py-[10px] font-semibold text-black">Application Status List</h4>
            </div>
            <div class="plain_dlfex bg_elips_ic">
                <button class="hover-effect-btn border_btn" type="button"
                    onclick="formContainer()">{{ __('Create Application Status') }}
                </button>
            </div>
        </div>
        <table class="data_bg_table cust_table__ table_sparated" id="applicationStatusTable">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>

@endsection

@push('scripts')
    @include('master-settings.js.datatable-init')
    @include('master-settings.js.delete-confirmation')
    @include('master-settings.js.form-handler')
    <script>
        $(document).ready(function () {
            initDataTable('#applicationStatusTable', '{{ route("application-status.index") }}', [{
                data: 'status',
                name: 'status'
            },
            {
                data: 'type',
                name: 'type'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            ]);
        });

        function formContainer(isEdit = false, applicationStatusId = null) {
            handleFormToggle('applicationStatusFormContainer', 'applicationStatusForm', isEdit, applicationStatusId, {
                updateUrl: "{{ route('application-status.update', ':id') }}",
                editUrl: "{{ route('application-status.edit', ':id') }}",
                storeUrl: "{{ route('application-status.store') }}",
                fieldMap: {
                    'status': 'status'
                },
                idField: 'applicationStatus_id'
            });
        }

        handleFormSubmit('applicationStatusForm', '#applicationStatusTable', 'applicationStatusContainer');
    </script>
@endpush