


<!-- Loader Div -->
<div id="loader"></div>

<div class="inner_page_dash__">
    <div class="my-4">
        <div id="application" class="tabcontent">
        <img class="img-responsive" src="data:image/png;base64,{{ $image }}" alt="" width="50" height="60">
            <h4 class="applicat_cust-title" style="font-size: 1rem !important;color: #000;font-weight: 600 !important;padding: 10px 0; text-align: center;">Candidate Information</h4>
            <div class="table_over" style="justify-content: center;display: flex;">
                <table style="     width: 100%;   border: 1px solid #ededed;" class="cust_table__ table_sparated">
                    <thead style="    background: #373737;color: #fff;font-weight: 400;">
                        <tr>
                            <th style="text-align:start;padding: 7px;" scope="col">Field</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr >
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Application ID</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewName">{{$personal_details->id}}</td>
                        </tr>
                        <tr >
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Name</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewName">{{$personal_details->full_name}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Gender</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewGender">{{$personal_details->gender}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Father/Husband Name</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewFnameHname">{{$personal_details->father_husband_name}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Date of Birth</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewDob">{{$personal_details->date_of_birth}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Contact Number</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewMobileNo">{{$personal_details->mobile_no}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Email</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewEmail">{{$personal_details->email}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed; border-bottom: 1px solid #ededed;padding: 8px 5px;">Correspondence Address</td>
                            <td style="border-bottom: 1px solid #ededed; padding-left: 10px;" id="previewCaddress">{{$personal_details->correspondence_address}}</td>
                        </tr>
                        <tr>
                            <td style="border-right: 1px solid #ededed;">Permanent Address</td>
                            <td style="padding-left: 10px;" id="previewPaddress">{{$personal_details->permanent_address}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Education Qualification Section -->
            <h4 class="applicat_cust-title mt-3" style="font-size: 1rem !important;color: #000;font-weight: 600 !important;padding: 10px 0; text-align: center;">Education Qualification</h4>
            <div class="table_over" style="justify-content: center;display: flex;">
                <table style="    border: 1px solid #ededed;" class="cust_table__ table_sparated">
                    <thead style="    background: #373737;color: #fff;font-weight: 400;">
                        <tr>
                            <th style="text-align:start;padding: 7px;" scope="col">#</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Qualification</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Board/University/College</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Main Subject</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Course Mode</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Passing Year</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Percentage</th>
                        </tr>
                    </thead>
                    <tbody id="preEdu">
                    @foreach($educational_details as $key=> $rowEdu)

                        <tr>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$key+1}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowEdu->qualification->qualification_name}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowEdu->board_university_college->name}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowEdu->main_subject->subject_name}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowEdu->course_mode->course_mode}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowEdu->passing_year}}</td>
                            <td>{{$rowEdu->percentage}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Work Experience Section -->
            <h4 class="applicat_cust-title mt-3" style="font-size: 1rem !important;color: #000;font-weight: 600 !important;padding: 10px 0; text-align: center;">Work Experience</h4>
            <div class="table_over" style="justify-content: center;display: flex;">
                <table style="    border: 1px solid #ededed;" class="cust_table__ table_sparated">
                    <thead style="    background: #373737;color: #fff;font-weight: 400;">
                        <tr>
                            <th style="text-align:start;padding: 7px;" scope="col">#</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Employer Name</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Post Held</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Experience</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Nature of Duties</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Job Type</th>


                        </tr>
                    </thead>
                    <tbody id="preWorkExp">
                    @foreach($experience_details as $key=> $rowwexp)
                        <tr>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$key+1}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowwexp->employer_name}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowwexp->post_held->post_held}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowwexp->work_experience_year->fetch_year}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowwexp->nature_of_duties}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{@$rowwexp->job_type->job_type}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Competitive Exam Details Section -->
            <h4 class="applicat_cust-title mt-3" style="font-size: 1rem !important;color: #000;font-weight: 600 !important;padding: 10px 0; text-align: center;">Competitive Exam Details</h4>
            <div class="table_over" style="justify-content: center;display: flex;">
                <table style="     width: 100%;   border: 1px solid #ededed;" class="cust_table__ table_sparated">
                    <thead style="    background: #373737;color: #fff;font-weight: 400;">
                        <tr>
                            <th style="text-align:start;padding: 7px;" scope="col">#</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Name of Exam</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Score</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Appearing Year</th>
                        </tr>
                    </thead>
                    <tbody id="preCompetDetails">
                    @foreach($competitive_details as $key=> $rowcomp)
                    <tr>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$key+1}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowcomp->examDetails->exam_name}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowcomp->score}}</td>
                            <td>{{@$rowcomp->appearingYear->passing_year}}</td>

                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Additional Details Section -->
            <h4 class="applicat_cust-title mt-3" style="font-size: 1rem !important;color: #000;font-weight: 600 !important;padding: 10px 0; text-align: center;">Additional Details</h4>
            <div class="table_over" style="justify-content: center;display: flex;">
                <table style="     width: 100%;   border: 1px solid #ededed;" class="cust_table__ table_sparated">
                    <thead style="    background: #373737;color: #fff;font-weight: 400;">
                        <tr>
                            <th style="text-align:start;padding: 7px;" scope="col">#</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Award/Achievement Name</th>
                            <th style="text-align:start;padding: 7px;" scope="col">Award/Achievement Details</th>

                        </tr>
                    </thead>
                    <tbody id="preAddDetails">
                    @foreach($additional_details as $key=> $rowAdd)
                    <tr>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$key+1}}</td>
                            <td style="border-right: 1px solid #ededed; padding: 8px 5px;">{{$rowAdd->award_name}}</td>
                            <td>{{$rowAdd->award_details}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


