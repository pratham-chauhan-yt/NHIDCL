@extends('layouts.dashboard')
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Audit Query</div>
                <!-- <div class="plain_dlfex bg_elips_ic">
                            <select name="Date" id="date">
                                <option value="2025">2025</option>
                            </select>
                        </div> -->
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div class="tab_custom_c">
                    <button class="tablink" onclick="openPage('Home', this, '#373737')" id="defaultOpen">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                        </svg>

                        Pending Queries
                    </button>

                    <!-- <button
                    class="tablink"
                    onclick="openPage('News', this, '#373737')"
                  >
                    <svg
                      fill="none"
                      viewBox="0 0 24 24"
                      stroke-width="1.5"
                      stroke="currentColor"
                      class="size-4"
                    >
                      <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776"
                      />
                    </svg>

                    Answered Queries
                  </button> -->

                    <button class="tablink" onclick="openPage('Dropped', this, '#373737')">
                        <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 9.776c.112-.017.227-.026.344-.026h15.812c.117 0 .232.009.344.026m-16.5 0a2.25 2.25 0 0 0-1.883 2.542l.857 6a2.25 2.25 0 0 0 2.227 1.932H19.05a2.25 2.25 0 0 0 2.227-1.932l.857-6a2.25 2.25 0 0 0-1.883-2.542m-16.5 0V6A2.25 2.25 0 0 1 6 3.75h3.879a1.5 1.5 0 0 1 1.06.44l2.122 2.12a1.5 1.5 0 0 0 1.06.44H18A2.25 2.25 0 0 1 20.25 9v.776" />
                        </svg>

                        Dropped Queries
                    </button>
                </div>

                <div id="Home" class="tabcontent">
                    <!-- <div class="inner_select_cust_op">
                                <select class="m-2">
                                    <option value="2025">2025</option>
                                </select>
                            </div> -->

                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Audit Query</th>
                                    <th scope="col">Letter Date</th>
                                    <th scope="col">Pending</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td>1</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="./audit-para/audit-query-details.html"><i class="fa fa-eye"
                                                aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>6 Days</td>
                                    <td>Pending</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
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

                <!-- <div id="News" class="tabcontent">
                  <div class="table_over">
                    <table class="cust_table__ table_sparated">
                      <thead class="">
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">Audit Query</th>
                          <th scope="col">Letter Date</th>
                          <th scope="col">Replied Date</th>
                          <th scope="col">Status</th>
                          <th scope="col">View</th>
                        </tr>
                      </thead>
                      <tbody class="">
                        <tr>
                          <td>1</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>6</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>7</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>8</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>9</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
                          </td>
                        </tr>
                        <tr>
                          <td>10</td>
                          <td>Test audit query</td>
                          <td>27-12-2020</td>
                          <td>07-01-2025</td>
                          <td>Answered</td>
                          <td>
                            <a href="#"
                              ><i class="fa fa-eye" aria-hidden="true"></i
                            ></a>
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
                          <a href="#" class="cust-pagination-link"
                            ><i class="fa fa-arrow-left" aria-hidden="true"></i
                          ></a>
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
                          <a href="#" class="cust-pagination-link"
                            ><i class="fa fa-arrow-right" aria-hidden="true"></i
                          ></a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div> -->

                <div id="Dropped" class="tabcontent">
                    <!-- <div class="inner_select_cust_op">
                      <select class="m-2">
                        <option value="2025">2025</option>
                      </select>
                    </div> -->

                    <div class="table_over">
                        <table class="cust_table__ table_sparated">
                            <thead class="">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Audit Query</th>
                                    <th scope="col">Letter Date</th>
                                    <th scope="col">Dropped Date</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View</th>
                                </tr>
                            </thead>
                            <tbody class="">
                                <tr>
                                    <td>1</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>6</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>7</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>8</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>9</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>10</td>
                                    <td>Test audit query</td>
                                    <td>27-12-2020</td>
                                    <td>27-12-2023</td>
                                    <td>Dropped</td>
                                    <td>
                                        <a href="#"><i class="fa fa-eye" aria-hidden="true"></i></a>
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
@endsection
