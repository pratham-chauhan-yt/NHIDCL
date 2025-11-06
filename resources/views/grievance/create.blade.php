@extends('layouts.dashboard')
@php
    use App\Models\{DepartmentMaster, DesignationMaster};
@endphp


@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Grievance Application</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="Home" class="tabcontent">
                    <form class="form_grid_cust" id="add-grievance" action="{{ route('grievance.store') }}" method="POST">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Name</label>
                                <input type="text" name="name" class="" placeholder="Your  Name">
                                @error('name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="required-label">Employee No.</label>
                                <input type="text" name="employee_no" class="" placeholder="Employee No">
                                @error('employee_no')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="required-label">Designation</label>
                                <select name="ref_designation_id" id="ref_designation_id">
                                    <option value=""> Select </option>
                                    @foreach (DesignationMaster::all() as $source)
                                        <option value="{{ $source->id }}"
                                            {{ old('ref_designation_id') == $source->id ? 'selected' : '' }}>
                                            {{ $source->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ref_designation_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="">
                                <label class="required-label">Grievance &amp; Reason in brief </label>
                                <input type="text" name="grievance_reason" class=""
                                    placeholder="Grievance &amp; Reason in brief">

                                @error('grievance_reason')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror

                            </div>

                            <div class="">
                                <label class="required-label">Pay Scale </label>
                                <input type="text" name="pay_scale" class="" placeholder="Pay Scale">

                                @error('pay_scale')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror

                            </div>


                            <div class="">
                                <label class="required-label">Department</label>

                                <select name="ref_department_id" id="ref_department_id">
                                    <option value=""> Select </option>
                                    @foreach (DepartmentMaster::all() as $source)
                                        <option value="{{ $source->id }}"
                                            {{ old('ref_department_id') == $source->id ? 'selected' : '' }}>
                                            {{ $source->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ref_department_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                                {{-- <input type="text" name="department" class="" placeholder="Department"> --}}
                            </div>
                            <div class="">
                                <label class="required-label">Permanent address</label>
                                <input type="text" class="" name="permanent_address"
                                    placeholder="Permanent Address">
                                @error('permanent_address')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Dated </label>
                                <input type="date" name="date" class="">

                                @error('date')
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

            </div>

        </div>

    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/grievance.js') }}"></script>
@endpush
