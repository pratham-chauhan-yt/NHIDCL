@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Claim Lodge BG List</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">

            <div id="project" class="tabcontent">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="claimlodge-bg-table">
                        <thead class="">
                            <tr>
                                <th>#</th>
                                <!-- <th>BG Id</th> -->
                                <th>Ref. No</th>
                                <th>SAP ID</th>
                                <th>BG No</th>
                                <th>Guarantee Type</th>
                                <th>State</th>
                                <th>No. of Renew</th>
                                <th>Expiry Date</th>
                                <th>Track Status</th>
                                <th>Track Claim Lodge</th>
                                <th>Status</th>
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
        <h2 id="bg-action-title"></h2>

        {{-- Hidden field to tell backend which action --}}
        <input type="hidden" name="action_type" id="action_type">

<div style="display:none;" id="bg-encashment-section">
    <label class="required-label" for="remarks_encashment">Remarks</label>
    <textarea id="remarks_encashment" name="remarks_encashment" class="form-control"></textarea>
<small class="error-message" id="remarks_encashment_error" style="color:red; display:none;">
    Please enter valid remarks (minimum 5 words required).
</small>
</div>

        <div class="modal-buttons">
            <button type="button" class="btn btn-cancel" id="closeModal">Cancel</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>
@endsection
@push('scripts')
    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
<script>
$(document).on('click', '.bg-encashment', function () {
    let actionUrl = $(this).data('action'); 
    let actionType = $(this).data('type'); 

    // set form action
    $('#bg-received-form').attr('action', actionUrl);
    $('#action_type').val(actionType);
    $('#bg-action-title').text('BG Encashment');

    // hide all sections
    $('#bg-receive-modal form > div[id$="-section"]').hide();

    // show only encashment section
    $('#bg-encashment-section').show();

    // show modal
    $('#bg-receive-modal-overlay').show();
    $('#bg-receive-modal').show();
});

// Close modal
$('#closeModal, #bg-receive-modal-overlay').on('click', function () {
    $('#bg-receive-modal-overlay').hide();
    $('#bg-receive-modal').hide();
});

// Validation before submit
$('#bg-received-form').on('submit', function(e) {
    let remarks = $('#remarks_encashment').val().trim();
    let wordCount = remarks.split(/\s+/).filter(function(word) { return word.length > 0; }).length;

    if ($('#action_type').val() === 'bg-encashment') {
        if (wordCount < 5) {
            e.preventDefault();
            $('#remarks_encashment_error').show();
            return false;
        } else {
            $('#remarks_encashment_error').hide();
        }
    }
});
</script>

@endpush
