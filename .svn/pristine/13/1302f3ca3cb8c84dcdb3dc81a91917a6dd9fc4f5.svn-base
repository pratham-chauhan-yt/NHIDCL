@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Add External Employee</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4">
            <div class="tab_custom_c mb-[20px]">
                <button class="tablink active" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z"></path>
                    </svg> External Employee
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"></path>
                    </svg> Archive External Employee
                </button>
            </div>
            @include('components.alert')
            <div id="Home" class="tabcontent" style="display: block;">
                <form action="{{ route('directory-management.external.employees.store') }}" method="post" class="form_grid_cust" id="saveExternalEmployeeForm">
                    @csrf
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Full Name</label>
                            <input type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" data-validate="required" data-error="Please enter employee full name." placeholder="Your Full Name">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Email</label>
                            <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" data-validate="required" data-error="Please enter a valid email address">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Mobile Number</label>
                            <input type="text" name="mobile_no" id="mobile_no" value="{{ old(key: 'mobile_no') }}" placeholder="Mobile Number" data-validate="required" data-error="Please enter employee mobile number.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Date Of Birth</label>
                            <input type="date" name="date_of_birth" id="date_of_birth" value="{{ old('date_of_birth') }}" data-validate="required" data-error="Please choose employee date of birth.">
                        </div>
                        <div class="form-input">
                            <label class="required-label">Designation</label>
                            <select name="designation" id="designation" class="form-select" data-validate="required" data-error="Please choose employee designation.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($designation as $val)
                                <option value="{{ $val->id }}" {{ old('designation') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Department</label>
                            <select  name="department" id="department" class="form-select" data-validate="required" data-error="Please choose employee department.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($department as $val)
                                <option value="{{ $val->id }}" {{ old('department') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">Roles</label>
                            <select  name="roles" id="roles" class="form-select" data-validate="required" data-error="Please choose employee roles.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($roles as $val)
                                <option value="{{ $val->id }}" {{ old('roles') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-input">
                            <label class="required-label">State</label>
                            <select  name="state" id="state" class="form-select" data-validate="required" data-error="Please choose employee state.">
                                <option value="">{{ __('--select--') }}</option>
                                @foreach($state as $val)
                                <option value="{{ $val->id }}" {{ old('state') == $val->id ? 'selected' : '' }}>{{ $val->name }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="form-input">
                            <label class="required-label">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}" placeholder="Address" data-validate="required" data-error="Please enter employee complete address.">
                        </div>
                    </div>
                    <div class="button_flex_cust_form">
                        <button class="hover-effect-btn fill_btn" id="saveExternalEmployee" type="submit">Add</button>
                    </div>
                </form>
            </div>

            <div id="News" class="tabcontent" style="display:none;">
                <div class="table_over">
                    <table class="cust_table__ table_sparated" id="externalEmpTableData">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Designation</th>
                                <th>Department</th>
                                <th>State</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        window.externalEmpDataUrl = "{{ route('directory-management.external.employees.create') }}";
    </script>
@endpush
