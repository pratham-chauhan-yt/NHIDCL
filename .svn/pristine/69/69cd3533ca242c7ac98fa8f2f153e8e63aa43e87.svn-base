@extends('layouts.dashboard')
@section('dashboard_content')
<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Dashboard</div>
        </div>
    </div>
    <div class="dashbord_main_content_rigt">
        <div class="one_cut">
            @if (auth()->user()->hasRole('Resource Pool User'))
                <div class="welcome-card">
                    <div class="welcome-icon">👋</div>
                    <div class="welcome-content">
                        <h1>Welcome to NHIDCL, {{ Auth::user()->name }}!</h1>
                        <h2>Application ID: {{ Auth::user()->id }}</h2>
                        <p>This dashboard is your personal hub — built to keep you informed, in control, and moving forward with confidence.</p>
                        <p>It's great to see you back. Everything is running smoothly, and your connection is secure. Let’s make progress together!</p>
                        <p><strong>Logged in IP Address:</strong> {{ Auth::user()->last_login_ip }}</p>
                    </div>
                </div>
                <div class="progress-wrapper">
                    <h2>Application Progress</h2>
                    <div class="progress-bar">
                        <div class="progress-fill" style="width: {{ $percentage }}%;">{{ round($percentage) }}% {{ $percentage == 100 ? 'Application completed and successfully submitted.' : 'Application submitted, pending completion of remaining sections.' }}</div>
                    </div>
                    <p class="progress-message">
                        @if($percentage == 100)
                            🎉 All sections completed. You’re good to go!
                        @else
                            {{ $completed }} of {{ $totalSections }} sections completed. Keep going!
                        @endif
                    </p>

                    <ul style="margin-top: 10px; padding-left: 20px; color: #cfd8e3;">
                        @foreach($sections as $section => $status)
                            <li>
                                {!! $status ? '✅' : '⬜' !!}
                                <a href="{{ route('candidate.applicantProfile') }}">
                                {{ ucwords(str_replace('_', ' ', str_replace('nhidcl_', '', str_replace('ref_', '', $section)))) }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            @else
            <div class="card_cust_parnet_dash">    
                <div class="first_card_dash">
                    <div class="bg_card_1">
                        <a href="#" class="">
                            <div class="inner_flex_card">
                                <div>
                                    <p class="">Reserved</p>
                                    <h5 class="">{{$ReservedUsers}}</h5>
                                </div>
                                <div class="bg_elips_ic">
                                    <img src="{{ asset('public/images/arrow-right.svg')}}" alt="">
                                </div>
                            </div>
                            <div class="inner_span_custom">
                                <span class="bg_span">+2.9%</span>
                                <span class="">The Last Month</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="second_card_dash">
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{asset('public/images/company-vision.png')}}" alt="">
                            </div>
                            <div class="content_card_dash content_card_dash1 ">
                                <h5 class="">{{$ShortlestedUser}}</h5>
                                <p class="">Shortlists</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{asset('public/images/shortlist.png')}}" alt="">
                            </div>
                            <div class="content_card_dash content_card_dash3 ">
                                <h5 class="">{{$selectedUser}}</h5>
                                <p class="">Selected</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_4">
                                <img src="{{asset('public/images/skills.png')}}" alt="">
                            </div>
                            <div class="content_card_dash content_card_dash4 ">
                                <h5 class="">{{$rejectedUser}}</h5>
                                <p class="">Rejected</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="chart_grid_custom">
                <div class="bg_chart_card ">
                    <div class="heading_chart_">
                        <h5 class="">Interview</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart_ w-50">
                        <canvas id="interviewChart" height="100" data-chart='@json($chartData)'></canvas>
                        <ul>
                            <li>Shortlist <b>{{ $chartData['Shortlisted'] ?? 0 }}</b></li>
                            <li>Selected <b>{{ $chartData['Selected'] ?? 0 }}</b></li>
                            <li>Rejected <b>{{ $chartData['Rejected'] ?? 0 }}</b></li>
                        </ul>
                    </div>
                </div>
                <div class="bg_chart_card ">
                    <div class="heading_chart_">
                        <h5>Hiring Status</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart_ chart_2_img">
                        <img src="{{asset('public/images/chart2.svg')}}" alt="chart" class="w-[100%]">
                    </div>
                </div>
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
@push('scripts')
<script src="{{asset('public/js/chart.js')}}"></script>
@endpush