@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Candidate Profile Logs</div>
                <button onclick="window.location.href='{{ route("recruitment-portal.application.activity.export") }}'" class="btn btn-primary rounded-lg">
                    Export Data
                </button>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="applicantLogDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Date Time</th>
                                <th>Ip Address</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Status</th>
                                <th>Comment</th>
                                <th>View File</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const applicantLogDataUrl = "{{route('recruitment-portal.application.activity.data')}}";
    </script>
    <script src="{{ asset('public/js/recruitment-portal.js') }}"></script>
@endpush