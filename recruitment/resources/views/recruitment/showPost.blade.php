@extends('layouts.dashboard')
@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Show/Advertisement</div>
        <div class="plain_dlfex bg_elips_ic">
            <select>
                <option value="Today">19-12-2024</option>
            </select>
        </div>
    </div>
</div>

<div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            Add Post in Advertisement
                        </button>
                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Show Post</div>
                        </div>
                        <form class="form_grid_cust" method="POST" action="{{route('recruitment.postStore')}}" id="PostDetails">
                        @csrf
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">

                                <div class="">
                                    <label class="">Advertisement Year</label>
                                    <select class="" name="advertisement_year" class="form-select" id="advertisement_year">
                                        <option value="2025">2025</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label class="">Advertisement</label>
                                    <select class="" name="advertisement" class="form-select" id="advertisement">
                                        <option value="Advertisement Title2">Advertisement Title2</option>
                                        <option value="Advertisement Title5">Advertisement Title5</option>
                                    </select>
                                </div>

                                <div>
                                    <label  class="">Post Name</label>
                                    <textarea  rows="2" class="" name="post_name" id="post_name" value="{{ old('post_name') }}" required="true"></textarea>
                                </div>

                                <div>
                                    <label  class="">Post Requirement</label>
                                    <input type="text" class="" name="post_requirement" id="post_requirement" value="{{ old('post_requirement') }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Minimum Age</label>
                                    <input type="number" class="" min="16" max="65" name="minimum_age" id="minimum_age" value="{{ old('minimum_age') }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Required Experience</label>
                                    <input type="number" class="" max="50" name="required_experience" id="required_experience" value="{{ old('required_experience') }}" required="true" />
                                </div>

                                <div>
                                    <label  class="">Required Experience Details</label>
                                    <textarea  rows="2" class="" name="required_experience_details" value="{{ old('required_experience_details') }}" required="true"></textarea>
                                </div>

                                <div>
                                    <label  class="">Post Eligibility</label>
                                    <textarea  rows="2" class="" name="post_eligibility" value="{{ old('post_eligibility') }}" required="true"></textarea>
                                </div>

                            </div>

                            <!-- <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="submit" id="submitButton">Submit
                                </button>
                            </div> -->
                        </form>
                    </div>

        </div>
</div>

@endsection

@push('scripts')
    <script src="{{ asset('js/chart-loader.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

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

<script type="text/javascript">
$(document).ready(function () {
            $("#PostDetails input").prop("disabled", true);
            $("#PostDetails textarea").prop("disabled", true);
        });
    </script>

@endpush
