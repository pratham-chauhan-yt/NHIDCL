@extends('layouts.dashboard')

@section('dashboard_content')

<div class="container-fluid md:p-0">
    <div class="top_heading_dash__">
        <div class="main_hed">Edit/Advertisement</div>
        <div class="plain_dlfex bg_elips_ic">
        <a href="{{ route('recruitment.advertisementList') }}"><button class="hover-effect-btn fill_btn" type="button">Back
        </button></a>
        </div>
    </div>
</div>

<div class="inner_page_dash__">

        @if (count($errors) > 0)

        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        @endif

                <div class="my-4 ">
                    <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            Edit/Advertisement
                        </button>
                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                            <div class="">Edit/Advertisement Details</div>
                        </div>

                        {!! Form::open([
                            'route' => 'recruitment.updateAdvertisement',
                            'method' => 'POST',
                        ]) !!}

                        <!-- <form class="form_grid_cust" method="POST" action="recruitment.updateAdvertisement"> -->

                        <div class="inpus_cust_cs form_grid_dashboard_cust_">

                            <div>
                                <label  class="">Advertisement Title</label>
                                <input type="text" class="" name="advertisement_title" value="{{$AdvertisementList->advertisement_title}}" required="true" />
                                <input type="hidden" class="form-control" name="id" id="id" value="{{ $AdvertisementList->id }}">
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

                            <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="submit">Update</button>
                            </div>
                        <!-- </form> -->
                        {!! Form::close() !!}
                    </div>

                </div>
</div>

@endsection