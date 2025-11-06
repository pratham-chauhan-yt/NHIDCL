@extends('layouts.dashboard')
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Edit Query</div>
                <!-- <div class="plain_dlfex bg_elips_ic">
                                        <select>
                                            <option value="Today">19-12-2024</option>
                                        </select>
                                    </div> -->
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg>

                        Edit Audit Query
                    </button>
                    <!-- <button class="tablink" onclick="openPage('News', this, '#373737')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                                Create Para
                            </button> -->
                    <!-- <button class="tablink" onclick="openPage('archive', this, '#373737')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                    stroke="currentColor" class="size-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                                </svg>
                                Archive
                            </button> -->

                </div>
                <div id="Home" class="tabcontent">
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Edit Audit Query</div>
                    </div>
                    <!-- <h6 class="text-[14px] font-medium">Mode of Engagement</h6> -->
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form class="form_grid_cust" action="{{ route('audit-management.store') }}" method="post"
                        enctype="multipart/form-data" id="createAuditQuery">
                        @csrf
                        <input type="hidden" name="audit_id" value="{{ $auditQuery->id }}">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="">Subject</label>
                                <textarea rows="1" class="" name="subject" placeholder="Subject of audit query">{{ $auditQuery->subject }}</textarea>
                                @error('subject')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">Letter No.</label>
                                <input type="text" class="" name="letter_no" placeholder="Letter No."
                                    value="{{ $auditQuery->letter_no }}">
                                @error('letter_no')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">Letter Date</label>
                                <input type="date" class="" name="letter_date" placeholder="Letter Date"
                                    value="{{ $auditQuery->letter_date }}">
                                @error('letter_date')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">From/To Date (Period covered in audit)</label>
                                <div class="grid grid-cols-2 gap-[10px]">
                                    <input type="date" class="" name="from_date"
                                        value="{{ $auditQuery->from_date }}">
                                    @error('from_date')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                    <input type="date" class="" name="to_date" value="{{ $auditQuery->to_date }}">
                                    @error('to_date')
                                        <div class="error-message">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="">
                                <label class="">Location</label>
                                <select class="form-select" name="location">
                                    <option value="">Select Location</option>
                                    @foreach ($refProjectState as $projectState)
                                        <option value="{{ $projectState->id }}"
                                            {{ $auditQuery->ref_project_state_id == $projectState->id ? 'selected' : '' }}>
                                            {{ $projectState->state_name }}</option>
                                    @endforeach
                                </select>
                                @error('location')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">Audit Year</label>
                                <input type="text" class="" name="audit_year" placeholder="YYYY-YYYY"
                                    value="{{ $auditQuery->audit_year }}">
                                @error('audit_year')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">Audit Level</label>
                                <select class="form-select" name="audit_level">
                                    <option value="">Select audit level</option>
                                    @foreach ($refAuditLevel as $level)
                                        <option value="{{ $level->id }}"
                                            {{ $level->id == $auditQuery->ref_audit_level_id ? 'selected' : '' }}>
                                            {{ $level->audit_level }}</option>
                                    @endforeach
                                </select>
                                @error('audit_level')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="">Audit Type</label>
                                <select class="form-select" name="audit_type">
                                    <option value="">Select audit level</option>
                                    @foreach ($refAuditType as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $type->id == $auditQuery->ref_audit_type_id ? 'selected' : '' }}>
                                            {{ $type->audit_type }}</option>
                                    @endforeach
                                </select>
                                @error('audit_type')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="attachment_section_upload_pdf">
                                <label>Upload PDF File (<span style="font-size: 10px;">Max 1MB & file should be
                                        PDF</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_pdf" name="uploaded_pdf"
                                        placeholder="Upload Image" class="uploaded_pdf" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_pdf" name="upload_pdf"
                                            class="hidden upload_pdf">
                                        <input type="hidden" id="pdf_file" name="pdf_file"
                                            value="{{ $auditQuery->pdf_file ?? '' }}">
                                    </label>
                                </div>
                                @if (isset($auditQuery->pdf_file))
                                    @php
                                        $pdfFilePath = 'uploads/audit-management/';
                                        $pdfFileName = basename($auditQuery->pdf_file);
                                        $pdfFileUrl = route('audit-management.view.files', [
                                            'pathName' => $pdfFilePath,
                                            'fileName' => $pdfFileName,
                                        ]);
                                    @endphp
                                    <a href="{{ $pdfFileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                        title="View pdf file">
                                        View File
                                    </a>
                                @endif
                                @error('upload_pdf')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="attachment_section_upload_word">
                                <label>Upload Word File (<span style="font-size: 10px;">Max 2MB & file should be DOC or
                                        DOCX</span>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_word" name="uploaded_word"
                                        placeholder="Upload Word File" class="uploaded_word" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_word" name="upload_word"
                                            class="hidden upload_word">
                                        <input type="hidden" id="word_file" name="word_file"
                                            value="{{ $auditQuery->word_file ?? '' }}">
                                    </label>
                                </div>
                                @if (isset($auditQuery->word_file))
                                    @php
                                        $pdfFilePath = 'uploads/audit-management/';
                                        $pdfFileName = basename($auditQuery->word_file);
                                        $pdfFileUrl = route('audit-management.view.files', [
                                            'pathName' => $pdfFilePath,
                                            'fileName' => $pdfFileName,
                                        ]);
                                    @endphp
                                    <a href="{{ $pdfFileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                        title="View pdf file">
                                        View File
                                    </a>
                                @endif
                                @error('upload_word')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>


                            <!-- <div class="">
                                                    <label  class="">Comment</label>
                                                    <textarea rows="1" class="" placeholder="Add Note/Instruction"></textarea>

                                                </div> -->
                        </div>
                        <div class="button_flex_cust_form">
                            <!-- <button class="hover-effect-btn border_btn">Add More Note/Instruction</button> -->
                            <button class="hover-effect-btn fill_btn" type="submit"> Update </button>
                            <!-- Modal toggle -->
                            <!-- <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                                        class="hover-effect-btn fill_btn" type="submit">
                                        Create
                                    </button> -->

                            <!-- Main modal -->
                            <!-- <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative p-4 w-full max-w-xl max-h-full">
                                            <div class="relative bg-white rounded-[20px] py-[20px]">
                                                <div class="flex items-center justify-between pr-[10px]">
                                                    <button type="button"
                                                        class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                        data-modal-hide="static-modal">
                                                        <svg class="w-3 h-3" aria-hidden="true"
                                                            xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 14 14">
                                                            <path stroke="currentColor" stroke-linecap="round"
                                                                stroke-linejoin="round" stroke-width="2"
                                                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                        </svg>
                                                        <span class="sr-only">Close modal</span>
                                                    </button>
                                                </div>
                                                <div class="modal_body_cust">
                                                    <img src="../../assets/images/check-1.png" alt="popupimage">
                                                    <p>Audit Query Id</p>
                                                    <h4>1254785554</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div> -->
                        </div>
                    </form>
                </div>

                <div id="News" class="tabcontent">
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Create New Para</div>
                    </div>
                    <!-- <h6 class="text-[14px] font-medium">Mode of Engagement</h6> -->

                    <form class="form_grid_cust">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="">Year</label>
                                <select class="">
                                    <option>Select Year</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Letter No.</label>
                                <select class="">
                                    <option>Select Letter No.</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Title</label>
                                <input type="text" class=""
                                    placeholder="e.g. Introduction, Audit Findings, Significant Audit Findings, etc.">
                            </div>
                            <div class="">
                                <label class="">Brief Report/Para</label>
                                <textarea rows="1" class="" placeholder="Brief"></textarea>
                            </div>
                            <div class="">
                                <label class="">Query Type</label>
                                <select class="">
                                    <option>Select Query Type</option>
                                    <option>Audit Observation</option>
                                    <option>Audit Requisition</option>
                                    <option>Half Margin</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Part</label>
                                <select class="">
                                    <option>Select Part</option>
                                    <option>I</option>
                                    <option>II</option>
                                    <option>II-A</option>
                                    <option>II-B</option>
                                    <option>III</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Upload PDF File</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" class="" placeholder="Upload documents" disabled>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" class="hidden">

                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <label class="">Upload Word File</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" class="" placeholder="Upload word file" disabled>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" class="hidden">

                                    </label>
                                </div>
                            </div>
                            <div class="">
                                <label class="">Office</label>
                                <select class="">
                                    <option>Select Office</option>
                                    <option>HQ</option>
                                    <option>RO</option>
                                    <option>PMU</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Department</label>
                                <select class="">
                                    <option>Select Department</option>
                                    <option>Admin</option>
                                    <option>HR</option>
                                    <option>Finance</option>
                                    <option>Technical</option>
                                </select>
                            </div>
                            <div class="">
                                <label class="">Assign to</label>
                                <select class="">
                                    <option>Select Candidate</option>
                                    <option>XYZ (xyz@nhidcl.com)</option>
                                    <option>XYZ (xyz@nhidcl.com)</option>
                                    <option>XYZ (xyz@nhidcl.com)</option>
                                    <option>XYZ (xyz@nhidcl.com)</option>
                                    <option>XYZ (xyz@nhidcl.com)</option>
                                </select>
                            </div>

                        </div>
                        <div class="button_flex_cust_form">
                            <!-- <button class="hover-effect-btn border_btn">Add more candidate</button> -->

                            <!-- Modal toggle -->
                            <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                                class="hover-effect-btn fill_btn" type="button">
                                Create
                            </button>

                            <!-- Main modal -->
                            <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-[20px] py-[20px]">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between pr-[10px]">
                                            <button type="button"
                                                class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="static-modal">
                                                <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal_body_cust">
                                            <img src="../../assets/images/check-1.png" alt="popupimage">
                                            <p>Para Id</p>
                                            <h4>1254785554</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/auditQuery.js') }}"></script>
@endpush
