@extends('layouts.dashboard')
@section('styles')
<style>
    .invalid-feedback {
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
                    <div class="main_hed">Advertisement</div>
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
                            </svg>
                            Edit Post
                        </button>
                        <button class="tablink" onclick="openPage('News', this, '#373737')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Post List
                        </button>
                    </div>

                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div id="Post" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Post Details</div>
                        </div>
                            {{ Form::model($edit_record, array('route' => ['recruitment-portal.post.update', $edit_record->id], 'id'=>'editAdvertisementForm', 'files' => true)) }}
                            @csrf
                            @method('put')
                            <div class="">
                                <label  class="">Mode of Recruitment</label>
                                <div class="custom_check_inline-container">
                                    <div class="custom_check_inline-item">
                                        <input id="exam-checkbox" type="checkbox" name="mode_of_requirement[]" value="is_deputation" class="custom_check_inline-checkbox">
                                        <label for="exam-checkbox" class="custom_check_inline-label">Deputation</label>
                                    </div>
                                    <div class="custom_check_inline-item">
                                        <input id="interview-checkbox" type="checkbox" name="mode_of_requirement[]" value="is_direct_contract" class="custom_check_inline-checkbox">
                                        <label for="interview-checkbox" class="custom_check_inline-label">Direct Contract</label>
                                    </div>
                                    @error('mode_of_requirement')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>
                            </div>
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Year</label>
                                    <select  class="" name="advertisement_year" onchange="getAdvertisement(this.value)">
                                        @forelse ($year as $data)
                                        <option value="{{$data}}">{{$data}}</option>
                                        @empty
                                        <option value="2025">2025</option>
                                        @endforelse
                                    </select>
                                    @error('advertisement_year')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div class="">
                                    <label  class="">Select Advertisement</label>
                                    <select  class="advertisement_data" name="nhidcl_recruitment_advertisement_id">
                                        @forelse ($advertisement as $val)
                                        <option value="{{$val->id}}"{{ ($val->id == $edit_record->nhidcl_recruitment_advertisement_id) ? 'selected':'' }}>
                                            {{$val->advertisement_title}}
                                        </option>
                                        @empty
                                        <option value="">--Select Advertisement--</option>
                                        @endforelse

                                    </select>
                                    @error('nhidcl_recruitment_advertisement_id')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                </div>

                                <div class="">
                                    <label  class="">Duration Of Engagement</label>
                                       Year:
                                    <select  class="" name="engagement_year">
                                    <option value="">-- Select Year --</option>
                                    @forelse ($yearList as $val)
                                    <option value="{{$val->id}}" {{ ($val->id == $edit_record->engagement_year) ? 'selected' : ''}}>{{$val->fetch_year}}</option>
                                    @empty
                                    <option value="2025">2025</option>
                                    @endforelse
                                    </select>
                                    @error('engagement_year')
									<div class="invalid-feedback d-block">{{ $message }}</div>
									@enderror
                                       Month:
                                       <select  class="" name="engagement_month">
                                        <option value="">-- Select Month --</option>
                                        <option value="1" {{ ( '1' == $edit_record->engagement_month) ? 'selected' : ''}}>1 Month</option>
                                        <option value="2" {{ ( '2' == $edit_record->engagement_month) ? 'selected' : ''}}>2 Months</option>
                                        <option value="3" {{ ( '3' == $edit_record->engagement_month) ? 'selected' : ''}}>3 Months</option>
                                        <option value="4" {{ ( '4' == $edit_record->engagement_month) ? 'selected' : ''}}>4 Months</option>
                                        <option value="5" {{ ( '5' == $edit_record->engagement_month) ? 'selected' : ''}}>5 Months</option>
                                        <option value="6" {{ ( '6' == $edit_record->engagement_month) ? 'selected' : ''}}>6 Months</option>
                                        <option value="7" {{ ( '7' == $edit_record->engagement_month) ? 'selected' : ''}}>7 Months</option>
                                        <option value="8" {{ ( '8' == $edit_record->engagement_month) ? 'selected' : ''}}>8 Months</option>
                                        <option value="9" {{ ( '9' == $edit_record->engagement_month) ? 'selected' : ''}}>9 Months</option>
                                        <option value="10" {{ ( '10' == $edit_record->engagement_month) ? 'selected' : ''}}>10 Months</option>
                                        <option value="11" {{ ( '11' == $edit_record->engagement_month) ? 'selected' : ''}}>11 Months</option>
                                       </select>
                                       @error('engagement_month')
                                       <div class="invalid-feedback d-block">{{ $message }}</div>
                                       @enderror
                                    </div>

                                <div class="">
                                    <label class="">Post Name</label>
                                    <input class="" name="post_name" value="{{$edit_record->post_name}}" placeholder="Consultant"/>
                                    @error('post_name')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label class="">Enter specific requirement of post</label>
                                    <textarea  name="specific_requirement_of_post" rows="3" cols="3" class="" placeholder="Dictation of 10 minutes at the speed of 100 words per minute in Shorthand (English/Hindi) and transcription time (on computer only) is 50 minutes for English and 65 minutes for Hindi.">{!! $edit_record->specific_requirement_of_post !!}</textarea>
                                    @error('specific_requirement_of_post')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label  class="">Status</label>
                                    <select name="is_active" class="">
                                        <option value="1" {{ ($edit_record->is_active == '1') ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($edit_record->is_active == '0') ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    @error('is_active')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="">
                                    <label  class="">Require location preference?</label>
                                    <select class="is_location_preference" name="is_location_preference" onchange="location_preference(this.value)">
                                        <option value="1" {{ ($edit_record->is_active == '1') ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($edit_record->is_active == '0') ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    @error('is_location_preference')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="no_of_location_prefered">
                                    <label  class="">No. of location preference</label>
                                    <input class="no_of_location_input" name="no_of_location_prefered" type="number" placeholder="3"/>
                                    @error('no_of_location_prefered')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="require_location_prefered">
                                    <label  class="">Select Post Location</label>
                                    
                                    <?php
                                    echo"<pre>";
                                    print_r($edit_record->getPostLocation);
                                    ?>
                                    <select class="require_location_input" name="require_location_prefered[]" multiple="multiple">
                                        <option value="">-- Select State --</option>

                                        @forelse ($stateList as $val)
                                        <option value="{{$val->id}}">{{$val->name}}</option>
                                        @empty
                                        @endforelse
                                    </select>
                                    @error('require_location_prefered')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                                <div class="">Required Document</div>
                            </div>

                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Require 5 month salary slip? 11111</label>
                                    <select  name="required_5_month_salary_slip" class="">
                                        <option value="1" {{ ($edit_record->is_active == '1') ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($edit_record->is_active == '0') ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    @error('required_5_month_salary_slip')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label  class="">Require 10 years of share capital?</label>
                                    <select  class="" name="required_10_year_share_capital">
                                        <option value="1" {{ ($edit_record->is_active == '1') ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($edit_record->is_active == '0') ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    @error('required_10_year_share_capital')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="">
                                    <label  class="">Require bar councel registration certificate?</label>
                                    <select  class="" name="required_bar_councel_registration_certificate">
                                        <option value="1" {{ ($edit_record->is_active == '1') ? 'selected' : ''}}>Active</option>
                                        <option value="0" {{ ($edit_record->is_active == '0') ? 'selected' : ''}}>InActive</option>
                                    </select>
                                    @error('required_bar_councel_registration_certificate')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                                <div class="">Eligibility Details</div>
                            </div>

                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Age Limit</label>
                                    <div class="grid grid-cols-2 gap-[10px]">
                                        <input type="number" name="min_age_limit" value="{{$age_limit->min_age_limit}}" placeholder="18" class="">

                                        @error('min_age_limit')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror

                                        <input type="number" name="max_age_limit" value="{{$age_limit->max_age_limit}}" placeholder="60" class="">

                                        @error('max_age_limit')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="">
                                    <label  class="">Required Experience</label>
                                    <input class="" name="required_experience" placeholder="3" value="{{ $edit_record->required_experience }}"/>
                                    @error('required_experience')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label  class="">Select Desire Education</label>
                                    <select  name="desire_education[]" class="form-control desire_education" multiple="multiple">
                                    <option value="">--Select Education --</option>

                                    @forelse ($refQualification as $val)
                                    <option value="{{$val->id}}">{{$val->qualification_name}}</option>
                                    @empty
                                    @endforelse
                                    </select>
                                    @error('desire_education')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label  class="">Select Desire Course</label>
                                    <select  name="desire_course[]" class="form-control desire_course" multiple="multiple">
                                    <option value="">--Select Course --</option>
                                    @forelse ($refCourse as $val)
                                    <option value="{{$val->id}}">{{$val->course_name}}</option>
                                    @empty
                                    @endforelse
                                    </select>
                                    @error('desire_course')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="">
                                    <label  class="">Enter Eligibility Criteria</label>
                                    <textarea cols="5" rows="3" name="eligibility_criteria">{{$edit_record->eligibility_criteria}}</textarea>
                                    @error('eligibility_criteria')
                                    <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>                       
                            </div>

                        {{--<div id="m_repeater_3" class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div data-repeater-list="notes">
                                    <div data-repeater-item>
                                        <label  class="">Note/Instruction</label>
                                        <div class="col-xxl-10 col-xl-8 col-md-8">
                                            <div class="row mb-3">
                                                <div class="col-md-10 mb-2">
                                                    <textarea name="note_instruction" class="form-control" placeholder="Description" rows="2"></textarea>
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
                   
                            <button class="hover-effect-btn fill_btn" type="submit">
                                Submit
                            </button>
                                <!-- Main modal -->
                                <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-xl max-h-full">
                                        <!-- Modal content -->
                                        <div class="relative bg-white rounded-[20px] py-[20px]">
                                            <!-- Modal header -->
                                            <div class="flex items-center justify-between pr-[10px]">
                                                <button type="button"
                                                    class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                    data-modal-hide="static-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <div class="modal_body_cust">
                                                <img src="../../assets/images/check-1.png" alt="popupimage">
                                                <p>Advertisement Id</p>
                                                <h4>1254785554</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div id="News" class="tabcontent">
                        <form class="form_grid_cus">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                                <div class="">
                                    <label  class="">Select Year</label>
                                    <select  class="">

                                        <option>2025</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label  class="">Select advertisement</label>
                                    <select  class="" name>
                                        <option>10-01-2025 - Applications invited in On-line mode for the posts of Associate and Consultant on private entities in NHIDCL</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="table_over mt-4">
                            <h4>Post Details</h4>
                            <table class="cust_table__ table_sparated" id="post_list">
                                <thead class="">
                                    <tr>
                                        <th scope="col">
                                            #
                                        </th>
                                        <th scope="col">
                                            Post name
                                        </th>
                                        <th scope="col">
                                            Post Created Date
                                        </th>
                                        <th scope="col">
                                            Post Created By
                                        </th>
                                        <th scope="col">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                            {{--<tbody class="">
                                @forelse ($postList as $value)
                                <tr>
                                    <td>
                                        1
                                    </td>
                                    <td>
                                        {{$value->post_name}}
                                    </td>
                                    <td>
                                        {{$value->created_at}}
                                    </td>
                                    <td>
                                        {{$value->created_by}}
                                    </td>
                                    <td>
                                        <button>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                            stroke="currentColor" class="size-4">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </button>
                                    </td>
                                </tr>
                                @empty
                                    
                                @endforelse
                                  
                                </tbody>--}}
                            </table>
                        </div>
                        <div class="pagination_cust">
                            <span>01 to 10 of 50 Items</span>
                            <nav aria-label="Page navigation example">
                                <ul class="cust-pagination">
                                    <li>
                                        <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-left"
                                                aria-hidden="true"></i></a>
                                    </li>
                                    <li>
                                        <a href="#" class="cust-pagination-link">1</a>
                                    </li>
                                    <li>
                                        <a href="#" class="cust-pagination-link">2</a>
                                    </li>
                                    <li>
                                        <a href="#" class="cust-pagination-link">3</a>
                                    </li>
                                    <li>
                                        <a href="#" class="cust-pagination-link"><i class="fa fa-arrow-right"
                                                aria-hidden="true"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
</div>
@endsection

@section('scripts')

<script>
$(document).ready(function() {
    $(".require_location_input").select2();
    $(".desire_education").select2();
    $(".desire_course").select2();


var table = $('#post_list').DataTable({
    processing: true,
    serverSide: true,
    responsive: true,
    ajax:{
        url:"{{ route('recruitment-portal.post.index') }}",
        data: function (d) {
            d.status = $('.filter_status').val(),
            d.search = $('input[type="search"]').val()
        }
    },
    columns: [
    {data: 'DT_RowIndex', name:'DT_RowIndex', orderable: false, searchable: false},
    {data: 'post_name', name: 'post_name'},
    {data: 'created_at', name: 'created_at'},
    {data: 'created_by', name: 'created_by'},
    {data: 'action', name: 'action', orderable: false, searchable: false},
    ]
});
});

$('#m_repeater_3').repeater({
        initEmpty: false,
        isFirstItemUndeletable: true,
        show: function() {
        $(this).slideDown();
        },
        });

</script>

    <script src="{{ asset('js/chart-loader.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script type="text/javascript" src="{{ asset('vendor/jsvalidation/js/jsvalidation.js')}}"></script>
    {!! JsValidator::formRequest('App\Http\Requests\Recruitment\AdvertisementPostRequest', '.recruitmentPostForm'); !!}

    <script>
        const select = document.getElementById('adYear');
        const currentYear = new Date().getFullYear();

        for (let year = currentYear; year >= 2022; year--) {
            let option = document.createElement('option');
            option.value = year;
            option.text = year;
            select.appendChild(option);
        }

        function getAdvertisement(year) {
        let url = @json(route('recruitment.getAdvertisement'));
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        url: url,
        method: 'POST',
        data: { year: year },
        success: function(response) {
            $(".advertisement_data").html(response);
        }
        });
        }
        // $(".is_location_preference").on('change',function(){
        //     alert();
        // })
        // $(".is_location_preference").on('change', function() {
        //   alert("Location preference changed!");
        // });
    </script>

    <script>
        async function getAdvertisementList(year) {
            const select = document.getElementById('advertisementId');
        }

        function getAdvertisementList(year) {
            const advertisementSelect = document.getElementById('advertisementId');
            if (year) {
                advertisementSelect.innerHTML = '<option value="">Loading...</option>';

                setTimeout(() => {
                    // Simulated response based on the selected year
                    const advertisements = (year === "2024") ? [{
                            id: 1,
                            name: `Ad 1 - Year ${year}`
                        },
                        {
                            id: 2,
                            name: `Ad 2 - Year ${year}`
                        },
                        {
                            id: 3,
                            name: `Ad 3 - Year ${year}`
                        }
                    ] : []; // No ads for other years


                    if (advertisements.length > 0) {
                        // Clear the dropdown before populating
                        advertisementSelect.innerHTML = '<option value="">Select</option>';
                        advertisements.forEach(ad => {
                            const option = document.createElement('option');
                            option.value = ad.id;
                            option.text = ad.name;
                            advertisementSelect.appendChild(option);
                        });
                    } else {
                        // Clear the dropdown before populating
                        advertisementSelect.innerHTML = '<option value="">No data found</option>';
                    }
                }, 1000); // Simulate a 1 second delay for data fetching
            } else {
                advertisementSelect.innerHTML = '<option value="">Select</option>';
            }
        }

        document.getElementById('adYear').addEventListener('change', function() {
            const selectedYear = this.value;
            getAdvertisementList(selectedYear);
        });

        function location_preference(val){
      
        if(val == 'N'){
        $(".no_of_location_prefered").hide();
        $(".require_location_prefered").hide();

        $(".no_of_location_input").attr("disabled","disabled");
        $(".require_location_input").attr("disabled","disabled");
        
        }else{
        $(".no_of_location_prefered").show();
        $(".require_location_prefered").show();
        
        $(".no_of_location_input").removeAttr("disabled");
        $(".require_location_input").removeAttr("disabled");

        }
        }
    </script>
@endsection
