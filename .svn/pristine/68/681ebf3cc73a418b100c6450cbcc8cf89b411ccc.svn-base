@extends('layouts.dashboard')
@section('dashboard_content')

    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Edit User Details</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('user-config.view') }}"><button type="button"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('employer_details', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                    Organization Details
                </button>
                <button class="tablink" onclick="openPage('Home', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Personal Details
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                    </svg>
                    Education Details
                </button>
                <button class="tablink" onclick="openPage('work', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                    </svg>

                    Work Experience Details
                </button>
                <button class="tablink" onclick="openPage('additional', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>

                    Additional Details
                </button>
                <button class="tablink" onclick="openPage('application', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Application Preview
                </button>
            </div>

            @if (count($errors) > 0)
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            @endif

            <div id="employer_details" class="tabcontent">
                <form class="form_grid_cust" action="{{ route('user-config.update', Crypt::encrypt($user->id)) }}"
                    method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">{{ __('ID') }}</label>
                            <input type="text" class="form-control" value="{{ $user->id ?? '' }}" disabled>
                        </div>

                        <div class="">
                            <label class="required-label" for="name">{{ __('Name') }}</label>
                            <input type="text" name="name" class="form-control" value="{{ $user->name ?? '' }}" disabled>
                        </div>

                        <div class="">
                            <label class="required-label">{{ __('Email') }}</label>
                            <input type="text" class="form-control" value="{{ $user->email ?? '' }}" disabled>
                        </div>

                        <div class="">
                            <label for="" class="form-label aster">{{ __('Is NHIDCL Employee') }}</label>
                            <select name="is_nhidcl_employee" class="form-select" id="is_nhidcl_employee" required>
                                <option value="">{{ __('Choose...') }}</option>
                                <option {{ old('is_nhidcl_employee', $user->is_nhidcl_employee) == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                                <option {{ old('is_nhidcl_employee', $user->is_nhidcl_employee) == '0' ? 'selected' : '' }}
                                    value="0">No
                                </option>
                            </select>
                        </div>

                        <div class="">
                            <label class="">Employee ID</label>
                            <input type="text" class="" placeholder="NHIDCL Employee ID" name="user_code"
                                id="user_code" value="{{ old('user_code', $user->user_code) }}" maxlength="100">
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Designation') }}</label>
                            <select name="ref_designation_id" class="form-select" id="ref_designation_id">
                                <option value="">{{ __('Choose...') }}</option>
                                @foreach ($designation as $val)
                                    <option value="{{ $val->id }}"
                                        {{ old('ref_designation_id', $user->ref_designation_id) == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Department') }}</label>
                            <select name="ref_department_id" class="form-select" id="ref_department_id">
                                <option value="">{{ __('Choose...') }}</option>
                                @foreach ($department as $val)
                                    <option value="{{ $val->id }}"
                                        {{ old('ref_department_id', $user->ref_department_id) == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Employee Type') }}</label>
                            <select name="ref_employee_type_id" class="form-select" id="ref_employee_type_id">
                                <option value="">{{ __('Choose...') }}</option>
                                @foreach ($employee_type as $val)
                                    <option value="{{ $val->id }}"
                                        {{ old('ref_employee_type_id', $user->ref_employee_type_id) == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Date of Joining') }}</label>
                            <input type="date" class="form-control" name="date_of_joining" id="date_of_joining"
                                value="{{ old('date_of_joining', $user->date_of_joining) }}">
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Date of Completion of Tenure') }}</label>
                            <input type="date" class="form-control" name="date_completion_tenure"
                                id="date_completion_tenure" value="{{ old('date_completion_tenure') }}">
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Place of Posting') }}</label>
                            <select name="place_of_posting[]"
                                class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none"
                                id="place_of_posting">
                                <option value="">Select Place of Posting</option>
                                <option value="1">Record of Previous Postings 1</option>
                                <option value="2">Record of Previous Postings 2</option>
                                <option value="3">Record of Previous Postings 3 </option>
                                <option value="4">Record of Previous Postings 4</option>
                                <option value="5">Record of Previous Postings 5</option>
                                <option value="6">Record of Previous Postings 6</option>

                            </select>
                        </div>


                        <div class="">
                            <label class="form-label aster">{{ __('Date of Posting') }}</label>
                            <input type="date" class="form-control" name="date_of_posting" id="date_of_posting"
                                value="{{ old('date_of_posting') }}">
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Office Type') }}</label>
                            <select name="ref_office_type_id" class="form-select" id="ref_office_type_id">
                                <option value="">{{ __('Choose...') }}</option>
                                @foreach ($office_type as $val)
                                    <option value="{{ $val->id }}"
                                        {{ old('ref_office_type_id', $user->ref_office_type_id) == $val->id ? 'selected' : '' }}>
                                        {{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="">
                            <label class="form-label aster">{{ __('Applicant Posted') }}</label>
                            <select name="state_id" class="form-select" id="state_id">
                                <option value="">{{ __('Choose...') }}</option>
                                @foreach ($state as $val)
                                    <option value="{{ $val->id }}" {{ $val->id == $user->currently_posted ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>

                    <div class=" inner_page_dash__ mt-[20px]">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages">
                            <h4 class="text-[18px] font-semibold">Assign Role</h4>
                        </div>

                        <div class="">
                            <div class="grid_rdit_page_user">
                                <div class="">
                                    <div class="Cust_toggle_edit">
                                        <label class="toggle-wrapper">
                                        </label>
                                    </div>
                                    <div class="border_check_box__">
                                        <p>Roles</p>
                                        <div
                                            class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-4 2xl:grid-cols-5 gap-1">
                                            @if ($roles->isNotEmpty())
                                                @foreach ($roles as $role)
                                                    <div class="custom_check_inline-item">
                                                        <input {{ $hasRoles->contains($role->id) ? 'checked' : '' }}
                                                            type="radio" id="role-{{ $role->id }}"
                                                            class="custom_check_inline-checkbox" name="role[]"
                                                            value="{{ $role->name }}">
                                                        <label class="custom_check_inline-label"
                                                            for="role-{{ $role->id }}">{{ $role->name }}</label>

                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn">{{ __('Update') }}</button>
                        <button type="button" class="hover-effect-btn fill_btn"
                            onclick="confirmResetPassword()">{{ __('Reset Password') }}</button>
                    </div>
                </form>
            </div>

            <div id="Home" class="tabcontent">
                <form class="form_grid_cust">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="">Full Name</label>
                            <input type="text" class="" value="{{ $user->name }}"
                                placeholder="Your Full Name">
                        </div>
                        <div class="">
                            <label class="">Email</label>
                            <input type="email" class="" value="{{ $user->email }}" placeholder="Email">
                        </div>
                        <div class="">
                            <label class="">Mobile No</label>
                            <input type="text" class="" value="{{ $user->mobile }}" placeholder="Mobile No">
                        </div>

                        <div class="">
                            <label class="">Date of Birth</label>
                            <input type="date" class="">

                        </div>
                        <div class="">
                            <label class="">Gender</label>
                            <select class="">
                                <option>Male</option>
                                <option>Female</option>
                            </select>
                        </div>

                        <div class="">
                            <label for="" class="form-label aster">{{ __('Status') }}</label>
                            <select name="userid_status" class="form-select" id="userid_status" required>
                                <option value="">{{ __('Choose...') }}</option>
                                <option {{ old('userid_status') == '1' ? 'selected' : '' }} value="1">Active
                                </option>
                                <option {{ old('userid_status') == '2' ? 'selected' : '' }} value="2">
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <div class="">
                            <label class="">Correspondence Address</label>
                            <input type="text" class="" placeholder="Correspondence Address">
                        </div>
                        <div class="">
                            <label class="">Permanent Address</label>
                            <input type="text" class="" placeholder="Permanent Address">
                        </div>

                        <div class="">
                            <label class="">Upload Photo</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Certificate" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                        <div class="">
                            <label class="">Upload Signature</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Certificate" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                        <div class="">
                            <label class="">Upload CV</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Certificate" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>


                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="button">
                            Save & Next
                        </button>
                    </div>
                </form>

            </div>

            <div id="News" class="tabcontent">
                <form class="form_grid_cust">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="">Qualification</label>
                            <select class="">
                                <option>Select Qualification</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Course</label>
                            <select class="">
                                <option>Select Course</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Board / University / Collage</label>
                            <input type="text" class="" placeholder="Board / University / Collage">
                        </div>
                        <div class="">
                            <label class="">Main Subjects</label>
                            <textarea rows="1" class="" placeholder="Main Subjects"></textarea>
                        </div>
                        <div class="">
                            <label class="">Course Mode</label>
                            <select class="">
                                <option>Course Mode</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Passing Year</label>
                            <input type="text" class="" placeholder="Passing Year">
                        </div>
                        <div class="">
                            <label class="">CGPA (If applicable)</label>
                            <input type="text" class="" placeholder="CGPA">
                        </div>
                        <div class="">
                            <label class="">Percentage</label>
                            <input type="text" class="" placeholder="Percentage">
                        </div>
                        <div class="">
                            <label class="">Marksheet / Degree</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Marksheet / Degree" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn border_btn
                                    ">Add</button>
                        <button class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Course Mode
                                </td>
                                <td>
                                    2024
                                </td>
                                <td>
                                    89.2%
                                </td>
                                <td>
                                    Degree1
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div id="work" class="tabcontent">
                <form class="form_grid_cust">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="">Employer name</label>
                            <input type="text" class="" placeholder="Employer name">
                        </div>
                        <div class="">
                            <label class="">Current Employer?</label>
                            <select class="">

                                <option>Select Current Employer?</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Post Held</label>
                            <input type="text" class="" placeholder="Post Held">
                        </div>
                        <div class="">
                            <label class="">From Date</label>
                            <input type="date" class="">

                        </div>
                        <div class="">
                            <label class="">To Date</label>
                            <input type="date" class="">

                        </div>
                        <div class="">
                            <label class="">Nature of duties (in detail)</label>
                            <textarea rows="1" class="" placeholder="Nature of duties (in detail)"></textarea>

                        </div>
                        <div class="">
                            <label class="">Employer Details</label>
                            <select class="">

                                <option>Employer Details</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Select Your Job Type</label>
                            <select class="">

                                <option>Government Employee</option>
                                <option>Private Employee</option>
                                <option>Retired Government Employee</option>
                            </select>
                        </div>
                        <div class="">
                            <label class="">Experience Certificate</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Experience Certificate"
                                    disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button class="hover-effect-btn border_btn
                                    ">Add</button>
                        <button class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Course Mode
                                </td>
                                <td>
                                    2024
                                </td>
                                <td>
                                    89.2%
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="additional" class="tabcontent">
                <form class="form_grid_cust">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="">Award Name</label>
                            <input type="text" class="" placeholder="Award Name">
                        </div>

                        <div class="">
                            <label class="">Award Details</label>
                            <textarea rows="1" class="" placeholder="Award Details"></textarea>

                        </div>

                        <div class="">
                            <label class="">Award Certificate</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Certificate" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                        <div class="">
                            <label class="">Achievements</label>
                            <div class="flex gap-[10px]">
                                <input type="text" class="" placeholder="Upload Achievements" disabled>
                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" class="hidden">

                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

                        <button class="hover-effect-btn border_btn
                                    ">Add</button>
                        <button class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
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
                                    Award Name
                                </th>
                                <th scope="col">
                                    Award Details
                                </th>
                                <th scope="col">
                                    Award Certificate
                                </th>
                                <th scope="col">
                                    Achievements
                                </th>

                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Achievements1
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="application" class="tabcontent">
                <h4 class="applicat_cust-title">User Information</h4>
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value">{{$user->name ?? 'N/A'}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Gender</div>
                        <div class="applicat_cust-value">N/A</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                        <div class="applicat_cust-value">N/A</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value">{{$user->date_of_birth ?? 'N/A'}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Contact Number</div>
                        <div class="applicat_cust-value">{{$user->mobile ?? 'N/A'}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value">{{$user->email ?? 'N/A'}}</div>
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
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Course Mode
                                </td>
                                <td>
                                    2024
                                </td>
                                <td>
                                    89.2%
                                </td>
                                <td>
                                    Degree1
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
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
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Course Mode
                                </td>
                                <td>
                                    2024
                                </td>
                                <td>
                                    89.2%
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Employer Details</h4>
                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Employee Id
                                </th>
                                <th scope="col">
                                    Place of Posting
                                </th>
                                <th scope="col">
                                    Office Type
                                </th>
                                <th scope="col">
                                    Department
                                </th>

                                <th scope="col" class="">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td>
                                    ######
                                </td>
                                <td>
                                    Collage
                                </td>
                                <td>
                                    Main Subject
                                </td>
                                <td>
                                    Achievements1
                                </td>
                                <td>
                                    <a href="#">
                                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                            </path>
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="button_flex_cust_form">
                    <button class="hover-effect-btn fill_btn" type="button">Save</button>
                </div>
            </div>
        </div>

    </div>
@endsection
