@extends('layouts.dashboard')
@section('title', 'Training Budget')
@section('dashboard_content')
<section class="home-section ">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Training Budget</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div id="sessions" class="tabcontent">
                <div class="table_over">
                    <table class="table table_sparated table-auto" id="budgetTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Training</th>
                                <th>Trainer</th>
                                <th>Budget</th>
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
<div id="approveModal" class="modal" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header mb-4">
                <h5>Approve Training Session Budget</h5>
                <button type="button" class="close" onclick="closeApproveModal()">×</button>
            </div>
            <div class="modal-body">
                <form id="approve-request-form" method="POST" action="{{ route('hr.training.budget.approve') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label class="required-label">Status</label>
                        <select name="ref_status_id" id="ref_status_id" class="form-control" data-validate="required" data-error="Please choose status.">
                            <option value="">---- Choose status ----</option>
                            @foreach($status as $statusVal)
                            <option value="{{ $statusVal->id }}">{{ $statusVal->type }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="hidden" id="approve_session_id" name="approve_session_id">
                    <input type="hidden" name="redirect_url" value="{{ url()->current() }}">
                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary" id="approve-request-btn">Approve Budget</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        const budgetDataUrl = "{{ route('hr.training.budget') }}";
    </script>
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush
