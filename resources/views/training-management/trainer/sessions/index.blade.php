@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Session List</div>
                <div class="plain_dlfex bg_elips_ic">
                    <a href="{{ route('sessions.create') }}"><button class="hover-effect-btn gray_btn" type="button">Create Sessions</button></a>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="sessions" class="tabcontent">
                    <div class="table_over">
                        <table class="table_sparated" id="sessionsTable">
                            <thead class="">
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Agenda</th>
                                    <th>Date</th>
                                    <th>Duration</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Guide Modal -->
    <div id="guideModal" class="modal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-4">
                    <h5>Upload Training Materials</h5>
                    <button type="button" class="close" onclick="closeModal()">×</button>
                </div>
                <div class="modal-body">
                    <form id="upload-guide-form" method="POST" action="{{ route('sessions.material.upload') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="attachment_advertisement attachment_section_photos mb-4">
                            <label class="required-label">Choose Guide File (<small>Max size 2MB & file should be pdf only</small>)</label>
                            <div class="flex gap-[10px]">
                                <input type="text" id="upload_file_txt" name="upload_file_txt" class="form-control upload_file_txt" placeholder="Upload training Materials files" data-validate="required" data-error="Please upload training materials files." readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer">
                                    Upload File
                                    <input type="file"
                                        name="upload_file"
                                        class="hidden file-uploader"
                                        accept=".pdf"
                                        data-type="pdf"
                                        data-max-size="2000000"
                                        data-input-id="upload_file_txt"
                                        data-preview-wrapper="file_preview"
                                        data-hidden-input="upload_file_hidden"
                                        data-upload-url="/users/upload/files/"
                                        data-view-url="/users/view/files/"
                                        data-file-path="/uploads/employee/training/">
                                </label>
                                <input type="hidden" name="upload_file_hidden" id="upload_file_hidden">
                            </div>
                            <div id="file_preview"></div>
                        </div>
                        <input type="hidden" id="session_id" name="session_id">
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary" id="upload-guide-btn">Upload Guide</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div id="budgetModal" class="modal" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header mb-4">
                    <h5>Create Training Session Budget</h5>
                    <button type="button" class="close" onclick="closeBudgetModal()">×</button>
                </div>
                <div class="modal-body">
                    <form id="upload-budget-form" method="POST" action="{{ route('trainer.budget.submit') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="required-label">Amount</label>
                            <input type="text" name="amount" id="amount" class="form-control" oninput="this.value = this.value.replace(/[^0-9]/g, '')" data-validate="required" data-error="Please enter training budget amount.">
                        </div>
                        <div class="form-group">
                            <label class="required-label">Status</label>
                            <select name="ref_status_id" id="ref_status_id" class="form-control" data-validate="required" data-error="Please choose training budget status.">
                                <option value="">---- Please choose status ----</option>
                                @foreach($status as $statusData)
                                <option value="{{ $statusData->id }}">{{ $statusData->type }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="required-label">Remarks</label>
                            <input type="text" name="remarks" id="remarks" class="form-control" data-validate="required" data-error="Please leave your remarks.">
                        </div>
                        <input type="hidden" id="budget_session_id" name="budget_session_id">
                        <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                        <div class="form-group mt-4">
                            <button type="submit" class="btn btn-primary" id="upload-budget-btn">Upload Budget</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        const sessionsDataUrl = "{{ route('sessions.index') }}";
    </script>
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush