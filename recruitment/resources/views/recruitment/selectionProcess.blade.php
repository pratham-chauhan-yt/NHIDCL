@extends('layouts.dashboard')
@section('dashboard_content')

    <div class="container-fluid md:p-0">
        <div class="top_heading_dash__">
            <div class="main_hed">Selection Process</div>
        </div>
    </div>

    <div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c">
                        <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            Candidate Shortlist
                        </button>
                        <button class="tablink" onclick="openPage('News', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.125 2.25h-4.5c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125v-9M10.125 2.25h.375a9 9 0 0 1 9 9v.375M10.125 2.25A3.375 3.375 0 0 1 13.5 5.625v1.5c0 .621.504 1.125 1.125 1.125h1.5a3.375 3.375 0 0 1 3.375 3.375M9 15l2.25 2.25L15 12" />
                            </svg>
                            Candidate Assessment
                        </button>
                        <button class="tablink" onclick="openPage('Contact', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M18 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0ZM3 19.235v-.11a6.375 6.375 0 0 1 12.75 0v.109A12.318 12.318 0 0 1 9.374 21c-2.331 0-4.512-.645-6.374-1.766Z" />
                            </svg>
                            Candidate Selection
                        </button>
                    </div>


                    <div id="Home" class="tabcontent">
                        <form class="form_grid_cus">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_ items-end">
                                <div class="">
                                    <label  class="">Select requisition ID</label>
                                    <select  class="">

                                        <option>Select requisition ID</option>
                                    </select>
                                </div>
                                <button class="hover-effect-btn border_btn h-fit w-fit" type="button"> Generate
                                    candidate list </button>
                            </div>

                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col">
                                            S.No.
                                        </th>
                                        <th scope="col">
                                            Profile ID
                                        </th>
                                        <th scope="col">
                                            Candidate name
                                        </th>
                                        <th scope="col">
                                            Status
                                        </th>
                                        <th scope="col">
                                            View
                                        </th>
                                        <th scope="col">
                                            Select
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Comment box</label>
                                    <textarea  rows="1" class="" placeholder="Add your comment"></textarea>

                                </div>
                                <div class="">
                                    <label  class="">Upload for efile noting</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class=""
                                            placeholder="Upload documents" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" >

                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="button_flex_cust_form">

                            <!-- Modal toggle -->
                            <button data-modal-target="static-modal2" data-modal-toggle="static-modal2"
                                class="hover-effect-btn border_btn" type="button">
                                Save shortlist
                            </button>
                            <button class="hover-effect-btn gray_btn">Generate Shortlist</button>
                            <!-- Main modal -->
                            <div id="static-modal2" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto bg-[#0000006b] overflow-x-hidden fixed top-0 right-0 left-0 z-80 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-[20px] py-[20px]">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between pr-[10px]">
                                            <button type="button"
                                                class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="static-modal2">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal_body_cust">
                                            <img src="{{asset('/images/check-1.png')}}" alt="popupimage">
                                            <p>Shortlist Code</p>
                                            <h4>1254785554</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div id="News" class="tabcontent">
                        <form class=" ">
                            <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Select shortlist code</label>
                                    <select  class="">

                                        <option>Select shortlist code</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col">
                                            S.No.
                                        </th>
                                        <th scope="col">
                                            Profile ID
                                        </th>
                                        <th scope="col">
                                            Candidate name
                                        </th>
                                        <th scope="col">
                                            Status
                                        </th>
                                        <th scope="col">
                                            View
                                        </th>
                                        <th scope="col">
                                            Select
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="flex items-center">
                                                <input type="checkbox" value="" class="">
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Schedule assessment</label>
                                    <div class="custom_check_inline-container">
                                        <div class="custom_check_inline-item">
                                            <input id="exam-checkbox" type="checkbox" value=""
                                                class="custom_check_inline-checkbox">
                                            <label for="exam-checkbox" class="custom_check_inline-label">Exam</label>
                                        </div>
                                        <div class="custom_check_inline-item">
                                            <input id="interview-checkbox" type="checkbox" value=""
                                                class="custom_check_inline-checkbox">
                                            <label for="interview-checkbox"
                                                class="custom_check_inline-label">Interview</label>
                                        </div>
                                    </div>

                                </div>
                                <div class="">
                                    <label  class="">Comment box</label>
                                    <textarea  rows="1" class="" placeholder="Add your comment"></textarea>

                                </div>

                            </div>

                        </form>
                        <div class="button_flex_cust_form">

                            <!-- Modal toggle -->
                            <button data-modal-target="static-modal3" data-modal-toggle="static-modal3"
                                class="hover-effect-btn border_btn" type="button">
                                Generate assessment batch
                            </button>
                            <!-- Main modal -->
                            <div id="static-modal3" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-[20px] py-[20px]">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between pr-[10px]">
                                            <button type="button"
                                                class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="static-modal3">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg>
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        <div class="modal_body_cust">
                                            <img src="{{asset('/images/check-1.png')}}" alt="popupimage">
                                            <p>Your Batch Code is</p>
                                            <h4>1254785554</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="Contact" class="tabcontent">
                        <form class=" ">
                            <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Select assessment batch code</label>
                                    <select  class="">

                                        <option>Select assessment batch code</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col">
                                            S.No.
                                        </th>
                                        <th scope="col">
                                            Profile ID
                                        </th>
                                        <th scope="col">
                                            Candidate name
                                        </th>
                                        <th scope="col">
                                            Status
                                        </th>
                                        <th scope="col">
                                            View
                                        </th>
                                        <th scope="col">
                                            Select
                                        </th>
                                        <th scope="col">
                                            Upload Offer Latter
                                        </th>
                                        <th scope="col">
                                            Date of Joining
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="">
                                                <select  class="">
                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#"> <svg fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            2
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="">
                                                <select  class="">

                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#"> <svg fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Name here
                                        </td>
                                        <td>
                                            Engaged
                                        </td>
                                        <td>
                                            <a href="#"> <i class="fa fa-eye " aria-hidden="true"></i></a>
                                        </td>
                                        <td>
                                            <div class="">
                                                <select  class="">

                                                    <option>Select</option>
                                                </select>
                                            </div>
                                        </td>
                                        <td>
                                            <a href="#"> <svg fill="none" viewBox="0 0 24 24"
                                                    stroke-width="1.5" stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" />
                                                </svg>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#"><svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Comment box</label>
                                    <textarea  rows="1" class="" placeholder="Add your comment"></textarea>

                                </div>
                                <div class="">
                                    <label  class="">Upload for efile noting</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class=""
                                            placeholder="Upload documents" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" >

                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="button_flex_cust_form">

                            <!-- Modal toggle -->
                            <button data-modal-target="static-modal4" data-modal-toggle="static-modal4"
                                class="hover-effect-btn border_btn" type="button">
                                Generate candidate selection list
                            </button>

                            <!-- Main modal -->
                            <div id="static-modal4" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto bg-[#00000057] overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                <div class="relative p-4 w-full max-w-xl max-h-full">
                                    <!-- Modal content -->
                                    <div class="relative bg-white rounded-[20px] py-[20px]">
                                        <!-- Modal header -->
                                        <div class="flex items-center justify-between pr-[10px]">
                                            <button type="button"
                                                class="text-[#1C274C] bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center "
                                                data-modal-hide="static-modal4">
                                                <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 14 14">
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
                                            <p>Selection List code</p>
                                            <h4>1254785554</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

@endsection