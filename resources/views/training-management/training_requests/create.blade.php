@extends('layouts.dashboard')
@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">{{ __('Create Training Request') }}</div>
            </div>
        </div>

        <div class="inner_page_dash__">
            {!! Form::open(['route' => 'training.store','method' => 'POST', 'id' => 'training-request-form']) !!}
                <div class="inpus_cust_cs grid check_box_input grid-cols-1 gap-[10px] mt-4 mb-4">
                    <div class="form-input">
                        <label class="required-label">{{ __('Topic') }}</label>
                        <input type="text" name="training_topic" id="training_topic" class="form-control" value="{{ old('training_topic') }}" data-validate="required" data-error="Please enter training topic." maxlength="100">
                    </div>
                    <div class="form-input">
                        <label class="required-label">{{ __('Message') }}</label>
                        <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" maxlength="500" data-validate="required" data-error="Please leave your message.">{{ old('message') }}</textarea>
                        <small id="char-count-hint" class="text-muted">
                            Max 500 characters allowed.
                        </small>
                    </div>
                </div>

                <div class="form-input">
                    <button type="submit" id="training-request-btn" class="hover-effect-btn fill_btn">{{ __('Submit') }}</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</section>
@endsection
@push('scripts')
    <script src="{{ asset('/public/js/training-management.js') }}"></script>
@endpush