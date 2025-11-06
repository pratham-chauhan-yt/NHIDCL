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
                <div class="card_cust_parnet_dash">
                    <div class="first_card_dash">
                        <div class="bg_card_1">
                            <a href="#" class="">
                                <div class="inner_flex_card">
                                    <div>
                                        <p class="">Total Queries</p>
                                        <h5 class="">{{ $totalQueries }}</h5>
                                    </div>
                                    <div class="bg_elips_ic">
                                        <img src="../../assets/images/arrow-right.svg" alt="" />
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="second_card_dash">
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_1">
                                    <img src="{{ asset('public/images/company-vision.png') }}" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash1">
                                    <p class="">Pending</p>
                                    <h5 class="">{{ $pendingQueries }}</h5>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_2">
                                    <img src="{{ asset('public/images/request-for-proposal.png') }}" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash2">
                                    <p class="">Resolved</p>
                                    <h5 class="">{{ $resolvedQueries }}</h5>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table_over mt-6" style="background: #f5f5f5; border-radius: 10px; padding: 10px;">
                    <h4 class="">Query Type</h4>
                    <div class="chart-container" style="position: relative; height: 400px">
                        <canvas class="justify-self-center" id="myChart1" width="1600" height="800"
                            style="
                            display: block;
                            box-sizing: border-box;
                            height: 400px;
                            width: 800px;
                        "></canvas>
                    </div>
                </div>
            </div>
            <div class="second_cust">
                <div class="cust-box">
                    <div class="parrent_dahboard_ heading_chart_ chart_c inner_body_style mt-0">
                        <h5>Notifications</h5>
                        <div class="plain_dlfex">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Ankit
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Ketan
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Ankit
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Ravi
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Ankit
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">New Query Added</h4>
                            <p class="cust-schedule-type">Test Query</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-user"></i> Vikash
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx1 = document.getElementById("myChart1");
        new Chart(ctx1, {
            type: "bar",
            data: {
                labels: ["General Inquiry", "Technical Support", "Billing Issues"],
                datasets: [{
                        label: "Pending Queries",
                        data: [12, 15, 3],
                        backgroundColor: "Red",
                    },
                    {
                        label: "Resolved Queries",
                        data: [25, 12, 13],
                        backgroundColor: "Green",
                    },
                ],
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                    },
                },
                responsive: true,
                scales: {
                    x: {
                        stacked: true,
                    },
                    y: {
                        stacked: true,
                    },
                },
            },
        });
    </script>
@endpush
