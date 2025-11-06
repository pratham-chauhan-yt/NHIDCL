@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">My Application</div>
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
                                    <th>Advertisement</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($application) > 0)
                                @foreach ($application as $applicationData)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $applicationData?->advertisementPost?->post_name }}</td>
                                        <td>{{ $applicationData?->users?->name }}</td>
                                        <td>{{ $applicationData?->users?->email }}</td>
                                        <td>{{ $applicationData?->users?->mobile }}</td>
                                        <td><span class="badge badge-info">{{ $applicationData?->status?->status }}</span></td>
                                        <td>
                                            <a href="{{ route('recruitment-portal.candidate.advertisement.post', encrypt($applicationData?->nhidcl_recruitment_posts_id)) }}" class="btn btn-default btn-sm" target="_blank">View Application</a>
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