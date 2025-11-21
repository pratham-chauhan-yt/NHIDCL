@extends('layouts.dashboard')
@section('dashboard_content')
    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Recruitment Post</div>
        </div>
    </div>
    <div class="inner_page_dash__">
        <div class="my-4 ">
            <div class="tab_custom_c">
                <button class="tablink" onclick="openPage('Post', this, '#373737')" id="defaultOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                    </svg>Create Post
                </button>
                <button class="tablink" onclick="openPage('News', this, '#373737')">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                    </svg>Post List
                </button>
            </div>
            @include('components.alert')
            <div id="Post" class="tabcontent" style="display: block;">
                <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    <div class="">Post Details</div>
                </div>
                <form class="form_grid_cust" id="recruitmentPostJobForm" method="POST" action="{{ route('recruitment-portal.post.store') }}">
                    @csrf
                    <div class="form-data">
                        <label class="required-label">Mode of Recruitment</label>
                        <div class="custom_check_inline-container">
                            @forelse($refModeRecruitment as $refModeData)
                                <div class="custom_check_inline-item">
                                    <input type="radio" name="mode_of_requirement" id="mode_of_requirement{{ $refModeData->id }}" value="{{ $refModeData->id }}"
                                        class="custom_check_inline-checkbox"
                                        @if ($loop->first) checked @endif>
                                    <label for="mode_of_requirement{{ $refModeData->id }}"
                                        class="custom_check_inline-label">{{ $refModeData->name }}</label>
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
                                <option value="GATE" {{ old('post_examination') === 'GATE' ? 'selected' : '' }}>GATE</option>
                                <option value="UPSC" {{ old('post_examination') === 'UPSC' ? 'selected' : '' }}>UPSC</option>
                            </select>
                            @error('post_examination')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Year</label>
                            <select name="advertisement_year" id="advertisement_year" onchange="getAdvertisement(this.value)" data-validate="required" data-error="Please choose year." required>
                                <option value="">---- choose year ----</option>
                                <option value="2024" {{ old('advertisement_year') === '2024' ? 'selected' : '' }}>2024</option>
                                @forelse ($year as $data)
                                    <option value="{{ $data }}" {{ old('advertisement_year') === $data ? 'selected' : '' }}>{{ $data }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('advertisement_year')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Select Advertisement</label>
                            <select name="recruitment_advertisement_id" id="recruitment_advertisement_id" data-validate="required" data-error="Please choose advertisement." required>
                                <option value="">---- Select Advertisement ----</option>
                                @foreach ($adslist as $adsdata)
                                    <option value="{{ $adsdata->id }}" {{ old('recruitment_advertisement_id') === $adsdata->id ? 'selected' : '' }}>{{ $adsdata->advertisement_title }}</option>
                                @endforeach
                            </select>
                            @error('recruitment_advertisement_id')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Post Name</label>
                            <input type="text" name="post_name" id="post_name" value="{{ old('post_name') }}" placeholder="Consultant" data-validate="required" data-error="Please enter post name." required>
                            @error('post_name')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Status</label>
                            <select name="is_active" id="is_active" data-validate="required" data-error="Please choose post status." required>
                                <option value="">---- Choose post status ----</option>
                                <option value="1" {{ old('is_active') === 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ old('is_active') === 0 ? 'selected' : '' }}>InActive</option>
                                <option value="2" {{ old('is_active') === 2 ? 'selected' : '' }}>Cancelled</option>
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
							<input type="datetime-local" name="last_datetime" id="last_datetime" value="{{ old('last_datetime') }}" min="{{ $now }}" data-validate="required" data-error="Please enter post apply last date and time." required />
							<span id="last_datetime" class="last_datetime_err candidateErr"></span>
							@error('last_datetime')
								<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>
                        <div class="form-input">
                            <label class="required-label">Total Vacancy</label>
                            <input type="text" name="total_vacancy" id="total_vacancy" value="{{ old('total_vacancy') }}" placeholder="Enter total number of vacancy for this post..." data-validate="required" data-error="Please enter total number of vacancy." min="1" required>
                            @error('total_vacancy')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                        <div class="">Required Document</div>
                    </div>
                    <div class="inpus_cust_cs form_grid_dashboard_cust_">
                        <div class="form-input">
                            <label class="required-label">Require Gate Details?</label>
                            <select name="required_gate_detail" id="required_gate_detail" data-validate="required" data-error="Please choose require gate options." required>
                                <option value="">---- choose required gate details ----</option>
                                <option value="0" {{ old('required_gate_detail') === '0' ? 'selected' : '' }}>No</option>
                                <option value="1" {{ old('required_gate_detail') === '1' ? 'selected' : '' }}>Yes</option>
                            </select>
                            @error('required_gate_detail')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-input div_gate_year">
                            <label>Year of Gate Exam</label>
                            <select id="required_gate_exam_year" name="required_gate_exam_year[]" multiple
                                data-courses='@json($gate_years)' class="required_gate_exam_year"
                                @if (old('required_gate_detail') === '0') disabled @else required @endif>
                                @foreach ($gate_years as $gate_year)
                                    <option value="{{ $gate_year->id }}"
                                        @if (is_array(old('required_gate_exam_year')) && in_array($gate_year->id, old('required_gate_exam_year'))) selected @endif>
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
                            <select id="required_gate_discipline" name="required_gate_discipline[]" multiple
                                data-courses='@json($gate_disciplines)' class="required_gate_discipline"
                                @if (old('required_gate_detail') === '0') disabled @else required @endif>
                                @foreach ($gate_disciplines as $gate_discipline)
                                    <option value="{{ $gate_discipline->id }}"
                                        @if (is_array(old('required_gate_discipline')) && in_array($gate_discipline->id, old('required_gate_discipline'))) selected @endif>
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
                        <div class="form-input">
                            <label class="required-label">Age Limit</label>
                            <div class="grid grid-cols-2 gap-[10px]">
                                <input type="number" name="min_age_limit" id="min_age_limit" value="{{ old('min_age_limit') }}" placeholder="18" data-validate="required" data-error="Please enter minimum age limit." required>
                                @error('min_age_limit')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror

                                <input type="number" name="max_age_limit" id="max_age_limit" value="{{ old('max_age_limit') }}" placeholder="60" data-validate="required" data-error="Please enter maximum age limit." required>
                                @error('max_age_limit')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Required Education</label>
                            <select name="required_education" id="required_education" class="form-control required_education">
                                <option value="">--Select Required Education --</option>
                                @forelse ($refQualification as $val)
                                    <option value="{{ $val->id }}" >{{ $val->qualification_name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('required_education')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Desirable Education</label>
                            <select name="desire_education" id="desire_education" class="form-control desire_education">
                                <option value="">--Select Education --</option>
                                @forelse ($refQualification as $val)
                                    <option value="{{ $val->id }}">{{ $val->qualification_name }}</option>
                                @empty
                                @endforelse
                            </select>
                            @error('desire_education')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input">
                            <label class="required-label">Required Experience</label>
                            <input type="number" name="required_experience" id="required_experience" value="{{ old('required_experience') }}" placeholder="3" data-validate="required" data-error="Please enter total required experience." required>
                            @error('required_experience')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Required Experience Detail</label>
                            <input type="text" name="required_experience_detail" id="required_experience_detail" placeholder="3 Years of experience in Banking">
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Desirable Experience</label>
                            <input type="text" name="desire_experience" id="desire_experience" placeholder="5">
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Desirable Experience Detail</label>
                            <input type="text" name="desire_experience_detail" id="desire_experience_detail" placeholder="5 Years of experience in Banking">
                        </div>
                        <div class="form-input" style="display:none">
                            <label>Eligibility Criteria</label>
                            <textarea name="eligibility_criteria" id="eligibility_criteria" rows="2"
                                placeholder="Holding analogous post on regular basis in the pay Level-8 (pre revised PB-2(Rs.9300-34,800) with Grade Pay of Rs.4800/-) in CDA pattern or equivalent in IDA pattern in the parent cadre/department."></textarea>
                            @error('eligibility_criteria')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>


                    {{-- For payment --}}

                    <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                        <div class="form-input">
                            <label class="required-label">Post Type</label>
                            <select name="post_payment_type" id="post_payment_type" data-validate="required" data-error="Please enter employee full name." required>
                                <option value="">---- choose post type ----</option>
                                <option value="Unpaid" {{ old('post_payment_type') === 'Unpaid' ? 'selected' : '' }}>Un-paid</option>
                                <option value="Paid" {{ old('post_payment_type') === 'Paid' ? 'selected' : '' }}>Paid</option>
                            </select>
                        </div>

                        <div class="form-input" id="amount_field">
                            <label for="amount">Amount</label>
                            <input type="number" name="amount" id="amount" value="{{ old('amount') }}" placeholder="3" required>
                        </div>

                    </div>
                    {{-- End For payment --}}


                    <div class="button_flex_cust_form">
                        <button type="submit" name="submit" id="recruitmentPostJobSave" class="hover-effect-btn fill_btn">Submit</button>
                    </div>
                </form>
            </div>
            <div id="News" class="tabcontent" style="display:none;">
                <form class="form_grid_cus">
                    <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                        <div class="form-input">
                            <label for="filter_year">Select Year</label>
                            <select name="filter_year" id="filter_year">
                                @forelse ($year as $data)
                                    <option value="{{ $data }}">{{ $data }}</option>
                                @empty
                                    <option value="2025">2025</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-input">
                            <label for="filter_advertisement">Select advertisement</label>
                            <select class="filter_advertisement" id="filter_advertisement">
                                <option value="">---- Select advertisement ----</option>
                                @foreach ($adslist as $adsdata)
                                    <option value="{{ $adsdata->id }}">{{ $adsdata->advertisement_title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </form>
                <div class="table_over mt-4">
                    <h4>Post Details</h4>
                    <table class="cust_table__ table_sparated" id="advertisementPostDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Post name</th>
                                <th>Post Created Date</th>
                                <th>Post Created By</th>
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
        const advertismentPostDataUrl = "{{ route('recruitment-portal.post.index') }}";
    </script>
    <script src="{{ asset('public/js/recruitment-management/hr/post.js') }}"></script>
    <script src="{{ asset('public/js/select2.min.js') }}"></script>
@endpush
