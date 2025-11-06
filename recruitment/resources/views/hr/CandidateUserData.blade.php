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
