@extends('layouts.dashboard')
@section('dashboard_content')

<section class="home-section ">
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed"> Profile</div>

        </div>
    </div>
    <div class="inner_page_dash__">


                <form method="POST" id="profile" action="{{ route('profile.update') }}">
                    @csrf
                <!-- input type designs  -->
                <div class="container inner_page_dash__ mt-[20px]">

                    <h4 class="text-[24px] py-[10px] font-semibold"></h4>
                    <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">
                        <div class="">
                            <label class="form-label aster">{{ __('Emp ID') }}</label>
                            <input type="hidden" class="form-control" name="id" id="id" value="{{ $user->id }}">
                            <input type="text" class="form-control" name="user_id" id="user_id"
                            value="{{ old('user_id', $user->user_id ?? 'N/A') }}" disabled>
                        </div>
                        <div class="">
                            <label class="form-label aster">{{ __('Name') }}</label>
                            <input type="text" class="form-control" id="name" name="name"
                            value="{{ old('name', $user->name) }}" disabled>
                        </div>
                        <div class="">
                            <label class="form-label aster">{{ __('Email') }}</label>
                            <input type="email" class="form-control" name="email" id="email"
                            value="{{ old('email', $user->email) }}" disabled>
                        </div>
                        <div class="">
                            <label class="form-label aster">{{ __('Mobile') }}</label>
                            <input type="text" class="form-control" name="mobile" id="mobile"
                            value="{{ old('mobile', $user->mobile) }}" disabled>
                        </div>
                    </div>
                    <div class="inpus_cust_cs grid check_box_input grid-cols-4 gap-[30px] mt-4">
                        <div class="">
                            <label class="form-label aster">{{ __('Department') }}</label>
                                    <select name="department_master_id" class="form-select" id="department_master_id" disabled>
                                        <option value="">{{ __('Choose...') }}</option>
                                        @foreach($department as $val)
                                          <option value="{{ $val->id }}"{{ old('department_master_id', $user->department_master_id) ==  $val->id  ? 'selected' : '' }}>{{ $val->name }}</option>
                                        @endforeach
                                    </select>
                        </div>
                        <div class="">
                            <label for="" class="form-label aster">{{ __('Status') }}</label>
                            <select name="userid_status" class="form-select" id="userid_status" disabled>
                                <option value="">{{ __('Choose...') }}</option>
                                <option {{ old('userid_status', $user->userid_status) == '1' ? 'selected' : '' }}
                                    value="1">Active</option>
                                <option {{ old('userid_status', $user->userid_status) == '2' ? 'selected' : '' }}
                                    value="2">Inactive
                                </option>
                                <option {{ old('userid_status', $user->userid_status) == '3' ? 'selected' : '' }}
                                    value="3">Blacklisted
                                </option>
                                <option {{ old('userid_status', $user->userid_status) == '4' ? 'selected' : '' }}
                                    value="4">Left NHIDCL
                                </option>
                            </select>
                        </div>
                        <div class="">
                            <label for="" class="form-label aster">{{ __('Is NHIDCL Employee') }}</label>
                            <select name="is_nhidcl_employee" class="form-select" id="is_nhidcl_employee" disabled>
                                <option value="">{{ __('Choose...') }}</option>
                                <option {{ old('is_nhidcl_employee', $user->is_nhidcl_employee) == '1' ? 'selected' : '' }}
                                    value="1">Yes</option>
                                <option {{ old('is_nhidcl_employee', $user->is_nhidcl_employee) == '0' ? 'selected' : '' }}
                                    value="0">No
                                </option>
                            </select>
                        </div>

                    </div>


                    <div class="container inner_page_dash__ mt-[20px]">

                        <button class="hover-effect-btn fill_btn" id="edit"  type="button"> Edit</button>
                        <button class="hover-effect-btn fill_btn" id="update"  type="submit" style="display:none"> Update</button>

                    </div>

                </div>

                <!-- Edn input types  -->

                </form>

    </div>
</div>

</section>

 @endsection

 @push('scripts')

 <script>
 $(document).ready(function() {
     $("#edit").click(function() {
         // $("#profile #user_id").removeAttr("disabled");
         $("#profile #name").removeAttr("disabled");
         $("#profile #mobile").removeAttr("disabled");
         // $("#profile #department_master_id").removeAttr("disabled");
         $('#edit').hide();
         $('#update').show();
     });
 });
 </script>
@endpush
