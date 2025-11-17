@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Session List</div>
                <div class="plain_dlfex bg_elips_ic">
                    <a href="{{ route('sessions.index') }}"><button class="hover-effect-btn gray_btn" type="button">Back</button></a>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="sessions" class="tabcontent">
                    <div class="table_over">
                        <table class="table_sparated" id="sessionsTable">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Agenda</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const sessionsDataUrl = "{{ route('sessions.index') }}";
    </script>
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush