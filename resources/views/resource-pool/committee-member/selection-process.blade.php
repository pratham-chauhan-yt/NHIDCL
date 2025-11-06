@extends('layouts.dashboard')

@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Selection Process</div>
                <div class="plain_dlfex bg_elips_ic">
                    <select name="year" id="year">
                        @foreach ($requisitionYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="inner_page_dash__ my-4">
            <div class="tab_custom_c">
                <button class="tablink" onclick="openPage('Committee', this, '#373737')" id="defaultOpen">
                    Candidate Shortlist by Committee
                </button>
            </div>

            <div id="Committee" class="tabcontent">
                <form class="form_grid_cus">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                        <div>
                            <label>Select requisition ID</label>
                            <select class="js-single" id="requisitionId" name="requisitionId">
                                <option value="">Select requisition ID</option>
                                @foreach ($listOfRequisitions as $listOfRequisition)
                                    <option value="{{ $listOfRequisition->id }}">
                                        {{ $listOfRequisition->id }} - {{ $listOfRequisition->job_title }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label>Select shortlist code</label>
                            <select class="js-single" id="shortlistId" name="shortlistId">
                                <option value="">Select shortlist code</option>
                            </select>
                        </div>
                    </div>
                </form>

                <div class="table_over mt-4 p-1">
                    <table id="candidateTable"
                        class="cust_table__ table-auto text-wrap cell-border stripe compact hover w-full">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>View</th>
                                <th>Select</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

                @can('resource pool - create committee shortlist')
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn border_btn" id="saveDraftBtn" type="button">Save Draft</button>
                        <button class="hover-effect-btn gray_btn" id="generateShortlist" type="button">Generate
                            Shortlist</button>
                    </div>
                @endcan
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/committee-member/selection-process.js') }}"></script>
@endpush
