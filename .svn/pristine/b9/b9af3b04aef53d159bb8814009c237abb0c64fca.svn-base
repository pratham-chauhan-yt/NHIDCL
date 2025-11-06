@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Asset Details</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="tab_custom_c mt-5">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10"></path>
                    </svg> Assign Asset
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> Assets Allocated by You
                </button>
                <button class="tablink" onclick="openPage('All', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"></path>
                    </svg> Total Assets Allocated by NHIDCL
                </button>
            </div>
            @include('components.alert')
            <div id="Home" class="tabcontent" style="display: block;">
                <form action="" method="post" class="form_grid_cust" id="hrAssignAssetForms">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Name of asset</label>
                            <input type="text" name="asset_name" id="asset_name" placeholder="Name of asset" data-validate="required" data-error="Please enter name of assets.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">No. of assets</label>
                            <input type="number" name="number_of_asset" id="number_of_asset" placeholder="Enter number of assets" data-validate="required" data-error="Please enter total number od assets.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Division</label>
                            <select name="division" id="division" data-validate="required" data-error="Please choose employee division.">
                                <option value="">--- Choose Employee Division ---</option>
                                @foreach($department as $division)
                                    <option value="{{ $division->id }}">{{ $division->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-input">
                            <label class="required-label">Assign to</label>
                            <select name="assign" id="assign" data-validate="required" data-error="Please choose assign assets employee.">
                                <option value="">--- Choose Asset Assign Employee ---</option>
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Remark</label>
                            <textarea name="remarks" id="remarks" rows="3" placeholder="Remark" maxlength="500" data-validate="required" data-error="Please enter remarks."></textarea>
                            <small class="form-text text-muted text-red">
                                Remarks exceeding 500 characters will not be accepted.
                            </small>
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button type="submit" class="hover-effect-btn fill_btn" name="submit" id="savehrAssignAsset" value="Submit">
                            Submit
                        </button>
                    </div>
                </form>
            </div>

            <div id="News" class="tabcontent" style="display: none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="assetTableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name of asset</th>
                                <th>No. of assets</th>
                                <th>Allotted - Returned date</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Allotted To</th>
                                <th>Division of emp.</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

            <div id="All" class="tabcontent" style="display: none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated table-auto" id="assetTotalTableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name of asset</th>
                                <th>No. of assets</th>
                                <th>Allotted - Returned date</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Allotted To</th>
                                <th>Division of emp.</th>
                                <th>Allotted By</th>
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
    const userDivisionUrl = "{{ route('employee-management.get.users.by.division') }}";
    const assetDataUrl = "{{ route('employee-management.hr.assign.asset') }}";
    const assetTotalDataUrl = "{{ route('employee-management.hr.assign.asset.table') }}";
</script>
<script src="{{asset('public/js/employee-management.js')}}"></script>
@endpush