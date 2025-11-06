@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Accepted BG</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">

            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen" data-tab="accepted_bg">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Accepted BG
                </button>
            <button class="tablink" onclick="openPage('Home', this, '#373737')" data-tab="renew">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    Renew
                </button>
            </div>

            <div id="Home" class="tabcontent">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="accepted-table">
                        <thead class="">
                            <tr>
                                <th>#</th>
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
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div>
        </div>

    {{-- Model For the status --}}
<div id="track-status-modal-overlay" class="track-status-modal-overlay" style="display: none;"></div>

<div id="track-status-modal" class="track-status-modal" style="display:none; position: relative;">
    <!-- Close button -->
    <span id="close-track-status-modal" 
          style="position: absolute; top: 10px; right: 15px; font-size: 22px; font-weight: bold; cursor: pointer;">
        &times;
    </span>

    <table class="cust_table__ table_sparated" id="track-status-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <th>Updated By</th>
                <th>Verified By</th>
                <th>Reason</th>
                <th>Receiving</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


{{-- Model For the claim lodge --}}
<div id="track-status-modal-claimlodge-overlay" class="track-status-modal-overlay" style="display: none;"></div>

<div id="track-status-modal-claimlodge" class="track-status-modal" style="display:none; position: relative;">
    <!-- Close button -->
    <span id="close-track-status-modal-claimlodge" 
          style="position: absolute; top: 10px; right: 15px; font-size: 22px; font-weight: bold; cursor: pointer;">
        &times;
    </span>

    <table class="cust_table__ table_sparated" id="track-claimlodge-table">
        <thead>
            <tr>
                <th>#</th>
                <th>Status</th>
                <!-- <th>Updated By</th> -->
                  <th>Remark</th>
                <!-- <th>Verified By</th> -->
                 <th>Claim by Whome</th>
                <!-- <th>Reason</th>
                <th>Receiving</th> -->
                <th>Date</th>
            </tr>
        </thead>
        <tbody></tbody>
    </table>
</div>


<div id="bg-receive-modal" class="custom-modal" style="display:none;">
    <form class="form_grid_cust" id="bg-received-form" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <h2 id="bg-action-title"></h2>

        {{-- Hidden field to tell backend which action --}}
        <input type="hidden" name="action_type" id="action_type">

<div style="display:none;" id="bg-remark-section">
    <label class="required-label" for="remarks_tech">Remarks</label>
    <textarea id="remarks_tech" name="remarks_tech" class="form-control"></textarea>
    <small class="error-message" style="color:red; display:none;">
        Please enter valid remark (min 5 chars).
    </small>
</div>

<div style="display:none;" id="bg-remark-ec-section">
    <label class="required-label" for="remarks_encash">Remarks</label>
    <textarea id="remarks_encash" name="remarks_encash" class="form-control"></textarea>
    <small class="error-message" style="color:red; display:none;">
        Please enter valid remark (min 5 chars).
    </small>
</div>

<div style="display:none;" id="bg-remark-claim-lodge">
    <label class="required-label" for="remarks_claim">Remarks</label>
    <textarea id="remarks_claim" name="remarks_claim" class="form-control"></textarea>
    <small class="error-message" style="color:red; display:none;">
        Please enter valid remark (min 5 chars).
    </small>
</div>


        <div id="bg-upload-section" class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
            <div class="attachment_section_upload_attachment attachment_preview">
                <label>Upload BG</label>
                <div class="flex gap-[10px]">
                    <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                           placeholder="Upload Image" class="uploaded_attachment" readonly>
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
        </div>

        <div class="modal-buttons">
            <button type="button" class="btn btn-cancel" id="closeModal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@push('style_start')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
    <style>
        .track-status-modal {
            display: -webkit-box;
            position: fixed;
            background: white;
            width: 814px !important;
            padding: 20px;
            top: 20%;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }
    </style>
@endpush
@push('scripts')
    <script src="{{ asset('/public/validation/bgms.finance.js') }}"></script>
    <script src="{{ asset('/public/tilwind.js') }}"></script>
    <script>
    //cross button
    document.getElementById('close-track-status-modal').addEventListener('click', function() {
    document.getElementById('track-status-modal').style.display = 'none';
    document.getElementById('track-status-modal-overlay').style.display = 'none';
  });

    //cross button
    document.getElementById('close-track-status-modal-claimlodge')
    .addEventListener('click', function() {
        document.getElementById('track-status-modal-claimlodge').style.display = 'none';
        document.getElementById('track-status-modal-claimlodge-overlay').style.display = 'none';
    });

    </script>
    <script>
// Track Status
$(document).on('click', '.track_status', function () {
    const modal = $('#track-status-modal');
    const overlay = $('#track-status-modal-overlay');
    const actionUrl = $(this).data('action');

    $('#track-status-table tbody').empty();
    modal.show();
    overlay.show();

    $.get(actionUrl, function (response) {
        if (response?.length > 0) {
            response.forEach((row, index) => {
                $('#track-status-table tbody').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.status}</td>
                        <td>${row.updated_by}</td>
                        <td>${row.verified_by || ''}</td>
                        <td>${row.reason || ''}</td>
                        <td>${row.receiving || ''}</td>
                        <td>${row.date}</td>
                    </tr>
                `);
            });
        } else {
            $('#track-status-table tbody').append(`<tr><td colspan="7" style="text-align:center;">No data available</td></tr>`);
        }
    });
});

$('#close-track-status-modal, #track-status-modal-overlay').on('click', function () {
    $('#track-status-modal').hide();
    $('#track-status-modal-overlay').hide();
    $('#track-status-table tbody').empty();
});

// Claim Lodge
$(document).on('click', '.track_claim_lodge', function () {
    const modal = $('#track-status-modal-claimlodge');  
    const overlay = $('#track-status-modal-claimlodge-overlay');  
    const actionUrl = $(this).data('action');

    $('#track-claimlodge-table tbody').empty();
    modal.show();
    overlay.show();

    $.get(actionUrl, function (response) {
        if (response?.length > 0) {
            response.forEach((row, index) => {
                $('#track-claimlodge-table tbody').append(`
                    <tr>
                        <td>${index + 1}</td>
                        <td>${row.status}</td>
                        <td>${row.reason || ''}</td>
                        <td>${row.created_by}</td>
                        <td>${row.date}</td>
                    </tr>
                `);
            });
        } else {
            $('#track-claimlodge-table tbody').append(`<tr><td colspan="7" style="text-align:center;">No data available</td></tr>`);
        }
    });
});

$('#close-track-status-modal-claimlodge, #track-status-modal-claimlodge-overlay').on('click', function () {
    $('#track-status-modal-claimlodge').hide();
    $('#track-status-modal-claimlodge-overlay').hide();
    $('#track-claimlodge-table tbody').empty();
});
</script> 
@endpush
