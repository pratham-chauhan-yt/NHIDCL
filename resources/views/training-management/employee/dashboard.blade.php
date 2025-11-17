@extends('layouts.dashboard')
@section('title', 'Employee Dashboard')
@section('dashboard_content')
<section class=" home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Employee Dashboard</div>
        </div>
    </div>
    <div class="dashbord_main_content_rigt">
        <div class="one_cut">
            <div class="card_cust_parnet_dash">
                <div class="first_card_dash">
                    <div class="bg_card_1">
                        <a href="{{ route('training.employee.sessions')}}">
                            <div class="inner_flex_card">
                                <div>
                                    <p>Total Training Sessions</p>
                                    <h5>{{ $sessionsCount ?? 0 }}</h5>
                                </div>
                                <div class="bg_elips_ic">
                                    <img src="{{ asset('public/images/arrow-right.svg') }}" alt="Total Task">
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="second_card_dash">
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="{{ route('training.employee.enrolled')}}">
                            <div class="inner_bg_images_cust card_dash_2">
                                <img src="{{ asset('public/images/request-for-proposal.png') }}" alt="In Progress Task">
                            </div>
                            <div class="content_card_dash content_card_dash2 ">
                                <h5>{{ $enrolledCount  ?? 0 }}</h5>
                                <p>Enrolled Trainings</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="{{ route('training.employee.sessions')}}">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{ asset('public/images/company-vision.png') }}" alt="Not Start Task">
                            </div>
                            <div class="content_card_dash content_card_dash1 ">
                                <h5>{{ $completedCount ?? 0 }}</h5>
                                <p>Completed Trainings</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="{{ route('training.index')}}">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{ asset('public/images/shortlist.png') }}" alt="Complete Task">
                            </div>
                            <div class="content_card_dash content_card_dash3 ">
                                <h5>{{ $requestCount ?? 0 }}</h5>
                                <p>Trainings Request</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @if(isset($ongoingSessions) && sizeof($ongoingSessions)>0)
            <div class="card mt-4 p-3 shadow-sm">
                <h5>Ongoing Trainings</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Trainer</th>
                            <th>Start Date</th>
                            <th>Duration</th>
                            <th>Type</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($ongoingSessions as $session)
                        <tr>
                            <td>{{ $session->name }}</td>
                            <td>{{ $session?->trainer?->user?->name ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->date)->format('d M Y') }}</td>
                            <th>{{ ucwords($session->duration) }}</th>
                            <th>{{ ucwords($session->type) }}</th>
                            <td>{{ ucfirst($session?->status?->type ?? 'enrolled') }}</td>
                        </tr>
                        @empty
                        <tr><td colspan="5">No ongoing trainings.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @endif
        </div>
        <div class="second_cust">
            <div class="cust-box">
                <div class="parrent_dahboard_ heading_chart_ chart_c inner_body_style mt-0">
                    <h5>Upcoming Schedule</h5>
                    <div class="plain_dlfex">
                        <div class="bg_elips_ic">
                            <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
                <div class="cust-content">
                    <div class="cust-schedule-item">
                        <p class="cust-schedule-type">No Upcoming Schedule</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
