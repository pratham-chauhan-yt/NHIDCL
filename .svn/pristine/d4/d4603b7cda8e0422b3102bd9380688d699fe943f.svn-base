@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Exit Interview</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="tab_custom_c">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                    </svg> Resignation Form
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> Allotted Assets
                </button>
                <button class="tablink" onclick="openPage('Resigned', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> List of Employees resigned form NHIDCL
                </button>
            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <form action="" method="post" class="form_grid_cust" id="hrAssignAssetForms">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Reason</label>
                            <textarea name="reason" id="reason" rows="1" placeholder="Enter exit interview reason" data-validate="required" data-error="Please enter exit interview reason."></textarea>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Notice Period in days</label>
                            <input type="text" name="notice_period_days" id="notice_period_days" value="90" placeholder="notice period days" disabled>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Checker</label>
                            <select name="ref_checker_id" id="ref_checker_id" data-validate="required" data-error="Please choose your reporting manager.">
                                <option value="">---- Choose your manager ----</option>
                                @forelse($manager as $managerdata)
                                <option value="{{$managerdata->id}}">{{$managerdata->name."  ".$managerdata->email}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Approver</label>
                            <select name="ref_approver_id" id="ref_approver_id" data-validate="required" data-error="Please choose exit interview approver.">
                                <option value="">---- Choose your manager ----</option>
                                @forelse($gmanager as $gmanagerdata)
                                <option value="{{$gmanagerdata->id}}">{{$gmanagerdata->name."  ".$gmanagerdata->email}}</option>
                                @empty
                                @endforelse
                            </select>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn" name="submit" value="Submit" id="savehrAssignAsset">
                        Submit
                        </button>
                    </div>

                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="interviewTableData">
                        <thead>
                            <tr>
                            <th>#</th>
                            <th>Reason</th>
                            <th>Resignation Date</th>
                            <th>Last working day</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    </form>
            </div>

            <div id="News" class="tabcontent" style="display: none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name of asset</th>
                                <th>Asset belongs to</th>
                                <th>No. of assets</th>
                                <th>Allotted - Returned date</th>
                                <th>Status</th>
                                <th>Allotted By</th>
                                <th>Remark</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Test</td>
                                <td>IT</td>
                                <td>1</td>
                                <td>28-01-2025 - NA</td>
                                <td><span class="text-yellow-500">Allotted</span></td>
                                <td>Manager (mgr.division@nhidcl.com)</td>
                                <td>Remark</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div id="Resigned" class="tabcontent" style="display: none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="resignTableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Division</th>
                                <th>Reason</th>
                                <th>Resignation Date</th>
                                <th>Last working day</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>XYZ (xyz@nhidcl.com)</td>
                            <td>HR</td>
                            <td>Testing</td>
                            <td>25-04-2025</td>
                            <td>25-04-2025</td>
                            <td><span class="interview">Pending</span></td>
                            <td>
                                <a href="#" title="More details"><i class="fa-solid fa-ellipsis"></i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const resignEmployeeUrl = "{{ route('employee-management.hr.exit.interview') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush