@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Roles Permissions') }}</div>
                <div class="plain_dlfex bg_elips_ic">
                    @can('permissions-create')
                        <a href="{{ route('permissions.create') }}"><button class="hover-effect-btn gray_btn"
                                type="button">Create Permission</button></a>
                    @endcan
                </div>
            </div>
        </div>
        <div class="container inner_page_dash__ mt-[20px]" id="permissionContainer" data-route-url="{{ route('permissions.index') }}">
            <h4 class="text-[24px] py-[10px] font-semibold">Permission List</h4>
            <table id="permissionTable" class="data_bg_table cust_table__ table_sparated  table-auto text-wrap cell-border stripe">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </section>
@endsection