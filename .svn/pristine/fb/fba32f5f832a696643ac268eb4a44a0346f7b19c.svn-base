@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Employees Detail</div>
            <div class="plain_dlfex bg_elips_ic">
                <select name="month" id="month">
                    <option value="01">01</option>
                </select>
                <select name="year" id="year">
                    <option value="2025">2025</option>
                </select>
            </div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="tab_custom_c">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                    </svg> Attendance Details
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> Applied Leave Details
                </button>
                <button class="tablink" onclick="openPage('Leave', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> Employees Leave Details
                </button>
            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="hrAttendanceTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Division</th>
                                <th>Purpose</th>
                                <th>Address/Location</th>
                                <th>No. of Days</th>
                                <th>From/To date</th>
                                <th>Status</th>
                                <th>Checker</th>
                                <th>Checker Remark</th>
                                <th>Approver</th>
                                <th>Approver Remark</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="News" class="tabcontent" style="display: none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="hrLeaveDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Division</th>
                                <th>Purpose Of Leave</th>
                                <th>Address during the leave period</th>
                                <th>No. of Days</th>
                                <th>From/To date</th>
                                <th>Prefix/Suffix Date</th>
                                <th>Status</th>
                                <th>Checker</th>
                                <th>Checker Remark</th>
                                <th>Approver</th>
                                <th>Approver Remark</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="Leave" class="tabcontent" style="display: none;">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="table_over">
                        <h4>Deputation Employees</h4>
                        <table class="cust_table__ table_sparated table-auto">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Employee</th>
                                    <th>Division</th>
                                    <th>Earned</th>
                                    <th>Casual</th>
                                    <th>Half-pay</th>
                                    <th>Restricted</th>
                                    <th>Checker</th>
                                    <th>Approver</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>XYZ<br>(xyz@nhidcl.com)</td>
                                    <td>Technical</td>
                                    <td>312</td>
                                    <td>8</td>
                                    <td>10</td>
                                    <td>2</td>
                                    <td>Manager<br>(mgr.division@nhidcl.com)</td>
                                    <td>GM<br>(gm.division@nhidcl.com)</td>
                                    <td><a href="#"><i class="fa fa-clock-rotate-left m-1" title="View Leave History"></i></a> <a href="#"><i class="fa fa-pencil m-1" title="Edit Leave"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    const hrAttendanceDataUrl = "{{route('employee-management.hr.employee.attendance.table')}}";
    const hrLeaveDataUrl = "{{route('employee-management.hr.employee.attendance')}}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush