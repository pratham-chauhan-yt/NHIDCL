@extends('layouts.dashboard')

@section('dashboard_content')
<section class="home-section">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Create User / Employee') }}</div>

        </div>
    </div>

    <div class="inner_page_dash__">
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {!! Form::open([
                'route' => 'employeeUser.store',
                'method' => 'POST',
            ]) !!}

                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">
                    <div class="">
                        <label class="form-label aster">{{ __('First Name') }}</label>
                        <input type="text" class="form-control" name="first_name" id="first_name" required>
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Last Name') }}</label>
                        <input type="text" class="form-control" name="last_name" id="last_name" required>
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Qualification') }}</label>
                        <input type="text" class="form-control" id="qualification" name="qualification" value="{{ old('qualification') }}"
                           required>
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Designation') }}</label>
                        <select name="designation_id" class="form-select" id="designation_id" required>
                            <option value="">{{ __('Choose...') }}</option>
                            @foreach($designation as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">
                    <div class="">
                        <label class="form-label aster">{{ __('Employee Type') }}</label>
                        <input type="text" class="form-control" name="employee_type" id="employee_type" value="{{ old('employee_type') }}">
                    </div>

                    <div class="">
                        <label class="form-label aster">{{ __('Date of Joining') }}</label>
                        <input type="date" class="form-control" name="date_of_joining" id="date_of_joining" value="{{ old('date_of_joining') }}"
                        >
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Date of Completion of Tenure') }}</label>
                        <input type="date" class="form-control" name="date_completion_tenure" id="date_completion_tenure" value="{{ old('date_completion_tenure') }}"
                        >
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Category') }}</label>
                        <select name="category" class="form-select" id="category" required>
                            <option value="General">{{ __('General') }}</option>
                            <option value="ST">{{ __('ST') }}</option>
                            <option value="SC">{{ __('SC') }}</option>
                            <option value="OBC">{{ __('OBC') }}</option>
                        </select>
                    </div>

                </div>

                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">
                    <div class="">
                        <label class="form-label aster">{{ __('Date of Birth') }}</label>
                        <input type="date" class="form-control" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}"
                        >
                    </div>

                    <div class="">
                        <label class="form-label aster">{{ __('Date of Retirement from government (In case of Direct contract and Deputation)') }}</label>
                        <input type="date" class="form-control" name="date_of_retirement" id="date_of_retirement"
                        value="{{ old('date_of_retirement') }}">
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Employee Code') }}</label>
                        <input type="text" class="form-control" name="employee_code" id="employee_code" value="{{ old('employee_code') }}">
                    </div>
                    <div class="">

                        <label class="form-label aster">{{ __('Email') }}</label>
                        <input type="email" class="form-control" name="email" id="email" value="{{ old('email') }}"
                            maxlength="100" required>
                    </div>

                </div>



                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">

                    <div class="">
                        <label class="form-label aster">{{ __('Contact Number') }}</label>
                        <input type="text" class="form-control" name="contact_number" id="contact_number" value="{{ old('contact_number') }}"
                        maxlength="10">
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Parent Department (In case of Direct Contract and Deputation)') }}</label>

                        <input type="text" class="form-control"
                        value="{{getDepartmentNameById(Auth::user()->department_master_id)}}" disabled>

                        <input type="hidden" class="form-control" name="parent_department_id" id="parent_department_id"
                        value="{{Auth::user()->department_master_id}}">

                    </div>

                    <div class="">
                        <label class="form-label aster">{{ __('Place of Posting') }}</label>
                        <input type="text" class="form-control" name="place_of_posting" id="place_of_posting" value="{{ old('place_of_posting') }}"
                        >
                    </div>


                    <div class="">
                        <label class="form-label aster">{{ __('Date of Posting') }}</label>
                        <input type="date" class="form-control" name="date_of_posting" id="date_of_posting" value="{{ old('date_of_posting') }}"
                        >
                    </div>

                </div>


                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">

                    <div class="">
                        <label class="form-label aster">{{ __('Record of Previous Postings') }}</label>
                        <input type="text" class="form-control" name="record_previous_posting" id="record_previous_posting" value="{{ old('record_previous_posting') }}"
                        >
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Department') }}</label>
                        <select name="department_id" class="form-select" id="department_id" required>
                            <option value="">{{ __('Choose...') }}</option>
                            @foreach($department as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="">
                        <label class="form-label aster">{{ __('Role') }}</label>
                        <select name="role_id" class="form-select" id="role_id" required>
                            <option value="">{{ __('Choose...') }}</option>
                            @foreach($roles as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label class="form-label aster">{{ __('Last Activity Time') }}</label>
                        <input type="datetime-local" class="form-control" name="last_activity_time" id="last_activity_time" value="{{ old('last_activity_time') }}"
                        >
                    </div>

                </div>


                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">

                    <div class="">
                        <label for="" class="form-label aster">{{ __('Account Status') }}</label>
                        <select name="userid_status" class="form-select" id="userid_status" required>
                            <option value="">{{ __('Choose...') }}</option>
                            <option {{ old('userid_status') == '1' ? 'selected' : '' }} value="1">Active</option>
                            <option {{ old('userid_status') == '2' ? 'selected' : '' }} value="2">Inactive
                            </option>
                        </select>
                    </div>
                    <div class="">
                        <label for="" class="form-label aster">{{ __('Office Type') }}</label>
                        <select name="office_type" class="form-select" id="office_type" required>
                            <option value="">{{ __('Choose...') }}</option>
                            @foreach($office_type as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                            </option>
                        </select>
                    </div>

                    <div class="">
                        <label class="form-label aster">{{ __('State') }}</label>
                        <select name="state_id" class="form-select" id="state_id" required>
                            <option value="">{{ __('Choose...') }}</option>
                            @foreach($state as $val)
                              <option value="{{ $val->id }}">{{ $val->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="">
                        <label for="" class="form-label aster">{{ __('Captcha') }}</label>

                        <input type="text" class="form-control captcha_code"
                            aria-describedby="emailHelp" id="captcha" name="captcha" placeholder="{{ __('Captcha Code') }}"
                            required autocomplete="off">
                        @error('captcha')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>


                </div>

                <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">

                    <div class="">
                        <img src="{{ captcha_src('default') }}" alt="Captcha Image" id="captcha-image" class="w-100 caption_border">
                        <img src="{{ asset('/images/refresh.png') }}" alt="refresh" type="button" class="btn btn-refresh">

                    </div>


                    <div class="">

                    </div>

                    <div class="">

                    </div>

                    <div class="">

                    </div>

                </div>

                <div class="container inner_page_dash__ mt-[20px]">
                    <button type="submit" class="hover-effect-btn fill_btn">{{ __('Create') }}</button>
                 </div>


            {!! Form::close() !!}

   </section>

@endsection

@push('scripts')
    <script src="{{ asset('js/chart-loader.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>
    <script type="text/javascript">
        $('.btn-refresh').click(function() {
            $.ajax({
                type: 'GET',
                url: "{!! route('auth.refresh-captcha') !!}",
                success: function(data) {
                    // Update captcha image
                    $("#captcha-image").attr("src", data.captcha + '?' + Math.random());
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                }
            });
        });
    </script>
@endpush
