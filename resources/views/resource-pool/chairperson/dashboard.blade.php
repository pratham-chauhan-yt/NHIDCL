@extends('layouts.dashboard')

@section('dashboard_content')
    <section class="home-section ">
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
                                        <p class="">Advertisement</p>
                                        <h5 class="">201</h5>
                                    </div>
                                    <div class="bg_elips_ic">
                                        <img src="../../assets/images/arrow-right.svg" alt="">
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
                                    <img src="../../assets/images/company-vision.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash1 ">
                                    <h5 class="">12,500</h5>
                                    <p class="">Resource Profiles</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_2">
                                    <img src="../../assets/images/request-for-proposal.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash2 ">
                                    <h5 class="">30</h5>
                                    <p class="">Resource Requestions
                                    </p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_3">
                                    <img src="../../assets/images/shortlist.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash3 ">
                                    <h5 class="">18</h5>
                                    <p class="">Shortlist</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_4">
                                    <img src="../../assets/images/skills.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash4 ">
                                    <h5 class="">35</h5>
                                    <p class="">Assessments</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_5">
                                    <img src="../../assets/images/handshake.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash5 ">
                                    <h5 class="">84</h5>
                                    <p class="">Resource Engaged</p>
                                </div>
                            </a>
                        </div>
                        <div class="hover-effect-dash coman_bg_card_dash">
                            <a href="#">
                                <div class="inner_bg_images_cust card_dash_6">
                                    <img src="../../assets/images/recruitment.png" alt="">
                                </div>
                                <div class="content_card_dash content_card_dash6 ">
                                    <h5 class="">99</h5>
                                    <p class="">Resource Reserved</p>
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
                        <div class="chart_">
                            <img src="../../assets/images/chart1.svg" alt="chart">
                            <ul>
                                <li>Shortlisted</li>
                                <li>In Progress</li>
                                <li>Rejected</li>
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
                            <img src="../../assets/images/chart2.svg" alt="chart" class="w-[100%]">
                        </div>
                    </div>
                </div>

                <div class="table_over">
                    <h4>Candidate Details</h4>
                    <table class="cust_table__ table_sparated">
                        <thead class="">
                            <tr>
                                <th scope="col">
                                    Name
                                </th>
                                <th scope="col">
                                    Department
                                </th>
                                <th scope="col">
                                    Qualification
                                </th>
                                <th scope="col">
                                    Assessment Status
                                </th>
                                <th scope="col">
                                    View
                                </th>
                            </tr>
                        </thead>
                        <tbody class="">
                            <tr class="">
                                <td>
                                    Ayush Tyagi
                                </td>
                                <td>
                                    Designs
                                </td>
                                <td>
                                    Graduated
                                </td>
                                <td>
                                    <span class="interview">Interviewed</span>
                                </td>
                                <td>
                                    <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class=" hover:bg-gray-200">
                                <td>
                                    Ayush Tyagi
                                </td>
                                <td>
                                    Designs
                                </td>
                                <td>
                                    Graduated
                                </td>
                                <td>
                                    <span class="rejected">Rejected</span>
                                </td>
                                <td>
                                    <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class=" hover:bg-gray-200">
                                <td>
                                    Ayush Tyagi
                                </td>
                                <td>
                                    Designs
                                </td>
                                <td>
                                    Graduated
                                </td>
                                <td>
                                    <span class="interview">Reviewing</span>
                                </td>
                                <td>
                                    <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class=" hover:bg-gray-200">
                                <td>
                                    Ayush Tyagi
                                </td>
                                <td>
                                    Designs
                                </td>
                                <td>
                                    Graduated
                                </td>
                                <td>
                                    <span class="selected">Selected</span>
                                </td>
                                <td>
                                    <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i></a>
                                </td>
                            </tr>
                            <tr class=" hover:bg-gray-200">
                                <td>
                                    Ayush Tyagi
                                </td>
                                <td>
                                    Designs
                                </td>
                                <td>
                                    Graduated
                                </td>
                                <td>
                                    <span class="selected">Selected</span>
                                </td>
                                <td>
                                    <a href="#"> <i class="fa fa-eye" aria-hidden="true"></i></a>
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
                        <h5>Upcoming Schedule</h5>
                        <div class="plain_dlfex">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="cust-content">
                        <div class="cust-schedule-item">
                            <h4 class="cust-schedule-title">Senior Product Designer</h4>
                            <p class="cust-schedule-type">Interview</p>
                            <div class="cust-schedule-details">
                                <span class="cust-schedule-date">
                                    <i class="fa-solid fa-calendar-days"></i> 19/12/2024
                                </span>
                                <span class="cust-schedule-time">
                                    <i class="fa-regular fa-clock"></i> 19/12/2024
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
