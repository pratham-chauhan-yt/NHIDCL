@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Archieve Recruitment Notices</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="News">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Advertisement</th>
                                    <th>Start date</th>
                                    <th>End date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (sizeof($recordtrash) > 0)
                                    @foreach ($recordtrash as $recordtrashdata)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $recordtrashdata->advertisement_title }}</td>
                                            <td>{{ \Carbon\Carbon::parse($recordtrashdata->start_datetime)->format('d-m-Y') }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($recordtrashdata->expiry_datetime)->format('d-m-Y') }}
                                            </td>
                                            <td>
                                                @if (!empty($recordtrashdata->advertisement_file))
                                                    <a href="{{ url('recruitment-portal/candidate/advertisement/view/files').'?pathName=/uploads/recruitment/advertisement/&fileName=' . urlencode(optional($recordtrashdata)->advertisement_file) }}"
                                                        class="btn btn-default btn-sm" target="_blank">View</a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <th colspan="5">No records found here</th>
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