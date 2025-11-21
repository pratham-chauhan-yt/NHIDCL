@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Training Attendance</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="sessions" class="tabcontent">
                    <div class="space-y-4 mb-6 inpus_cust_cs ">
                        <div class="flex space-x-4 gap-[10px]">
                           <div class="flex flex-col gap-[10px]">
                                <label for="designation_filter" class="text-sm font-medium">Training Session:</label>
                                <select id="designation_filter" name="designation_filter" class="filter-session">
                                    <option value="">Select Training Session</option>
                                    @foreach($session as $rowData)
                                        <option value="{{$rowData->id}}">{{$rowData->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('hr.training.participants.employee.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="sessionid" value="">
                        <div class="table_over">
                            <table class="table_sparated" id="trainingSessionTable">
                                <thead class="">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Department</th>
                                        <th>User Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const employeeDataUrl = "{{ route('hr.training.attendance') }}";
    </script>
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush