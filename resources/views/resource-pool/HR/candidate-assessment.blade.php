<div id="News" class="tabcontent">
    <form class=" ">
        <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
            <div class="">
                <label class="">Select requisition ID</label>
                <select id="listSelectedByChairPerson" name="listSelectedByChairPerson" class="listSelectedByChairPerson js-single">
                    <option value="">Select requisition ID</option>
                    @foreach($requisitionSelectedBYChairPerson as $rowRequision)
                        <option value="{{$rowRequision->id}}-{{$rowRequision->shortlistApplicantDetails->first()->id}}">{{$rowRequision->id}} - {{$rowRequision->job_title}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>
    <div class="table_over my-1">
        <table class="cust_table__ table_sparated table-auto text-wrap cell-border stripe compact hover w-full" id="selectedCandidateTable"
            style="width:100% !important">
            <thead class=" ">
                <tr>
                    <th scope="col">Sr.No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">View</th>
                    <th scope="col">Members Remark</th>
                    <th scope="col">Chairperson Remark</th>
                    <th scope="col">Select/Assigned Batch</th>
                </tr>
            </thead>
            <tbody id="dataTablesRow">
                <!-- Data will be rendered here by DataTables -->
            </tbody>
        </table>

        <!-- DataTables Script -->
        <div id="pagination-links">
            <!-- Pagination links will be inserted here -->
        </div>

    </div>
    <form id="assessmentForm" class="form_grid_cust">
        <div class="inpus_cust_cs form_grid_dashboard_cust_">
            <div class="">
                <label class="">Schedule assessment</label>
                <div class="custom_check_inline-container">
                    <div class="custom_check_inline-item">
                        <input id="exam-checkbox" name="exam" type="checkbox" value="1"
                            class="custom_check_inline-checkbox">
                        <label for="exam-checkbox" class="custom_check_inline-label">Exam</label>
                    </div>
                    <span id="exam" class="exam_err candidateErr"></span>
                    <div class="custom_check_inline-item">
                        <input id="interview-checkbox" name="interview" type="checkbox" value="1"
                            class="custom_check_inline-checkbox">
                        <label for="interview-checkbox"
                            class="custom_check_inline-label">Interview</label>
                    </div>
                    <span id="interview" class="interview_err candidateErr"></span>
                </div>
            </div>
            {{-- <div class="">
                <label class="">Number of batch</label>
                    <input name="batch_number" id="batch_number" type="number" class="" min="1" max="1" placeholder="Number of batch" value="1">
                <span id="batch_number" class="batch_number_err candidateErr"></span>
            </div> --}}
            <div id="batches">
                <div class="batches">
                    <label class="">Date and Time of Batch</label>
                    <input name="date_time" id="date_time" type="datetime-local" class="" placeholder="Date and Time of Batch"
                        required="">
                    <span id="date_time" class="date_time_err candidateErr"></span>
                </div>
            </div>
            <div class="">
                {{-- <input type="hidden" id="candidate_email"  name="candidate_email[]" class=""> --}}
                <input type="hidden" id="requision_id"  name="requision_id" class="">

            </div>
        </div>
    </form>
    <div class="button_flex_cust_form">
        <button id="assessmentSubmitButton" data-modal-target="static-modal3" data-modal-toggle="static-modal3"
            class="hover-effect-btn border_btn" type="button">
            Generate assessment batch
        </button>
    </div>
</div>
