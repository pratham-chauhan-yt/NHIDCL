@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c">
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>

                    Create New Jobs
                </button>
                <button id="jobPosted" class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Jobs Posted
                </button>
                <button id="archivedJobs" class="tablink" onclick="openPage('archive', this, '#373737')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>


                    Archive
                </button>

            </div>

            <div id="loader"></div>
            <div id="Home" class="tabcontent">
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Resource requisition</div>
                </div>
                <!-- <h6 class="text-[14px] font-medium">Mode of Engagement</h6> -->

                <form id="resourceRequisitionFrm" action="{{route('hr.create-requisition')}}" method="POST"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="">Title*</label>
                            <input id="job_title" name="job_title" type="text" class="" placeholder="Enter Job Title">
                            <span id="job_title" class="job_title_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Description*</label>
                            <textarea id="job_description" name="job_description" rows="1" class=""
                                placeholder="Enter Job Description"></textarea>
                            <span id="job_description" class="job_description_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Type of Engagement</label>
                            <select class="" id="Engagement" name="Engagement">
                            <option value="" disabled selected>Select Engagement*</option>
                                    @foreach ($engagement as $engagements)
                                        <option value="{{ $engagements->id }}">{{ $engagements->engagement_type }}</option>
                                    @endforeach
                                <!-- <option value="">Select Engagement</option>
                                <option value="1">Young Professional</option>
                                <option value="2">Expert Professional</option>
                                <option value="3">People of Eminence</option> -->
                            </select>
                        </div>
                        <div class="">
                            <label for="Designation">Desigmation of Engagement</label>
                            <select class="form-control" id="Designation_Engagement" name="Designation_Engagement" disabled>
                                <option value="">Select a Designation</option>
                            </select>
                            <!--
                                                                        <label for="prof" class="">Designation of Engagement</label>
                                                                        <select id="Designation_Engagement" class="" name="Designation_Engagement">
                                                                            <option value="1">Senior Consultant</option>
                                                                            <option value="2">Consultant</option>
                                                                            <option value="3">Senior Associate</option>
                                                                            <option value="4">Associate</option>
                                                                            <option value="5">Principal Expert</option>
                                                                            <option value="6">Senior Expert</option>
                                                                            <option value="7">Expert</option>
                                                                            <option value="8">People of Eminence</option>
                                                                        </select> -->
                        </div>



                        <div class="">
                            <label class="">Duration of engagement Year and Month*</label>
                            <div class="grid grid-cols-2 gap-[10px]">
                                <!-- <input id="duration_of_engagement_start" name="duration_of_engagement_start" type="date"
                                                class="duration_of_engagement_start">
                                            <input id="duration_of_engagement_end" name="duration_of_engagement_end" type="date"
                                                class="duration_of_engagement_end"> -->

                                <select class="" id="duration_of_engagement_start" name="duration_of_engagement_start">
                                    <option value="" disabled selected>Duration of engagement in Year*</option>
                                    @foreach ($workExperienceYear as $ExperienceYear)
                                        <option value="{{ $ExperienceYear->year }}">{{ $ExperienceYear->fetch_year }}</option>
                                    @endforeach
                                </select>
                                <!-- <input id="duration_of_engagement_end" name="duration_of_engagement_end" type="date"
                                                            class="duration_of_engagement_end"> -->

                                <select class="" id="duration_of_engagement_end" name="duration_of_engagement_end">
                                    <option value="" disabled selected>Duration of engagement in Month*</option>
                                    @foreach ($WorkExperienceMonth as $ExperienceMonth)
                                        <option value="{{ $ExperienceMonth->month }}">{{ $ExperienceMonth->fetch_month }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <span id="duration_of_engagement_start"
                                class="duration_of_engagement_start_err candidateErr"></span>

                            <span id="duration_of_engagement_end"
                                class="duration_of_engagement_end_err candidateErr"></span>
                        </div>


                        <div class="">
                            <label class="">Number of required resources</label>
                            <input type="number" min="1" max="501" name="number_of_required_resources" class=""
                                placeholder="Number of required resources">
                        </div>
                        <div class="">
                            <label class="">Domain</label>
                            <select id="domain" name="domain" class="domain">
                                <option value="" disabled selected>Select Domain*</option>
                                @foreach ($domain as $domains)

                                    <option value="{{ $domains->id }}">{{ $domains->domain_name }}</option>
                                @endforeach
                            </select>
                            <span id="domain" class="domain_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Discipline</label>
                            <select id="discipline" name="discipline" class="">
                                <option value="" disabled selected>Select Discipline*</option>
                                @foreach ($discipline as $disciplines)
                                    <option value="{{ $disciplines->id }}">{{ $disciplines->discipline_name }}</option>
                                @endforeach
                                <!-- <option value="">--select discipline--</option>
                                    <option value="1">Civil</option>
                                    <option value="2">Non Civil</option> -->
                            </select>
                            <span id="discipline" class="discipline_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Qualification requirements</label>
                            <!-- <select id="qualification_requirements" name="qualification_requirements" class="">
                                                                                                        <option value="">--select qualification requirements--</option>
                                                                                                        <option value="2">Graduation</option>
                                                                                                        <option value="3">Post Graduation</option>
                                                                                                    </select> -->
                            <select id="qualification_requirements" name="qualification_requirements[]" multiple="multiple"
                                class="js-example-basic-multiple" multiple="multiple">
                                <option value="">--select qualification requirements--</option>
                                @foreach($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->qualification_name }}</option>
                                @endforeach
                            </select>

                            <span id="qualification_requirements"
                                class="qualification_requirements_err candidateErr"></span>
                        </div>

                        <div class="">
                            <label class="">Required Qualification Score (in Percentage)</label>
                            <input type="number" class="" min="1" max="100" placeholder="Qualification Score (in Percentage)">
                        </div>
                        <div class="">
                            <label class="">Minimum work experience</label>
                            <select class="form-control" id="minimum_work_experience" name="minimum_work_experience">
                                <option value="" disabled selected>Select an Minimum Work</option>
                                @foreach ($EngagementYear as $engagement)
                                    <option value="{{ $engagement->year }}">{{ $engagement->fetch_year }}</option>
                                @endforeach
                            </select>
                            <span id="minimum_work_experience" class="minimum_work_experience_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Retired Government Personnel</label>
                            <select id="retired_government_personnel" name="retired_government_personnel" class="">
                                <option value="">Select retired government personnel--</option>
                                <option value="1">Yes</option>
                                <option value="2">No</option>
                            </select>
                            <span id="retired_government_personnel"
                                class="retired_government_personnel_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Remark</label>
                            <textarea id="comment" name="comment" rows="1" class=""
                                placeholder="Add your comment"></textarea>
                            <span id="comment" class="comment_err candidateErr"></span>
                        </div>
                        <div class="attachment_section_photos ">
                            <label class="">Upload efile Noting</label>
                            <div class="flex gap-[10px]">
                                <input id="upload_for_efile_noting_txt" name="upload_for_efile_noting_txt" type="text"
                                    class="upload_for_efile_noting_txt" placeholder="Upload documents">
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos"> Upload File
                                    <input id="upload_for_efile_noting" name="upload_for_efile_noting" type="file"
                                        class="hidden upload_for_efile_noting">

                                </label>
                            </div>
                            <span id="upload_for_efile_noting" class="upload_for_efile_noting_err candidateErr"></span>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <!-- <button class="hover-effect-btn border_btn">Add More Qualification</button> -->



                        <!-- Modal toggle -->
                        <!-- Modal toggle -->
                        <button id="resourceRequisitionBtn" data-modal-target="static-modal1"
                            data-modal-toggle="static-modal" class="hover-effect-btn fill_btn" type="button">
                            Submit
                        </button>

                        <!-- Main modal -->
                        <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-[20px] py-[20px]">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between pr-[10px]">
                                        <button type="button"
                                            class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                            data-modal-hide="static-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="modal_body_cust">
                                        <img src="../../assets/images/check-1.png" alt="popupimage">
                                        <p>Requisition Id</p>
                                        <h4>1254785554</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="News" class="tabcontent">
                <div class="inner_select_cust_op">
                    <select class="">
                        <option value="Active Jobs">Active Jobs</option>
                        <option value="InActive Jobs">InActive Jobs</option>
                    </select>
                </div>
                <div id="postedJobs" class="job_poster_grid_cust">
                    <!-- <div class="job_posted_cust">
                                                                                                                    <a href="#">
                                                                                                                        <h4 class="">UI/UX Designer</h4>
                                                                                                                        <div class="mb-[10px] cust_p pt-[5px]">
                                                                                                                            <p>Active Until: <span> Jan 31, 2025</span></p>
                                                                                                                        </div>
                                                                                                                        <p class="">We are seeking a talented and creative UI/UX Designer to join our team.
                                                                                                                            As a UI/UX Designer, you will be responsible for designing intuitive and
                                                                                                                            visually appealing user interfaces for our digital products.</p>

                                                                                                                    </a>
                                                                                                                </div> -->
                </div>
            </div>

            <div id="archive" class="tabcontent">
                <div class="table_over">
                    <h4>Candidate Details</h4>
                    <table class="cust_table__ table_sparated">
                        <thead class="">
                            <tr>
                                <th scope="col">
                                    #
                                </th>
                                <th scope="col">
                                    Job name
                                </th>
                                <th scope="col">
                                    From date
                                </th>
                                <th scope="col">
                                    To date
                                </th>
                                <th scope="col">
                                    Job Created Date
                                </th>
                                <th scope="col">
                                    Job Created By
                                </th>
                            </tr>
                        </thead>
                        <tbody id="archiveRow" class="">
                            <!-- <tr>
                                                                                                                            <td>
                                                                                                                                1
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                UI/UX Designer
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                10-12-2024
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                10-12-2024
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                10-12-2024
                                                                                                                            </td>
                                                                                                                            <td>
                                                                                                                                XYZ
                                                                                                                            </td>
                                                                                                                        </tr> -->
                        </tbody>
                    </table>

                </div>
                <div class="pagination_cust">
                    <span>01 to 10 of 50 Items</span>
                    <nav aria-label="Page navigation example">
                        <ul class="cust-pagination">
                            <li>
                                <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">1</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">2</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">3</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-right"
                                        aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/advertisement.js') }}"></script>
@endpush
