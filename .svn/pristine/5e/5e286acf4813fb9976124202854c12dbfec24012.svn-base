@props([
    'title', // Page Title
    'entity', // Entity Name (e.g. caste, designation, dms-type)
    'fields' => [], // Form fields [ {name,label,type} ]
    'idField' => 'id', // Primary key field
    'maxlength',
])

@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __("Master Settings - {$title}") }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ URL::previous() }}">
                    <button class="hover-effect-btn fill_btn" type="button">{{ __('Back') }}</button>
                </a>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="inner_page_dash__" id="{{ $entity }}FormContainer" style="display: none;">
        <div class="my-4">
            <form class="form_grid_cust" method="POST" id="{{ $entity }}Form">
                @csrf
                <input type="hidden" name="_method" id="method" value="POST">
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    @foreach ($fields as $field)
                        <div>
                            <label class="required-label">{{ $field['label'] }}</label>
                            <input type="{{ $field['type'] ?? 'text' }}" name="{{ $field['name'] }}"
                                id="{{ $field['name'] }}" value="{{ old($field['name']) }}" maxlength="{{ $field['maxlength'] ?? '100' }}" required>
                            @error($field['name'])
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    @endforeach
                </div>
                <div class="button_flex_cust_form">
                    <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">
                        {{ __('Create') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- List --}}
    <div class="inner_page_dash__ mt-[20px]">
        <div class="top_heading_dash__">
            <div class="main_hed">
                <h4 class="text-[24px] py-[10px] font-semibold text-black">{{ $title }} List</h4>
            </div>
            <div class="plain_dlfex bg_elips_ic">
                <button class="hover-effect-btn border_btn" type="button" onclick="formContainer()">{{ __('Create') }}
                    {{ $title }}</button>
            </div>
        </div>
        <table class="data_bg_table cust_table__ table_sparated" id="{{ $entity }}Table">
            <thead>
                <tr>
                    <th>#</th>
                    @foreach ($fields as $field)
                        <th>{{ $field['label'] }}</th>
                    @endforeach
                    <th>Created</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
@endsection

@push('scripts')
    @include('master-settings.js.datatable-init')
    @include('master-settings.js.delete-confirmation')
    @include('master-settings.js.form-handler')

    <script>
        $(document).ready(function() {
            initDataTable('#{{ $entity }}Table', '{{ route("master-settings.$entity.index") }}', [
                @foreach ($fields as $field)
                    {
                        data: '{{ $field['name'] }}',
                        name: '{{ $field['name'] }}'
                    },
                @endforeach {
                    data: 'created_at',
                    name: 'created_at'
                }
            ]);
        });

        function formContainer(isEdit = false, recordId = null) {
            handleFormToggle('{{ $entity }}FormContainer', '{{ $entity }}Form', isEdit, recordId, {
                updateUrl: "{{ route("master-settings.$entity.update", ':id') }}",
                editUrl: "{{ route("master-settings.$entity.edit", ':id') }}",
                storeUrl: "{{ route("master-settings.$entity.store") }}",
                fieldMap: {
                    @foreach ($fields as $field)
                        '{{ $field['name'] }}': '{{ $field['name'] }}',
                    @endforeach
                },
                idField: '{{ $idField }}'
            });
        }

        handleFormSubmit('{{ $entity }}Form', '#{{ $entity }}Table', '{{ $entity }}FormContainer');
    </script>
@endpush
