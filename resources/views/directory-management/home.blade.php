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
                        <a href="#" class="">
                            <div class="inner_flex_card">
                                <p class="">Total Stakeholders</p>
                                <h5 class="">0</h5>
                            </div>
                            <div class="bg_elips_ic">
                                <img src="{{ url('public/images/arrow-right.svg') }}" alt="Total Stakeholders">
                            </div>
                        </a>
                    </div>
                </div>
                <div class="second_card_dash">
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{ url('public/images/company-vision.png')}}" alt="Internal Employee">
                            </div>
                            <div class="content_card_dash content_card_dash1">
                            <h5 class="">{{$internalCount}}</h5>
                            <p class="">Internal Employee</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_2">
                                <img src="{{ url('public/images/request-for-proposal.png')}}" alt="External Employee">
                            </div>
                            <div class="content_card_dash content_card_dash2">
                                <h5 class="">{{$externalCount}}</h5>
                                <p class="">External Employee</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="#">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{ url('public/images/shortlist.png')}}" alt="Contractors">
                            </div>
                            <div class="content_card_dash content_card_dash3">
                                <h5 class="">0</h5>
                                <p class="">Contractors</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="chart_grid_custom">
                <div class="bg_chart_card">
                    <div class="heading_chart_">
                        <h5 class="">State Wise External Employee</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                        </div>
                    <div class="chart-container" style="position: relative; width: 604px; height: 400px">
                        <canvas class="justify-self-center" id="stateWiseExternalEmployeeChart" width="400" height="400" style="display: block; box-sizing: border-box; height: 400px; width: 400px;"></canvas>
                    </div>
                </div>
                <div class="bg_chart_card">
                    <div class="heading_chart_">
                        <h5>State Wise Contractors</h5>
                        <div class="flex items-center gap-[12px]">
                            <div class="bg_elips_ic">
                                <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                    <div class="chart-container" style="position: relative; width: 604px; height: 400px">
                        <canvas class="justify-self-center" id="stateWiseContractorsChart" width="400" height="400" style="display: block; box-sizing: border-box; height: 400px; width: 400px;"></canvas>
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
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
      const ctx1 = document.getElementById("stateWiseExternalEmployeeChart");
      const ctx2 = document.getElementById("stateWiseContractorsChart");

      new Chart(ctx1, {
        type: "doughnut",
        data: {
          labels: [
            "Andaman & Nicobar",
            "Arunachal Pradesh",
            "Assam",
            "Delhi",
            "Himachal Pradesh",
            "Jammu & Kashmir",
            "Ladakh",
            "Manipur",
            "Meghalaya",
            "Mizoram",
            "Nagaland",
            "Sikkim",
            "Tripura",
            "Uttarakhand",
            "West Bengal",
          ],
          datasets: [
            {
              label: "BG Type",
              backgroundColor: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue",
                "Purple",
                "Pink",
                "Cyan",
                "Lime",
                "Teal",
                "Indigo",
                "Violet",
                "Gray",
                "Brown",
                "Black",
              ],
              data: [23, 19, 31, 72, 0, 2, 3, 23, 19, 31, 72, 2, 3, 23, 19],
              borderWidth: 1,
            },
          ],
        },
        options: {
          responsive: true,
          plugins: {
            legend: {
              display: true,
              // position: 'right'
            },
          },
        },
      });

      new Chart(ctx2, {
        type: "polarArea",
        data: {
          labels: [
            "Andaman & Nicobar",
            "Arunachal Pradesh",
            "Assam",
            "Delhi",
            "Himachal Pradesh",
            "Jammu & Kashmir",
            "Ladakh",
            "Manipur",
            "Meghalaya",
            "Mizoram",
            "Nagaland",
            "Sikkim",
            "Tripura",
            "Uttarakhand",
            "West Bengal",
          ],
          datasets: [
            {
              //   label: "Present",
              data: [23, 19, 31, 72, 0, 62, 38, 73, 19, 31, 72, 42, 53, 73, 69],
              backgroundColor: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue",
                "Purple",
                "Pink",
                "Cyan",
                "Lime",
                "Teal",
                "Indigo",
                "Violet",
                "Gray",
                "Brown",
                "Black",
              ],
              borderColor: [
                "Red",
                "Orange",
                "Yellow",
                "Green",
                "Blue",
                "Purple",
                "Pink",
                "Cyan",
                "Lime",
                "Teal",
                "Indigo",
                "Violet",
                "Gray",
                "Brown",
                "Black",
              ],
              borderWidth: 1,
              fill: true,
              tension: 0.4,
            },
          ],
        },
        options: {
          responsive: true,
          elements: {
            arc: {
              borderWidth: 0,
            },
          },
          plugins: {
            legend: {
              display: true,
              // position: 'right'
            },
          },
        },
      });
    </script>
@endpush