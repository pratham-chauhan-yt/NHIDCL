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
            @if (auth()->user()->hasRole('Recruitment User'))
            <div class="welcome-card">
                <div class="welcome-icon">👋</div>
                <div class="welcome-content">
                    <h1>Welcome to NHIDCL, {{ Auth::user()->name }}!</h1>
                    <p>This dashboard is your personal hub — built to keep you informed, in control, and moving forward with confidence.</p>
                    <p>It's great to see you back. Everything is running smoothly, and your connection is secure. Let’s make progress together!</p>
                    <p><strong>Logged in IP Address:</strong> {{ Auth::user()->last_login_ip }}</p>
                </div>
            </div>
            @else
            <div class="card_cust_parnet_dash">
                <div class="first_card_dash">
                    <div class="bg_card_1">
                        <a href="javascript:void(0);">
                            <div class="inner_flex_card">
                                <div>
                                    <p>Total Number of Advertisements</p>
                                    <h5>{{$counts['total']}}</h5>
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
                            <div class="inner_bg_images_cust card_dash_5">
                                <img src="{{ url('public/images/handshake.png')}}" alt="Answer Para Query">
                            </div>
                            <div class="content_card_dash content_card_dash5 ">
                                <h5>{{$counts['active'] ?? 0}}</h5>
                                <p>Total Number of Active Advertisements</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_6">
                                <img src="{{ url('public/images/recruitment.png')}}" alt="Dropped Para Query">
                            </div>
                            <div class="content_card_dash content_card_dash6 ">
                                <h5 class="">{{$counts['closed'] ?? 0}}</h5>
                                <p class="">Total Number of Closed Advertisements</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_4">
                                <img src="{{ url('public/images/skills.png')}}" alt="Pending Para Query">
                            </div>
                            <div class="content_card_dash content_card_dash4 ">
                                <h5>{{$post}}</h5>
                                <p>Total Number of Posts</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_3">
                                <img src="{{ url('public/images/shortlist.png')}}" alt="Dropped Query">
                            </div>
                            <div class="content_card_dash content_card_dash3 ">
                                <h5>{{count($users)}}</h5>
                                <p>Total Number of Registrations</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_1">
                                <img src="{{ url('public/images/company-vision.png')}}" alt="Pending Query">
                            </div>
                            <div class="content_card_dash content_card_dash1 ">
                                <h5>{{count($application)}}</h5>
                                <p>Total Number of Post Applications</p>
                            </div>
                        </a>
                    </div>
                    
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="javascript:void(0);">
                            <div class="inner_bg_images_cust card_dash_2">
                                <img src="{{ url('public/images/request-for-proposal.png')}}" alt="Total Para Query">
                            </div>
                            <div class="content_card_dash content_card_dash2 ">
                                <h5>{{$incompleteCount}}</h5>
                                <p>InProgress Profiles</p>
                            </div>
                        </a>
                    </div>
                    <div class="hover-effect-dash coman_bg_card_dash">
                        <a href="{{route('recruitment-portal.application.activity.data')}}">
                            <div class="inner_bg_images_cust card_dash_5">
                                <img src="{{ url('public/images/handshake.png')}}" alt="Answer Para Query">
                            </div>
                            <div class="content_card_dash content_card_dash5 ">
                                <h5>{{$appcounts ?? 0}}</h5>
                                <p>Total Number of Edits Allowed</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="chart_grid_custom">
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="space-y-4 mb-6 inpus_cust_cs">
                            <div class="ruby gap-[10px]">
                                <x-filter-input label="Advertisement ID" name="advertisementId" type="select" class="advertisement_filter js-single" required="required">
                                    <option value="">--- Select Advertisement ID ---</option>
                                    @foreach ($listOfAdvertisement as $dataOfAdvertisement)
                                        <option value="{{ $dataOfAdvertisement->id }}">
                                            {{ $loop->iteration }} - {{ $dataOfAdvertisement->advertisement_title }}
                                        </option>
                                    @endforeach
                                </x-filter-input>
                            </div>
                        </div>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated" id="applicantDataTable">
                                <thead class=" ">
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Post Name</th>
                                        <th>Mode Of Recruitment</th>
                                        <th>Total Vacancy</th>
                                        <th>Last Date Time</th>
                                        <th>Total Application</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th colspan="7">No records found here</th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        @if (auth()->user()->hasRole('Recruitment User'))
        @else
        <div class="second_cust bg_chart_card">
            <div class="heading_chart_">
                <h5>Gender / Category Distribution</h5>
                <div class="flex items-center gap-[12px]">
                    <div class="bg_elips_ic">
                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
            <div class="chart_ chart_2_img">
                <canvas id="distributionChart" width="300" height="300"></canvas>
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
@push('scripts')
<script src="{{asset('public/js/chart.js')}}"></script>
<script>
    window.distributionData = @json($distribution);
</script>
@endpush