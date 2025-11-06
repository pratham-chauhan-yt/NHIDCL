@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                @can('user config - create role')
                    <a href="{{ route('roles.create') }}"><button class="hover-effect-btn gray_btn" type="button">Create Role</button></a>
                @endcan
            </div>
        </div>
    </div>
    <div class="container inner_page_dash__ mt-[20px]" id="rolesContainer" data-roles-url="{{ route('roles.index') }}">
        <h4 class="text-[24px] py-[10px] font-semibold">Role List</h4>
        <table id="roleTable" class="data_bg_table cust_table__ table_sparated  table-auto text-wrap cell-border stripe">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Role</th>
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