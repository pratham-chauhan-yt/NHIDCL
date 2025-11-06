@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Project List</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">

            <div id="project" class="tabcontent">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="project-table">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <th>Project Id</th>
                                <th>SAP ID</th>
                                <th>Job No</th>
                                <th>UPC No</th>
                                <th>Project Name</th>
                                <th>Project Type</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('/public/validation/bgms.project.js') }}"></script>
@endpush
