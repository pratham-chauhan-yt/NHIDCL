@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Sharing of Documents</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Share', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>
                        Edit Shared Document
                    </button>
                </div>

                <div id="Share" class="tabcontent">
                    <form id="share-document-form" method="POST"
                        action="{{ route('dms.sharing.update', Crypt::encrypt($document->id)) }}" class="form_grid_cust"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label" for="title">Title</label>
                                <input type="text" name="title" id="title"
                                    value="{{ old('title', $document->title) }}" placeholder="Enter Title" />
                                <span id="title_err" class="title_err candidateErr">
                                    @error('title')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="attachment_section_doc attachment_preview">
                                <label class="required-label" for="upload_doc">Document (<small
                                        class="text-yellow-message">PDF file only, max size 40 MB</small>)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="upload_doc_url" name="upload_doc_url"
                                        class="upload_doc_url" placeholder="Upload Document" readonly
                                        value="{{ url('document-management/viewSharedFiles?pathName=' . $document->document_filepath . '&fileName=' . $document->document) }}">
                                    <label class="upload_cust mb-0 hover-effect-btn hide_upload_doc_btn"> Upload File
                                        <input id="upload_doc" type="file" name="upload_doc" class="hidden upload_doc">
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
                            </div>

                            <div class="">
                                <label class="" for="remark">Remark</label>
                                <input type="text" name="remark" id="remark"
                                    value="{{ old('remark', $document->remark) }}" placeholder="Enter remark" />
                                <span id="remark_err" class="remark_err candidateErr">
                                    @error('remark')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label" for="share_type">Share Document</label>
                                <select class="js-select2" required name="share_type" id="share_type">
                                    <option value="">Select</option>
                                    <option value="Within Department"
                                        {{ $document->share_type == 'Within Department' ? 'selected' : '' }}>Within
                                        Department</option>
                                    <option value="Other Department"
                                        {{ $document->share_type == 'Other Department' ? 'selected' : '' }}>Other
                                        Department</option>
                                </select>
                                <span id="share_type_err" class="share_type_err candidateErr">
                                    @error('share_type')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label" for="ref_users_id">User</label>
                                <select class="js-select2" name="ref_users_id" id="ref_users_id" data-selected-user="{{ $document->ref_users_id ?? '' }}">
                                    <option value="">Select User</option>
                                </select>
                                <span id="ref_users_id_err" class="ref_users_id_err candidateErr">
                                    @error('ref_users_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>
                        </div>
                        <br />
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Update
                            </button>
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
    <script src="{{ asset('public/js/document-management/sharing-document/edit-shared-document.js') }}"></script>
@endpush
