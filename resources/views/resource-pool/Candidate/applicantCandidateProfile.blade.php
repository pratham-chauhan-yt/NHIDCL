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
                <button class="tablink active" id="defaultTabs1">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Personal Details
                </button>
                <button class="tablink" id="defaultTabs2">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    Educational Details
                </button>
                <button class="tablink" id="defaultTabs3">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>
                    Work Experience Details
                </button>
                <button data-popover-target="popover-default2" class="tablink myDIV" id="defaultTabs4">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    Competitive Exams
                </button>
                <div data-popover id="popover-default2" role="tooltip"
                    class="custom_tool_tip  shadow-xl absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 candidateErr">
                        <p>Competitive Exams tab is optional</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-default3" type="button" class="tablink myDIV" id="defaultTabs5">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    Additional Details
                </button>
                <div data-popover id="popover-default3" role="tooltip"
                    class="custom_tool_tip shadow-xl absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 candidateErr">
                        <p>Additional Details tab is optional</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button data-popover-target="popover-default4" type="button" class="tablink myDIV" id="defaultTabs6">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    Training Details
                </button>
                <div data-popover id="popover-default4" role="tooltip"
                    class="custom_tool_tip shadow-xl absolute z-10 invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                    <div class="px-3 py-2 candidateErr">
                        <p>Training Details tab is optional</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>
                <button class="tablink" onclick="openPage('application', this, '#373737')" id="defaultTabs7">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Application Preview
                </button>
            </div>
            @include('components.alert')

            <div id="tab-1" class="tabcontent">
                <form id="personalDetailsForm" method="POST" action="{{ route('personal-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Applied For</label>
                            <select id="ref_engagement_id" name="ref_engagement_id" class="ref_engagement_id">
                                @foreach ($engagements as $engagement)
                                    <option value="{{ $engagement->id }}" {{ old('ref_engagement_id') == $engagement->id ? 'selected' : '' }}>
                                        {{ $engagement->engagement_type }}
                                    </option>
                                @endforeach
                            </select>
                            <span id="ref_engagement_id_err" class="ref_engagement_id_err candidateErr">
                                @if ($errors->has('ref_engagement_id'))
                                    {{ $errors->first('ref_engagement_id') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ @Auth::user()->name }}"
                                class="full_name" placeholder="Your Full Name" required="true" readonly>
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
                                value="{{ @Auth::user()->email }}" readonly>
                            <span id="email_err" class="candidateErr">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Mobile No</label>
                            <input type="text" id="mobile_no" name="mobile_no" class="mobile_no"
                                placeholder="Mobile No" value="{{ @Auth::user()->mobile }}" readonly>
                            <span id="mobile_no_err" class="candidateErr">
                                @if ($errors->has('mobile_no'))
                                    {{ $errors->first('mobile_no') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="date_of_birth"
                                value="{{ @Auth::user()->date_of_birth }}" readonly>
                            <span id="date_of_birth_err" class="candidateErr">
                                @if ($errors->has('date_of_birth'))
                                    {{ $errors->first('date_of_birth') }}
                                @endif
                            </span>
                            
                        </div>
                        <div class="">
                            <label class="required-label">Gender</label>
                            <select id="gender" name="gender" class="gender">
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <span id="gender_err" class="candidateErr">
                                @if ($errors->has('gender'))
                                    {{ $errors->first('gender') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="">Spouse Name</label>
                            <input type="text" id="spouse_name" name="spouse_name" class="spouse_name"
                                placeholder="Spouse Name" value="{{ old('spouse_name') }}">
                            <span id="spouse_name_err" class="candidateErr">
                                @if ($errors->has('spouse_name'))
                                    {{ $errors->first('spouse_name') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="">Spouse Mobile No</label>
                            <input type="text" id="spouse_mobile_no" name="spouse_mobile_no" class="spouse_mobile_no"
                                placeholder="Spouse Mobile No" value="{{ old('spouse_mobile_no') }}">
                            <span id="spouse_mobile_no_err" class="candidateErr">
                                @if ($errors->has('spouse_mobile_no'))
                                    {{ $errors->first('spouse_mobile_no') }}
                                @endif
                            </span>
                        </div>

                        <div class="">
                            <label class="required-label">Correspondence Address</label>
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
                            <label class="required-label">Pin Code</label>
                            <input type="number" min="100000" max="999999" id="pincode" name="pincode"
                                class="pincode" placeholder="Pin Code" value="{{ old('pincode') }}" required>
                            <span id="pincode_err" class="candidateErr">
                                @if ($errors->has('pincode'))
                                    {{ $errors->first('pincode') }}
                                @endif
                            </span>
                        </div>
                        <div class="">
                            <label class="required-label">Permanent Address</label>
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
                            <label class="required-label">Upload Signature(<span style="font-size: 10px;">Max size 2MB &
                                    file
                                    should be jpg, png only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_signaturee" name="upload_signaturee"
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
                        <div class="attachment_section_resume attachment_preview">
                            <label class="required-label">Upload CV(<span style="font-size: 10px;">Max size 2MB & file
                                    should be
                                    pdf only</span>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_resumee" name="upload_resumee" class=""
                                    placeholder="Upload CV" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_resume"> Upload File
                                    <input id="upload_resume" name="upload_resume" class="upload_resume" type="file"
                                        class="hidden" accept="application/pdf,.pdf">
                                </label>
                            </div>
                            <span id="upload_resume_err" class="candidateErr">
                                @if ($errors->has('upload_resume'))
                                    {{ $errors->first('upload_resume') }}
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

            <div id="tab-2" class="tabcontent">
                <form id="educationalDetailsForm" method="POST" action="{{ route('educational-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div id="educationalDetailsFormPrep">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_" id="eduDevAdd_0">
                            <div class="qualificationDiv">
                                <label class="required-label">Qualification</label>
                                <select id="qualification" name="qualification"
                                    data-courses='@json($courses)' class="js-single">
                                    <option value="">Select Qualification</option>
                                    @foreach ($qualifications as $rowQualification)
                                        <option value="{{ $rowQualification->id }}">
                                            {{ $rowQualification->qualification_name }}</option>
                                    @endforeach
                                </select>
                                <span class="qualification_err candidateErr">
                                    @error('qualification')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="otherQualificationDiv" style="display:none">
                                <label class="">Other Qualification</label>
                                <input type="text" id="other_qualification" name="other_qualification" class=""
                                    placeholder="Qualification Name">
                                <span id="other_qualification_err" class="other_qualification_err candidateErr">
                                    @error('other_qualification')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="courseDiv">
                                <label class="required-label">Course / Degree</label>
                                <select id="course" name="course" class="js-single">
                                    <option value="">Select Course/Degree</option>
                                </select>
                                <span class="course_err candidateErr">
                                    @error('course')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="otherCourseDiv" style="display:none">
                                <label class="">Other Course / Degree</label>
                                <input type="text" id="other_course" name="other_course" class=""
                                    placeholder="Course/Degree Name">
                                <span id="other_course_err" class="other_course_err candidateErr">
                                    @error('other_course')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="collegeDiv">
                                <label class="required-label">Board / University / College</label>
                                <select id="board_university_collage" name="board_university_collage" class="js-single">
                                    <option value="">Select Board / University / College</option>
                                    @foreach ($board_university_collages as $rowboard_university_collage)
                                        <option value="{{ $rowboard_university_collage->id }}">
                                            {{ $rowboard_university_collage->name }}</option>
                                    @endforeach
                                </select>
                                <span class="board_university_collage_err candidateErr">
                                    @error('board_university_collage')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="otherCollegeDiv" style="display:none">
                                <label class="required-label">Other Board / University / College</label>
                                <input type="text" id="other_board_university_collage"
                                    name="other_board_university_collage" class=""
                                    placeholder="Name of Board/University/College">
                                <span id="other_board_university_collage_err"
                                    class="other_board_university_collage_err candidateErr">
                                    @error('other_board_university_collage')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="mainSubjectDiv">
                                <label class="required-label">Main Subject / Stream</label>
                                <select id="main_subject" name="main_subject" class="js-single">
                                    <option value="">Select Main Subject / Stream</option>
                                    @foreach ($main_subjects as $rowmain_subject)
                                        <option value="{{ $rowmain_subject->id }}">{{ $rowmain_subject->subject_name }}
                                        </option>
                                    @endforeach
                                    <option value="Others">Others</option>
                                </select>
                                <span class="main_subject_err candidateErr">
                                    @error('main_subject')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="otherMainSubjectDiv" style="display:none">
                                <label class="">Other Main Subject / Stream</label>
                                <input type="text" id="other_main_subject" name="other_main_subject" class=""
                                    placeholder="Main Subject/Stream Name">
                                <span id="other_main_subject_err" class="other_main_subject_err candidateErr">
                                    @error('other_main_subject')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Course Mode</label>
                                <select id="course_mode" name="course_mode" class="js-single">
                                    <option value="">Select Course Mode</option>
                                    @foreach ($course_modes as $rowcourse_mode)
                                        <option value="{{ $rowcourse_mode->id }}">{{ $rowcourse_mode->course_mode }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="course_mode_err candidateErr">
                                    @error('course_mode')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Passing Year</label>
                                <select id="passing_year" name="passing_year" class="passing_year">
                                    <option value="">Select Passing Year</option>
                                    @foreach ($passing_years as $rowpassing_year)
                                        <option value="{{ $rowpassing_year->id }}">{{ $rowpassing_year->passing_year }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="passing_year_err" class="candidateErr passing_year_err">
                                    @if ($errors->has('passing_year'))
                                        {{ $errors->first('passing_year') }}
                                    @endif
                                </span>
                            </div>
                            <div class="">
                                <label class="">CGPA (If applicable)</label>
                                <input type="number" id="cgpa" name="cgpa" placeholder="CGPA" step="0.01" min="0">
                                <span class="cgpa_err candidateErr">
                                    @error('cgpa')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Percentage</label>
                                <input type="number" id="percentage" name="percentage" placeholder="Percentage" step="0.01" min="0">
                                <span class="percentage_err candidateErr">
                                    @error('percentage')
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
                                            class="hidden marksheet_degree" accept="application/pdf,.pdf">
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
                        <button id="educationalDetailsBtn2" class="hover-effect-btn border_btn"
                            type="button">Add</button>
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
                                    Qualification
                                </th>
                                <th scope="col">
                                    Board/University/Collage
                                </th>
                                <th scope="col">
                                    Main Subject/Stream
                                </th>
                                <th scope="col">
                                    Course Mode
                                </th>
                                <th scope="col">
                                    Passing Year
                                </th>
                                <th scope="col">
                                    Percentage
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

            <div id="tab-3" class="tabcontent">
                <form id="workExperienceDetailsForm" method="POST" action="{{ route('work-experience-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="workExperienceDetailsRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev">
                            <div class="">
                                <label class="required-label">Employer/Organization name</label>
                                <input id="employer_name" name="employer_name[]" type="text" class=""
                                    placeholder="Employer/Organization name" value="{{ old('employer_name.0') ?? '' }}">
                                <span id="employer_name_err" class="candidateErr employer_name_err">
                                    @error('employer_name.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Post Held</label>
                                <input id="post_held" name="post_held[]" required maxlength="500" type="text"
                                    class="" placeholder="Post Held" value="{{ old('post_held.0') ?? '' }}">
                                <span id="post_held_err" class="candidateErr post_held_err">
                                    @error('post_held.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">From Date</label>
                                <input type="date" id="from_date" name="from_date[]" class="">
                                <span id="from_date_err" class="candidateErr from_date_err">
                                    @error('from_date.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">To Date</label>
                                <input type="date" id="to_date" name="to_date[]" class="">
                                <span id="to_date_err" class="candidateErr to_date_err" value="{{ old('to_date.0') }}">
                                    @error('to_date.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Nature of duties (in detail)</label>
                                <textarea rows="1" class="" id="nature_of_duties" name="nature_of_duties[]"
                                    placeholder="Nature of duties (in detail)">{{ old('nature_of_duties.0') }}</textarea>
                                <span id="nature_of_duties_err" class="candidateErr nature_of_duties_err">
                                    @error('nature_of_duties.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="">Employer Details (Place of Posting)</label>
                                <textarea rows="1" id="employer_details" name="employer_details[]" class=""
                                    placeholder="Employer Details">{{ old('employer_details.0') }}</textarea>
                                <span id="employer_details_err" class="candidateErr employer_details_err">
                                    @error('employer_details.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="areaOfExpertiseDiv">
                                <label class="required-label">Area of Expertise</label>
                                <select id="area_of_expertise" name="area_of_expertise[]" class="">
                                    <option value="">Select Area of Expertise</option>
                                    @foreach ($area_experties as $rowarea_of_expertise)
                                        <option value="{{ $rowarea_of_expertise->id }}">
                                            {{ $rowarea_of_expertise->experties_area }}</option>
                                    @endforeach
                                    <option value="Others">Others</option>
                                </select>
                                <span id="area_of_expertise_err" class="candidateErr area_of_expertise_err">
                                    @error('area_of_expertise.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="otherAreaOfExpertiseDiv" style="display:none">
                                <label class="">Other Area of Expertise</label>
                                <input type="text" id="other_area_of_expertise" name="other_area_of_expertise[]"
                                    class="" placeholder="Area of Expertise">
                                <span id="other_area_of_expertise_err" class="candidateErr other_area_of_expertise_err">
                                    @error('other_area_of_expertise.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Select Your Job Type</label>
                                <select id="job_type" name="job_type[]" class="">
                                    <option value="">Select Job Type</option>
                                    @foreach ($job_types as $rowjob_type)
                                        <option value="{{ $rowjob_type->id }}">{{ $rowjob_type->job_type }}</option>
                                    @endforeach
                                </select>
                                <span id="job_type_err" class="candidateErr job_type_err">
                                    @error('job_type.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="attachment_section_experience_certificate attachment_preview">
                                <label class="required-label">Experience Certificate(<span style="font-size: 10px;">Max
                                        size 2MB
                                        & file should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="experience_certificatee[]" name="experience_certificatee[]"
                                        class="experience_certificatee" placeholder="Upload Experience Certificate"
                                        readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input id="experience_certificate[]" name="experience_certificate[]"
                                            type="file" class="hidden experience_certificate" accept="application/pdf,.pdf">
                                        <input type="hidden" id="workClickedFrom" name="workClickedFrom"
                                            value="">
                                    </label>
                                </div>
                                <span id="experience_certificate_err" class="candidateErr experience_certificate_err">
                                    @error('experience_certificatee.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button id="workExperienceDetailsBtn1" type="button"
                            class="hover-effect-btn border_btn
                                    ">Add</button>
                        <button id="workExperienceDetailsBtn" class="hover-effect-btn fill_btn" type="button"> Save &
                            Next </button>
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
                                    Employer/Organization Name
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
                                    Nature of Duites
                                </th>
                                <th scope="col">
                                    Job Type
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
            
            <div id="tab-4" class="tabcontent">
                <form id="competitiveForm" method="POST" action="{{ route('competitive-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="competitiveRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Name of Exam</label>
                                <select id="name_of_exam" name="name_of_exam[]" class="name_of_exam">
                                    <option value="">--select exam--</option>
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->exam_name }}</option>
                                    @endforeach
                                </select>

                                <span id="name_of_exam_err" class="candidateErr name_of_exam_err">
                                    @if ($errors->has('name_of_exam'))
                                        {{ $errors->first('name_of_exam') }}
                                    @endif
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Conducting Agency</label>
                                <select id="conducting_agency" name="conducting_agency[]" class="conducting_agency">
                                    <option value="">--select conducting agency--</option>

                                    @foreach ($conductingAgency as $rowconductingAgency)
                                        <option value="{{ $rowconductingAgency->id }}">
                                            {{ $rowconductingAgency->agency_name }}</option>
                                    @endforeach

                                </select>
                                <span id="conducting_agency_err" class="candidateErr conducting_agency_err">
                                    @if ($errors->has('conducting_agency'))
                                        {{ $errors->first('conducting_agency') }}
                                    @endif
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Appearing Year</label>

                                <select id="appearing_year" name="appearing_year[]" class="appearing_year">
                                    <option value="">--select exam--</option>
                                    @foreach ($passing_years as $rowpassing_year)
                                        <option value="{{ $rowpassing_year->id }}">{{ $rowpassing_year->passing_year }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="appearing_year_err" class="candidateErr appearing_year_err">
                                    @if ($errors->has('appearing_year'))
                                        {{ $errors->first('appearing_year') }}
                                    @endif
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Score</label>
                                <input type="number" id="score" name="score[]" placeholder="score" step="0.01" min="0">
                                <span id="score_err" class="candidateErr score_err">
                                    @if ($errors->has('score'))
                                        {{ $errors->first('score') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_certificate attachment_preview">
                                <label class="required-label">Certificate(<span style="font-size: 10px;">Max size 2MB &
                                        file
                                        should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="certificatee" name="certificatee[]"
                                        placeholder="Upload Certificate" class="certificatee" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="certificate" name="certificate[]"
                                            class="hidden certificate">
                                        <input type="hidden" id="competClickedFrom" name="competClickedFrom"
                                            value="">
                                    </label>
                                </div>
                                <span id="certificate_err" class="candidateErr certificate_err">
                                    @if ($errors->has('certificate'))
                                        {{ $errors->first('certificate') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button type="button" id="competitiveBtn1"
                            class="hover-effect-btn border_btn competitiveAddMoreBtn
                                    ">Add</button>
                        <button id="competitiveBtn" class="hover-effect-btn fill_btn" type="button"> Save & Next
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
                                    Name of Exam
                                </th>
                                <th scope="col">
                                    Score
                                </th>
                                <th scope="col">
                                    Appearing Year
                                </th>
                                <th scope="col">
                                    Certificate
                                </th>

                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="competTbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-5" class="tabcontent">
                <form id="additionalDetailsForm" method="POST" action="{{ route('additional-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="additionalDetailsRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Award/Achievement Name</label>
                                <input type="text" id="award_name" name="award_name[]" class=""
                                    placeholder="Award Name">
                                <span id="award_name_err" class="candidateErr award_name_err">
                                    @if ($errors->has('award_name'))
                                        {{ $errors->first('award_name') }}
                                    @endif
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label">Award/Achievement Details</label>
                                <textarea rows="1" id="award_details" name="award_details[]" class="" placeholder="Award Details"></textarea>
                                <span id="award_details_err" class="candidateErr award_details_err">
                                    @if ($errors->has('award_details'))
                                        {{ $errors->first('award_details') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_award_certificate attachment_preview">
                                <label class="required-label">Award/Achievement Certificate(<span
                                        style="font-size: 10px;">Max
                                        size 2MB & file should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="award_certificatee" name="award_certificatee[]"
                                        placeholder="Upload Certificate" class="award_certificatee" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="award_certificate" name="award_certificate[]"
                                            class="hidden award_certificate">
                                        <input type="hidden" id="addClickedFrom" name="addClickedFrom" value="">
                                    </label>
                                </div>
                                <span id="award_certificate_err" class="candidateErr award_certificate_err">
                                    @if ($errors->has('award_certificate'))
                                        {{ $errors->first('award_certificate') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="button" id="additionalDetailsBtn1"
                            class="hover-effect-btn border_btn additionalDetailsAddMoreBtn
                                    ">Add</button>
                        <button id="additionalDetailsBtn" class="hover-effect-btn fill_btn" type="button"> Save & Next
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
                                    Award/Achievement Name
                                </th>
                                <th scope="col">
                                    Award/Achievement Details
                                </th>
                                <th scope="col">
                                    Award/Achievement Certificate
                                </th>
                                <th scope="col">
                                </th>

                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="additTbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-6" class="tabcontent">

                <form id="trainingDetailsForm" method="POST" action="{{ route('training-details') }}"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="trainingDetailsRow">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Name of Training/Certifications</label>
                                <input type="text" id="name_of_training" name="name_of_training" class=""
                                    placeholder="Name of training/certifications">
                                <span id="name_of_training_err" class="candidateErr name_of_training_err">
                                    @if ($errors->has('name_of_training'))
                                        {{ $errors->first('name_of_training') }}
                                    @endif
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Start Date</label>
                                <input type="date" id="training_start_date" name="training_start_date"
                                    class="">
                                <span id="training_start_date_err" class="candidateErr training_start_date_err">
                                    @error('training_start_date.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">End Date</label>
                                <input type="date" id="training_end_date" name="training_end_date" class="">
                                <span id="training_end_date_err" class="candidateErr training_end_date_err"
                                    value="{{ old('training_end_date.0') }}">
                                    @error('training_end_date.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="">
                                <label class="required-label">Descriptions</label>
                                <textarea rows="1" id="description" name="description" class="" placeholder="Description"></textarea>
                                <span id="description_err" class="candidateErr description_err">
                                    @if ($errors->has('description'))
                                        {{ $errors->first('description') }}
                                    @endif
                                </span>
                            </div>
                            <div class="">
                                <label class="">Certificate Expiry Date</label>
                                @php
                                    $tomorrow = \Carbon\Carbon::tomorrow()->format('Y-m-d');
                                @endphp

                                <input type="date" id="certificate_expiry_date" name="certificate_expiry_date"
                                    class="" min="{{ $tomorrow }}">
                                <span id="certificate_expiry_date_err" class="candidateErr certificate_expiry_date_err"
                                    value="{{ old('certificate_expiry_date.0') }}">
                                    @error('to_date.*')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                            <div class="attachment_section_training_certificate attachment_preview">
                                <label class="required-label">Certificate(<span style="font-size: 10px;">Max size 2MB &
                                        file
                                        should be pdf only</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="training_certificatee" name="training_certificatee"
                                        placeholder="Training Certificate" class="training_certificatee" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="training_certificate" name="training_certificate"
                                            class="hidden training_certificate">
                                        <input type="hidden" id="trainClickedFrom" name="trainClickedFrom"
                                            value="">
                                    </label>
                                </div>
                                <span id="training_certificate_err" class="candidateErr training_certificate_err">
                                    @if ($errors->has('training_certificate'))
                                        {{ $errors->first('training_certificate') }}
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button type="button" id="trainingAddBtn"
                            class="hover-effect-btn border_btn trainingAddBtn
                                    ">Add</button>
                        <button id="trainingBtn" class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                                    Name of Training/Certifications
                                </th>
                                <th scope="col">
                                    Descriptions
                                </th>
                                <th scope="col">
                                    Training Certificate
                                </th>

                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody id="TrainCbody">
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="tab-7" class="tabcontent">
                <div class="download_prive_cust">
                    <h4 class="applicat_cust-title">User Information</h4>
                    @if ($isProfileComplete)
                        <a class="hover-effect-btn fill_btn" id="photosDown" href="{{ route('profile.download') }}"
                            download>
                            <span>Download Profile</span>
                        </a>
                    @else
                        <p class="alert-danger">Please complete all steps to enable profile download.</p>
                    @endif
                </div>
                <div class="applicat_cust-container">
                    <div class="flex flex-row items-end" style="justify-content: space-evenly;">
                        <div class="p-5">
                            <img class="img-responsive"
                                src="{{ url('resource-pool-portal/candidate/viewFiles') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}"
                                alt="" width="100" height="100">
                            <h4 class="applicat_cust-title text-center">Photo</h4>
                        </div>
                        <div class="p-5">
                            <img class="img-responsive"
                                src="{{ url('resource-pool-portal/candidate/viewFiles') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}"
                                alt="" width="100" height="100">
                            <h4 class="applicat_cust-title text-center">Signature</h4>
                        </div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Application ID</div>
                        <div class="applicat_cust-value" id="previewId">{{ Auth::user()->id }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Applied For</div>
                        <div class="applicat_cust-value" id="previewEngagementType"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value" id="previewName">{{ Auth::user()->name }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Gender</div>
                        <div class="applicat_cust-value" id="previewGender"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                        <div class="applicat_cust-value" id="previewFnameHname"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value" id="previewDob">{{ Auth::user()->date_of_birth }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Contact Number</div>
                        <div class="applicat_cust-value" id="previewMobileNo">{{ Auth::user()->mobile }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value" id="previewEmail">{{ Auth::user()->email }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Spouse Name</div>
                        <div class="applicat_cust-value" id="previewSpouseName"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Spouse Number</div>
                        <div class="applicat_cust-value" id="previewSpouseNo"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Correspondence Address</div>
                        <div class="applicat_cust-value" id="previewCaddress"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Pin Code</div>
                        <div class="applicat_cust-value" id="previewPincode"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Permanent Address</div>
                        <div class="applicat_cust-value" id="previewPaddress"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Resume/CV</div>
                        <div class="applicat_cust-value" id="previewCv"></div>
                    </div>
                </div>
                <h4 class="applicat_cust-title mt-3">Education Qualification</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Qualification
                                </th>
                                <th scope="col">
                                    Board/University/Collage
                                </th>
                                <th scope="col">
                                    Main Subject/Stream
                                </th>
                                <th scope="col">
                                    Course Mode
                                </th>
                                <th scope="col">
                                    Passing Year
                                </th>
                                <th scope="col">
                                    Percentage
                                </th>
                                <th scope="col">
                                    Marksheet/Degree
                                </th>
                            </tr>
                        </thead>
                        <tbody id="preEdu">
                        </tbody>
                    </table>
                </div>
                <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Employer/Organization Name
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
                                    Nature of Duites
                                </th>
                                <th scope="col">
                                    Job Type
                                </th>
                                <th scope="col">
                                    Experience Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody id="preWorkExp">
                        </tbody>
                    </table>
                </div>
                
                <h4 class="applicat_cust-title mt-3">Competitive Exam Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Name of Exam
                                </th>
                                <th scope="col">
                                    Score
                                </th>
                                <th scope="col">
                                    Appearing Year
                                </th>
                                <th scope="col">
                                    Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody id="preCompetDetails">
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Additional Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Award/Achievement Name
                                </th>
                                <th scope="col">
                                    Award/Achievement Details
                                </th>
                                <th scope="col">
                                    Award/Achievement Certificate
                                </th>
                                <th scope="col">
                                </th>
                            </tr>
                        </thead>
                        <tbody id="preAddDetails">
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Training Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Name of Training/Certifications
                                </th>
                                <th scope="col">
                                    Descriptions
                                </th>
                                <th scope="col">
                                    Training Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody id="preTrainCbody">
                        </tbody>
                    </table>

                </div>
                <div class="">
                    @include('resource-pool.Candidate.disclouser')
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection

@push('scripts')
    <script>
        window.hasEducation = {!! json_encode($sections['nhidcl_applicant_education_details']) !!};
        window.hasExperience = {!! json_encode($sections['nhidcl_applicant_work_experience_details']) !!};
        window.hasDisclosure = {!! json_encode($sections['nhidcl_disclouser_questions']) !!};
    </script>

    <script src="{{ asset('public/js/resource-pool/candidate/candidate.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/candidate/candidate-tab.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/candidate/disclouser.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
@endpush
