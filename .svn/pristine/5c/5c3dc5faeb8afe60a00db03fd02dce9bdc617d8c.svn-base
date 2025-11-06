@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Selection Process</div>
                <div class="plain_dlfex bg_elips_ic">
                    <select name="requisition-year" id="requisition-year">
                            <option value="">Select Year</option>
                        @foreach ($requisitionYears as $year)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                        </svg>
                        Candidate Shortlist
                    </button>
                    <button class="tablink select-candidate" onclick="openPage('News', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                        </svg>
                        Candidate Assessment
                    </button>
                    <button class="tablink" onclick="openPage('Contact', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                        </svg>
                        Candidate Selection
                    </button>

                </div>

                <div id="Home" class="tabcontent">
                    <form class="form_grid_cus" id="searchCandidate" action="#" method="POST">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                            <div class="">
                                <label class="required-label" for="job_title">Select requisition ID</label>
                                <select class="js-single" id="requisitionId" name="requisitionId">
                                    <option value="">Select requisition ID</option>
                                    @foreach ($listOfRequisitions as $listOfRequisition)
                                        <option value="{{ $listOfRequisition->id }}">
                                            {{ $listOfRequisition->id }} - {{ $listOfRequisition->job_title }}
                                        </option>
                                    @endforeach
                                </select>
                                <span class="candidateErr" id="requisitionId_err">
                                    <span id="requisitionId_err" class="candidateErr requisitionId_err">
                                        @if ($errors->has('requisitionId'))
                                            {{ $errors->first('requisitionId') }}
                                        @endif
                                    </span>
                                </span>
                            </div>
                            <button type="button" class="hover-effect-btn border_btn h-fit w-fit"
                                id="generateCandidateList">
                                Generate candidate list
                            </button>
                        </div>
                    </form>

                    <div class="table_over p-1">
                        <div id="filters" class="filters" style="margin-bottom:15px; display:flex; flex-wrap:wrap; gap:15px;"></div>
                        <table class="cust_table__ table_sparated table-auto text-wrap cell-border stripe compact hover w-full" id="candidateTable">
                            <thead>
                                <tr>
                                    <th>Sr.No.</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Select</th>
                                </tr>
                            </thead>
                            <tfoot>
                                
                            </tfoot>
                            <tbody id="user-lists"></tbody>
                        </table>
                    </div>

                    <form class="form_grid_cust">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Remark</label>
                                <textarea rows="1" class="" name="remarks" id="remarks" placeholder="Add your comment"></textarea>
                                <span id="remarks_err" class="candidateErr remarks_err">
                                    @if ($errors->has('remarks'))
                                        {{ $errors->first('remarks') }}
                                    @endif
                                </span>
                            </div>

                            <div class="attachment_section_efileCommittee attachment_preview">
                                <label class="">E-File(<span style="font-size: 10px;">Max size 2MB</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="efileCommitteee" name="efileCommitteee"
                                        placeholder="Upload Certificate" class="efileCommitteee" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="efileCommittee" name="efileCommittee[]"
                                            class="hidden efileCommittee">
                                        <input type="hidden" id="competClickedFrom" name="competClickedFrom"
                                            value="">
                                    </label>
                                </div>
                                <span id="efileCommittee_err" class="candidateErr efileCommittee_err">
                                    @if ($errors->has('efileCommittee'))
                                        {{ $errors->first('efileCommittee') }}
                                    @endif
                                </span>
                            </div>

                        </div>


                    </form>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn border_btn" type="button" id="shortlist">
                            Save Draft
                        </button>
                        <button class="hover-effect-btn gray_btn" onclick="fetchExternalMembers()"
                            id="togglesButton">Generate Shortlist</button>
                        <!-- Main modal -->
                        <div id="static-modal2" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                            class="hidden overflow-y-auto bg-[#0000006b] overflow-x-hidden fixed top-0 right-0 left-0 z-80 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-xl max-h-full">
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-[20px] py-[20px]">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between pr-[10px]">
                                        <button type="button"
                                            class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                            data-modal-hide="static-modal2">
                                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="toggleDiv" style="display:none">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                            <div class="">Selection of Committee Members</div>
                        </div>
                        <form class="form_grid_cus">
                            <div class="inpus_cust_cs grid check_box_input grid-cols-3 gap-[30px] mt-4">
                                <div class="">
                                    <label for="users1" class="required-label">Select Chairperson</label>
                                    <select class="js-single" name="users1" id="users1">
                                        <option value="">Select Chairperson</option>
                                        @foreach ($user_chairpersons as $user_chairperson)
                                            <option value="{{ $user_chairperson->id }}">{{ $user_chairperson->name }}
                                                ({{ $user_chairperson->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                    <span id="users1_err" class="candidateErr users1_err">
                                        @if ($errors->has('users1'))
                                            {{ $errors->first('users1') }}
                                        @endif
                                    </span>
                                </div>

                                <div class="">
                                    <label class="required-label">Select NHIDCL Committee Member</label>
                                    <select class="js-multiple" name="users2[]" id="users2" multiple="multiple">
                                        <option value="" disabled>Select NHIDCL Committee Member</option>
                                        @foreach ($user_member as $user_members)
                                            <option value="{{ $user_members->id }}">{{ $user_members->name }} ({{ $user_members->email }})</option>
                                        @endforeach
                                    </select>
                                    <span id="users2_err" class="candidateErr users2_err">
                                        @if ($errors->has('users2'))
                                            {{ $errors->first('users2') }}
                                        @endif
                                    </span>
                                </div>


                                <div id="mySelect">
                                    <label>Select External Committee Member</label>
                                    <select class="js-multiple" name="users3[]" id="users3" multiple="multiple">
                                        <option value="" disabled>Select External Committee Member</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="button_flex_cust_form">
                            <button type="button" class="hover-effect-btn border_btn" data-modal-target="addMemberModal"
                                data-modal-toggle="addMemberModal">
                                Add External Committee Member
                            </button>

                            <button class="hover-effect-btn gray_btn" id="generateShortlisted">
                                Finalize Committee
                            </button>
                        </div>
                    </div>
                    {{-- Start Add External Committee Member Modal --}}
                    <div id="addMemberModal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto bg-[#0000006b] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">

                        <div class="relative p-4">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow-sm dark:bg-gray-700">
                                <!-- Modal header -->
                                <div class="flex items-center justify-between p-4 md:p-5 border-b border-gray-200 dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                        Add External Committee Member
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                        data-modal-hide="addMemberModal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="M1 1l6 6m0 0l6 6M7 7l6-6M7 7L1 13" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>

                                <!-- Modal body -->
                                <div class="px-4 md:px-5 pb-4 md:pb-5">
                                    <form id="registerExternalMember" class="space-y-4">
                                        @csrf
                                        <div>
                                            <label for="externalMemberName"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                                            <input type="text" name="externalMemberName" id="externalMemberName"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                                placeholder="Enter external member name" maxlength="500" required />
                                            <div class="error-message text-red-500 text-sm mt-1"></div>
                                        </div>
                                        <div>
                                            <label for="externalMemberEmail"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                                            <input type="email" name="externalMemberEmail" id="externalMemberEmail"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                                placeholder="Enter external member email" maxlength="500" required />
                                            <div class="error-message text-red-500 text-sm mt-1"></div>
                                        </div>
                                        <div>
                                            <label for="externalMemberMobile"
                                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile Number</label>
                                            <input type="text" name="externalMemberMobile" id="externalMemberMobile"
                                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-sm focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-black"
                                                placeholder="Enter external member mobile number" maxlength="10" required />
                                            <div class="error-message text-red-500 text-sm mt-1"></div>
                                        </div>
                                        <button type="button" id="ExternalMemberData"
                                            class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2 mb-6 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hover-effect-btn gray_btn">
                                            Add Member
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- End Add External Committee Member Modal --}}
                </div>


                @include('resource-pool.HR.candidate-assessment')

                @include('resource-pool.HR.candidate-selection')
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/resource-pool/hr/selection-process.js') }}"></script>
@endpush
