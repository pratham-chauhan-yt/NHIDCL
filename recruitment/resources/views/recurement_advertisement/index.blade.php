@extends('layouts.dashboard')
@section('dashboard_content')
	<div class="container-fluid md:p-0">
		<div class="top_heading_dash__">
			<div class="main_hed">Advertisement</div>
		</div>
	</div>
	<div class="inner_page_dash__">
		<div class="my-4 ">
			<div class="tab_custom_c">
				<button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
					<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
					</svg>
					Create Advertisement
				</button>
				<button class="tablink" onclick="openPage('News', this, '#373737')">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
					<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
					</svg>
					Advertisement Posted
				</button>
			</div>
			@include('components.alert')
			<div id="Home" class="tabcontent">
				<div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
					<div class="">Create New Advertisement</div>
				</div>
				{{ Form::open(array('route' => 'recruitment-portal.advertisement.store', 'id'=>'advertisementForm','files' => true)) }}
					@csrf
					<div class="inpus_cust_cs form_grid_dashboard_cust_">
						<div class="form-input">
							<label class="required-label">Advertisement Title</label>
							<input type="text" name="advertisement_title" id="advertisement_title" value="{{ old('advertisement_title') }}" required/>
							<span id="advertisement_title" class="advertisement_title_err candidateErr"></span>
							@error('advertisement_title')
							<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>
						<div class="form-input">
							<label class="required-label">As on date</label>
							<input type="date" name="as_on_date" id="as_on_date" value="{{ old('as_on_date') }}" required/>
							<span id="as_on_date" class="as_on_date_err candidateErr"></span>
							@error('as_on_date')
							<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>

						@php
						$now = \Carbon\Carbon::now()->format('Y-m-d\TH:i');
						@endphp

						<div class="form-input">
							<label class="required-label">Start Date and Time</label>
							<input type="datetime-local" name="start_datetime" id="start_datetime" value="{{ old('start_datetime') }}" min="{{ $now }}" required />
							<span id="start_datetime" class="start_datetime_err candidateErr"></span>
							@error('start_datetime')
								<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>

						<div class="form-input">
							<label class="required-label">Expiry Date and Time</label>
							<input type="datetime-local" name="expiry_datetime" id="expiry_datetime" value="{{ old('expiry_datetime') }}" min="{{ $now }}" required/>
							<span id="expiry_datetime" class="expiry_datetime_err candidateErr"></span>
							@error('expiry_datetime')
							<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
						</div>
						<div class="attachment_advertisement">
                            <label class="required-label">Upload Advertisement File</label>
                            <div class="flex gap-[10px]">
                                <input id="advertisement_file_txt" name="advertisement_file_txt" type="text" class="advertisement_file_txt" placeholder="Upload documents" readonly>
                                <label class="upload_cust mb-0 hover-effect-btn hide_upload_photos cursor-pointer"> Upload File
                                    <input id="advertisement_file" name="advertisement_file" type="file" class="hidden advertisement_file">
                                </label>
								<input type="hidden" name="upload_file" id="upload_file">
                            </div>
                            <span id="advertisement_file" class="advertisement_file_err candidateErr"></span>
							@error('advertisement_file')
							<div class="invalid-feedback d-block">{{ $message }}</div>
							@enderror
                        </div>

						<div class="upload_sec">
							<div class="upload_advertisement">
								<label class="">Note/Instruction</label>
								<textarea name="note_instruction" id="note_instruction" class="form-control" placeholder="Description" rows="2"></textarea>
								<span id="note_instruction" class="note_instruction_err candidateErr"></span>
                                @error('note_instruction')
								<div class="invalid-feedback d-block">{{ $message }}</div>
								@enderror
							</div>
						</div>
					</div>
					<div class="button_flex_cust_form">
						<button class="hover-effect-btn fill_btn cursor-pointer" type="submit" id="submitAdvertisementButton">Submit</button>
					</div>
				</form>
			</div>

			<div id="News" class="tabcontent">
				<div class="job_poster_grid_cust">
					@forelse($record as $value)
					<div class="job_posted_cust">
						<h4 class="">{{$value->advertisement_title}}</h4>
						<div class="mb-[10px] cust_p pt-[5px]">
							<p>Active Until: <span>
							{{ Carbon\Carbon::parse($value->start_datetime)->format('M d, Y') }}
							</span></p>
						</div>
						<div class="cust_points_jobs mt-[10px] justify-end">
							<span class=""><a href="{{route('recruitment-portal.advertisement.edit',encrypt($value->id))}}">Edit</a></span>
							<span class=""><a href="{{route('recruitment-portal.advertisement.show',encrypt($value->id))}}">View</a></span>
							<span style="background: rgb(202, 21, 21); color: white;">
							<form id="delete-form-{{ $value->id }}" method="POST" action="{{ route('recruitment-portal.advertisement.destroy', encrypt($value->id)) }}" onsubmit="event.preventDefault(); confirmDelete({{ $value->id }});">
								@csrf
								@method('DELETE')
								<button type="submit">Delete</button>
							</form>
							</span>
						</div>
					</div>
					@empty
					@endforelse
				</div>
			</div>
		</div>
	</div>
@endsection
@push('scripts')
    <script src="{{ asset('public/js/recruitment-portal.js') }}"></script>
@endpush
