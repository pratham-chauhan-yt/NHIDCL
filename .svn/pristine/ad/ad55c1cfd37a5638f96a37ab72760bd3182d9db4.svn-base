    $(document).ready(function() {
        $('.js-single').select2();

        /********************Personal details form  validation ******************** */

        document.querySelectorAll('input[name="father_husband_name"], input[name="spouse_name"], input[name="mother_name"]').forEach(function(input) {
            input.addEventListener('input', function() {
                this.value = this.value.replace(/[^A-Za-z\s]/g, '');
            });
        });
        
        $(document).on("click", "#personalDetailsFormBtn, #personalDetailsFormBtn1", function(e) {
            e.preventDefault(); // stop the form from submitting automatically
            let isValid = true;
            let id = this.id;
            let $full_name = $("#full_name").val();
            let $father_husband_name = $("#father_husband_name").val();
            let $mother_name = $("#mother_name").val();
            let $email = $("#email").val();
            let $mobile_no = $("#mobile_no").val();
            let $date_of_birth = $("#date_of_birth").val();
            let $gender = $("#gender").val();
            let $marital_status = $("#marital_status").val();
            let $indian_citizen = $("#indian_citizen").val();
            let $citizenship_consent = $("#citizenship_consent").is(":checked");
            let $category = $("#category").val();
            let $category_confirm = $("#category_confirm").is(":checked");
            let $aadhar_number = $("#aadhar_number").val();
            let $ex_serviceman = $("#ex_serviceman").val();
            let $ex_serviceman_consent = $("#ex_serviceman_consent").is(":checked");
            let $pwbd = $("#pwbd").val();
            let $disability = $("#disability").val();
            let $disability_consent = $("#disability_consent").is(":checked");
            let $correspondence_address = $("#correspondence_address").val();
            let $correspondence_city = $("#correspondence_city").val();
            let $correspondence_state = $("#correspondence_state").val();
            let $correspondence_pincode = $("#correspondence_pincode").val();
            let $permanent_address = $("#permanent_address").val();
            let $permanent_city = $("#permanent_city").val();
            let $permanent_state = $("#permanent_state").val();
            let $permanent_pincode = $("#permanent_pincode").val();
            let $upload_photos = $("#upload_photos").val();
            let $upload_signature = $("#upload_signature").val();
            let $upload_identity_proof = $("#upload_identity_proof").val();
            let $upload_caste_certificate = $("#upload_caste_certificate").val();
            let $upload_disability_proof = $("#upload_disability_proof").val();
            let $upload_dob_proof = $("#upload_dob_proof").val();
            let $upload_ex_serviceman_proof = $("#upload_ex_serviceman_proof").val();
            let $dob_consent = $("#dob_consent").is(":checked");
            
            $("#full_name_err").text("");
            $("#father_husband_name_err").text("");
            $("#mother_name_err").text("");
            $("#email_err").text("");
            $("#mobile_no_err").text("");
            $("#date_of_birth_err").text("");
            $("#gender_err").text("");
            $("#marital_status_err").text("");
            $("#indian_citizen_err").text("");
            $("#category_err").text("");
            $("#aadhar_number_err").text("");
            $("#ex_serviceman_err").text("");
            $("#pwbd_err").text("");
            $("#disability_err").text("");
            $("#correspondence_address_err").text("");
            $("#correspondence_city_err").text("");
            $("#correspondence_state_err").text("");
            $("#correspondence_pincode_err").text("");
            $("#permanent_address_err").text("");
            $("#permanent_city_err").text("");
            $("#permanent_state_err").text("");
            $("#permanent_pincode_err").text("");
            $("#upload_photos_err").text("");
            $("#upload_signature_err").text("");
            $("#upload_identity_err").text("");
            $("#upload_caste_certificate_err").text("");
            $("#upload_disability_proof_err").text("");
            $("#upload_dob_proof_err").text("");
            $("#upload_identity_err").text("");
            $("#upload_ex_serviceman_proof_err").text("");

            let $err = 0;
            if ($full_name == "") {
                $("#full_name_err").text("Full name field is required");
                isValid = false;
            } else {
                if (($full_name.length > 50) || ($full_name.length < 2)) {
                    $("#full_name_err").text("Full name should be of 2 to 50 characters");
                    isValid = false;
                }
            }

            if ($father_husband_name == "") {
                $("#father_husband_name_err").text("Father/Husband name field is required");
                isValid = false;
            } else {
                if (($father_husband_name.length > 50) || ($father_husband_name.length < 2)) {
                    $("#father_husband_name_err").text("Father/Husband name should be of 2 to 50 characters");
                    isValid = false;
                }
            }

            if ($mother_name == "") {
                $("#mother_name_err").text("Mother name field is required");
                isValid = false;
            } else {
                if (($mother_name.length > 50) || ($mother_name.length < 2)) {
                    $("#mother_name_err").text("Mother name should be of 2 to 50 characters");
                    isValid = false;
                }
            }

            if ($email == "") {
                $("#email_err").text("Email field is required");
                isValid = false;
            } else {
                if (isEmail($email) == false) {
                    $("#email_err").text("Invalid email!");
                    isValid = false;
                }
            }

            if ($mobile_no == "") {
                $("#mobile_no_err").text("Mobile number field is required");
                isValid = false;
            } else {
                if (isNaN($mobile_no)) {
                    $("#mobile_no_err").text("Mobile number should be only numbers");
                    isValid = false;
                } else {
                    if (($mobile_no.length > 15) || ($mobile_no.length < 7)) {
                        $("#mobile_no_err").text("Mobile number should be of 7 to 15 digits");
                        isValid = false;
                    }
                }
            }

            if ($date_of_birth == "") {
                $("#date_of_birth_err").text("Date of birth field is required");
                isValid = false;
            } else {
                if (getAge($date_of_birth) < 16) {
                    $("#date_of_birth_err").text("Date of birth showing invalid age");
                    isValid = false;
                }
            }

            // Validate Marital Status
            let marital_status = $("#marital_status").val();
            if (marital_status === "") {
                $("#marital_status_err").text("Marital status is required");
                isValid = false;
            } else {
                $("#marital_status_err").text("");
            }

            // Validate Spouse Name only if Married
            if (marital_status === "Married") {
                let spouse_name = $("#spouse_name").val().trim();

                if (spouse_name === "") {
                    $("#spouse_name_err").text("Spouse name field is required");
                    isValid = false;
                } else if (spouse_name.length < 2 || spouse_name.length > 50) {
                    $("#spouse_name_err").text("Spouse name should be between 2 to 50 characters");
                    isValid = false;
                } else {
                    $("#spouse_name_err").text("");
                }
            } else {
                $("#spouse_name_err").text(""); // clear error if Single
            }

            if ($indian_citizen === "") {
                $("#indian_citizen_err").text("Citizenship field is required");
                isValid = false;
            } else {
                $("#indian_citizen_err").text("");
            }

            if (!$citizenship_consent) {
                $("#indian_citizen_err").text("Citizen ship consent is required.");
                isValid = false;
            }

            if ($gender == "") {
                $("#gender_err").text("Gender field is required");
                isValid = false;
            }

            if ($aadhar_number == "") {
                $("#aadhar_number_err").text("Last 6 digits of aadhar_number are required");
                isValid = false;
            } else {
                if (isNaN($aadhar_number)) {
                    $("#aadhar_number_err").text("Last 6 digits of aadhar should be only numbers");
                    isValid = false;
                } else {
                    if ($aadhar_number.length != 6) {
                        $("#aadhar_number_err").text("Aadhar number should be of 6 digits");
                        isValid = false;
                    }
                }
            }

            if ($ex_serviceman === "") {
                $("#ex_serviceman_err").text("Ex serviceman field is required.");
                isValid = false;
            } else if ($ex_serviceman === "1" && !$ex_serviceman_consent) {
                $("#ex_serviceman_err").text("Ex serviceman consent is required.");
                isValid = false;
            }
            
            if ($pwbd == "") {
                $("#pwbd_err").text("PWBD field is required");
                isValid = false;
            }

            if ($pwbd == "Yes" && $disability == "") {
                $("#disability_err").text("Disability field is required, If PWBD.");
                isValid = false;
            }

            if ($pwbd == "Yes" && !$disability_consent) {
                $("#disability_err").text("Disability consent is required.");
                isValid = false;
            }

            if ($gender == "") {
                $("#gender_err").text("Gender field is required");
                isValid = false;
            }

            if ($category === "") {
                $("#category_err").text("Category field is required");
                isValid = false;
            } else if ($category != "1" && !$category_confirm) {
                $("#category_err").text("Category consent is required.");
                isValid = false;
            }

            if ($correspondence_address == "") {
                $("#correspondence_address_err").text("Correspondence address field is required");
                isValid = false;
            }

            if ($correspondence_city == "") {
                $("#correspondence_city_err").text("Correspondence city field is required");
                isValid = false;
            } else {
                if (($correspondence_city.length > 250) || ($correspondence_city.length < 2)) {
                    $("#correspondence_city_err").text("Correspondence city should be of 2 to 250 characters");
                    isValid = false;
                }
            }

            if ($correspondence_state == "") {
                $("#correspondence_state_err").text("Correspondence state field is required");
                isValid = false;
            }

            if ($correspondence_pincode == "") {
                $("#correspondence_pincode_err").text("Correspondence pincode field is required");
                isValid = false;
            }

            const pincodePattern = /^\d{6}$/;

            if (!pincodePattern.test($correspondence_pincode)) {
                $("#correspondence_pincode_err").text("Correspondence pincode must be exactly 6 digits.");
                isValid = false;
            }

            if ($permanent_address == "") {
                $("#permanent_address_err").text("Permanent address field is required");
                isValid = false;
            }

            if ($permanent_city == "") {
                $("#permanent_city_err").text("Permanent city field is required");
                isValid = false;
            } else {
                if (($permanent_city.length > 250) || ($permanent_city.length < 2)) {
                    $("#permanent_city_err").text("Permanent city should be of 2 to 250 characters");
                    isValid = false;
                }
            }

            if ($permanent_state == "") {
                $("#permanent_state_err").text("Permanent state field is required");
                isValid = false;
            }

            if ($permanent_pincode == "") {
                $("#permanent_pincode_err").text("Permanent pincode field is required");
                isValid = false;
            }

            if (!pincodePattern.test($permanent_pincode)) {
                $("#permanent_pincode_err").text("Permanent pincode must be exactly 6 digits.");
                isValid = false;
            }

            if (($upload_photos == "") && ($("#upload_photoss").val() == "")) {
                $("#upload_photos_err").text("Upload photo field is required");
                isValid = false;
            }

            if (($upload_signature == "") && ($("#upload_signaturee").val() == "")) {
                $("#upload_signature_err").text("Upload signature field is required");
                isValid = false;
            }
            // if (($upload_identity_proof == "") && ($("#upload_identity").val() == "")) {
            //     $("#upload_identity_err").text("Upload identity proof is required");
            //     isValid = false;
            // }
            // if (($('#category option:selected').text().trim() == "EWS") && ($upload_caste_certificate == "") && ($("#upload_caste_certificatee").val() == "")) {
            //     $("#upload_caste_certificate_err").text("Caste certificate or Income proof is required, If EWS.");
            //     isValid = false;
            // }
            // if (($pwbd == "Yes") && ($upload_disability_proof == "") && ($("#upload_disability_prooff").val() == "")) {
            //     $("#upload_disability_proof_err").text("Disability proof is required, If PwBD.");
            //     isValid = false;
            // }
            // if (($ex_serviceman == "1") && ($upload_ex_serviceman_proof == "") && ($("#upload_ex_serviceman_prooff").val() == "")) {
            //     $("#upload_ex_serviceman_proof_err").text("Ex-serviceman proof is required, If Ex-serviceman.");
            //     isValid = false;
            // }
            if (($upload_dob_proof == "") && ($("#upload_dob_prooff").val() == "")) {
                $("#upload_dob_proof_err").text("Date of birth proof is required");
                isValid = false;
            }

            if (!$("#dob_consent").is(":checked")) {
                $("#dob_consent_err").text("You must provide consent.");
                isValid = false;
            } else {
                $("#dob_consent_err").text("");
            }

            // Prevent form submission if any validation failed
            if (!isValid) {
                return false;
            } else {

                $("#personalDetailsForm").submit();
                // Logic for Save & Next vs Save
                if (id === "personalDetailsFormBtn1") {
                    // Save & Next button clicked
                    let nextTab = 2; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 2); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }  
            }
        });

        $("#upload_photos").change(function() {
            let filename = $('#upload_photos').val();
            $("#upload_photoss").val(filename);
        });

        $("#upload_signature").change(function() {
            let filename = $('#upload_signature').val();
            $("#upload_signaturee").val(filename);
        });

        $("#upload_identity_proof").change(function() {
            let filename = $('#upload_identity_proof').val();
            $("#upload_identity").val(filename);
        });

        $("#upload_caste_certificate").change(function() {
            let filename = $('#upload_caste_certificate').val();
            $("#upload_caste_certificatee").val(filename);
        });

        $("#upload_disability_proof").change(function() {
            let filename = $('#upload_disability_proof').val();
            $("#upload_disability_prooff").val(filename);
        });

        $("#upload_ex_serviceman_proof").change(function() {
            let filename = $('#upload_ex_serviceman_proof').val();
            $("#upload_ex_serviceman_prooff").val(filename);
        });

        $("#upload_dob_proof").change(function() {
            let filename = $('#upload_dob_proof').val();
            $("#upload_dob_prooff").val(filename);
        });


        $("#pwbd").on("change", function () {
            const isPwbd = $(this).val().trim() === "Yes";

            const $disability = $("#disability");
            const $disabilityProof = $("#upload_disability_proof");

            if (isPwbd) {
                $disability.prop("disabled", false);
                $disabilityProof.prop("disabled", false);
            } else {
                document.getElementById('pwbd_div').style.display = "none";
                $disability.prop("disabled", true).val('').trigger("change");
                $disabilityProof.prop("disabled", true).val('');
            }
        });

        // $("#ex_serviceman").on("change", function () {
        //     const isExServiceman = $(this).val().trim() === "1";

        //     const $exServicemanProof = $("#upload_ex_serviceman_proof");

        //     if (isExServiceman) {
        //         $exServicemanProof.prop("disabled", false);
        //     } else {
        //         $exServicemanProof.prop("disabled", true).val('');
        //     }
        // });

        // $("#category").on("change", function () {
        //     const selectedText = $('#category option:selected').text().trim();
        //     const $casteCertificate = $("#upload_caste_certificate");

        //     if (selectedText === "GENERAL") {
        //         $casteCertificate.prop("disabled", true).val('');
        //     } else if (selectedText === "" || selectedText === "Select category") {
        //         $casteCertificate.prop("disabled", true).val('');
        //     } else {
        //         $casteCertificate.prop("disabled", false);
        //     }
        // });

        $("#forSame").on("change", function () {
            const isChecked = $(this).is(":checked");

            const fields = ["address", "city", "state", "pincode"];

            fields.forEach(function (field) {
                const cVal = $(`#correspondence_${field}`).val();
                const $permanentField = $(`#permanent_${field}`);

                if (isChecked) {
                    $permanentField.val(cVal).prop("readonly", true);
                    if (field === "state") $permanentField.trigger("change");
                } else {
                    $permanentField.prop("readonly", false);
                }
            });
        });
        /*************************end personaldetails validation **************** */

        /*********************Educational-details validation *********************** */
        $(document).on("click", "#educationalDetailsBtn1", function(e) {
            e.preventDefault(); // stop the form from submitting automatically
            let isValid = true;
            let id = this.id;
            $("#eduClickedFrom").val(id);

            // Validation code (same as before)
            $("input[name='examination']").each(function() {
                if ($(this).val().trim() === "") {
                    $(this).next("#examination_err").text("Please enter examination name.");
                    isValid = false;
                } else {
                    $(this).next("#examination_err").text("");
                }
            });

            $("input[name='institute_name']").each(function() {
                if ($(this).val().trim() === "") {
                    $(this).next("#institute_name_err").text("Please enter institute/college name.");
                    isValid = false;
                } else {
                    $(this).next("#institute_name_err").text("");
                }
            });

            $("input[name='university_board']").each(function() {
                if ($(this).val().trim() === "") {
                    $(this).next("#university_board_err").text("Please enter university/board name.");
                    isValid = false;
                } else {
                    $(this).next("#university_board_err").text("");
                }
            });

            $("select[name='passing_year']").each(function() {
                let inputVal = $(this).val().trim();
                let errorSpan = $(this).siblings(".passing_year_err");
                if (inputVal === "") {
                    errorSpan.text("Please select passing year.");
                    isValid = false;
                } else if (isNaN(inputVal)) {
                    errorSpan.text("Please enter a valid passing year.");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }
            });

            $("input[name='percentage_cgpa']").each(function() {
                let val = $(this).val().trim();
                if (val === "") {
                    $(this).next(".percentage_cgpa_err").text("Please enter the percentage/CGPA.");
                    isValid = false;
                } else if (isNaN(val)) {
                    $(this).next(".percentage_cgpa_err").text("Percentage/CGPA should have a numeric value.");
                    isValid = false;
                } else if (val > 100 || val < 1) {
                    $(this).next(".percentage_cgpa_err").text("Percentage/CGPA invalid!");
                    isValid = false;
                } else {
                    $(this).next(".percentage_cgpa_err").text("");
                }
            });

            let edu_confirm = $("#edu_confirm").is(":checked");
            // clear old error
            $(".edu_confirm_err").text("");
            if (!edu_confirm) {
                $(".edu_confirm_err").text("Please confirm your education qualification.");
                isValid = false;
            }

            let $dob_consent = $("#dob_consent").is(":checked");

            if (!isValid) {
                return false; // stop if form is invalid
            }

            // Submit form via AJAX or normal submit
            $("#educationalDetailsForm").submit();
        });

        $(document).on("click", "#educationalDetailsBtn", function (e) {
            
            e.preventDefault(); // stop the form from submitting automatically
            let isValid = true;
            let id = this.id;
            
            // Logic for Skip steps button
            if (window.hasEducation === true) {
                // Save & Next button clicked
                let nextTab = (window.hasGateDetails === "Yes") ? 3 : 4;
                setCookie("selected_tab_candidate", nextTab, 3);
                location.reload();
            }else{
                Swal.fire(
                    "Warning",
                    `Please Complete education/qualification steps.`,
                    "warning"
                );
            }
        });

        $(document).on("click", "#workExperienceDetailsBtn , #workExperienceDetailsBtn1", function() {

            let isValid = true;
            let id = this.id;
            $("#workClickedFrom").val(id);

            $("input[name='employer_name']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".employer_name_err").text("Please enter the employer name.");
                    isValid = false;
                }else {
                    $(this).next(".employer_name_err").text("");
                }


            });

            $("input[name='post_held']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".post_held_err").text("Please enter the post held name.");
                    isValid = false;
                }else {
                    $(this).next(".post_held_err").text("");
                }
            });

            $("input[name='from_date']").each(function(index) {
                var $fromInput = $(this);
                var $toInput = $("input[name='to_date']").eq(index);

                var fromDate = $fromInput.val().trim();
                var toDate = $toInput.val().trim();

                var isValid = true;

                // Clear previous error messages
                $fromInput.next(".from_date_err").text("");
                $toInput.next(".to_date_err").text("");

                // Empty checks
                if (fromDate === "") {
                    $fromInput.next(".from_date_err").text("Please enter the From Date.");
                    isValid = false;
                }

                if (toDate === "") {
                    $toInput.next(".to_date_err").text("Please enter the To Date.");
                    isValid = false;
                }

                // Continue only if both dates are filled
                if (fromDate && toDate) {
                    var from = new Date(fromDate);
                    var to = new Date(toDate);
                    var today = new Date();
                    today.setHours(0, 0, 0, 0); // Remove time part

                    // From date after To date
                    if (from > to) {
                        $fromInput.next(".from_date_err").text("From Date cannot be after To Date.");
                        $toInput.next(".to_date_err").text("To Date cannot be before From Date.");
                        isValid = false;
                    }

                    // From date equals To date
                    if (from.getTime() === to.getTime()) {
                        $fromInput.next(".from_date_err").text("From Date and To Date cannot be the same.");
                        $toInput.next(".to_date_err").text("From Date and To Date cannot be the same.");
                        isValid = false;
                    }

                    // From date in future
                    if (from > today) {
                        $fromInput.next(".from_date_err").text("From Date cannot be in the future.");
                        isValid = false;
                    }

                    // To date in future
                    if (to > today) {
                        $toInput.next(".to_date_err").text("To Date cannot be in the future.");
                        isValid = false;
                    }
                }

                // Prevent form submission if any pair is invalid
                if (!isValid) {
                    overallValid = false;
                }
            });

            $("textarea[name='job_description']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".job_description_err").text(
                        "Please enter the nature of duties.");
                    isValid = false;
                }else {
                    $(this).next(".job_description_err").text("");
                }
            });

            let edu_confirm = $("#experience_consent").is(":checked");
            // clear old error
            $(".experience_consent_err").text("");
            if (!edu_confirm) {
                $(".experience_consent_err").text("Please confirm your experience certificate consent.");
                isValid = false;
            }

            // $("input[name='experience_certificate']").each(function(index) {

            //     let experience_certificateInput = $(this);
            //     let errorMessageSpan = experience_certificateInput.closest(
            //         '.attachment_section_experience_certificate').find(
            //         '.experience_certificate_err');

            //     if (experience_certificateInput[0].files.length === 0) {
            //         errorMessageSpan.text("Please choose the experience certificate.");
            //         isValid = false;
            //     } else {
            //         errorMessageSpan.text("");
            //     }
            // });

            if (!isValid) {
                return false;
            } 
            $("#workExperienceDetailsForm").submit();
            // Logic for Save & Next vs Save
            if (id === "workExperienceDetailsBtn") {
                // Save & Next button clicked
                let nextTab = 5;
                setCookie("selected_tab_candidate", nextTab, 3);
                loadStep(nextTab);
            } 
            // If Save button clicked (#workExperienceDetailsBtn)
            // Do NOT move to another tab
        });

        $(document).on("click", "#workExperienceSkipBtn", function (e) {
            e.preventDefault(); // stop the form from submitting automatically
            let id = this.id;
            let isValid = true;
            
            if (!isValid) {
                return false;
            } 
            // Logic for Skip steps button
            if (id === "workExperienceSkipBtn") {
                // Save & Next button clicked
                let nextTab = 5;
                setCookie("selected_tab_candidate", nextTab, 3);
                location.reload();
            } 
        });

        
        /**************************END Work Experience Details  ******************* */

        /**************************** Gate Score Details Form Validation **************************/
        $(document).on("click", "#gateScoreDataBtn, #gateScoreDataBtnNext", function(e) {
            e.preventDefault(); // stop default submission

            let id = this.id;
            let isValid = true;
            $("#gateClickedFrom").val(id);

            // Remove old errors
            $(".error-message").remove();

            function showError(input, message) {
                isValid = false;
                if (input.next(".error-message").length === 0) {
                    input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
                } else {
                    input.next(".error-message").text(message);
                }
            }

            // Validate inputs
            $("#gateScoreDataForm").find("input, select, checkbox").each(function() {
                let input = $(this);
                let val = input.val().trim();
                let type = input.data("validate");

                if (type === "required" && val === "") {
                    showError(input, input.data("error") || "This field is required.");
                }
                if (type === "number" && (val === "" || isNaN(val))) {
                    showError(input, input.data("error") || "Please enter a valid number.");
                }
                if (type === "file" && this.files.length === 0) {
                    showError(input, input.data("error") || "Please upload a file.");
                }
                // Validate all checkboxes with data-validate="checkbox"
                $("#gateScoreDataForm").find("input[type='checkbox']").each(function() {
                    let input = $(this);
                    let type = input.data("validate"); // e.g. "checkbox"

                    if (!input.is(":checked")) {
                        showError(input, input.data("error") || "Please accept gate score consent fields.");
                    }
                });
            });
            // Only proceed if valid
            if (!isValid) return false;
            
            // Save & Next logic before submit
            if (id === "gateScoreDataBtnNext") {
                $("#gateScoreDataForm")[0].submit();
                let nextTab = '4';
                setCookie("selected_tab_candidate", nextTab, 4);
                //loadStep(nextTab);
            }

            // Submit form **after everything**
            $("#gateScoreDataForm")[0].submit();
        });


        /**************************** State Group Form Validation **************************/
        $(document).on("click", "#stateGroupDataBtn", function(e) {
            e.preventDefault(); // stop default submission

            let isValid = true;

            // Remove old errors
            $(".error-message").remove();

            function showError(input, message) {
                isValid = false;
                if (input.next(".error-message").length === 0) {
                    input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
                } else {
                    input.next(".error-message").text(message);
                }
            }

            // Validate all checkboxes with data-validate="checkbox"
            $("#stateGroupDataForm").find("input[type='checkbox']").each(function() {
                let input = $(this);
                let type = input.data("validate"); // e.g. "checkbox"

                if (type === "checkbox" && !input.is(":checked")) {
                    showError(input, input.data("error") || "Please accept consent fields.");
                }
            });

            // Only proceed if valid
            if (!isValid) return false;
            let nextTab = (window.hasPayment.trim()  === "Paid") ? 6 : 7;
            setCookie("selected_tab_candidate", nextTab, 6);
            $("#stateGroupDataForm")[0].submit();
        });

        $(document).on("click", "#draftBtnData", function(e) {
            e.preventDefault(); // stop default submission
            let isValid = true;

            // Remove old errors
            $(".error-message").remove();

            function showError(input, message) {
                isValid = false;
                if (input.next(".error-message").length === 0) {
                    input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
                } else {
                    input.next(".error-message").text(message);
                }
            }

            // Validate all checkboxes with data-validate="checkbox"
            $("#draftDataForm").find("input[type='checkbox']").each(function() {
                let input = $(this);
                let val = input.val().trim();
                let type = input.data("validate");

                if (type === "required" && val === "") {
                    showError(input, input.data("error") || "This field is required.");
                }
                
                if (!input.is(":checked")) {
                    showError(input, input.data("error") || "Please accept consent fields.");
                    isValid = false;
                }
            });
            // Only proceed if valid
            if (!isValid) return false;
            $("#draftDataForm")[0].submit();
        });


    });

    function isEmail(email) {
        const validateEmail = (email) => {
            return String(email)
                .toLowerCase()
                .match(
                    /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|.(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
        };
    }


    function getAge(birth) {
        ageMS = Date.parse(Date()) - Date.parse(birth);
        age = new Date();
        age.setTime(ageMS);
        ageYear = age.getFullYear() - 1970;
        // console.log(ageYear, "calculated age is");
        return ageYear;
    }

    /*****************************Upload Photos Code *************************** */

    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.upload_photos').on('change', function() {
            var $this = $(this);

            // Check the file type
            if ($this[0].files[0].type !== 'image/jpeg' && $this[0].files[0].type !== 'image/png' &&
                $this[0].files[0].type !== 'image/jpg') {
                Swal.fire('Warning', 'Please select a valid image file only!!!', 'warning');
                $this.val("");
                return false;
            }

            // Check the file size (10MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }

            var formData = new FormData();
            var file = $this[0].files[0];
            formData.append('upload_photos', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        var fileName = encodeURIComponent(response.file_name);
                        var pathName = encodeURIComponent('uploads/candidate/photos/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        $this.parents('.attachment_section_photos').find(
                            '.hide_upload_photos').hide();
                        $this.parents('.attachment_section_photos').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_photos').siblings(
                            '.attachment_section_photos').show();

                        $('.attachment_section_photos').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_photos" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');

                        $("#upload_photoss").val(url);
                    } else {
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                }
            });
        });
        $(document).on('click', '.report_remove_photos', function() {

            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_photos').find('.hide_upload_photos').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });
        /*******************************End Upload Phots Code ****************************** */

        /*********************Start Code For Signature Upload ************************** */
        $('.upload_signature').on('change', function() {
            let $this = $(this);

            // Check the file type
            if ($this[0].files[0].type !== 'image/jpeg' && $this[0].files[0].type !== 'image/png' &&
                $this[0].files[0].type !== 'image/jpg') {
                Swal.fire('Warning', 'Please select a valid image file only!!!', 'warning');
                $this.val("");
                return false;
            }

            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }

            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_signature', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        $('#upload_signature_err').text('');
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/signature/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        //$this.parents('.attachment_section').find('input[type="file"]').hide();
                        $this.parents('.attachment_section_sign').find(
                            '.hide_upload_signature').hide();
                        $this.parents('.attachment_section_sign').find('input[type="file"]')
                            .prop('required', false);
                        $this.parents('.attachment_section_sign').siblings(
                            '.attachment_section_sign').show();

                        $('.attachment_section_sign').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_signature" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');

                        $("#upload_signaturee").val(url);
                    } else {
                        $("#upload_signaturee").val('');
                        $('#upload_signature_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_signaturee").val('');
                    $('#upload_signature_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_signature', function() {

            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_sign').find('.hide_upload_signature').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        /**********************End Code For Signature Upload **************************** */

        $('.upload_identity_proof').on('change', function() {
            let $this = $(this);
            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }
            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }
            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_identity_proof', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/identity_proof/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;
                        //$this.parents('.attachment_section_upload_identity').find('input[type="file"]').hide();
                        $this.parents('.attachment_section_upload_identity').find(
                            '.hide_upload_identity_proof').hide();
                        $this.parents('.attachment_section_upload_identity').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_upload_identity').siblings(
                            '.attachment_section_upload_identity').show();
                        $('.attachment_section_upload_identity').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_dob_proof" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                        $("#upload_identity").val(url);
                        $('#upload_identity_err').text('');
                    } else {
                        $("#upload_identity").val('');
                        $('#upload_identity_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_identity").val('');
                    $('#upload_identity_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_dob_proof', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_upload_identity').find('.hide_upload_identity_proof').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        /*****************************Start code For caste, disability, ex-serviceman & dob certificate proof Upload ************************  */

        $('.upload_caste_certificate').on('change', function() {
            let $this = $(this);

            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }

            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }

            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_caste_certificate', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/caste_certificate/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        $this.parents('.attachment_section_caste_certificate').find(
                            '.hide_upload_caste_certificate').hide();
                        $this.parents('.attachment_section_caste_certificate').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_caste_certificate').siblings(
                            '.attachment_section_caste_certificate').show();

                        $('.attachment_section_caste_certificate').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_caste_certificate" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');

                        $("#upload_caste_certificatee").val(url);
                        $('#upload_caste_certificate_err').text('');
                    } else {
                        $("#upload_caste_certificatee").val('');
                        $('#upload_caste_certificate_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_caste_certificatee").val('');
                    $('#upload_caste_certificate_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_caste_certificate', function() {

            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_caste_certificate').find('.hide_upload_caste_certificate').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        $('.upload_disability_proof').on('change', function() {
            let $this = $(this);
            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }
            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }
            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_disability_proof', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/disability_proof/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        $this.parents('.attachment_section_disability_proof').find(
                            '.hide_upload_disability_proof').hide();
                        $this.parents('.attachment_section_disability_proof').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_disability_proof').siblings(
                            '.attachment_section_disability_proof').show();
                        $('.attachment_section_disability_proof').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_disability_proof" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                        $("#upload_disability_prooff").val(url);
                        $('#upload_disability_proof_err').text('');
                    } else {
                        $("#upload_disability_prooff").val('');
                        $('#upload_disability_proof_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_disability_prooff").val('');
                    $('#upload_disability_proof_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_disability_proof', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_disability_proof').find('.hide_upload_disability_proof').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        $('.upload_ex_serviceman_proof').on('change', function() {
            let $this = $(this);
            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }
            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }
            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_ex_serviceman_proof', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/ex_serviceman_proof/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        $this.parents('.attachment_section_ex_serviceman_proof').find(
                            '.hide_upload_ex_serviceman_proof').hide();
                        $this.parents('.attachment_section_ex_serviceman_proof').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_ex_serviceman_proof').siblings(
                            '.attachment_section_ex_serviceman_proof').show();
                        $('.attachment_section_ex_serviceman_proof').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_ex_serviceman_proof" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                        $("#upload_ex_serviceman_prooff").val(url);
                        $('#upload_ex_serviceman_proof_err').text('');
                    } else {
                        $("#upload_ex_serviceman_prooff").val('');
                        $('#upload_ex_serviceman_proof_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_ex_serviceman_prooff").val('');
                    $('#upload_ex_serviceman_proof_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_ex_serviceman_proof', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_ex_serviceman_proof').find('.hide_upload_ex_serviceman_proof').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        $('.upload_dob_proof').on('change', function() {
            let $this = $(this);
            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }
            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }
            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_dob_proof', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/dob_proof/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;
                        //$this.parents('.attachment_section_dob_proof').find('input[type="file"]').hide();
                        $this.parents('.attachment_section_dob_proof').find(
                            '.hide_upload_dob_proof').hide();
                        $this.parents('.attachment_section_dob_proof').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_dob_proof').siblings(
                            '.attachment_section_dob_proof').show();
                        $('.attachment_section_dob_proof').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_dob_proof" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                        $("#upload_dob_prooff").val(url);
                        $('#upload_dob_proof_err').text('');
                    } else {
                        $("#upload_dob_prooff").val('');
                        $('#upload_dob_proof_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_dob_prooff").val('');
                    $('#upload_dob_proof_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_dob_proof', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_dob_proof').find('.hide_upload_dob_proof').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        $('.upload_gate_scorecard').on('change', function() {
            let $this = $(this);
            // Check the file type
            if ($this[0].files[0].type !== 'application/pdf') {
                Swal.fire('Warning', 'Please select a valid pdf file only!!!', 'warning');
                $this.val("");
                return false;
            }
            // Check the file size (2MB)
            if ($this[0].files[0].size > 2000000) {
                $this.val("");
                Swal.fire('Warning', 'File size should not exceed 2MB!!!', 'warning');
                return false;
            }
            let formData = new FormData();
            let file = $this[0].files[0];
            formData.append('upload_gate_scorecard', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#loader').hide();
                    // clear old errors
                    $(".error-message").remove();
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/gate_scorecard/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;
                        //$this.parents('.attachment_section_gate_scorecard').find('input[type="file"]').hide();
                        $this.parents('.attachment_section_gate_scorecard').find(
                            '.hide_upload_gate_scorecard').hide();
                        $this.parents('.attachment_section_gate_scorecard').find('input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_gate_scorecard').siblings('.attachment_section_gate_scorecard').show();
                        $('.attachment_section_gate_scorecard').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_gate_scorecard" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                        $("#upload_gate_scorecardd").val(url);
                        $('#upload_gate_scorecard_err').text('');
                    } else {
                        $("#upload_gate_scorecardd").val('');
                        $('#upload_gate_scorecard_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    $('#loader').hide();
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_gate_scorecardd").val('');
                    $('#upload_gate_scorecard_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_gate_scorecard', function() {
            //$(this).closest('.attachment_preview').find('input').val('');
            $("#upload_gate_scorecardd").val('');
            $("#upload_gate_scorecard").val('');
            $(this).closest('.attachment_preview').find('.upload_gate_scorecard').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_gate_scorecard').find('.hide_upload_gate_scorecard').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_gate_scorecard").val('');
            $("#gate_consent").prop("checked", false);
        });

        /*****************************End caste, disability, ex-serviceman & dob certificate proof Upload Code **************************** */

        /*********************Start Code For Marksheet/Degree Upload ************************** */

        $(document).on('change', '.marksheet_degree', function() {
            var $this = $(this);
            var file = $this[0].files[0];
            if ((file.type != 'application/pdf') && (file.type != 'image/jpeg' && file.type !=
                    'image/png' && file.type != 'image/jpg' && file
                    .type != 'image/JPG' && file.type != 'image/JPEG')) {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Extension',
                    text: 'Please upload PDF or Image only',
                });
                $this.val("");
                return false;
            }

            if (file.size > 2000000) { // Size in bytes
                Swal.fire({
                    icon: 'error',
                    title: 'File size large',
                    text: 'Please select 2 MB PDF or Image only!',
                });
                $this.val("");
                return false;
            }

            var formData = new FormData();
            formData.append('marksheet_degree', file);
            formData.append('type', file.type);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent(
                            '/uploads/candidate/marksheet_degree/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl = url;
                        var autoid = $this.attr('id').split('_')[2];
                        $this.hide();
                        $this.closest('.attachment_section_marksheet_degree').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_marksheet_degree').find(
                            '.marksheet_degreee').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest(
                            '.attachment_section_marksheet_degree');
                        $section.append(`
                 <div id="temp${autoid}" class="my-3">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                 </div>
             `);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: response.message,
                        });
                        $this.val('');
                    }
                }
            });
        });

        $(document).on('click', '.report_remove', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var autoid = $(this).data('id');
            $(`#marksheet_degree_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });

        /**********************End Code For Marksheet/Degree Upload **************************** */

        /**************************Start Code for Experience Certificate ********************* */
        $(document).on('change', '.experience_certificate', function() {
            var $this = $(this);
            var file = $this[0].files[0];

            if (file.type != 'application/pdf') {
                Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Extension',
                    text: 'Please upload PDF only',
                });
                $this.val("");
                return false;
            }
            if (file.size > 2000000) { // Size in bytes
                Swal.fire({
                    icon: 'error',
                    title: 'File size large',
                    text: 'Please select 2 MB PDF only!',
                });
                $this.val("");
                return false;
            }

            var formData = new FormData();
            formData.append('experience_certificate', file);
            formData.append('type', file.type);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/upload/files` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;
            $('#loader').show();
            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#loader').hide();
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent(
                            '/uploads/candidate/experience_certificate/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl = url;
                        var autoid = $this.attr('id').split('_')[2];
                        $this.hide();
                        $this.closest('.attachment_section_experience_certificate').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_experience_certificate').find(
                            '.experience_certificatee').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest(
                            '.attachment_section_experience_certificate');
                        $section.append(`
                 <div id="temp${autoid}" class="my-3">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                 </div>
             `);
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Upload Failed',
                            text: response.message,
                        });
                        $this.val('');
                    }
                }
            });
        });

        $(document).on('click', '.report_remove', function() {
            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var autoid = $(this).data('id');
            $(`#experience_certificate_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });
        /**************************End Code for Experience Certificate ********************* */

        /**************************Code to handle Tabs ******************* *****   */
        $(document).on("click", ".tablink", function(e) {
            e.preventDefault();

            let linkid = parseInt($(this).attr("id").replace(/\D/g, ""), 10);
            if (!linkid) {
                return false;
            }
            let currentTab = parseInt(getCookie("selected_tab_candidate") || 1, 10);

            // Validate all required steps before the one user clicked
            for (let i = 1; i < linkid; i++) {
                if (stepRules[i]?.required && typeof stepRules[i].validator === "function") {
                    if (!stepRules[i].validator()) {
                        Swal.fire("Error", `Kindly finish this Step to proceed further.`, "error");
                        return false;
                    }
                }
            }

            // Auto-skip optional tabs only when moving forward
            // if (linkid > currentTab) {
            //     while (stepRules[linkid] && stepRules[linkid].required === false) {
            //         linkid++;
            //     }
            // }
            setCookie("selected_tab_candidate", linkid, 7);

            // Show the chosen tab (even if optional)
            $(".tabcontent").hide();                // hide all tabs
            $(`#tab-${linkid}`).show();             // show selected tab (example: <div id="tab-1">)
            $(".tablink").removeClass("active");
            $(this).addClass("active");
            loadStep(linkid);
        });


        $(window).on("load", function () {
            let selectedTab = getCookie("selected_tab_candidate");
            // fallback: if no cookie, default to tab 1
            if (!selectedTab) {
                selectedTab = 1;
            }

            // show only the last selected tab
            $(".tabcontent").hide();
            $(`#tab-${selectedTab}`).show();
            $(".tablink").removeClass("active");
            $(`#defaultTabs${selectedTab}`).addClass("active");

            // load all previous steps + current one
            for (let i = 1; i <= selectedTab; i++) {
                loadStep(i);
            }
        });

        function loadStep(linkid) {
            // Skip if linkid is null, undefined, or 0
            if (!linkid) {
                return false;
            }
            let selectedTab = getCookie("selected_tab_candidate");
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute("content");
            const finalUrl = websiteUrl
                ? `${websiteUrl}/recruitment-portal/candidate/candidate_details?tab_id=${linkid}`
                : null;

            $("#loader").show();
            $.ajax({
                url: finalUrl,
                type: "GET",
                success: function(response) {
                    $("#loader").hide();

                    if (typeof response === "string") {
                        response = JSON.parse(response);
                    }

                    let tabId = response.data?.tab_id;

                    if (tabId == "1") personalDeatils(response.data);
                    if (tabId == "2") educationalDetails(response.data);
                    if (tabId == "3") validateGateScoreDetails(response.data);
                    if (tabId == "4") experienceDetails(response.data);
                    if (tabId == "5") validateStateGroupDetails(response.data);
                    if (tabId == "6") validatePaymentDetails(response.data);
                    if (tabId == "7") validatePreview(response.data);
                },
                error: function(xhr, status, error) {
                    $("#loader").hide();
                    console.error("Error occurred: " + status + " " + error);
                }
            });
        }

        const stepRules = {
            1: { required: true, validator: validatePersonalDetails },
            2: { required: true, validator: validateEducationDetails },
            3: { 
                required: (window.hasGateDetails === "Yes"), 
                validator: validateGateScoreDetails 
            },
            4: { required: false, validator: validateGateScoreDetails},
            5: { required: true, validator: validateStateGroupDetails },
            6: { 
                required: (window.hasPayment === "Paid"), 
                validator: validatePaymentDetails 
            },
            7: { required: true, validator: validatePreview }
        };

        function validatePersonalDetails() {
            let father_husband_name = $("#father_husband_name").val();
            let mother_name = $("#mother_name").val();
            let category  = $("#category").val();
            let aadhar_number  = $("#aadhar_number").val();
            let address  = $("#correspondence_address").val();
            let photo  = $("#upload_photoss").val();
            let signature  = $("#upload_signaturee").val();
            let dobfile  = $("#upload_dob_prooff").val();
            return window.hasPersonalDetail === true && 
                father_husband_name.trim() !== "" && 
                mother_name.trim() !== "" && 
                category.trim() !== "" && 
                aadhar_number.trim() !== "" && 
                photo.trim() !== "" && 
                signature.trim() !== "" && 
                dobfile.trim() !== "" && 
                address.trim() !== "" ;
        }

        function validateEducationDetails() {
            if (window.hasEducation) {
                return true; // already saved in DB, no need to validate again
            }

            let examination = $("#examination").val();
            let institute_name = $("#institute_name").val();
            let university_board = $("#university_board").val();
            let passing_year = $("#passing_year").val();
            let percentage_cgpa = $("#percentage_cgpa").val();
            let marksheet_degree = $("#marksheet_degree").val();
            return window.hasEducation === true && examination.trim() !== "" && institute_name.trim() !== "" && university_board.trim() !== "" && passing_year.trim() !== "" && percentage_cgpa.trim() !== "" && marksheet_degree.trim() !== "";
        }

        function validateGateScoreDetails() {
            let gate_exam_year = $("#gate_exam_year").val();
            let gate_discpline = $("#gate_discpline").val();
            let gate_registration_number = $("#gate_registration_number").val();
            let gate_score = $("#gate_score").val();
            // let all_india_rank = $("#all_india_rank").val();
            // let number_of_candidate = $("#number_of_candidate").val();
            let upload_gate_scorecardd = $("#upload_gate_scorecardd").val();
            return gate_exam_year.trim() !== "" && gate_discpline.trim() !== "" && gate_registration_number.trim() !== "" && gate_score.trim() !== "" && upload_gate_scorecardd.trim() !== "";
        }

        function validateStateGroupDetails() {
            return $("#state_group_confirm").is(":checked");
        }

        function validatePaymentDetails() {
            let respcode = $("#response_code").val();
            if(respcode === "E000"){
                return respcode.trim() !== "";
            }else{
                return null;
            }
        }

        function validatePreview() {
            // Example: check if user accepted T&C
            return $("#serve_location").is(":checked");
        } 


        const sessionTabMeta = document.querySelector('meta[name="session-tab"]');
        let sessionTab = sessionTabMeta?.getAttribute('content') || 0;
        sessionTab = Number(sessionTab);

        if (sessionTab) {
            sessionTab = Number(sessionTab) + 1;

            setTimeout(function() {
                $("#defaultOpen" + sessionTab).click();
            }, 1000);

        }

        let currentTab = getCookie('selected_tab_candidate');
        if (!currentTab) {
            $("#defaultOpen1").click();
        }
        $("#" + currentTab).click();

        $(document).on('click', '.report_remove_pre', function() {
            $(this).parent().hide();
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            //$(this).closest('.attachment_preview').find('input').val('');

            //$(this).closest('.attachment_preview').find('input').val('');
            $("#upload_dob_prooff").val('');
            $("#upload_dob_proof").val('');
            $("#dob_consent").prop("checked", false);
            $("#dob_consent_hidden").val('0');
        });

        $("#passing_year").change(function() {
            if ($("#passing_year").attr("type") == "text") {
                $("#passing_year").attr("type", "month");
            } else {
                var value = $("#passing_year").val();
                var year = value.split('-')[0];
                $("#passing_year").attr("type", "text");
                $("#passing_year").val(year);
            }
        });

    });

    function setCookie(cname, cvalue, exdays) {
        const d = new Date();
        //   d.setTime(d.getTime() + (exdays*24*60*60*1000));   // set time in days
        d.setTime(d.getTime() + (5 * 60 * 1000)); // set time in minute
        let expires = "expires=" + d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        let name = cname + "=";
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }