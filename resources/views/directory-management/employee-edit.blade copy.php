@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Edit External Employee</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            @include('components.alert')
            <div id="Home">
                <form action="{{ route('directory-management.external.employees.update', $users->id) }}" method="post" class="form_grid_cust" id="saveExternalEmployeeForm">
                    @csrf
                    @method('PUT')
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Full Name</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name', $users->name) }}" data-validate="required" data-error="Please enter employee full name." placeholder="Your Full Name">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email', $users->email) }}" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" data-validate="required" data-error="Please enter a valid email address">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Mobile Number</label>
                            <input type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile', $users->mobile) }}" placeholder="Mobile Number" data-validate="required" data-error="Please enter employee mobile number.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Date Of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth', $users->date_of_birth) }}" data-validate="required" data-error="Please choose employee date of birth.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Designation</label>
                            <select name="designation" id="designation" class="form-select" data-validate="required" data-error="Please choose employee designation.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($designation as $val)
                                <option value="{{ $val->id }}" {{ old('designation', $users->ref_designation_id) == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Department</label>
                            <select  name="department" id="department" class="form-select" data-validate="required" data-error="Please choose employee department.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($department as $val)
                                <option value="{{ $val->id }}" {{ old('department', $users->ref_department_id) == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Roles</label>
                            <select  name="roles" id="roles" class="form-select" data-validate="required" data-error="Please choose employee roles.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($roles as $val)
                                <option value="{{ $val->id }}" {{ old('roles', $users->roles->first()->id ?? '') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">State</label>
                            <select  name="state" id="state" class="form-select" data-validate="required" data-error="Please choose employee state.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($state as $val)
                                <option value="{{ $val->id }}" {{ old('state', $users->currently_posted) == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        
                        <div class="form-input">
                            <label class="required-label">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address', $users->address) }}" placeholder="Address" data-validate="required" data-error="Please enter employee complete address.">
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" id="saveExternalEmployee" type="submit">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection