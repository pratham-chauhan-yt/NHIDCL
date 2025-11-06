@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View User Details</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('resource-pool.hr.exportPDF', Crypt::encrypt($user->id)) }}">
                    <button type="button" class="hover-effect-btn fill_btn">{{ __('PDF') }}</button>
                </a>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('application', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    User Information
                </button>
            </div>

            <!-- End Tarining Details Start  -->
            <div id="application" class="tabcontent">
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Application ID</div>
                        <div class="applicat_cust-value">{{ $user->id }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Applied For</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['engagementType']->engagement_type ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value">{{ $user->name }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Gender</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['gender'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['father_husband_name'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value">
                            {{ \Carbon\Carbon::parse($user->date_of_birth)->format('d-m-Y'); }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Contact Number</div>
                        <div class="applicat_cust-value">{{ $user->mobile }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value">{{ $user->email }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Spouse Name</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['spouse_name'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Spouse Number</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['spouse_mobile_no'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Correspondence Address</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['correspondence_address'] ?? '' }}
                        </div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Pin Code</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['pincode'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Permanent Address</div>
                        <div class="applicat_cust-value">{{ $data['personal_details']['permanent_address'] ?? '' }}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Photo</div>
                        <div class="applicat_cust-value">
                            @if (!empty($data['personal_details']['upload_photos_filepath']) && !empty($data['personal_details']['upload_photos']))
                                            <a title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['personal_details']['upload_photos_filepath']) . '&fileName=' . urlencode($data['personal_details']['upload_photos']) }}" target="_blank" class="">View Files</a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Signature</div>
                        <div class="applicat_cust-value">
                            @if (!empty($data['personal_details']['upload_signature_filepath']) && !empty($data['personal_details']['upload_signature']))
                                            <a title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['personal_details']['upload_signature_filepath']) . '&fileName=' . urlencode($data['personal_details']['upload_signature']) }}" target="_blank" class="">View Files</a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Resume</div>
                        <div class="applicat_cust-value">
                            @if (!empty($data['personal_details']['upload_resume_filepath']) && !empty($data['personal_details']['upload_resume']))
                                            <a title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['personal_details']['upload_resume_filepath']) . '&fileName=' . urlencode($data['personal_details']['upload_resume']) }}" target="_blank" class="">View Files</a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>

                <h4 class="applicat_cust-title mt-3">Education Qualification</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Qualification</th>
                                <th>Board/ University/ College</th>
                                <th>Main Subject</th>
                                <th>Course</th>
                                <th>Course Mode</th>
                                <th>Passing Year</th>
                                <th>Percentage</th>
                                <th>Marksheet/Degree</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['educational_details'] as $index => $education)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        {{
                                            $education->qualification
                                                ? ($education->qualification->qualification_name === 'Others'
                                                    ? ($education->other_qualification ?? 'N/A')
                                                    : ($education->qualification->qualification_name ?? 'N/A'))
                                                : ($education->other_qualification ?? 'N/A')
                                        }}
                                    </td>
                                    <td style="word-wrap: break-word; white-space: normal;">{{ $education->board_university_college ? ($education->board_university_college->name == 'Others' ? $education->other_board_university_collage : $education->board_university_college->name) : 'N/A' }}</td>
                                    <td>{{ $education->main_subject ? ($education->main_subject->subject_name ?? 'N/A') : ($education->other_main_subject ?? 'N/A') }}</td>
                                    <td style="word-wrap: break-word; white-space: normal;">{{ $education->course ? ($education->course->course_name == 'Others' ? $education->other_course : $education->course->course_name) : 'N/A' }}</td>
                                    <td>{{ $education->course_mode->course_mode ?? 'N/A' }}</td>
                                    <td>{{ $education->ref_passing_year->passing_year ?? 'N/A' }}</td>
                                    <td>{{ $education->percentage ?? 'N/A' }}</td>
                                    <td>
                                        @if (!empty($education->marksheet_degree))
                                            <a title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($education['marksheet_degree_filepath']) . '&fileName=' . urlencode($education['marksheet_degree']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>

                                            {{-- <a href="{{ $education->marksheet_degree_filepath }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a> --}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="9" style="text-align: center;">No educational records available.</td>
                                </tr>
                            @endforelse
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
                                    Employer/Organization Name
                                </th>
                                <th scope="col">
                                    Employer Details
                                </th>
                                <th scope="col">
                                    Post Held
                                </th>
                                <th scope="col">
                                    From-To Date
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
                                    Area of Expertise
                                </th>
                                <th scope="col">
                                    Experience Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['experience_details'] as $index => $experience)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $experience->employer_name ?? 'N/A' }}</td>
                                    <td>{{ $experience->employer_details ?? 'N/A' }}</td>
                                    <td>{{ $experience->post_held ?? 'N/A' }}</td>
                                    <td>{{ $experience->from_date ?? 'N/A' }} - {{ $experience->to_date ?? 'N/A' }}</td>
                                    <td>{{ $experience->work_experience->fetch_year ?? 'N/A' }}</td>
                                    <td>{{ $experience->nature_of_duties ?? 'N/A' }}</td>
                                    <td>{{ $experience->job_type->job_type ?? 'N/A' }}</td>
                                    <td>{{ $experience->area_experties ? ($experience->area_experties->experties_area ?? 'N/A') : ($experience->other_area_of_expertise ?? 'N/A') }}</td>
                                    <td>
                                        @if (!empty($experience->experience_certificate))
                                            <a title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($experience['experience_certificate_filepath']) . '&fileName=' . urlencode($experience['experience_certificate']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>

                                            {{-- <a href="{{ $experience->experience_certificate_filepath }}" target="_blank"
                                                class="btn btn-sm btn-outline-primary"><i class="fa fa-eye"></i></a> --}}
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" style="text-align: center;">No work experience records available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Additional Details</h4>

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
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['additional_details'] as $index => $additional)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $additional->award_name ?? 'N/A' }}</td>
                                    <td>{{ $additional->award_details ?? 'N/A' }}</td>
                                    <td>
                                        @if (!empty($additional->award_certificate))
                                            <a href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($additional['award_certificate_filepath']) . '&fileName=' . urlencode($additional['award_certificate']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" style="text-align: center;">No additional records available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Competitive Exam Details</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Name of Exam
                                </th>
                                <th scope="col">
                                    Score
                                </th>
                                <th scope="col">
                                    Appearing Year
                                </th>
                                <th scope="col">
                                    Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['competitive_details'] as $index => $competitive)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $competitive->examDetails->exam_name ?? 'N/A' }}</td>
                                    <td>{{ $competitive->score ?? 'N/A' }}</td>
                                    <td>{{ $competitive->appearingYear->passing_year ?? 'N/A' }}</td>
                                    <td>
                                        @if (!empty($competitive->certificate))
                                            <a href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($competitive['certificate_filepath']) . '&fileName=' . urlencode($competitive['certificate']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" style="text-align: center;">No competitive exam records available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <h4 class="applicat_cust-title mt-3">Training Details</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Name of Tarining/Certifications
                                </th>
                                <th scope="col">
                                    Descriptions
                                </th>
                                 <th scope="col">
                                    Start-End Date
                                </th>
                                <th scope="col">
                                    Certificate Expiry Date
                                </th>
                                <th scope="col">
                                    Training Certificate
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data['training_details'] as $index => $training)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $training->name_of_training ?? 'N/A' }}</td>
                                    <td>{{ $training->description ?? 'N/A' }}</td>
                                    <td>{{ $training->training_start_date ?? 'N/A' }} - {{ $training->training_end_date ?? 'N/A' }}</td>
                                    <td>{{ $training->certificate_expiry_date ?? 'N/A' }}</td>

                                    <td>
                                        @if (!empty($training->training_certificate))
                                            <a href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($training['training_certificate_filepath']) . '&fileName=' . urlencode($training['training_certificate']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                                        @else
                                            N/A
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;">No educational records available.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>

                <h4 class="applicat_cust-title mt-3">Disclosure Questions</h4>

                <div class="">
                    <div class="flex">
                        <h3 class="m-1 me-3">Whether you are convicted by any court at any time in your life?</h3>
                        @if (isset($data['disclouser_questions']['conviction']) && $data['disclouser_questions']['conviction'])
                            <a class="m-1" title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['disclouser_questions']['conviction_filepath']) . '&fileName=' . urlencode($data['disclouser_questions']['conviction']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                    <div class="flex">
                        <h3 class="m-1 me-3">Whether any criminal case is pending against you?</h3>
                        @if (isset($data['disclouser_questions']['criminal_case']) && $data['disclouser_questions']['criminal_case'])
                            <a class="m-1" title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['disclouser_questions']['criminal_case_filepath']) . '&fileName=' . urlencode($data['disclouser_questions']['criminal_case']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                    <div class="flex">
                        <h3 class="m-1 me-3">Whether any financial liabilities or any other obligation are pending with present employer?</h3>
                        @if (isset($data['disclouser_questions']['financial_liabilities']) && $data['disclouser_questions']['financial_liabilities'])
                            <a class="m-1" title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['disclouser_questions']['financial_liabilities_filepath']) . '&fileName=' . urlencode($data['disclouser_questions']['financial_liabilities']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                    <div class="flex">
                        <h3 class="m-1 me-3">Whether you have any conflict of interest with or pecuniary interest that you could derive by working in this assignment with the Government of India?</h3>
                        @if (isset($data['disclouser_questions']['conflict_of_interest']) && $data['disclouser_questions']['conflict_of_interest'])
                            <a class="m-1" title="View" href="{{ url('/resource-pool-portal/hr') . '/viewFiles?pathName=' . urlencode($data['disclouser_questions']['conflict_of_interest_filepath']) . '&fileName=' . urlencode($data['disclouser_questions']['conflict_of_interest']) }}" target="_blank" class="btn btn-sm btn-outline-primary">View Files</a>
                        @else
                            <span>No</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="inner_page_dash__">
          <div class="my-4">

            <h4 class="applicat_cust-title mt-3">Selection History</h4>

                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="selectionHistory">
                        <thead class=" ">
                            <tr>
                                <th scope="col" class=" ">
                                    #
                                </th>
                                <th scope="col">
                                    Requisition ID
                                </th>
                                <th scope="col">
                                    Status of Committee
                                </th>
                                <th scope="col">
                                    Remark of Committee
                                </th>
                                <th scope="col">
                                    Status of Chairperson
                                </th>
                                <th scope="col">
                                    Remark of Chairperson
                                </th>
                                <th scope="col">
                                    Status of Interview
                                </th>
                                <th scope="col">
                                    Remark of Interview
                                </th>
                            </tr>
                        </thead>
                    </table>
                </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/resource-pool/selection-history.js') }}"></script>
@endpush
