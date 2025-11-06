@extends('layouts.dashboard')
@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">User Config - Create User</div>
    </div>
</div>
<div class="inner_page_dash__">
    <div class="my-4 ">
        <div class="tab_custom_c mb-[20px]">
            <button class="tablink" onclick="openPage('user_details', this, '#373737')" id="defaultOpen">
                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                    class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                </svg>
                Create User
            </button>
        </div>
        @include('components.alert')
        <div id="user_details" class="tabcontent">
            <form id="createUserFrm" method="POST" action="{{route('user-config.store')}}" class="form_grid_cust" enctype="multipart/form-data">
                @csrf
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    <div class="form-input">
                        <label class="required-label">Full Name</label>
                        <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" placeholder="Enter full name" required>
                        <span id="full_name_err" class="candidateErr">
                            @if($errors->has('full_name'))
                                {{ $errors->first('full_name') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">Email</label>
                        <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter email address" required>
                        <span id="email_err" class="candidateErr">
                            @if($errors->has('email'))
                                {{ $errors->first('email') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">Mobile No</label>
                        <input type="text" name="mobile_no" id="mobile_no" value="{{ old('mobile_no') }}" minlength="10" maxlength="10" placeholder="Enter mobile number" required>
                        <span id="mobile_no_err" class="candidateErr">
                            @if($errors->has('mobile_no'))
                                {{ $errors->first('mobile_no') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="form-label aster">{{ __('Is NHIDCL Employee') }}</label>
                        <select name="is_nhidcl_employee" class="form-select" id="is_nhidcl_employee" required>
                            <option value="">{{ __('Choose...') }}</option>
                            <option value="1" {{ old('is_nhidcl_employee') == '1' ? 'selected' : '' }}>Yes</option>
                            <option value="0" {{ old('is_nhidcl_employee') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Status') }}</label>
                        <select name="status" class="form-select" id="status" required>
                            <option value="">{{ __('--select--') }}</option>
                            <option {{ old('status') == '1' ? 'selected' : '' }} value="1">Active</option>
                            <option {{ old('status') == '2' ? 'selected' : '' }} value="2">InActive</option>
                        </select>
                        <span id="status_err" class="candidateErr">
                            @if($errors->has('status'))
                                {{ $errors->first('status') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">Date of Birth</label>
                        <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}">
                        <span id="date_of_birth_err" class="candidateErr">
                            @if($errors->has('date_of_birth'))
                                {{ $errors->first('date_of_birth') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Designation') }}</label>
                        <select name="ref_designation_id" class="form-select" id="ref_designation_id">
                            <option value="">{{ __('--select--') }}</option>
                            @foreach($designation as $val)
                            <option value="{{ $val->id }}" {{ old('ref_designation_id') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span id="ref_designation_id_err" class="candidateErr">
                            @if($errors->has('ref_designation_id'))
                                {{ $errors->first('ref_designation_id') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Department') }}</label>
                        <select  name="ref_department_id" class="form-select" id="ref_department_id">
                            <option value="">{{ __('--select--') }}</option>
                            @foreach($department as $val)
                            <option value="{{ $val->id }}" {{ old('ref_department_id') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span id="ref_department_id_err" class="candidateErr">
                            @if($errors->has('ref_department_id'))
                                {{ $errors->first('ref_department_id') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Office Type') }}</label>
                        <select name="ref_office_type_id" class="form-select" id="ref_office_type_id">
                            <option value="">{{ __('--select--') }}</option>
                            @foreach($office_type as $val)
                            <option value="{{ $val->id }}" {{ old('ref_office_type_id') == $val->id ? 'selected' : '' }}>{{ $val->office_type_name }}</option>
                            @endforeach
                        </select>
                        <span id="ref_office_type_id_err" class="candidateErr">
                            @if($errors->has('ref_office_type_id'))
                                {{ $errors->first('ref_office_type_id') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Date of Joining') }}</label>
                        <input type="date" class="form-control" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining') }}">
                        <span id="date_of_joining_err" class="candidateErr">
                            @if($errors->has('date_of_joining'))
                                {{ $errors->first('date_of_joining') }}
                            @endif
                        </span>
                    </div>

                    <div class="form-input">
                        <label class="required-label">{{ __('Currently Posted') }}</label>
                        <select name="currently_posted" class="form-select" id="currently_posted" required>
                            <option value="">{{ __('--select--') }}</option>
                            @foreach($state as $val)
                            <option value="{{ $val->id }}" {{ old('currently_posted') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                            @endforeach
                        </select>
                        <span id="currently_posted_err" class="candidateErr">
                            @if($errors->has('currently_posted'))
                                {{ $errors->first('currently_posted') }}
                            @endif
                        </span>
                    </div>
                    <div class="form-input">
                        <label class="form-label aster">{{ __('Reporting Manager') }}</label>
                        <select name="reporting_manager_id" id="reporting_manager_id" class="form-select">
                            <option value="">----Select Reporting Manager----</option>
                            @foreach ($manager as $managerval)
                            <option value="{{ $managerval->id }}" {{ old('reporting_manager_id') == $managerval->id ? 'selected' : '' }}>
                                {{ $managerval->name }} ({{ $managerval->email }})
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-input">
                        <label class="required-label">Address</label>
                        <textarea id="address" name="address" placeholder="Address">{{ old('address') }}</textarea>
                        <span id="address_err" class="candidateErr">
                            @if($errors->has('address'))
                                {{ $errors->first('address') }}
                            @endif
                        </span>
                    </div>
                </div>

                <div class=" inner_page_dash__ mt-[20px]">
                    <h4 class="text-[18px] py-[10px] font-semibold">Assign Role</h4>
                    <div class="">
                        <div class="grid_rdit_page_user">
                            <div class="">
                                <div class="border_check_box__">
                                    <p>Roles</p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-1">
                                        @if ($roles->isNotEmpty())
                                        @foreach ($roles as $role)
                                            <div class="custom_check_inline-item">
                                            <input type="radio"
                                                id="role-{{ $role->id }}" class="custom_check_inline-checkbox"
                                                name="role[]" value="{{ $role->name }}">
                                            <label class="custom_check_inline-label"
                                                for="role-{{ $role->id }}">{{ $role->name }}</label>

                                            </div>
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <button id="creteUserButton" class="hover-effect-btn fill_btn" type="button">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection