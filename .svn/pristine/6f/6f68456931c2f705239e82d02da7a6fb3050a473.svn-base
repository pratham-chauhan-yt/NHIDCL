@extends('layouts.dashboard')
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Audit Query</div>
                <div class="plain_dlfex bg_elips_ic">
                    <select>
                        <option value="Today">2025</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Pending', this, '#373737')" id="defaultOpen">
                        <i class="fa fa-file-lines"></i>
                        Pending Queries
                    </button>

                    <button class="tablink" onclick="openPage('Dropped', this, '#373737')">
                        <i class="fa fa-file-circle-check"></i>
                        Dropped Queries
                    </button>
                </div>

                <div id="Pending" class="tabcontent">
                    <div class="table_over mt-4">
                        <input type="hidden" name="role" id="user_role" value="{{ auth()->user()->hasRole('Resource Pool User') }}">
                        <table class="cust_table__ table_sparated" id="audit_query_table">
                            <thead class="">
                                <tr>
                                    @if (auth()->user()->hasRole('Resource Pool User'))
                                        <th scope="col">#</th>
                                        <th scope="col">Audit Query</th>
                                        <th scope="col">Letter No.</th>
                                        <th scope="col">Letter Date</th>
                                        <th scope="col">Pending</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    @else
                                        <th scope="col">#</th>
                                        <th scope="col">Letter No.</th>
                                        <th scope="col">Letter Date</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div id="Dropped" class="tabcontent">
                    <div class="table_over mt-4">
                        <table class="cust_table__ table_sparated" id="audit_dropped_query_table">
                            <thead class="">
                                <tr>
                                   @if (auth()->user()->hasRole('Resource Pool User'))
                                        <th scope="col">#</th>
                                        <th scope="col">Audit Query</th>
                                        <th scope="col">Letter No.</th>
                                        <th scope="col">Letter Date</th>
                                        <th scope="col">Pending</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    @else
                                        <th scope="col">#</th>
                                        <th scope="col">Letter No.</th>
                                        <th scope="col">Letter Date</th>
                                        <th scope="col">Subject</th>
                                        <th scope="col">Created By</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('/public/validation/auditQuery.js') }}"></script>
@endpush
