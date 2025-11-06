@extends('layouts.dashboard')
@section('meta-head')
    <meta name="session-tab" content="{{ session('tab') ?? 0 }}">
@endsection

@section('dashboard_content')
    <div id="loader"></div>
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Applicant Profile</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Personal Details
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')" id="defaultOpen2">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    Education Details
                </button>
                <button data-popover-target="popover-default4" class="tablink" onclick="openPage('gateScore', this, '#373737')" id="defaultOpen4">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                    GATE Score Details
                </button>
                <button data-popover-target="popover-default2" class="tablink" onclick="openPage('work', this, '#373737')"
                    id="defaultOpen3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                    Work Experience Details
                </button>
                <div data-popover id="popover-default2" role="tooltip"
                    class="custom_tool_tip shadow-xl absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 candidateErr">
                        <p>Work Experience Details tab is optional for freshers</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button class="tablink" onclick="openPage('preview', this, '#373737')" id="defaultOpen1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>Preview</button>

            </div>
            @include('components.alert')

            <div id="Home" class="tabcontent">
                <form id="personalDetailsForm" method="POST"
                    action="{{ route('recruitment-portal.candidate.personal-details') }}" class="form_grid_cust"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ @Auth::user()->name }}"
                                class="full_name" placeholder="Your Full Name" required="true" disabled>
                            <span id="full_name_err" class="candidateErr">
                                @if ($errors->has('full_name'))
                                    {{ $errors->first('full_name') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Father's/Husband's Name</label>
                            <input type="text" id="father_husband_name" name="father_husband_name"
                                class="father_husband_name" placeholder="Father's/Husband's Name"
                                value="{{ old('father_husband_name') }}">
                            <span id="father_husband_name_err" class="candidateErr">
                                @if ($errors->has('father_husband_name'))
                                    {{ $errors->first('father_husband_name') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Email</label>
                            <input type="email" id="email" name="email" class="email" placeholder="Email"
                                value="{{ @Auth::user()->email }}" disabled>
                            <span id="email_err" class="candidateErr">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Mobile No</label>
                            <input type="text" id="mobile_no" name="mobile_no" class="mobile_no" placeholder="Mobile No"
                                value="{{ @Auth::user()->mobile }}" disabled>
                            <span id="mobile_no_err" class="candidateErr">
                                @if ($errors->has('mobile_no'))
                                    {{ $errors->first('mobile_no') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="date_of_birth"
                                value="{{ @Auth::user()->date_of_birth }}" disabled>
                            <span id="date_of_birth_err" class="candidateErr">
                                @if ($errors->has('date_of_birth'))
                                    {{ $errors->first('date_of_birth') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Gender</label>
                            <select id="gender" name="gender" class="gender">
                                <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') === 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <span id="gender_err" class="candidateErr">
                                @if ($errors->has('gender'))
                                    {{ $errors->first('gender') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Category</label>
                            <select id="category" name="category" data-courses='@json($castes)'
                                class="category js-single" required>
                                <option value="">Select category</option>
                                @foreach ($castes as $caste)
                                    <option value="{{ $caste->id }}"
                                        {{ old('category') === $caste->id ? 'selected' : '' }}>
                                        {{ $caste->caste }}</option>
                                @endforeach
                            </select>
                            <span id="category_err" class="candidateErr">
                                @if ($errors->has('category'))
                                    {{ $errors->first('category') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Aadhar number (Last 6 Digits)</label>
                            <input type="text" id="aadhar_number" name="aadhar_number" class="aadhar_number"
                                placeholder="Aadhar number (Last 6 Digits)" value="{{ old('aadhar_number') }}"
                                maxlength="6">
                            <span id="aadhar_number_err" class="candidateErr">
                                @if ($errors->has('aadhar_number'))
                                    {{ $errors->first('aadhar_number') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Ex Service Man</label>
                            <select id="ex_serviceman" name="ex_serviceman" class="ex_serviceman">
                                <option value="0" {{ old('ex_serviceman') === '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('ex_serviceman') === '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            <span id="ex_serviceman_err" class="candidateErr">
                                @if ($errors->has('ex_serviceman'))
                                    {{ $errors->first('ex_serviceman') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Disability Details</div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Whether you are PwBD or not</label>
                            <select id="pwbd" name="pwbd" class="pwbd">
                                <option value="No" {{ old('pwbd') === 'No' ? 'selected' : '' }}>No</option>
                                <option value="Yes" {{ old('pwbd') === 'Yes' ? 'selected' : '' }}>Yes</option>
                            </select>
                            <span id="pwbd_err" class="candidateErr">
                                @if ($errors->has('pwbd'))
                                    {{ $errors->first('pwbd') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="">If yes, the nature of disability</label>
                            <select id="disability" name="disability" class="disability"
                                {{ old('pwbd') !== 'Yes' ? 'disabled' : '' }}>
                                <option value="" selected>Select</option>
                                <option value="Deaf(D) / Hard of Hearing(HH)"
                                    {{ old('disability') === 'Deaf(D) / Hard of Hearing(HH)' ? 'selected' : '' }}>Deaf(D) /
                                    Hard of
                                    Hearing(HH)</option>
                                <option
                                    value="One arm(OA)/ one leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/ Acid Attack Victims(AAV)"
                                    {{ old('disability') === 'One arm(OA)/ one leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/ Acid Attack Victims(AAV)' ? 'selected' : '' }}>
                                    One arm(OA)/ one
                                    leg(OL)/ Leprosy Cured(LC)/ Dwarfism (Dw)/ Acid Attack Victims(AAV)</option>
                                <option value="Special Learning Disability (SLD)/ Mental Illness (MI)"
                                    {{ old('disability') === 'Special Learning Disability (SLD)/ Mental Illness (MI)' ? 'selected' : '' }}>
                                    Special Learning
                                    Disability (SLD)/ Mental Illness (MI)</option>
                                <option
                                    value="Multiple disability (MD) involving more than one Benchmark Disability of (i) to (iii) above"
                                    {{ old('disability') === 'Multiple disability (MD) involving more than one Benchmark Disability of (i) to (iii) above' ? 'selected' : '' }}>
                                    Multiple
                                    disability (MD) involving more than one Benchmark Disability of (i) to (iii) above
                                </option>
                            </select>
                            <span id="disability_err" class="candidateErr">
                                @if ($errors->has('disability'))
                                    {{ $errors->first('disability') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Correspondence Address</div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div class="">
                            <label class="required-label">Address</label>
                            <input type="text" id="correspondence_address" name="correspondence_address"
                                class="correspondence_address" placeholder="Correspondence Address"
                                value="{{ old('correspondence_address') }}">
                            <span id="correspondence_address_err" class="candidateErr">
                                @if ($errors->has('correspondence_address'))
                                    {{ $errors->first('correspondence_address') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">City</label>
                            <input type="text" id="correspondence_city" name="correspondence_city"
                                class="correspondence_city" placeholder="Correspondence City"
                                value="{{ old('correspondence_city') }}">
                            <span id="correspondence_city_err" class="candidateErr">
                                @if ($errors->has('correspondence_city'))
                                    {{ $errors->first('correspondence_city') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">State</label>
                            <select id="correspondence_state" name="correspondence_state"
                                data-courses='@json($states)' class="js-single" required>
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                            <span id="correspondence_state_err" class="candidateErr">
                                @if ($errors->has('correspondence_state'))
                                    {{ $errors->first('correspondence_state') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Pincode</label>
                            <input type="number" min="100000" max="999999" id="correspondence_pincode"
                                name="correspondence_pincode" class="correspondence_pincode"
                                placeholder="Correspondence Pincode" value="{{ old('correspondence_pincode') }}"
                                required>
                            <span id="correspondence_pincode_err" class="candidateErr">
                                @if ($errors->has('correspondence_pincode'))
                                    {{ $errors->first('correspondence_pincode') }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Permanent Address</div>
                    </div>

                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div class="">
                            <label class="required-label">Address</label>
                            <input type="text" id="permanent_address" name="permanent_address"
                                class="permanent_address" placeholder="Permanent Address"
                                value="{{ old('permanent_address') }}">
                            <div class="flex items-start">
                                <div class="flex items-center h-5 inpus_cust_cs">
                                    <input type="checkbox" class="w-4 h-4" id="forSame">
                                </div>
                                &nbsp;&nbsp;<span style="font-size: 10px;">Same as Correspondence Address</span>
                            </div>
                            <span id="permanent_address_err" class="candidateErr">
                                @if ($errors->has('permanent_address'))
                                    {{ $errors->first('permanent_address') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">City</label>
                            <input type="text" id="permanent_city" name="permanent_city" class="permanent_city"
                                placeholder="Permanent City" value="{{ old('permanent_city') }}">
                            <span id="permanent_city_err" class="candidateErr">
                                @if ($errors->has('permanent_city'))
                                    {{ $errors->first('permanent_city') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">State</label>
                            <select id="permanent_state" name="permanent_state"
                                data-courses='@json($states)' class="js-single" required>
                                <option value="">Select state</option>
                                @foreach ($states as $state)
                                    <option value="{{ $state->id }}">
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                            <span id="permanent_state_err" class="candidateErr">
                                @if ($errors->has('permanent_state'))
                                    {{ $errors->first('permanent_state') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Pincode</label>
                            <input type="number" min="100000" max="999999" id="permanent_pincode"
                                name="permanent_pincode" class="pincode" placeholder="Permanent Pincode"
                                value="{{ old('permanent_pincode') }}" required>
                            <span id="permanent_pincode_err" class="candidateErr">
                                @if ($errors->has('permanent_pincode'))
                                    {{ $errors->first('permanent_pincode') }}
                                @endif
                            </span>
                        </div>
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div>Upload Documents</div>
                    </div>
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div class="attachment_section_photos attachment_preview">
                            <label class="required-label">Upload Photo(<span style="font-size: 10px;">Max size
                                    2MB</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_photoss" name="upload_photoss" class="upload_photoss"
                                    placeholder="Upload Photo" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos"> Upload File
                                    <input id="upload_photos" type="file" name="upload_photos"
                                        class="hidden upload_photos" value="">
                                </label>
                            </div>
                            <span id="upload_photos_err" class="candidateErr">
                                @if ($errors->has('upload_photos'))
                                    {{ $errors->first('upload_photos') }}
                                @endif
                            </span>
                        </div>

                        <div class="attachment_section_sign attachment_preview">
                            <label class="required-label">Upload Signature(<span style="font-size: 10px;">Max size
                                    2MB</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_signaturee" name="upload_signaturee" class=""
                                    placeholder="Upload Signature" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_signature"> Upload File
                                    <input name="upload_signature" id="upload_signature" type="file"
                                        class="hidden upload_signature">

                                </label>
                            </div>
                            <span id="upload_signature_err" class="candidateErr">
                                @if ($errors->has('upload_signature'))
                                    {{ $errors->first('upload_signature') }}
                                @endif
                            </span>
                        </div>

                        <div class="attachment_section_dob_proof attachment_preview">
                            <label class="required-label">Proof of Date of Birth(Class X Certificate)(<span
                                    style="font-size: 10px;">Max size 2MB & file
                                    should be pdf only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_dob_prooff" name="upload_dob_prooff" class=""
                                    placeholder="Upload DOB proof" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_dob_proof"> Upload File
                                    <input name="upload_dob_proof" id="upload_dob_proof" type="file"
                                        class="hidden upload_dob_proof">

                                </label>
                            </div>
                            <span id="upload_dob_proof_err" class="candidateErr">
                                @if ($errors->has('upload_dob_proof'))
                                    {{ $errors->first('upload_dob_proof') }}
                                @endif
                            </span>
                        </div>

                        @php
                            $selectedCaste = collect($castes)->firstWhere('id', old('category'));
                            $isGeneral = $selectedCaste && strtoupper($selectedCaste->caste) === 'GENERAL';
                            $shouldDisable = $isGeneral || old('category') == '';
                        @endphp

                        <div class="attachment_section_caste_certificate attachment_preview">
                            <label class="">Proof of Caste (Category Certification)/ Proof of Income, if
                                EWS(<span style="font-size: 10px;">Max size 2MB & file
                                    should be pdf only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_caste_certificatee" name="upload_caste_certificatee"
                                    class="" placeholder="Upload caste certificate" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_caste_certificate"> Upload File
                                    <input name="upload_caste_certificate" id="upload_caste_certificate" type="file"
                                        class="hidden upload_caste_certificate" {{ $shouldDisable ? 'disabled' : '' }}>
                                </label>
                            </div>
                            <span id="upload_caste_certificate_err" class="candidateErr">
                                @if ($errors->has('upload_caste_certificate'))
                                    {{ $errors->first('upload_caste_certificate') }}
                                @endif
                            </span>
                        </div>

                        <div class="attachment_section_disability_proof attachment_preview">
                            <label class="">Proof of Physically Disabled(<span style="font-size: 10px;">Max
                                    size 2MB & file
                                    should be pdf only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_disability_prooff" name="upload_disability_prooff"
                                    class="" placeholder="Upload disability proof" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_disability_proof"> Upload File
                                    <input name="upload_disability_proof" id="upload_disability_proof" type="file"
                                        class="hidden upload_disability_proof"
                                        {{ old('pwbd') !== 'Yes' ? 'disabled' : '' }}>

                                </label>
                            </div>
                            <span id="upload_disability_proof_err" class="candidateErr">
                                @if ($errors->has('upload_disability_proof'))
                                    {{ $errors->first('upload_disability_proof') }}
                                @endif
                            </span>
                        </div>

                        <div class="attachment_section_ex_serviceman_proof attachment_preview">
                            <label class="">Proof of Ex Serviceman(<span style="font-size: 10px;">Max size
                                    2MB & file
                                    should be pdf only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_ex_serviceman_prooff" name="upload_ex_serviceman_prooff"
                                    class="" placeholder="Upload ex serviceman proof" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_ex_serviceman_proof"> Upload
                                    File
                                    <input name="upload_ex_serviceman_proof" id="upload_ex_serviceman_proof"
                                        type="file" class="hidden upload_ex_serviceman_proof"
                                        {{ old('ex_serviceman') !== '1' ? 'disabled' : '' }}>
                                </label>
                            </div>
                            <span id="upload_ex_serviceman_proof_err" class="upload_ex_serviceman_proof candidateErr">
                                @if ($errors->has('upload_ex_serviceman_proof'))
                                    {{ $errors->first('upload_ex_serviceman_proof') }}
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button id="personalDetailsSaveBtn" class="hover-effect-btn fill_btn" type="button">
                            Save & Next
                        </button>
                    </div>
                </form>

            </div>

            <div id="News" class="tabcontent">
                <form id="educationalDetailsForm" method="POST"
                    action="{{ route('recruitment-portal.candidate.educational-details') }}" class="form_grid_cust"
                    enctype="multipart/form-data">
                    @csrf
                    <div id="educationalDetailsFormPrep">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_" id="eduDevAdd_0">
                            <div class="">
                                <label class="required-label">Examination</label>
                                <input type="text" id="examination" name="examination" class=""
                                    placeholder="Examination">
                                <span id="examination_err" class="examination_err candidateErr">
                                    @error('examination')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Name of Institute/College</label>
                                <input type="text" id="institute_name" name="institute_name" class=""
                                    placeholder="Name of Institute/College">
                                <span id="institute_name_err" class="institute_name_err candidateErr">
                                    @error('institute_name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">University/Board</label>
                                <input type="text" id="university_board" name="university_board" class=""
                                    placeholder="University/Board">
                                <span id="university_board_err" class="university_board_err candidateErr">
                                    @error('university_board')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Passing Year</label>
                                <select id="passing_year" name="passing_year" data-courses='@json($passing_years)'
                                    class="passing_year js-single" required>
                                    <option value="">Select passing year</option>
                                    @foreach ($passing_years as $passing_year)
                                        <option value="{{ $passing_year->id }}">
                                            {{ $passing_year->passing_year }}</option>
                                    @endforeach
                                </select>
                                <span id="passing_year_err" class="passing_year_err candidateErr">
                                    @error('passing_year')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Percentage of marks/CGPA obtained</label>
                                <input type="text" id="percentage_cgpa" name="percentage_cgpa" class=""
                                    placeholder="Percentage of marks/CGPA obtained">
                                <span class="percentage_cgpa_err candidateErr">
                                    @error('percentage_cgpa')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="attachment_section_marksheet_degree attachment_preview">
                                <label class="required-label">Marksheet / Degree (<span style="font-size: 10px;">Max size
                                        2MB &
                                        file should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="marksheet_degreee0" name="marksheet_degreee"
                                        class="marksheet_degreee" placeholder="Upload Marksheet / Degree" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_marksheet_degree"> Upload File
                                        <input type="file" id="marksheet_degree" name="marksheet_degree"
                                            class="hidden marksheet_degree">
                                        <input type="hidden" id="eduClickedFrom" name="eduClickedFrom" value="">
                                    </label>
                                </div>
                                <span class="marksheet_degree_err candidateErr">
                                    @error('marksheet_degree')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button id="educationalDetailsBtn" type="button"
                            class="hover-effect-btn border_btn
                                    ">Add</button>
                        <button id="educationalDetailsBtn1" class="hover-effect-btn fill_btn" type="button"> Save & Next
                        </button>
                    </div>
                </form>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Examination
                                </th>
                                <th scope="col">
                                    Name of Institute/College
                                </th>
                                <th scope="col">
                                    University/Board
                                </th>
                                <th scope="col">
                                    Passing Year
                                </th>
                                <th scope="col">
                                    Percentage/CGPA
                                </th>
                                <th scope="col">
                                    Marksheet/Degree
                                </th>
                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="eduTbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="gateScore" class="tabcontent">
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                    <label class="required-label">Details of GATE Score :</label>
                </div>
                <form class="form_grid_cust" action="{{ route('recruitment-portal.candidate.gate.score') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Year of GATE Exam</label>
                            <select name="gate_exam_year" id="gate_exam_year" required>
                                <option value="">--- Select year of GATE exam ---</option>
                                @php
                                    $currentYear = date('Y');
                                    $filteredYears = $passing_years->filter(function ($year) use ($currentYear) {
                                        return $year->passing_year >= ($currentYear - 3) && $year->passing_year <= $currentYear;
                                    });
                                @endphp

                                @foreach ($filteredYears as $passing_year)
                                    <option value="{{ $passing_year->id }}">
                                        {{ $passing_year->passing_year }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="required-label">GATE Discpline</label>
                            <select name="gate_discpline" id="gate_discpline" required>
                                <option value="">--- Select GATE discpline ---</option>
                                @forelse ($disciplines as $disciplinesVal)
                                    <option value="{{ $disciplinesVal->id }}" {{ $disciplinesVal->id === 1 ? 'selected' : '' }}>
                                        {{ $disciplinesVal->discipline_name }}
                                    </option>
                                @empty
                                    <option value="">No GATE discpline found</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">GATE Registartion Number</label>
                            <input type="text" id="gate_registration_number" name="gate_registration_number" value="" placeholder="Enter GATE registration number" required>
                        </div>
                        <div class="form-input">
                            <label class="required-label">GATE Score</label>
                            <input type="text" name="gate_score" id="gate_score" class="full_name" placeholder="Enter your GATE score" required>
                            <small>Please enter your GATE Score as mentioned in your official GATE 2025 Scorecard (range: 0 to 1000). For reference, you may click [here] to view a sample scorecard indicating the location of the GATE Score).</small>
                        </div>
                        <div class="form-input">
                            <label class="required-label">All India Rank</label>
                            <input type="text" id="all_india_rank" name="all_india_rank" placeholder="Enter all india rank in test paper" required>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Total Number Of Candidate</label>
                            <input type="text" id="number_of_candidate" name="number_of_candidate" placeholder="Enter number of candidate appeared for the test paper" required>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Percentile</label>
                            <input type="text" id="gate_percentile" name="gate_percentile" placeholder="0.00" required readonly>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn border_btn">Save</button>
                    </div>
                </form>
                <div class="table_over" style="display:none">
                    <table class="cust_table__ table_sparated" id="gateScoreTableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Registartion Number</th>
                                <th>Exam Year</th>
                                <th>GATE Discpline</th>
                                <th>GATE Score</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="work" class="tabcontent">
                <form id="workExperienceDetailsForm" method="POST"
                    action="{{ route('recruitment-portal.candidate.work-experience-details') }}" class="form_grid_cust"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="workExperienceDetailsRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev">
                            <div class="">
                                <label class="required-label">Employer name</label>
                                <input id="employer_name" name="employer_name" type="text" class=""
                                    placeholder="Employer name" value="{{ old('employer_name') ?? '' }}">
                                <span id="employer_name_err" class="candidateErr employer_name_err">
                                    @error('employer_name')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Post Held</label>
                                <input id="post_held" name="post_held" required maxlength="500" type="text"
                                    class="" placeholder="Post Held" value="{{ old('post_held') ?? '' }}">
                                <span id="post_held_err" class="candidateErr post_held_err">
                                    @error('post_held')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">From Date</label>
                                <input type="date" id="from_date" name="from_date" class="">
                                <span id="from_date_err" class="candidateErr from_date_err">
                                    @error('from_date')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">To Date</label>
                                <input type="date" id="to_date" name="to_date" class="">
                                <span id="to_date_err" class="candidateErr to_date_err" value="{{ old('to_date') }}">
                                    @error('to_date')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Brief Job Description(Max.500 Characters)</label>
                                <textarea rows="1" class="" maxlength="500" id="job_description" name="job_description"
                                    placeholder="Brief Job Description">{{ old('job_description') }}</textarea>
                                <span id="job_description_err" class="candidateErr job_description_err">
                                    @error('job_description')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="attachment_section_experience_certificate attachment_preview">
                                <label class="required-label">Experience Certificate(<span style="font-size: 10px;">Max
                                        size 2MB
                                        & file should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="experience_certificatee" name="experience_certificatee"
                                        class="experience_certificatee" placeholder="Upload Experience Certificate"
                                        readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input id="experience_certificate" name="experience_certificate" type="file"
                                            class="hidden experience_certificate">
                                        <input type="hidden" id="workClickedFrom" name="workClickedFrom"
                                            value="">
                                    </label>
                                </div>
                                <span id="experience_certificate_err" class="candidateErr experience_certificate_err">
                                    @error('experience_certificatee')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button id="workExperienceDetailsBtn1" type="button"
                            class="hover-effect-btn border_btn
                                    ">Save</button>
                        {{-- <button id="workExperienceDetailsBtn" class="hover-effect-btn fill_btn" type="button"> Save &
                            Next </button> --}}
                    </div>
                </form>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Employer Name
                                </th>
                                <th scope="col">
                                    Post Held
                                </th>
                                <th scope="col">
                                    From - To Date
                                </th>
                                <th scope="col">
                                    Experience
                                </th>
                                <th scope="col">
                                    Brief Job Description
                                </th>
                                <th scope="col">
                                    Experience Certificate
                                </th>
                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="expeTbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="preview" class="tabcontent">
                <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files').'?pathName=' . urlencode($previewData->upload_photos_filepath) . '&fileName=' . urlencode($previewData->upload_photos) }}" alt="" width="100" height="100">
                <div class="download_prive_cust">
                    <h4 class="applicat_cust-title">User Information</h4>
                </div>
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Application ID</div>
                        <div class="applicat_cust-value" id="previewId">{{ $previewData->user->id }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value" id="previewName">{{ $previewData->user->name }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Gender</div>
                        <div class="applicat_cust-value" id="previewGender">{{ $previewData->gender }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                        <div class="applicat_cust-value" id="previewFnameHname">{{ $previewData->father_husband_name }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value" id="previewDob">{{ Auth::user()->date_of_birth }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Contact Number</div>
                        <div class="applicat_cust-value" id="previewMobileNo">{{ $previewData->user->mobile }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value" id="previewEmail">{{ $previewData->user->email }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Pin Code</div>
                        <div class="applicat_cust-value" id="previewPincode">{{ $previewData->permanent_pincode }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Correspondence Address</div>
                        <div class="applicat_cust-value" id="previewCaddress">{{ $previewData->correspondence_address }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Permanent Address</div>
                        <div class="applicat_cust-value" id="previewPaddress">{{ $previewData->permanent_address }}</div>
                    </div>
                </div>
                <h4 class="applicat_cust-title mt-3">Education Qualification</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Qualification</th>
                                <th>Board/ University/ Collage</th>
                                <th>Passing Year</th>
                                <th>Percentage</th>
                                <th>Marksheet/Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($previewData->education as $educationData)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $educationData->examination }}</td>
                                <td>{{ $educationData->institute_name }}</td>
                                <td>{{ $educationData->passingYear->passing_year }}</td>
                                <td>{{ $educationData->percentage_cgpa }}</td>

                                <td>
                                    <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                        'pathName' => $educationData->marksheet_filepath,
                                        'fileName' => $educationData->marksheet
                                    ]) }}" class="btn btn-default btn-sm" target="_blank">
                                        View Marksheet
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="6">No Records found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <h4 class="applicat_cust-title mt-3">Gate Score Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th>#</th>
                                <th>Registartion Number</th>
                                <th>Exam Year</th>
                                <th>GATE Discpline</th>
                                <th>GATE Score</th>
                                <th>All India Rank</th>
                                <th>GATE Percentile</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($previewData->gatescore as $gatescoreData)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $gatescoreData->gate_registration_number }}</td>
                                <td>{{ optional($gatescoreData->passingYear)->passing_year }}</td>
                                <td>{{ optional($gatescoreData->gateDiscpline)->discipline_name }}</td>
                                <td>{{ $gatescoreData->gate_score }}</td>
                                <td>{{ $gatescoreData->all_india_rank ?? '0' }}</td>
                                <td>{{ $gatescoreData->gate_percentile ?? '0.00' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="5">No Records found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Employer</th>
                                <th>Post Held</th>
                                <th>From - To Date</th>
                                <th>Nature of Duites</th>
                                <th>Experience Certificate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($previewData->experience as $experienceData)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $experienceData->employer_name }}</td>
                                <td>{{ $experienceData->post_held }}</td>
                                <td>
                                    {{ \Carbon\Carbon::parse($experienceData->from_date)->format('d M Y') }} -
                                    {{ $experienceData->to_date ? \Carbon\Carbon::parse($experienceData->to_date)->format('d M Y') : 'Present' }}
                                </td>
                                <td>{{ $experienceData->job_description }}</td>
                                <td>
                                    <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                        'pathName' => $experienceData->experience_certificate_filepath,
                                        'fileName' => $experienceData->experience_certificate
                                    ]) }}" class="btn btn-default btn-sm" target="_blank">
                                        View Certificate
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <th colspan="6">No Records found</th>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <form action="{{route('recruitment-portal.candidate.application.disclosure')}}" method="post">
                    @csrf
                    <input type="hidden" name="action" value="disclouser">
                    <input type="hidden" name="applicationid" value="{{ $previewData->id }}">
                    <h4 class="applicat_cust-title mt-3">Declaration:- </h4>
                    <label>
                        <input type="checkbox" name="terms_agreement" id="terms_agreement" {{ $previewData->terms_agreement === 1 ? 'checked' : '' }} required><small> I have carefully gone through the vacancy advertisement and I solemnly declare and undertake that all the information furnished by me is true, correct and complete to the best of my knowledge and belief. I undertake that, if at any stage of the selection or even after selection, any of the information furnished by me is found to be false, incorrect or misleading, then my candidature/appointment/services will stand cancelled / terminated without assigning me any reason. I will produce the original documents in support of the information furnished when so ever required by the employer. I also certify that there is no conflict of interest with any concessionairs/stakeholders/staff associated with National Highways & Infrastructure Development Corporation Ltd.</small>
                    </label>
                    <div class="button_flex_cust_form finalBtnDev">
                        <button class="hover-effect-btn fill_btn" type="submit"> {{ $previewData->terms_agreement === 1 ? 'Update' : 'Accept' }} </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const userGateScoreUrl = "{{ route('recruitment-portal.candidate.gate.score.table') }}";
    </script>
    <script src="{{ asset('public/js/recruitment-management/candidate/candidate.js') }}"></script>
    <script src="{{ asset('public/js/recruitment-management/candidate/candidate-tab.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
@endpush
