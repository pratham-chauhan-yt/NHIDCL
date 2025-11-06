@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Accept or Refer Back BG</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">

            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen" data-tab="accept_or_refer_back_bg">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Accept or Refer Back BG
                </button>

            <button class="tablink" onclick="openPage('Home', this, '#373737')" data-tab="renew">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    Renew
                </button>
            </div>

            <div id="Home" class="tabcontent">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="accept-table">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>BG Id</th>
                                <th>Ref. No</th>
                                <th>SAP ID</th>
                                <th>Guarantee Type</th>
                                <th>State</th>
                                <th>BG No</th>
                                <th>No. of Renew</th>
                                <th>Expiry Date</th>
                                <th>Track Status</th>
                                <th>Track Claim Lodge</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div>
        </div>





    </div>
@endsection
@push('style_start')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('/public/validation/bgms.finance.js') }}"></script>

    {{-- <script src="{{ asset('/public/tilwind.js') }}"></script> --}}
@endpush
