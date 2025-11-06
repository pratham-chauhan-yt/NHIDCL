@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container">
    <h1>Your Activities</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Activity</th>
                <th>IP Address</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($activities as $activity)
                <tr>
                    <td>{{ $activity->activity }}</td>
                    <td>{{ $activity->ip_address }}</td>
                    <td>{{ $activity->created_at }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
