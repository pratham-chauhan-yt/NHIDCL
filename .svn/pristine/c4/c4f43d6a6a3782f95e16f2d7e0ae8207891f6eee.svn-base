@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Edit Document</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Update office order and other documents</div>
                    </div>
                    <form id="edit-document-form" method="POST"
                        action="{{ route('dms.document.update', Crypt::encrypt($document->id)) }}" class="form_grid_cust"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="inpus_cust_cs form_grid_dashboard_cust_">

                            <div class="">
                                <label class="required-label" for="ref_type_of_document_id">Type of Document</label>
                                <select class="js-select2" required name="ref_type_of_document_id"
                                    id="ref_type_of_document_id">
                                    <option value="">Select Document Type</option>
                                    @foreach ($document_types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ $document->ref_type_of_document_id == $type->id ? 'selected' : '' }}>
                                            {{ $type->document_type }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="ref_type_of_document_id_err" class="candidateErr">
                                    @error('ref_type_of_document_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label" for="title">Title</label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $document->title) }}" placeholder="Enter Title" />
                                <span id="title_err" class="candidateErr">
                                    @error('title')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_file_number">
                                <label id="file_number_label" for="file_number">Code/File Number</label>
                                <input type="text" name="file_number" id="file_number"
                                    value="{{ old('file_number', $document->file_number) }}"
                                    placeholder="Enter Code/File Number" />
                                <span id="file_number_err" class="candidateErr">
                                    @error('file_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_issue_date">
                                <label class="required-label" for="issue_date">Issue Date</label>
                                <input type="date" name="issue_date" id="issue_date"
                                    value="{{ old('issue_date', optional($document->issue_date)->format('Y-m-d')) }}"
                                    placeholder="Select Issue Date" />
                                <span id="issue_date_err" class="candidateErr">
                                    @error('issue_date')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_type">
                                <label class="required-label" for="ref_type_id">Type</label>
                                <select class="js-select2" required name="ref_type_id" id="ref_type_id">
                                    <option value="">Select Type</option>
                                    @foreach ($ref_types as $ref_type)
                                        <option value="{{ $ref_type->id }}"
                                            {{ $document->ref_type_id == $ref_type->id ? 'selected' : '' }}>
                                            {{ $ref_type->type }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="ref_type_id_err" class="candidateErr">
                                    @error('ref_type_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_department">
                                <label class="required-label" for="ref_department_id">Department</label>
                                <select class="js-select2" required name="ref_department_id" id="ref_department_id">
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}"
                                            {{ $document->ref_department_id == $department->id ? 'selected' : '' }}>
                                            {{ $department->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="ref_department_id_err" class="candidateErr">
                                    @error('ref_department_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_year">
                                <label class="required-label" for="year">Year</label>
                                <select class="js-select2" required name="year" id="year">
                                    <option value="">Select Year</option>
                                    @foreach ($document_years as $year)
                                        <option value="{{ $year->id }}"
                                            {{ $document->year == $year->id ? 'selected' : '' }}>
                                            {{ $year->passing_year }}
                                        </option>
                                    @endforeach
                                </select>
                                <span id="year_err" class="candidateErr">
                                    @error('year')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_tag_user">
                                <label for="tag_user">Tag User</label>
                                <select class="js-select2" name="tag_user" id="tag_user">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}"
                                            {{ $document->tag_user == $user->id ? 'selected' : '' }}>
                                            {{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <span id="tag_user_err" class="candidateErr">
                                    @error('tag_user')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <x-form.file-upload label="Document" name="upload_doc"
                                existingUrl="{{url('document-management/viewFiles?pathName=' . $document->document_filepath . '&fileName=' . $document->document)}}"
                                smallLabel="PDF file only, with a max size of 20 MB" smallLabelClass="text-yellow-message"
                                required />

                            {{-- <div class="attachment_section_doc attachment_preview">
                                <label class="required-label" for="upload_doc">Document (<small
                                        class="text-yellow-message">PDF file only, max size 20 MB</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_doc_url" name="upload_doc_url"
                                        class="upload_doc_url" placeholder="Upload Document" readonly
                                        value="{{ url('document-management/viewFiles?pathName=' . $document->document_filepath . '&fileName=' . $document->document) }}">
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_doc_btn"> Upload File
                                        <input id="upload_doc" type="file" name="upload_doc"
                                            class="hidden upload_doc">
                                    </label>
                                </div>
                                @php
                                    $key = 'doc_' . time() . '_' . mt_rand(100000, 999999);
                                @endphp

                                @if ($document->document)
                                    <div class="upload-preview" data-key="{{ $key }}">
                                        <a href="{{ url('document-management/viewFiles?pathName=' . $document->document_filepath . '&fileName=' . $document->document) }}"
                                            target="_blank"
                                            class="font-medium text-sm mx-2 my-2 report_preview_support_photo">
                                            View
                                        </a>
                                        <a href="javascript:void(0);"
                                            class="font-medium text-sm mx-2 my-2 report_remove_doc"
                                            data-key="{{ $key }}" data-filename="{{ $document->document }}">
                                            Remove
                                        </a>
                                    </div>
                                @endif

                                <span id="upload_doc_err" class="candidateErr">
                                    @if ($errors->has('upload_doc'))
                                        {{ $errors->first('upload_doc') }}
                                    @endif
                                </span>
                            </div> --}}
                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('public/css/flowbite.min.css') }}">
@endpush
@push('scripts')
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
    <script src="{{ asset('public/js/utils/validationManager.js') }}"></script>
    <script src="{{ asset('public/js/utils/fileUpload.js') }}"></script>
    <script src="{{ asset('public/js/document-management/edit-document.js') }}"></script>
@endpush
