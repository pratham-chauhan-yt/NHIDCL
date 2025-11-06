@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('User Management - Dashboard') }}</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="dashbord_main_content_rigt">
                <div class="one_cut">
                    <div class="card_cust_parnet_dash">
                        <div class="second_card_dash">
                            <div class="hover-effect-dash coman_bg_card_dash">
                                <a href="#">
                                    <div class="inner_bg_images_cust card_dash_1">
                                        <img src="{{ asset('public/images/company-vision.png') }}" alt="total-emp">
                                    </div>
                                    <div class="content_card_dash content_card_dash1 ">
                                        <h5 class="">{{ $totalUser }}</h5>
                                        <p class="">Total User</p>
                                    </div>
                                </a>
                            </div>
                            <div class="hover-effect-dash coman_bg_card_dash">
                                <a href="#">
                                    <div class="inner_bg_images_cust card_dash_2">
                                        <img src="{{ asset('public/images/company-vision.png') }}" alt="">
                                    </div>
                                    <div class="content_card_dash content_card_dash2 ">
                                        <h5 class="">{{ $nhidclUser }}</h5>
                                        <p class="">NHIDCL User</p>
                                    </div>
                                </a>
                            </div>
                            <div class="hover-effect-dash coman_bg_card_dash">
                                <a href="#">
                                    <div class="inner_bg_images_cust card_dash_3">
                                        <img src="{{ asset('public/images/company-vision.png') }}" alt="">
                                    </div>
                                    <div class="content_card_dash content_card_dash3 ">
                                        <h5 class="">{{ $otherUser }}</h5>
                                        <p class="">Other User</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="inner_page_dash__" id="usersContainer" data-route-url="{{ route('user-config.view') }}">
                <div class="inner_page_dash__ mt-[20px]">
                    <div class="table_over">
                        <h4 class="text-[24px] py-[10px] font-semibold">List of users</h4>
                        <table id="usersTable_data" class="data_bg_table cust_table__ table_sparated table-auto text-wrap cell-border">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile No</th>
                                    <th>Department</th>
                                    <th>Roles</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>

                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection