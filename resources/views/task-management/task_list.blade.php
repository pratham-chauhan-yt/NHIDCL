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
                    <div class="main_hed">Task Details</div>
                </div>
            </div>
            <div class="inner_page_dash__">
                <div class="my-4 ">
                    <div class="tab_custom_c">
                        <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>

                            Tasks
                        </button>

                        <button class="tablink" onclick="openPage('News', this, '#373737')">
                            <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                class="size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                            </svg>
                            Archive
                        </button>

                    </div>

                    <div id="Home" class="tabcontent">
                        <div class="input_cust_end inpus_cust_cs">
                            <div class="relative">
                                <input type="text" placeholder="Search Job Title" class="">
                            </div>
                            <button class="hover-effect-btn fill_btn" type="button">
                                Find Jobs
                            </button>
                        </div>
                        <div class="candidat_cust-container">
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="{{ asset('public/assets/images/logo-comp.png')}}" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                            <div class="candidat_cust-item">
                                <a href="#">
                                    <div class="candidat_cust-header">
                                        <div class="candidat_cust-logo">
                                            <img src="../../assets/images/logo-comp.png" alt="Company Logo">
                                        </div>
                                        <span class="candidat_cust-time">1d ago</span>
                                    </div>
                                    <h4 class="candidat_cust-title">UI/UX Designer</h4>
                                    <p class="candidat_cust-description">
                                        Gathering and evaluating user requirements, in collaboration with product
                                        managers and engineers
                                    </p>
                                    <div class="candidat_cust-dates">
                                        <p>Start Date: <br><span>10-12-2024</span></p>
                                        <p>End Date: <br><span>22-12-2024</span></p>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="button_flex_cust_form">
                            <button class="hover-effect-btn border_btn ">View More</button>
                        </div>
                    </div>

                    <div id="News" class="tabcontent">

                        <div class="table_over">
                            <table class="cust_table__ table_sparated">
                                <thead class="">
                                    <tr>
                                        <th scope="col">
                                            #
                                        </th>
                                        <th scope="col">
                                            Task name
                                        </th>
                                        <th scope="col">
                                            Bucket
                                        </th>
                                        <th scope="col">
                                            Start date
                                        </th>
                                        <th scope="col">
                                            End date
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="">
                                    <tr>
                                        <td>
                                            1
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
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
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            3
                                        </td>
                                        <td>
                                            #######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            4
                                        </td>
                                        <td>
                                            ######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            5
                                        </td>
                                        <td>
                                            ########
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            6
                                        </td>
                                        <td>
                                           #######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            7
                                        </td>
                                        <td>
                                           ######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            8
                                        </td>
                                        <td>
                                            #######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            9
                                        </td>
                                        <td>
                                            #######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            10
                                        </td>
                                        <td>
                                            #######
                                        </td>
                                        <td>
                                            Technical
                                        </td>
                                        <td>
                                            10-12-2024
                                        </td>
                                        <td>
                                            10-12-2024
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

        </section>

        <!-- Edn sidebar  -->

    </div>

    <footer class="bg-footer-color p-4">
        <div class="container">
            <p>@ 2024 NHIDCL </p>
        </div>
    </footer>
</body>

  












