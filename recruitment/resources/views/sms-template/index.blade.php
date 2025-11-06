@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Grievance List</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">

                <div id="grievance" class="tabcontent">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="grievance-table">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Grievance Id</th>
                                    <th>Name</th>
                                    <th>Employee No</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Pay Scale</th>
                                    <th>Date</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class=""> </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('/public/validation/grievance.js') }}"></script>
@endpush
