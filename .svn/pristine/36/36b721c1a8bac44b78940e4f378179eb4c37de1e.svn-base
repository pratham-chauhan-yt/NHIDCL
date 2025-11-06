@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Master Settings - Mode Of Recruitment') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ URL::previous() }}"><button class="hover-effect-btn fill_btn" type="button">{{ __('Back') }}
                    </button></a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__" id="dataFormContainer" style="display: none;">
        <div class="my-4 ">
            <div>
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Add Mode Of Recruitment</div>
                </div>
                <form class="form_grid_cust" method="POST" id="dataFormContainer">
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
                <h4 class="text-[24px] py-[10px] font-semibold text-black">Mode Of Recruitment List</h4>
            </div>
            <div class="plain_dlfex bg_elips_ic">
                <button class="hover-effect-btn border_btn" type="button"
                    onclick="formContainer()">{{ __('Create Mode Of Recruitment') }}
                </button>
            </div>
        </div>
        <table class="data_bg_table cust_table__ table_sparated" id="dataTable">
            <thead class="">
                <tr>
                    <th>#</th>
                    <th>Name</th>
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
            initDataTable('#dataTable', '{{ route("recruitment-mode.index") }}', [{
                data: 'name',
                name: 'name'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            ]);
        });

        function formContainer(isEdit = false, dataId = null) {
            handleFormToggle('dataFormContainer', 'dataForm', isEdit, dataId, {
                updateUrl: "{{ route('recruitment-mode.update', ':id') }}",
                editUrl: "{{ route('recruitment-mode.edit', ':id') }}",
                storeUrl: "{{ route('recruitment-mode.store') }}",
                fieldMap: {
                    'status': 'status'
                },
                idField: 'data_id'
            });
        }

        handleFormSubmit('dataForm', '#dataTable', 'dataFormContainer');
    </script>
@endpush