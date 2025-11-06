@include('shared.header')
@extends('layouts.app')

@section('content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Recruitment</div>
    </div>
</div>

        <div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            Candidate Basic Details
                        </button>
                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Add Basic Details</div>
                        </div>

                        <form class="form_grid_cust" method="POST" action="{{route('recruitment.basicDetailsStore')}}" enctype="multipart/form-data" id="basicDetails">
                        @csrf
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">

                                <div>
                                    <label  class="">First Name</label>
                                    <input type="text" class="" name="first_name" id="first_name" value="{{ $CandidateList->first_name }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Last Name</label>
                                    <input type="text" class="" name="last_name" id="last_name" value="{{ $CandidateList->last_name }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Mobile Number</label>
                                    <input type="text" class="" name="mobile_number" id="mobile_number" value="{{ $CandidateList->mobile_number }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Email</label>
                                    <input type="email" class="" name="email_id" id="email_id" value="{{ $CandidateList->email_id }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Date of Birth</label>
                                    <input type="date"  name="date_of_birth" id="date_of_birth" value="{{ $CandidateList->date_of_birth }}" required="true"/> 
                                </div>

                                <div>
                                    <label  class="">Residential Address</label>
                                    <input type="text" class="" name="address" id="address" value="{{ $CandidateList->address }}" required="true" />
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
                                    <label  class="">Job position applied for</label>
                                    <input type="text" class="" name="applied_for" id="applied_for" value="{{ $CandidateList->applied_for }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Expected Salary</label>
                                    <input type="text" class="" name="expected_salary" id="expected_salary" value="{{ $CandidateList->expected_salary }}" required="true" />
                                </div>

                                <div class="">
                                    <label  class="">Work Experience</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class="" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" name="work_experience" id="work_experience" value="{{ $CandidateList->work_experience }}">

                                        </label>
                                    </div>
                                </div>

                                <div>
                                    <label  class="">Educational Background</label>
                                    <input type="text" class="" name="educational" id="educational" value="{{ $CandidateList->educational }}" required="true" />
                                </div>
                            
                                <div>
                                    <label  class="">Reference Details (If have)</label>
                                    <input type="text" class="" name="reference" id="reference" value="{{ $CandidateList->reference }}" required="true" />
                                </div>

                                <div class="">
                                    <label  class="">Add CV or Portfolio Links</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class="" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" name="upload_cv_portfolio_links" id="upload_cv_portfolio_links" value="{{ $CandidateList->upload_cv_portfolio_links }}">
                                        </label>
                                    </div>
                                </div>

                            </div>

                            <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">Submit
                                </button>
                            </div>
                        </form>
                    </div>

                </div>
        </div>
    
    @endsection
 
<!-- Include jQuery Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(document).on("click","#submitButton",function(){
        $('#basicDetails').validate({
            rules: {
                first_name: "required",
                last_name: "required",
                mobile_no: "required",
                email_id: "required",
                // upload_files: "required",
            },

            // Specify validation error messages
            messages: {
                first_name: "Please enter first name.",
                last_name: "Please enter Last name.",
                mobile_no: "Please enter Mobile No.",
                email_id: "Please enter Email Id.",

            },
        });
    });

    $(document).ready(function () {
            $("#basicDetails input").prop("disabled", true);
        });

</script>

