@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Query Details</div>
                <div class="plain_dlfex bg_elips_ic">
                    <button type="button" onclick="history.back();"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <h1 class="candidat_cust-title">{{ $queryDetails->title }}</h1>
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <p>Query ID: <br /><span class="text-red-500">{{ $queryDetails->query_id }}</span></p>
                        <p>Query Type: <br /><span>{{ $queryDetails->queryType->query_type }}</span></p>
                        <p>Status: <br /><span>{{ $queryDetails->status->status }}</span></p>
                        <p>
                            Supporting Document: <br />
                            @if (isset($queryDetails->supporting_document))
                                @php
                                    $FilePath = 'uploads/query-management/';
                                    $FileName = basename($queryDetails->supporting_document);
                                    $FileUrl = route('qms.view-file', [
                                        'pathName' => $FilePath,
                                        'fileName' => $FileName,
                                    ]);
                                @endphp
                                <a href="{{ $FileUrl }}" target="_blank" data-bs-toggle="tooltip"
                                    title="View query file">
                                    <i class="fa fa-file mx-1" aria-hidden="true"></i>
                                </a>
                            @else
                                <span>no file uloaded</span>
                            @endif
                        </p>
                        <p>Query Raise on: <br /><span>{{ $queryDetails->created_at->format('d M Y') }}</span></p>
                        <p>Query Raised By: <br /><span>{{ $queryDetails->createdBy->name }} <br>
                                ({{ $queryDetails->createdBy->email }})</span></p>
                    </div>

                    <hr class="my-3" />

                    <p class="text-sm"><strong>Note:-</strong> <span
                            class="text-gray-600">{{ $queryDetails->description }}</span></p>

                    <div class="table_over mt-4">
                        <h4 class="candidat_cust-title">List of replies:-</h4>
                        @php
                            use Illuminate\Support\Facades\Crypt;
                            $encryptedId = Crypt::encryptString($queryDetails->id);
                        @endphp


                        <table class="cust_table__ table_sparated" id="queryRepliedTable">
                            <div id="query" data-id="{{ urlencode($encryptedId) }}"></div>
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Message/Reply/Comment</th>
                                    <th scope="col">File</th>
                                    <th scope="col">User (Replied By)</th>
                                    <th>Replied Date</th>
                                </tr>
                            </thead>
                            <tbody class="">
                            </tbody>
                        </table>
                    </div>
                    <hr class="mt-5 mx-12" />
                    <form class="form_grid_cust mt-4" enctype="multipart/form-data"
                        action="{{ route('qms.store-query-reply') }}" method="POST" id="queryReplyForm">
                        @csrf
                        <div class="border border-indigo-100 border-solid rounded-md shadow-xl mt-5 mx-4">
                            <input type="hidden" name="query_details_id" value="{{ $queryDetails->id }}">
                            <textarea name="description" id="description">{{ old('description') }}</textarea>
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ grid check_box_input grid-cols-1 mt-4 p-2">
                                <div class="">
                                    <div class="">
                                        <label class="">Upload File <small>(max file sixe 2MB & File should be
                                                PDF)</small></label>
                                        <div class="flex gap-[10px]">
                                            <input type="text" id="uploaded_reply_file" name="uploaded_reply_file"
                                                placeholder="Upload Image" class="uploaded_reply_file" readonly>
                                            <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                                <input type="file" id="upload_reply_file" name="upload_reply_file"
                                                    class="hidden upload_reply_file">
                                                <input type="hidden" id="reply_file" name="reply_file" value="">
                                            </label>
                                        </div>
                                    </div>
                                    <div class="flex mt-3">
                                        <button type="submit" title="submit-button" class="hover-effect-btn fill_btn">
                                            Submit
                                        </button>
                                        @can('qms-resolve-query')
                                            @if (!isset($queryDetails->remark))
                                                <button type="button" title="mark-as-resolve"
                                                    class="hover-effect-btn border_btn btn-sm ml-3 openMarkAsResolvedModalBtn"
                                                    data-id="{{ $queryDetails->id }}"> Mark as Resolved
                                                </button>
                                            @else
                                                <button type="button" class="hover-effect-btn btn-sm border_btn ml-3 queryResolved"
                                                    data-remark="{{ $queryDetails->remark }}" title="Already Resolved">
                                                    Already Resolved
                                                </button>
                                            @endif
                                        @endcan
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

@push('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-lite.min.js"></script>
@endpush
@push('scripts')
    <script src="{{ asset('public/validation/query-management/raised-query.js') }}"></script>
    <script src="{{ asset('public/validation/query-management/markAsResolved.js') }}"></script>
@endpush
