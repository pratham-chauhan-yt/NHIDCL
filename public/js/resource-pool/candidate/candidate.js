    $(document).ready(function() {
        $('.js-single').select2();

        const htmlTagPattern = /^[A-Za-z0-9.,@_\-\s]+$/;
        const htmlTagMsg = "HTML tags are not allowed";


        /********************Personal details form  validation ******************** */
        $(document).on("click", "#personalDetailsSaveBtn", function() {
            let $full_name = $("#full_name").val();
            let $father_husband_name = $("#father_husband_name").val();
            let $email = $("#email").val();
            let $mobile_no = $("#mobile_no").val();
            let $ref_engagement_id= $("#ref_engagement_id").val();
            let $date_of_birth = $("#date_of_birth").val();
            let $gender = $("#gender").val();
            let $pincode = $("#pincode").val();
            // let $spouse_name = $("#spouse_name").val();
            let $spouse_mobile_no = $("#spouse_mobile_no").val();
            let $correspondence_address = $("#correspondence_address").val();
            let $permanent_address = $("#permanent_address").val();
            let $upload_photos = $("#upload_photos").val();
            let $upload_signature = $("#upload_signature").val();
            let $upload_resume = $("#upload_resume").val();

            // const htmlTagPattern = /^[A-Za-z]+(?: [A-Za-z]+)*$/;

            $("#full_name_err").text("");
            $("#father_husband_name_err").text("");
            $("#email_err").text("");
            $("#mobile_no_err").text("");
            $("#date_of_birth_err").text("");
            $("#ref_engagement_id_err").text("");
            $("#gender_err").text("");
            $("#pincode_err").text("");
            // $("#spouse_name_err").text("");
            $("#spouse_mobile_no_err").text("");
            $("#correspondence_address_err").text("");
            $("#permanent_address_err").text("");
            $("#upload_photos_err").text("");
            $("#upload_signature_err").text("");
            $("#upload_resume_err").text("");
            //    $("#personalDetailsForm").submit();
            //    return false;
            let $err = 0;
            if ($full_name == "") {
                $("#full_name_err").text("Full name field is required");
                $err = 1;
            } else {
                if (($full_name.length > 50) || ($full_name.length < 2)) {
                    $("#full_name_err").text("Full name should be of 2 to 50 characters");
                    $err = 1;
                }
            }


            if ($father_husband_name == "") {
                $("#father_husband_name_err").text("Father/Husband name field is required");
                $err = 1;
            } else {
                if (($father_husband_name.length > 50) || ($father_husband_name.length < 2)) {
                    $("#father_husband_name_err").text(
                        "Father/Husband name should be of 2 to 50 characters");
                    $err = 1;
                }
            }

            if (!htmlTagPattern.test($father_husband_name)) {
                $("#father_husband_name_err").text("Numeric and special characters should not be allowed");
                $err = 1;
            }


            if ($email == "") {
                $("#email_err").text("Email field is required");
                $err = 1;
            } else {
                if (isEmail($email) == false) {
                    $("#email_err").text("Invalid email!");
                    $err = 1;
                }
            }
            if ($mobile_no == "") {
                $("#mobile_no_err").text("Mobile number field is required");
                $err = 1;
            } else {
                if (isNaN($mobile_no)) {
                    $("#mobile_no_err").text("Mobile number should be only numbers");
                    $err = 1;
                } else {
                    if (($mobile_no.length > 15) || ($mobile_no.length < 7)) {
                        $("#mobile_no_err").text("Mobile number should be of 7 to 15 digits");
                        $err = 1;
                    }
                }
            }

            if ($date_of_birth == "") {
                $("#date_of_birth_err").text("Date of birth field is required");
                $err = 1;
            } else {
                if (getAge($date_of_birth) < 18) {
                    $("#date_of_birth_err").text("Date of birth showing invalid age");
                    $err = 1;
                }
            }

            if($ref_engagement_id==""){
             $("#ref_engagement_id_err").text("Please select the Engagement type that you are applying for");
                $err=1;
            }

            if ($gender == "") {
                $("#gender_err").text("Gender field is required");
                $err = 1;
            }

            // if ($spouse_name != "") {
            //     if (($spouse_name.length > 50) || ($spouse_name.length < 2)) {
            //         $("#spouse_name_err").text("Spouse name should be of 2 to 50 characters");
            //         $err = 1;
            //     }
            //     if (!htmlTagPattern.test($spouse_name)) {
            //         $("#spouse_name_err").text("Numeric and special characters should not be allowed");
            //         $err = 1;
            //     }
            // }

            if ($spouse_mobile_no !== "") {
                // $("#spouse_mobile_no_err").text("Spouse mobile number field is required");
                // $err = 1;
                if (isNaN($spouse_mobile_no)) {
                    $("#spouse_mobile_no_err").text("Spouse mobile number should be only numbers");
                    $err = 1;
                } else if ($spouse_mobile_no.length !== 10) {
                    $("#spouse_mobile_no_err").text("Spouse mobile number should be of 10 digits");
                    $err = 1;
                }
            }

            if ($pincode == "") {
                $("#pincode_err").text("Pin Code field is required");
                $err = 1;
            }

            const pincodePattern = /^\d{6}$/;

            if (!pincodePattern.test($pincode)) {
                $("#pincode_err").text("Pincode must be exactly 6 digits.");
                $err = 1;
            }

            if ($correspondence_address == "") {
                $("#correspondence_address_err").text("Correspondence address field is required");
                $err = 1;
            }

            if (!htmlTagPattern.test($correspondence_address)) {

                $("#correspondence_address_err").text(
                    "Numeric and special characters should not be allowed");
                $err = 1;
            }

            if ($permanent_address == "") {
                $("#permanent_address_err").text("Permanent address field is required");
                $err = 1;
            }

            if (!htmlTagPattern.test($permanent_address)) {
                $("#permanent_address_err").text(
                    "Numeric and special characters should not be allowed");
                $err = 1;
            }
            if (($upload_photos == "") && ($("#upload_photoss").val() == "")) {
                $("#upload_photos_err").text("Upload photo field is required");
                $err = 1;
            }

            if (($upload_signature == "") && ($("#upload_signaturee").val() == "")) {
                $("#upload_signature_err").text("Upload signature field is required");
                $err = 1;
            }
            if (($upload_resume == "") && ($("#upload_resumee").val() == "")) {
                $("#upload_resume_err").text("Upload CV field is required");
                $err = 1;
            }
            if ($err) {
                return false;
            } else {
                $("#personalDetailsForm").submit();
                // Save & Next button clicked
                let nextTab = 2; // or dynamically determine next tab
                setCookie("selected_tab_candidate", nextTab, 2); // store for reload
                loadStep(nextTab); // load the next tab dynamically
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
        $("#upload_resume").change(function() {
            let filename = $('#upload_resume').val();
            $("#upload_resumee").val(filename);
        });

        $("#forSame").click(function() {
            let filename = $('#correspondence_address').val();
            $("#permanent_address").val(filename);
        });
        /*************************end personaldetails validation **************** */

        /*********************Educational-details validation *********************** */
        $(document).on("click", "#educationalDetailsBtn1, #educationalDetailsBtn2", function() {
            let isValid = true;
            let id = this.id;
            $("#eduClickedFrom").val(id);

            $("select[name='qualification']").each(function() {
                const selectedVal = $(this).val();
                const errorSpan = $(this).closest('div').find('.qualification_err');
                if (selectedVal === "") {
                    errorSpan.text("Please select a qualification.");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }
            });

             $("input[name='other_qualification']").each(function(index) {
                if (($(this).val() === "") && ($(".otherQualificationDiv").attr('style') == "")) {
                    $(this).next("#other_qualification_err").text("Please enter qualification name.");
                    isValid = false;
                } else {
                    $(this).next("#other_qualification_err").text("");
                }
            });

            $("select[name='course']").each(function(index) {
                const errorSpan = $(this).closest('div').find('.course_err');

                if ($(this).val() === "") {
                    errorSpan.text("Please select a course.");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }
            });


            $("input[name='other_course']").each(function(index) {
                if (($(this).val() === "") && ($(".otherCourseDiv").attr('style') == "")) {
                    $(this).next("#other_course_err").text("Please enter course name.");
                    isValid = false;
                } else {
                    $(this).next("#other_course_err").text("");
                }
            });

            $("input[name='other_board_university_collage[]']").each(function(index) {
                if (($(this).val() === "") && ($(".otherCollegeDiv").attr('style') == "")) {
                    $(this).next("#other_board_university_collage_err").text(
                        "Please enter Board/University/College name.");
                    isValid = false;
                } else {
                    $(this).next("#other_board_university_collage_err").text("");
                }
            });


            $("select[name='board_university_collage']").each(function(index) {

                const errorSpan = $(this).closest('div').find('.board_university_collage_err');

                if ($(this).val() === "") {
                    errorSpan.text("Please enter the Board/University/College");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }


            });

            $("select[name='main_subject']").each(function(index) {

                const errorSpan = $(this).closest('div').find('.main_subject_err');

                if ($(this).val() === "") {
                    errorSpan.text("Please enter the main subjects.");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }

            });

            $("input[name='other_main_subject']").each(function(index) {
                if (($(this).val() === "") && ($(".otherMainSubjectDiv").attr('style') == "")) {
                    $(this).next("#other_main_subject_err").text(
                        "Please enter main subject name.");
                    isValid = false;
                } else {
                    $(this).next("#other_main_subject_err").text("");
                }
            });


            $("select[name='course_mode']").each(function(index) {

                const errorSpan = $(this).closest('div').find('.course_mode_err');

                if ($(this).val() === "") {
                    errorSpan.text("Please select a course mode.");
                    isValid = false;
                } else {
                    errorSpan.text("");
                }

            });

            $("select[name='passing_year']").each(function(index) {
                let inputVal = $(this).val().trim();

                if (inputVal === "") {
                    $(this).next(".passing_year_err").text(
                        "Please enter the passing year.");
                    isValid = false;
                } else if (isNaN(inputVal)) {
                    $(this).next(".passing_year_err").text(
                        "Please enter a valid passing year.");
                    isValid = false;
                }
                else {
                    $(this).next(".passing_year_err").text("");
                }

            });

            $("input[name='percentage']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".percentage_err").text("Please enter the percentage.");
                    isValid = false;
                } else if (isNaN($(this).val().trim())) {
                    $(this).next(".percentage_err").text(
                        "Percentage should have a numeric value.");
                    isValid = false;
                } else if (($(this).val().trim() > 100) || ($(this).val().trim() < 1)) {
                    $(this).next(".percentage_err").text("Percentage invalid!");
                    isValid = false;
                } else {
                    $(this).next(".percentage_err").text("");
                }
            });

            $("input[name='cgpa[]']").each(function(index) {
                if (($(this).val().trim() != "") && (isNaN($(this).val().trim()))) {
                    $(this).next(".cgpa_err").text("CGPA should be a numeric value.");
                    isValid = false;
                } else if (($(this).val().trim() > 10)) {
                    $(this).next(".cgpa_err").text("Invalid CGPA.");
                    isValid = false;
                } else {
                    $(this).next(".cgpa_err").text("");
                }
            });
            // Validate Marksheet/Degree File Upload
            $("input[name='marksheet_degree']").each(function(index) {
                let marksheet_degreeInput = $(this);
                let errorMessageSpan = marksheet_degreeInput.closest(
                    '.attachment_section_marksheet_degree').find('.marksheet_degree_err');

                if (marksheet_degreeInput[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the marksheet/degree.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });

            // Prevent form submission if any validation failed
            if (!isValid) {
                return false;
            } else {
                $("#educationalDetailsForm").submit();
                if(id==="educationalDetailsBtn1"){
                    let nextTab = 3; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 3); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }
            }
        });

        /************************END Educationaldetails validation *************** */




        $(document).on("click", "#workExperienceDetailsBtn , #workExperienceDetailsBtn1", function() {

            let isValid = true;
            let id = this.id;
            $("#workClickedFrom").val(id);

            $("input[name='employer_name[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".employer_name_err").text("Please enter the employer name.");
                    isValid = false;
                } else if (!htmlTagPattern.test($(this).val())) {
                    $(".employer_name_err").text(htmlTagMsg);
                    isValid = false;
                } else {
                    $(this).next(".employer_name_err").text("");
                }


            });

            $("input[name='post_held[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".post_held_err").text("Please enter the post held name.");
                    isValid = false;
                } else if (!htmlTagPattern.test($(this).val())) {
                    $(".post_held_err").text(htmlTagMsg);
                    isValid = false;
                } else {
                    $(this).next(".post_held_err").text("");
                }
            });

            // $("select[name='post_held[]']").each(function(index) {
            //     if ($(this).val().trim() === "") {
            //         $(this).next(".post_held_err").text("Please enter the post held.");
            //         isValid = false;
            //     } else {
            //         $(this).next(".post_held_err").text("");
            //     }
            // });

            $("input[name='from_date[]']").each(function(index) {
                var $fromInput = $(this);
                var $toInput = $("input[name='to_date[]']").eq(index);

                var fromDate = $fromInput.val().trim();
                var toDate = $toInput.val().trim();

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


            $("textarea[name='nature_of_duties[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".nature_of_duties_err").text(
                        "Please enter the nature of duties.");
                    isValid = false;
                } else if (!htmlTagPattern.test($(this).val())) {
                    $(".nature_of_duties_err").text(htmlTagMsg);
                    isValid = false;
                } else {
                    $(this).next(".nature_of_duties_err").text("");
                }
            });

            $("textarea[name='employer_details[]']").each(function(index) {

                if ($(this).val().trim() != "") {
                    if (!htmlTagPattern.test($(this).val())) {
                        $(".employer_details_err").text(htmlTagMsg);
                        isValid = false;
                    } else {
                        $(this).next(".employer_details_err").text("");
                    }
                }
            });

            $("select[name='job_type[]']").each(function(index) {
                if ($(this).val() === "") {

                    $(this).next(".job_type_err").text("Please select a job type.");
                    isValid = false;
                } else {
                    $(this).next(".job_type_err").text("");
                }
            });

            $("select[name='area_of_expertise[]']").each(function(index) {
                if ($(this).val() === "") {

                    $(this).next(".area_of_expertise_err").text(
                        "Please enter area of expertise.");
                    isValid = false;
                } else {
                    $(this).next(".area_of_expertise_err").text("");
                }
            });

            $("input[name='other_area_of_expertise[]']").each(function(index) {
                if (($(this).val() === "") && ($(".otherAreaOfExpertiseDiv").attr('style') ==
                        "")) {
                    $(this).next("#other_area_of_expertise_err").text(
                        "Please enter area of expertise name.");
                    isValid = false;
                } else {
                    $(this).next("#other_area_of_expertise_err").text("");
                }
            });

            $("input[name='experience_certificate[]']").each(function(index) {

                let experience_certificateInput = $(this);
                let errorMessageSpan = experience_certificateInput.closest(
                    '.attachment_section_experience_certificate').find(
                    '.experience_certificate_err');

                if (experience_certificateInput[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the experience certificate.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });

            if (!isValid) {
                return false;
            } else {
                $("#workExperienceDetailsForm").submit();
                if(id==="workExperienceDetailsBtn"){
                    let nextTab = 4; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 4); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }
            }

        });

        $(document).on("change", "#area_of_expertise", function() {
            let value = $("#area_of_expertise").val();
            let selectedText = $('#area_of_expertise option[value="' + value + '"]:selected').text();
            value = selectedText;

            if (value == "Others") {
                $(".otherAreaOfExpertiseDiv").show();
            } else {
                $(".otherAreaOfExpertiseDiv").css("display", "none");
                $(".areaOfExpertiseDiv").show();
            }
        });

        /**************************END Work Experience Details  ******************* */

        /***************  Additional Details Validation  ************************** */
        $(document).on("click", "#additionalDetailsBtn , #additionalDetailsBtn1", function() {

            let isValid = true;
            let id = this.id;
            $("#addClickedFrom").val(id);

            $("input[name='award_name[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".award_name_err").text(
                        "Please enter the award/achievement name.");
                    isValid = false;
                } else if (!htmlTagPattern.test($(this).val())) {
                    $(".award_name_err").text(htmlTagMsg);
                    isValid = false;
                } else {
                    $(this).next(".award_name_err").text("");
                }
            });

            $("textarea[name='award_details[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".award_details_err").text(
                        "Please enter the award/achievement details.");
                    isValid = false;
                } else if (!htmlTagPattern.test($(this).val())) {
                    $(".award_details_err").text(htmlTagMsg);
                    isValid = false;
                } else {
                    $(this).next(".award_details_err").text("");
                }
            });

            $("input[name='award_certificate[]']").each(function() {

                let award_certificate = $(this);
                let errorMessageSpan = award_certificate.closest(
                    '.attachment_section_award_certificate').find('.award_certificate_err');

                if (award_certificate[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the award/achievement certificate.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });

            if (!isValid) {
                return false;
            } else {
                $("#additionalDetailsForm").submit();
                if(id==="additionalDetailsBtn"){
                    let nextTab = 6; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 6); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }
            }

        });

        /**********************END Additional Details Validation ************************ */

        /***************  Competitive Exams Validation  ************************** */
        $(document).on("click", "#competitiveBtn , #competitiveBtn1", function() {

            let isValid = true;
            let id = this.id;
            $("#competClickedFrom").val(id);

            $("select[name='name_of_exam[]']").each(function(index) {
                if ($(this).val().trim() == "") {
                    $(this).next(".name_of_exam_err").text("Please enter the name of exam.");
                    isValid = false;
                } else {
                    $(this).next(".name_of_exam_err").text("");
                }
            });

            $("select[name='conducting_agency[]']").each(function(index) {
                if ($(this).val().trim() == "") {
                    $(this).next(".conducting_agency_err").text("The conducting agency field is required.");
                    isValid = false;
                } else {
                    $(this).next(".conducting_agency_err").text("");
                }
            });

            $("select[name='appearing_year[]']").each(function(index) {

                let currentYear = new Date().getFullYear();
                let fiftyYearsBack = currentYear - 50;
                let inputVal = $(this).val().trim();

                if (inputVal === "") {
                    $(this).next(".appearing_year_err").text(
                        "Please enter the appearing year.");
                    isValid = false;
                } else if (isNaN(inputVal)) {
                    $(this).next(".appearing_year_err").text(
                        "Please enter a valid appearing year.");
                    isValid = false;
                }
                //  else if (parseInt(inputVal) > currentYear) {
                //     $(this).next(".appearing_year_err").text("appearing year cannot be greater than the current year.");
                //     isValid = false;
                // } else if (parseInt(inputVal) < fiftyYearsBack) {
                //     $(this).next(".appearing_year_err").text("appearing year cannot be more than 50 years back.");
                //     isValid = false;
                // }
                else {
                    $(this).next(".appearing_year_err").text("");
                }

            });

            $("textarea[name='score[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".score_err").text("Please enter the score.");
                    isValid = false;
                } else if (isNaN($(this).val().trim())) {
                    $(this).next(".score_err").text("Score should be a number.");
                    isValid = false;
                } else {
                    $(this).next(".score_err").text("");
                }
            });

            $("input[name='certificate[]']").each(function() {

                let certificate = $(this);
                let errorMessageSpan = certificate.closest('.attachment_section_certificate')
                    .find('.certificate_err');

                if (certificate[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the certificate.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });

            if (!isValid) {
                return false;
            } else {
                $("#competitiveForm").submit();
                if(id==="competitiveBtn"){
                    let nextTab = 5; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 5); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }
            }

        });

        /***************  End Competitive Exams Validation  ************************** */

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
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        var fileName = encodeURIComponent(response.file_name);
                        var pathName = encodeURIComponent('uploads/candidate/photos/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;
                        //$("#upload_photos").val(url);
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

        /*****************************Start code For Resume Upload ************************  */

        $('.upload_resume').on('change', function() {
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
            formData.append('upload_resume', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('uploads/candidate/resume/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        let ii = 0;

                        //$this.parents('.attachment_section_resume').find('input[type="file"]').hide();
                        $this.parents('.attachment_section_resume').find(
                            '.hide_upload_resume').hide();
                        $this.parents('.attachment_section_resume').find(
                            'input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_resume').siblings(
                            '.attachment_section_resume').show();

                        $('.attachment_section_resume').append('<div id="temp_12' + ii +
                            '" class="my-3"><a target="_blank" href="' + url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_resume" data-id="' +
                            ii++ + '" data-name="' + response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp');

                        $("#upload_resumee").val(url);
                        $('#upload_resume_err').text('');
                    } else {
                        $("#upload_resumee").val('');
                        $('#upload_resume_err').text(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + status + " " + error);
                    $("#upload_resumee").val('');
                    $('#upload_resume_err').text('Something went wrong. Please try again.');
                }
            });
        });

        $(document).on('click', '.report_remove_resume', function() {

            $(this).closest('.attachment_preview').find('input').val('');
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            var $this = $(this);
            var id = $(this).attr("data-id");
            $this.parents('.attachment_section_resume').find('.hide_upload_resume').show();
            $this.parents('#temp_12' + id).hide();
            $("#hiddendoc_upload_cover_photo").val('');
        });

        /*****************************End Resume Upload Code **************************** */

        /*********************Start Code For Signature Upload ************************** */
        $('.upload_signature').on('change', function() {
            let $this = $(this);

            // Check the file type
            if ($this[0].files[0].type !== 'image/jpeg' && $this[0].files[0].type !== 'image/png' && $this[0].files[0].type !== 'image/jpg') {
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
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl, // Update with the correct route
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
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
            //   if (file.type != 'image/jpeg' && file.type !=
            //                 'image/png' && file.type != 'image/jpg' && file
            //                 .type != 'image/JPG' && file.type != 'image/JPEG') {
            //       Swal.fire({
            //           icon: 'error',
            //           title: 'Invalid File Extension',
            //           text: 'Please upload PDF or Image only',
            //       });
            //       $this.val("");
            //       return false;
            //   }
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
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response,
                    //     "**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
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
                        /*$('.attachment_section').append(`
                            <div id="temp${autoid}">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                            </div>
                        `);*/
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
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response,
                    //     "**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
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
                        /*$('.attachment_section').append(`
                            <div id="temp${autoid}">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                            </div>
                        `);*/
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


        /**************************Start Code for Experience Certificate ********************* */


        /**************************Start Code for Award Certificate ********************* */
        $(document).on('change', '.award_certificate', function() {
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
            formData.append('award_certificate', file);
            formData.append('type', file.type);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response,
                    //     "**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent(
                            '/uploads/candidate/award_certificate/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl = url;
                        var autoid = $this.attr('id').split('_')[2];
                        $this.hide();
                        $this.closest('.attachment_section_award_certificate').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_award_certificate').find(
                            '.award_certificatee').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest(
                            '.attachment_section_award_certificate');
                        $section.append(`
                 <div id="temp${autoid}" class="my-3">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                 </div>
             `);
                        /*$('.attachment_section').append(`
                            <div id="temp${autoid}">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                            </div>
                        `);*/
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
            $(`#award_certificate_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });


        /**************************End Code for Award Certificate ********************* */

        /**************************Start Code for Competition Certificate ********************* */
        $(document).on('change', '.certificate', function() {
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
            if (file.size > 2000000) {
                Swal.fire({
                    icon: 'error',
                    title: 'File size large',
                    text: 'Please select 2 MB PDF only!',
                });
                $this.val("");
                return false;
            }

            var formData = new FormData();
            formData.append('certificate', file);
            formData.append('type', file.type);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent(
                            '/uploads/candidate/certificate/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl = url;
                        var autoid = $this.attr('id').split('_')[2];
                        $this.hide();
                        $this.closest('.attachment_section_certificate').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_certificate').find(
                            '.certificatee').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest('.attachment_section_certificate');
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
            $(`#certificate_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });


        /**************************Start Code for Achievments ********************* */

        /**************************Code to handle Tabs ******************* *****   */

        $(document).on('click', '.report_remove_pre', function() {
            $(this).parent().hide();
            $(this).closest('.attachment_preview').find('.upload_cust').show();
            $(this).closest('.attachment_preview').find('input').val('');
        });

        $(document).on('change', '#qualification', function () {
            const $this = $(this);
            const courses = JSON.parse($this.attr('data-courses') || '[]');
            const qualificationId = Number($this.val());
            const $course = $('#course');
            const $otherDiv = $('.otherQualificationDiv');
            const $qualificationDiv = $('.qualificationDiv');

            let optionsHtml = '<option value="">Select Course</option>';

            courses.forEach(course => {
                if (course.ref_qualification_id === qualificationId) {
                    optionsHtml += `<option value="${course.id}">${course.course_name}</option>`;
                }
            });

            $course.html(optionsHtml);

            const selectedQualificationText = $this.find('option:selected').text();

            if (selectedQualificationText.trim() === "Others") {
                $otherDiv.show();
            } else {
                $otherDiv.hide();
                $qualificationDiv.show();
            }
        });

        //$("#course").change(function() {
        $(document).on("change", "#course", function() {
            let value = $("#course").val();
            let selectedText = $('#course option[value="' + value + '"]:selected').text();
            value = selectedText;

            if (value == "Others") {
                $(".otherCourseDiv").show();
            } else {
                $(".otherCourseDiv").css("display", "none");
                $(".courseDiv").show();
            }
        });

        $(document).on("change", "#main_subject", function() {
            let value = $("#main_subject").val();
            let selectedText = $('#main_subject option[value="' + value + '"]:selected').text();
            value = selectedText;

            if (value == "Others") {
                $(".otherMainSubjectDiv").show();
            } else {
                $(".otherMainSubjectDiv").css("display", "none");
                $(".mainSubjectDiv").show();
            }
        });

        $(document).on("change", "#board_university_collage", function() {
            let value = $("#board_university_collage").val();
            let selectedText = $('#board_university_collage option[value="' + value + '"]:selected').text();

            if (selectedText.trim() === "Others") {
                $(".otherCollegeDiv").show();
            } else {
                $(".otherCollegeDiv").css("display", "none");
                $(".collegeDiv").show();
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


    $(document).ready(function() {

        const htmlTagPattern = /^[A-Za-z0-9.,@_\-\s]+$/;
        const htmlTagMsg = "HTML tags are not allowed";


        /**************************Tarining/Certification Validation and Submition  ********************** */

        $(document).on("click", "#trainingBtn,#trainingAddBtn", function() {
            let id = this.id;
            let $name_of_training = $("#name_of_training").val();
            let $training_start_date = $("#training_start_date").val();
            let $training_end_date = $("#training_end_date").val();
            let $description = $("#description").val();
            // let   $certificate_expiry_date= $("#certificate_expiry_date").val();
            let $training_certificate = $("#training_certificate").val();


            $("#name_of_training_err").text("");
            $("#training_start_date_err").text("");
            $("#training_end_date_err").text("");
            $("#description_err").text("");
            // $("#certificate_expiry_date_err").text("");
            $("#training_certificate_err").text("");

            let $err = 0;
            if ($name_of_training == "") {
                $("#name_of_training_err").text("Training name field is required");
                $err = 1;
            } else {
                if (($name_of_training.length > 50) || ($name_of_training.length < 2)) {
                    $("#name_of_training_err").text("Training name should be of 2 to 50 characters");
                    $err = 1;
                } else if (!htmlTagPattern.test($name_of_training)) {

                    $("#name_of_training_err").text(htmlTagMsg);
                    $err = 1;
                }
            }

            if ($training_start_date == "") {
                $("#training_start_date_err").text("Start date field is required");
                $err = 1;
            }

            if ($training_end_date == "") {
                $("#training_end_date_err").text("End date field is required");
                $err = 1;
            } else if (new Date($training_end_date) < new Date($training_start_date)) {
                $("#training_end_date_err").text("End date cannot be before the start date");
                $err = 1;
            }

            // Optionally, if you also want to check that the start date is not after the end date:
            if (new Date($training_start_date) > new Date($training_end_date)) {
                $("#training_start_date_err").text("Start date cannot be after the end date");
                $err = 1;
            }

            if ($description == "") {
                $("#description_err").text("Description field is required");
                $err = 1;
            } else if (!htmlTagPattern.test($description)) {

                $("#description_err").text(htmlTagMsg);
                $err = 1;
            } else {
                $("#description_err").text();
            }


            // if($certificate_expiry_date){
            //  $("#certificate_expiry_date_err").text("Certificate expiry date field is required");
            //     $err=1;
            // }

            if ($training_certificate == "") {
                $("#training_certificate_err").text("Certificate field is required");
                $err = 1;
            }
            if (id) {
                $("#trainClickedFrom").val(id);
            }
            if ($err) {
                return false;
            } else {
                $("#trainingDetailsForm").submit();
                if(id==="trainingBtn"){
                    let nextTab = 7; // or dynamically determine next tab
                    setCookie("selected_tab_candidate", nextTab, 7); // store for reload
                    loadStep(nextTab); // load the next tab dynamically
                }
            }


        });


        /**************************Start Code for Training Certificate ********************* */
        $(document).on('change', '.training_certificate', function() {
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
            formData.append('training_certificate', file);
            formData.append('type', file.type);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // console.log(response,
                    //     "**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent(
                            '/uploads/candidate/training_certificate/');
                        let url =
                            `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl = url;
                        var autoid = $this.attr('id').split('_')[2];
                        $this.hide();
                        $this.closest('.attachment_section_training_certificate').find(
                            '.upload_cust').hide();
                        $this.closest('.attachment_section_training_certificate').find(
                            '.training_certificatee').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest(
                            '.attachment_section_training_certificate');
                        $section.append(`
                        <div id="temp${autoid}" class="my-3">
                            <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                            <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                        </div>
                    `);
                        /*$('.attachment_section').append(`
                            <div id="temp${autoid}">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Remove</a>
                            </div>
                        `);*/
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
            $(`#training_certificate_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });
    });

    $(document).on("click", ".tablink", function(e) {
        e.preventDefault();

        let linkid = parseInt($(this).attr("id").replace(/\D/g, ""), 10);
        let currentTab = parseInt(getCookie("selected_tab_candidate") || 1, 10);

        // Validate all required steps before the one user clicked
        for (let i = 1; i < linkid; i++) {
            if (stepRules[i]?.required && typeof stepRules[i].validator === "function") {
                if (!stepRules[i].validator()) {
                    Swal.fire("Error", `Kindly finish Step ${i} to proceed further.`, "error");
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
            let selectedTab = getCookie("selected_tab_candidate");
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute("content");
            const finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/candidate/candidate_details?tab_id=${linkid}`
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

                    let tabId = response.tab_id;
                    if (tabId === "1") personalDeatils(response);
                    if (tabId == "2") educationalDetails(response);
                    if (tabId == "3") experienceDetails(response);
                    if (tabId == "4") competitiveExam(response);
                    if (tabId == "5") additionalDetails(response);
                    if (tabId == "6") trainingDetails(response);
                    if (tabId == "7") applicationPreview(response);
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
            3: { required: true, validator: validateExperienceDetails },
            4: { required: false },
            5: { required: false },
            6: { required: false },
            7: { required: true, validator: validatePreview }
        };

        function validatePersonalDetails() {
            let father_husband_name = $("#father_husband_name").val();
            let mobile_no  = $("#mobile_no").val();
            let address  = $("#correspondence_address").val();
            return father_husband_name.trim() !== "" && mobile_no.trim() !== "" && address.trim() !== "" ;
        }

        function validateEducationDetails() {
            if (window.hasEducation) {
                return true; // already saved in DB, no need to validate again
            }

            let qualification = $("#qualification").val();
            let course = $("#course").val();
            let university_board = $("#board_university_collage").val();
            let main_subject = $("#main_subject").val();
            let passing_year = $("#passing_year").val();
            let percentage_cgpa = $("#percentage").val();
            let marksheet_degree = $("#marksheet_degree").val();
            return qualification.trim() !== "" && course.trim() !== "" && university_board.trim() !== "" && main_subject.trim() !== "" && passing_year.trim() !== "" && percentage_cgpa.trim() !== "" && marksheet_degree.trim() !== "";
        }

        function validateExperienceDetails() {
            if (window.hasExperience) {
                return true; // already saved in DB, no need to validate again
            }

            let employer_name = $("#employer_name").val();
            let post_held = $("#post_held").val();
            let nature_of_duties = $("#nature_of_duties").val();
            let area_of_expertise = $("#area_of_expertise").val();
            let job_type = $("#job_type").val();
            return employer_name.trim() !== "" && post_held.trim() !== "" && nature_of_duties.trim() !== "" && area_of_expertise.trim() !== "" && job_type.trim() !== "";
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
