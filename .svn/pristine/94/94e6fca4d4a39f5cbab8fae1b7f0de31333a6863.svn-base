    $(document).ready(function(){

        /********************Personal details form  validation ******************** */
        $(document).on("click","#personalDetailsSaveBtn",function(){
            let   $full_name= $("#full_name").val();
            let   $father_husband_name= $("#father_husband_name").val();
            let   $email= $("#email").val();
            let   $mobile_no= $("#mobile_no").val();
            let   $date_of_birth= $("#date_of_birth").val();
            let   $ref_engagement_id= $("#ref_engagement_id").val();
            let   $gender= $("#gender").val();
            let   $correspondence_address= $("#correspondence_address").val();
            let   $permanent_address= $("#permanent_address").val();
            let   $upload_photos= $("#upload_photos").val();
            let   $upload_signature= $("#upload_signature").val();
            let   $upload_resume= $("#upload_resume").val();

           $("#full_name_err").text("");
           $("#father_husband_name_err").text("");
           $("#email_err").text("");
           $("#mobile_no_err").text("");
           $("#date_of_birth_err").text("");
           $("#ref_engagement_id_err").text("");
           $("#gender_err").text("");
           $("#correspondence_address_err").text("");
           $("#permanent_address_err").text("");
           $("#upload_photos_err").text("");
           $("#upload_signature_err").text("");
           $("#upload_resume_err").text("");
            // alert($father_husband_name.length);
            //    $("#personalDetailsForm").submit();
            //    return false;
           let $err =0;
           if($full_name==""){
             $("#full_name_err").text("Full name field is required");
                $err=1;
            }else{
                if(($full_name.length>50) || ($full_name.length<2) ){
                    $("#full_name_err").text("Full name should be of 2 to 50 characters");
                        $err=1;
                }
           }
           if($father_husband_name==""){
             $("#father_husband_name_err").text("Father/Husband name field is required");
                $err=1;
            }else{
                if(($father_husband_name.length>50) || ($father_husband_name.length<2) ){
                    $("#father_husband_name_err").text("Father/Husband name should be of 2 to 50 characters");
                        $err=1;
                }
            }
           if($email==""){
             $("#email_err").text("Email field is required");
                $err=1;
            }
           else{
                if(isEmail($email)==false){
                    $("#email_err").text("Invalid email!");
                        $err=1;
                }
           }
           if($mobile_no==""){
             $("#mobile_no_err").text("Mobile number field is required");
                $err=1;
            }else{
                if(isNaN($mobile_no)){
                    $("#mobile_no_err").text("Mobile number should be only numbers");
                        $err=1;
                }else{
                    if(($mobile_no.length>15) || ($mobile_no.length<7)){
                        $("#mobile_no_err").text("Mobile number should be of 7 to 15 digits");
                            $err=1;
                    }
                }
           }

           if($date_of_birth==""){
             $("#date_of_birth_err").text("Date of birth field is required");
                $err=1;
           }
           else{
                if(getAge($date_of_birth)<18){
                    $("#date_of_birth_err").text("Date of birth showing invalid age");
                        $err=1;
                }
           }

           if($ref_engagement_id==""){
             $("#ref_engagement_id_err").text("Please select the Engagement type that you are applying for");
                $err=1;
            }
           if($gender==""){
             $("#gender_err").text("Gender field is required");
                $err=1;
            }
           if($correspondence_address==""){
             $("#correspondence_address_err").text("Correspondence address field is required");
                $err=1;
            }
           if($permanent_address==""){
             $("#permanent_address_err").text("Permanent address field is required");
                $err=1;
            }
           if(($upload_photos=="") && ($("#upload_photoss").val()=="") ){
             $("#upload_photos_err").text("Upload photo field is required");
                $err=1;
            }
           if(($upload_signature=="") && ($("#upload_signaturee").val()=="")){
             $("#upload_signature_err").text("Upload signature field is required");
                $err=1;
            }
           if(($upload_resume=="") && ($("#upload_resumee").val()=="")){
             $("#upload_resume_err").text("Upload CV field is required");
                $err=1;
            }
           if($err){
            return false;
           }else{
            $("#personalDetailsForm").submit();
           }

        });

        $("#upload_photos").change(function(){
            let filename = $('#upload_photos').val();
            $("#upload_photoss").val(filename);
        });

        $("#upload_signature").change(function(){
            let filename = $('#upload_signature').val();
            $("#upload_signaturee").val(filename);
        });
        $("#upload_resume").change(function(){
            let filename = $('#upload_resume').val();
            $("#upload_resumee").val(filename);
        });

        $("#forSame").click(function(){
            let filename = $('#correspondence_address').val();
            $("#permanent_address").val(filename);
        });
        /*************************end personaldetails validation **************** */

        /*********************Educational-details validation *********************** */
        $(document).on("click","#educationalDetailsBtn1",function(){
            let isValid = true;

            // Loop through the qualification, course, and other array fields
            $("select[name='qualification[]']").each(function(index) {
                if ($(this).val() === "") {

                    $(this).next(".qualification_err").text("Please select a qualification.");
                    isValid = false;
                } else {
                    $(this).next(".qualification_err").text("");
                }
            });

            $("select[name='course[]']").each(function(index) {
                if ($(this).val() === "") {
                    $(this).next(".course_err").text("Please select a course.");
                    isValid = false;
                } else {
                    $(this).next(".course_err").text("");
                }
            });

            $("input[name='board_university_collage[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".board_university_collage_err").text("Please enter the Board/University/College.");
                    isValid = false;
                } else {
                    $(this).next(".board_university_collage_err").text("");
                }
            });

            $("textarea[name='main_subject[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".main_subject_err").text("Please enter the main subjects.");
                    isValid = false;
                } else {
                    $(this).next(".main_subject_err").text("");
                }
            });

            $("select[name='course_mode[]']").each(function(index) {
                if ($(this).val() === "") {
                    $(this).next(".course_mode_err").text("Please select a course mode.");
                    isValid = false;
                } else {
                    $(this).next(".course_mode_err").text("");
                }
            });

            $("input[name='passing_year[]']").each(function(index) {

                let currentYear = new Date().getFullYear();
                let fiftyYearsBack = currentYear - 50;
                let inputVal = $(this).val().trim();

                if (inputVal === "") {
                    $(this).next(".passing_year_err").text("Please enter the passing year.");
                    isValid = false;
                } else if (isNaN(inputVal)) {
                    $(this).next(".passing_year_err").text("Please enter a valid passing year.");
                    isValid = false;
                } else if (parseInt(inputVal) > currentYear) { // Check if the year is greater than the current year
                    $(this).next(".passing_year_err").text("Passing year cannot be greater than the current year.");
                    isValid = false;
                } else if (parseInt(inputVal) < fiftyYearsBack) { // Check if the year is more than 50 years ago
                    $(this).next(".passing_year_err").text("Passing year cannot be more than 50 years back.");
                    isValid = false;
                } else {
                    $(this).next(".passing_year_err").text("");
                }

            });

            $("input[name='percentage[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".percentage_err").text("Please enter the percentage.");
                    isValid = false;
                }else if(isNaN($(this).val().trim())){
                    $(this).next(".percentage_err").text("Percentage should have a numeric value.");
                    isValid = false;
                }
                else {
                    $(this).next(".percentage_err").text("");
                }
            });

            $("input[name='cgpa[]']").each(function(index) {
                if (($(this).val().trim()!="") && (isNaN($(this).val().trim()))) {
                    $(this).next(".cgpa_err").text("CGPA should be a numeric value.");
                    isValid = false;
                } else {
                    $(this).next(".cgpa_err").text("");
                }
            });
            // Validate Marksheet/Degree File Upload
            $("input[name='marksheet_degree[]']").each(function(index) {
               let marksheet_degreeInput = $(this);
               let errorMessageSpan = marksheet_degreeInput.closest('.attachment_section_marksheet_degree').find('.marksheet_degree_err');

               if (marksheet_degreeInput[0].files.length === 0) {
                   errorMessageSpan.text("Please choose the marksheet/degree.");
                   isValid = false;
               } else {
                   errorMessageSpan.text("");
               }
            });

            // Prevent form submission if any validation failed
            if (!isValid) {
                //alert("false");
                return false;
            }else{
                //alert("true");
                $("#educationalDetailsForm").submit();
            }
        });

        /************************END Educationaldetails validation *************** */


        /*************************Work Experience Details Validation Start *****************/
        // $(document).on("click","#workExperienceDetailsBtn",function(){

        //     let   $employer_name= $("#employer_name").val();
        //     let   $post_held= $("#post_held").val();
        //     let   $from_date= $("#from_date").val();
        //     let   $to_date= $("#to_date").val();
        //     let   $nature_of_duties= $("#nature_of_duties").val();
        //     let   $employer_details= $("#employer_details").val();
        //     let   $job_type= $("#job_type").val();
        //     let   $experience_certificate= $("#experience_certificate").val();

        //     //alert($experience_certificate);

        //     $("#employer_name_err").text("");
        //     $("#post_held_err").text("");
        //     $("#from_date_err").text("");
        //     $("#to_date_err").text("");
        //     $("#nature_of_duties_err").text("");
        //     $("#employer_details_err").text("");
        //     $("#job_type_err").text("");
        //     $("#experience_certificate_err").text("");

        //     $err=0;
        //     if($employer_name==""){
        //         $("#employer_name_err").text("Employer name field is required");
        //         $err=1;
        //     }
        //     if($post_held==""){
        //      $("#post_held_err").text("Post helde field is required");
        //         $err=1;
        //     }
        //     if($from_date==""){
        //         $("#from_date_err").text("From date field is required");
        //         $err=1;
        //     }
        //     if($to_date==""){
        //         $("#to_date_err").text("To date field is required");
        //         $err=1;
        //     }
        //     if($nature_of_duties==""){
        //         $("#nature_of_duties_err").text("Nature of duties field is required");
        //         $err=1;
        //     }
        //     if($employer_details==""){
        //         $("#employer_details_err").text("Employer details field is required");
        //         $err=1;
        //     }
        //     if($job_type==""){
        //         $("#job_type_err").text("Job type field is required");
        //         $err=1;
        //     }
        //     if($experience_certificate==""){
        //         $("#experience_certificate_err").text("Experience certificate field is required");
        //         $err=1;
        //     }
        //     if($err){
        //         return false;
        //     }else{
        //         $("#workExperienceDetailsForm").submit();
        //     }


        // });

        $(document).on("click","#workExperienceDetailsBtn",function(){

            let isValid=true;

            $("input[name='employer_name[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".employer_name_err").text("Please enter the employer name.");
                    isValid = false;
                } else {
                    $(this).next(".employer_name_err").text("");
                }
            });

            $("input[name='post_held[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".post_held_err").text("Please enter the post held.");
                    isValid = false;
                } else {
                    $(this).next(".post_held_err").text("");
                }
            });

            $("input[name='from_date[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".from_date_err").text("Please enter the from date.");
                    isValid = false;
                } else {
                    $(this).next(".from_date_err").text("");
                }
            });

            $("input[name='to_date[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".to_date_err").text("Please enter the to date.");
                    isValid = false;
                } else {
                    $(this).next(".to_date_err").text("");
                }
            });

            $("textarea[name='nature_of_duties[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".nature_of_duties_err").text("Please enter the nature of duties.");
                    isValid = false;
                } else {
                    $(this).next(".nature_of_duties_err").text("");
                }
            });

            $("textarea[name='employer_details[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".employer_details_err").text("Please enter the employer details.");
                    isValid = false;
                } else {
                    $(this).next(".employer_details_err").text("");
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

            $("input[name='experience_certificate[]']").each(function(index) {

                let experience_certificateInput = $(this);
                let errorMessageSpan = experience_certificateInput.closest('.attachment_section_experience_certificate').find('.experience_certificate_err');

                if (experience_certificateInput[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the experience certificate.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });

            if(!isValid){
                return false;
            }else{
                $("#workExperienceDetailsForm").submit();
            }

        });

        /**************************END Work Experience Details  ******************* */

        /***************  Additional Details Validation  ************************** */
        $(document).on("click","#additionalDetailsBtn",function(){

            let isValid=true;

            $("input[name='award_name[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".award_name_err").text("Please enter the award/achievement name.");
                    isValid = false;
                } else {
                    $(this).next(".award_name_err").text("");
                }
            });

            $("textarea[name='award_details[]']").each(function(index) {
                if ($(this).val().trim() === "") {
                    $(this).next(".award_details_err").text("Please enter the award/achievement details.");
                    isValid = false;
                } else {
                    $(this).next(".award_details_err").text("");
                }
            });

            $("input[name='award_certificate[]']").each(function () {

                let award_certificate = $(this);
                let errorMessageSpan = award_certificate.closest('.attachment_section_award_certificate').find('.award_certificate_err');

                if (award_certificate[0].files.length === 0) {
                    errorMessageSpan.text("Please choose the award/achievement certificate.");
                    isValid = false;
                } else {
                    errorMessageSpan.text("");
                }
            });


            // $("input[name='achievements[]']").each(function (index) {
            //     let achievementInput = $(this);
            //     let errorMessageSpan = achievementInput.closest('.attachment_section_achievements').find('.achievements_err');

            //     if (achievementInput[0].files.length === 0) {
            //         errorMessageSpan.text("Please choose the achievement.");
            //         isValid = false;
            //     } else {
            //         errorMessageSpan.text("");
            //     }
            // });

           if(!isValid){
                //alert("false");
                return false;
           }else{
                //alert("true");
                $("#additionalDetailsForm").submit();
           }

        });

        /**********************END Additional Details Validation ************************ */


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
        //console.log(ageYear,"calculated age is");
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
        if ($this[0].files[0].type !== 'image/jpeg' && $this[0].files[0].type !== 'image/png' && $this[0].files[0].type !== 'image/jpg') {
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
            url: finalUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == true) {
                    var fileName = encodeURIComponent(response.file_name);
                    var pathName = encodeURIComponent('uploads/candidate/photos/');
                    let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                    url = url.replace(':fileName', fileName);
                    url = url.replace(':pathName', pathName);
                    let ii=0;
                    //$("#upload_photos").val(url);
                    $this.parents('.attachment_section_photos').find('.hide_upload_photos').hide();
                    $this.parents('.attachment_section_photos').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_section_photos').siblings('.attachment_section_photos').show();

                    $('.attachment_section_photos').append('<div id="temp_12' + ii + '" ><a target="_blank" href="' + url + '" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_photos" data-id="' + ii++ + '" data-name="' + response.file_name + '">Re-upload</a>&nbsp&nbsp&nbsp&nbsp');

                    $("#upload_photoss").val(response.file_name);
                } else {
                    alert(response.message);
                    $this.val('');
                }
            },
            error: function(xhr, status, error) {
                //console.error("Error occurred: " + status + " " + error);
            }
        });
    });
    $(document).on('click', '.report_remove_photos', function() {
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
            url: finalUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == true) {
                    let fileName = encodeURIComponent(response.file_name);
                    let pathName = encodeURIComponent('uploads/candidate/resume/');
                    let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                    url = url.replace(':fileName', fileName);
                    url = url.replace(':pathName', pathName);
                    let ii=0;

                    //$this.parents('.attachment_section_resume').find('input[type="file"]').hide();
                    $this.parents('.attachment_section_resume').find('.hide_upload_resume').hide();
                    $this.parents('.attachment_section_resume').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_section_resume').siblings('.attachment_section_resume').show();

                    $('.attachment_section_resume').append('<div id="temp_12' + ii + '" ><a target="_blank" href="' + url + '" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_resume" data-id="' + ii++ + '" data-name="' + response.file_name + '">Re-upload</a>&nbsp&nbsp&nbsp&nbsp');

                    $("#upload_resumee").val(response.file_name);
                } else {
                    alert(response.message);
                    $this.val('');
                }
            },
            error: function(xhr, status, error) {
                //console.error("Error occurred: " + status + " " + error);
            }
        });
    });

    $(document).on('click', '.report_remove_resume', function() {
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
            url: finalUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == true) {
                    let fileName = encodeURIComponent(response.file_name);
                    let pathName = encodeURIComponent('uploads/candidate/signature/');
                    let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                    url = url.replace(':fileName', fileName);
                    url = url.replace(':pathName', pathName);
                    let ii=0;

                    //$this.parents('.attachment_section').find('input[type="file"]').hide();
                    $this.parents('.attachment_section_sign').find('.hide_upload_signature').hide();
                    $this.parents('.attachment_section_sign').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_section_sign').siblings('.attachment_section_sign').show();

                    $('.attachment_section_sign').append('<div id="temp_12' + ii + '" ><a target="_blank" href="' + url + '" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_signature" data-id="' + ii++ + '" data-name="' + response.file_name + '">Re-upload</a>&nbsp&nbsp&nbsp&nbsp');

                    $("#upload_signaturee").val(response.file_name);
                } else {
                    alert(response.message);
                    $this.val('');
                }
            },
            error: function(xhr, status, error) {
                //console.error("Error occurred: " + status + " " + error);
            }
        });
    });

    $(document).on('click', '.report_remove_signature', function() {
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
       // alert(file.type);
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
            //console.log(response,"**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
              if (response.status === true) {
                let fileName = encodeURIComponent(response.file_name);
                let pathName = encodeURIComponent('/uploads/candidate/marksheet_degree/');
                let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                url = url.replace(':fileName', fileName);
                url = url.replace(':pathName', pathName);
                  var fileUrl =url;
                  var autoid = $this.attr('id').split('_')[2];
                  //alert(autoid);
                  $this.hide();
                  $this.closest('.attachment_section_marksheet_degree').find('.marksheet_degreee').val(fileUrl);
                  $this.siblings('input[type="hidden"]').val(response.file_name);

                   var $section = $this.closest('.attachment_section_marksheet_degree');
                   $section.append(`
                 <div id="temp${autoid}">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                 </div>
             `);
                  /*$('.attachment_section').append(`
                      <div id="temp${autoid}">
                          <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                          <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
            //console.log(response,"**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
              if (response.status === true) {
                let fileName = encodeURIComponent(response.file_name);
                let pathName = encodeURIComponent('/uploads/candidate/experience_certificate/');
                let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                url = url.replace(':fileName', fileName);
                url = url.replace(':pathName', pathName);
                  var fileUrl =url;
                  var autoid = $this.attr('id').split('_')[2];
                 // alert(autoid);
                  $this.hide();
                  $this.closest('.attachment_section_experience_certificate').find('.experience_certificatee').val(fileUrl);
                  $this.siblings('input[type="hidden"]').val(response.file_name);

                   var $section = $this.closest('.attachment_section_experience_certificate');
                   $section.append(`
                 <div id="temp${autoid}">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                 </div>
             `);
                  /*$('.attachment_section').append(`
                      <div id="temp${autoid}">
                          <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                          <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
            //console.log(response,"**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
              if (response.status === true) {
                let fileName = encodeURIComponent(response.file_name);
                let pathName = encodeURIComponent('/uploads/candidate/award_certificate/');
                let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                url = url.replace(':fileName', fileName);
                url = url.replace(':pathName', pathName);
                  var fileUrl =url;
                  var autoid = $this.attr('id').split('_')[2];
                 // alert(autoid);
                  $this.hide();
                  $this.closest('.attachment_section_award_certificate').find('.award_certificatee').val(fileUrl);
                  $this.siblings('input[type="hidden"]').val(response.file_name);

                   var $section = $this.closest('.attachment_section_award_certificate');
                   $section.append(`
                 <div id="temp${autoid}">
                     <a target="_blank" href="${fileUrl}" class="quick-btn view-btn report_preview">View</a>&nbsp;
                     <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                 </div>
             `);
                  /*$('.attachment_section').append(`
                      <div id="temp${autoid}">
                          <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                          <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
      var autoid = $(this).data('id');
      $(`#award_certificate_${autoid}`).show().prop('required', true);
      $(`#hidden_document_${autoid}`).val('');
      $(this).parent().remove();
   });


    /**************************Start Code for Award Certificate ********************* */

    /**************************Start Code for Achievments ********************* */
        $(document).on('change', '.achievements', function() {
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
            formData.append('achievements', file);
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
                    //console.log(response,"**********************JJJJJJJJJJJJJKKKKKKKKKKKKK");
                    if (response.status === true) {
                        let fileName = encodeURIComponent(response.file_name);
                        let pathName = encodeURIComponent('/uploads/candidate/achievements/');
                        let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        var fileUrl =url;
                        var autoid = $this.attr('id').split('_')[2];
                        // alert(autoid);
                        $this.hide();
                        $this.closest('.attachment_section_achievements').find('.achievementss').val(fileUrl);
                        $this.siblings('input[type="hidden"]').val(response.file_name);

                        var $section = $this.closest('.attachment_section_achievements');
                        $section.append(`
                        <div id="temp${autoid}">
                            <a target="_blank" href="${fileUrl}" class="quick-btn view-btn report_preview">View</a>&nbsp;
                            <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                        </div>
                    `);
                        /*$('.attachment_section').append(`
                            <div id="temp${autoid}">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                <a href="javascript:void(0);" class="quick-btn reupload-btn report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
            var autoid = $(this).data('id');
            $(`#achievements_${autoid}`).show().prop('required', true);
            $(`#hidden_document_${autoid}`).val('');
            $(this).parent().remove();
        });


    /**************************Start Code for Achievments ********************* */

    /**************************Code to handle Tabs ******************* *****   */

    $(document).on("click",".tablink",function(){

       let linkid= $(this).attr("id");
       setCookie('selected_tab_candidate', linkid, 7);
       let selectedTab=getCookie('selected_tab_candidate');
       //console.log(selectedTab);
       $('#loader').show();

       const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute('content');
        const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/candidate_details?tab_id=${linkid}` : null;

       $.ajax({
            url: finalUrl,
            type: 'GET',
            data: "",
            contentType: false,
            processData: false,
            success: function(response) {

                $('#loader').hide();
                if(response.tab_id=="1"){
                    personalDeatils(response);
                }
                if(response.tab_id=="2"){
                    educationalDetails(response);
                }
                if(response.tab_id=="3"){
                    experienceDetails(response);
                }
                if(response.tab_id=="4"){
                    additionalDetails(response);
                }
                if(response.tab_id=="5"){
                    applicationPreview(response);
                }
                //console.log(response);
            },
            error: function(xhr, status, error) {
               // alert("fail");
                //console.error("Error occurred: " + status + " " + error);
            }

       })
    })

    let sessionTab = @json(session('tab'))?@json(session('tab')):0;
        //console.log(sessionTab,"sessssssssssssionnnnnnnnnnnnn TAB");
       if(sessionTab){
        sessionTab=Number(sessionTab)+1;

        setTimeout(function(){
            $("#defaultOpen"+sessionTab).click();
        },1000);

       }
    //    else{
            let currentTab=getCookie('selected_tab_candidate');
            if(!currentTab){
                    $("#defaultOpen1").click();
            }
            $("#"+currentTab).click();
    //    }


});

function setCookie(cname,cvalue,exdays) {
  const d = new Date();
//   d.setTime(d.getTime() + (exdays*24*60*60*1000));   // set time in days
d.setTime(d.getTime() + (5*60*1000)); // set time in minute
  let expires = "expires=" + d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i < ca.length; i++) {
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
