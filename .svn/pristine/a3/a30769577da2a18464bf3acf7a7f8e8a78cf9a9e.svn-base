@extends('layouts.dashboard')
@section('dashboard_content')
<div class="inner_page_dash__">
    <div class="my-4 ">


        <div id="Home" class="tabcontent" data-users-postid="{{ auth()->user()->id }}">
            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                <div class="">Appraisal Cycle Create</div>

                @if (session('success'))
                <div style="background-color:#d1e7dd; color:#0f5132; padding:10px; border-radius:5px; margin-bottom:10px;">
                    {{ session('success') }}
                </div>
                @endif
            </div>
            <form id="resourceRequisitionFrms" action="{{route('employee-management.appraisal.storeappraisal')}}" method="POST"
                class="form_grid_cust" enctype="multipart/form-data">
                @csrf
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    <div class="">
                        <label class="required-label">Cycle Name</label>
                        <input id="cycle_name" name="cycle_name" type="text" maxlength="100" placeholder="Enter Cycle Name">
                        <span id="cycle_name" class="cycle_name_err candidateErr"></span>
                    </div>

                    <div class="">
                        <label class="">Start Date</label>
                        <input type="date" class="" name="start_date" id="start_date" value="">
                        <span id="start_date" class="start_date_err candidateErr"></span>
                    </div>

                    <div class="">
                        <label class="">End Date</label>
                        <input type="date" class="" name="end_date" id="end_date" value="" required>
                        <span id="end_date" class="end_date_err candidateErr"></span>
                    </div>

                    <div class="form-group">
                        <label for="status" class="required-label">Status</label>

                        <select name="status" id="status" class="form-control" required>
                            @foreach ($statuses as $status)

                            <option value="{{ $status->id }}" {{ old('status') == $status->id ? 'selected' : '' }}>
                                {{ $status->type }}
                            </option>
                            @endforeach
                        </select>
                        {{-- <select name="status" id="status" class="form-control" required>
                            <option value="">-- Select Status --</option>
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select> --}}
                        <span id="status_err" class="status_err candidateErr"></span>
                    </div>





                </div>


        </div>
        <div class="button_flex_cust_form">

            <!-- Modal toggle -->
            <!-- Modal toggle -->
            <button id="appraisalcreateBtn" data-modal-target="static-modal1"
                data-modal-toggle="static-modal" class="hover-effect-btn fill_btn" type="button">
                Submit
            </button>


        </div>
        </form>
    </div>



</div>

</div>



@endsection
@push('scripts')
<script src="{{ asset('public/js/select2.min.js') }}"></script>
<script src="{{ asset('public/js/resource-pool/hr/advertisement.js') }}"></script>
@endpush