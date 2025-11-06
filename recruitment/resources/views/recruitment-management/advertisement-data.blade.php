@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Advertisement Details</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <p><b>Start Date:</b> <br><span>{{ \Carbon\Carbon::parse($record->start_datetime)->format('d-m-Y h:i:s A') }}</span></p>
                        <p><b>End Date Time:</b> <br><span>{{ \Carbon\Carbon::parse($record->expiry_datetime)->format('d-m-Y h:i:s A') }}</span></p>
                    </div>
                    <hr class="my-3">
                    <div class="heading_and_btn">
                        <h1 class="candidat_cust-title">{{$record->advertisement_title}}</h1>

                    <div class="inline-flex mt-3 mb-2 gap-10">
                        <!-- <h2 class="font-semibold text-red-500">Notes:-</h2> -->
                        @if (!empty($record?->advertisement_file))
                            <p><a href="{{ url('recruitment-portal/candidate/advertisement/view/files').'?pathName=/uploads/recruitment/advertisement/&fileName=' . urlencode(optional($record)->advertisement_file) }}" class="text-hover btn btn-default" target="_blank">View Advertisement</a></p>
                        @endif
                    </div>
                    </div>
                    <!-- <p>{{$record->note_instruction}}</p> -->
                    <div class="candidat_cust-container-3cols">
                        @foreach($postdata as $postresult)
                        @php
                            $readableModes = $postresult->moderecruitment->pluck('name')->implode(', ');
                        @endphp
                        <div class="candidat_cust-item">
                            <div class="candidat_cust-header">
                                <span class="candidat_cust-time">Mode of Recruitment</span>
                                <span class="candidat_cust-time">{{ $readableModes }}</span>
                            </div>
                            <h4 class="candidat_cust-title">{{$postresult->post_name}}</h4>
                            {{-- <br> --}}

                            <div class="candidat_cust-dates">
                                <p>Total Vacancy <br><span>{{ $postresult->total_vacancy ?? '0' }}</span></p>
                                @if($postresult->last_datetime)
                                <p>Last date and time <br><span>{{ \Carbon\Carbon::parse($postresult->last_datetime)->format('d-m-Y h:i:s A') }}</span></p>
                                @endif
                            </div>
                            @php
                                $now = \Carbon\Carbon::now();
                                $start = $record?->start_datetime ? \Carbon\Carbon::parse($record?->start_datetime) : null;
                                $end   = $record?->expiry_datetime ? \Carbon\Carbon::parse($record?->expiry_datetime) : null;
                            @endphp
                            @if($start && $end && $now->between($start, $end) && now()->lessThan(\Carbon\Carbon::parse($postresult->last_datetime)))
                            <div class="text-right">
                                <a href="{{ route('recruitment-portal.candidate.advertisement.post', encrypt($postresult->id)) }}" class="hover-effect-btn text-hover btn btn-primary text-white">Apply Here</a>
                            </div>
                            @else
                            <div class="text-right">
                                <a href="javascript:void(0);" class="text-hover btn btn-theme">Apply Here</a>
                            </div>
                            @endif

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
