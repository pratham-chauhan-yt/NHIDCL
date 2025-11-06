@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Recruitment Notices</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="candidat_cust-container-2cols">
                    @foreach ($record as $recordshow)
                        <div class="candidat_cust-item">
                            <div class="candidat_cust-header">
                                <div class="candidat_cust-logo">
                                    <img src="{{ asset('public/images/logo.png') }}" alt="NHIDCL Logo">
                                </div>
                                <span class="candidat_cust-time">{{ $recordshow->created_at->diffForHumans() }}</span>
                            </div>
                            <h4 class="candidat_cust-title">{{ $recordshow->advertisement_title }}</h4>
                            <div class="candidat_cust-dates">
                                <p>Start Date:
                                    <br><span>{{ \Carbon\Carbon::parse($recordshow->start_datetime)->format('d-m-Y h:i:s A') }}</span>
                                </p>
                                <p>End Date:
                                    <br><span>{{ \Carbon\Carbon::parse($recordshow->expiry_datetime)->format('d-m-Y h:i:s A') }}</span>
                                </p>
                            </div>

                            <div class="text-right mt-2">
                                @php
                                    $now = \Carbon\Carbon::now();
                                    $start = $recordshow->start_datetime ? \Carbon\Carbon::parse($recordshow->start_datetime) : null;
                                    $end   = $recordshow->expiry_datetime ? \Carbon\Carbon::parse($recordshow->expiry_datetime) : null;
                                @endphp
                                @if($start && $end && $now->between($start, $end))
                                    <a href="{{ route('recruitment-portal.candidate.advertisement.show', encrypt($recordshow->id)) }}" 
                                    class="hover-effect-btn text-hover btn btn-default">
                                        Proceed
                                    </a>
                                @elseif($start && $now->lt($start))
                                    <a href="javascript:void(0);" class="text-hover btn btn-theme">
                                        Proceed
                                    </a>
                                @elseif($end && $now->gt($end))
                                    <a href="javascript:void(0);" class="text-hover btn btn-theme">
                                        Proceed
                                    </a>
                                @else
                                    <a href="javascript:void(0);" class="text-hover btn btn-theme">
                                        Proceed
                                    </a>
                                @endif
                            </div>

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection