@extends('layouts.dashboard')
@php
    use App\Models\{RefGuaranteeType, NhidclProject};
@endphp


@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Edit BG</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z">
                        </path>
                    </svg>
                    Add BG
                </button>

                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776">
                        </path>
                    </svg>
                    Added BG
                </button>

            </div>

            <div id="Home" class="tabcontent" style="display: block;">

                <form class="form_grid_cust" id="edit-bg" enctype="multipart/form-data"
                    action="{{ route('bgms.bg.update', encryptId($bg->id)) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="">
                            <label class="required-label">Project</label>
                            <select name="nhidcl_bgm_project_details_id" class="">
                                <option value="">Select a project</option>
                                @foreach (NhidclProject::where('ref_project_state_id', bgmsAssignedState())->get() as $project)
                                    <option value="{{ $project->id }}"
                                        {{ old('nhidcl_bgm_project_details_id', $bg->nhidcl_bgm_project_details_id) == $project->id ? 'selected' : '' }}>
                                        {{ $project->project_name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('nhidcl_bgm_project_details_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Guarantee Type</label>
                            <select name="ref_guarantee_type_id" class="">
                                <option value="">Select guarantee type</option>
                                @foreach (RefGuaranteeType::all() as $gt)
                                    <option value="{{ $gt->id }}"
                                        {{ old('ref_guarantee_type_id', $bg->ref_guarantee_type_id) == $gt->id ? 'selected' : '' }}>
                                        {{ $gt->guarantee_type }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ref_guarantee_type_id')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Agency Name</label>
                            <input type="text" name="agency_name" placeholder="Enter agency name"
                                value="{{ old('agency_name', $bg->agency_name) }}">
                            @error('agency_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Agency Mob No.</label>
                            <input type="text" name="agency_mob_no" placeholder="Enter agency mobile number"
                                value="{{ old('agency_mob_no', $bg->agency_mob_no) }}">
                            @error('agency_mob_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Agency Email ID</label>
                            <input type="email" name="agency_email" placeholder="Enter agency email"
                                value="{{ old('agency_email', $bg->agency_email) }}">
                            @error('agency_email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Agency Address</label>
                            <input type="text" name="agency_address" placeholder="Enter agency address"
                                value="{{ old('agency_address', $bg->agency_address) }}">
                            @error('agency_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">BG No.</label>
                            <input type="text" name="bg_no" placeholder="Enter BG number"
                                value="{{ old('bg_no', $bg->bg_no) }}">
                            @error('bg_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Bank Name</label>
                            <input type="text" name="bank_name" placeholder="Enter bank name"
                                value="{{ old('bank_name', $bg->bank_name) }}">
                            @error('bank_name')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Issuing Bank Branch</label>
                            <input type="text" name="issuing_bank_branch" placeholder="Enter issuing bank branch"
                                value="{{ old('issuing_bank_branch', $bg->issuing_bank_branch) }}">
                            @error('issuing_bank_branch')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Issuing Bank Mob No</label>
                            <input type="text" name="issuing_bank_mob_no"
                                placeholder="Enter issuing bank mobile number"
                                value="{{ old('issuing_bank_mob_no', $bg->issuing_bank_mob_no) }}">
                            @error('issuing_bank_mob_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Issuing Bank Email</label>
                            <input type="email" name="issuing_bank_email" placeholder="Enter issuing bank email"
                                value="{{ old('issuing_bank_email', $bg->issuing_bank_email) }}">
                            @error('issuing_bank_email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Issuing Bank Address</label>
                            <input type="text" name="issuing_bank_address" placeholder="Enter issuing bank address"
                                value="{{ old('issuing_bank_address', $bg->issuing_bank_address) }}">
                            @error('issuing_bank_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Operable Bank Mob No</label>
                            <input type="text" name="operable_bank_mob_no"
                                placeholder="Enter operable bank mobile number"
                                value="{{ old('operable_bank_mob_no', $bg->operable_bank_mob_no) }}">
                            @error('operable_bank_mob_no')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Operable Bank Email</label>
                            <input type="email" name="operable_bank_email" placeholder="Enter operable bank email"
                                value="{{ old('operable_bank_email', $bg->operable_bank_email) }}">
                            @error('operable_bank_email')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Operable Bank Address</label>
                            <input type="text" name="operable_bank_address" placeholder="Enter operable bank address"
                                value="{{ old('operable_bank_address', $bg->operable_bank_address) }}">
                            @error('operable_bank_address')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Operable Bank Branch</label>
                            <input type="text" name="operable_bank_branch" placeholder="Enter operable bank branch"
                                value="{{ old('operable_bank_branch', $bg->operable_bank_branch) }}">
                            @error('operable_bank_branch')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">BG Amount</label>
                            <input type="text" name="bg_amount" placeholder="Enter BG amount"
                                value="{{ old('bg_amount', $bg->bg_amount) }}">
                            @error('bg_amount')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Issue Date</label>
                            <input type="date" name="issue_date" placeholder="Select issue date"
                                value="{{ old('issue_date', $bg->issue_date) }}">
                            @error('issue_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">BG Valid Up-to</label>
                            <input type="date" name="bg_valid_upto" placeholder="Select validity date"
                                value="{{ old('bg_valid_upto', $bg->bg_valid_upto) }}">
                            @error('bg_valid_upto')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="">
                            <label class="required-label">Claim Expiry Date</label>
                            <input type="date" name="claim_expiry_date" placeholder="Select claim expiry date"
                                value="{{ old('claim_expiry_date', $bg->claim_expiry_date) }}">
                            @error('claim_expiry_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="attachment_section_upload_attachment attachment_preview">
                                <label>Upload BG</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                                        placeholder="Upload File" class="uploaded_attachment"
                                        value="{{ old('uploaded_attachment', route('bgms.bg.view', ['fileName' => urlencode($bg->bg_file)])) }}"
                                        readonly>

                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_attachment" name="upload_attachment"
                                            class="hidden upload_attachment">
                                        <input type="hidden" id="bg_file" name="bg_file"
                                            value="{{ old('bg_file', $bg->bg_file) }}">
                                    </label>
                                </div>


                                @if ($bg->bg_file)
                                    <div class="mt-2 oldView">
                                        <a style="color:green"
                                            href="{{ route('bgms.bg.view', ['fileName' => urlencode($bg->bg_file)]) }}"
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
                            </div> --}}


                        <div class="attachment_section_upload_attachment attachment_preview">
                            <label>Upload BG</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="uploaded_attachment" name="uploaded_attachment"
                                    placeholder="Upload File" class="uploaded_attachment"
                                    value="{{ old('uploaded_attachment', $bg->bg_file ? route('bgms.bg.view', ['fileName' => urlencode($bg->bg_file)]) : '') }}"
                                    readonly>

                                <label class="upload_cust mb-0 hover-effect-btn"
                                    style="{{ $bg->bg_file ? 'display:none;' : '' }}">
                                    Upload File
                                    <input type="file" id="upload_attachment" name="upload_attachment"
                                        class="hidden upload_attachment">
                                    <input type="hidden" id="bg_file" name="bg_file"
                                        value="{{ old('bg_file', $bg->bg_file) }}">
                                </label>
                            </div>

                            @if ($bg->bg_file)
                                <div class="file-preview my-3">
                                    <a style="color:green"
                                        href="{{ route('bgms.bg.view', ['fileName' => urlencode($bg->bg_file)]) }}"
                                        target="_blank" class="quick-btn view-btn">
                                        View
                                    </a>
                                    <button type="button" class="quick-btn reupload-btn"
                                        style="margin-left:10px;color:rgb(255, 60, 0);">
                                        Reupload
                                    </button>
                                </div>
                            @endif

                            @error('bg_file')
                                <div class="error-message">{{ $message }}</div>
                            @enderror

                            <input type="hidden" id="uploadUrl" value="{{ route('bgms.bg.upload') }}">
                            <input type="hidden" id="viewUrl" value="{{ route('bgms.bg.view') }}">
                        </div>


                    </div>

                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" type="submit">
                            Submit
                        </button>
                    </div>
                </form>




            </div>

            <div id="News" class="tabcontent" style="display: none;">

                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="bg-table">
                        <thead class="">
                            <tr>
                                <th>#</th>
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

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
@endpush
