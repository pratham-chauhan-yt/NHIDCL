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
                <button id="jobPosted" class="tablink advertisementPoseted" onclick="openPage('News', this, '#373737')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>
                    Jobs Posted
                </button>
                <button id="archivedJobs" class="tablink advertisementArchived" onclick="openPage('archive', this, '#373737')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>


                    Archive
                </button>

            </div>

            <div id="Home" class="tabcontent" data-users-postid="{{ auth()->user()->id }}">
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Resource requisition</div>
                </div>
                <form id="resourceRequisitionFrm" action="{{route('hr.create-requisition')}}" method="POST"
                    class="form_grid_cust" enctype="multipart/form-data">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Title</label>
                            <input id="job_title" name="job_title" type="text" maxlength="100" placeholder="Enter Job Title">
                            <span id="job_title" class="job_title_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Description</label>
                            <textarea id="job_description" name="job_description" rows="4" minlength="50" maxlength="500" placeholder="Enter Job Description"></textarea>
                            <span id="job_description" class="job_description_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Type of Engagement</label>
                            <select class="" id="engagement" name="engagement_type" data-url="{{ route('getDesignationsByEngagement', ['engagement_id' => ':engagementId']) }}">
                            <option value="" disabled selected>Select Engagement</option>
                                    @foreach ($engagement as $engagements)
                                        <option value="{{ $engagements->id }}">{{ $engagements->engagement_type }}</option>
                                    @endforeach
                            </select>
                            <span id="engagement_err" class="engagement_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label for="Designation" class="required-label">Designation of Engagement</label>
                            <select class="form-control" id="designation_engagement" name="designation_engagement">
                                <option value="">Select a Designation</option>
                                    @foreach ($DesignationEngagement as $designationRow)
                                        <option value="{{ $designationRow->ref_engagement_id }}">{{ $designationRow->designation }}</option>
                                    @endforeach
                            </select>
                            <span id="designation_engagement_err" class="designation_engagement_err candidateErr"></span>
                        </div>

                        <div class="">
                            <label class="required-label">Duration of engagement Year and Month</label>
                            <div class="grid grid-cols-2 gap-[10px]">

                                <select class="" id="duration_of_engagement_start" name="engagement_year">
                                    <option value="" disabled selected>Duration of engagement in Year</option>
                                    @foreach ($workExperienceYear as $ExperienceYear)
                                        <option value="{{ $ExperienceYear->year }}">{{ $ExperienceYear->fetch_year }}</option>
                                    @endforeach
                                </select>

                                <select class="" id="duration_of_engagement_end" name="engagement_month">
                                    <option value="" disabled selected>Duration of engagement in Month</option>
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
                            <label class="required-label">Number of required resources</label>
                            <input id="number_of_required_resources" type="number" min="1" max="500" name="number_of_required_resources" class=""
                                placeholder="Number of required resources">

                            <span id="number_of_required_resources"
                                class="number_of_required_resources_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Domain</label>
                            <select id="domain" name="domain" class="domain">
                                <option value="" disabled selected>Select Domain</option>
                                @foreach ($domain as $domains)

                                    <option value="{{ $domains->id }}">{{ $domains->domain_name }}</option>
                                @endforeach
                            </select>
                            <span id="domain" class="domain_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Discipline</label>
                            <select id="discipline" name="discipline" class="">
                                <option value="" disabled selected>Select Discipline</option>
                                @foreach ($discipline as $disciplines)
                                    <option value="{{ $disciplines->id }}">{{ $disciplines->discipline_name }}</option>
                                @endforeach

                            </select>
                            <span id="discipline" class="discipline_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Qualification requirements</label>
                            <select id="qualification_requirements" data-courses='@json($courses)' name="qualification_requirements[]" multiple="multiple"
                                class="js-example-basic-multiple" multiple="multiple">
                                <option value="">--select qualification requirements--</option>
                                @foreach($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->qualification_name }}</option>
                                @endforeach
                            </select>

                            <span id="qualification_requirements"
                                class="qualification_requirements_err candidateErr"></span>
                        </div>
                        <div class="courseDiv">
                            <label  class="required-label">Course</label>
                            <select id="course"  name="course" class="js-example-basic-multiple" multiple="multiple" >
                                <option value="">Select Course</option>
                            </select>
                            <span class="course_err candidateErr">
                                @error('course.*')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </span>

                        </div>
                        <input type="hidden" id="course_list" name="course_list[]">
                        <div class="">
                            <label class="required-label">Required Qualification Score (in Percentage)</label>
                            <input id="qualification_percent" type="number" name="qualification_percent" min="30" max="100" placeholder="Qualification Score (in Percentage)">
                            <span id="qualification_percent" class="qualification_percent_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Minimum work experience</label>
                            <select class="form-control" id="minimum_work_experience" name="minimum_work_experience">
                                <option value="" disabled selected>Select an Minimum Work</option>
                                @foreach ($minimumWorkExp as $work)
                                    <option value="{{ $work->year }}">{{ $work->fetch_year }}</option>
                                @endforeach
                            </select>
                            <span id="minimum_work_experience" class="minimum_work_experience_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Retired Government Personnel</label>
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
                            <textarea id="comment" name="comment" rows="4" maxlength="500" placeholder="Add your comment"></textarea>
                            <span id="comment" class="comment_err candidateErr"></span>
                        </div>
                        @php
						$now = \Carbon\Carbon::now()->format('Y-m-d\TH:i');
						@endphp
                        <div class="">
                            <label class="required-label">Start Date</label>
                            <input type="datetime-local" name="start_date" id="start_date" min="{{ $now }}" required>
                            <span id="start_date" class="duration_of_advertisment_start_err candidateErr"></span>

                        </div>
                        <div class="">
                            <label class="required-label">End Date</label>
                            <input type="datetime-local" class="" name="end_date" id="end_date" min="{{ $now }}" required>
                            <span id="end_date" class="duration_of_advertisment_end_err candidateErr"></span>
                        </div>
                        <div class="attachment_section_photos ">
                            <label class="required-label">Upload efile noting approved advertisement file</label>
                            <div class="flex gap-[10px]">
                                <input id="upload_for_efile_noting_txt" name="upload_for_efile_noting_txt" type="text"
                                    class="upload_for_efile_noting_txt" placeholder="Upload documents" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos"> Upload File
                                    <input id="upload_for_efile_noting" name="upload_for_efile_noting" type="file"
                                        class="hidden upload_for_efile_noting">

                                </label>
                            </div>
                            <span id="upload_for_efile_noting" class="upload_for_efile_noting_err candidateErr"></span>
                        </div>

                        <div class="">
                            <label class="">Newspaper Publication Date</label>
                            <input type="date" class="" name="newspaper_publication_date" id="newspaper_publication_date" value="" required>
                            <span id="newspaper_publication_date" class="newspaper_publication_date_err candidateErr"></span>
                        </div>
                        <div class="attachment_section_newsclip ">
                            <label class="">Upload Newspaper Clipping</label>
                            <div id="efile_edit" class="flex gap-[10px]">
                                <input id="upload_newspaper_clip_txt" name="upload_newspaper_clip_txt" type="text"
                                    class="upload_newspaper_clip_txt" placeholder="Upload document" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_efile"> Upload File
                                    <input id="upload_newspaper_clip" name="upload_newspaper_clip" type="file"
                                        class="hidden upload_newspaper_clip">
                                </label>
                            </div>
                            <span id="upload_newspaper_clip_txt" class="upload_newspaper_clip_txt_err candidateErr"></span>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">

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
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div id="News" class="tabcontent">
                <div class="input_cust_end inpus_cust_cs">
                    <div class="relative">
                        <input type="text" placeholder="Search Job Title" class="searchKeyPost">
                    </div>
                    <button class="hover-effect-btn fill_btn postSearch" type="button">
                        Search
                    </button>
                </div>
                <div class="inner_select_cust_op">
                    <select id="filterBy" class="filterBy">
                        <option value="Active">Active Jobs</option>
                        <option value="Scheduled">Scheduled Jobs</option>
                    </select>
                </div>
                <div id="postedJobs" class="job_poster_grid_cust">

                </div>
            </div>

            <input id="vMore" type="hidden" data-archived=0 data-posted=0>
            <div id="archive" class="tabcontent">
                <div class="input_cust_end inpus_cust_cs">
                    <div class="relative">
                        <input type="text" placeholder="Search Job Title" class="searchKeyArch">
                    </div>
                    <button class="hover-effect-btn fill_btn archSearch" type="button">
                        Search
                    </button>
                </div>
                <div id="archiveJobs" class="job_poster_grid_cust">

                </div>
            </div>
        </div>

    </div>


    <div id="postedJob-modal" class="custom_modal_latest hidden">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close-btn">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            </div>
            <div class="modal-body mt-3">
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Job Title</div>
                        <div class="applicat_cust-value" id="v_job_title"></div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Job Description</div>
                        <div class="applicat_cust-value" id="v_job_description"></div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>Required Resource</th>
                                <th>Required Experience</th>
                                <th>Duration of engagement</th>
                                <th>View Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="v_number_of_required_resources"></td>
                                <td id="v_minimum_work_experience"></td>
                                <td id="duration_of_engagement_hr"></td>
                                <td id="view_advertisment_details_hr"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush
