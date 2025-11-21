@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Selection Process</div>
        </div>
    </div>

    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c">
                <button class="tablink cursor-pointer" onclick="openPage('Shortlist', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                    </svg> Candidate Shortlist
                </button>
            </div>
            <div id="Shortlist" class="tabcontent">
                <div class="header-grey">
                    <p>Advance Search</p>
                </div>
                <form class="form_grid_cus" action="{{route('recruitment-portal.candidate.shortlist.process')}}" method="post" id="candidateFilterForm">
                    @csrf
                    <input type="hidden" name="action" value="shortlist">
                    <div class="space-y-4 mb-6 inpus_cust_cs body-filter">
                        <div class="ruby gap-[10px]">
                            <x-filter-input label="Advertisement ID" name="advertisementId" type="select" class="advertisement_id js-single" required="required">
                                <option value="">--- Select Advertisement ID ---</option>
                                @foreach ($listOfAdvertisement as $dataOfAdvertisement)
                                    <option value="{{ $dataOfAdvertisement->id }}">
                                        {{ $loop->iteration }} - {{ $dataOfAdvertisement->advertisement_title }}
                                    </option>
                                @endforeach
                            </x-filter-input>
                            <x-filter-input label="Select Post" name="postId" type="select" class="posts_id js-single" required="required">
                                <option value="">Choose posts</option>
                            </x-filter-input>
                            <x-filter-input label="Name" name="name_filter" placeholder="Search candidate name..." />
                            <x-filter-input label="Email" name="email_filter" type="email" placeholder="Search candidate email..." />
                            <x-filter-input label="Mobile" name="mobile_filter" minlength="10" maxlength="10" placeholder="Search candidate mobile..." />
                            <x-filter-input label="GATE Registration Number" name="gate_registartion_filter" placeholder="Search GATE registration number..." />
                            <x-filter-input label="GATE Year" name="gate_year_filter" type="select" class="js-single">
                                <option value="">--- Choose GATE year ---</option>
                                @forelse($years as $yeardata)
                                <option value="{{ $yeardata->id }}">{{ $yeardata->passing_year }}</option>
                                @empty
                                @endforelse
                            </x-filter-input>
                            <x-filter-input label="GATE Score" name="gate_score_filter" placeholder="Search GATE score wise..." />
                            <x-filter-input label="Age" name="age_filter" placeholder="Search candidate age wise..." />
                            <x-filter-input label="Category" name="category_filter" type="select" class="js-single">
                                <option value="">--- Choose category ---</option>
                                @forelse($category as $catdata)
                                <option value="{{ $catdata->id }}">{{ $catdata->caste }}</option>
                                @empty
                                @endforelse
                            </x-filter-input>
                            <x-filter-input label="Gender" name="gender_filter" type="select" class="js-single">
                                <option value="">--- Choose gender ---</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </x-filter-input>
                            <x-filter-input label="Marital Status" name="marital_status_filter" type="select" class="js-single">
                                <option value="">--- Choose marital status ---</option>
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                            </x-filter-input>
                            <x-filter-input label="PwBD" name="pwbd_filter" type="select" class="js-single">
                                <option value="">--- Choose PwBD status ---</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </x-filter-input>
                            <!-- <x-filter-input label="Percentile" name="percentile_filter" placeholder="Search candidate percentile wise..." /> -->
                            <div class="w-fit">
                                <button type="button" name="exportdata" id="exportSelectionData" class="btn btn-primary">Export Data</button>
                            </div>
                        </div>
                    </div>
                    <div class="mt-3">
                        <p>Total Application: <span id="total_vacancy_count">0</span></p>
                    </div>
                
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="postDataTable">
                            <thead class=" ">
                                <tr>
                                    <th>S.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Gate Registration Number</th>
                                    <th>Gate Score</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>View Profile</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                    <div id="paginationContainer" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/recruitment-portal.js') }}"></script>
@endpush