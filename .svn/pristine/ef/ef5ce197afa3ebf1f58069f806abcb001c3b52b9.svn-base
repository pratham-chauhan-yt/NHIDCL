@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View User Details</div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">

                <button class="tablink" onclick="openPage('application', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                    </svg>
                    Profile Details
                </button>
            </div>

            <div id="application" class="tabcontent">
                <h4 class="applicat_cust-title">User Information</h4>
                <div class="applicat_cust-container">
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">ID</div>
                        <div class="applicat_cust-value">{{$users->id ?? '0'}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Name</div>
                        <div class="applicat_cust-value">{{$users->name ?? ''}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Email</div>
                        <div class="applicat_cust-value">{{$users->email ?? ''}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Mobile Number</div>
                        <div class="applicat_cust-value">{{$users->mobile ?? ''}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date of Birth</div>
                        <div class="applicat_cust-value">{{ $users->date_of_birth ? \Carbon\Carbon::parse($users->date_of_birth)->format('d-m-Y') : '' }}</div>
                    </div>
                    @if(!empty($users?->designation))
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Designation</div>
                        <div class="applicat_cust-value">{{$users?->designation?->name ?? ''}}</div>
                    </div>
                    @endif
                    @if(!empty($users?->department))
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Department</div>
                        <div class="applicat_cust-value">{{$users?->department?->name ?? ''}}</div>
                    </div>
                    @endif
                    @if(!empty($users?->date_of_joining))
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Date Of Joining</div>
                        <div class="applicat_cust-value">{{ $users->date_of_joining ? \Carbon\Carbon::parse($users->date_of_joining)->format('d-m-Y') : '' }}</div>
                    </div>
                    @endif
                    @if(!empty($users?->address))
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Address</div>
                        <div class="applicat_cust-value">{{$users->address ?? ''}}</div>
                    </div>
                    @endif
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Login Ip Address</div>
                        <div class="applicat_cust-value">{{$users->last_login_ip ?? ''}}</div>
                    </div>
                    <div class="applicat_cust-row">
                        <div class="applicat_cust-label">Last Login Time</div>
                        <div class="applicat_cust-value">{{ $users->last_login_at ? \Carbon\Carbon::parse($users->last_login_at)->format('d-m-Y') : '' }}</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection