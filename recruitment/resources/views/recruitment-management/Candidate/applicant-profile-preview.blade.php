@extends('layouts.dashboard')
@section('meta-head')
    <meta name="session-tab" content="{{ session('tab') ?? 0 }}">
@endsection

@section('dashboard_content')
    <div id="loader"></div>
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Applicant Profile</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            @include('components.alert')
            <div class="profile-preview" >
                <div class="text-right">
                    <button class="hover-effect-btn fill_btn" onclick="downloadPDF()">Download Profile</button>
                </div>
                <div id="profileDiv">
                    <div class="applicat_cust-container mt-3">
                        <div class="applicat_cust-row">
                            @if (!empty($previewData?->upload_photos))
                            <div class="applicat_cust-label">
                                <div class="w-fit text-center">
                                    <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}" alt="" width="100" height="100">
                                    <h4 class="applicat_cust-title text-center">Passport Size Photo</h4>
                                </div>
                            </div>
                            @endif
                            @if (!empty($previewData?->upload_signature))
                            <div class="applicat_cust-value">
                                <div class="w-fit text-center">
                                    <img class="img-responsive" src="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}" alt="" width="100" height="100">
                                    <h4 class="applicat_cust-title text-center">Signature</h4>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="download_prive_cust">
                        <h4 class="applicat_cust-title">Personal Details</h4>
                    </div>
                    <div class="applicat_cust-container">
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Application ID</div>
                            <div class="applicat_cust-value" id="previewId">
                                {{ 
                                $recordApplication?->action === 'draft'
                                    ? ($recordApplication?->id ?? '')
                                    : (
                                        $recordApplication?->action
                                            ? 'NHIDCL/' . date('Y') . '/' . ($record->id ?? '') . '/' . ($previewData?->user?->id ?? '')
                                            : ($recordApplication?->id ?? $previewData?->user?->id)
                                    )
                                }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Post Name</div>
                            <div class="applicat_cust-value" id="previewName">{{ $record?->post_name ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Full Name</div>
                            <div class="applicat_cust-value" id="previewName">{{ $previewData?->user?->name ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Father’s/Husband’s Name</div>
                            <div class="applicat_cust-value" id="previewFnameHname">
                                {{ $previewData?->father_husband_name ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Mother Name</div>
                            <div class="applicat_cust-value" id="previewFnameHname">
                                {{ $previewData?->mother_name ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Email</div>
                            <div class="applicat_cust-value" id="previewEmail">
                                {{ $previewData?->user?->email ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Mobile No</div>
                            <div class="applicat_cust-value" id="previewMobileNo">
                                {{ $previewData?->user?->mobile ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Date of Birth</div>
                            <div class="applicat_cust-value" id="previewDob">
                                {{ \Carbon\Carbon::parse($previewData?->user?->date_of_birth)->format('d-m-Y') }}
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.    
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->dob_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->dob_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.  
                            </label>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Gender</div>
                            <div class="applicat_cust-value" id="previewGender">{{ $previewData?->gender ?? '' }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Marital Status</div>
                            <div class="applicat_cust-value">{{ $previewData?->marital_status ?? '' }}</div>
                        </div>
                        @if($previewData?->marital_status=="Married")
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Spouse Name</div>
                            <div class="applicat_cust-value">{{ $previewData?->spouse_name ?? '' }}</div>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Citizenship</div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->indian_citizen ?? '' }}</div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->citizenship_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                             </div> --}}

                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->citizenship_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                       
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Category</div>
                            <div class="applicat_cust-value">{{ optional($previewData)->caste->caste ?? '' }}
                                @if (!empty($previewData?->upload_caste_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_caste_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_caste_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank">
                                        <small>View Certificate</small>
                                    </a>
                                @endif
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->category_confirm == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        @if (strtolower(optional($previewData)->caste->caste ?? '') !== 'general')
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->category_confirm == 1 ? 'checked' : '' }} disabled>
                                   I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Aadhaar Number</div>
                            <div class="applicat_cust-value">{{ optional($previewData)->aadhar_number ?? '' }}</div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Ex Service Man</div>
                            <div class="applicat_cust-value">
                                {{ is_null(optional($previewData)->ex_serviceman) ? '' : (optional($previewData)->ex_serviceman ? 'Yes' : 'No') }}
                            </div>
                        </div>
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.    
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->ex_serviceman_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div> --}}
                        @if (optional($previewData)->ex_serviceman)
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->ex_serviceman_consent == 1 ? 'checked' : '' }} disabled>
                                 I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.   
                            </label>
                        </div>
                        @endif
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Whether you are PwBD or not</div>
                            <div class="applicat_cust-value">
                                {{ $previewData?->pwbd ?? '' }}
                            </div>
                        </div>
                        @if($previewData?->pwbd==="Yes")
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Nature of disability</div>
                            <div class="applicat_cust-value">
                                {{ $previewData?->disability ?? '' }}
                            </div>
                        </div>
                        @endif
                        @if (strtolower(optional($previewData)->pwbd) === "yes")
                        <div class="mt-2 p-4">
                            <label>
                                <input type="checkbox"  {{ $previewData?->disability_consent == 1 ? 'checked' : '' }} disabled>
                                I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                        @endif
                        {{-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">
                                I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </div>
                            <div class="applicat_cust-value" id="previewGender">
                                {{ $previewData?->disability_consent == 1 ? 'Yes' : 'No' }}
                            </div>
                        </div>
                         --}}

                        {{-- <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Religion</div>
                        <div class="applicat_cust-value">{{ optional($previewData)->religion ?? ''  }}</div>
                        </div> --}}
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Correspondence Address</div>
                            <div class="applicat_cust-value" id="previewCaddress">
                                {{ implode(
                                    ', ',
                                    array_filter([
                                        $previewData?->correspondence_address,
                                        $previewData?->correspondence_city,
                                        $previewData?->correspondenceState?->name . ', ' . $previewData?->correspondence_pincode,
                                    ]),
                                ) }}
                            </div>
                        </div>
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Permanent Address</div>
                            <div class="applicat_cust-value" id="previewPaddress">
                                {{ implode(
                                    ', ',
                                    array_filter([
                                        $previewData?->permanent_address,
                                        $previewData?->permanent_city,
                                        $previewData?->permanentState?->name . ', ' . $previewData?->permanent_pincode,
                                    ]),
                                ) }}
                            </div>
                        </div>
                        @if (!empty($previewData?->upload_photos_filepath) && !empty($previewData?->upload_photos))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Candidate Photo</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_photos))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_photos_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_photos) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Photo</small></a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if (!empty($previewData?->upload_signature_filepath) && !empty($previewData?->upload_signature))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Candidate Signature</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_signature))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_signature_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_signature) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Signature</small></a>
                                @endif
                            </div>
                        </div>
                        @endif
                        @if (!empty($previewData?->upload_identity_proof_filepath) && !empty($previewData?->upload_identity_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Identity Proof</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_identity_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_identity_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_identity_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Identity Proof</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (!empty($previewData?->upload_identity_caste_certificate_filepath) && !empty($previewData?->upload_caste_certificate))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Caste/Category Proof</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_caste_certificate))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_caste_certificate_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_caste_certificate) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Caste Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (optional($previewData)->pwbd === 'Yes' && !empty($previewData?->upload_disability_proof_filepath) && !empty($previewData?->upload_disability_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof of Physically Disabled</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_disability_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_disability_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_disability_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (optional($previewData)->ex_serviceman && !empty($previewData?->upload_ex_serviceman_proof_filepath) && !empty($previewData?->upload_ex_serviceman_proof))
                        <!-- <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof of Ex Serviceman</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_ex_serviceman_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_ex_serviceman_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_ex_serviceman_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div> -->
                        @endif
                        @if (!empty($previewData?->upload_dob_proof_filepath) && !empty($previewData?->upload_dob_proof))
                        <div class="applicat_cust-row">
                            <div class="applicat_cust-label">Proof Of DOB</div>
                            <div class="applicat_cust-value">
                                @if (!empty($previewData?->upload_dob_proof))
                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files') . '?pathName=' . urlencode(optional($previewData)->upload_dob_proof_filepath) . '&fileName=' . urlencode(optional($previewData)->upload_dob_proof) }}"
                                        class="text-hover btn btn-default btn-sm" target="_blank"><small>View Certificate</small></a>
                                @endif
                            </div>
                        </div>
                         <div class="mt-2 p-4">
                                <label>
                                    <input type="checkbox" checked disabled>
                                   I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                                </label>
                            </div>
                        @endif
                    </div>
                    <h4 class="applicat_cust-title mt-3">Education Qualification</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Examination</th>
                                    <th>Name of Institute/College</th>
                                    <th>University/Board</th>
                                    <th>Passing Year</th>
                                    <th>Percentage/CGPA</th>
                                    <!-- <th>Marksheet/Degree</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData?->education ?? [] as $educationData)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $educationData->examination }}</td>
                                        <td>{{ $educationData->institute_name }}</td>
                                        <td>{{ $educationData->university_board }}</td>
                                        <td>{{ $educationData->passingYear->passing_year }}</td>
                                        <td>{{ $educationData->percentage_cgpa }}</td>

                                        <!-- <td>
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                                'pathName' => $educationData->marksheet_filepath,
                                                'fileName' => $educationData->marksheet,
                                            ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Marksheet
                                            </a>
                                        </td> -->
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label><input type="checkbox" checked disabled> I hereby undertake to submit the documents regarding education qualification at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</label>
                        </div>
                    </div>
                    @if ($record?->required_gate_detail == '1')
                    <h4 class="applicat_cust-title mt-3">GATE Score Details</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class=" ">
                                <tr>
                                    <th>#</th>
                                    <th>Registration Number</th>
                                    <th>Exam Year</th>
                                    <th>GATE Discpline</th>
                                    <th>GATE Score</th>
                                    <th>GATE Scorecard Certificate</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData->gatescore ?? [] as $gatescoreData)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $gatescoreData->gate_registration_number }}</td>
                                        <td>{{ optional($gatescoreData->passingYear)->passing_year }}
                                        </td>
                                        <td>{{ optional($gatescoreData->gateDiscpline)->discipline_name }}
                                        </td>
                                        <td>{{ $gatescoreData->gate_score }}</td>
                                        <td><a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                            'pathName' => $gatescoreData->gatescore_certificate_filepath,
                                            'fileName' => $gatescoreData->gatescore_certificate,
                                        ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Certificate
                                            </a></td>
                                        
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="5">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label>
                                <input type="checkbox" checked disabled>
                                I hereby undertake to submit my GATE Score card at the time of document verification, if shortlisted and give my consent for use of my GATE login credentials for verification/re-verification of my GATE Score by NHIDCL. I do understand that my documents are liable for scrutiny/verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/offer of appointment/ appointment at any time.
                            </label>
                        </div>
                    </div>
                    @endif
                    @if($previewData?->submit_experience!=2)
                    <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <!-- <th>Work Experience Certificate</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($previewData?->experience ?? [] as $experienceData)
                                    @php
                                        $from = \Carbon\Carbon::parse(
                                            $experienceData->from_date,
                                        );
                                        $to = $experienceData->to_date
                                            ? \Carbon\Carbon::parse($experienceData->to_date)
                                            : now();

                                        $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                        $experience = [];
                                        if ($diff->y > 0) {
                                            $experience[] =
                                                $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                        }
                                        if ($diff->m > 0) {
                                            $experience[] =
                                                $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                        }
                                        //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                        $experienceText = count($experience)
                                            ? implode(' ', $experience)
                                            : 'less than 1 Month';
                                    @endphp
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td>{{ $experienceData->employer_name }}</td>
                                        <td>{{ $experienceData->post_held }}</td>
                                        <td>{{ $from->format('d M Y') }} -
                                            {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}
                                        </td>
                                        <td>{{ $experienceText }}</td>
                                        <td>{{ $experienceData->job_description }}</td>
                                        <!-- <td>
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.viewfiles', [
                                                'pathName' => $experienceData->experience_certificate_filepath,
                                                'fileName' => $experienceData->experience_certificate,
                                            ]) }}"
                                                class="btn btn-default btn-sm" target="_blank">
                                                View Certificate
                                            </a>
                                        </td> -->
                                    </tr>
                                @empty
                                    <tr>
                                        <th colspan="6">No Records found</th>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div class="mt-2 text-sm">
                            <label for="experience_consent" class="dark:text-gray-600 cursor-pointer text-sm"><input type="checkbox" checked disabled>
                                I hereby undertake to submit the documents regarding work experience, at the time of document verification, if shortlisted.
                                I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                            </label>
                        </div>
                    </div>
                    @else
                    <h4 class="applicat_cust-title mt-3">Work Experience</h4>
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employer Name</th>
                                    <th>Post Held</th>
                                    <th>From - To Date</th>
                                    <th>Experience</th>
                                    <th>Brief Job Description</th>
                                    <!-- <th>Work Experience Certificate</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th colspan="6">No</th>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    @endif

                    <h4 class="applicat_cust-title mt-3">State Group</h4>
                    <div class="p-4">
                        <label for="experience_consent" class="dark:text-gray-600 cursor-pointer text-sm"><input type="checkbox" checked disabled>
                            I hereby confirm that, if selected, I may be allocated to a particular State Group on the basis of principle of Merit-cum-Choice through a counselling session. NHIDCL Cadre Rules, 2025; specifically Rule 6.5 and Rule 6.6 shall be referred for more details.
                        </label>
                    </div>

                    <h4 class="applicat_cust-title mt-3">Declaration:- </h4>
                    <p class="mb-4 fs-14">I hereby undertake to submit the following documents at the time of document verification, if shortlisted:</p>
                    <label for="consent_one">
                        <input type="checkbox" name="consent_one" id="consent_one" data-validate="required" data-error="You must accept consent one of application."
                            {{ $recordApplication?->consent_one == 1 ? 'checked' : '' }} disabled required>
                        Medical Examination Certificate by the Medical Board in the prescribed proforma.
                    </label><br>
                    <label for="consent_two">
                        <input type="checkbox" name="consent_two" id="consent_two" data-validate="required" data-error="You must accept consent two of application."
                            {{ $recordApplication?->consent_two == 1 ? 'checked' : '' }} disabled required>
                        I am willing to serve anywhere in India/Outside.
                    </label><br>
                    <label for="consent_three">
                        <input type="checkbox" name="consent_three" id="consent_three" data-validate="required" data-error="You must accept consent three of application."
                            {{ $recordApplication?->consent_three == 1 ? 'checked' : '' }} disabled required>
                        I have carefully gone through the vacancy advertisement and I solemnly
                            declare and undertake that all the information furnished by me is true, correct and complete to
                            the best of my knowledge and belief. I undertake that, if at any stage of the
                            selection or even after selection, any of the information furnished by me is found to be
                            false, incorrect or misleading, then my candidature/appointment/service will stand
                            cancelled / terminated without assigning any reason. I will produce the original documents
                            in support of the information furnished when so ever required by the National Highways
                            & Infrastructure Development Corporation Ltd. (NHIDCL).
                    </label><br>
                    <p><small>Place: <b>{{ $recordApplication?->place_of_application }}</b></small></p>
                    <p><small>Date And Time: <b>{{ \Carbon\Carbon::parse($recordApplication?->applied_at)->format('d-m-Y h:i:s A') }}</b></small></p>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
<script>
function downloadPDF() {
    const loader = document.querySelector(".loader");
    loader.style.display = "block";

    // hide after 4 seconds (4000 ms)
    setTimeout(() => {
        loader.style.display = "none";
    }, 4000);
    
    const element = document.getElementById("profileDiv").cloneNode(true);
    // Remove all hrefs (make links plain text)
    element.querySelectorAll("a").forEach(a => {
        // Option 1: Keep text only
        const span = document.createElement("span");
        span.innerHTML = a.innerHTML; // keep inner content (like "View Proof")
        a.parentNode.replaceChild(span, a);

        // Option 2 (if you want them hidden instead):
        // a.style.pointerEvents = "none";
        // a.removeAttribute("href");
    });
    const opt = {
        margin: 0.5,
        filename: '{{ $previewData?->user?->name."-profile" ?? "applicant-profile" }}.pdf',
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };

    html2pdf().set(opt).from(element).save();
}
</script>
@endpush