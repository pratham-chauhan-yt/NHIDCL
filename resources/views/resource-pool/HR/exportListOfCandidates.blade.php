<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid black;
        padding: 8px;
        text-align: left;
    }

    th {
        font-weight: bold;
    }
</style>
<table>
    <thead>
        <tr>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Applicant ID</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Name</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Email</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Mobile No</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Father’s/Husband’s Name</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Gender</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">DOB</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Pin code</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Correspondence Address</th>
            <th rowspan="2" style="border: 1px solid black; font-weight: bold;">Permanent Address</th>
            <th colspan="8" style="border: 1px solid black; font-weight: bold;">Education Qualification</th>
            <th colspan="4" style="border: 1px solid black; font-weight: bold;">Work Experience</th>
            <th colspan="2" style="border: 1px solid black; font-weight: bold;">Additional Details</th>
            <th colspan="4" style="border: 1px solid black; font-weight: bold;">Competitive Exam Details</th>
            <th colspan="3" style="border: 1px solid black; font-weight: bold;">Training Details</th>
            <th colspan="4" style="border: 1px solid black; font-weight: bold;">Disclosure Questions</th>
        </tr>
        <tr>
            <th style="border: 1px solid black; font-weight: bold;">Qualification</th>
            <th style="border: 1px solid black; font-weight: bold;">Course</th>
            <th style="border: 1px solid black; font-weight: bold;">Board/University/College</th>
            <th style="border: 1px solid black; font-weight: bold;">Main Subject</th>
            <th style="border: 1px solid black; font-weight: bold;">Course Mode</th>
            <th style="border: 1px solid black; font-weight: bold;">CGPA</th>
            <th style="border: 1px solid black; font-weight: bold;">Percentage</th>
            <th style="border: 1px solid black; font-weight: bold;">Year of Passing</th>
            <th style="border: 1px solid black; font-weight: bold;">Employer Name</th>
            <th style="border: 1px solid black; font-weight: bold;">Post Held</th>
            <th style="border: 1px solid black; font-weight: bold;">From Date</th>
            <th style="border: 1px solid black; font-weight: bold;">To Date</th>
            <th style="border: 1px solid black; font-weight: bold;">Award Name</th>
            <th style="border: 1px solid black; font-weight: bold;">Award Details</th>
            <th style="border: 1px solid black; font-weight: bold;">Exam Name</th>
            <th style="border: 1px solid black; font-weight: bold;">Agency Name</th>
            <th style="border: 1px solid black; font-weight: bold;">Appearing Year</th>
            <th style="border: 1px solid black; font-weight: bold;">Score</th>
            <th style="border: 1px solid black; font-weight: bold;">Training Name</th>
            <th style="border: 1px solid black; font-weight: bold;">Training Start Date</th>
            <th style="border: 1px solid black; font-weight: bold;">Training End Date</th>
            <th style="border: 1px solid black; font-weight: bold;">Conviction</th>
            <th style="border: 1px solid black; font-weight: bold;">Criminal Case</th>
            <th style="border: 1px solid black; font-weight: bold;">Financial Liability</th>
            <th style="border: 1px solid black; font-weight: bold;">Conflict of Interest</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            @php
                $hasData =
                    (($user->educational_details ?? null) != null &&
                        ($user->educational_details ?? null)->isNotEmpty()) ||
                    (($user->experience_details ?? null) != null &&
                        ($user->experience_details ?? null)->isNotEmpty()) ||
                    (($user->additional_details ?? null) != null &&
                        ($user->additional_details ?? null)->isNotEmpty()) ||
                    (($user->competitive_details ?? null) != null &&
                        ($user->competitive_details ?? null)->isNotEmpty()) ||
                    (($user->training_details ?? null) != null && ($user->training_details ?? null)->isNotEmpty()) ||
                    ($user->personal_details ?? null) != null; //check for null
            @endphp
            @if ($hasData)
                @php
                    $maxRows = max(
                        ($user->educational_details ?? null) != null
                            ? ($user->educational_details ?? null)->count()
                            : 0,
                        ($user->experience_details ?? null) != null ? ($user->experience_details ?? null)->count() : 0,
                        ($user->additional_details ?? null) != null ? ($user->additional_details ?? null)->count() : 0,
                        ($user->competitive_details ?? null) != null
                            ? ($user->competitive_details ?? null)->count()
                            : 0,
                        ($user->training_details ?? null) != null ? ($user->training_details ?? null)->count() : 0,
                        1,
                    );
                @endphp
                @for ($i = 0; $i < $maxRows; $i++)
                    <tr>
                        @if ($i === 0)
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->id }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->name }}
                            </td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->email }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->mobile }}
                            </td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->personal_details->father_husband_name ?? '' }}
                            </td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->personal_details->gender ?? '' }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">
                                {{ $user->date_of_birth }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->personal_details->pincode ?? '' }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">
                                {{ $user->personal_details->correspondence_address ?? '' }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->personal_details->permanent_address ?? '' }}
                            </td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->department->name ?? '' }}</td>
                            <td style="border: 1px solid black;" rowspan="{{ $maxRows }}">{{ $user->employeeType->name ?? '' }}</td>
                        @endif

                        {{-- Educational Details --}}

                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->qualification->qualification_name ?? '' }}</td>

                        @if (isset($user->educational_details[$i]))
                            @php
                                $college = optional($user->educational_details[$i]->board_university_college);
                                $collegeName = $college->name == 'Others' ? $college->other_board_university_collage : $college->name;

                                $course = optional($user->educational_details[$i]->course);
                                $courseName = $course->course_name == 'Others' ? $course->other_course : $course->course_name;
                            @endphp
                            <td style="border: 1px solid black;">{{ $courseName ?? '' }}</td>
                            <td style="border: 1px solid black;">{{ $collegeName ?? '' }}</td>
                        @else
                            <td style="border: 1px solid black;"></td>
                            <td style="border: 1px solid black;"></td>
                        @endif

                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->main_subject->main_subject ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->course_mode->course_mode ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->cgpa ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->percentage ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->educational_details[$i]->passing_year ?? '' }}</td>

                        {{-- Experience Details --}}

                        <td style="border: 1px solid black;">{{ $user->experience_details[$i]->employer_name ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->experience_details[$i]->post_held->post_held ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->experience_details[$i]->from_date ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->experience_details[$i]->to_date ?? '' }}</td>

                        {{-- Additional/Award Details --}}

                        <td style="border: 1px solid black;">{{ $user->additional_details[$i]->award_name ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->additional_details[$i]->award_details ?? '' }}</td>

                        {{-- Competitive Exam Details --}}

                        <td style="border: 1px solid black;">{{ $user->competitive_details[$i]->examDetails->exam_name ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->competitive_details[$i]->conductingAgency->agency_name ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->competitive_details[$i]->appearingYear->passing_year ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->competitive_details[$i]->score ?? '' }}</td>

                        {{-- Training Details --}}

                        <td style="border: 1px solid black;">{{ $user->training_details[$i]->name_of_training ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->training_details[$i]->training_start_date ?? '' }}</td>
                        <td style="border: 1px solid black;">{{ $user->training_details[$i]->training_end_date ?? '' }}</td>

                        {{-- Disclosure Questions --}}

                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->conviction) ? (($user->disclosure_questions->conviction == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->criminal_case) ? (($user->disclosure_questions->criminal_case == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->financial_liabilities) ? (($user->disclosure_questions->financial_liabilities == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->conflict_of_interest) ? (($user->disclosure_questions->conflict_of_interest == 1) ? 'Yes' : 'No') : "" }}</td>
                    </tr>
                @endfor
            @else
                <tr>
                    <td style="border: 1px solid black;">{{ $user->id }}</td>
                    <td style="border: 1px solid black;">{{ $user->name }}</td>
                    <td style="border: 1px solid black;">{{ $user->email }}</td>
                    <td style="border: 1px solid black;">{{ $user->mobile }}</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">{{ $user->date_of_birth }}</td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;">{{ $user->department->name ?? '' }}</td>
                    <td style="border: 1px solid black;">{{ $user->employeeType->name ?? '' }}</td>

                    {{-- Educational Details --}}

                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>

                    {{-- Experience Details --}}

                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>

                    {{-- Additional/Award Details --}}

                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>

                    {{-- Competitive Exam Details --}}

                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>

                    {{-- Training Details --}}

                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>
                    <td style="border: 1px solid black;"></td>

                    {{-- Disclosure Questions --}}

                    <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->conviction) ? (($user->disclosure_questions->conviction == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->criminal_case) ? (($user->disclosure_questions->criminal_case == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->financial_liabilities) ? (($user->disclosure_questions->financial_liabilities == 1) ? 'Yes' : 'No') : "" }}</td>
                        <td style="border: 1px solid black;">{{ isset($user->disclosure_questions->conflict_of_interest) ? (($user->disclosure_questions->conflict_of_interest == 1) ? 'Yes' : 'No') : "" }}</td>
                </tr>
            @endif
        @endforeach
    </tbody>
</table>
