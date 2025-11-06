@extends('layouts.dashboard')


@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Renew BG</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <h1 class="candidat_cust-title">{{ $bg->id }}, {{ $bg->project?->project_name }}</h1>
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z">
                        </path>
                    </svg>
                    Add Renew BG
                </button>
            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <form id="renew-bg-form" class="form_grid_cust" method="POST" action="{{ route(name: 'bgms.bg.renew.store') }}">
                    @csrf
                    <input type="hidden" name="nhidcl_bgm_bank_guarantees_id" value="{{ $bg->id }}">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">

                        <div>
                            <label class="required-label">BG No.</label>
                            <input type="text" value="{{ $bg->bg_no ?? '' }}" readonly>
                        </div>

                        <div>
                            <label class="required-label">Agency Name</label>
                            <input type="text" value="{{ $bg->agency_name ?? '' }}" readonly>
                        </div>

                        <div>
                            <label class="required-label">Renew BG Issue Date</label>
                            <input type="date" name="issue_date" placeholder="Select issue date" class="required"
                                min="{{ date('Y-m-d') }}" value="{{ old('issue_date', date('Y-m-d')) }}">
                            @error('issue_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Renew BG Valid Upto</label>
                            <input type="date" name="valid_upto" placeholder="Select valid upto date" class="required"
                                min="{{ date('Y-m-d') }}" value="{{ old('valid_upto', date('Y-m-d')) }}">
                            @error('valid_upto')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Renew BG Claim Expiry Date</label>
                            <input type="date" name="claim_expiry_date" placeholder="Select claim expiry date"
                                class="required" min="{{ date('Y-m-d') }}"
                                value="{{ old('claim_expiry_date', date('Y-m-d')) }}">
                            @error('claim_expiry_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div>
                                <label class="required-label">Upload Renew BG</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_attachment" class="" placeholder="Upload File"
                                        readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_attachment" name="renew_bg_file"
                                            class="hidden required">
                                    </label>
                                </div>
                                @error('renew_bg_file')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div> --}}

                        <div class="attachment_section_upload_attachment attachment_preview">
                            <label>Upload Renew BG</label>
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

                        <div>
                            <label class="required-label">Is Electronic/Renew</label>
                            <select name="is_renew" class="required">
                                <option value="YES" {{ old('is_renew') == 'YES' ? 'selected' : '' }}>YES</option>
                                <option value="NO" {{ old('is_renew') == 'NO' ? 'selected' : '' }}>NO</option>
                            </select>
                            @error('is_renew')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    @php
                    $bgnew = DB::table('nhidcl_bgm_renew_bg')->where('nhidcl_bgm_bank_guarantees_id', $bg->id)->first();
                    @endphp
                   @if(empty($bgnew))
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">Renew BG</button>
                    </div>
                    @endif
                </form>

            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
@endpush
