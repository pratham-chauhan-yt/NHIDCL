@extends('layouts.dashboard')
@section('dashboard_content')

<!-- <div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Applicant Profile</div>
        <div class="plain_dlfex bg_elips_ic">
            <select name="Date" id="date">
                <option value="Today">{{date('d-m-Y', strtotime(now()));}}</option>
            </select>
        </div>
    </div>
</div> -->

<div id="loader"></div>
<div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c mb-[20px]">
                        <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen1" >
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>

                            Personal Details
                        </button>
                        <button class="tablink" onclick="openPage('News', this, '#373737')" id="defaultOpen2">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>

                            Education Details
                        </button>
                        <button class="tablink" onclick="openPage('work', this, '#373737')" id="defaultOpen3">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>

                            Work Experience Details
                        </button>
                        <button class="tablink" onclick="openPage('additional', this, '#373737')" id="defaultOpen4">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>

                            Additional Details
                        </button>
                        <button class="tablink" onclick="openPage('application', this, '#373737')" id="defaultOpen5">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>

                            Application Preview
                        </button>

                    </div>


                    <div id="Home" class="tabcontent">
                        <form id="personalDetailsForm" method="POST" action="{{route('personal-details')}}" class="form_grid_cust" enctype="multipart/form-data">
                            @csrf
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="">Full Name*</label>
                                    <input type="text" id="full_name" name="full_name" value="{{ Auth::user()->name }}"  class="full_name" placeholder="Your Full Name" required="true" readonly>
                                    <span id="full_name_err" class="candidateErr">
                                    @if($errors->has('full_name'))
                                        {{ $errors->first('full_name') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="">
                                    <label  class="">Father's/Husband's Name*</label>
                                    <input type="text"  id="father_husband_name" name="father_husband_name" class="father_husband_name"
                                     placeholder="Father's/Husband's Name" value="{{ old('father_husband_name') }}">
                                    <span id="father_husband_name_err" class="candidateErr">
                                    @if($errors->has('father_husband_name'))
                                        {{ $errors->first('father_husband_name') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="">
                                    <label class="">Email*</label>
                                    <input type="email"  id="email" name="email" class="email" placeholder="Email" value="{{ Auth::user()->email }}" readonly>
                                    <span id="email_err" class="candidateErr">
                                    @if($errors->has('email'))
                                        {{ $errors->first('email') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="">
                                    <label  class="">Mobile No*</label>
                                    <input type="text"  id="mobile_no" name="mobile_no" class="mobile_no" placeholder="Mobile No"  value="{{ Auth::user()->mobile }}" readonly>
                                    <span id="mobile_no_err" class="candidateErr">
                                    @if($errors->has('mobile_no'))
                                        {{ $errors->first('mobile_no') }}
                                    @endif
                                    </span>
                                </div>
                                   
                                <div class="">
                                    <label  class="">Date of Birth*</label>
                                    <input type="date"   id="date_of_birth" name="date_of_birth" class="date_of_birth"  value="{{ Auth::user()->date_of_birth }}"  readonly>
                                    <span id="date_of_birth_err" class="candidateErr">
                                    @if($errors->has('date_of_birth'))
                                        {{ $errors->first('date_of_birth') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="">
                                    <label class="">Gender*</label>
                                    <select  id="gender" name="gender" class="gender"  >
                                        <option value="male" {{ old('gender') === 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ old('gender') === 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                    <span id="gender_err" class="candidateErr">
                                    @if($errors->has('gender'))
                                        {{ $errors->first('gender') }}
                                    @endif
                                    </span>
                                </div>

                                <div class="">
                                    <label  class="">Correspondence Address*</label>
                                    <input type="text"  id="correspondence_address" name="correspondence_address" class="correspondence_address" placeholder="Correspondence Address" value="{{ old('correspondence_address') }}">
                                    <span id="correspondence_address_err" class="candidateErr">
                                        @if($errors->has('correspondence_address'))
                                            {{ $errors->first('correspondence_address') }}
                                        @endif
                                    </span>
                                </div>
                                <div class="">
                                    <label  class="">Permanent Address*</label>
                                    <input type="text"  id="permanent_address" name="permanent_address" class="permanent_address"  placeholder="Permanent Address" value="{{ old('permanent_address') }}">
                                    <div class="flex items-start">
                                        <div class="flex items-center h-5 inpus_cust_cs">
                                                <input type="checkbox" class="w-4 h-4" id="forSame">
                                        </div>
                                        &nbsp;&nbsp;<span style="font-size: 10px;">check if same</span>
                                    </div>
                                    <span id="permanent_address_err" class="candidateErr">
                                    @if($errors->has('permanent_address'))
                                        {{ $errors->first('permanent_address') }}
                                    @endif
                                    </span>
                                </div>

                                <div class="attachment_section_photos attachment_preview">
                                    <label  class="">Upload Photo*(<span style="font-size: 10px;">Max size 2MB</span>)</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text"  id="upload_photoss" name="upload_photoss" class="upload_photoss" placeholder="Upload Photo" >
                                        <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos"> Upload File
                                            <input id="upload_photos"  type="file" name="upload_photos" class="hidden upload_photos"  value="">
                                        </label>
                                    </div>
                                    <span id="upload_photos_err" class="candidateErr">
                                    @if($errors->has('upload_photos'))
                                        {{ $errors->first('upload_photos') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="attachment_section_sign attachment_preview">
                                    <label  class="">Upload Signature*(<span style="font-size: 10px;">Max size 2MB</span>)</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" id="upload_signaturee" name="upload_signaturee" class="" placeholder="Upload Signature" >
                                        <label class="upload_cust mb-0 hover-effect-btn hide_upload_signature"> Upload File
                                            <input  name="upload_signature" id="upload_signature"  type="file" class="hidden upload_signature" >

                                        </label>
                                    </div>
                                    <span id="upload_signature_err" class="candidateErr">
                                    @if($errors->has('upload_signature'))
                                        {{ $errors->first('upload_signature') }}
                                    @endif
                                    </span>
                                </div>
                                <div class="attachment_section_resume attachment_preview">
                                    <label  class="">Upload CV*(<span style="font-size: 10px;">Max size 2MB</span>)</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" id="upload_resumee" name="upload_resumee" class="" placeholder="Upload CV" >
                                        <label class="upload_cust mb-0 hover-effect-btn hide_upload_resume"> Upload File
                                            <input id="upload_resume" name="upload_resume"  class="upload_resume"   type="file" class="hidden" >
                                        </label>
                                    </div>
                                    <span id="upload_resume_err" class="candidateErr">
                                        @if($errors->has('upload_resume'))
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

                    <div id="News" class="tabcontent">
                        <form id="educationalDetailsForm" method="POST" action="{{route('educational-details')}}" class="form_grid_cust" enctype="multipart/form-data">
                            @csrf
                            <div id="educationalDetailsFormPrep">
                                <div class="inpus_cust_cs form_grid_dashboard_cust_" id="eduDevAdd_0">
                                    <div class="">
                                        <label  class="">Qualification*</label>
                                        <select id="qualification"  name="qualification[]" class="">
                                            <option value="">Select Qualification</option>
                                            <option value="PHD">PHD</option>
                                            <option value="post_graduation">Post Graduation</option>
                                            <option value="graduation">Under Graduation</option>
                                        </select>
                                        <span class="qualification_err candidateErr">
                                            @error('qualification.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Course*</label>
                                        <select id="course"  name="course[]" class="">

                                            <option value="">Select Course</option>
                                            <option value="PHD">PHD</option>
                                            <option value="MA">M.A</option>
                                            <option value="MCOM">M.Com</option>
                                            <option value="MSC">M.Sc</option>
                                            <option value="MCA">MCA</option>
                                            <option value="MBA">MBA</option>
                                            <option value="BA">B.A</option>
                                            <option value="BCOM">B.Com</option>
                                            <option value="BSC">B.Sc</option>
                                            <option value="BCA">BCA</option>
                                            <option value="BBA">BBA</option>
                                            <option value="BTECH">B.tech</option>
                                            <option value="MBBS">MBBS</option>
                                            <option value="LLB">L.L.B</option>
                                        </select>
                                        <span class="course_err candidateErr">
                                            @error('course.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Board / University / Collage*</label>
                                        <input type="text" id="board_university_collage"  name="board_university_collage[]" class="" 
                                            placeholder="Board / University / Collage">
                                        <span class="board_university_collage_err candidateErr">
                                            @error('board_university_collage.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Main Subjects*</label>
                                        <textarea  rows="1"  id="main_subject" name="main_subject[]" class="" placeholder="Main Subjects"></textarea>
                                        <span class="main_subject_err candidateErr">
                                            @error('main_subject.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Course Mode*</label>
                                        <select id="course_mode"  name="course_mode[]"  class="">
                                            <option value="">Select Course Mode</option>
                                            <option value="distance">Distance Mode</option>
                                            <option value="Regular">Regular Mode</option>
                                        </select>
                                        <span class="course_mode_err candidateErr">
                                            @error('course_mode.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Passing Year*</label>
                                        <input type="text" id="passing_year"  name="passing_year[]" class=""
                                            placeholder="Passing Year">
                                        <span class="passing_year_err candidateErr">
                                        @error('passing_year.*')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">CGPA (If applicable)</label>
                                        <input type="text" id="cgpa"  name="cgpa[]" class=""
                                            placeholder="CGPA">
                                        <span class="cgpa_err candidateErr">
                                        @error('cgpa.*')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Percentage*</label>
                                        <input type="text" id="percentage"  name="percentage[]" class=""
                                            placeholder="Percentage">
                                        <span class="percentage_err candidateErr">
                                        @error('percentage.*')
                                            <div class="error">{{ $message }}</div>
                                        @enderror
                                        </span>
                                    </div>
                                    <div class="attachment_section_marksheet_degree attachment_preview">
                                        <label  class="">Marksheet / Degree* (<span style="font-size: 10px;">Max size 2MB</span>)</label>
                                        <div class="flex gap-[10px]">
                                            <input type="text" id="marksheet_degreee0" name="marksheet_degreee[]" class="marksheet_degreee"
                                                placeholder="Upload Marksheet / Degree">
                                            <label class="upload_cust mb-0 hover-effect-btn hide_marksheet_degree"> Upload File
                                                <input  type="file" id="marksheet_degree[]"  name="marksheet_degree[]" class="hidden marksheet_degree" >

                                            </label>
                                        </div>
                                        <span class="marksheet_degree_err candidateErr">
                                            @error('marksheet_degree.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="button_flex_cust_form">

                                <button class="hover-effect-btn border_btn" id="educationAddBtn" type="button">Add</button>
                                <button id="educationalDetailsBtn1" class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                                            Board/ University/ Collage
                                        </th>
                                        <th scope="col">
                                            Main Subject
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
                                    <!-- <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="work" class="tabcontent">
                        <form id="workExperienceDetailsForm" method="POST" action="{{route('work-experience-details')}}" class="form_grid_cust" enctype="multipart/form-data">
                            @csrf
                            <div class="workExperienceDetailsRow">
                                <div class="inpus_cust_cs form_grid_dashboard_cust_ workExpAdDev">
                                    <div class="">
                                        <label  class="">Employer name</label>
                                        <input id="employer_name" name="employer_name[]" type="text" class=""
                                            placeholder="Employer name" value="{{old('employer_name.0') ?? '' }}">
                                        <span id="employer_name_err" class="candidateErr employer_name_err">
                                            @error('employer_name.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <!----------- Commenting this field because i think this is duplicate----- -->
                                    <!-- <div class=""> 
                                        <label  class="">Current Employer?</label>
                                        <select id="current_employer" name="current_employer"  class="">

                                            <option>Select Current Employer?</option>
                                        </select>
                                    </div> -->
                                    <div class="">
                                        <label  class="">Post Held</label>
                                        <input type="text" id="post_held" name="post_held[]" class=""
                                            placeholder="Post Held" value="{{old('post_held.0') ?? '' }}">
                                        <span id="post_held_err" class="candidateErr post_held_err">
                                            @error('post_held.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">From Date</label>
                                        <input type="date" id="from_date" name="from_date[]"  class="">
                                        <span id="from_date_err" class="candidateErr from_date_err">
                                            @error('from_date.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">To Date</label>
                                        <input type="date"  id="to_date" name="to_date[]" class="">
                                        <span id="to_date_err" class="candidateErr to_date_err" value="{{old('to_date.0')}}">
                                            @error('to_date.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Nature of duties (in detail)</label>
                                        <textarea  rows="1" class="" id="nature_of_duties" name="nature_of_duties[]"
                                            placeholder="Nature of duties (in detail)" >{{old('nature_of_duties.0')}}</textarea>
                                        <span id="nature_of_duties_err" class="candidateErr nature_of_duties_err">
                                            @error('nature_of_duties.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Employer Details</label>
                                        <textarea rows="1" id="employer_details" name="employer_details[]" class="" 
                                        placeholder="Employer Details" >{{old('employer_details.0')}}</textarea>
                                        <span id="employer_details_err" class="candidateErr employer_details_err">
                                            @error('employer_details.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="">
                                        <label  class="">Select Your Job Type</label>
                                        <select id="job_type" name="job_type[]" class="">
                                            <option value="">Select Job Type</option>
                                            <option value="GOVT" {{ in_array('GOVT', old('job_type', [])) ? 'selected' : '' }}>Government Employee</option>
                                            <option value="PRIVATE" {{ in_array('GOVT', old('job_type', [])) ? 'selected' : '' }}>Private Employee</option>
                                            <option value="RTGOVT" {{ in_array('GOVT', old('job_type', [])) ? 'selected' : '' }}>Retired Government Employee</option>
                                        </select>
                                        <span id="job_type_err" class="candidateErr job_type_err">
                                            @error('job_type.*')
                                                <div class="error">{{ $message }}</div>
                                            @enderror
                                        </span>
                                    </div>
                                    <div class="attachment_section_experience_certificate attachment_preview">
                                        <label  class="">Experience Certificate</label>
                                        <div class="flex gap-[10px]">
                                            <input type="text" id="experience_certificatee[]" name="experience_certificatee[]"  class="experience_certificatee"
                                                placeholder="Upload Experience Certificate">
                                            <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                                <input  id="experience_certificate[]" name="experience_certificate[]" type="file" class="hidden experience_certificate" >

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

                                <button id="workExpAddMoreBtn"  type="button" class="hover-effect-btn border_btn
                                    ">Add</button>
                                <button id="workExperienceDetailsBtn" class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                                            Experience
                                        </th>
                                        <th scope="col">
                                            Nature of Duites
                                        </th>
                                        <th scope="col">
                                            Employer Type
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
                                    <!-- <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="additional" class="tabcontent">
                    
                        <form id="additionalDetailsForm" method="POST" action="{{route('additional-details')}}" class="form_grid_cust" enctype="multipart/form-data">
                            @csrf
                           <div class="additionalDetailsRow">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Award/Achievement Name</label>
                                    <input type="text" id="award_name" name="award_name[]" class=""
                                        placeholder="Award Name">
                                    <span id="award_name_err" class="candidateErr award_name_err">
                                        @if($errors->has('award_name'))
                                            {{ $errors->first('award_name') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="">
                                    <label  class="">Award/Achievement Details</label>
                                    <textarea  rows="1"  id="award_details" name="award_details[]" class="" placeholder="Award Details"></textarea>
                                    <span id="award_details_err" class="candidateErr award_details_err">
                                        @if($errors->has('award_details'))
                                            {{ $errors->first('award_details') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="attachment_section_award_certificate attachment_preview">
                                    <label  class="">Award/Achievement Certificate</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text"  id="award_certificatee" name="award_certificatee[]"
                                            placeholder="Upload Certificate" class="award_certificatee">
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" id="award_certificate" name="award_certificate[]" class="hidden award_certificate" >

                                        </label>
                                    </div>
                                    <span id="award_certificate_err" class="candidateErr award_certificate_err">
                                        @if($errors->has('award_certificate'))
                                            {{ $errors->first('award_certificate') }}
                                        @endif
                                    </span>
                                </div>
                                <!-- <div class="attachment_section_achievements attachment_preview">
                                    <label  class="">Achievements</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" id="achievementss" 
                                            placeholder="Upload achievements" name="achievementss[]" class="achievementss">
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" id="achievements" name="achievements[]" class="hidden achievements" >

                                        </label>
                                    </div>
                                    <span id="achievements_err" class="candidateErr achievements_err">
                                        @if($errors->has('achievements'))
                                            {{ $errors->first('achievements') }}
                                        @endif
                                    </span>
                                </div> -->
                            </div>
                           </div>
                            <div class="button_flex_cust_form">

                                <button type="button" id="additionalDetailsAddMoreBtn" class="hover-effect-btn border_btn additionalDetailsAddMoreBtn
                                    ">Add</button>
                                <button id="additionalDetailsBtn" class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                                            <!-- Achievements         -->
                                        </th>

                                        <th scope="col" class="">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="additTbody">
                                    <!-- <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                          
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div id="application" class="tabcontent">
                        <h4 class="applicat_cust-title">User Information</h4>
                        <div class="applicat_cust-container">
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Name</div>
                                <div class="applicat_cust-value" id="previewName"></div>
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
                                <div class="applicat_cust-value" id="previewDob"></div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Contact Number</div>
                                <div class="applicat_cust-value" id="previewMobileNo"></div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Email</div>
                                <div class="applicat_cust-value" id="previewEmail"></div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Correspondence Address</div>
                                <div class="applicat_cust-value" id="previewCaddress"></div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Permanent Address</div>
                                <div class="applicat_cust-value" id="previewPaddress"></div>
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
                                            Board/ University/ Collage
                                        </th>
                                        <th scope="col">
                                            Main Subject
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
                                <tbody id="preEdu">
                                    <!-- <tr>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
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
                                            Employer Name
                                        </th>
                                        <th scope="col">
                                            Post Held
                                        </th>
                                        <th scope="col">
                                            Experience
                                        </th>
                                        <th scope="col">
                                            Nature of Duites
                                        </th>
                                        <th scope="col">
                                            Employer Type
                                        </th>
                                        <th scope="col">
                                            Experience Certificate
                                        </th>
                                        <th scope="col" class="">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="preWorkExp">
                                    <!-- <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                          
                                        </td>
                                        <td>
                                           
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <h4 class="applicat_cust-title mt-3">Addittional Details</h4>
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
                                            <!-- Achievements -->
                                        </th>

                                        <th scope="col" class="">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="preAddDetails">
                                    <!-- <tr>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                        
                                        </td>
                                        <td>
                                            
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                        <!-- <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="button">Save</button>
                        </div> -->
                    </div>
                </div>
</div>
</div>

@include("applicant.js.candidate")
@include("applicant.js.candidate-tab")
@endsection