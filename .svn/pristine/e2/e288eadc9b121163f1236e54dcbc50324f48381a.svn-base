@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Aprrove Leave Management</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            @include('components.alert')
            <div id="News" class="tabcontent" style="display: block;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="leaveDataTable">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Purpose</th>
                                <th>Address</th>
                                <th>No. of Days</th>
                                <th>From/To date</th>
                                <th>Prefix/Suffix Date</th>
                                <th>Status</th>
                                <th>Checker</th>
                                <th>Checker Remark</th>
                                <th>Approver</th>
                                <th>Approver Remark</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    const leaveDataUrl = "{{ route('employee-management.apply.leave.approver') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush