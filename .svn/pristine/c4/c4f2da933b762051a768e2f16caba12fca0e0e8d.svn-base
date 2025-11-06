<br><h4><b>Disclosure Questions</b><span class="candidateErr" id="final_status"></span></h4><br>
    <form id="clouserForm" action="{{route('final-clouser.submition')}}" method="POST">
        @csrf

        <h3>Whether you are convicted by any court at any time in your life?</h3>
        <label>
            <input id="conviction_yes" type="radio" name="conviction" value="Yes"> Yes
        </label>
        <label>
            <input id="conviction_no" type="radio" name="conviction" value="No"> No
        </label>
        <span id="conviction_err" class="candidateErr">
            @if($errors->has('conviction'))
                {{ $errors->first('conviction') }}
            @endif
        </span>
        <div class="attachment_section_conviction_file attachment_preview convictionDev inpus_cust_cs form_grid_dashboard_cust_" style="display:none">
            <div class="">
                <label  class="">Upload supporting document*(<span style="font-size: 10px;">Max size 2MB  & file should be pdf only</span>)</label>
                <div class="flex gap-[10px]">
                    <input type="text" id="conviction_filee" name="conviction_filee"
                        placeholder="Upload supporting document" class="conviction_filee" readonly>
                    <label class="upload_cust mb-0 hover-effect-btn cf"> Upload
                        <input  type="file" id="conviction_file" name="conviction_file" class="hidden conviction_file" >
                        <input type="hidden" id="trainClickedFrom" name="trainClickedFrom" value="">
                    </label>
                </div>
            </div>
        </div>
        <span id="conviction_file_err" class="candidateErr conviction_file_err">
        </span>

        <h3>Whether any criminal case is pending against you?</h3>
        <label>
            <input  id="criminal_yes" type="radio" name="criminal_case" value="Yes"> Yes
        </label>
        <label>
            <input  id="criminal_no" type="radio" name="criminal_case" value="No"> No
        </label>
        <span id="criminal_case_err" class="candidateErr">
            @if($errors->has('criminal_case'))
                {{ $errors->first('criminal_case') }}
            @endif
        </span>
        <div class="attachment_section_criminal_case_file attachment_preview criminal_caseDev inpus_cust_cs form_grid_dashboard_cust_" style="display:none">
            <div class="">
                <label  class="">Upload supporting document*(<span style="font-size: 10px;">Max size 2MB  & file should be pdf only</span>)</label>
                <div class="flex gap-[10px]">
                    <input type="text"  id="criminal_case_filee" name="criminal_case_filee"
                        placeholder="Upload supporting document" class="criminal_case_filee" readonly>
                    <label class="upload_cust mb-0 hover-effect-btn ccf"> Upload
                        <input  type="file" id="criminal_case_file" name="criminal_case_file" class="hidden criminal_case_file" >
                        <input type="hidden" id="trainClickedFrom" name="trainClickedFrom" value="">
                    </label>
                </div>
            </div>
        </div>
        <span id="criminal_case_file_err" class="candidateErr criminal_case_file_err">
            @if($errors->has('criminal_case_file'))
                {{ $errors->first('criminal_case_file') }}
            @endif
        </span>

        <h3>Whether any financial liabilities or any other obligation are pending with present employer?</h3>
        <label>
            <input id="financial_liabilities_yes" type="radio" name="financial_liabilities" value="Yes"> Yes
        </label>
        <label>
            <input id="financial_liabilities_no" type="radio" name="financial_liabilities" value="No"> No
        </label>
        <span id="financial_liabilities_err" class="candidateErr">
            @if($errors->has('financial_liabilities'))
                {{ $errors->first('financial_liabilities') }}
            @endif
        </span>
        <div class="attachment_section_financial_liabilities_file attachment_preview financial_liabilitiesDev inpus_cust_cs form_grid_dashboard_cust_" style="display:none">
            <div class="">
            <label  class="">Upload supporting document*(<span style="font-size: 10px;">Max size 2MB  & file should be pdf only</span>)</label>
                <div class="flex gap-[10px]">
                    <input type="text"  id="financial_liabilities_filee" name="financial_liabilities_filee"
                        placeholder="Upload supporting document" class="financial_liabilities_filee" readonly>
                    <label class="upload_cust mb-0 hover-effect-btn flf"> Upload
                        <input  type="file" id="financial_liabilities_file" name="financial_liabilities_file" class="hidden financial_liabilities_file" >
                        <input type="hidden" id="trainClickedFrom" name="trainClickedFrom" value="">
                    </label>
                </div>
            </div>
        </div>
        <span id="financial_liabilities_file_err" class="candidateErr financial_liabilities_file_err">
            @if($errors->has('financial_liabilities_file'))
                {{ $errors->first('financial_liabilities_file') }}
            @endif
        </span>

        <h3>Whether you have any conflict of interest with or pecuniary interest that you could derive by working in this assignment with the Government of India?</h3>
        <label>
            <input id="conflict_of_interest_yes" type="radio" name="conflict_of_interest" value="Yes"> Yes
        </label>
        <label>
            <input id="conflict_of_interest_no" type="radio" name="conflict_of_interest" value="No"> No
        </label>
        <span id="conflict_of_interest_err" class="candidateErr">
            @if($errors->has('conflict_of_interest_case'))
                {{ $errors->first('conflict_of_interest_case') }}
            @endif
        </span>
        <div class="attachment_section_conflict_of_interest_file attachment_preview conflict_of_interestDev inpus_cust_cs form_grid_dashboard_cust_" style="display:none">
            <div class="">
            <label  class="">Upload supporting document*(<span style="font-size: 10px;">Max size 2MB  & file should be pdf only</span>)</label>
                <div class="flex gap-[10px]">
                    <input type="text"  id="conflict_of_interest_filee" name="conflict_of_interest_filee"
                        placeholder="Upload supporting document" class="conflict_of_interest_filee" readonly>
                    <label class="upload_cust mb-0 hover-effect-btn coif"> Upload
                        <input  type="file" id="conflict_of_interest_file" name="conflict_of_interest_file" class="hidden conflict_of_interest_file" >
                        <input type="hidden" id="trainClickedFrom" name="trainClickedFrom" value="">
                    </label>
                </div>
            </div>
        </div>
        <span id="conflict_of_interest_file_err" class="candidateErr conflict_of_interest_file_err">
            @if($errors->has('conflict_of_interest_file'))
                {{ $errors->first('conflict_of_interest_file') }}
            @endif
        </span>

        <br><br>

        <h3>Terms and Conditions:</h3>
        <label>
            <input type="checkbox" name="terms_agreement"> I have gone through the procedure and guidelines for engagement of Senior Consultants/Consultants Grade-2/Consultants Grade-1/Young Professionals and agreed to the terms and conditions given there.
        </label><br>
        <span id="terms_agreement_err" class="candidateErr">
            @if($errors->has('terms_agreement_case'))
                {{ $errors->first('terms_agreement_case') }}
            @endif
        </span><br>
        <label>
            <input type="checkbox" name="documentary_proof"> I undertake to submit the original documentary proof in respect of my educational qualifications, working experience, Date of Birth, address, and all other documents submitted by me as and when asked.
        </label><br>
        <span id="documentary_proof_err" class="candidateErr">
            @if($errors->has('documentary_proof_case'))
                {{ $errors->first('documentary_proof_case') }}
            @endif
        </span><br>
        <label>
            <input type="checkbox" name="eligibility_criteria"> I understand that I fulfill the eligibility criteria via age, educational qualification, and required work experience as per the Guidelines for the position applied. In case of non-eligibility, my candidature is liable to be rejected without informing me.
        </label><br>
        <span id="eligibility_criteria_err" class="candidateErr">
            @if($errors->has('eligibility_criteria_case'))
                {{ $errors->first('eligibility_criteria_case') }}
            @endif
        </span><br>
        <label>
            <input type="checkbox" name="information_accuracy"> I am well aware that the information furnished in the application and resume, duly supported by the documents in respect of Essential Qualification/Work Experience submitted by me, will also be assessed by the selection committee at the time of selection for the position. The information details provided by me are correct and true to the best of my knowledge, and no material fact having bearing on my selection has been suppressed or withheld.
        </label><br>
        <span id="information_accuracy_err" class="candidateErr">
            @if($errors->has('information_accuracy'))
                {{ $errors->first('information_accuracy') }}
            @endif
        </span><br>
        <input type="hidden" id="draftOrSubmit" name="draftOrSubmit" class="draftOrSubmit" value="">
        <div class="button_flex_cust_form finalBtnDev">

            <!-- <button type="button" id="disclouserBtn" class="hover-effect-btn border_btn disclouserBtn
                ">Save as Draft</button> -->
            <button id="disclouserFinalBtn" class="hover-effect-btn fill_btn" type="button"> {{ $btnApplication }} </button>
        </div>
    </form>
