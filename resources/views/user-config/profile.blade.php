@extends('layouts.dashboard')
@section('dashboard_content')

    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Complete User Profile</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('user-config.view') }}"><button type="button"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            @php
                $tabs = [
                    ['id' => 'Personal', 'label' => 'Personal Details', 'icon' => 'personal'],
                    ['id' => 'Education', 'label' => 'Education Details', 'icon' => 'education'],
                    ['id' => 'Work', 'label' => 'Work Experience Details', 'icon' => 'work'],
                    ['id' => 'Training', 'label' => 'Training & Certification Details', 'icon' => 'document-check'],
                    ['id' => 'Document', 'label' => 'Document Upload', 'icon' => 'document-check'],
                    ['id' => 'Employer', 'label' => 'Organization/Official Details', 'icon' => 'document-check'],
                    ['id' => 'Application', 'label' => 'Complete Application', 'icon' => 'document-check'],
                ];
            @endphp

            <div class="tab_custom_c mb-[20px]">
                @if ($profileData?->profile_status == 'submit')
                    <!-- Display only the last tab when the profile is submitted -->
                    <button class="tablink" onclick="openPage('{{ $tabs[6]['id'] }}', this, '#373737')" id="defaultOpen">
                        <x-tabicon name="{{ $tabs[6]['icon'] }}" />
                        {{ $tabs[6]['label'] }}
                    </button>
                @else
                    <!-- Display all tabs when the profile is not submitted -->
                    @foreach ($tabs as $index => $tab)
                        <button class="tablink" onclick="openPage('{{ $tab['id'] }}', this, '#373737')" id="{{ $index == 0 ? 'defaultOpen' : '' }}">
                            <x-tabicon name="{{ $tab['icon'] }}" />
                            {{ $tab['label'] }}
                        </button>
                    @endforeach
                @endif
            </div>

            @if (count($errors) > 0)
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            
            @if(empty($profileData?->profile_status))
            <div id="Personal" class="tabcontent">
                <form id="personalDetailsForm" action="{{ route('employee.personal.details') }}" method="POST" class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <x-form.select label="Title" name="title" :options="['Mr.' => 'Mr.', 'Mrs.' => 'Mrs.', 'Shri/Smt.' => 'Shri/Smt.', 'Ms.' => 'Ms.']" value="{{ old('category', $profileData->title ?? '') }}" required
                            selectClass="js-select2" />

                        <x-form.input label="Full Name" placeholder="Enter your full name" name="name" value="{{ old('name', $profileData->name ?? '') }}" required />

                        <x-form.input label="Personal Email" placeholder="Enter personal email address" name="email"
                            type="email" value="{{ old('email', $profileData->email ?? '') }}" required />

                        <x-form.input label="Mobile No" placeholder="Enter mobile number" name="mobile"
                            value="{{ old('mobile', $profileData->mobile_number ?? '') }}" minlength="10" maxlength="10" required oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                        <x-form.input label="Alternate Mobile No" placeholder="Enter alternate mobile number"
                            name="mobile_alternate" value="{{ old('mobile', $profileData->alternate_mobile_number ?? '') }}" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>

                        <x-form.input label="Date of Birth" name="date_of_birth" type="date"
                            value="{{ old('date_of_birth', $profileData->date_of_birth ?? '') }}" required />

                        <x-form.select label="Gender" name="gender" :options="['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other']" value="{{ old('gender', $profileData->gender ?? '') }}" required selectClass="js-select2" />

                        <x-form.select label="Blood Group" name="blood_group" :options="[
                            'A+' => 'A+',
                            'A-' => 'A-',
                            'B+' => 'B+',
                            'B-' => 'B-',
                            'AB+' => 'AB+',
                            'AB-' => 'AB-',
                            'O+' => 'O+',
                            'O-' => 'O-',
                        ]" value="{{ old('blood_group', $profileData->blood_group ?? '') }}" required
                            selectClass="js-select2" />

                        <x-form.select label="Marital Status" name="marital_status" :options="[
                            'Single' => 'Single',
                            'Married' => 'Married',
                            'Divorced' => 'Divorced',
                            'Widowed' => 'Widowed',
                        ]" 
                        value="{{ old('marital_status', $profileData->marital_status ?? '') }}"
                        required
                        selectClass="js-select2" />

                        <x-form.input label="Wedding Date" wrapperId="field_wedding_date" name="wedding_date" type="date"
                            value="{{ old('wedding_date', $profileData->wedding_date ?? '') }}"/>

                        <x-form.select label="Country of birth" name="country_of_birth" :options="['India' => 'India', 'Bhutan' => 'Bhutan', 'Nepal' => 'Nepal']" required
                            selectClass="js-select2" value="{{ old('country_of_birth', $profileData->country_of_birth ?? '') }}"/>

                        <x-form.input label="Place of birth (city/town)" placeholder="Place of birth (city/town)"
                            name="place_of_birth" value="{{ old('place_of_birth', $profileData->place_of_birth ?? '') }}" required />

                        <x-form.select label="Religion" name="religion" :options="[
                            'Hindu' => 'Hindu',
                            'Muslim' => 'Muslim',
                            'Christian' => 'Christian',
                            'Sikh' => 'Sikh',
                            'Jain' => 'Jain',
                            'Buddhist' => 'Buddhist',
                        ]" 
                        value="{{ old('religion', $profileData->religion ?? '') }}"
                        required
                            selectClass="js-select2" />

                        <x-form.select label="Nationality" name="nationality" :options="['India' => 'India', 'Bhutan' => 'Bhutan', 'Nepal' => 'Nepal']" required
                            selectClass="js-select2" value="{{ old('nationality', $profileData->nationality ?? '') }}" />
                        
                        <x-form.select label="Category" name="category" :options="$castes->pluck('caste', 'id')"
                                value="{{ old('category', $profileData->ref_caste_id ?? '') }}" required selectClass="js-select2" />

                        <x-form.select label="Ex-Serviceman" name="ex_serviceman" :options="['Yes' => 'Yes', 'No' => 'No']" required
                            selectClass="js-select2" value="{{ old('ex_serviceman', $profileData->ex_serviceman ?? '') }}"/>

                        <x-form.select label="Disability" name="disability" :options="['Yes' => 'Yes', 'No' => 'No']" required
                            selectClass="js-select2" value="{{ old('disability', $profileData->disability ?? '') }}"/>

                        <x-form.select label="Nature of Disability" wrapperId="field_nature_of_disability"
                            name="nature_of_disability" :options="[
                                'Physical' => 'Physical',
                                'Mental' => 'Mental',
                                'Visual' => 'Visual',
                                'Hearing' => 'Hearing',
                            ]" selectClass="js-select2" value="{{ old('nature_of_disability', $profileData->nature_of_disability ?? '') }}" />

                        <x-form.select label="Language Known" name="language" :options="['English' => 'English', 'Hindi' => 'Hindi']"
                            selectClass="js-select2" value="{{ old('language', $profileData->language ?? '') }}" />

                        <x-form.input label="Hobbies" placeholder="Hobbies" name="hobbies" value="{{ old('hobbies', $profileData->hobbies ?? '') }}"/>

                        <x-form.input label="Current Address"
                            smallLabel="Address in full i.e., Village, Thana and District or House number, Lane / Street / Road, and Town (Pin / Code)"
                            placeholder="Current Address" name="current_address" value="{{ old('current_address', $profileData->current_address ?? '') }}" />

                        <x-form.input label="Permanent Address"
                            smallLabel="Address in full i.e., Village, Thana and District or House number, Lane / Street / Road, and Town (Pin / Code)"
                            placeholder="Permanent Address" name="permanent_address" value="{{ old('permanent_address', $profileData->permanent_address ?? '') }}" />

                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Emergency Contact Details</div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <x-form.input label="Full Name" placeholder="Enter emergency contact full name" name="emergency_contact_name"
                            value="{{ old('emergency_contact_name', $profileData->emergency_contact_name ?? '') }}" required />

                        <x-form.input label="Relationship" placeholder="Relationship"
                            name="emergency_contact_relation" value="{{ old('emergency_contact_relation', $profileData->emergency_contact_relation ?? '') }}"
                            required />

                        <x-form.input label="Contact Number" placeholder="Phone Number" name="emergency_contact_mobile"
                            value="{{ old('emergency_contact_mobile', $profileData->emergency_contact_mobile ?? '') }}" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />

                        <x-form.input label="Alternate Contact Number" placeholder="Alternate Contact Number"
                            name="emergency_contact_mobile_alternate" value="{{ old('emergency_contact_mobile_alternate', $profileData->emergency_contact_alternate_mobile ?? '') }}" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')"/>

                        <x-form.input label="Address" placeholder="Address" name="emergency_contact_address"
                            value="{{ old('emergency_contact_address', $profileData->emergency_contact_address ?? '') }}" required />
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5"
                        style="justify-content: start;">
                        <div>Next of Kin (NOK)</div>
                        <div class="flex items-center">
                            <div class="flex items-center h-5 inpus_cust_cs" style="margin-left: 10px;">
                                <input type="checkbox" class="w-4 h-4" id="same_as_emergency_contact">
                            </div>
                            &nbsp;&nbsp;<span class="text-yellow-message">Same as Emergency Contact</span>
                        </div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <x-form.input label="Full Name" placeholder="Enter full name" name="nok_contact_name"
                            value="{{ old('nok_contact_name', $profileData->nok_contact_name ?? '') }}" required />

                        <x-form.input label="Relationship" placeholder="Relationship" name="nok_contact_relation"
                            value="{{ old('nok_contact_relation', $profileData->nok_contact_relation ?? '') }}" required />

                        <x-form.input label="Contact Number" placeholder="Phone Number" name="nok_contact_mobile"
                            value="{{ old('nok_contact_mobile', $profileData->nok_contact_mobile ?? '') }}" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required />

                        <x-form.input label="Alternate Contact Number" placeholder="Alternate Contact Number"
                            name="nok_contact_mobile_alternate" value="{{ old('nok_contact_mobile_alternate', $profileData->nok_contact_alternate_mobile ?? '') }}" minlength="10" maxlength="10" oninput="this.value = this.value.replace(/[^0-9]/g, '')" />

                        <x-form.input label="Address" placeholder="Address" name="nok_contact_address"
                            value="{{ old('emergency_contact_name', $profileData->nok_contact_address ?? '') }}" required />
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Family details</div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <x-form.input label="Father Name" placeholder="Enter full name" name="father_name"
                            value="{{ old('father_name', $profileData->father_name ?? '') }}" required />

                        <x-form.select label="Is your father dependent on you?" name="father_dependent" :options="['Yes' => 'Yes', 'No' => 'No']"
                            value="{{ old('father_dependent', $profileData->father_dependent ?? '') }}" required selectClass="js-select2" />

                        <x-form.input label="Mother Name" placeholder="Enter full name" name="mother_name"
                            value="{{ old('mother_name', $profileData->mother_name ?? '') }}" required />

                        <x-form.select label="Is your mother dependent on you?" name="mother_dependent" :options="['Yes' => 'Yes', 'No' => 'No']"
                            value="{{ old('mother_dependent', $profileData->mother_dependent ?? '') }}" required selectClass="js-select2" />

                        <x-form.input label="Spouse Name" wrapperId="field_spouse_name" placeholder="Enter full name"
                            name="spouse_name" value="{{ old('spouse_name', $profileData->spouse_name ?? '') }}" />

                        <x-form.select label="Is your spouse dependent on you?" wrapperId="field_spouse_dependent"
                            name="spouse_dependent" :options="['Yes' => 'Yes', 'No' => 'No']" value="{{ old('spouse_dependent', $profileData->spouse_dependent ?? '') }}"
                            selectClass="js-select2" />

                        <x-form.input label="Child/Children Name" wrapperId="field_children_name"
                            placeholder="Enter child full name" name="child_name" value="{{ old('child_name', $profileData->child_name ?? '') }}" />

                        <x-form.select label="Are your child/children dependent on you?"
                            wrapperId="field_children_dependent" name="child_dependent" :options="['Yes' => 'Yes', 'No' => 'No']"
                            value="{{ old('child_dependent', $profileData->child_dependent ?? '') }}" selectClass="js-select2" />
                    </div>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">Save & Next</button>
                    </div>
                </form>

            </div>

            <div id="Education" class="tabcontent">
                <p>The details of educational qualifications should be provided from 10th standard onwards. </p>
                <form id="educationalDetailsForm" action="{{ route('employee.education.details') }}" method="POST" class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                    <div id="educationalDetailsFormPrep">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_" id="eduDevAdd_0">
                            <x-form.select label="Examination" smallLabel="10th, 12th, Graduation and Post-Graduation" name="ref_qualification_id" :options="$qualifications->pluck('qualification_name', 'id')"
                                value="{{ old('ref_qualification_id', $profileData->ref_caste_id ?? '') }}" required selectClass="js-select2" />

                            <x-form.input label="Name of Institute/College" name="institute_name"
                                placeholder="Name of Institute/College" value="{{ old('institute_name') }}" required />

                            <x-form.select label="University/Board" name="ref_board_university_college_id" :options="$board_university_collages->pluck('name', 'id')"
                                value="{{ old('ref_board_university_college_id') }}" required selectClass="js-select2" />

                            <x-form.select label="Passing Year" name="passing_year" :options="$passing_years->pluck('passing_year', 'id')"
                                value="{{ old('passing_year') }}" required selectClass="js-single" />

                            <x-form.input label="Percentage of Marks / CGPA Obtained" name="percentage_cgpa"
                                placeholder="Percentage of Marks / CGPA Obtained" value="{{ old('percentage_cgpa') }}" step="0.01" min="0" max="100" oninput="this.value = this.value.replace(/[^0-9.]/g, '')"
                                required />

                            <div class="attachment_advertisement attachment_section_photos">
                                <label class="required-label">Marksheet / Degree (<small>Max size 2MB & file should be pdf only</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_degree_txt" name="upload_degree_txt" class="upload_degree_txt" placeholder="Upload education marksheet/degree files" data-validate="required" data-error="Please upload education marksheet/degree files." readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                        Upload File
                                        <input type="file"
                                            name="upload_degree_files"
                                            class="hidden file-uploader"
                                            accept=".pdf"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="upload_degree_txt"
                                            data-preview-wrapper="degree_preview"
                                            data-hidden-input="upload_degree_hidden"
                                            data-upload-url="/users/upload/files/"
                                            data-view-url="/users/view/files/"
                                            data-file-path="/uploads/employee/degree/">
                                    </label>
                                    <input type="hidden" name="upload_degree_hidden" id="upload_degree_hidden">
                                </div>
                                <div id="degree_preview"></div>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn border_btn" type="button"
                            data-validate-form="#educationalDetailsForm">Save & Add</button>
                        <button id="educationalDetailsBtn" class="tablink hover-effect-btn fill_btn" type="submit"> Next
                        </button>
                    </div>
                </form>
                @if(sizeof($education)>0)
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Examination</th>
                                <th>Name of Institute/College</th>
                                <th>University/Board</th>
                                <th>Passing Year</th>
                                <th>Percentage/CGPA</th>
                                <th>Marksheet/Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($education as $eduData)
                            <tr>
                                <th>{{ $loop->index+1 }}</th>
                                <td>{{ $eduData->qualification->qualification_name ?? '' }}</td>
                                <td>{{ $eduData->college_name }}</td>
                                <td>{{ $eduData->university->name ?? ''}}</td>
                                <td>{{ $eduData->passingyear->passing_year ?? '' }}</td>
                                <td>{{ $eduData->marks_percentage }}</td>
                                <td>
                                    @if(!empty($eduData->marksheet_certificate) && !empty($eduData->marksheet_certificate_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $eduData->marksheet_certificate_filepath, 'fileName' => $eduData->marksheet_certificate]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div id="Work" class="tabcontent">
                <div class="experience-data" id="experience-data">
                    <form id="workExperienceDetailsForm" action="{{ route('employee.work.experience.details') }}" method="POST" class="form_grid_cust" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                        <div class="workExperienceDetailsRow">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev">
                                <x-form.input label="Employer Name / Department / Organisation Name" name="employer_name"
                                    placeholder="Employer Name" value="{{ old('employer_name') }}" required />

                                <x-form.input label="Post Held" name="post_held" placeholder="Post Held"
                                    value="{{ old('post_held') }}" maxlength="500" required />

                                <x-form.input label="From Date" name="from_date" type="date"
                                    value="{{ old('from_date') }}" required />

                                <x-form.input label="To Date" name="to_date" type="date"
                                    value="{{ old('to_date') }}" required />

                                <x-form.textarea label="Brief Job Description" name="job_description"
                                    placeholder="Brief Job Description (Max. 500 characters)" maxlength="500"
                                    rows="3" value="{{ old('job_description') }}" required />

                                <div class="attachment_advertisement attachment_section_photos">
                                    <label class="required-label">Experience Certificate (<small>Max size 2MB & file should be pdf only</small>)</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" id="experience_certificate_txt" name="experience_certificate_txt" class="experience_certificate_txt" placeholder="Upload experience certificate files" data-validate="required" data-error="Please upload experience certificate files." readonly>
                                        <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                            Upload File
                                            <input type="file"
                                                name="experience_certificate"
                                                class="hidden file-uploader"
                                                accept=".pdf"
                                                data-type="pdf"
                                                data-max-size="2000000"
                                                data-input-id="experience_certificate_txt"
                                                data-preview-wrapper="experience_certificate_preview"
                                                data-hidden-input="upload_experience_certificate_hidden"
                                                data-upload-url="/users/upload/files/"
                                                data-view-url="/users/view/files/"
                                                data-file-path="/uploads/employee/experience_certificate/">
                                        </label>
                                        <input type="hidden" name="upload_experience_certificate_hidden" id="upload_experience_certificate_hidden">
                                    </div>
                                    <div id="experience_certificate_preview"></div>
                                </div>

                            </div>
                        </div>
                        <div class="button_flex_cust_form">
                            <button type="button" class="hover-effect-btn border_btn"
                                data-validate-form="#workExperienceDetailsForm">Save &
                                Add</button>
                            <button type="submit" id="workExperienceSkipBtn" class="tablink hover-effect-btn fill_btn">
                                Next </button>
                        </div>
                    </form>
                    @if(sizeof($workdata)>0)
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <th>Experience Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workdata as $experienceData)
                                    @php
                                        $from = \Carbon\Carbon::parse($experienceData->from_date);
                                        $to = $experienceData->to_date
                                            ? \Carbon\Carbon::parse($experienceData->to_date)
                                            : now();

                                        $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                        $experience = [];
                                        if ($diff->y > 0) {
                                            $experience[] = $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                        }
                                        if ($diff->m > 0) {
                                            $experience[] = $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                        }
                                        //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                        $experienceText = count($experience)
                                            ? implode(' ', $experience)
                                            : 'less than 1 Month';
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $experienceData->employer_name }}</td>
                                        <td>{{ $experienceData->post_held }}</td>
                                        <td>{{ $from->format('d M Y') }} -
                                            {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}</td>
                                        <td>{{ $experienceText }}</td>
                                        <td>{{ $experienceData->job_summary }}</td>
                                        <td>
                                            @if(!empty($experienceData->experience_letter) && !empty($experienceData->experience_letter_filepath))
                                            <a target="_blank" href="{{ route('users.view.files', ['pathName' => $experienceData->experience_letter_filepath, 'fileName' => $experienceData->experience_letter]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="7">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @endif
                </div>
            </div>

            <div id="Training" class="tabcontent">
                <form id="trainingDetailsForm" action="{{ route('employee.training.details') }}" method="POST" class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                    <div class="trainingDetailsRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <x-form.input label="Name of Training/Certifications" name="name_of_training"
                                placeholder="Name of training/certifications" value="{{ old('name_of_training') }}"
                                required />

                            <x-form.input label="Start Date" name="training_start_date" type="date"
                                value="{{ old('training_start_date') }}" required />

                            <x-form.input label="End Date" name="training_end_date" type="date"
                                value="{{ old('training_end_date') }}" required />

                            <x-form.textarea label="Descriptions" name="description" placeholder="Description"
                                rows="2" value="{{ old('description') }}" required />

                            @php
                                $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
                            @endphp

                            <x-form.input label="Certificate Expiry Date" name="certificate_expiry_date" type="date"
                                min="{{ $tomorrow }}" value="{{ old('certificate_expiry_date') }}" />
                            
                            <div class="attachment_advertisement attachment_section_photos">
                                <label class="required-label">Training Certificate (<small>Max size 2MB & file should be pdf only</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="training_certificate_txt" name="training_certificate_txt" class="training_certificate_txt" placeholder="Upload training certificate files" data-validate="required" data-error="Please upload training certificate files." readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                        Upload File
                                        <input type="file"
                                            name="training_certificate"
                                            class="hidden file-uploader"
                                            accept=".pdf"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="training_certificate_txt"
                                            data-preview-wrapper="training_certificate_preview"
                                            data-hidden-input="upload_training_certificate_hidden"
                                            data-upload-url="/users/upload/files/"
                                            data-view-url="/users/view/files/"
                                            data-file-path="/uploads/employee/training_certificate/">
                                    </label>
                                    <input type="hidden" name="upload_training_certificate_hidden" id="upload_training_certificate_hidden">
                                </div>
                                <div id="training_certificate_preview"></div>
                            </div>

                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">Save & Add</button>
                        <button type="button" data-validate-form="#trainingDetailsForm"
                            class="hover-effect-btn border_btn">Next</button>
                    </div>
                </form>
                @if(sizeof($training)>0)
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name of Training/Certifications</th>
                                <th>Description</th>
                                <th>Training Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($training as $trainingResult)
                            <tr>
                                <th>{{ $loop->index+1 }}</th>
                                <td>{{ $trainingResult->training_name }}</td>
                                <td>{{ $trainingResult->summary }}</td>
                                <td>
                                    @if(!empty($trainingResult->certificate) && !empty($trainingResult->certificate_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $trainingResult->certificate_filepath, 'fileName' => $trainingResult->certificate]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>

            <div id="Document" class="tabcontent">
                <form id="documentUploadForm" class="form_grid_cust" action="{{ route('employee.document.upload') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Passport Photo (<small>Max size 2MB & file should be jpg, png only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_profile_txt" name="upload_profile_txt" 
                                value="{{ !empty($profileData->upload_photo_filepath) && !empty($profileData->upload_photo) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_photo_filepath, 'fileName' => $profileData->upload_photo]) 
                                : '' }}"
                                class="upload_profile_txt" placeholder="Upload profile picture" data-validate="required" data-error="Please upload profile picture." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_photo ?? '') && !empty($profileData->upload_photo_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_profile"
                                        id="upload_profile"
                                        class="hidden file-uploader"
                                        accept=".jpg, .jpeg, .png"
                                        data-type="image"
                                        data-max-size="2000000"
                                        data-input-id="upload_profile_txt"
                                        data-preview-wrapper="profile_preview"
                                        data-hidden-input="upload_profile_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/profile/">
                                </label>
                                <input type="hidden" name="upload_profile_hidden" id="upload_profile_hidden">
                            </div>
                            <div id="profile_preview">
                                @if(!empty($profileData->upload_photo) && !empty($profileData->upload_photo_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_photo_filepath, 'fileName' => $profileData->upload_photo]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_profile_txt" data-wrapper-id="profile_preview" data-hidden-input="upload_profile_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Signature (<small>Max size 2MB & file should be jpg, png only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_signature_txt" name="upload_signature_txt" 
                                value="{{ !empty($profileData->upload_signature_filepath) && !empty($profileData->upload_signature) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_signature_filepath, 'fileName' => $profileData->upload_signature]) 
                                : '' }}" 
                                class="upload_signature_txt" placeholder="Upload signature" data-validate="required" data-error="Please upload signature picture." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_signature ?? '') && !empty($profileData->upload_signature_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_signature"
                                        id="upload_signature"
                                        class="hidden file-uploader"
                                        accept=".jpg, .jpeg, .png"
                                        data-type="image"
                                        data-max-size="2000000"
                                        data-input-id="upload_signature_txt"
                                        data-preview-wrapper="signature_preview"
                                        data-hidden-input="upload_signature_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/signature/">
                                </label>
                                <input type="hidden" name="upload_signature_hidden" id="upload_signature_hidden">
                            </div>
                            <div id="signature_preview">
                                @if(!empty($profileData->upload_signature) && !empty($profileData->upload_signature_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_signature_filepath, 'fileName' => $profileData->upload_signature]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_signature_txt" data-wrapper-id="signature_preview" data-hidden-input="upload_signature_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload DOB Proof (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_dob_proof_txt" name="upload_dob_proof_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_dob_proof_txt" placeholder="Upload date of birth proof document" data-validate="required" data-error="Please upload date of birth proof." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_dob_proof"
                                        id="upload_dob_proof"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_dob_proof_txt"
                                        data-preview-wrapper="dob_proof_preview"
                                        data-hidden-input="upload_dob_proof_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/dob_proof/">
                                </label>
                                <input type="hidden" name="upload_dob_proof_hidden" id="upload_dob_proof_hidden">
                            </div>
                            <div id="dob_proof_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_dob_proof_txt" data-wrapper-id="dob_proof_preview" data-hidden-input="upload_dob_proof_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload CV / Resume (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_resume_txt" name="upload_resume_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_resume_txt" placeholder="Upload resume/cv files" data-validate="required" data-error="Please upload resume/cv files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_resume"
                                        id="upload_resume"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_resume_txt"
                                        data-preview-wrapper="resume_preview"
                                        data-hidden-input="upload_resume_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/resume/">
                                </label>
                                <input type="hidden" name="upload_resume_hidden" id="upload_resume_hidden">
                            </div>
                            <div id="resume_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_resume_txt" data-wrapper-id="resume_preview" data-hidden-input="upload_resume_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload PAN Card (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_pancard_txt" name="upload_pancard_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_pancard_txt" placeholder="Upload resume/cv files" data-validate="required" data-error="Please upload resume/cv files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_pancard"
                                        id="upload_pancard"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_pancard_txt"
                                        data-preview-wrapper="pancard_preview"
                                        data-hidden-input="upload_pancard_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/pancard/">
                                </label>
                                <input type="hidden" name="upload_pancard_hidden" id="upload_pancard_hidden">
                            </div>
                            <div id="pancard_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_pancard_txt" data-wrapper-id="pancard_preview" data-hidden-input="upload_pancard_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Aadhar Card (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_aadhar_txt" name="upload_aadhar_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_aadhar_txt" placeholder="Upload aadhar card files" data-validate="required" data-error="Please upload aadhar card files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_aadhar"
                                        id="upload_aadhar"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_aadhar_txt"
                                        data-preview-wrapper="aadhar_preview"
                                        data-hidden-input="upload_aadhar_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/aadhar/">
                                </label>
                                <input type="hidden" name="upload_aadhar_hidden" id="upload_aadhar_hidden">
                            </div>
                            <div id="aadhar_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_aadhar_txt" data-wrapper-id="aadhar_preview" data-hidden-input="upload_aadhar_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Address Proof (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_address_txt" name="upload_address_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_address_txt" placeholder="Upload address proof files" data-validate="required" data-error="Please upload address proof files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_address"
                                        id="upload_address"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_address_txt"
                                        data-preview-wrapper="address_preview"
                                        data-hidden-input="upload_address_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/aadhar/">
                                </label>
                                <input type="hidden" name="upload_address_hidden" id="upload_address_hidden">
                            </div>
                            <div id="address_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_address_txt" data-wrapper-id="address_preview" data-hidden-input="upload_address_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label>Upload Caste Certificate (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_caste_certificate_txt" name="upload_caste_certificate_txt" 
                                value="{{ !empty($profileData->upload_resume_filepath) && !empty($profileData->upload_resume) 
                                ? route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) 
                                : '' }}"
                                class="upload_caste_certificate_txt" placeholder="Upload caste certificate proof files" data-validate="required" data-error="Please upload caste certificate proof files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($profileData->upload_resume ?? '') && !empty($profileData->upload_resume_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_caste_certificate"
                                        id="upload_caste_certificate"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_caste_certificate_txt"
                                        data-preview-wrapper="caste_certificate_preview"
                                        data-hidden-input="upload_caste_certificate_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/caste_certificate/">
                                </label>
                                <input type="hidden" name="upload_caste_certificate_hidden" id="upload_caste_certificate_hidden">
                            </div>
                            <div id="caste_certificate_preview">
                                @if(!empty($profileData->upload_resume) && !empty($profileData->upload_resume_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $profileData->upload_resume_filepath, 'fileName' => $profileData->upload_resume]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                   data-input-id="upload_caste_certificate_txt" data-wrapper-id="caste_certificate_preview" data-hidden-input="upload_caste_certificate_hidden">
                                   Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="button_flex_cust_form">
                            <button type="submit" class="hover-effect-btn fill_btn">{{ __('Save & Next') }}</button>
                        </div>
                    </div>
                </form>
            </div>

            <div id="Employer" class="tabcontent">
                <form id="employerDetailsForm" class="form_grid_cust" action="{{ route('employee.organisation.details.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="userid" value="{{ $users->id ?? '0' }}">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <x-form.select label="User Type" name="user_type" :options="['1' => 'Internal', '2' => 'Applicant']" value="{{ $orgData->user_type ?? '' }}" required
                            selectClass="js-select2" />
                        <x-form.input label="Official Email" name="official_email" placeholder="Official Email"
                            type="email" value="{{ $orgData->official_email ?? '' }}" required />

                        <x-form.select label="Employment Type" name="ref_employee_type_id" :options="$employee_type->pluck('name', 'id')" value="{{ $orgData->ref_employee_type_id ?? '' }}" required
                            selectClass="js-select2" />

                        <x-form.input label="Date of Joining" name="date_of_joining" type="date"
                            value="{{ $orgData->date_of_joining ?? '' }}" required />

                        <x-form.select label="Designation" name="ref_designation_id" :options="$designation->pluck('name', 'id')" value="{{ $orgData->ref_designation_id ?? '' }}" required
                            selectClass="js-select2" />

                        <x-form.select label="Division" name="ref_department_id" :options="$department->pluck('name', 'id')" value="{{ $orgData->ref_department_id ?? '' }}" required
                            selectClass="js-select2" />

                        <x-form.input label="Employee ID" name="user_code" type="text"
                            placeholder="NHIDCL Employee ID" value="{{ $orgData->employee_id ?? '' }}" required />

                        <x-form.select label="Present Level" name="level_id" :options="[
                            'Grade I' => 'Grade I',
                            'Grade II' => 'Grade II',
                            'Grade III' => 'Grade III',
                            'Grade IV' => 'Grade IV',
                        ]" required value="{{ $orgData->present_level ?? '' }}"
                            selectClass="js-select2" />

                        <x-form.select label="Probation Period for Permanent Employment" smallLabel="in months"
                            name="probation_period" :options="array_combine(range(0, 24), range(0, 24))" value="{{ $orgData->probation_period ?? '' }}" required selectClass="js-select2" />

                        <x-form.input label="Confirmation Date" name="confirmation_date" type="date"
                            value="{{ $users->confirmation_date ?? '' }}" value="{{ $orgData->confirmation_date ?? '' }}" required />

                        <x-form.select label="Reporting Officer" name="reporting_officer_id" :options="$managers->pluck('name', 'id')" value="{{ $orgData->ref_users_id_reporting_officer ?? '' }}"
                            required selectClass="js-select2" />

                        <x-form.select label="Posting Location" name="ref_posting_location_id" :options="$states->pluck('name', 'id')" value="{{ $orgData->posting_location ?? '' }}"
                            required selectClass="js-select2" />
                        
                        
                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Salary Slip (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_salary_slip_txt" name="upload_salary_slip_txt" value="{{ !empty($orgData->salary_slip_filepath) && !empty($orgData->salary_slip) 
                                    ? route('users.view.files', ['pathName' => $orgData->salary_slip_filepath, 'fileName' => $orgData->salary_slip]) 
                                    : '' }}"class="upload_salary_slip_txt" placeholder="Upload salary slip files" data-validate="required" data-error="Please upload salary slip files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->salary_slip ?? '') && !empty($orgData->salary_slip_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_salary_slip"
                                        id="upload_salary_slip"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_salary_slip_txt"
                                        data-preview-wrapper="upload_salary_slip_preview"
                                        data-hidden-input="upload_salary_slip_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/salary_slip/">
                                </label>
                                <input type="hidden" name="upload_salary_slip_hidden" id="upload_salary_slip_hidden">
                            </div>
                            <div id="upload_salary_slip_preview">
                                @if(!empty($orgData->salary_slip) && !empty($orgData->salary_slip_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->salary_slip_filepath, 'fileName' => $orgData->salary_slip]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                        data-input-id="upload_salary_slip_txt" data-wrapper-id="upload_salary_slip_preview" data-hidden-input="upload_salary_slip_hidden">
                                        Remove
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Signed Offer Letter (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_offer_letter_txt" name="upload_offer_letter_txt" class="upload_offer_letter_txt"
                                value="{{ !empty($orgData->offer_letter_filepath) && !empty($orgData->offer_letter) 
                                ? route('users.view.files', ['pathName' => $orgData->offer_letter_filepath, 'fileName' => $orgData->offer_letter]) 
                                : '' }}" placeholder="Upload Signed Offer Letter files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->offer_letter ?? '') && !empty($orgData->offer_letter_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_offer_letter"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_offer_letter_txt"
                                        data-preview-wrapper="upload_offer_letter_preview"
                                        data-hidden-input="upload_offer_letter_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/offer_letter/">
                                </label>
                                <input type="hidden" name="upload_offer_letter_hidden" id="upload_offer_letter_hidden">
                            </div>
                            <div id="upload_offer_letter_preview">
                                @if(!empty($orgData->offer_letter) && !empty($orgData->offer_letter_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->offer_letter_filepath, 'fileName' => $orgData->offer_letter]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_offer_letter_txt" data-wrapper-id="upload_offer_letter_preview" data-hidden-input="upload_offer_letter_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload NDA/Confidentiality Agreement (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_nda_agreement_txt" name="upload_nda_agreement_txt" class="upload_nda_agreement_txt" 
                                value="{{ !empty($orgData->nda_agreement_filepath) && !empty($orgData->nda_agreement) 
                                ? route('users.view.files', ['pathName' => $orgData->nda_agreement_filepath, 'fileName' => $orgData->nda_agreement]) 
                                : '' }}" placeholder="Upload NDA/Confidentiality Agreement files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->nda_agreement ?? '') && !empty($orgData->nda_agreement_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_nda_agreement"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_nda_agreement_txt"
                                        data-preview-wrapper="upload_nda_agreement_preview"
                                        data-hidden-input="upload_nda_agreement_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/nda_agreement/">
                                </label>
                                <input type="hidden" name="upload_nda_agreement_hidden" id="upload_nda_agreement_hidden">
                            </div>
                            <div id="upload_nda_agreement_preview">
                                @if(!empty($orgData->nda_agreement) && !empty($orgData->nda_agreement_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->nda_agreement_filepath, 'fileName' => $orgData->nda_agreement]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_nda_agreement_txt" data-wrapper-id="upload_nda_agreement_preview" data-hidden-input="upload_nda_agreement_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Background Verification Report (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_background_verification_txt" name="upload_background_verification_txt" class="upload_background_verification_txt"
                                value="{{ !empty($orgData->bg_verfication_report_filepath) && !empty($orgData->bg_verfication_report) 
                                ? route('users.view.files', ['pathName' => $orgData->bg_verfication_report_filepath, 'fileName' => $orgData->bg_verfication_report]) 
                                : '' }}" placeholder="Upload Background Verification Report files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->bg_verfication_report ?? '') && !empty($orgData->bg_verfication_report_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_background_verification"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_background_verification_txt"
                                        data-preview-wrapper="upload_background_verification_preview"
                                        data-hidden-input="upload_background_verification_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/background_verification/">
                                </label>
                                <input type="hidden" name="upload_background_verification_hidden" id="upload_background_verification_hidden">
                            </div>
                            <div id="upload_background_verification_preview">
                                @if(!empty($orgData->bg_verfication_report) && !empty($orgData->bg_verfication_report_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->bg_verfication_report_filepath, 'fileName' => $orgData->bg_verfication_report]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_background_verification_txt" data-wrapper-id="upload_background_verification_preview" data-hidden-input="upload_background_verification_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Disciplinary Status Report (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_disciplinary_status_txt" name="upload_disciplinary_status_txt" class="upload_disciplinary_status_txt"
                                value="{{ !empty($orgData->disciplinary_report_filepath) && !empty($orgData->disciplinary_report) 
                                ? route('users.view.files', ['pathName' => $orgData->disciplinary_report_filepath, 'fileName' => $orgData->disciplinary_report]) 
                                : '' }}" placeholder="Upload Disciplinary Status Report files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->disciplinary_report ?? '') && !empty($orgData->disciplinary_report_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_disciplinary_status"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_disciplinary_status_txt"
                                        data-preview-wrapper="upload_disciplinary_status_preview"
                                        data-hidden-input="upload_disciplinary_status_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/disciplinary_status/">
                                </label>
                                <input type="hidden" name="upload_disciplinary_status_hidden" id="upload_disciplinary_status_hidden">
                            </div>
                            <div id="upload_disciplinary_status_preview">
                                @if(!empty($orgData->disciplinary_report) && !empty($orgData->disciplinary_report_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->disciplinary_report_filepath, 'fileName' => $orgData->disciplinary_report]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_disciplinary_status_txt" data-wrapper-id="upload_disciplinary_status_preview" data-hidden-input="upload_disciplinary_status_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Vigilance Clearance Report (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_vigilance_clearance_txt" name="upload_vigilance_clearance_txt" class="upload_vigilance_clearance_txt"
                                value="{{ !empty($orgData->vigilance_report_filepath) && !empty($orgData->vigilance_report) 
                                ? route('users.view.files', ['pathName' => $orgData->vigilance_report_filepath, 'fileName' => $orgData->vigilance_report]) 
                                : '' }}" placeholder="Upload Vigilance Clearance Report files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->vigilance_report ?? '') && !empty($orgData->vigilance_report_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_vigilance_clearance"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_vigilance_clearance_txt"
                                        data-preview-wrapper="upload_vigilance_clearance_preview"
                                        data-hidden-input="upload_vigilance_clearance_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/vigilance_clearance/">
                                </label>
                                <input type="hidden" name="upload_vigilance_clearance_hidden" id="upload_vigilance_clearance_hidden">
                            </div>
                            <div id="upload_vigilance_clearance_preview">
                                @if(!empty($orgData->vigilance_report) && !empty($orgData->vigilance_report_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->vigilance_report_filepath, 'fileName' => $orgData->vigilance_report]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_vigilance_clearance_txt" data-wrapper-id="upload_vigilance_clearance_preview" data-hidden-input="upload_vigilance_clearance_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>
                        
                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Medical Fitness Report (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_medical_fitness_txt" name="upload_medical_fitness_txt" class="upload_medical_fitness_txt" 
                                value="{{ !empty($orgData->medical_report_filepath) && !empty($orgData->medical_report) 
                                ? route('users.view.files', ['pathName' => $orgData->medical_report_filepath, 'fileName' => $orgData->medical_report]) 
                                : '' }}" placeholder="Upload medical fitness report files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->medical_report ?? '') && !empty($orgData->medical_report_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_medical_fitness"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_medical_fitness_txt"
                                        data-preview-wrapper="upload_medical_fitness_preview"
                                        data-hidden-input="upload_medical_fitness_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/medical_fitness/">
                                </label>
                                <input type="hidden" name="upload_vigilance_clearance_hidden" id="upload_vigilance_clearance_hidden">
                            </div>
                            <div id="upload_medical_fitness_preview">
                                @if(!empty($orgData->medical_report) && !empty($orgData->medical_report_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->medical_report_filepath, 'fileName' => $orgData->medical_report]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_medical_fitness_txt" data-wrapper-id="upload_medical_fitness_preview" data-hidden-input="upload_medical_fitness_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label>Upload Upload Marriage Certificate (<small>Upload Marriage Certificate (Optional - PDF/JPG/JPEG/PNG, Max size 2MB)</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_marriage_certificate_txt" name="upload_marriage_certificate_txt" class="upload_marriage_certificate_txt" 
                                value="{{ !empty($orgData->marriage_certificate_filepath) && !empty($orgData->marriage_certificate) 
                                ? route('users.view.files', ['pathName' => $orgData->marriage_certificate_filepath, 'fileName' => $orgData->marriage_certificate]) 
                                : '' }}" placeholder="Upload marriage certificate files" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer" @if(!empty($orgData->marriage_certificate ?? '') && !empty($orgData->marriage_certificate_filepath ?? '')) style="display:none" @endif>
                                    Upload File
                                    <input type="file"
                                        name="upload_marriage_certificate"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_marriage_certificate_txt"
                                        data-preview-wrapper="marriage_certificate_preview"
                                        data-hidden-input="upload_marriage_certificate_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/marriage_certificate/">
                                </label>
                                <input type="hidden" name="upload_marriage_certificate_hidden" id="upload_marriage_certificate_hidden">
                            </div>
                            <div id="marriage_certificate_preview">
                                @if(!empty($orgData->marriage_certificate) && !empty($orgData->marriage_certificate_filepath))
                                <a target="_blank" href="{{ route('users.view.files', ['pathName' => $orgData->marriage_certificate_filepath, 'fileName' => $orgData->marriage_certificate]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                <a href="javascript:void(0);" class="reupload-btn bg-red-700 hover:bg-red-800 rounded-lg text-sm px-5 py-2.5"
                                    data-input-id="upload_marriage_certificate_txt" data-wrapper-id="marriage_certificate_preview" data-hidden-input="upload_marriage_certificate_hidden">
                                    Remove
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn">{{ __('Submit') }}</button>
                    </div>
                </form>
            </div>
            @endif
            <div id="Application" class="tabcontent">
                <h4 class="applicat_cust-title">User Information</h4>
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value">{{ optional($profileData)->name ?? optional($users)->name ?? 'N/A' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Gender</div>
                        <div class="applicat_cust-value">{{ $profileData->gender ?? 'N/A' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                        <div class="applicat_cust-value">{{ $profileData->father_name ?? 'N/A' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value">{{ optional($profileData)->date_of_birth ?? optional($users)->date_of_birth ?? 'N/A' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Contact Number</div>
                        <div class="applicat_cust-value">{{ optional($profileData)->mobile_number ?? optional($users)->mobile ?? 'N/A' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value">{{ optional($profileData)->email ?? optional($users)->email ?? 'N/A' }}</div>
                    </div>
                </div>
                <h4 class="applicat_cust-title mt-3">Education Qualification</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Examination</th>
                                <th>Name of Institute/College</th>
                                <th>University/Board</th>
                                <th>Passing Year</th>
                                <th>Percentage/CGPA</th>
                                <th>Marksheet/Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($education as $eduData)
                            <tr>
                                <th>{{ $loop->index+1 }}</th>
                                <td>{{ $eduData->qualification->qualification_name ?? '' }}</td>
                                <td>{{ $eduData->college_name }}</td>
                                <td>{{ $eduData->university->name ?? ''}}</td>
                                <td>{{ $eduData->passingyear->passing_year ?? '' }}</td>
                                <td>{{ $eduData->marks_percentage }}</td>
                                <td>
                                    @if(!empty($eduData->marksheet_certificate) && !empty($eduData->marksheet_certificate_filepath))
                                    <a target="_blank" href="{{ route('users.view.files', ['pathName' => $eduData->marksheet_certificate_filepath, 'fileName' => $eduData->marksheet_certificate]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <th>Experience Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($workdata as $experienceData)
                                    @php
                                        $from = \Carbon\Carbon::parse($experienceData->from_date);
                                        $to = $experienceData->to_date
                                            ? \Carbon\Carbon::parse($experienceData->to_date)
                                            : now();

                                        $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                        $experience = [];
                                        if ($diff->y > 0) {
                                            $experience[] = $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                        }
                                        if ($diff->m > 0) {
                                            $experience[] = $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                        }
                                        //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                        $experienceText = count($experience)
                                            ? implode(' ', $experience)
                                            : 'less than 1 Month';
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $experienceData->employer_name }}</td>
                                        <td>{{ $experienceData->post_held }}</td>
                                        <td>{{ $from->format('d M Y') }} -
                                            {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}</td>
                                        <td>{{ $experienceText }}</td>
                                        <td>{{ $experienceData->job_summary }}</td>
                                        <td>
                                            @if(!empty($experienceData->experience_letter) && !empty($experienceData->experience_letter_filepath))
                                            <a target="_blank" href="{{ route('users.view.files', ['pathName' => $experienceData->experience_letter_filepath, 'fileName' => $experienceData->experience_letter]) }}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View</a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="7">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Employer Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employee Id</th>
                                <th>Place of Posting</th>
                                <th>Present Level</th>
                                <th>Department</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{$orgData->employee_id ?? ''}}</td>
                                <td>{{$orgData->posting_location ?? ''}}</td>
                                <td>{{ucwords($orgData->present_level ?? '')}}</td>
                                <td>{{ $orgData?->department?->name ?? '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                
                @if(empty($profileData?->profile_status) && !empty($profileData) && $profileData?->ref_users_id !=Auth::user()->id)
                <form id="draftDataForm" action="{{ route('employee.organisation.profile.submit') }}" method="post">
                    @csrf
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <input type="hidden" name="action" value="profileSubmit">
                    <input type="hidden" name="userid" value="{{ $users->id }}">
                    <div class="button_flex_cust_form finalBtnDev">
                        @php
                            $isUpdate = $profileData?->upload_photo == 1;
                            $message = 'After submission of this application, no changes are permitted.';
                            $actionType = 'submit';
                        @endphp
                        <button type="submit" name="actiontype" class="btn-green p-2" value="submit"
                            onclick="event.preventDefault(); confirmSwal({{ $profileData?->id ?? 0 }}, '{{ $message }}', '{{ $actionType }}');">
                            Approve & Submit
                        </button>
                    </div>
                </form>
                @endif
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/utils/toggleFields.js') }}"></script>
    <script src="{{ asset('public/js/utils/validationManager.js') }}"></script>
    <script src="{{ asset('public/js/user-management/edit.js') }}"></script>
@endpush