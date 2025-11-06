@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View Users</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('user-config.view') }}"><button type="button" class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
            </div>
        </div>
    </div>
    <div class="container-fluid inner_page_dash__ mt-[20px]" id="candidateContainer" data-route-url="{{ route('resource-pool.hr.listOfCandidates') }}" data-export-url="{{ route('resource-pool.hr.export') }}">
        <div class="space-y-4 mb-6 inpus_cust_cs ">
            <div class="flex space-x-4 gap-[10px]">
                <div class="flex flex-col gap-[10px]">
                    <label for="email_filter" class="text-sm font-medium">Email:</label>
                    <input type="text" id="email_filter" name="email_filter" placeholder="Filter by Email" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="mobile_filter" class="text-sm font-medium">Mobile:</label>
                    <input type="text" name="mobile_filter" id="mobile_filter" placeholder="Filter by Mobile" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="dob_filter" class="text-sm font-medium">Date Of Birth:</label>
                    <input type="text" name="dob_filter" id="dob_filter" placeholder="Filter by date of birth" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="dob_filter" class="text-sm font-medium">Gender:</label>
                    <select id="gender_filter" name="gender_filter" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="board_filter" class="text-sm font-medium">Board/University:</label>
                    <select id="board_filter" name="board_filter" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Board/University</option>
                        @forelse($university as $boardshow)
                        <option value="{{$boardshow->id}}">{{$boardshow->name}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="experience_filter" class="text-sm font-medium">Experience:</label>
                    <select id="experience_filter" name="experience_filter" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Experience</option>
                        @forelse($experience as $experienceshow)
                        <option value="{{$experienceshow->year}}">{{$experienceshow->fetch_year}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="flex flex-col gap-[10px]">
                    <label for="exam_filter" class="text-sm font-medium">Exam:</label>
                    <select id="exam_filter" name="exam_filter" class="mt-1 px-3 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">Select Exam</option>
                        @forelse($exam as $examshow)
                        <option value="{{$examshow->id}}">{{$examshow->exam_name}}</option>
                        @empty

                        @endforelse
                    </select>
                </div>

                <div class="mt-8">
                    <button onclick="exportFilteredData()" data-export-url="{{ route('resource-pool.hr.export') }}" class="btn btn-primary rounded-lg">
                        Download Excel
                    </button>
                </div>
            </div>
        </div>
        <table id="candidateTable" class="data_bg_table cust_table__ table_sparated  table-auto text-wrap cell-border stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Date Of Birth</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection