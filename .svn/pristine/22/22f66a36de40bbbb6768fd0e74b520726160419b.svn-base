@extends('layouts.dashboard')

@section('dashboard_content')


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NHIDCL</title>
    <link rel="stylesheet" href="../../assets/css/output.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/responsive.css">
</head>

<body class="dashboard_bg_body">
    <!-- top header  -->

    <!-- Edn top header  -->

    <!-- sidebar  -->
    <div class="main-container flex overflow-hidden bg_main_dash">
        <!-- Sidebar for navigation -->
        <!-- Main content area -->
        <section class="home-section ">
            <div class="container-fluid md:p-0">
                <div class="top_heading_dash__">
                    <div class="main_hed">Selection Process</div>
                    <div class="plain_dlfex bg_elips_ic">
                        <select>
                            <option value="2025">2025</option>
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
                                    d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z" />
                            </svg>
                            Candidate Shortlist
                        </button>
                        <button class="tablink select-candidate" onclick="openPage('News', this, '#373737')">
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
                    <label class="">Select requisition ID</label>
                    <select class="">
                      <option>Select requisition ID</option>
                    </select>
                  </div>
                  <!-- <div class="">
                    <label class="">Select shortlist code</label>
                    <select class="">
                      <option>Select shortlist code</option>
                    </select>
                  </div> -->
                  <button class="hover-effect-btn border_btn h-fit w-fit" type="button">
                    Generate candidate list
                  </button>
                </div>

                        </form>
                        <div class="table_over">


                            <table class="cust_table__ table_sparated" id="candidateTable">
                                <thead class=" ">
                                    <tr>

                                        <th scope="col">Profile ID</th>
                                        <th scope="col">Candidate Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="user-lists">

                                </tbody>
                            </table>
                            <div id="pagination-links">
                                <!-- Pagination links will be inserted here -->
                            </div>

                        </div>
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="">Comment box</label>
                                    <textarea rows="1" class="" placeholder="Add your comment"></textarea>

                                </div>
                                <div class="">
                                    <label class="">Upload for efile noting</label>
                                    <div class="flex gap-[10px]">
                                        <input type="text" class="" placeholder="Upload documents" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload File
                                            <input type="file" class="hidden">

                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="button_flex_cust_form">

                            <!-- Modal toggle -->
                            <!-- <button data-modal-target="static-modal2" data-modal-toggle="static-modal2"
                                class="hover-effect-btn border_btn" type="button" id="shortlist">
                                Save shortlist
                            </button> -->
                            <button class="hover-effect-btn border_btn" type="button" id="shortlist">
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
                                            <img src="../../assets/images/check-1.png" alt="popupimage">
                                            <p>Shortlist Code</p>
                                            <h4>1254785554</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                fetchUsers();
                                function fetchUsers(page = 1) {
                                    var baseUrl = "{{ route('ajax.searchUsersByRol', ['page' => '']) }}";
                                    $.ajax({
                                        url: baseUrl + page,
                                        method: 'GET',
                                        success: function (response) {
                                            // console.log(response);
                                            if (response.html) {
                                                $('#user-lists').html(response.html);
                                                $('#pagination-links').html(response.pagination);   

                                            } else {
                                                // console.log("No HTML returned in response.");
                                            }
                                        },
                                        error: function (xhr, status, error) {
                                            console.log('Error:', error);
                                        }
                                    });
                                }

                                $(document).on('click', '.pagination a', function (event) {
                                    event.preventDefault();

                                var href = $(this).attr('href');

                                // Use URLSearchParams to extract the page number safely
                                var urlParams = new URLSearchParams(href.split('?')[1]);
                                var page = urlParams.get('page');

                                if (page) {
                                    fetchUsers(page);
                                } else {
                                    console.error('Page number not found in href:', href);
                                }
                                });




                                // <!-- save status by HR -->

                                $("#shortlist").click(function () {

                                    var selectedUserIds = [];
                                    $("input[name='selected[]']:checked").each(function () {
                                        selectedUserIds.push($(this).val());
                                    });


                                    // alert(selectedUserIds);


                                    if (selectedUserIds.length > 0) {

                                        $.ajax({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                            },
                                            url: "{{ route('updateUserStatus') }}",
                                            type: 'GET',
                                            data: {
                                                user_ids: selectedUserIds,
                                            },
                                            success: function (response) {
                                                alert(response.message);
                                            },
                                            error: function (xhr, status, error) {
                                                alert('Error: ' + error);
                                            }
                                        });
                                    } else {
                                        alert('Please select at least one user and a status to update.');
                                    }
                                });
                            });

                        </script>
                    </div>

                    <div id="News" class="tabcontent">
                        <form class=" ">
                            <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="">Select advertisement</label>
                                    <select class="">

                                        <option>10-01-2025 - Applications invited in On-line mode for the posts of
                                            Associate and Consultant on private entities in NHIDCL</option>
                                    </select>
                                </div>
                                
                            </div>

                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated" id="candidateTable">
                                <thead class=" ">
                                    <tr>

                                        <th scope="col">Profile ID</th>
                                        <th scope="col">Candidate Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="users-list">
                               
                                </tbody>
                            </table>
                        </div>
                        <form class="form_grid_cust">
                        <div class="inpus_cust_cs form_grid_dashboard_cust_">
                  <div class="">
                    <label class="">Schedule assessment</label>
                    <div class="custom_check_inline-container">
                      <div class="custom_check_inline-item">
                        <input id="exam-checkbox" type="checkbox" value="" class="custom_check_inline-checkbox">
                        <label for="exam-checkbox" class="custom_check_inline-label">Exam</label>
                      </div>
                      <div class="custom_check_inline-item">
                        <input id="interview-checkbox" type="checkbox" value="" class="custom_check_inline-checkbox">
                        <label for="interview-checkbox" class="custom_check_inline-label">Interview</label>
                      </div>
                    </div>
                  </div>

                  <div class="">
                    <label class="">Number of batch</label>
                    <input type="number" class="" placeholder="Number of batch" value="1">
                  </div>

                  <div class="">
                    <label class="">Date and Time of Batch 1</label>
                    <input type="datetime-local" class="" placeholder="Date and Time of Batch 1" required="">
                  </div>

                  <div class="">
                    <label class="">Comment box</label>
                    <textarea rows="1" class="" placeholder="Add your comment"></textarea>
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
                                            <img src="../../assets/images/check-1.png" alt="popupimage">
                                            <p>Your Batch Code is</p>
                                            <h4>1254785554</h4>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function () {
                              
                                $.ajax({
                                    url: "{{ route('ajax.SearchShortLeastedCandidate') }}",
                                    method: 'GET',
                                    success: function (response) {
                                        // console.log(response);
                                        if (response.html) {
                                            $('#users-list').html(response.html);
                                            
                                        } else {
                                            // console.log("No HTML returned in response.");
                                        }
                                    },
                                    error: function (xhr, status, error) {
                                        console.log('Error:', error);
                                    }
                                });
                            });

                        </script>
                    </div>

                    <div id="Contact" class="tabcontent">
                        <form class=" ">
                            <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
                                <!-- <div class="">
                                    <label class="">Select advertisement</label>
                                    <select class="">

                                        <option>10-01-2025 - Applications invited in On-line mode for the posts of
                                            Associate and Consultant on private entities in NHIDCL</option>
                                    </select>
                                </div>
                                <div class="">
                                    <label class="">Select shortlist code</label>
                                    <select class="">

                                        <option>Select shortlist code</option>
                                    </select>
                                </div> -->
                                <div class="">
                                    <label class="">Select assessment batch code</label>
                                    <select class="">

                                        <option>Select assessment batch code</option>
                                    </select>
                                </div>
                            </div>

                        </form>
                        <div class="table_over">
                            <table class="cust_table__ table_sparated" id="candidateTable">
                                <thead class=" ">
                                    <tr>

                                        <th scope="col">Profile ID</th>
                                        <th scope="col">Candidate Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">View</th>
                                        <th scope="col">Select</th>
                                    </tr>
                                </thead>
                                <tbody id="users-list">

                                </tbody>
                            </table>
                        </div>
                        <form class="form_grid_cust">
                            <div class="inpus_cust_cs form_grid_dashboard_cust_">
                                <div class="">
                                    <label class="">Comment box</label>
                                    <textarea rows="1" class="" placeholder="Add your comment"></textarea>

                                </div>
                                <div class="">
                                    <label class="">Upload for efile noting</label>
                                    <div class="flex gap-[10px]">
                                        <input type="file" class="" placeholder="Upload documents" disabled>
                                        <label class="upload_cust mb-0 hover-effect-btn"> Upload
                                            <!-- <input  type="file" class="hidden" > -->

                                        </label>
                                    </div>
                                </div>
                            </div>

                        </form>
                        <div class="button_flex_cust_form">

                            <!-- Modal toggle -->
                            <!-- <button data-modal-target="static-modal4" data-modal-toggle="static-modal4"
                                class="hover-effect-btn border_btn" type="button">
                                Generate candidate selection list
                            </button> -->

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
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function () {
                                $.ajax({
                                   {{-- url: "{{ route('ajax.searchUsersByRol') }}", --}}
                                method: 'GET',
                                success: function (response) {
                                    // console.log(response);
                                    if (response.html) {
                                        $('#user-list').html(response.html);
                                        $('#userModal').fadeIn();
                                    } else {
                                        // console.log("No HTML returned in response.");
                                    }
                                },
                                error: function (xhr, status, error) {
                                    console.log('Error:', error);
                                }
                                });
                            });

                        </script>
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

    <script src="../../assets/js/jquery.min.js"></script>
    <script src="../../assets/js/flowbit.min.js"></script>
    <script src="../../assets/js/tailwind.js"></script>
    <script src="../../assets/js/custom.js"></script>


</body>
@endsection