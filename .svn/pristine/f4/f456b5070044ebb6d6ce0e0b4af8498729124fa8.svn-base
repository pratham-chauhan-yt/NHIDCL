@extends('layouts.dashboard')
@php
    use App\Models\{RefProjectType, RefProjectState};
@endphp


@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Project Lists</div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('ProjectList', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z">
                        </path>
                    </svg>
                    Projects List
                </button>
            </div>

            <div id="ProjectList" class="tabcontent" style="display: none;">

                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="project-table">
                        <thead class="">
                            <tr>
                                <th>S. No.</th>
                                <th>Ref.</th>
                                <th>Job No.</th>
                                <th>UPC No</th>
                                <th>Project Name</th>
                                <th>Project Type</th>
                                <th>Project State</th>
                                <th>Project Added Date</th>
                                <th>EMD</th>
                                <th>Performance Guarantee</th>
                                <th>Mobilisation</th>
                                <th>Retention Money</th>
                                <th>Others</th>
                                <th>Machinery Advance</th>
                                <th>APBG</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody class=""></tbody>
                    </table>
                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.project.js') }}"></script>
@endpush
