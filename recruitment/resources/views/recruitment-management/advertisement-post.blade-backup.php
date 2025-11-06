@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Applications invited in On-line mode for the post of {{$record->post_name}}.</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <h1 class="candidat_cust-title">
                Appling for the post of {{$record->post_name}} 
            </h1>
            <div class="my-4">
                <div class="tab_custom_c mb-[20px]">
                    <button class="tablink {{ session('active_tab', 'Home') == 'Home' ? 'active' : '' }}" onclick="openPage('Home', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z"></path>
                        </svg> Post Specific Requirements
                    </button>
                    <button class="tablink {{ session('active_tab') == 'application' ? 'active' : '' }}" onclick="openPage('application', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z"></path>
                        </svg> Application Preview
                    </button>
                </div>

                <div id="Home" class="tabcontent" style="{{ session('active_tab', 'Home') == 'Home' ? 'display:block' : 'display:none' }}">
                    <form class="form_grid_cust" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-data">
                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                                <label class="required-label">Mode of Recruitment :</label>
                            </div>
                            <div class="custom_check_inline-container">
                                @forelse($refModeRecruitment as $refModeData)
                                <div class="custom_check_inline-item">
                                    <input type="radio" name="mode_of_requirement" id="mode_of_requirement{{$refModeData->id}}" value="{{$refModeData->id}}" class="custom_check_inline-checkbox" @if($loop->first) checked @endif>
                                    <label for="mode_of_requirement{{$refModeData->id}}" class="custom_check_inline-label">{{$refModeData->name}}</label>
                                </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            @if($record->required_5_month_salary_slip == 1)
                            <div class="attachment_advertisement attachment_section_photos">
                                <label class="required-label">Last 5 months salary slip</label>
                                <div class="flex gap-[10px]">
                                    <input id="salary_slip_txt" name="salary_slip_txt" type="text" class="salary_slip_txt" placeholder="Upload salary slip" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                        Upload File
                                        <input type="file"
                                            name="upload_salary"
                                            class="hidden file-uploader"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="salary_slip_txt"
                                            data-preview-wrapper="salary_preview"
                                            data-hidden-input="upload_file"
                                            data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                            data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                    </label>
                                    <input type="hidden" name="upload_file" id="upload_file">
                                </div>
                                <div id="salary_preview"></div>
                            </div>

                            @endif
                            @if($record->required_10_year_share_capital == 1)
                            <div class="attachment_advertisement attachment_section_photos">
                                <label class="required-label">10 years of share capital</label>
                                <div class="flex gap-[10px]">
                                    <input id="share_capital_txt" name="share_capital_txt" type="text" class="share_capital_txt" placeholder="Upload 10 years of share capital" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                        Upload File
                                        <input type="file"
                                            name="upload_share_capital"
                                            class="hidden file-uploader"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="share_capital_txt"
                                            data-preview-wrapper="share_capital_preview"
                                            data-hidden-input="share_capital_file"
                                            data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                            data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                    </label>
                                    <input type="hidden" name="share_capital_file" id="share_capital_file">
                                </div>
                                <div id="share_capital_preview"></div>
                            </div>
                            @endif

                            @for($i = 0; $i < $record->no_of_location_prefered; $i++)
                                <div class="form-group mb-3">
                                    <label for="preferred_location_{{ $i }}" class="required-label">
                                        Preferred Location {{ $i + 1 }}
                                    </label>
                                    <select name="preferred_location[]" id="preferred_location_{{ $i }}" class="form-control" required>
                                        <option value="">-- Select Location --</option>
                                        @forelse ($stateList as $val)
                                            <option value="{{ $val->id }}">
                                                {{ $val->name }}
                                            </option>
                                        @empty
                                            <option value="">No states found</option>
                                        @endforelse
                                    </select>
                                </div>
                            @endfor
                            <div class="attachment_advertisement attachment_section_photos">
                                <label class="required-label">Upload Resume/CV</label>
                                <div class="flex gap-[10px]">
                                    <input id="resume_file_txt" name="resume_file_txt" type="text" class="resume_file_txt" placeholder="Upload resume file" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                        Upload File
                                        <input type="file"
                                            name="upload_resume"
                                            class="hidden file-uploader"
                                            data-type="pdf"
                                            data-max-size="2000000"
                                            data-input-id="resume_file_txt"
                                            data-preview-wrapper="resume_preview"
                                            data-hidden-input="resume_file"
                                            data-upload-url="/recruitment-portal/candidate/advertisement/upload/files"
                                            data-view-url="/recruitment-portal/candidate/advertisement/view/files">
                                    </label>
                                    <input type="hidden" name="resume_file" id="resume_file">
                                </div>
                                <div id="resume_preview"></div>
                            </div>
                        </div>
                        
                        @if($record->required_gate_detail == 1)
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <label class="required-label">Details Of GATE Score :</label>
                        </div>
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="form-input">
                                <label class="required-label">Year Of Gate Exam</label>
                                <select name="gate_exam_year" id="gate_exam_year" required>
                                    <option value="">--- Select year of gate exam ---</option>
                                    @forelse ($gateYears as $gateYearVal)
                                        <option value="{{ $gateYearVal->id }}">
                                            {{ $gateYearVal->passing_year }}
                                        </option>
                                    @empty
                                        <option value="">No gate years found</option>
                                    @endforelse
                                </select>
                            </div>

                            <div class="form-input">
                                <label class="required-label">GATE Discpline</label>
                                <select name="gate_discpline" id="gate_discpline" required>
                                    <option value="">--- Select gate discpline ---</option>
                                    @forelse ($disciplines as $disciplinesVal)
                                        <option value="{{ $disciplinesVal->id }}">
                                            {{ $disciplinesVal->discipline_name }}
                                        </option>
                                    @empty
                                        <option value="">No gate discpline found</option>
                                    @endforelse
                                </select>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Gate Score</label>
                                <input type="text" name="gate_score" id="gate_score" class="full_name" placeholder="Enter your gate score" required>
                            </div>
                            <div class="form-input">
                                <label class="required-label">Gate Registartion Number</label>
                                <input type="text" id="gate_registration_number" name="gate_registration_number" value="" placeholder="Enter gate registration number" required>
                            </div>
                        </div>
                        @endif
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn cursor-pointer" type="submit">
                                Save &amp; Next
                            </button>
                        </div>
                    </form>

                </div>

                <div id="application" class="tabcontent" style="{{ session('active_tab', 'Home') == 'application' ? 'display:block' : 'display:none' }}">
                    <h4 class="applicat_cust-title">User Information</h4>
                    <div class="applicat_cust-container">
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Name</div>
                            <div class="applicat_cust-value">{{ $applicant->full_name ?? null }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Gender</div>
                            <div class="applicat_cust-value">{{$applicant->gender ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                            <div class="applicat_cust-value">{{$applicant->father_husband_name ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Date of Birth</div>
                            <div class="applicat_cust-value">{{$applicant->date_of_birth ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Contact Number</div>
                            <div class="applicat_cust-value">{{$applicant->mobile_no ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Email</div>
                            <div class="applicat_cust-value">{{$applicant->email ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Correspondence Address</div>
                            <div class="applicat_cust-value">{{$applicant->correspondence_address ?? null}}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Permanent Address</div>
                            <div class="applicat_cust-value">{{$applicant->permanent_address ?? null}}</div>
                        </div>
                    </div>
                    <h4 class="applicat_cust-title mt-3">Education Qualification</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Qualification</th>
                                    <th>Board/ University/ Collage</th>
                                    <th>Main Subject</th>
                                    <th>Course Mode</th>
                                    <th>Passing Year</th>
                                    <th>Percentage</th>
                                    <th>Marksheet/Degree</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($applicantedu)>0)
                                @foreach($applicantedu as $educationdata)
                                <tr>
                                    <td>
                                        {{ $loop->iteration }}
                                    </td>
                                    <td>{{ $educationdata->qualification->qualification_name }}</td>
                                    <td>{{ $educationdata->board_university_college->name }}</td>
                                    <td>{{ $educationdata->main_subject->subject_name }}</td></td>
                                    <td>{{ $educationdata->course_mode->course_mode }}</td></td>
                                    <td>{{ $educationdata->passing_year }}</td></td>
                                    <td>{{ $educationdata->percentage }}</td></td>
                                    <td>{{ $educationdata->course->course_name }}</td></td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <th>No education record founds</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>Experience</th>
                                    <th>Nature of Duites</th>
                                    <th>Employer Type</th>
                                    <th>Experience Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(sizeof($applicantexp)>0)
                                @foreach($applicantexp as $experiencedata)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $experiencedata->employer_name }}</td>
                                    <td>{{ $experiencedata->post_held }}</td>
                                    <td>{{ $experiencedata->employer_name }}</td>
                                    <td>{{ $experiencedata->nature_of_duties }}</td>
                                    <td>{{ $experiencedata->ref_job_type_id }}</td>
                                    <td>{{ $experiencedata->experience_certificate }}</td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <th>No work experience records found</th>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <h4 class="applicat_cust-title mt-3">Preferred Location</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Preferred Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applicantState as $locationData)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ ucwords($locationData->name) }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="2">No preferred location data found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    <h4 class="applicat_cust-title mt-3">Details Of GATE Score :</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Discpline Name</th>
                                    <th>Registartion Number</th>
                                    <th>Passing Year</th>
                                    <th>Gate Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($applicantGateData)
                                <tr>
                                    <td>1</td>
                                    <td>{{ optional($applicantGateData)->discipline_name }}</td>
                                    <td>{{ optional($applicantGateData)->gate_registration_number }}</td>
                                    <td>{{ optional($applicantGateData)->passing_year }}</td>
                                    <td>{{ optional($applicantGateData)->gate_score }}</td>
                                </tr>
                                @endisset
                            </tbody>
                        </table>
                    </div>

                    <h4 class="applicat_cust-title mt-3">Documents</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <tbody>
                                @if(optional($applicant)->upload_photos)
                                <tr>
                                    <th>1</th>
                                    <td>Photo</td>
                                    <td><a href="{{ url('/resource-pool-portal/candidate/viewFiles?pathName='.$applicant->upload_photos_filepath.'&fileName='.$applicant->upload_photos)}}" class="bg-blue-700 hover:bg-blue-800" target="_blank">View</a></td>
                                </tr>
                                @endif
                                @if(!empty($applicant->upload_signature))
                                <tr>
                                    <th>2</th>
                                    <td>Signature</td>
                                    <td><a href="{{ url('/resource-pool-portal/candidate/viewFiles?pathName='.$applicant->upload_signature_filepath.'&fileName='.$applicant->upload_signature)}}" class="bg-blue-700 hover:bg-blue-800" target="_blank">View</a></td>
                                </tr>
                                @endif
                                @if(!empty($applicant->upload_resume))
                                <tr>
                                    <th>3</th>
                                    <td>Resume</td>
                                    <td><a href="{{ url('/resource-pool-portal/candidate/viewFiles?pathName='.$applicant->upload_resume_filepath.'&fileName='.$applicant->upload_resume)}}" class="bg-blue-700 hover:bg-blue-800" target="_blank">View</a></td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <form class="form_grid_cust" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="action" value="application">
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn cursor-pointer" type="submit">
                                {{ !empty($recordApplication) ? 'Update' : 'Submit' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/recruitment-portal.js') }}"></script>
@endpush