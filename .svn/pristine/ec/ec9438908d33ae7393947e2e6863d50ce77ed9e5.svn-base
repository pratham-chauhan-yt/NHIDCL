@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Users List</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="tabcontent">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="usersTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Date Of Birth</th>
                                    <th>Registration Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const usersDataUrl = "{{ route('recruitment-portal.candidate.view') }}";
    </script>
    <script src="{{ asset('/public/js/recruitment-portal.js') }}"></script>
@endpush
