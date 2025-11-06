<div id="Contact" class="tabcontent">
    <form class=" ">
        <div class="inpus_cust_cs grid form_grid_dashboard_cust_">
            <div class="">
                <label for="job_title">Select requisition ID</label>
                <select class="js-single" id="cs-requisitionId" name="cs-requisitionId">
                    <option value="">Select requisition ID</option>
                    @foreach($requisitionSelectedBYChairPerson as $rowRequision)
                        <option value="{{$rowRequision->id}}">{{$rowRequision->id}} - {{$rowRequision->job_title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="">
                <label class="">Select batch code</label>
                <select id="batchList" name="batchList" class="batchList js-single">
                    <option value="">Select batch code</option>
                </select>
            </div>
        </div>
    </form>

    <div class="table_over my-1">
        <table id="finalCandidate" class="cust_table__ table_sparated display">
            <thead class="display">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">User ID</th>
                    <th scope="col">Candidate Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                    <th scope="col">View</th>
                    <th scope="col">Select</th>
                    <th scope="col">Upload Offer</th>
                    <th scope="col">Date of Joining</th>
                    <th scope="col">Remark</th>
                    <th scope="col">Action</th>
                </tr>
            </thead id="selectionRow">
            <tbody>
            </tbody>
        </table>
    </div>
</div>
