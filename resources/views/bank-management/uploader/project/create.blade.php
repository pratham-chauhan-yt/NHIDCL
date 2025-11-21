@extends('layouts.dashboard')
@php
    use App\Models\{RefProjectType, RefProjectState};
@endphp


@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Add New Project</div>
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

                <button class="tablink" onclick="openPage('ProjectList', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776">
                        </path>
                    </svg>
                    Added Projects
                </button>

            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <form id="add-project" method="POST" action="{{ route('bgms.project.store') }}" class="form_grid_cust">
                    @csrf


                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div>
                            <label class="required-label">Job No.</label>
                            <input type="text" name="job_no" value="{{ old('job_no') }}" required placeholder="Job no">
                            @error('job_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">UPC No.</label>
                            <input type="text" name="upc_no" value="{{ old('upc_no') }}" required placeholder="UPC no">
                            @error('upc_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project Name</label>
                            <input type="text" name="project_name" value="{{ old('project_name') }}" required
                                placeholder="Project name">
                            @error('project_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project Type</label>
                            <select name="ref_project_type_id" required>
                                <option value="">Select Project Type</option>
                                @foreach (RefProjectType::all() as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('ref_project_type_id') == $project->id ? 'selected' : '' }}>
                                        {{ $project->project_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ref_project_type_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Project State</label>
                            {{-- <select name="ref_project_state_id" required>
                                <option value="">Select State</option>
                                @foreach (RefProjectState::all() as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('ref_project_state_id', $bgmsAssignedState) == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select> --}}


                            <select required disabled>
                                <option value="">Select State</option>
                                @foreach (RefProjectState::all() as $state)
                                    <option value="{{ $state->id }}"
                                        {{ old('ref_project_state_id', $bgmsAssignedState) == $state->id ? 'selected' : '' }}>
                                        {{ $state->state_name }}
                                    </option>
                                @endforeach
                            </select>

                            <input type="hidden" name="ref_project_state_id"
                                value="{{ old('ref_project_state_id', $bgmsAssignedState) }}">

                            @error('ref_project_state_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Tender ID</label>
                            <input type="text" name="tender_id" value="{{ old('tender_id') }}" required placeholder="Tender ID">
                            @error('tender_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">SAP ID</label>
                            <input type="text" name="sap_id" value="{{ old('sap_id') }}" required placeholder="SAP ID">
                            @error('sap_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">
                            Save
                        </button>
                    </div>
                </form>



            </div>

            <div id="ProjectList" class="tabcontent" style="display: none;">

                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="project-table">
                        <thead class="">
                            <tr>
                                <th>S. No.</th>
                                <th>Project Id</th>
                                <th>SAP ID</th>
                                <th>Job No</th>
                                <th>UPC No</th>
                                <th>Project Name</th>
                                <th>Project Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.project.js') }}"></script>
@endpush
