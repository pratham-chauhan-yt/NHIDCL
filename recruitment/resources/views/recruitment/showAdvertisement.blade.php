@extends('layouts.dashboard')

@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Advertisement</div>
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
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            Show Advertisement
                        </button>
                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Show advertisement</div>
                        </div>
                        <form class="form_grid_cust" method="POST" action="{{route('recruitment.advertisementStore')}}" id="AdvertisementDetails">
                        @csrf
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">

                                <div>
                                    <label  class="">Advertisement Title</label>
                                    <input type="text" class="" name="advertisement_title" value="{{$AdvertisementList->advertisement_title}}" required="true" />
                                </div>

                                <div>
                                    <label  class="">As on date</label>
                                    <input type="date"  name="as_on_date" value="{{$AdvertisementList->as_on_date}}" required="true"/>
                                </div>

                                <div>
                                    <label  class="">Expiry Date and Time</label>
                                    <input type="date"  name="expire_date_and_time" value="{{$AdvertisementList->expire_date_and_time}}" required="true"/>
                                </div>

                                <div>
                                    <label  class="">Note</label>
                                    <textarea  rows="2" class="" name="note" value="{{$AdvertisementList->note}}" required="true"></textarea>
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
    <script type="text/javascript">
$(document).ready(function () {
            $("#AdvertisementDetails input").prop("disabled", true);
            $("#AdvertisementDetails textarea").prop("disabled", true);
        });
    </script>
@endpush
