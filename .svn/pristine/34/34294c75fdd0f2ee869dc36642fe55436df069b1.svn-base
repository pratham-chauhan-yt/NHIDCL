@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Dashboard</div>
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
                                    <p>My Attendance</p>
                                    <h5>25</h5>
                                </div>
                                <div class="bg_elips_ic">
                                    <img src="{{ url('public/images/arrow-right.svg') }}" alt="My Attendance">
                                </div>
                            </div>
                            <div class="inner_span_custom">
                                <span class="bg_span">+2.9%</span>
                                <span>The Last Month</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="second_card_dash">
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_1">
                            <img src="{{ url('public/images/company-vision.png')}}" alt="OOO Request">
                        </div>
                        <div class="content_card_dash content_card_dash1">
                            <h5>1</h5>
                            <p>Pending OOO Request</p>
                        </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_2">
                            <img src="{{ url('public/images/shortlist.png')}}" alt="OOO Attendance">
                        </div>
                        <div class="content_card_dash content_card_dash2">
                            <h5>5</h5>
                            <p>Approved OOO Attendance</p>
                        </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_3">
                            <img src="{{ url('public/images/skills.png')}}" alt="Approved Leave">
                        </div>
                        <div class="content_card_dash content_card_dash3">
                            <h5>2</h5>
                            <p>Approved Leave</p>
                        </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_4">
                            <img src="{{ url('public/images/request-for-proposal.png')}}" alt="Total Grievances">
                        </div>
                        <div class="content_card_dash content_card_dash4">
                            <h5>{{ $total }}</h5>
                            <p>Total Grievances Registered</p>
                        </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_5">
                            <img src="{{ url('public/images/skills.png')}}" alt="Pending Grievances">
                        </div>
                        <div class="content_card_dash content_card_dash5">
                            <h5>{{ $pending }}</h5>
                            <p>Total Pending Grievances</p>
                        </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                        <div class="inner_bg_images_cust card_dash_6">
                            <img src="{{ url('public/images/skills.png')}}" alt="Closed Grievances">
                        </div>
                        <div class="content_card_dash content_card_dash6">
                            <h5>{{ $closed }}</h5>
                            <p>Total Closed Grievances</p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>

        <div class="chart_grid_custom">
            <div class="bg_chart_card">
            <div class="heading_chart_">
                <h5 class="">Today's attendance of your team</h5>
                <div class="flex items-center gap-[12px]">
                <div class="bg_elips_ic">
                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                </div>
                </div>
            </div>
            <div class="chart-container" style="position: relative; width: 604px; height: 258px">
                <canvas class="justify-self-center" id="myChart1" width="258" height="258" style="display: block; box-sizing: border-box; height: 258px; width: 258px;"></canvas>
            </div>
            </div>
            <div class="bg_chart_card">
            <div class="heading_chart_">
                <h5>Monthly attendance of your team</h5>
                <div class="flex items-center gap-[12px]">
                <div class="bg_elips_ic">
                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                </div>
                </div>
            </div>
            <div class="chart-container" style="position: relative; width: 604px; height: 258px">
                <canvas class="justify-self-center" id="myChart2" width="516" height="258" style="display: block; box-sizing: border-box; height: 258px; width: 516px;"></canvas>
            </div>
            </div>
        </div>
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
                        <h4 class="cust-schedule-title">No Upcoming Schedule</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection