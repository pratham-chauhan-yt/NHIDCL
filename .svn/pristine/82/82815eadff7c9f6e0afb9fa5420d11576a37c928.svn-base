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

                    Edit Job
                </button>

                 <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <span><i class="fa fa-arrow-left" aria-hidden="true"></i></span>

                    @if(($requisition && $requisition->end_date) && (Carbon\Carbon::parse($requisition->end_date)->lt(today())))
                        <a id="backTab2" href="{{ route('hr.create.advertisement', ['arch' => 'xegrjvdhjhvdv256hdfh6789fdhgdyt6r5get4rtrrtr']) }}">Back</a>
                    @endif
                    @if(($requisition && $requisition->end_date) && (Carbon\Carbon::parse($requisition->end_date)->gt(today())))
                        <a id="backTab1" href="{{ route('hr.create.advertisement', ['post' => 'vxegrjvdhjhvdv256hdfh6543fdhgdyt6r5get4rtrrtr']) }}">Back</a>
                    @endif


                </button>

            </div>

            <div id="loader"></div>
            <div id="Home" class="tabcontent">
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Resource requisition</div>
                </div>
                <!-- <h6 class="text-[14px] font-medium">Mode of Engagement</h6> -->

                <form id="resourceRequisitionFrm" action="{{ route('hr.updatePostedJobs', ['id' => $requisition->id]) }}" method="POST"
      class="form_grid_cust" enctype="multipart/form-data">

                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Title</label>
                            <input id="job_title" name="job_title" type="text" value="{{$requisition->job_title}}" placeholder="Ui-Ux Designer">
                            <span id="job_title" class="job_title_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Description</label>
                            <textarea id="job_description" name="job_description" rows="1" placeholder="job description">{{$requisition->job_description}}</textarea>
                            <span id="job_description" class="job_description_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Type of Engagement</label>
                            <select class="" id="Engagement" name="engagement_type">
                            <option value="" disabled selected>Select Engagement</option>
                                    @foreach ($engagement as $engagements)
                                        <option value="{{ $engagements->id }}" {{ $engagements->id == $requisition->ref_engagement_id ? 'selected' : '' }} >{{ $engagements->engagement_type }}</option>
                                    @endforeach
                            </select>
                        </div>
                        <div class="">
                            <label for="Designation" class="required-label">Designation of Engagement</label>
                            <input type="hidden" id ='engagement_designation_id' value="{{$requisition->nhidcl_engagement_designation_id}}">
                            <select class="form-control" id="Designation_Engagement" name="Designation_Engagement">
                                <option value="">Select a Designation</option>

                            </select>
                        </div>

                        <div class="">
                            <label class="required-label">Duration of engagement Year and Month</label>
                            <div class="grid grid-cols-2 gap-[10px]">

                                <select class="" id="duration_of_engagement_start" name="engagement_year">
                                    <option value="" disabled selected>Duration of engagement in Year</option>
                                    @foreach ($workExperienceYear as $ExperienceYear)
                                        <option value="{{ $ExperienceYear->year }}" {{ $ExperienceYear->year  == $requisition->engagement_year ? 'selected' : '' }} >{{ $ExperienceYear->fetch_year }}</option>
                                    @endforeach
                                </select>

                                <select class="" id="duration_of_engagement_end" name="engagement_month">
                                    <option value="" disabled selected>Duration of engagement in Month</option>
                                    @foreach ($WorkExperienceMonth as $ExperienceMonth)
                                        <option value="{{ $ExperienceMonth->month }}" {{ $ExperienceMonth->month  == $requisition->engagement_month ? 'selected' : '' }}>{{ $ExperienceMonth->fetch_month }}
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
                            <input type="number" min="1" max="500" name="number_of_required_resources" value="{{ $requisition->number_of_required_resources}}"
                                placeholder="Number of required resources">
                        </div>
                        <div class="">
                            <label class="required-label">Domain</label>
                            <select id="domain" name="domain" class="domain">
                                <option value="" disabled selected>Select Domain</option>
                                @foreach ($domain as $domains)
                                    <option value="{{ $domains->id }}" {{ $domains->id  == $requisition->ref_domain_id ? 'selected' : '' }}> {{ $domains->domain_name }}</option>
                                @endforeach
                            </select>
                            <span id="domain" class="domain_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Discipline</label>
                            <select id="discipline" name="discipline" class="">
                                <option value="" disabled selected>Select Discipline</option>
                                @foreach ($discipline as $disciplines)
                                    <option value="{{ $disciplines->id }}"  {{ $disciplines->id  == $requisition->ref_discipline_id ? 'selected' : '' }} > {{ $disciplines->discipline_name }}</option>
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
                                <option value="{{ $qualification->id }}"
                                    @if(in_array($qualification->id, $existingQualifications)) selected @endif>{{ $qualification->qualification_name }}
                                </option>
                                @endforeach
                            </select>
                            <span id="qualification_requirements"
                                class="qualification_requirements_err candidateErr"></span>
                        </div>
                        <input type="hidden" id="course_list" name="course_list[]">
                        <div class="courseDivEdit">
                            <label class="required-label">Course</label>
                            <select id="course"  name="course" class="js-example-basic-multiple" multiple="multiple" >
                                <option value="">Select Course</option>
                                @foreach($courses as $course)

                                <option value="{{ $course->id }}"
                                    @if(in_array($course->id, $existingCourses)) selected @endif>{{ $course->course_name }}
                                </option>
                                @endforeach
                            </select>
                            <span class="course_err candidateErr">
                                @error('course.*')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </span>

                        </div>

                        <div class="">
                            <label class="required-label">Required Qualification Score (in Percentage)</label>
                            <input type="number" name="qualification_percent" value="{{$requisition->qualification_percent}}" min="1" max="100" placeholder="Qualification Score (in Percentage)">
                        </div>
                        <div class="">
                            <label class="required-label">Minimum work experience</label>
                            <select class="form-control" id="minimum_work_experience" name="minimum_work_experience">
                                <option value="" disabled selected>Select an Minimum Work</option>
                                @foreach ($minimumWorkExp as $work)
                                    <option value="{{ $work->year}}"  {{ $work->year  == $requisition->ref_work_experience_year_id ? 'selected' : '' }}>{{ $work->fetch_year }}</option>
                                @endforeach
                            </select>
                            <span id="minimum_work_experience" class="minimum_work_experience_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="required-label">Retired Government Personnel</label>
                            <select id="retired_government_personnel" name="retired_government_personnel" class="">
                                <option value="">Select retired government personnel--</option>
                                <option value="1" {{ $requisition->retired_government_personnel == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="2" {{ $requisition->retired_government_personnel == 2 ? 'selected' : '' }}>No</option>
                            </select>
                            <span id="retired_government_personnel"
                                class="retired_government_personnel_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Remark</label>
                            <textarea id="comment" name="comment" rows="1"
                                placeholder="Add your comment">{{$requisition->comment_box}}</textarea>
                            <span id="comment" class="comment_err candidateErr"></span>
                        </div>

                        <div class="">
                            <label class="required-label">Start Date</label>
                            <input type="datetime-local" class=""  name="start_date" id="start_date" value="{{$requisition->start_date}}" required>
                            <span id="start_date" class="duration_of_advertisment_start_err candidateErr"></span>

                        </div>
                        <div class="">
                            <label class="required-label">End Date</label>
                            <input type="datetime-local" class="" name="end_date" id="end_date" value="{{$requisition->end_date}}" required>
                            <span id="end_date" class="duration_of_advertisment_end_err candidateErr"></span>
                        </div>
                        <div class="attachment_section_photos ">
                            <label class="required-label">Upload efile Noting approved advertisement file</label>
                            <div id="efile_edit" class="flex gap-[10px]">
                                <input id="upload_for_efile_noting_txt" name="upload_for_efile_noting_txt" type="text"
                                    class="upload_for_efile_noting_txt" placeholder="Upload documents" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_efile"> Upload File
                                    <input id="upload_for_efile_noting" name="upload_for_efile_noting" type="file"
                                        class="hidden upload_for_efile_noting">

                                </label>
                            </div>
                            <span id="upload_for_efile_noting" class="upload_for_efile_noting_err candidateErr"></span>
                        </div>
                        <div class="">
                            <label class="">Newspaper Publication Date</label>
                            <input type="date" class="" name="newspaper_publication_date" id="newspaper_publication_date" value="{{$requisition->newspaper_publication_date}}">
                            <span id="newspaper_publication_date" class="newspaper_publication_date_err candidateErr"></span>
                        </div>

                        <div class="attachment_section_newsclip ">
                            <label class="">Upload Newspaper Clipping</label>
                            <div id="newspaper_clip_edit" class="flex gap-[10px]">
                                <input id="upload_newspaper_clip_txt" name="upload_newspaper_clip_txt" type="text"
                                    class="upload_newspaper_clip_txt" placeholder="Upload document" vlaue="{{$requisition->newspaper_clipping}}" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_newspaper_clip"> Upload File
                                    <input id="upload_newspaper_clip" name="upload_newspaper_clip" type="file"
                                        class="hidden upload_newspaper_clip">
                                </label>
                            </div>
                            <span id="upload_newspaper_clip_txt" class="upload_newspaper_clip_txt_err candidateErr"></span>
                        </div>
                    </div>

                    <div id="requisition-data"
                        data-courses='@json($courses)'
                        data-efile="{{ $requisition->upload_for_efile_noting }}"
                        data-efile-path="{{ $requisition->upload_for_efile_noting_filepath }}"
                        data-news-clip="{{ $requisition->newspaper_clipping }}"
                        data-news-clip-path="{{ $requisition->newspaper_clipping_filepath }}">
                    </div>

                    <div style="margin-top:10px;">
                        <button class="hover-effect-btn fill_btn" type="submit" name="submit">  Submit </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush
