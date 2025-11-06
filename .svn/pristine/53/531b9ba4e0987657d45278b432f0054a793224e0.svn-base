@extends('layouts.dashboard')

@section('dashboard_content')

    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('Edit Role') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('roles.index') }}"><button type="button"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
            </div>
        </div>
    </div>
    {!! Form::open([
        'route' => ['roles.update', Crypt::encrypt($role->id)],
        'method' => 'PATCH',
    ]) !!}
    <div class="container inner_page_dash__ mt-[20px]">
        <div class="inpus_cust_cs grid check_box_input edit_input__">
            <div class="">
                <label class="">Role</label>
                {{-- <input type="text" class="" placeholder="role" value="{{ $role->name }}"> --}}
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                    value="{{ old('name', $role->name) }}" maxlength="100" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>

    <div class="container inner_page_dash__ mt-[20px]">
        <div class="">
            <div class=" inner_page_dash__ ">
                <div class="Cust_toggle_edit">
                    <label class="toggle-wrapper">
                        <h4 class="text-[14px] font-semibold">Assign Permissions</h4>
                    </label>
                    <div class="permission-section grid_rdit_page_user border_check_box__">
                        @php
                            $permissions = $permissions->mapWithKeys(function ($items, $key) {
                                return [($key ?: 'Others') => $items];
                            });
                        @endphp
                        @foreach ($permissions as $module => $permissionGroup)
                            <h4 class="text-[18px] py-[10px] font-semibold">{{ $module }}</h4>
                            <div class="grid_for_check_box">
                                @foreach ($permissionGroup as $permission)
                                    <div class="permissions">
                                        <input type="checkbox" id="permission-{{ $permission->id }}" class="custom_check_inline-checkbox"
                                            name="permission[]" value="{{ $permission->name }}" {{ $hasPermissions->contains($permission->name) ? 'checked' : '' }}>
                                        <label class="custom_check_inline-label" for="permission-{{ $permission->id }}">
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="container inner_page_dash__ mt-[20px]">
                    <button type="submit" class="hover-effect-btn fill_btn">{{ __('Update Role') }}</button>
                </div>
            </div>
        </div>
        
    </div>
    {!! Form::close() !!}
@endsection
