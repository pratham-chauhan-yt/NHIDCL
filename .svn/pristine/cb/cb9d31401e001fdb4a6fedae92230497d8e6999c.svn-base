@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Grievance Management</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="top_heading_dash__">
                <div class="main_hed">
                    <h4 class="font-semibold text-black">Grievance List</h4>
                </div>
                @can('grievance-management-create')
                <div class="plain_dlfex bg_elips_ic">
                    <a href="{{ route('grievance-management.grievance.create') }}" class="hover-effect-btn border_btn">{{ __('Create Grievance') }}</a>
                </div>
                @endcan
            </div>
            @include('components.alert')
            <div class="table-responsive">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="grievanceDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Title</th>
                                <th>Name</th>
                                <th>Employee Code</th>
                                <th>Type</th>
                                <th>Submitted Date</th>
                                <th>Assigned</th>
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
    const grievanceDataUrl = "{{ route('grievance-management.grievance.index') }}";
</script>
<script src="{{asset('public/js/grievance-management.js')}}"></script>
@endpush