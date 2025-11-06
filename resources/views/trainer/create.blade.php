@extends('layouts.dashboard')
@php
    use App\Models\{DepartmentMaster, DesignationMaster};
@endphp

@section('dashboard_content')
    <section class="home-section ">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Advertisement</div>
                <div class="plain_dlfex bg_elips_ic">
                    <select>
                        <option value="today">{{ date('d-m-Y') }}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4 ">
                <div id="Home" class="tabcontent">
                    <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                        <div class="">Details of the Attendees</div>
                    </div>

                    <form class="form_grid_cust" id="add-trainer" action="{{ route('trainer.store') }}" method="POST">
                        @csrf
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                            <div class="">
                                <label class="required-label">Name</label>
                                <input type="text" name="attendee_name" class="" placeholder=" Name">
                            </div>
                            <div class="">
                                <label for="prof" class="required-label">Email Address</label>
                                <input type="email" name="attendee_email" class="" placeholder="Email Address">
                            </div>
                            <div class="">
                                <label class="required-label">Contact Number</label>
                                <input type="text" name="attendee_contact" class="" placeholder="Contact Number">
                            </div>
                            <div class="">
                                <label class="required-label">Profile Picture</label>
                                <input type="upload" name="attendee_profile_picture" class=""
                                    placeholder="Profile Picture">
                            </div>
                            <div class="">
                                <label class="required-label">Organization/Company Name</label>
                                <input type="text" name="attendee_company" class=""
                                    placeholder="Organization/Company Name">
                            </div>
                            <div class="">
                                <label class="required-label">Role/Position</label>
                                <div class="grid grid-cols-2 gap-[10px]">
                                    <input type="text" name="attendee_role" class="">
                                </div>
                            </div>
                            <div class="">
                                <label class="required-label">Check-in time</label>
                                <div class="grid grid-cols-2 gap-[10px]">
                                    <input type="text" name="checkin_time" class="">
                                </div>
                            </div>
                            <div class="">
                                <label class="required-label">Check-out time</label>
                                <div class="grid grid-cols-2 gap-[10px]">
                                    <input type="text" name="checkout_time" class="">
                                </div>
                            </div>
                        </div>
                        <br>

                        <div id="Home" class="tabcontent">
                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                                <div class="">Trainer Profile details</div>
                            </div>

                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="required-label">Trainer Name</label>
                                    <input type="text" name="trainer_name" class="" placeholder=" Trainer Name">
                                </div>
                                <div class="">
                                    <label for="prof" class="required-label">Trainer Designation</label>
                                    <input type="text" name="trainer_designation" class=""
                                        placeholder="Trainer Designation">
                                </div>
                                <div class="">
                                    <label class="required-label">Contact Number</label>
                                    <input type="text" name="trainer_contact" class=""
                                        placeholder="Contact Number">
                                </div>
                                <div class="">
                                    <label class="required-label">Trainer Qualification</label>
                                    <input type="text" name="trainer_qualification" class=""
                                        placeholder="Trainer Qualification">
                                </div>
                                <div class="">
                                    <label class="required-label">Trainer Time Availability</label>
                                    <input type="text" name="trainer_time_availability" class=""
                                        placeholder="Trainer Time Availability">
                                </div>
                            </div>
                            <br>
                        </div>


                        <div id="Home" class="tabcontent">
                            <div class="parrent_dahboard_ chart_c inner_body_style inner_pages mt-0">
                                <div class="">Training Session Detail</div>
                            </div>


                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="required-label">Training Session Name</label>
                                    <input type="text" name="session_name" class=""
                                        placeholder="Training Session Name">
                                </div>
                                <div class="">
                                    <label for="prof" class="required-label">Training Session Date(s)</label>
                                    <input type="text" name="session_date" class=""
                                        placeholder="Training Session Date(s)">
                                </div>
                                <div class="">
                                    <label class="required-label">Location (if applicable)</label>
                                    <input type="text" name="location" class="" placeholder="Location">
                                </div>
                                <div class="">
                                    <label class="required-label">Session Agenda/Schedule</label>
                                    <input type="text" name="session_agenda" class=""
                                        placeholder="Session Agenda/Schedule">
                                </div>
                                <div class="">
                                    <label class="required-label">Session/Workshop Registration</label>
                                    <input type="text" name="session_registration" class=""
                                        placeholder="Session/Workshop Registration">
                                </div>
                                <div class="">
                                    <label class="required-label">Status</label>
                                    <input type="text" name="status" class="" placeholder="Status">
                                </div>
                                <div class="">
                                    <label class="required-label">Cost Details (If Any)</label>
                                    <input type="number" name="cost_details" class=""
                                        placeholder="Cost Details (If Any)">
                                </div>
                                <div class="">
                                    <label class="required-label">Training Material</label>
                                    <input type="text" name="training_material" class=""
                                        placeholder="Training Material">
                                </div>
                                <div class="">
                                    <label class="required-label">Upcoming Training Session Details for Trainer</label>
                                    <input type="text" name="upcoming_training" class=""
                                        placeholder="Upcoming Training Session Details for Trainer">
                                </div>
                            </div>
                            <br>

                            <div class="button_flex_cust_form">
                                <!-- Modal toggle -->
                                {{-- <button data-modal-target="static-modal" data-modal-toggle="static-modal" --}}
                                <button type="submit" class="hover-effect-btn fill_btn">Submit</button>


                                <!-- Main modal -->
                                {{-- <div id="static-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                    class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                    <div class="relative p-4 w-full max-w-xl max-h-full">
                                        <div class="relative bg-white rounded-[20px] py-[20px]">
                                            <div class="flex items-center justify-between pr-[10px]">
                                                <button type="button"
                                                    class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                    data-modal-hide="static-modal">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div class="modal_body_cust">
                                                <img src="../../assets/images/check-1.png" alt="popupimage">
                                                <p>Requisition Id</p>
                                                <h4>1254785554</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection


@push('scripts')
    <script src="{{ asset('public/js/validate-method.js') }}"></script>

    <script src="{{ asset('/public/validation/trainer.js') }}"></script>
@endpush
