@extends('layouts.dashboard')
@section('dashboard_content')
<div class="container-fluid md:p-0">
                <div class="top_heading_dash__">
                    <div class="main_hed">Advertisement</div>
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
                        <button class="tablink" onclick="openPage('Post', this, '#373737')" id="defaultOpen">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>

                            Create Post
                        </button>
                        <button class="tablink" onclick="openPage('News', this, '#373737')">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            Post Details
                        </button>
                    </div>

                    <div id="Post" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Post Details</div>
                        </div>

                        <form class="form_grid_cust" method="POST" action="{{route('recruitment.postStore')}}">
                            @csrf
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
                                </div>
                            </div>
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Year</label>
                                    <select  class="" name="advertisement_year">
                                        <option>2025</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Select Advertisement</label>
                                    <select  class="" name="advertisement_slug">
                                        <option>10-01-2025 - Applications invited in On-line mode for the posts of Associate and Consultant on private entities in NHIDCL</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Duration Of Engagement</label>
                                   Year:  <input type="number" name="year" class="" placeholder="Year"/>
                                   Month: <input type="number" name="month" class="" placeholder="Month"/>
                                </div>

                                <div class="">
                                    <label  class="">Post Name</label>
                                    <input class="" name="post_name" placeholder="Consultant"/>
                                </div>

                                <div class="">
                                    <label  class="">Enter specific requirement of post</label>
                                    <textarea  name="specific_requirement_of_post" rows="1" class="" placeholder="Dictation of 10 minutes at the speed of 100 words per minute in Shorthand (English/Hindi) and transcription time (on computer only) is 50 minutes for English and 65 minutes for Hindi."></textarea>
                                </div>

                                <div class="">
                                    <label  class="">Status</label>
                                    <select name="is_active" class="">
                                        <option value="Y">Active</option>
                                        <option value="N">InActive</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Require location preference?</label>
                                    <select  class="" name="require_location_prefered">
                                        <option value="Y">Yes</option>
                                        <option value="N">No</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">No. of location preference</label>
                                    <input name="no_of_location_prefered" type="number" class="" placeholder="3"/>
                                </div>

                                <div class="">
                                    <label  class="">Select Post Location</label>
                                    <input class="" placeholder="Delhi, Jammu, Andaman & Nicobar, Assam +5"/>
                                </div>
                            </div>

                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                                <div class="">Required Document</div>
                            </div>

                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Require 5 month salary slip?</label>
                                    <select  name="is_5_month_salary_slip" class="">
                                        <option>Yes</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label  class="">Require 10 years of share capital?</label>
                                    <select  class="">

                                        <option>Yes</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label  class="">Require bar councel registration certificate?</label>
                                    <select  class="">

                                        <option>No</option>
                                    </select>
                                </div>
                            </div>


                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-5">
                                <div class="">Eligibility Details</div>
                            </div>
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Age Limit</label>
                                    <div class="grid grid-cols-2 gap-[10px]">
                                        <input type="number" placeholder="16" class="">
                                        <input type="number" placeholder="62" class="">
                                    </div>
                                </div>
                                <div class="">
                                    <label  class="">Required Experience</label>
                                    <input class="" placeholder="3"/>
                                </div>
                                <div class="">
                                    <label  class="">Desirable Experience</label>
                                    <input class="" placeholder="5"/>
                                </div>

                                {{--<div class="">
                                    <label  class="">Eligibility Criteria</label>
                                    <textarea  rows="2" class="" placeholder="Holding analogous post on regular basis in the pay Level-8 (pre revised PB-2(Rs.9300-34,800) with Grade Pay of Rs.4800/-) in CDA pattern or equivalent in IDA pattern in the parent cadre/department."></textarea>
                                </div>--}}


                            </div>
                            <div id="m_repeater_3" class="inpus_cust_cs form_grid_dashboard_cust_">
                                    <div data-repeater-list="note">
                                        <div data-repeater-item>

                                            <label  class="">Note/Instruction</label>
                                            <div class="col-xxl-10 col-xl-8 col-md-8">
                                                <div class="row mb-3">
                                                    <div class="col-md-10 mb-2">
                                                        <textarea name="description" class="form-control" value="{{ old('notes') }}" placeholder="Description" rows="2" required=""></textarea>
                                                    </div>
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
                            </div>
                            <div class="button_flex_cust_form">
                            {{--<button class="hover-effect-btn border_btn">Add More Eligibility Criteria</button>--}}

                                <!-- Modal toggle -->
                                <button data-modal-target="static-modal" data-modal-toggle="static-modal"
                                    class="hover-effect-btn fill_btn" type="button">
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
                                    <select  class="">

                                        <option>10-01-2025 - Applications invited in On-line mode for the posts of Associate and Consultant on private entities in NHIDCL</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <div class="table_over mt-4">
                            <h4>Post Details</h4>
                            <table class="cust_table__ table_sparated">
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
                                <tbody class="">
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
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
                                    <tr>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            4
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            5
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            6
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            8
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            9
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            10
                                        </td>
                                        <td>
                                            Associate
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            XYZ
                                        </td>
                                        <td>
                                            <button> <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" class="size-4">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                            </svg> </button>
                                        </td>
                                    </tr>
                                </tbody>
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

@push('scripts')

<script>
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
    <script>
        const select = document.getElementById('adYear');
        const currentYear = new Date().getFullYear();

        for (let year = currentYear; year >= 2022; year--) {
            let option = document.createElement('option');
            option.value = year;
            option.text = year;
            select.appendChild(option);
        }



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
    </script>
@endpush
