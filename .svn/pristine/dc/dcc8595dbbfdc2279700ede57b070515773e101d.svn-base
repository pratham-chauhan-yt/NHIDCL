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
        <div class="inner_page_dash__">
            <div class="my-4">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Chairperson', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        Candidate Shortlist by Committee
                    </button>
                </div>

                <div id="Chairperson" class="tabcontent">
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
                                    <th>Members Remark</th>
                                    <th>Select</th>
                                    <th>Remark</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>

                    @can('resource pool - create chairperson shortlist')
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn border_btn" id="saveDraftBtn" type="button">Save Draft</button>
                            <button class="hover-effect-btn gray_btn" id="generateShortlist" type="button">Generate
                                Shortlist</button>
                        </div>
                    @endcan
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/chairperson/selection-process.js') }}"></script>
@endpush
