@extends('layouts.dashboard')
@section('title', 'Trainer Dashboard')
@section('dashboard_content')
<section class=" home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Trainer Dashboard</div>
        </div>
    </div>
    <div class="dashbord_main_content_rigt">
        <div class="one_cut">
            <div class="card_cust_parnet_dash">
                <div class="first_card_dash">
                    <div class="bg_card_1">
                        <a href="javascript:void(0);">
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
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_2">
                                <img src="{{ asset('public/images/request-for-proposal.png') }}" alt="In Progress Task">
                            </div>
                            <div class="content_card_dash content_card_dash2 ">
                                <h5>{{ $pendingRequests ?? 0 }}</h5>
                                <p>Pending Requests</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{ asset('public/images/company-vision.png') }}" alt="Not Start Task">
                            </div>
                            <div class="content_card_dash content_card_dash1 ">
                                <h5>{{ $pendingBudgets ?? 0 }}</h5>
                                <p>Pending Budgets</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{ asset('public/images/shortlist.png') }}" alt="Complete Task">
                            </div>
                            <div class="content_card_dash content_card_dash3 ">
                                <h5>{{ $totalTrainers ?? 0 }}</h5>
                                <p>Total Trainers</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            @if(isset($recentRequests) && sizeof($recentRequests)>0)
            <div class="card mt-4 p-3 shadow-sm">
                <h5>Training Requests</h5>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Created At</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($recentRequests as $session)
                        <tr>
                            <td>{{ $session->training_topic }}</td>
                            <td>{{ $session?->user?->name ?? 'N/A' }}</td>
                            <td>{{ ucwords($session?->status?->type ?? 'pending') }}</td>
                            <td>{{ \Carbon\Carbon::parse($session->created_at)->format('d M Y h:i:s') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4">No pending training request found.</td></tr>
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
