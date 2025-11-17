@extends('layouts.dashboard')
@section('title', 'Enrolled Training List')
@section('dashboard_content')
<section class="home-section ">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Enrolled Training List</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div id="sessions" class="tabcontent">
                <div class="table_over">
                    <table class="table table_sparated table-auto">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Training</th>
                                <th>Check In Time</th>
                                <th>Check Out Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($session as $sessionData)
                            <tr>
                                <td>{{ $loop->index+1 }}</td>
                                <td>{{ $sessionData?->attendee?->name ?? 'N/A' }}</td>
                                <td>{{ $sessionData?->session?->name }}</td>
                                <td>{{ $sessionData?->check_in_time ?? '00:00' }}</td>
                                <td>{{ $sessionData?->check_out_time ?? '00:00' }}</td>
                                <td><span class="badge badge-info">{{ ucfirst($sessionData->status->type ?? 'Enrolled') }}</span></td>
                                <td>
                                    @if($sessionData->status->type === 'Scheduled')
                                        <form action="{{ route('attendee.enroll', Crypt::encrypt($sessionData->id)) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-info btn-sm">Enrolled</button>
                                        </form>
                                    @elseif($sessionData->status->type === 'Enrolled')
                                        <form action="{{ route('attendee.withdraw', Crypt::encrypt($sessionData->id)) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Withdraw</button>
                                        </form>
                                    @else
                                        <button class="btn btn-secondary btn-sm" disabled>Not Enrolled</button>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="7">Not enrolled any trainings.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
