@extends('layouts.dashboard')

@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">{{ __('View Role') }}</div>
            <div class="plain_dlfex bg_elips_ic">
                <a href="{{ route('roles.index') }}"><button type="button"
                        class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
            </div>
        </div>
    </div>
    <!-- input type designs  -->
    <div class="container inner_page_dash__ mt-[20px]">
        <div class="inpus_cust_cs grid check_box_input edit_input__">
            <div class="">
                <label class="">Role</label>
                <input type="text" class="" placeholder="role" value="{{ $role->name }}" disabled>
            </div>
        </div>
        <div class="border_check_box__">
            <p>Permissions</p>
            <div class="grid_for_check_box">
                @if ($permissions->isNotEmpty())
                    @foreach ($permissions->filter(fn($permission) => $hasPermissions->contains($permission->name)) as $permission)
                        <div class="custom_check_inline-item">
                            <input type="checkbox" id="permission-{{ $permission->id }}"
                                class="custom_check_inline-checkbox" name="permission[]"
                                value="{{ $permission->name }}" checked>
                            <label class="custom_check_inline-label" for="permission-{{ $permission->id }}">
                                {{ Str::replaceFirst('user config - ', '', $permission->name) }}
                            </label>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
@endsection
