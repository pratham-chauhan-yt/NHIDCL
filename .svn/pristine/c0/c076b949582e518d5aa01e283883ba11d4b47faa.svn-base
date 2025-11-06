@extends('layouts.dashboard')

@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Sms Template</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="Home" class="tabcontent">
                    <form class="form_grid_cust" id="add-template" action="{{ route('template.store') }}" method="POST">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">

                            <div class="">
                                <label class="required-label">Template Name</label>
                                <input type="text" name="template_name" class="" placeholder="Template Name"
                                    value="{{ old('template_name') }}">
                                @error('template_name')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Template ID</label>
                                <input type="text" name="template_id" class="" placeholder="Template ID"
                                    value="{{ old('template_id') }}">
                                @error('template_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Event ID</label>
                                <input type="text" name="event_id" class="" placeholder="Event ID"
                                    value="{{ old('event_id') }}">
                                @error('event_id')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Message</label>
                                <textarea name="message" class="" placeholder="Enter Message">{{ old('message') }}</textarea>
                                @error('message')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="">
                                <label class="required-label">Status</label>
                                <select name="status" class="">
                                    <option value="">Select Status</option>
                                    <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                    <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <div class="error-message">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Submit
                            </button>
                        </div>
                    </form>


                </div>

            </div>

        </div>

    </section>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    {{-- <script src="{{ asset('/public/validation/grievance.js') }}"></script> --}}
@endpush
