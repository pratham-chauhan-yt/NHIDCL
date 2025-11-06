@extends('layouts.dashboard')
@push('styles')
@endpush
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Para Details</div>
                <div class="plain_dlfex bg_elips_ic">
                    <button type="button" onclick="history.back();"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <h1 class="candidat_cust-title">Introduction</h1>
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <p>Letter No: <br /><span>{{ $auditQueryPara->auditQuery->letter_no ?? 'N/A' }}</span></p>
                        <p>Part: <br /><span>{{ $auditQueryPara->part->part ?? 'N/A' }}</span></p>
                        <p>Query Type: <br /><span>{{ $auditQueryPara->queryType->query_type ?? 'N/A' }}</span></p>
                        <p>
                            File: <br />
                            <span>
                                @if (isset($auditQueryPara->word_file_path))
                                    @php
                                        $wordFilePath = 'uploads/audit-management/para/';
                                        $wordFileName = basename($auditQueryPara->word_file_path);
                                        $wordFileUrl = route('audit-management.view.files', [
                                            'pathName' => $wordFilePath,
                                            'fileName' => $wordFileName,
                                        ]);
                                    @endphp
                                    <a href="{{ $wordFileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                        title="View word file">
                                        <i class="fa fa-file-word mx-1" aria-hidden="true"></i>
                                    </a>
                                @endif
                                @if (isset($auditQueryPara->pdf_file_path))
                                    @php
                                        $pdfFilePath = 'uploads/audit-management/para/';
                                        $pdfFileName = basename($auditQueryPara->pdf_file_path);
                                        $pdfFileUrl = route('audit-management.view.files', [
                                            'pathName' => $pdfFilePath,
                                            'fileName' => $pdfFileName,
                                        ]);
                                    @endphp
                                    <a href="{{ $pdfFileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                        title="View pdf file">
                                        <i class="fa fa-file-pdf mx-1" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </span>
                        </p>
                        @if (auth()->user()->hasRole('Nodal Officer') && isset($auditQueryPara->assignTo))
                            <p> Assign to : <br /><span> {{ $auditQueryPara->assignTo->name }}</span></p>
                        @endif

                        @if (auth()->user()->hasRole('Resource Pool User') && isset($auditQueryPara->createdBy))
                            <p> Created By : <br /><span> {{ $auditQueryPara->createdBy->name }}</span></p>
                        @endif
                        @php
                            $statusText = $auditQueryPara->ref_status_text ?? 'N/A';
                            $badgeClass = 'badge-danger';
                            switch ($statusText) {
                                case 'Reply Pending':
                                    $badgeClass = 'badge-warning';
                                    break;
                                case 'Replied':
                                    $badgeClass = 'badge-success';
                                    break;
                                case 'Dropped':
                                    $badgeClass = 'badge-secondary';
                                    break;
                                default:
                                    $badgeClass = 'badge-danger';
                                    break;
                            }
                        @endphp
                        <p>Status: <br />
                            <span class="badge p-2 {{ $badgeClass }}">{{ $statusText }}</span>
                        </p>

                        @if (isset($auditQueryPara->status_dropped_date))
                            <p>Dropped Date: <br /><span>{{ $auditQueryPara->status_dropped_date }}</span></p>
                        @endif
                    </div>

                    <hr class="mt-3" />

                    <h1 class="candidat_cust-title mt-3">
                        Loss to the exchequer to around:Rs. 795.55 crore on account of
                        price adjustment, payment made in respect of 118 projects having
                        construction period less than,18 months since 2017-18, in
                        violation to the GFR guidelines issued by Department of
                        Expenditure.
                    </h1>

                    <div class="table_over mt-4">
                        <h4 class="candidat_cust-title">List of replies:-</h4>
                        <input type="hidden" name="audit_para_table_id" value="{{ Crypt::encrypt($auditQueryPara->id) }}">
                        <table class="cust_table__ table_sparated" id="para_details_table">
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Ref</th>
                                    <th scope="col">Remark/Comment</th>
                                    <th scope="col">File</th>
                                    <th scope="col">User (Reply by)</th>
                                    <th>Response Date</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            </tbody>
                        </table>
                    </div>
                    <hr class="mt-5 mx-12" />

                    <form class="form_grid_cust" enctype="multipart/form-data"
                        action="{{ route('audit-management.store-audit-para-reply') }}" method="post" id="auditParaReply">
                        @csrf
                        <div class="border border-indigo-100 border-solid rounded-md shadow-xl mt-5 mx-4">
                            <textarea name="remark" id="remark" placeholder="Write remark...">{{ old('remark') }}</textarea>
                            {{-- </div> --}}
                            <input type="hidden" name="audit_para_id" value="{{ $auditQueryPara->id }}">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ grid check_box_input grid-cols-1 mt-4 p-2">
                                <div class="">
                                    <label class="">Upload PDF File (<span style="font-size: 10px;">Max 1MB & file
                                            should be PDF</span>)</label>
                                    <div class="reply-upload-wrapper attachment_section_upload_pdf">
                                        <div class="flex gap-[15px] ">
                                            <input type="text" id="uploaded_para_reply" name="uploaded_para_reply"
                                                placeholder="Upload PDF" class="uploaded_para_reply" readonly>

                                            <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                                <input type="file" id="upload_para_reply" name="upload_para_reply"
                                                    class="hidden upload_para_reply">
                                                <input type="hidden" id="para_reply_file" class="para_reply_file"
                                                    name="para_reply_file" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" title="submit-button" class="hover-effect-btn border_btn mt-3">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                    @if (auth()->user()->hasRole('Nodal Officer'))
                        <div class="d-flex justify-content-end align-items-center gap-2  mt-4">
                            <button type="button" class="hover-effect-btn border_btn" data-id="{{ $auditQueryPara->id }}"
                                data-status="5" id="dropParaBtn">Drop Para</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection
@push('style_end')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
    @endpush
    @push('scripts')
    <script src="{{ asset('public/validation/auditParaReply.js') }}"></script>
@endpush
