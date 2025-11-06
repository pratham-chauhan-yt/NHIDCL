@extends('layouts.dashboard')

@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Edit /Employee Details</div>
        <div class="plain_dlfex bg_elips_ic">
        <a href="{{ route('recruitment.viewEmpJoiningApplication') }}"><button class="hover-effect-btn fill_btn" type="button">Back
        </button></a>
        </div>
    </div>
</div>

<div class="inner_page_dash__">

        @if (count($errors) > 0)

        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        @endif

                <div class="my-4 ">
                    <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            Edit/Employee Joining
                        </button>
                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Edit Joining Details</div>
                        </div>

                        {!! Form::open([
                            'route' => 'recruitment.updateEmployeeDetails',
                            'method' => 'POST',
                        ]) !!}

                        <!-- <form class="form_grid_cust" method="POST" action="recruitment.updateEmployeeDetails"> -->
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">

                                <div>
                                    <label  class="">First Name</label>
                                    <input type="text" class="" name="first_name" id="first_name" value="{{$emplist->first_name}}">
                                    <input type="hidden" class="form-control" name="id" id="id" value="{{ $emplist->id }}">
                                </div>

                                <div>
                                    <label  class="">Last Name</label>
                                    <input type="text" class="" name="last_name" id="last_name" value="{{$emplist->last_name}}">
                                </div>

                                <div>
                                    <label  class="">Date of Birth</label>
                                    <input type="date"  name="date_of_birth" id="date_of_birth" value="{{$emplist->date_of_birth}}"> 
                                </div>

                                <div>
                                    <label  class="">Correspondence Address</label>
                                    <input type="text" class="" name="address" id="address" value="{{$emplist->address}}">
                                </div>

                                <div class="">
                                    <label class="">Employment Type</label>
                                    <select class="" name="employment_type" class="form-select" id="employment_type">
                                        <option value="Contract">Contract</option>
                                        <option value="Direct">Direct</option>
                                        <option value="Deputation">Deputation</option>
                                        <option value="Outsource">Outsource</option>
                                        <option value="Direct recruitment/Lateral recruitment">Direct recruitment/Lateral recruitment</option>
                                    </select>
                                </div>

                                <div>
                                    <label  class="">Mobile Number</label>
                                    <input type="text" class="" name="mobile_number" id="mobile_number" value="{{$emplist->mobile_number}}">
                                </div>

                                <div>
                                    <label  class="">Assigned Job Position</label>
                                    <input type="text" class="" name="assigned_job_position" id="assigned_job_position" value="{{$emplist->assigned_job_position}}">
                                </div>

                                <div>
                                    <label  class="">KRA’s</label>
                                    <input type="text" class="" name="kras" id="kras" value="{{$emplist->kras}}">
                                </div>

                                <div>
                                    <label  class="">Employee Policies</label>
                                    <input type="text" class="" name="employee_policies" id="employee_policies" value="{{$emplist->employee_policies}}">
                                </div>

                                <div class="">
                                    <label class="">Gender</label>
                                    <select class="" name="gender" class="form-select" id="gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label class="">Nationality</label>
                                    <select class="" name="nationality" class="form-select" id="nationality">
                                        <option value="Indian">Indian</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label class="">Marital Status</label>
                                    <select class="" name="marital_status" class="form-select" id="marital_status">
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Divorced">Divorced</option>
                                        <option value="Widowed">Widowed</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>

                                <div>
                                    <label  class="">Email Address</label>
                                    <input type="email" class="" name="email_address" id="email_address" value="{{$emplist->email_address}}">
                                </div>

                                <div>
                                    <label  class="">Residential Address</label>
                                    <input type="text" class="" name="residential_address" id="residential_address" value="{{$emplist->residential_address}}">
                                </div>

                                <div>
                                    <label  class="">Current Designation</label>
                                    <input type="text" class="" name="current_designation" id="current_designation" value="{{$emplist->current_designation}}">
                                </div>

                                <div class="">
                                    <label class="">Department</label>
                                    <select class="" name="department_id" class="form-select" id="department_id">
                                        <option value="">Choose</option>
                                        @foreach($department as $val)
                                        <option value="{{ $val->id }}">{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label  class="">Joining Date</label>
                                    <input type="date"  name="joining_date" id="joining_date" value="{{$emplist->joining_date}}"> 
                                </div>

                                <div class="">
                                    <label class="">Employment Status</label>
                                    <select class="" name="employment_status" class="form-select" id="employment_status">
                                        <option value="">Choose</option>
                                        <option {{ old('employment_status') == '1' ? 'selected' : '' }} value="1">Active</option>
                                        <option {{ old('employment_status') == '2' ? 'selected' : '' }} value="2">De-active</option>
                                    </select>
                                </div>

                                <div>
                                    <label  class="">Job Role Description</label>
                                    <input type="text" class="" name="job_role_description" id="job_role_description" value="{{$emplist->job_role_description}}">
                                </div>

                            </div>

                            <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="submit">Update</button>
                            </div>
                        <!-- </form> -->

                        {!! Form::close() !!}
                    </div>

                </div>
</div>
@endsection
