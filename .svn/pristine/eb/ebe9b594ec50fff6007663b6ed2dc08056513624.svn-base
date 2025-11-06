@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Verify BG / Renew Verification</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">

            <div class="tab_custom_c mb-[20px]">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    Verification Pending
                </button>
                <button class="tablink" onclick="openPage('Home', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                    </svg>
                    Renew
                </button>

            </div>


            <div id="Home" class="tabcontent">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="verifier-table">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div>

            {{-- <div id="Renew" class="tabcontent" style="display:none">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="renew-table">
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>

                        </thead>
                        <tbody class=""> </tbody>
                    </table>
                </div>
            </div> --}}
        </div>
    </div>

    <div id="bg-modal-overlay" class="modal-overlay" style="display: none;"></div>

    <div id="bg-modal" class="custom-modal" style="display:none;">
        <form class="form_grid_cust" id="bg-form" method="POST">
            @csrf
            @method('put')
            <h2>Refer Back BG</h2>
            <div class="inpus_cust_cs form_grid_dashboard_cust_" style="display:block;">
                <div class="">
                    <label class="required-label" for="remarks">Remarks</label>
                    <textarea id="remarks" name="remarks"></textarea>
                    <small class="error-message" style="color:red; display:none;">Please enter valid remark (min 5
                        chars).</small>
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
    <script src="{{ asset('/public/validation/bgms.verifier.js') }}"></script>
@endpush
