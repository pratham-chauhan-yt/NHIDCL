@extends('layouts.dashboard')
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Dashboard</div>
                <div class="plain_dlfex bg_elips_ic">
                    <select name="Date" id="date">
                        <option value="Today">19-12-2024</option>
                    </select>
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
                                        <p class="">Total Para Assigned</p>
                                        <h5 class="">1800</h5>
                                    </div>
                                    <div class="bg_elips_ic">
                                        <img src="../../assets/images/arrow-right.svg" alt="" />
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
                                    <img src="../../assets/images/company-vision.png" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash1">
                                    <h5 class="">205</h5>
                                    <p class="">Answered/Replied</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_2">
                                    <img src="../../assets/images/request-for-proposal.png" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash2">
                                    <h5 class="">300</h5>
                                    <p class="">Pending Query</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_3">
                                    <img src="../../assets/images/shortlist.png" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash3">
                                    <h5 class="">1200</h5>
                                    <p class="">Dropped</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_4">
                                    <img src="../../assets/images/skills.png" alt="" />
                                </div>
                                <div class="content_card_dash content_card_dash4">
                                    <h5 class="">12</h5>
                                    <p class="">Refer Back</p>
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
                            <img src="../../assets/images/chart1.svg" alt="chart" />
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
                            <img src="../../assets/images/chart2.svg" alt="chart" class="w-[100%]" />
                        </div>
                    </div>
                </div>

                <div class="table_over">
                    <h4>Tiles for Audit Para</h4>
                    <table class="cust_table__ table_sparated">
                        <thead class="">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Para</th>
                                <th scope="col">Letter No.</th>
                                <th scope="col">Letter Date</th>
                                <th scope="col">Location</th>
                                <th scope="col">Status</th>
                                <th scope="col">View</th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="">
                                <td>1</td>
                                <td>
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </td>
                                <td>NHIDCL/FIN/2024/5</td>
                                <td>05-12-2024</td>
                                <td>Delhi</td>
                                <td>
                                    <span class="interview">Pending</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td>2</td>
                                <td>
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </td>
                                <td>NHIDCL/FIN/2020/5</td>
                                <td>05-12-2020</td>
                                <td>Delhi</td>
                                <td>
                                    <span class="interview">Pending</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td>3</td>
                                <td>
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </td>
                                <td>NHIDCL/FIN/2014/5</td>
                                <td>05-12-2014</td>
                                <td>Delhi</td>
                                <td>
                                    <span class="rejected">Refer Back</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td>4</td>
                                <td>
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </td>
                                <td>NHIDCL/FIN/2017/5</td>
                                <td>05-12-2017</td>
                                <td>Delhi</td>
                                <td>
                                    <span class="selected">Dropped</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class="hover:bg-gray-200">
                                <td>5</td>
                                <td>
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </td>
                                <td>NHIDCL/FIN/2021/5</td>
                                <td>05-12-2021</td>
                                <td>Delhi</td>
                                <td>
                                    <span class="selected">Dropped</span>
                                </td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="pagination_cust">
                    <span>01 to 10 of 50 Items</span>
                    <nav aria-label="Page navigation example">
                        <ul class="cust-pagination">
                            <li>
                                <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-left"
                                        aria-hidden="true"></i></a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">1</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">2</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link">3</a>
                            </li>
                            <li>
                                <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-right"
                                        aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="second_cust">
                <div class="cust-box">
                    <div class="parrent_dahboard_ heading_chart_ chart_c inner_body_style mt-0">
                        <h5>Notification</h5>
                        <div class="plain_dlfex">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Assigned</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Test Audit Para</h4>
                            <p class="cust-schedule-type">Pending</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> Pending from 12 days
                                </span>
                            </div>
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
