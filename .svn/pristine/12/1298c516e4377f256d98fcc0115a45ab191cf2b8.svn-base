@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Upload Document</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Upload office order and other documents</div>
                    </div>
                    <form id="upload-document-form" method="POST" action="{{ route('dms.document.store') }}"
                        class="form_grid_cust" enctype="multipart/form-data">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label" for="ref_type_of_document_id">Type of Document</label>
                                <select class="js-select2" required name="ref_type_of_document_id"
                                    id="ref_type_of_document_id">
                                    <option value="">Select Document Type</option>
                                    @foreach ($document_types as $type)
                                        <option value="{{ $type->id }}">{{ $type->document_type }}</option>
                                    @endforeach
                                </select>
                                <span id="ref_type_of_document_id_err" class="ref_type_of_document_id_err candidateErr">
                                    @error('ref_type_of_document_id')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="">
                                <label class="required-label" for="title">Title</label>
                                <input type="text" name="title" id="title" placeholder="Enter Title" />
                                <span id="title_err" class="title_err candidateErr">
                                    @error('title')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_file_number">
                                <label id="file_number_label" for="file_number">Code/File Number</label>
                                <input type="text" name="file_number" id="file_number"
                                    placeholder="Enter Code/File Number" />
                                <span id="file_number_err" class="file_number_err candidateErr">
                                    @error('file_number')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_issue_date">
                                <label class="required-label" for="issue_date">Issue Date</label>
                                <input type="date" name="issue_date" id="issue_date" placeholder="Select Issue Date" />
                                <span id="issue_date_err" class="issue_date_err candidateErr">
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
                                        <option value="{{ $ref_type->id }}">{{ $ref_type->type }}</option>
                                    @endforeach
                                </select>
                                <span id="ref_type_id_err" class="ref_type_id_err candidateErr">
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
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                    @endforeach
                                </select>
                                <span id="ref_department_id_err" class="ref_department_id_err candidateErr">
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
                                        <option value="{{ $year->id }}">{{ $year->passing_year }}</option>
                                    @endforeach
                                </select>
                                <span id="year_err" class="year_err candidateErr">
                                    @error('year')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <div class="conditional-field" id="field_tag_user">
                                <label class="" for="tag_user">Tag User</label>
                                <select class="js-select2" name="tag_user" id="tag_user">
                                    <option value="">Select User</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                                        </option>
                                    @endforeach
                                </select>
                                <span id="tag_user_err" class="tag_user_err candidateErr">
                                    @error('tag_user')
                                        <div class="error">{{ $message }}</div>
                                    @enderror
                                </span>
                            </div>

                            <x-form.file-upload label="Document" name="upload_doc"
                                smallLabel="PDF file only, with a max size of 20 MB" smallLabelClass="text-yellow-message" required />
                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">Submit</button>
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
    <script src="{{ asset('public/js/document-management/add-document.js') }}"></script>
@endpush
