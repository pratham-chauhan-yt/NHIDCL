@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Search BG</div>
    </div>
</div>
<div class="inner_page_dash__">
    <div class="my-4 ">

        <div id="project" class="tabcontent">
            <div class="search_section_box md-6 border rounded bg-white shadow-sm p-3">
                <form id="bg-search-form" class="flex flex-wrap items-center gap-2" onsubmit="return false;">
                    <div class="flex">
                        <input
                         type="text"
                         id="searchInput"
                         class="form-control w-1/3"
                         placeholder="Enter value to search">
                    </div>
                    <div class="flex">
                        <input type="radio" class="form-input-contol " name="ref_name" value="Ref. No">Ref. No
                        <span>
                        <input type="radio" class="form-input-contol" name="ref_name" value="BG No">BG No
                        <input type="radio" class="form-input-contol" name="ref_name" value="Agency Name">Agency Name
                        <input type="radio" class="form-input-contol" name="ref_name" value="Amount">Amount
                    </div>
                    <button type="button" id="searchButton" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="table_over">
                <table class="cust_table__ table_sparated" id="search-bg-table">
                    <thead class="">
                        <tr>
                            <!-- <th>#</th>
                                <th>BG Id</th>
                                <th>Ref. No</th>
                                <th>SAP ID</th>
                                <th>Guarantee Type</th>
                                <th>State</th>
                                <th>BG No</th>
                                <th>No. of Renew</th>
                                <th>Expiry Date</th>
                                <th>Track Status</th>
                                <th>Track Claim Lodge</th>
                                <th>Status</th>
                                <th>Action</th> -->
                            <th>S. No</th>
                            <th>Ref. No</th>
                            <th>Project Name</th>
                            <th>State</th>
                            <th>Work Type</th>
                            <th>BG No</th>
                            <th>Guarantee Type</th>
                            <th>Agency Name</th>
                            <th>BG Amount</th>
                            <th>BG Expiry</th>
                            <th>Status</th>
                            <th>Renew Expiry</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody class=""> </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="bg-receive-modal-overlay" class="modal-overlay" style="display: none;"></div>

<div id="bg-receive-modal" class="custom-modal" style="display:none;">
    <form class="form_grid_cust" id="bg-received-form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2>Receive BG</h2>
        <div class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
            <div class="attachment_section_upload_attachment attachment_preview">
                <label>Upload BG</label>
                <div class="flex gap-[10px]">
                    <input type="text" id="uploaded_attachment" name="uploaded_attachment" placeholder="Upload Image"
                        class="uploaded_attachment" readonly>
                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                        <input type="file" id="upload_attachment" name="upload_attachment"
                            class="hidden upload_attachment">
                        <input type="hidden" id="bg_file" name="bg_file" value="">
                    </label>
                </div>
                @error('bg_file')
                <div class="error-message">{{ $message }}</div>
                @enderror

                <input type="hidden" id="uploadUrl" value="{{ route('bgms.bg.upload') }}">
                <input type="hidden" id="viewUrl" value="{{ route('bgms.bg.view') }}">
            </div>

            <div class="modal-buttons">
                <button type="button" class="btn btn-cancel" id="closeModal">Cancel</button>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
@endpush