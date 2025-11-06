@include('layouts.app')

<body class="dashboard_bg_body">
    <!-- top header  -->
    <header>
        <div class="header_parent_cust">
            <div class="container-fluid main_header">
                <div class="logo_cust logo_cust">
                    <a href="#"> <img class="" src="{{asset('public/images/logo.png')}}" alt="logo"></a>
                    <div class="logo_content ">
                        <h4 class="">Task Managemnet System</h4>
                        <p class="">National Highways & Infrastructure Development
                            Corporation
                            Ltd.
                        </p>
                    </div>
                    <div class="logo-details">
                        <!-- Icon and logo name -->
                        <i class='fa fa-bars' id="btn"></i>
                        <!-- Menu button to toggle sidebar -->
                    </div>
                </div>

                <div class="cust_notif_prf_">

                    <div class="drop_profile_bg" id="dropdownAvatarNameButton" data-dropdown-toggle="notification">
                            <a href="{{ route('notifications.all') }}" class="">
                            <button type="button" class="notification-cust">
                                <i class="fa fa-bell"></i>
                                <div class="notification-badge" id="new-notifications-coun">10</div>
                            </button>
                            </a>
                    </div>

                    <div class="drop_profile_bg" id="dropdownAvatarNameButton" data-dropdown-toggle="dropdownAvatarName">
                        <button class="" type="button">
                            <img class="" src="{{asset('public/images/banner-login.png')}}" alt="user photo">
                        </button>
                        <a class="drop_cont_cust">
                            Technical Director
                            <span class="">profile</span>
                        </a>
                        <!-- Dropdown menu -->
                        <div id="dropdownAvatarName" class="z-10 hidden divide-y divide-gray-100 shadow-xl w-44  ">
                            <ul class="after_dropdown">
                                <!-- <li>
                                    <a href="./dashboard.html" class="">Dashboard</a>
                                </li> -->
                                <li> <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Logout</a>
                                    <form id="logout-form" class="d-none" action="{{ url('/logout') }}" method="POST">
                                        {{ csrf_field() }}
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </header>
    <!-- Edn top header  -->

    <!-- sidebar  -->
    <div class="main-container flex overflow-hidden bg_main_dash">
        <!-- Sidebar for navigation -->

        <div class="sidebar">
            <ul class="nav-list">
                <!-- List of navigation items -->
                <li class="menu-item active">
                    <a href="./dashboard.html">
                        <img src="{{asset('public/images/dashboard.svg')}}" alt="dashboard.png">
                        <span class="links_name">Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('task-management.get_create_task')}}">
                        <img src="{{asset('public/images/status.svg')}}" alt="bank">
                        <span class="links_name">Create Task</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('task-management.get_task_list')}}">
                        <img src="{{asset('public/images/MDI-information-outline.svg')}}" alt="bank">
                        <span class="links_name">Task List</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('task-management.get_assign_task')}}">
                        <img src="{{asset('public/images/MDI-information-outline.svg')}}" alt="bank">
                        <span class="links_name">Assign Task</span>
                    </a>
                </li>

            </ul>
        </div>

        <!-- Main content area -->
         <section class="home-section ">
            <div class="container-fluid md:p-0">
                <div class="top_heading_dash__">
                    <div class="main_hed">Create Task</div>
                </div>
            </div>
            <div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c mb-[20px]">
                        <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8.25 7.5V6.108c0-1.135.845-2.098 1.976-2.192.373-.03.748-.057 1.123-.08M15.75 18H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08M15.75 18.75v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5A3.375 3.375 0 0 0 6.375 7.5H5.25m11.9-3.664A2.251 2.251 0 0 0 15 2.25h-1.5a2.251 2.251 0 0 0-2.15 1.586m5.8 0c.065.21.1.433.1.664v.75h-6V4.5c0-.231.035-.454.1-.664M6.75 7.5H4.875c-.621 0-1.125.504-1.125 1.125v12c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V16.5a9 9 0 0 0-9-9Z" />
                            </svg>
                            Task Details
                        </button>

                        <!-- <button class="tablink" onclick="openPage('News', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
                            </svg>
                            Education Details
                        </button> -->

                        <!-- <button class="tablink" onclick="openPage('work', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M20.25 14.15v4.25c0 1.094-.787 2.036-1.872 2.18-2.087.277-4.216.42-6.378.42s-4.291-.143-6.378-.42c-1.085-.144-1.872-1.086-1.872-2.18v-4.25m16.5 0a2.18 2.18 0 0 0 .75-1.661V8.706c0-1.081-.768-2.015-1.837-2.175a48.114 48.114 0 0 0-3.413-.387m4.5 8.006c-.194.165-.42.295-.673.38A23.978 23.978 0 0 1 12 15.75c-2.648 0-5.195-.429-7.577-1.22a2.016 2.016 0 0 1-.673-.38m0 0A2.18 2.18 0 0 1 3 12.489V8.706c0-1.081.768-2.015 1.837-2.175a48.111 48.111 0 0 1 3.413-.387m7.5 0V5.25A2.25 2.25 0 0 0 13.5 3h-3a2.25 2.25 0 0 0-2.25 2.25v.894m7.5 0a48.667 48.667 0 0 0-7.5 0M12 12.75h.008v.008H12v-.008Z" />
                            </svg>
                            Work Experience Details
                        </button> -->

                        <button class="tablink" onclick="openPage('additional', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                            </svg>
                            Additional Details
                        </button>

                        <button class="tablink" onclick="openPage('application', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m5.231 13.481L15 17.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v16.5c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Zm3.75 11.625a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                            </svg>
                            Application Preview
                        </button>
                        
                    </div>


                    <div id="Home" class="tabcontent">
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="">Task Name</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label class="">Bucket</label>
                                    <select class="">
                                        <option>Technical</option>
                                        <option>Non-Technical</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Division</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label  class="">Task Owner Name</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label  class="">Designation</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label class="">Progress</label>
                                    <select class=""> 
                                        <option>Not Started</option>
                                        <option>In Progress</option>
                                        <option>Completed</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label class="">Priority</label>
                                    <select class=""> 
                                        <option>Urgent</option>
                                        <option>Important</option>
                                        <option>Medium</option>
                                        <option>Low</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Start Date</label>
                                    <input type="date"  class="">
                                </div>

                                <div class="">
                                    <label  class="">Due Date</label>
                                    <input type="date"  class="">
                                </div>

                                <div class="">
                                    <label class="">Repeat</label>
                                    <select class=""> 
                                        <option>Daily</option>
                                        <option>Weekday</option>
                                        <option>Weekly</option>
                                        <option>Monthly</option>
                                        <option>Yearly</option>
                                        <option>Custom</option>
                                    </select>
                                </div>

                                <div class="">
                                    <label  class="">Note</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label  class="">Upload Attachment</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class=""
                                            placeholder="Upload Photos" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" >
                                        </label>
                                    </div>
                                </div>

                                <div class="">
                                    <label  class="">Team Creation</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label  class="">Milestone Creation</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label  class="">Milestone Weight Age</label>
                                    <input type="text" class="">
                                </div>

                                <div class="">
                                    <label class="">Sourse Of the Task</label>
                                    <select class=""> 
                                        <option>EMail</option>
                                        <option>EFile</option>
                                        <option>DO</option>
                                        <option>IOM</option>
                                        <option>Letter</option>
                                        <option>Others</option>
                                    </select>
                                </div>

                            </div>

                            <div class="button_flex_cust_form">
                                <button class="hover-effect-btn fill_btn" type="button">
                                    Save & Next
                                </button>
                            </div>
                        </form>

                    </div>

                    <div id="additional" class="tabcontent">
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label  class="">Division Name</label>
                                    <input type="text" class=""
                                        placeholder="Division Name">
                                </div>

                                <div class="">
                                    <label  class="">Division Details</label>
                                    <textarea  rows="1" class="" placeholder="Division Details"></textarea>

                                </div>

                                <div class="">
                                    <label  class="">Division Certificate</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class=""
                                            placeholder="Upload Certificate" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" >

                                        </label>
                                    </div>
                                </div>
                                <div class="">
                                    <label  class="">Attachments</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class=""
                                            placeholder="Upload Attachments" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input  type="file" class="hidden" >

                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="button_flex_cust_form">

                                <button class="hover-effect-btn border_btn
                                    ">Add</button>
                                <button class="hover-effect-btn fill_btn" type="button"> Save & Next </button>
                            </div>
                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col" class=" ">
                                            #
                                        </th>
                                        <th scope="col">
                                            Division Name
                                        </th>
                                        <th scope="col">
                                            Division Details
                                        </th>
                                        <th scope="col">
                                            Award Certificate
                                        </th>
                                        <th scope="col">
                                            Achievements
                                        </th>

                                        <th scope="col" class="">
                                            Action
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
                                            Collage
                                        </td>
                                        <td>
                                            Main Subject
                                        </td>
                                        <td>
                                            Achievements1
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div id="application" class="tabcontent">
                        <h4 class="applicat_cust-title">Task Information</h4>
                        <div class="applicat_cust-container">
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Task Name</div>
                                <div class="applicat_cust-value">######</div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Bucket</div>
                                <div class="applicat_cust-value">#####</div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Team Creation</div>
                                <div class="applicat_cust-value">#####</div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Start Date</div>
                                <div class="applicat_cust-value">14/01/25</div>
                            </div>
                            <div class="applicat_cust-row">
                                <div class="applicat_cust-label">Due Date</div>
                                <div class="applicat_cust-value">14/01/25</div>
                            </div>
                        </div>
                        <h4 class="applicat_cust-title mt-3">Task Details</h4>

                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col" class=" ">
                                            #
                                        </th>
                                        <th scope="col">
                                            Task Name
                                        </th>
                                        <th scope="col">
                                            Bucket
                                        </th>
                                        <th scope="col">
                                            Task Owner Name
                                        </th>
                                        <th scope="col">
                                            Start Date
                                        </th>
                                        <th scope="col">
                                            Due Date
                                        </th>
                                        <th scope="col">
                                            Priority
                                        </th>
                                        <th scope="col" class="">
                                            Action
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
                                            ######
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            High
                                        </td>

                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <h4 class="applicat_cust-title mt-3">Addittional Details</h4>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class=" ">
                                    <tr>
                                        <th scope="col" class=" ">
                                            #
                                        </th>
                                        <th scope="col">
                                            Division Name
                                        </th>
                                        <th scope="col">
                                            Division Details
                                        </th>
                                        <th scope="col">
                                            Progress
                                        </th>
                                        <th scope="col">
                                            Achievements
                                        </th>

                                        <th scope="col" class="">
                                            Action
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
                                            Collage
                                        </td>
                                        <td>
                                            Main Subject
                                        </td>
                                        <td>
                                            Achievements1
                                        </td>
                                        <td>
                                            <a href="#">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn fill_btn" type="button">Save</button>
                        </div>
                    </div>
                </div>

            </div>

        </section>

        <!-- Edn sidebar  -->

    </div>

    <footer class="bg-footer-color p-4">
        <div class="container">
            <p>@ 2024 NHIDCL </p>
        </div>
    </footer>
</body>

  












