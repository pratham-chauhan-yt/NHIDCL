@extends('layouts.dashboard')
@php
    use App\Models\{ModeOfConfirmation};
@endphp
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">BG Verification</div>
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
                    BG Verification
                </button>
            </div>

            <div id="Home" class="tabcontent" style="display: block;">
                <form id="renew-bg-form" class="form_grid_cust" method="POST"
                    action="{{ route('bgms.finance.accept-refer.store') }}">
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
                            <label class="required-label">Verified By</label>
                            <input type="text" name="verified_by" value="{{ $bg->verifiedBy?->name }}" readonly>
                            @error('verified_by')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <label class="required-label">Accept Or Refer Back BG</label>
                            <select name="accept_or_refer" id="accept_or_refer" class="required">
                                <option value="Accept" {{ old('accept_or_refer') == 'Accept' ? 'selected' : '' }}>Accept
                                </option>
                                <option value="Refer" {{ old('accept_or_refer') == 'Refer' ? 'selected' : '' }}>Refer
                                </option>
                            </select>
                            @error('accept_or_refer')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Show ONLY when Refer --}}
                        <div id="remark_section" style="display: none;">
                            <label class="required-label">Remark</label>
                            <input name="refer_back_remark" class="required" type="text"
                                placeholder="Reason for the refer back"
                                value="{{ old('refer_back_remark', $bg->refer_back_remark) }}">
                            @error('refer_back_remark')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Show ONLY when Accept --}}

                        <div class="accept_fields" style="display: none;">
                            <label class="required-label">Mode Of Confirmation</label>
                            <select name="mode_of_confirmation_master_id" class="required">
                                <option value="">Select Mode</option>
                                @foreach (ModeOfConfirmation::all() as $mode)
                                    <option value="{{ $mode->id }}"
                                        {{ old('mode_of_confirmation_master_id', $bg->mode_of_confirmation_master_id) == $mode->id ? 'selected' : '' }}>
                                        {{ $mode->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('mode_of_confirmation_master_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="accept_fields" style="display: none;">
                            <label class="required-label">Physical Location</label>
                            <input name="physical_location" class="required" type="text"
                                value="{{ old('physical_location', $bg->physical_location) }}"
                                placeholder="Physical Location">
                            @error('physical_location')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div style="display: none;"
                            class="attachment_section_upload_attachment attachment_preview accept_fields">
                            <label>Upload Renew BG</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                                    placeholder="Upload File" class="uploaded_attachment" readonly>
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
                        </div> --}}

                        <div class="attachment_section_upload_attachment attachment_preview">
                            <label>Upload Attachment</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                                    placeholder="Upload File" class="uploaded_attachment"
                                    value="{{ old('uploaded_attachment') }}" readonly>

                                <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                    <input type="file" id="upload_attachment" name="upload_attachment"
                                        class="hidden upload_attachment">
                                    <input type="hidden" id="bg_file" name="bg_file"
                                        value="{{ old('bg_file', $bg->mode_of_confirmation_file) }}">
                                </label>
                            </div>


                            @if ($bg->mode_of_confirmation_file)
                                <div class="mt-2 oldView">
                                    <a style="color:green"
                                        href="{{ route('bgms.bg.view', ['fileName' => urlencode($bg->mode_of_confirmation_file)]) }}"
                                        target="_blank" class="text-blue-500 underline">
                                        View
                                    </a>
                                </div>
                            @endif

                            @error('bg_file')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <input type="hidden" id="uploadUrl" value="{{ route('bgms.bg.upload') }}">
                            <input type="hidden" id="viewUrl" value="{{ route('bgms.bg.view') }}">
                        </div>
                    </div>


            </div>

            <div class="button_flex_cust_form">
                <button class="hover-effect-btn fill_btn" type="submit">Submit</button>
            </div>
            </form>

        </div>

    </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.finance.js') }}"></script>
    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
@endpush
