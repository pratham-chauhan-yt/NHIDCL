@extends('layouts.dashboard')

@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Create Role') }}</div>
            </div>
        </div>

        <div class="inner_page_dash__">
            {!! Form::open(['route' => 'roles.store','method' => 'POST']) !!}
                <div class="inpus_cust_cs grid check_box_input grid-cols-2 gap-[30px] mt-4">
                    <div class="">
                        <label class="form-label aster">{{ __('Role Name') }}</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" maxlength="100" required>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class=" inner_page_dash__ mt-[20px]">
                    <h4 class="text-[18px] py-[10px] font-semibold">Assign Permissions</h4>
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
                                                name="permission[]" value="{{ $permission->name }}">
                                            <label class="custom_check_inline-label" for="permission-{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="form-input">
                    <button type="submit" class="hover-effect-btn fill_btn">{{ __('Create Role') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection