@extends('layouts.dashboard')
@section('dashboard_content')
    <!-- Main content area -->
    <section class="home-section">
        <div class="container-fluid md:p-0">
            <div class="top_heading_dash__">
                <div class="main_hed">Audit Query Details</div>
            </div>
        </div>
        <div class="inner_page_dash__">
            <div class="my-4">
                <div id="Home" class="tabcontent">
                    <div class="candidat_cust-dates">
                        <p>Letter No: <br /><span>NHIDCL/FIN/2024/5</span></p>
                        <p>Letter Date: <br /><span>22-01-2017</span></p>
                        <p>Category: <br /><span>10-01-2025</span></p>
                        <p>Audit Year: <br /><span>2017-2018</span></p>
                        <p>Audit Type: <br /><span>Account Audit</span></p>
                        <p>Status: <br /><span>Pending</span></p>
                        <p>Location: <br /><span>Delhi (HQ)</span></p>
                        <p>
                            File: <br /><span><a href="#"><i class="fa fa-file-pdf mx-1" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-file mx-1" aria-hidden="true"></i></a></span>
                        </p>
                        <!-- <p>Doc: <br /><span><a href="#"><i class="fa fa-file" aria-hidden="true"></i></a></span></p> -->
                        <p>Dropped Date: <br /><span>-</span></p>
                    </div>

                    <hr class="my-3" />

                    <h1 class="candidat_cust-title">
                        Inspection Report on the Audit of National Highways &
                        infrastructure Development Corporation Limited (Corporate
                        Office) for the period April 2021 to March 2022.
                    </h1>

                    <div class="candidat_cust-container">
                        <div class="candidat_cust-item">
                            <a href="./audit-para-details.html">
                                <div class="candidat_cust-header">
                                    <span class="candidat_cust-time">PART</span>
                                    <span class="candidat_cust-time">I</span>
                                </div>
                                <h4 class="candidat_cust-title">Introduction</h4>

                                <div class="candidat_cust-dates">
                                    <p>Query Type <br /><span>Audit Requisition</span></p>
                                    <p>Status <br /><span>Dropped</span></p>
                                </div>
                            </a>
                        </div>

                        <!-- <div class="candidat_cust-item">
                      <a href="#">
                        <div class="candidat_cust-header">
                          <span class="candidat_cust-time">PART</span>
                          <span class="candidat_cust-time">II</span>
                        </div>
                        <h4 class="candidat_cust-title">Audit Findings</h4>

                        <div class="candidat_cust-dates">
                          <p>Query Type <br /><span>Audit Requisition</span></p>
                          <p>Status <br /><span>Answered</span></p>
                        </div>
                      </a>
                    </div>

                    <div class="candidat_cust-item">
                      <a href="#">
                        <div class="candidat_cust-header">
                          <span class="candidat_cust-time">PART</span>
                          <span class="candidat_cust-time">II-(A)</span>
                        </div>
                        <h4 class="candidat_cust-title">
                          Significant Audit Findings
                        </h4>

                        <div class="candidat_cust-dates">
                          <p>Query Type <br /><span>Audit Requisition</span></p>
                          <p>Status <br /><span>Refer Back</span></p>
                        </div>
                      </a>
                    </div> -->

                        <div class="candidat_cust-item">
                            <a href="#">
                                <div class="candidat_cust-header">
                                    <span class="candidat_cust-time">PART</span>
                                    <span class="candidat_cust-time">II-(B)</span>
                                </div>
                                <h4 class="candidat_cust-title">
                                    Other incidental Audit Findings
                                </h4>

                                <div class="candidat_cust-dates">
                                    <p>Query Type <br /><span>Audit Requisition</span></p>
                                    <p>Status <br /><span>Refer Back</span></p>
                                </div>
                            </a>
                        </div>

                        <div class="candidat_cust-item">
                            <a href="#">
                                <div class="candidat_cust-header">
                                    <span class="candidat_cust-time">PART</span>
                                    <span class="candidat_cust-time">III</span>
                                </div>
                                <h4 class="candidat_cust-title">
                                    Follow up on findings outstanding of previous Inspection
                                    Reports
                                </h4>

                                <div class="candidat_cust-dates">
                                    <p>Query Type <br /><span>Audit Requisition</span></p>
                                    <p>Status <br /><span>Pending</span></p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
