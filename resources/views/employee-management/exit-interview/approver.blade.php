@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Exit Interview</div>
    </div>
</div>
<div class="inner_page_dash__">
    <div class="my-4">
        @include('components.alert')
        <div id="Home" class="tabcontent" style="display: block;">
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
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    const interviewExitUrl = "{{ route('employee-management.exit.interview.approver') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush