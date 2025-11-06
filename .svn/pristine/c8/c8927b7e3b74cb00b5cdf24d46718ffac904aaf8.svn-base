<div>
    <div style="display: inline-block; vertical-align: top; padding-left: 1rem;">
        <img src="{{ public_path('/images/logo.png') }}" alt="NHIDCL Logo" style="width: 144px; height: auto;">
    </div>
    <div style="display: inline-block; vertical-align: bottom; margin-left: 10px;">
        <h4 style="margin: 0; padding: 0;">Recruitment Portal</h4>
        <p style="margin-top: 0; padding-top: 0; margin-bottom: 5px; padding-bottom: 0;">National Highways &amp;
            Infrastructure Development Corporation Limited</p>
    </div>
</div>
<hr
    style="height: 1px; padding: 0px; margin: 0px; border: 1px; color: black; background-color: black; margin-left: 1rem; margin-right: 1rem;" />
<div style="padding: 0px; margin: 0px; padding-left: 1rem; padding-right: 1rem; margin-bottom: 1rem;">
    <div>
        <h4>Personal Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table style="width: 100%; text-align: center; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ccc; padding: 1rem;">
                        @if (!empty($userPhoto))
                            <img src="data:image/{{ pathinfo($userPhoto, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($userPhoto)) }}"
                                width="100" height="100" style="object-fit: cover;" />
                        @else
                            <div style="width: 100px; height: 100px; background-color: #f0f0f0;"></div>
                        @endif
                        <div style="margin-top: 0.5rem;">Candidate Photo</div>
                    </td>

                    <td style="border: 1px solid #ccc; padding: 1rem;">
                        @if (!empty($userSignature))
                            <img src="data:image/{{ pathinfo($userSignature, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($userSignature)) }}"
                                width="100" height="100" style="object-fit: cover;" />
                        @else
                            <div style="width: 100px; height: 100px; background-color: #f0f0f0;"></div>
                        @endif
                        <div style="margin-top: 0.5rem;">Signature of the Candidate</div>
                    </td>
                </tr>
            </table>
            <table border="1"
                style="width: 100%; font-size: 0.8rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Application ID</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ ('NHIDCL/' . date('Y') . '/' . ($record?->id ?? '') . '/' . ($previewData?->user?->id ?? '')) ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Post Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $record?->post_name ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Full Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $previewData?->name ?? $previewData?->user?->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Father`s/Husband`s Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $previewData?->father_husband_name ?? ''  }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Mother Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $previewData?->mother_name ?? ''  }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Email</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $previewData?->email ?? $previewData?->user?->email ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Contact Number</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $previewData?->mobile ?? $previewData?->user?->mobile ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Date of Birth</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            @php
                                $dob = $previewData?->date_of_birth ?? $previewData?->user?->date_of_birth;
                            @endphp
                            {{ $dob ? \Carbon\Carbon::parse($dob)->format('d-m-Y') : '' }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="word-wrap: break-word; white-space: normal;"> <input type="checkbox" style="margin-top:2px" {{ $previewData?->dob_consent == 1 ? 'checked' : '' }}  disabled> 
                        I hereby undertake to provide the original documents regarding date of birth, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Gender</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $previewData?->gender ?? ''  }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Martital Status</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ optional($previewData)->marital_status ?? ''  }}
                        </td>
                    </tr>
                    @if(optional($previewData)->marital_status == "Married")
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">Spouse Name</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ optional($previewData)->spouse_name ?? ''  }}
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Citizenship</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ optional($previewData)->indian_citizen ?? ''  }}
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="word-wrap: break-word; white-space: normal;"><input type="checkbox" style="margin-top:2px" {{ $previewData?->citizenship_consent == 1 ? 'checked' : '' }} disabled> I hereby undertake to submit the documents regarding citizenship, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</td>
                    </tr>
          
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Category</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ optional($previewData)->caste->caste ?? ''  }}
                        </td>
                    </tr>
                    @if (strtolower(optional($previewData)->caste->caste ?? '') !== 'general')
                    <tr>
                        <td colspan="2" style="word-wrap: break-word; white-space: normal;">
                            <input type="checkbox" style="margin-top:2px" {{ $previewData?->category_confirm == 1 ? 'checked' : '' }} disabled>
                            I hereby undertake to submit the documents regarding category, as per the prescribed proforma, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Aadhar number</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ optional($previewData)->aadhar_number ?? ''  }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Ex Service Man</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ is_null(optional($previewData)->ex_serviceman) ? '' : (optional($previewData)->ex_serviceman ? 'Yes' : 'No') }}
                        </td>
                    </tr>
                    @if(optional($previewData)->ex_serviceman)
                    <tr>
                        <td colspan="2" style="word-wrap: break-word; white-space: normal;">
                            <input type="checkbox" style="margin-top:2px" {{ $previewData?->ex_serviceman_consent == 1 ? 'checked' : '' }} disabled>
                            I hereby undertake to submit the documents regarding ex-servicemen, as issued by the appropriate authority, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</td>
                    </tr>
                    @endif
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Whether you are PwBD or not </td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $previewData?->pwbd ?? '' }}
                        </td>
                    </tr>
                    @if($previewData?->pwbd=="Yes")
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">Nature of disability</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ optional($previewData)->disability ?? '' }}
                            </td>
                        </tr>
                    @endif
                    @if($previewData?->pwbd=="Yes")
                    <tr>
                        <td colspan="2" style="word-wrap: break-word; white-space: normal;">
                            <input type="checkbox" style="margin-top:2px" {{ $previewData?->disability_consent == 1 ? 'checked' : '' }} disabled>
                            I hereby clarify that my disability is not less than 40%. I hereby undertake to submit the documents regarding disability, as per the prescribed proforma, at the time of document verification, if shortlisted.
                            I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
                        </td>
                    </tr>
                    @endif
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Correspondence Address</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ implode(', ', array_filter([
                                $previewData?->correspondence_address,
                                $previewData?->correspondence_city,
                                $previewData?->correspondenceState?->name . ', ' . $previewData?->correspondence_pincode
                            ])) }}
                        </td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Permanent Address</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ implode(', ', array_filter([
                                $previewData?->permanent_address,
                                $previewData?->permanent_city,
                                $previewData?->permanentState?->name . ', ' . $previewData?->permanent_pincode
                            ])) }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="applicat_cust-title mt-3">Education Qualification</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.8rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Examination</th>
                        <th>Name of Institute/College</th>
                        <th>University/Board</th>
                        <th>Passing Year</th>
                        <th>Percentage/CGPA</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($previewData?->education ?? [] as $educationData)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $loop->iteration }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $educationData->examination }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $educationData->institute_name }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $educationData->university_board }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $educationData->passingYear->passing_year }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $educationData->percentage_cgpa }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No educational records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <label><input type="checkbox" style="margin-top:2px" checked disabled> I hereby undertake to submit the documents regarding education qualification at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.</label>
        </div>
        @if ($record->required_gate_detail == '1')
        <h4 class="applicat_cust-title mt-3">GATE Score Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Reg. Number</th>
                        <th>Exam Year</th>
                        <th>Discpline</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($previewData->gatescore ?? [] as $gatescoreData)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $loop->iteration }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $gatescoreData->gate_registration_number }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ optional($gatescoreData->passingYear)->passing_year }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ optional($gatescoreData->gateDiscpline)->discipline_name }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $gatescoreData->gate_score }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No gate score records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <label>
                <input type="checkbox" style="margin-top:2px" {{ $gatescoreData->gate_consent == 1 ? 'checked disabled' : 'disabled' }}> 
                I hereby undertake to submit my GATE Score card at the time of document verification, if shortlisted and give my consent for use of my GATE login credentials for verification/re-verification of my GATE Score by NHIDCL. I do understand that my documents are liable for scrutiny/verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/offer of appointment/ appointment at any time.
            </label>
        </div>
        @endif
        
        @if($previewData?->submit_experience!=2)
        <h4 class="applicat_cust-title mt-3">Work Experience</h4>
        @if(isset($previewData) && sizeof($previewData?->experience)>0)
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Employer Name</th>
                        <th>Post Held</th>
                        <th>From - To Date</th>
                        <th>Experience</th>
                        <th>Brief Job Description</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($previewData->experience ?? [] as $experienceData)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $loop->iteration }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $experienceData->employer_name }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $experienceData->post_held }}</td>
                            @php
                                $from = \Carbon\Carbon::parse($experienceData->from_date);
                                $to = $experienceData->to_date ? \Carbon\Carbon::parse($experienceData->to_date) : now();

                                $diff = $from->diff($to); // gives DateInterval (years, months, days)

                                $experience = [];
                                if ($diff->y > 0)
                                    $experience[] = $diff->y . ' Year' . ($diff->y > 1 ? 's' : '');
                                if ($diff->m > 0)
                                    $experience[] = $diff->m . ' Month' . ($diff->m > 1 ? 's' : '');
                                //if ($diff->d > 0) $experience[] = $diff->d . ' Day' . ($diff->d > 1 ? 's' : '');

                                $experienceText = count($experience) ? implode(' ', $experience) : 'less than 1 Month';
                            @endphp
                            <td>{{ $from->format('d M Y') }} -
                                {{ $experienceData->to_date ? $to->format('d M Y') : 'Present' }}
                            </td>
                            <td>{{ $experienceText }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $experienceData->job_description }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center;">No work experience records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <label><input type="checkbox" style="margin-top:2px" checked>
               I hereby undertake to submit the documents regarding work experience, at the time of document verification, if shortlisted. I do understand that my documents are liable for scrutiny/ verification and any discrepancies in the genuineness of the documents will lead to cancellation of my candidature/ offer of appointment/ appointment; at any time.
            </label>
        </div>
        @else
         <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Employer Name</th>
                        <th>Post Held</th>
                        <th>From - To Date</th>
                        <th>Experience</th>
                        <th>Brief Job Description</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th colspan="6">No</th>
                    </tr>
                </tbody>
            </table>
        @endif
        @endif
        <div style="position: relative; overflow-x: scroll;">
            <h4 class="applicat_cust-title mt-3">State Group:-</h4>
            <label><input type="checkbox" style="margin-top:2px" checked>
                I hereby confirm that, if selected, I may be allocated to a particular State Group on the basis of principle of Merit-cum-Choice through a counselling session. NHIDCL Cadre Rules, 2025; specifically Rule 6.5 and Rule 6.6 shall be referred for more details.
            </label>
        </div>
        <h4 class="applicat_cust-title mt-3">Declaration:-</h4>
        <div style="position: relative; overflow-x: scroll;">
            <p class="mb-2 fs-14">I hereby undertake to submit the following documents at the time of document verification, if shortlisted:</p>
            <label><input type="checkbox" {{ $recordApplication?->consent_one === 1 ? 'checked' : '' }}> Medical Examination Certificate by the Medical Board in the prescribed proforma.</label><br>
            <label><input type="checkbox" {{ $recordApplication?->consent_two === 1 ? 'checked' : '' }}> I am willing to serve anywhere in India/Outside.</label><br>
            <label><input type="checkbox" {{ $recordApplication?->consent_three === 1 ? 'checked' : '' }}> I have carefully gone through the vacancy advertisement and I solemnly declare and undertake that all the
                information furnished by me is true, correct and complete to the best of my knowledge and belief. I
                undertake that, if at any stage of the selection or even after selection, any of
                the information furnished by me is found to be false, incorrect or misleading, then my
                candidature/appointment/service will stand cancelled / terminated without assigning
                any reason. I will produce the original documents in support of the information furnished when so ever
                required by the National Highways & Infrastructure Development
                Corporation Ltd. (NHIDCL)</label><br><br>
            {{-- <label><input type="checkbox" style="margin-top:2px" {{ $recordApplication?->consent_four === 1 ? 'checked' : '' }}> I have read NHIDCL Cadre Rules, 2025 & FAQs given at the NHIDCL Recruitment Portal.</label><br><br> --}}
            <label>Place: {{ $recordApplication?->place_of_application ?? '' }}</label><br>
            <label>Date And Time: {{ \Carbon\Carbon::parse($recordApplication?->applied_at)->format('d-m-Y h:i:s A') }}</label>
        </div>
    </div>
</div>