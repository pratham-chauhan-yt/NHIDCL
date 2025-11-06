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
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    Accepted BG
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

        <div id="track-status-modal" class="track-status-modal" style="display:none;">

            <table class="cust_table__ table_sparated" id="track-status-table">
                <thead class="">
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
                <tbody class=""> </tbody>
            </table>


        </div>

    </div>

    <div id="bg-receive-modal-overlay" class="modal-overlay" style="display: none;"></div>

    <div id="bg-receive-modal" class="custom-modal" style="display:none;">
        <form class="form_grid_cust" id="bg-received-form" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <h2 id="bg-action-title"></h2>

            <input type="hidden" name="return_to_technical" id="return_to_technical">

            <div style="display:none;" id="bg-remark-section">


                <label class="required-label" for="remarks">Remarks</label>
                <textarea id="remarks" name="remarks" class="form-control"></textarea>
                <small class="error-message" style="color:red; display:none;">Please enter valid remark (min 5
                    chars).</small>

            </div>

            <div id="bg-upload-section" class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
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
    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
    {{-- <script src="{{ asset('/public/flowbit.min.js') }}"></script> --}}
    <script src="{{ asset('/public/tilwind.js') }}"></script>
@endpush
