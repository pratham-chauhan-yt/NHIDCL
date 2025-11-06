@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Advertisement Details</div>
            <div class="plain_dlfex bg_elips_ic">
                <button type="button" onclick="history.back();" class="hover-effect-btn fill_btn">{{ __('Back') }}</button>
            </div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="view-data">
                <div class="candidat_cust-dates">
                    <p><strong>Advertisement Title:</strong> {{ $edit_record->advertisement_title }}</p>
                    <p><strong>As on Date:</strong> {{ \Carbon\Carbon::parse($edit_record->as_on_date)->format('d-m-Y') }}
                    </p>
                </div>
                <div class="candidat_cust-dates">
                    <p><strong>Start Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($edit_record->start_datetime)->format('d-m-Y h:i A') }} </p>
                    <p><strong>Expiry Date & Time:</strong>
                        {{ \Carbon\Carbon::parse($edit_record->expiry_datetime)->format('d-m-Y h:i A') }} </p>
                    <p><strong>Uploaded File:</strong>
                        @if (!empty($edit_record->advertisement_file))
                            <a href="{{ route('recruitment-portal.advertisement.viewFiles', [
                                'pathName' => 'uploads/recruitment/advertisement/',
                                'fileName' => $edit_record->advertisement_file,
                            ]) }}"
                                target="_blank" class="btn btn-sm btn-primary">
                                View File
                            </a>
                        @else
                            <span class="text-muted">No file uploaded</span>
                        @endif
                    </p>
                </div>
                <div class="candidat_cust-dates">
                    <p><strong>Note Instruction:</strong> {{ $note_instruction }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection
