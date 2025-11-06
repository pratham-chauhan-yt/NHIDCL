@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Master Settings - Engagement') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ URL::previous() }}"><button class="hover-effect-btn fill_btn" type="button">{{ __('Back') }}
                    </button></a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__" id="engagementFormContainer" style="display: none;">
        <div class="my-4 ">
            <div>
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Engagement </div>
                </div>
                <form class="form_grid_cust" method="POST" id="engagementForm">
                    @csrf
                    <input type="hidden" name="_method" id="method" value="POST">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div>
                            <label class="">Engagement</label>
                            <input type="text" class="" name="engagement_type" value="{{ old('engagement_type') }}" id="engagement_type"
                                required>
                        </div>

                        @error("engagement_type")
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

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
                <h4 class="text-[24px] py-[10px] font-semibold text-black">Engagement List</h4>
            </div>
            <div class="plain_dlfex bg_elips_ic">
                <button class="hover-effect-btn border_btn" type="button"
                    onclick="formContainer()">{{ __('Create') }}
                </button>
            </div>
        </div>
        <table class="data_bg_table cust_table__ table_sparated" id="engagementTable">
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
            initDataTable('#engagementTable', '{{ route("master-settings.engagement.index") }}', [{
                data: 'engagement_type',
                name: 'engagement_type'
            },
            {
                data: 'created_at',
                name: 'created_at'
            },
            ]);
        });

        function formContainer(isEdit = false, qmsTypeId = null) {
            handleFormToggle('engagementFormContainer', 'engagementForm', isEdit, qmsTypeId, {
                updateUrl: "{{ route('master-settings.engagement.update', ':id') }}",
                editUrl: "{{ route('master-settings.engagement.edit', ':id') }}",
                storeUrl: "{{ route('master-settings.engagement.store') }}",
                fieldMap: {
                    'engagement_type': 'engagement_type'
                },
                idField: 'engagement_type_id'
            });
        }

        handleFormSubmit('engagementForm', '#engagementTable', 'engagementFormContainer');
    </script>
@endpush
