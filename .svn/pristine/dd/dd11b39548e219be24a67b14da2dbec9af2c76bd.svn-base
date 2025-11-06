<div>
    <div style="display: inline-block; vertical-align: top; padding-left: 1rem;">
        <img src="{{ public_path('/images/logo.png') }}" alt="NHIDCL Logo" style="width: 144px; height: auto;">
    </div>
    <div style="display: inline-block; vertical-align: bottom; margin-left: 10px;">
        <h4 style="margin: 0; padding: 0;">Resource Pool Portal</h4>
        <p style="margin-top: 0; padding-top: 0; margin-bottom: 5px; padding-bottom: 0;">National Highways &amp;
            Infrastructure Development Corporation Limited</p>
    </div>
</div>
<!-- Candidate Photos & Signature Section -->
<div style="display: flex; flex-direction: row; text-align:center; padding: 0px; margin: 0px; padding-left: 1rem; padding-right: 1rem; margin-top: 3rem; ">
    <!-- Profile Photo -->
    <div style="display: inline-block; margin-right: 8rem; text-align: center;">
        <div style="border: 1px solid #ccc; padding: 1rem;">
            @if (!empty($userPhoto))
                <img src="data:image/{{ pathinfo($userPhoto, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($userPhoto)) }}"
                    width="100" height="100" style="object-fit: cover;" />
            @else
                <div style="width: 100px; height: 100px; background-color: #f0f0f0;"></div>
            @endif
        </div>
        <div style="margin-top: 0.5rem;">Photo</div>
    </div>

    <!-- Signature Image -->
    {{-- <div style="display: inline-block; text-align: center; margin-left: 100px; margin-right: 100px;">
        <div style="border: 1px solid #ccc; padding: 1rem;">
            <img src="https://abc/sign.png" alt="signature" width="100" height="100" style="object-fit: cover;" />
        </div>
        <div style="margin-top: 0.5rem;">Sign of the candidate as uploaded.</div>
    </div> --}}

    <!-- Empty Signature Box -->
    <div style="display: inline-block; text-align: center; margin-left: 8rem;">
        @if (!empty($userSignature))
            <img src="data:image/{{ pathinfo($userSignature, PATHINFO_EXTENSION) }};base64,{{ base64_encode(file_get_contents($userSignature)) }}"
                width="100" height="100" style="object-fit: cover;" />
        @else
            <div style="border: 1px solid #ccc; width: 100; height: 100; object-fit: cover;"></div>
        @endif
        <div style="margin-top: 0.5rem;">Signature</div>
    </div>
</div>
<hr
    style="height: 1px; padding: 0px; margin: 0px; border: 1px; color: black; background-color: black; margin-left: 1rem; margin-right: 1rem;" />
<div style="padding: 0px; margin: 0px; padding-left: 1rem; padding-right: 1rem; margin-bottom: 1rem;">
    <div>
        <h4>Persnal Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.8rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Application ID</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $user->id }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Applied For</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $data['personal_details']['engagementType']->engagement_type ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Gender</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['gender'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Father/Husband Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['father_husband_name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Date of Birth</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $user->date_of_birth }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Contact Number</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $user->mobile }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Email</td>
                        <td style="word-wrap: break-word; white-space: normal;">{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Spouse Name</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['spouse_name'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Spouse Number</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['spouse_mobile_no'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Correspondence Address</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['correspondence_address'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Pin Code</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['pincode'] ?? '' }}</td>
                    </tr>
                    <tr>
                        <td style="word-wrap: break-word; white-space: normal;">Permanent Address</td>
                        <td style="word-wrap: break-word; white-space: normal;">
                            {{ $data['personal_details']['permanent_address'] ?? '' }}</td>
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
                        <th>Qualification</th>
                        <th>Board/University/College</th>
                        <th>Main Subject/Stream</th>
                        <th>Course</th>
                        <th>Course Mode</th>
                        <th>Passing Year</th>
                        <th>Percentage</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['educational_details'] as $index => $education)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $index + 1 }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{
                                    $education->qualification
                                        ? ($education->qualification->qualification_name === 'Others'
                                            ? ($education->other_qualification ?? 'N/A')
                                            : ($education->qualification->qualification_name ?? 'N/A'))
                                        : ($education->other_qualification ?? 'N/A')
                                }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->board_university_college ? ($education->board_university_college->name == 'Others' ? $education->other_board_university_collage : $education->board_university_college->name) : 'N/A' }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->main_subject ? $education->main_subject->subject_name ?? 'N/A' : $education->other_main_subject ?? 'N/A' }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->course ? ($education->course->course_name == 'Others' ? $education->other_course : $education->course->course_name) : 'N/A' }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->course_mode->course_mode ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->ref_passing_year->passing_year?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $education->percentage ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" style="text-align: center;">No educational records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h4 class="applicat_cust-title mt-3">Work Experience</h4>

        <div style="position: relative; overflow-x: scroll;">
            <table border="1" cellpadding="5" cellspacing="0" style="width:100%; font-size:0.813rem; border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Employer/Organization Name</th>
                        <th>Employer Details</th>
                        <th>Post Held</th>
                        <th>From - To Date</th>
                        <th>Experience</th>
                        <th>Nature of Duties</th>
                        <th>Job Type</th>
                        <th>Area of Expertise</th>
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
                            <td>
                                {{ $experience->area_experties ? $experience->area_experties->experties_area ?? 'N/A' : $experience->other_area_of_expertise ?? 'N/A' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align: center;">No work experience records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        
        <h4 class="applicat_cust-title mt-3">Competitive Exam Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Name of Exam</th>
                        <th>Score</th>
                        <th>Appearing Year</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['competitive_details'] as $index => $competitive)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $index + 1 }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $competitive->examDetails->exam_name ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $competitive->score ?? 'N/A' }}
                            </td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $competitive->appearingYear->passing_year ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" style="text-align: center;">No competitive exam records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h4 class="applicat_cust-title mt-3">Additional Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Award/Achievement Name</th>
                        <th>Award/Achievement Details</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['additional_details'] as $index => $additional)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $index + 1 }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $additional->award_name ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $additional->award_details ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align: center;">No additional records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <h4 class="applicat_cust-title mt-3">Training Details</h4>
        <div style="position: relative; overflow-x: scroll;">
            <table border="1"
                style="width: 100%; font-size: 0.813rem; text-align: start; white-space: nowrap; border-spacing: 1px; border-radius: 8px; border-collapse: collapse;">
                <thead class=" ">
                    <tr>
                        <th>#</th>
                        <th>Name of Training/Certifications</th>
                        <th>Descriptions</th>
                        <th>Start-End Date</th>
                        <th>Certificate Expiry Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data['training_details'] as $index => $training)
                        <tr>
                            <td style="word-wrap: break-word; white-space: normal;">{{ $index + 1 }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $training->name_of_training ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $training->description ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $training->training_start_date ?? 'N/A' }} -
                                {{ $training->training_end_date ?? 'N/A' }}</td>
                            <td style="word-wrap: break-word; white-space: normal;">
                                {{ $training->certificate_expiry_date ?? 'N/A' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center;">No training records available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

        </div>

        <h4 class="applicat_cust-title mt-3">Disclosure Questions</h4>
        <div style="position: relative; overflow-x: auto;">
            <table border="1"
                style="width: 100%; table-layout: fixed; font-size: 0.8rem; text-align: left; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            Whether you are convicted by any court at any time in your life?
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['conviction']) && $data['disclouser_questions']['conviction'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            Whether any criminal case is pending against you?
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['criminal_case']) && $data['disclouser_questions']['criminal_case'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            Whether any financial liabilities or any other obligation are pending with present employer?
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['financial_liabilities']) && $data['disclouser_questions']['financial_liabilities'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            Whether you have any conflict of interest with or pecuniary interest that you could derive
                            by working in this assignment with the Government of India?
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['conflict_of_interest']) && $data['disclouser_questions']['conflict_of_interest'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h4 class="applicat_cust-title mt-3">Terms and Conditions:</h4>
        <div style="position: relative; overflow-x: auto;">
            <table border="1"
                style="width: 100%; table-layout: fixed; font-size: 0.8rem; text-align: left; border-collapse: collapse;">
                <tbody>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            I have gone through the procedure and guidelines for engagement of Senior Consultants/Consultants Grade-2/Consultants Grade-1/Young Professionals and agreed to the terms and conditions given there.
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['terms_agreement']) && $data['disclouser_questions']['terms_agreement'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            I undertake to submit the original documentary proof in respect of my educational qualifications, working experience, Date of Birth, address, and all other documents submitted by me as and when asked.
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['documentary_proof']) && $data['disclouser_questions']['documentary_proof'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            I understand that I fulfill the eligibility criteria via age, educational qualification, and required work experience as per the Guidelines for the position applied. In case of non-eligibility, my candidature is liable to be rejected without informing me.
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['eligibility_criteria']) && $data['disclouser_questions']['eligibility_criteria'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 80%; word-wrap: break-word; word-break: break-word; padding: 8px;">
                            I am well aware that the information furnished in the application and resume, duly supported by the documents in respect of Essential Qualification/Work Experience submitted by me, will also be assessed by the selection committee at the time of selection for the position. The information details provided by me are correct and true to the best of my knowledge, and no material fact having bearing on my selection has been suppressed or withheld.
                        </td>
                        <td style="width: 20%; padding: 8px;">
                            {{ isset($data['disclouser_questions']['information_accuracy']) && $data['disclouser_questions']['information_accuracy'] ? 'Yes' : 'No' }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
