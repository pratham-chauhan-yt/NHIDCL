@extends('layouts.dashboard')
@php
    use App\Models\{RefProjectType, RefProjectState};
@endphp


@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Edit Project</div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z">
                        </path>
                    </svg>
                    Project Details
                </button>


            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <form id="edit-project" method="POST" action="{{ route('bgms.project.update', encryptId($project->id)) }}"
                    class="form_grid_cust">
                    @csrf
                    @method('PUT')

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div>
                            <label class="required-label">Job No.</label>
                            <input type="text" name="job_no" value="{{ old('job_no', $project->job_no) }}" required
                                placeholder="Job no">
                            @error('job_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">UPC No.</label>
                            <input type="text" name="upc_no" value="{{ old('upc_no', $project->upc_no) }}" required
                                placeholder="UPC NO">
                            @error('upc_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project Name</label>
                            <input type="text" name="project_name"
                                value="{{ old('project_name', $project->project_name) }}" required>
                            @error('project_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project Type</label>
                            {{-- <select name="ref_project_type_id" required>
                                <option value="">Select Project Type</option>
                                @foreach (RefProjectType::all() as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('ref_project_type_id', $project->ref_project_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->project_type }}
                                    </option>
                                @endforeach
                            </select> --}}

                            <select required disabled>
                                <option value="">Select Project Type</option>
                                @foreach (RefProjectType::all() as $type)
                                    <option value="{{ $type->id }}"
                                        {{ old('ref_project_type_id', $project->ref_project_type_id) == $type->id ? 'selected' : '' }}>
                                        {{ $type->project_type }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="hidden" name="ref_project_type_id"
                                value="{{ old('ref_project_type_id', $project->ref_project_type_id) }}">

                            @error('ref_project_type_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project State</label>
                            <select name="ref_project_state_id" required>
                                <option value="">Select State</option>
                                @foreach (RefProjectState::all() as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('ref_project_state_id', $project->ref_project_state_id) == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ref_project_state_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">SAP ID</label>
                            <input type="text" name="sap_id" value="{{ old('sap_id', $project->sap_id) }}" required
                                placeholder="SAP ID">
                            @error('sap_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">
                            Update
                        </button>
                    </div>
                </form>

            </div>


        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.project.js') }}"></script>
@endpush
