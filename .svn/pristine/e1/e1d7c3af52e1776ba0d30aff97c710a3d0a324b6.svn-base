@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Edit Permission') }}</div>
                <div class="plain_dlfex bg_elips_ic">
                    <a href="{{ route('permissions.index') }}"><button type="button"
                            class="hover-effect-btn fill_btn">{{ __('Back') }}</button></a>
                </div>
            </div>
        </div>

        <div class="container inner_page_dash__ mt-[20px]">
            {!! Form::open([
        'route' => ['permissions.update', Crypt::encrypt($permission->id)],
        'method' => 'PATCH', ]) !!}

            <div class="inpus_cust_cs grid check_box_input grid-cols-3 gap-[30px] mt-4">
                <div class="form-input">
                    <label class="form-label required-label">{{ __('Choose Module') }}</label>
                    <select name="module" id="module" class="form-control @error('module') is-invalid @enderror" required>
                        <option value="">--- Choose Module ---</option>
                        @foreach ($modules as $module)
                        <option value="{{ $module }}" {{ $permission->module == $module ? 'selected' : '' }}>
                            {{ $module }}
                        </option>
                        @endforeach
                    </select>
                    @error('module')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-input">
                    <label class="form-label aster">{{ __('Permission Name') }}</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                        value="{{ old('name', $permission->name) }}" maxlength="100" required>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="" style="display:none;">


                </div>
                <div class="" style="display:none;">

                </div>

            </div>



            <div class="container inner_page_dash__ mt-[20px]">
                <button class="hover-effect-btn fill_btn" type="submit"> {{ __('Update Permission') }}</button>
            </div>
            {!! Form::close() !!}
        </div>
    </section>
@endsection