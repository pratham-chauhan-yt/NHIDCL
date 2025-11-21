@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Add Participants</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="sessions" class="tabcontent">
                    <div class="space-y-4 mb-6 inpus_cust_cs ">
                        <div class="flex space-x-4 gap-[10px]">
                            <div class="flex flex-col gap-[10px]">
                                <label for="name_filter" class="text-sm font-medium">Name:</label>
                                <input type="text" id="name_filter" name="name_filter" placeholder="Filter by Name" class="filter-input">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label for="email_filter" class="text-sm font-medium">Email:</label>
                                <input type="text" id="email_filter" name="email_filter" placeholder="Filter by Email" class="filter-input">
                            </div>

                            <div class="flex flex-col gap-[10px]">
                                <label for="mobile_filter" class="text-sm font-medium">Mobile:</label>
                                <input type="text" name="mobile_filter" id="mobile_filter" placeholder="Filter by Mobile" class="filter-input">
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label for="department_filter" class="text-sm font-medium">Department:</label>
                                <select id="department_filter" name="department_filter" class="filter-input">
                                    <option value="">Select Department</option>
                                    @foreach($department as $rowDepart)
                                        <option value="{{$rowDepart->id}}">{{$rowDepart->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="flex flex-col gap-[10px]">
                                <label for="designation_filter" class="text-sm font-medium">Designation:</label>
                                <select id="designation_filter" name="designation_filter" class="filter-input">
                                    <option value="">Select Designation</option>
                                    @foreach($designation as $rowDesign)
                                        <option value="{{$rowDesign->id}}">{{$rowDesign->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <form action="{{ route('hr.training.participants.employee.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="sessionid" value="{{ Crypt::encrypt($session->id) }}">
                        <div class="table_over">
                            <table class="table_sparated" id="employeeTable">
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
                        <div class="form-input text-center">
                            <button type="submit" name="action" class="btn btn-primary">Add Participants</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script>
        const employeeDataUrl = "{{ route('hr.training.participants.employee') }}";
    </script>
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush