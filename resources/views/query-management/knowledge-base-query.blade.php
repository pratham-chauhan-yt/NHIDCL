@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Access Knowledge Base</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <small class="">Access Knowledge Base for self-service solutions and FAQs to find immediate
                answers.</small>
            <div class="my-4 ">
                <div class="tab_custom_c mb-[20px]">
                    <button class="tablink" onclick="openPage('appendKnowledgebase', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>
                        Append Knowledge Base
                    </button>
                    <button class="tablink" onclick="openPage('Knowledgebase', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                        </svg>
                        Knowledge Base
                    </button>
                </div>

                <div id="appendKnowledgebase" class="tabcontent">
                    <form class="form_grid_cust" action="{{ route('qms.store-knowledge-base-query') }}" method="POST"
                        enctype="multipart/form-data" id="knowledgeBaseQueryForm">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Title/Subject</label>
                                <input type="text" class="" name="title" value="{{ old('title') }}" placeholder="Enter your query title here...">
                                @error('title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="required-label">Meta Title</label>
                                <input type="text" class="" name="meta_title" value="{{ old('meta_title') }}" placeholder="Enter your meta title title here...">
                                @error('meta_title')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="">Supporting Document (If Any)</label>
                                <div class="flex gap-[10px]">
                                    <input type="text" id="uploaded_knowledgebase_file" name="uploaded_knowledgebase_file"
                                        placeholder="Upload Image" class="uploaded_knowledgebase_file" readonly>
                                    <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="upload_knowledgebase_file" name="upload_knowledgebase_file"
                                            class="hidden upload_knowledgebase_file">
                                        <input type="hidden" id="knowledgebase_file" name="knowledgebase_file" value="">
                                    </label>
                                </div>
                            </div>

                            <div class="">
                                <label class="required-label">Description</label>
                                <textarea class="" rows="2" name="description" placeholder="Enter your query description here...">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="required-label">Meta Description</label>
                                <textarea class="" rows="2" name="meta_description" placeholder="Enter your query description here...">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>

                <div id="Knowledgebase" class="tabcontent">
                    <div class="table_over">
                        <table class="cust_table__ table_sparated" id="knowledgebaseTable">
                            <thead class="">
                                <tr>
                                    <th scope="col">
                                        #
                                    </th>
                                    <th scope="col">
                                        Query ID
                                    </th>
                                    <th scope="col">
                                        Title/Subject
                                    </th>
                                     <th scope="col">
                                        Meta Title
                                    </th>
                                    <th scope="col">
                                        Added Date
                                    </th>
                                    <th scope="col">
                                        Added By
                                    </th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
@endpush
@push('scripts')
    <script src="{{ asset('public/validation/query-management/knowledgebase-query.js') }}"></script>
@endpush
