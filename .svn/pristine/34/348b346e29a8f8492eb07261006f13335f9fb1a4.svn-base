@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Current Vacancies</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="Application">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Advertisement Post</th>
                                    <th>Total Vacancy</th>
                                    <th>Mode Of Recruitment</th>
                                    <th>End Date & Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($postdata) > 0)
                                @foreach ($postdata as $vacancyData)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $vacancyData?->post_name }}</td>
                                        <td>{{ $vacancyData?->total_vacancy ?? 0 }}</td>
                                        <td>{{ $vacancyData?->mode_of_requirement != 4 ? 'Deputation' : 'Permanent' }}</td>
                                        <td>
                                            {{ \Carbon\Carbon::parse($vacancyData?->last_datetime)->format('d-m-Y h:i:s A') }}
                                        </td>
                                        <td>
                                            @if($vacancyData?->is_active)
                                                <span class="badge badge-info">Active</span>
                                            @else
                                                <span class="badge badge-danger">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $now = \Carbon\Carbon::now();
                                                $start = $vacancyData?->advertisement?->start_datetime ? \Carbon\Carbon::parse($vacancyData?->advertisement?->start_datetime) : null;
                                                $end   = $vacancyData?->advertisement?->expiry_datetime ? \Carbon\Carbon::parse($vacancyData?->advertisement?->expiry_datetime) : null;
                                            @endphp
                                            @if($start && $end && $now->between($start, $end) && now()->lessThan(\Carbon\Carbon::parse($vacancyData?->last_datetime)))
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.post', encrypt($vacancyData?->id)) }}" class="btn btn-default btn-sm" target="_blank">Apply Here</a>
                                            @else
                                            <a href="javascript:void(0);" class="btn btn-theme btn-sm text-hover">Apply Here</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                @else
                                    <tr>
                                        <th colspan="7">No records found here</th>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection