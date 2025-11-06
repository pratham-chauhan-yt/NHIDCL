@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
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
                                        <p>Total Audit Query</p>
                                        <h5>4201</h5>
                                    </div>
                                    <div class="bg_elips_ic">
                                        <img src="{{ url('public/images/arrow-right.svg')}}" alt="Audit Query">
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
                                    <img src="{{ url('public/images/company-vision.png')}}" alt="Pending Query">
                                </div>
                                <div class="content_card_dash content_card_dash1 ">
                                    <h5>2,500</h5>
                                    <p>Pending</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="javascript:void(0);">
                                <div class="inner_bg_images_cust card_dash_3">
                                    <img src="{{ url('public/images/shortlist.png')}}" alt="Dropped Query">
                                </div>
                                <div class="content_card_dash content_card_dash3 ">
                                    <h5>188</h5>
                                    <p>Dropped</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="javascript:void(0);">
                                <div class="inner_bg_images_cust card_dash_2">
                                    <img src="{{ url('public/images/request-for-proposal.png')}}" alt="Total Para Query">
                                </div>
                                <div class="content_card_dash content_card_dash2 ">
                                    <h5>12408</h5>
                                    <p>Total Para</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="javascript:void(0);">
                                <div class="inner_bg_images_cust card_dash_4">
                                    <img src="{{ url('public/images/skills.png')}}" alt="Pending Para Query">
                                </div>
                                <div class="content_card_dash content_card_dash4 ">
                                    <h5>3548</h5>
                                    <p>Pending Para</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="javascript:void(0);">
                                <div class="inner_bg_images_cust card_dash_5">
                                    <img src="{{ url('public/images/handshake.png')}}" alt="Answer Para Query">
                                </div>
                                <div class="content_card_dash content_card_dash5 ">
                                    <h5>5463</h5>
                                    <p>Answered Para</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="javascript:void(0);">
                                <div class="inner_bg_images_cust card_dash_6">
                                    <img src="{{ url('public/images/recruitment.png')}}" alt="Dropped Para Query">
                                </div>
                                <div class="content_card_dash content_card_dash6 ">
                                    <h5 class="">4567</h5>
                                    <p class="">Dropped Para</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="chart_grid_custom">
                    <div class="bg_chart_card">
                        <div class="heading_chart_">
                            <h5 class="">Audit Para</h5>
                            <div class="flex items-center gap-[12px]">
                                <div class="bg_elips_ic">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="chart_">
                            <img src="{{ url('public/images/chart1.svg')}}" alt="chart" />
                            <ul>
                                <li>Dropped</li>
                                <li>Pending</li>
                                <li>Rejected</li>
                            </ul>
                        </div>
                    </div>
                    <div class="bg_chart_card">
                        <div class="heading_chart_">
                            <h5>Para Status</h5>
                            <div class="flex items-center gap-[12px]">
                                <div class="bg_elips_ic">
                                    <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="chart_ chart_2_img">
                            <img src="{{ url('public/images/chart2.svg')}}" alt="chart" class="w-[100%]" />
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
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/chart.js') }}"></script>
@endpush
