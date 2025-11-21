@extends('layouts.app')
@section('content')
    <div class="cutom_flex_p">
    @include('shared.header2')
    <div class="flex flex-col justify-between md:h-[100%]">
        <div class="bg_main_">
            <div class="container md:h-[100%]">
                <div class="banner_cust_m">
                    <div class="left_side">
                        <div class="banner_heading">
                            <p>NHIDCL's Recruitment Portal is a dedicated digital platform where applicants can apply for various career opportunities. It is designed to ensure a fair, transparent, and merit-based recruitment process that attracts the best talent to serve the public interest. </p>
                        </div>
                    </div>
                    <div class="right_form">                  
                        @yield('auth_content')
                    </div>
                </div>
            </div>
        </div>
        <footer class="bg-footer-color p-4">
            <div class="container">
                <p>@ {{ now()->year }} NHIDCL </p>
            </div>
        </footer>
    </div>
    </div>
@endsection