@extends('layouts.dashboard')
@section('styles')
<style>
.invalid-feedback{
    width: 100%;
    margin-top: .25rem;
    font-size: .875em;
    color: #dc3545;
}
.error-help-block{
	width: 100%;
    margin-top: .25rem;
    font-size: .875em;
    color: #dc3545;
}
</style>
@endsection
@section('dashboard_content')
        <div class="container-fluid md:p-0">
        		<div class="top_heading_dash__">
        			<div class="main_hed">Advertisement Edit</div>
                    <!-- <div class="plain_dlfex bg_elips_ic">
                        <select>
                            <option value="Today">19-12-2024</option>
                        </select>
                    </div> -->
                </div>
            </div>
            <div class="inner_page_dash__">
            	<div class="my-4 ">
            		<div class="tab_custom_c">
            			<button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
            				<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            				stroke="currentColor" class="size-4">
            				<path stroke-linecap="round" stroke-linejoin="round"
            				d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
            			</svg>
            		    Edit Advertisement
            		</button>
            		<button class="tablink" onclick="openPage('News', this, '#373737')">
            			<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            			stroke="currentColor" class="size-4">
            			<path stroke-linecap="round" stroke-linejoin="round"
            			d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
            		</svg>
            		Advertisement Posted
            	    </button>
                    </div>

                    <div id="Home" class="tabcontent">
                    	<div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                    		<div class="">Edit Advertisement</div>
                    	</div>
                    	<!-- <h6 class="text-[14px] font-medium">Mode of Engagement</h6> -->
                        {{ Form::model($edit_record, array('route' => ['recruitment.advertisement.update', $edit_record->id], 'id'=>'editAdvertisementForm', 'files' => true)) }}
                        @csrf
                        @method('put')
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div>
                                    <label  class="">Advertisement Title</label>
                                    <input type="text" class="" name="advertisement_title"
                                    value="{{$edit_record->advertisement_title ?? ''}}" />
									@error('advertisement_title')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div>
                                    <label  class="">As on date</label>
                                    <input type="date"  name="as_on_date" value="{{$edit_record->as_on_date ?? ''}}"/>
									@error('as_on_date')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div>
                                    <label  class="">Start Date and Time</label>
                                    <input type="datetime-local" name="start_datetime" value="{{$edit_record->start_datetime ?? ''}}"/>
									@error('start_datetime')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div>
                                    <label  class="">Expiry Date and Time</label>
                                    <input type="datetime-local"  name="expiry_datetime" value="{{$edit_record->expiry_datetime ?? ''}}"/>
									@error('expiry_datetime')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div class="upload_sec">
									<div class="upload_advertisement">
										<label	label class="upload_advertisement">Upload Advertisement File</label>
										<input type="file" id="fileInput" name="advertisement_file" class="hidden" onchange="updateFileName()">
									</div>
								</div>

                               {{--<div class="upload_advertisement">
                                    <label class="upload_advertisement">Upload Advertisement File</label>
                                    <div class="flex gap-[10px] upload_file_div">
                                        <input type="text" id="fileName" class="upload_advertisement" placeholder="Upload documents" disabled="">
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                        <input type="file" id="fileInput" name="advertisement_file" class="hidden" onchange="updateFileName()">
                                        </label>
                                    </div>
									@error('upload_advertisement')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>
                            </div>--}}
                        
                       {{--<div id="m_repeater_3" class="inpus_cust_cs form_grid_dashboard_cust_">--}}
                    {{--<div id="m_repeater_3" class="inpus_cust_cs">
                            @if(!empty($note_instruction))
                            @foreach($note_instruction as $value)
                                <div data-repeater-list="note_instruction">
                                    <div data-repeater-item>
                                        <label  class="">Note/Instruction</label>
                                        <div class="col-xxl-10 col-xl-8 col-md-8">
                                            <div class="row mb-3">
                                                <div class="col-md-10 mb-2">
                                                    <textarea name="note_instruction" class="form-control" placeholder="Description" rows="2">{{ $value->note_instruction }}</textarea>
                                                </div>
												@error('note_instruction')
												<div class="invalid-feedback d-block">{{ $message }}</div>
												@enderror
                                                <div class="col-md-2">
                                                    <a href="javascript:void(0)" style="" data-repeater-delete=""><label class="upload_cust mb-0 hover-effect-btn">Delete</label></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            @endif
                                <div class="addMore mt-5">
                                    <label data-repeater-create="" class="upload_cust mb-0 hover-effect-btn">
                                        <i class="fa-light fa-plus mr-2"></i> Add More
                                    </label>
                                </div>
                            </div>--}}
                                <div id="m_repeater_3" class="inpus_cust_cs form_grid_dashboard_cust_">
                                @if(!empty($note_instruction) && !is_null($note_instruction))
                                    <div data-repeater-list="notes">
                                        @foreach($note_instruction as $value)
                                            <div data-repeater-item>
                                                <label class="">Note/Instruction</label>
                                                <div class="col-xxl-10 col-xl-8 col-md-8">
                                                    <div class="row mb-3">
                                                        <div class="col-md-10 mb-2">
                                                            <textarea name="note_instruction" class="form-control" placeholder="Description" rows="2">{{ $value->note_instruction }}</textarea>
                                                        </div>
                                                        @error('note_instruction.*')
                                                            <div class="invalid-feedback d-block">{{ $message }}</div>
                                                        @enderror
                                                        <div class="col-md-2">
                                                            <a href="javascript:void(0)"  data-repeater-delete=""><label class="upload_cust mb-0 hover-effect-btn">Delete</label></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                                <div class="addMore mt-5">
                                    <label data-repeater-create class="upload_cust mb-0 hover-effect-btn">
                                        <i class="fa-light fa-plus mr-2"></i> Add More
                                    </label>
                                </div>
                            </div>

                            <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">Submit
                                </button>
                            </div>
                        </form>
                </div>

    <div id="News" class="tabcontent">
    	<div class="inner_select_cust_op">
    		<select class="m-2">
    			<option value="2025">2025</option>
    		</select>
    		{{--<select class="m-2">
    			<option value="All Jobs">All Jobs</option>
    			<option value="Active Jobs">Active Jobs</option>
    			<option value="InActive Jobs">InActive Jobs</option>
    		</select>--}}
    	</div>
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
    				<span class=""><a href="{{route('recruitment.advertisement.edit',$value->id)}}">Edit</a></span>
    				<span class=""><a href="{{route('recruitment.advertisement.show',$value->id)}}">View</a></span>
    				<span style="background: rgb(202, 21, 21); color: rgb(63, 37, 37);">
					<form method="post" action="{{route('recruitment.advertisement.destroy',$value->id)}}">
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
@section('scripts')

<script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
{!! JsValidator::formRequest('App\Http\Requests\Recruitment\AdvertisementRequest', '#editAdvertisementForm'); !!}
<script>

$('#m_repeater_3').repeater({
    initEmpty: false,
    isFirstItemUndeletable: false, // If you want the first item to be deletable
    show: function() {
        $(this).slideDown();
    },
});

function updateFileName() {
        const fileInput = document.getElementById('fileInput');
        const fileNameField = document.getElementById('fileName');
      
        // Check if a file is selected and update the hidden input
        if (fileInput.files.length > 0) {
            const fileName = fileInput.files[0].name;
            fileNameField.value = fileName;  // Set the name of the selected file to hidden input
        }
    }
</script>
@endsection