@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View User Details</div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">

                <button class="tablink" onclick="openPage('application', this, '#373737')" id="defaultOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-480H200v480Zm280-80q-82 0-146.5-44.5T240-440q29-71 93.5-115.5T480-600q82 0 146.5 44.5T720-440q-29 71-93.5 115.5T480-280Zm0-60q56 0 102-26.5t72-73.5q-26-47-72-73.5T480-540q-56 0-102 26.5T306-440q26 47 72 73.5T480-340Zm0-100Zm0 60q25 0 42.5-17.5T540-440q0-25-17.5-42.5T480-500q-25 0-42.5 17.5T420-440q0 25 17.5 42.5T480-380Z"/></svg>
                    Profile Details
                </button>

                <button class="tablink" onclick="openPage('pdetails', this, '#373737')" id="defaultOpen1">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M720-240q25 0 42.5-17.5T780-300q0-25-17.5-42.5T720-360q-25 0-42.5 17.5T660-300q0 25 17.5 42.5T720-240Zm0 120q32 0 57-14t42-39q-20-16-45.5-23.5T720-204q-28 0-53.5 7.5T621-173q17 25 42 39t57 14Zm-520 0q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v268q-19-9-39-15.5t-41-9.5v-243H200v560h242q3 22 9.5 42t15.5 38H200Zm0-120v40-560 243-3 280Zm80-40h163q3-21 9.5-41t14.5-39H280v80Zm0-160h244q32-30 71.5-50t84.5-27v-3H280v80Zm0-160h400v-80H280v80ZM720-40q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Z"/></svg>
                    Personal Details
                </button>
                <button class="tablink" onclick="openPage('edudetails', this, '#373737')" id="defaultOpen2">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-120 200-272v-240L40-600l440-240 440 240v320h-80v-276l-80 44v240L480-120Zm0-332 274-148-274-148-274 148 274 148Zm0 241 200-108v-151L480-360 280-470v151l200 108Zm0-241Zm0 90Zm0 0Z"/></svg>
                    Educational Details
                </button>
                <button class="tablink" onclick="openPage('workdetails', this, '#373737')" id="defaultOpen4">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M480-340q33 0 56.5-23.5T560-420q0-33-23.5-56.5T480-500q-33 0-56.5 23.5T400-420q0 33 23.5 56.5T480-340ZM160-120q-33 0-56.5-23.5T80-200v-440q0-33 23.5-56.5T160-720h160v-80q0-33 23.5-56.5T400-880h160q33 0 56.5 23.5T640-800v80h160q33 0 56.5 23.5T880-640v440q0 33-23.5 56.5T800-120H160Zm0-80h640v-440H160v440Zm240-520h160v-80H400v80ZM160-200v-440 440Z"/></svg>
                    Work Experience Details
                </button>
            </div>
            @include('components.alert')
            <div id="application" class="tabcontent">
                <h4 class="applicat_cust-title">User Information</h4>
                <div class="applicat_cust-container table-responsive">
                    <table class="table table-bordered table-hover">
                        <tbody>
                            <tr>
                                <th>ID</th>
                                <td>{{$users->id ?? '0'}}</td>
                            </tr>
                            <tr>
                                <th>Name</th>
                                <td>{{$users->name ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Email Id</th>
                                <td>{{$users->email ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Mobile Number</th>
                                <td>{{$users->mobile ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $users->date_of_birth ? \Carbon\Carbon::parse($users->date_of_birth)->format('d-m-Y') : '' }}</td>
                            </tr>
                            @if(!empty($users?->designation))
                            <tr>
                                <th>Designation</th>
                                <td>{{$users?->designation?->name ?? ''}}</td>
                            </tr>
                            @endif
                            @if(!empty($users?->department))
                            <tr>
                                <th>Department</th>
                                <td>{{$users?->department?->name ?? ''}}</td>
                            </tr>
                            @endif
                            @if(!empty($users?->date_of_joining))
                            <tr>
                                <th>Date Of Joining</th>
                                <td>{{ $users->date_of_joining ? \Carbon\Carbon::parse($users->date_of_joining)->format('d-m-Y') : '' }}</td>
                            </tr>
                             @endif
                            @if(!empty($users?->address))
                            <tr>
                                <th>Address</th>
                                <td>{{$users->address ?? ''}}</td>
                            </tr>
                            @endif
                            <tr>
                                <th>Login Ip Address</th>
                                <td>{{$users->last_login_ip ?? ''}}</td>
                            </tr>
                            <tr>
                                <th>Login Date Time</th>
                                <td>{{ $users->last_login_at ? \Carbon\Carbon::parse($users->last_login_at)->format('d-m-Y H:i:s A') : '' }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="pdetails" class="tabcontent">
                <form id="personalDetailsForm" method="POST" action="{{ route('personal-details') }}" class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-group">
                            <label class="required-label">Full Name</label>
                            <input type="text" id="full_name" name="full_name" value="{{ @Auth::user()->name }}" class="full_name" placeholder="Your Full Name" data-validate="required" data-error="Please enter employee full name." readonly>
                            <span id="full_name_err" class="candidateErr">
                                @if ($errors->has('full_name'))
                                    {{ $errors->first('full_name') }}
                                @endif
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Father's/Husband's Name</label>
                            <input type="text" id="father_husband_name" name="father_husband_name"
                                class="father_husband_name" placeholder="Father's/Husband's Name"
                                value="{{ old('father_husband_name') }}" data-validate="required" data-error="Please enter father`s/husband`name name.">
                            <span id="father_husband_name_err" class="candidateErr">
                                @if ($errors->has('father_husband_name'))
                                    {{ $errors->first('father_husband_name') }}
                                @endif
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Email</label>
                            <input type="email" id="email" name="email" class="email" placeholder="Email"
                                value="{{ @Auth::user()->email }}" data-validate="required" data-error="Please enter email address." readonly>
                            <span id="email_err" class="candidateErr">
                                @if ($errors->has('email'))
                                    {{ $errors->first('email') }}
                                @endif
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Mobile No</label>
                            <input type="text" id="mobile_no" name="mobile_no" class="mobile_no"
                                placeholder="Mobile No" value="{{ @Auth::user()->mobile }}" data-validate="required" data-error="Please enter mobile number." readonly>
                            <span id="mobile_no_err" class="candidateErr">
                                @if ($errors->has('mobile_no'))
                                    {{ $errors->first('mobile_no') }}
                                @endif
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="required-label">Date of Birth</label>
                            <input type="date" id="date_of_birth" name="date_of_birth" class="date_of_birth"
                                value="{{ @Auth::user()->date_of_birth }}" data-validate="required" data-error="Please choose date of birth." readonly>
                            <span id="date_of_birth_err" class="candidateErr">
                                @if ($errors->has('date_of_birth'))
                                    {{ $errors->first('date_of_birth') }}
                                @endif
                            </span>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Gender</label>
                            <select id="gender" name="gender" class="gender" data-validate="required" data-error="Please choose your gender.">
                                <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                            </select>
                            <span id="gender_err" class="candidateErr">
                                @if ($errors->has('gender'))
                                    {{ $errors->first('gender') }}
                                @endif
                            </span>
                        </div>

                        <div class="form-group">
                            <label class="required-label">Address</label>
                            <textarea name="address" id="address" class="address" placeholder="Permanent Address" data-validate="required" data-error="Please enter complete address.">{{ old('address') }}</textarea>
                            <span id="permanent_address_err" class="candidateErr">
                                @if ($errors->has('permanent_address'))
                                    {{ $errors->first('permanent_address') }}
                                @endif
                            </span>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Photo (<small>Max size 2MB & file should be jpg, png only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input id="upload_profile_txt" name="upload_profile_txt" type="text" class="upload_profile_txt" placeholder="Upload profile picture" data-validate="required" data-error="Please upload profile picture." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                    Upload File
                                    <input type="file"
                                        name="upload_profile"
                                        class="hidden file-uploader"
                                        accept=".jpg, .jpeg, .png"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_profile_txt"
                                        data-preview-wrapper="profile_preview"
                                        data-hidden-input="upload_profile_hidden"
                                        data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                        data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                </label>
                                <input type="hidden" name="upload_profile_hidden" id="upload_profile_hidden">
                            </div>
                            <div id="profile_preview"></div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload Signature (<small>Max size 2MB & file should be jpg, png only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input id="upload_signature_txt" name="upload_signature_txt" type="text" class="upload_signature_txt" placeholder="Upload signature" data-validate="required" data-error="Please upload signature picture." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                    Upload File
                                    <input type="file"
                                        name="upload_signature"
                                        class="hidden file-uploader"
                                        accept=".jpg, .jpeg, .png"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_signature_txt"
                                        data-preview-wrapper="signature_preview"
                                        data-hidden-input="upload_signature_hidden"
                                        data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                        data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                </label>
                                <input type="hidden" name="upload_signature_hidden" id="upload_signature_hidden">
                            </div>
                            <div id="signature_preview"></div>
                        </div>

                        <div class="attachment_advertisement attachment_section_photos">
                            <label class="required-label">Upload DOB Proof (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input id="upload_dob_proof_txt" name="upload_dob_proof_txt" type="text" class="upload_dob_proof_txt" placeholder="Upload date of birth proof document" data-validate="required" data-error="Please upload date of birth proof." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                    Upload File
                                    <input type="file"
                                        name="upload_dob_proof"
                                        class="hidden file-uploader"
                                        accept=".jpg, .jpeg, .png"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_dob_proof_txt"
                                        data-preview-wrapper="dob_proof_preview"
                                        data-hidden-input="upload_dob_proof_hidden"
                                        data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                        data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                </label>
                                <input type="hidden" name="upload_dob_proof_hidden" id="upload_dob_proof_hidden">
                            </div>
                            <div id="dob_proof_preview"></div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button id="personalDetailsSaveBtn" class="hover-effect-btn fill_btn" type="button">
                            Save & Next
                        </button>
                    </div>
                </form>
            </div>

            <div id="edudetails" class="tabcontent">
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

            <div id="workdetails" class="tabcontent">
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
        </div>
    </div>
@endsection
@push('scripts')

    <script src="{{ asset('public/js/select2.min.js') }}"></script>
@endpush