@extends('layouts.dashboard')
@section('dashboard_content')
<section class="home-section ">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed"> Login History</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <table class="cust_table__ table_sparated">
            <thead>
                <tr>
                    <th>S.No.</th>
                    <th>Logs</th>
                    <th>Ip Address</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($activities as $data)
                <tr>
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $data->activity }}</td>
                    <td>{{ $data->ip_address }}</td>
                    <td>{{ $data->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
 @endsection