@extends('layouts.dashboard')
@section('dashboard_contents')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">View BG Details</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <h1 class="candidat_cust-title">{{ $bg->id }}, {{ $bg->project?->project_name }}</h1>
        <div class="my-4 ">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                    </svg>
                    BG Details
                </button>
            </div>
            <div id="Home" class="bg-gray-100 p-6">
                <div class="bg-white rounded-md shadow-md p-6">
                    <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">General Information</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">
                            <div><strong class="text-gray-600">BG No.:</strong></div>
                            <div class="text-gray-700">{{ $bg->bg_no }}</div>
                            <div><strong class="text-gray-600">Guarantee Type:</strong></div>
                            <div class="text-gray-700">{{ $bg->guaranteeType?->guarantee_type ?? 'N/A' }}</div>
                            <div><strong class="text-gray-600">Agency Name:</strong></div>
                            <div class="text-gray-700">{{ $bg->agency_name }}</div>
                            <div><strong class="text-gray-600">Agency Email:</strong></div>
                            <div class="text-gray-700">{{ $bg->agency_email }}</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">Bank Details</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">
                            <div><strong class="text-gray-600">Name of Master Bank:</strong></div>
                            <div class="text-gray-700">{{ $bg->bank_name }}</div>
                            <div><strong class="text-gray-600">Issuing Bank Name:</strong></div>
                            <div class="text-gray-700">{{ $bg->issuing_bank_name }}</div>
                            <div><strong class="text-gray-600">Issuing Bank Branch:</strong></div>
                            <div class="text-gray-700">{{ $bg->issuing_bank_branch }}</div>
                            <!-- <div><strong class="text-gray-600">Issuing Bank Swift:</strong></div>
                            <div class="text-gray-700">--</div> -->
                            <div><strong class="text-gray-600">Issuing Bank Address:</strong></div>
                            <div class="text-gray-700">{{ $bg->issuing_bank_address }}</div>
                            <div><strong class="text-gray-600">Issuing Bank Email:</strong></div>
                            <div class="text-gray-700">{{ $bg->issuing_bank_email }}</div>
                            <div><strong class="text-gray-600">Issuing Bank Mobile:</strong></div>
                            <div class="text-gray-700">{{ $bg->issuing_bank_mob_no }}</div>
                            <div><strong class="text-gray-600">Operating Bank Name:</strong></div>
                            <div class="text-gray-700">{{ $bg->operable_bank_name }}</div>
                            <div><strong class="text-gray-600">Operating Bank Branch:</strong></div>
                            <div class="text-gray-700">{{ $bg->operable_bank_branch }}</div>
                            <div><strong class="text-gray-600">Operating Bank Address:</strong></div>
                            <div class="text-gray-700">{{ $bg->operable_bank_address }}</div>
                            <div><strong class="text-gray-600">Operating Bank Email:</strong></div>
                            <div class="text-gray-700">{{ $bg->operable_bank_email }}</div>
                            <div><strong class="text-gray-600">Operating Bank Mobile:</strong></div>
                            <div class="text-gray-700">{{ $bg->operable_bank_mob_no }}</div>                          
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">Key Dates & Values</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">
                            <div><strong class="text-gray-600">Issue Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($bg->issue_date) }}</div>
                            <div><strong class="text-gray-600">BG Valid Up-to Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($bg->bg_valid_upto) }}</div>
                            <div><strong class="text-gray-600">Claim Expiry Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($bg->claim_expiry_date) }}</div>
                            <div><strong class="text-gray-600">BG Value (INR):</strong></div>
                            <div class="text-gray-700">{{ $bg->bg_amount }}</div>
                        </div>
                    </div>
                    <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">Status & Custody (Pending)</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">
                            <div><strong class="text-gray-600">Physical Custody:</strong></div>
                            <div class="text-gray-700">{{ $bg->physical_custody }}</div>
                            <div><strong class="text-gray-600">Status:</strong></div>
                            <div class="text-green-600 font-semibold">{{ getBgStatus($bg->status) }}</div>
                            <div><strong class="text-gray-600">Physical Location:</strong></div>
                            <div class="text-gray-700">{{ $bg->physical_location }}</div>
                        </div>
                    </div>
                    @php
                    $hist = DB::table('nhidcl_bgm_receiving')
                    ->where('nhidcl_bgm_bank_guarantees_id', $bg->id)
                    ->orderByDesc('id')
                    ->first();
                    @endphp
                    @if($hist)
                    <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">Inspection & Verification</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">
                            <div><strong class="text-gray-600">Inspected By:</strong></div>
                            <div class="text-gray-700">{{ getUserById($hist->created_by) }}</div>
                            <div><strong class="text-gray-600">Inspected Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($hist->created_at) }}</div>
                            <div><strong class="text-gray-600">Verified By:</strong></div>
                            <div class="text-gray-700">{{ getUserById($hist->verified_by) }}</div>
                            <div><strong class="text-gray-600">Verified Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($hist->created_at) }}</div>
                        </div>
                    </div>
                   @endif
                  <div>
                        <h4 class="text-lg font-semibold mt-4 mb-2 text-gray-700">Confirmation Details</h4>
                        <hr class="my-2 border-gray-300">
                        <div class="mt-2 grid grid-cols-2 gap-y-3">@php
                        @endphp
                            <div><strong class="text-gray-600">Mode of Confirmation:</strong></div>
                            <div class="text-green-600 font-semibold">{{ getModeConfirmationbyId($bg->mode_of_confirmation_master_id) }}</div>
                            <div><strong class="text-gray-600">Physical Location:</strong></div>
                            <div class="text-green-600 font-semibold">{{ $bg->physical_location }}</div>
                             <div><strong class="text-gray-600">Confirmation Uploaded By:</strong></div>
                            <div class="text-green-600 font-semibold">{{ getUserById($bg->confirmation_uploaded_by) }}</div>
                            <div><strong class="text-gray-600">Confirmation Status:</strong></div>
                            <div class="text-gray-700">{{ getBgStatus($bg->status) }}</div>
                            <div><strong class="text-gray-600">Confirmation Uploaded Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($bg->confirmation_uploaded_date)}}</div>
                            <div><strong class="text-gray-600">Confirmation File:</strong></div>
                            <div class="text-blue-600 hover:underline cursor-pointer"><a href="{{ url('/public/uploads/bg/' . $bg->mode_of_confirmation_file) }}" target="_blank" class="text-blue-600 hover:underline cursor-pointer">{{ $bg->mode_of_confirmation_file }}</a></div>
                        </div>
                    </div>
                    <div>                     
                    <div class="mt-2 grid grid-cols-2 gap-y-3">
                          <div><strong class="text-gray-600">Claim Lodge:</strong></div>
                          <div class="{{ $bg->claim_lodged ? 'text-green-600' : 'text-red-600' }} font-semibold">
                           {{ $bg->claim_lodged ? 'Yes' : 'No' }}
                          </div>
                          </div>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 py-6">
                    @if ($bg->renewals)
                        @foreach ($bg->renewals as $renew)
                            <div class="bg-white rounded-md shadow-md p-6">
                                <h3 class="text-xl font-semibold mb-1 text-gray-800">Renew BG {{ $loop->iteration }}</h3>
                                <hr class="m-0 p-0 mb-4" />
                                <div class="mt-2 grid grid-cols-2 gap-y-3">
                                    <div><strong class="text-gray-600">Issue Date:</strong></div>
                                    <div class="text-gray-700">{{ $renew->issue_date }}</div>
                                    <div><strong class="text-gray-600">Claim Expiry Date:</strong></div>
                                    <div class="text-gray-700">{{ $renew->claim_expiry_date }}</div>
                                    <div><strong class="text-gray-600">Electronic Received:</strong></div>
                                    <div class="text-green-600 font-semibold">{{ $renew->is_renew }}</div>
                                    <div><strong class="text-gray-600">BG Renew File:</strong></div>
                                    <div class="text-blue-600 hover:underline cursor-pointer">
                                        @if ($renew->renew_bg_file)
                                             <a href="{{ url('/public/uploads/bg/' . $bg->renew_bg_file) }}" target="_blank" class="text-blue-600 hover:underline cursor-pointer">{{ $bg->renew_bg_file }}</a>
                                        @endif
                                    </div>
                                    <div><strong class="text-gray-600">Physical Location:</strong></div>
                                    <div class="text-gray-700">Finance Department</div>
                                    <div><strong class="text-gray-600">Uploaded By:</strong></div>
                                    <div class="text-gray-700">{{ $renew->createdBy?->name ?? 'N/A' }}</div>
                                    <div><strong class="text-gray-600">Uploaded Date:</strong></div>
                                    <div class="text-gray-700">{{ format_datetime($renew->created_at, 'd-m-Y h:i') }}
                                    </div>
                                    @php
                                        $label = '';
                                        $statusColor = '';
                                        $statusText = renewStatus($renew->status);
                                        $dateLabel = '';

                                        switch ($renew->status) {
                                            case 1:
                                                $label = 'Verified By';
                                                $statusColor = 'text-green-600';
                                                $dateLabel = 'Verified Date';
                                                break;

                                            case 2:
                                                $label = 'Rejected By';
                                                $statusColor = 'text-red-600';
                                                $dateLabel = 'Rejected Date';
                                                break;

                                            default:
                                                $label = 'Verified By';
                                                $statusColor = 'text-yellow-600';
                                                $dateLabel = null;
                                                break;
                                        }
                                    @endphp
                                    <div><strong class="text-gray-600">{{ $label }}:</strong></div>
                                    <div class="text-gray-700">{{ $renew->verifiedBy?->name ?? 'N/A' }}</div>
                                    @if ($dateLabel)
                                        <div><strong class="text-gray-600">{{ $dateLabel }}:</strong></div>
                                        <div class="text-gray-700">
                                            {{ format_datetime($renew->verified_at, 'd-m-Y h:i') }}</div>
                                    @endif
                                    <div><strong class="text-gray-600">Status:</strong></div>
                                    <div class="{{ $statusColor }} font-semibold">{{ $statusText }}</div>
                                    <div><strong class="text-gray-600">Remark:</strong></div>
                                    <div class=" font-semibold">{{ $renew?->remarks }}</div>
                            <div><strong class="text-gray-600">Mode of Confirmation:</strong></div>
                            <div class="text-green-600 font-semibold">{{ getModeConfirmationbyId($bg->mode_of_confirmation_master_id) }}</div>
                            <div><strong class="text-gray-600">Physical Location:</strong></div>
                            <div class="text-green-600 font-semibold">{{ $bg->physical_location }}</div>
                             <div><strong class="text-gray-600">Confirmation Uploaded By:</strong></div>
                            <div class="text-green-600 font-semibold">{{ getUserById($bg->confirmation_uploaded_by) }}</div>
                            <div><strong class="text-gray-600">Confirmation Status:</strong></div>
                            <div class="text-gray-700">{{ getBgStatus($bg->status) }}</div>
                            <div><strong class="text-gray-600">Confirmation Uploaded Date:</strong></div>
                            <div class="text-gray-700">{{ format_datetime($bg->confirmation_uploaded_date)}}</div>
                            <div><strong class="text-gray-600">Confirmation File:</strong></div>
                            <div class="text-blue-600 hover:underline cursor-pointer"><a href="{{ url('/public/uploads/bg/' . $bg->mode_of_confirmation_file) }}" target="_blank" class="text-blue-600 hover:underline cursor-pointer">{{ $bg->mode_of_confirmation_file }}</a></div>
                                </div>
                            </div>
                        @endforeach
                    @endif


                </div>
            </div>

        </div>

    </div>
@endsection
@push('style_start')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>
    <script src="{{ asset('/public/validation/bgms.bg.js') }}"></script>
@endpush
