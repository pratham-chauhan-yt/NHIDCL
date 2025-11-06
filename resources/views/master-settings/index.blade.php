@extends('layouts.dashboard')

@section('dashboard_content')

<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Master Settings') }}</div>

        </div>
    </div>

    <div class="inner_page_dash__">

        @php
        $items = [
            'Country' => route('master-settings.countries.index'),
            'State' => route('master-settings.states.index'),
            "Caste Category" => route('master-settings.caste.index'),
            'Department' => route('master-settings.departments.index'),
            'Designation' => route('master-settings.designation.index'),
            'Office Type' => route('master-settings.office-type.index'),
            'Employee Type' => route('master-settings.employee-type.index'),
            'Conducting Agency' => route('master-settings.conducting-agency.index'),
            'Board/University/College' => route('master-settings.board-university-college.index'),
            'Course' => route('master-settings.course.index'),
            'Discipline' => route('master-settings.discipline.index'),
            "Competitive Exam" => route('master-settings.competitive-exam.index'),
            "Audit Type" => route('master-settings.audit-type.index'),
            "Audit Level" => route('master-settings.audit-level.index'),
            "Audit Query Type" => route('master-settings.audit-query-type.index'),
            "Qms Query Type" => route('master-settings.qms-query-type.index'),
            "Area Experties" => route('master-settings.area-experties.index'),
            "Buckets" => route('master-settings.bucket.index'),
            "Domain" => route('master-settings.domain.index'),
            "Engagement" => route('master-settings.engagement.index'),
            "Expert Professional" => route('master-settings.expert-professional.index'),
            "Gate Decipline" => route('master-settings.gate-descipline.index'),
            "Guarantee Type" => route('master-settings.guarantee-type.index'),
            "Interview status" => route('master-settings.interview-status.index'),
            "Job Type" => route('master-settings.job-type.index'),
            "Main Subject" => route('master-settings.main-subject.index'),
            "Post Held" => route('master-settings.post-held.index'),
            "DMS Type" => route('master-settings.dms-type.index'),
            "DMS Type of Document" => route('master-settings.dms-type-of-document.index'),
            //'Examination' => '#',
            //'Working Basic' => '#',
            //'Post Graduation' => '#',
            //'Nature of Employment' => '#',
            //'Graduation or Diploma' => '#',
            //'Parent Department Category' => '#',
            //'Nature of Employment in NHIDCL' => '#',
            //'Pay Scale (CDA, IDA or Other DA Pattern)' => '#',
        ];
    @endphp

        <div class="cust_card_design_iiner">
            <div class="one_cut">
                <div class="card_cust_parnet_dash">
                    <div class="second_card_dash">
                        @foreach ($items as $item => $route)
                        <div class="coman_bg_card_dash hover-effect-dash hover-effect-dash_style">
                            <a href="{{ $route }}">
                                <div class="content_card_dash content_card_dash1">
                                    <p class="">{{ $item }}</p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
