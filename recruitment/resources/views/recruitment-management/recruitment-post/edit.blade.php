@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Recruitment Post</div>
    </div>
</div>
<div class="inner_page_dash__">
    <div class="my-4 ">
        @include('components.alert')
        <div class="tabcontent">
            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                <div class="">Edit Post Details</div>
            </div>
                {{ Form::model($edit_record, array('route' => ['recruitment-portal.post.update', $edit_record->id], 'class'=>'form_grid_cust', 'files' => true)) }}
                    @method('put')
                <div class="form-data">
                    <label class="required-label">Mode of Recruitment</label>
                    <div class="custom_check_inline-container">
                        @forelse($refModeRecruitment as $refModeData)
                        <div class="custom_check_inline-item">
                            <input type="radio" name="mode_of_requirement" id="mode_of_requirement{{$refModeData->id}}" value="{{$refModeData->id}}" class="custom_check_inline-checkbox" {{ ($refModeData->id == $edit_record->mode_of_requirement) ? 'checked':'' }}>
                            <label for="mode_of_requirement{{$refModeData->id}}" class="custom_check_inline-label">{{$refModeData->name}}</label>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    <div class="form-input">
                        <label class="required-label">Post Required Examination</label>
                        <select name="post_examination" id="post_examination" data-validate="required" data-error="Please choose post required examination." required>
                            <option value="">---- choose post examination ----</option>
                            <option value="GATE" {{ (old('post_examination', $edit_record->post_examination) === 'GATE') ? 'selected' : '' }}>GATE</option>
                            <option value="UPSC" {{ (old('post_examination', $edit_record->post_examination) === 'UPSC') ? 'selected' : '' }}>UPSC</option>
                        </select>
                        @error('post_examination')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Year</label>
                        <select name="advertisement_year" id="advertisement_year" onchange="getAdvertisement(this.value)" required>
                            @forelse ($year as $data)
                            <option value="{{$data}}" {{ ($data == $edit_record->advertisement_year) ? 'selected':'' }}>{{$data}}</option>
                            @empty
                            <option value="2025">2025</option>
                            @endforelse
                        </select>
                        @error('advertisement_year')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Select Advertisement</label>
                        <select name="recruitment_advertisement_id" id="recruitment_advertisement_id" required>
                            <option value="">---Select Advertisement---</option>
                            @foreach($adslist as $adsdata)
                            <option value="{{$adsdata->id}}" {{ ($adsdata->id == $edit_record->nhidcl_recruitment_advertisement_id) ? 'selected':'' }}>{{$adsdata->advertisement_title}}</option>
                            @endforeach
                        </select>
                        @error('recruitment_advertisement_id')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Post Name</label>
                        <input type="text" name="post_name" id="post_name" value="{{ $edit_record->post_name }}" placeholder="Consultant" required>
                        @error('post_name')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Status</label>
                        <select name="is_active" id="is_active" required>
                            <option value="1" {{ (1 == $edit_record->is_active) ? 'selected':'' }}>Active</option>
                            <option value="0" {{ (0 == $edit_record->is_active) ? 'selected':'' }}>InActive</option>
                            <option value="2" {{ (2 == $edit_record->is_active) ? 'selected':'' }}>Cancelled</option>
                        </select>
                        @error('is_active')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    @php
                    $now = \Carbon\Carbon::now()->format('Y-m-d\TH:i');
                    @endphp
                    <div class="form-input">
                        <label class="required-label">Last Date and Time</label>
                        <input type="datetime-local" name="last_datetime" id="last_datetime" value="{{ $edit_record->last_datetime }}" required />
                        <span id="last_datetime" class="last_datetime_err candidateErr"></span>
                        @error('last_datetime')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Total Vacancy</label>
                        <input type="text" name="total_vacancy" id="total_vacancy" value="{{ $edit_record->total_vacancy }}" placeholder="Enter total number of vacancy for this post..." required>
                        @error('total_vacancy')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label class="required-label">Require location preference?</label>
                        <select class="is_location_preference" name="is_location_preference" onchange="location_preference(this.value)">
                            <option value="1" {{ (1 == $edit_record->is_location_preference) ? 'selected':'' }}>Yes</option>
                            <option value="0" {{ (0 == $edit_record->is_location_preference) ? 'selected':'' }}>No</option>
                        </select>
                        @error('is_location_preference')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>No. of location preference*</label>
                        <input type="number" name="no_of_location_prefered" id="no_of_location_prefered" value="{{ $edit_record->no_of_location_prefered }}" placeholder="3">
                        @error('no_of_location_prefered')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        @php
                        // Get selected state IDs from related table as an array
                        $selectedLocations = $edit_record->getPostLocation->pluck('ref_state_master_id')->toArray();
                        @endphp
                        <label>Select Post Location</label>
                        <select class="require_location_prefered" name="require_location_prefered[]" multiple>
                            <option value="">--- Select Post Location ---</option>
                            @forelse ($stateList as $val)
                            <option value="{{$val->id}}" {{ in_array($val->id, $selectedLocations) ? 'selected' : '' }}>{{$val->name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('require_location_prefered')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Enter specific requirement of post</label>
                        <textarea name="specific_requirement_of_post" id="specific_requirement_of_post" rows="3" cols="3" placeholder="Dictation of 10 minutes at the speed of 100 words per minute in Shorthand (English/Hindi) and transcription time (on computer only) is 50 minutes for English and 65 minutes for Hindi.">{{ $edit_record->specific_requirement_of_post }}</textarea>
                        @error('specific_requirement_of_post')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                    <div class="">Required Document</div>
                </div>
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    <div class="form-input" style="display:none">
                        <label class="required-label">Require 5 month salary slip?</label>
                        <select name="required_5_month_salary_slip" id="required_5_month_salary_slip">
                            <option value="1" {{ (1 == $edit_record->required_5_month_salary_slip) ? 'selected':'' }}>Yes</option>
                            <option value="0" {{ (0 == $edit_record->required_5_month_salary_slip) ? 'selected':'' }}>No</option>
                        </select>
                        @error('required_5_month_salary_slip')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Require 10 years of share capital?</label>
                        <select name="required_10_year_share_capital" id="required_10_year_share_capital">
                            <option value="1" {{ (1 == $edit_record->required_10_year_share_capital) ? 'selected':'' }}>Yes</option>
                            <option value="0" {{ (0 == $edit_record->required_10_year_share_capital) ? 'selected':'' }}>No</option>
                        </select>
                        @error('required_10_year_share_capital')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Require bar councel registration certificate?</label>
                        <select name="required_bar_councel_registration_certificate" id="required_bar_councel_registration_certificate">
                            <option value="1" {{ (1 == $edit_record->required_bar_councel_registration_certificate) ? 'selected':'' }}>Yes</option>
                            <option value="0" {{ (0 == $edit_record->required_bar_councel_registration_certificate) ? 'selected':'' }}>No</option>
                        </select>
                        @error('required_bar_councel_registration_certificate')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input">
                        <label class="required-label">Require Gate Details?</label>
                        <select name="required_gate_detail" id="required_gate_detail" required>
                            <option value="1" {{ ($edit_record->required_gate_detail == '1') ? 'selected':'' }}>Yes</option>
                            <option value="0" {{ ($edit_record->required_gate_detail == '0') ? 'selected':'' }}>No</option>
                        </select>
                        @error('required_gate_detail')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input div_gate_year">
                        <label>Year of Gate Exam</label>
                        <select id="required_gate_exam_year"
                                name="required_gate_exam_year[]"
                                multiple
                                data-courses='@json($gate_years)'
                                class="required_gate_exam_year"
                                @if(old('required_gate_detail') === '0') disabled @else required @endif>
                            @foreach ($gate_years as $gate_year)
                                <option value="{{ $gate_year->id }}"
                                    @if(
                                        (is_array(old('required_gate_exam_year')) && in_array($gate_year->id, old('required_gate_exam_year')))
                                        || (isset($edit_record) && is_array($edit_record->required_gate_exam_year) && in_array($gate_year->id, $edit_record->required_gate_exam_year))
                                    ) selected @endif>
                                    {{ $gate_year->passing_year }}
                                </option>
                            @endforeach
                        </select>
                        @error('required_gate_exam_year')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-input div_gate_discipline">
                        <label>Gate Discipline</label>
                        <select id="required_gate_discipline"
                                name="required_gate_discipline[]"
                                multiple
                                data-courses='@json($gate_disciplines)'
                                class="required_gate_discipline"
                                @if(old('required_gate_detail') === '0') disabled @else required @endif>
                            @foreach ($gate_disciplines as $gate_discipline)
                                <option value="{{ $gate_discipline->id }}"
                                    @if(
                                        (is_array(old('required_gate_discipline')) && in_array($gate_discipline->id, old('required_gate_discipline')))
                                        || (isset($edit_record) && is_array($edit_record->required_gate_discipline) && in_array($gate_discipline->id, $edit_record->required_gate_discipline))
                                    ) selected @endif>
                                    {{ $gate_discipline->discipline_name }}
                                </option>
                            @endforeach
                        </select>
                        @error('required_gate_discipline')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                    <div>Eligibility Details</div>
                </div>
                <div class="inpus_cust_cs form_grid_dashboard_cust_">
                    @php
                    $age_limit = json_decode($edit_record->age_limit, true);
                    @endphp
                    <div class="form-input">
                        <label class="required-label">Age Limit</label>
                        <div class="grid grid-cols-2 gap-[10px]">

                            <input type="number" name="min_age_limit" id="min_age_limit" placeholder="18" required
                                value="{{ old('min_age_limit', $age_limit['min_age_limit'] ?? '') }}">
                            @error('min_age_limit')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                            <input type="number" name="max_age_limit" id="max_age_limit" placeholder="60" required
                                value="{{ old('max_age_limit', $age_limit['max_age_limit'] ?? '') }}">
                            @error('max_age_limit')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror

                        </div>
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Required Education</label>
                        <select name="required_education[]" id="required_education" class="form-control required_education">
                            <option value="">--Select Required Education --</option>
                            @forelse ($refQualification as $val)
                            <option value="{{$val->id}}" {{ ($val->id == $edit_record->required_education) ? 'selected':'' }}>{{$val->qualification_name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('required_education')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Desirable Education</label>
                        <select name="desire_education[]" id="desire_education" class="form-control desire_education">
                            <option value="">--Select Education --</option>
                            @forelse ($refQualification as $val)
                            <option value="{{$val->id}}" {{ ($val->id == $edit_record->desire_education) ? 'selected':'' }}>{{$val->qualification_name}}</option>
                            @empty
                            @endforelse
                        </select>
                        @error('desire_education')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input">
                        <label class="required-label">Required Experience</label>
                        <input type="number" name="required_experience" id="required_experience" value="{{ $edit_record->required_experience }}" placeholder="3" required>
                        @error('required_experience')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Required Experience Detail</label>
                        <input type="text" name="required_experience_detail" id="required_experience_detail" value="{{ $edit_record->required_experience_detail }}" placeholder="3 Years of experience in Banking">
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Desirable Experience</label>
                        <input type="text" name="desire_experience" id="desire_experience" value="{{ $edit_record->desirable_experience }}" placeholder="5">
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Desirable Experience Detail</label>
                        <input type="text" name="desire_experience_detail" id="desire_experience_detail" value="{{ $edit_record->desire_experience_detail }}" placeholder="5 Years of experience in Banking">
                    </div>
                    <div class="form-input" style="display:none">
                        <label>Eligibility Criteria</label>
                        <textarea name="eligibility_criteria" id="eligibility_criteria" rows="2" placeholder="Holding analogous post on regular basis in the pay Level-8 (pre revised PB-2(Rs.9300-34,800) with Grade Pay of Rs.4800/-) in CDA pattern or equivalent in IDA pattern in the parent cadre/department.">{{ $edit_record->eligibility_criteria }}</textarea>
                        @error('eligibility_criteria')
                        <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                {{-- For payment --}}
                <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                    <div class="form-input">
                        <label class="required-label">Post Type</label>
                        <select name="post_payment_type" id="post_payment_type">
                            <option value="Unpaid" {{ $edit_record->post_payment_type == 'Unpaid' ? 'selected':'' }}>Un-paid</option>
                            <option value="Paid" {{ $edit_record->post_payment_type == 'Paid' ? 'selected':'' }}>Paid</option>
                        </select>
                    </div>

                    <div class="form-input" id="amount_field">
                        <label for="amount">Amount</label>
                        <input type="number" name="amount" id="amount" value="{{ $edit_record->amount }}" placeholder="3" required>
                    </div>
                </div>
                {{-- End For payment --}}

                <div class="button_flex_cust_form">
                    <button type="submit" name="submit" class="hover-effect-btn fill_btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script src="{{ asset('public/js/recruitment-management/hr/post.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
@endpush
