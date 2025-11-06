@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">MD Task Dashboard</div>
            <div class="plain_dlfex bg_elips_ic">

            </div>
        </div>
    </div>
    <div class="dashbord_main_content_rigt">
        <div class="one_cut">
            <div class="card_cust_parnet_dash">
                <div class="first_card_dash">
                    <div class="bg_card_1">
                        <a href="#" class="">
                            <div class="inner_flex_card">
                                <div>
                                    <p class="">Total Task</p>
                                    <h5 class="">{{ $statusCounts['total'] }}</h5>
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
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{ asset('public/images/company-vision.png') }}" alt="Not Start Task">
                            </div>
                            <div class="content_card_dash content_card_dash1 ">
                                <h5 class="">{{ $statusCounts['pending'] }}</h5>
                                <p class="">Not Started</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_2">
                                <img src="{{ asset('public/images/request-for-proposal.png') }}" alt="In Progress Task">
                            </div>
                            <div class="content_card_dash content_card_dash2 ">
                                <h5 class="">{{ $statusCounts['in_progress'] }}</h5>
                                <p class="">In Progress</p>
                                </p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{ asset('public/images/shortlist.png') }}" alt="Complete Task">
                            </div>
                            <div class="content_card_dash content_card_dash3 ">
                                <h5 class="">{{ $statusCounts['completed'] }}</h5>
                                <p class="">Completed</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="chart_grid_custom">
                <div class="bg_chart_card">
                    <div class="heading_chart_">
                        <h5 class="">Total task</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; width: 604px; height: 258px">
                        <canvas class="justify-self-center" id="myChart1" data-completed="{{ $statusCounts['completed'] }}"
                            data-in-progress="{{ $statusCounts['in_progress'] }}"
                            data-pending="{{ $statusCounts['pending'] }}"></canvas>
                    </div>
                </div>
                <div class="bg_chart_card">
                    <div class="heading_chart_">
                        <h5>Priority wise task</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; width: 604px; height: 258px">
                        <canvas class="justify-self-center" id="myChart2"
                            data-priority-labels='@json($statusCounts['priority']->pluck('priority_name'))'
                            data-completed='@json($statusCounts['priority']->pluck('completed'))' data-in-progress='@json($statusCounts['priority']->pluck('in_progress'))'
                            data-pending='@json($statusCounts['priority']->pluck('pending'))'>
                        </canvas>
                    </div>
                </div>
            </div>

            <!-- <div class="table_over">
                        <h4>Department wise task</h4>
                        <div class="chart-container" style="position: relative; height: 400px">
                            <canvas class="justify-self-center" id="myChart3"></canvas>
                        </div>
                    </div> -->
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
@endsection
@push('scripts')
    <script src="{{ asset('public/js/chart.js') }}"></script>
    <script src="{{ asset('public/js/md-task.js') }}"></script>
@endpush
