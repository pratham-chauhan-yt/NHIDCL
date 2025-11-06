    function personalDeatils(response) {
        if ((response != null) && (response.data)) {
            $("#full_name").val(response.data.full_name ? response.data.full_name : "");
            $("#father_husband_name").val(response.data.father_husband_name ? response.data.father_husband_name : "");
            $("#email").val(response.data.email ? response.data.email : "");
            $("#mobile_no").val(response.data.mobile_no);
            $("#date_of_birth").val(response.data.date_of_birth ? response.data.date_of_birth : "");
            $("#ref_engagement_id").val(response.data.ref_engagement_id ? response.data.ref_engagement_id : "");
            $("#gender option[value='" + response.data.gender ? response.data.gender : '' + "']").attr("selected",
                "selected");
            $("#pincode").val(response.data.pincode ? response.data.pincode : "");
            $("#spouse_name").val(response.data.spouse_name ? response.data.spouse_name : "");
            $("#spouse_mobile_no").val(response.data.spouse_mobile_no ? response.data.spouse_mobile_no : "");
            $("#correspondence_address").val(response.data.correspondence_address ? response.data
                .correspondence_address : "");
            $("#permanent_address").val(response.data.permanent_address ? response.data.permanent_address : "");

            /********** Creating complete url from filename anf filepath ********************/
            let completPhoto = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data.upload_photos_filepath + "&fileName=" + response.data
                .upload_photos;
            let completSignature = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data.upload_signature_filepath + "&fileName=" + response.data
                .upload_signature;
            let completResume = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data.upload_resume_filepath + "&fileName=" + response.data
                .upload_resume;

            $("#upload_signaturee").val(response.data.upload_signature ? completSignature : "");
            $("#upload_resumee").val(response.data.upload_resume ? completResume : "");
            $("#upload_photoss").val(response.data.upload_photos ? completPhoto : "");
            $("#temp_photos").remove();
            $("#temp_resume").remove();
            $("#temp_signature").remove();
            /***********Showing view button so hiding upload button ********** */
            $('.attachment_preview').find('.hide_upload_resume').hide();
            $('.attachment_preview').find('.hide_upload_photos').hide();
            $('.attachment_preview').find('.hide_upload_signature').hide();
            /***********End Showing view button so hiding upload button ********** */

            /********************Appending view button on peronal details ************ */
            $('.attachment_section_photos').append(`<div id="temp_photos" class="my-3">
            <a target="_blank" href="` + completPhoto + `" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
            <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
            </div>`);

            $('.attachment_section_resume').append(`<div id="temp_resume"class="my-3">
            <a target="_blank" href="` + completResume + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
            <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
            </div>`);

            $('.attachment_section_sign').append(`<div id="temp_signature" class="my-3">
            <a target="_blank" href="` + completSignature + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
            <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
            </div>`);
            /********************End Appending view button on peronal details ************ */
        }

    }

    function educationalDetails(response) {

        let tableRow = ``;
        let param = [];
        for (let i = 0; i < response.data.length; i++) {
            let completMarksheet = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data[i].marksheet_degree_filepath + "&fileName=" + response.data[i]
                .marksheet_degree;
            param['tab_id'] = response.tab_id;
            param['id'] = response.data[i].id;
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${(() => {
                                const edu = response.data[i];
                                const qualification = edu.qualification;

                                if (!qualification) return "";

                                if (qualification.qualification_name === "Others") {
                                    return edu.other_qualification || "";
                                }

                                return qualification.qualification_name || "";
                                })()}</td>
                            <td>${response.data[i].board_university_college ? (response.data[i].board_university_college.name == 'Others' ? response.data[i].other_board_university_collage : response.data[i].board_university_college.name) :""}</td>
                            <td>${response.data[i].main_subject ? response.data[i].main_subject.subject_name : response.data[i].other_main_subject ? response.data[i].other_main_subject : ""}</td>
                            <td>${response.data[i].course_mode?response.data[i].course_mode.course_mode:""}</td>
                            <td>${response.data[i].ref_passing_year?response.data[i].ref_passing_year?.passing_year:""}</td>
                            <td>${response.data[i].percentage?response.data[i].percentage:""}</td>
                            <td>
                                ${response.data[i].marksheet_degree ?
                                    `<a href="${completMarksheet}" target="_blank">View</a>` :
                                    ""
                                }
                            </td>
                            <td>
                                <button onclick="confirmDelete(` + param['id'] + "," + param['tab_id'] + `);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        // console.log(tableRow);
        $("#eduTbody").html(tableRow);
    }


    function experienceDetails(response) {


        let tableRow = ``;
        let param = [];
        for (let i = 0; i < response.data.length; i++) {
            let completExpCerificate = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data[i].experience_certificate_filepath + "&fileName=" + response
                .data[i].experience_certificate;

            param['tab_id'] = response.tab_id;
            param['id'] = response.data[i].id;
            let experience = 0;
            let formattedFromDate = formatDate(response.data[i].from_date);
            let formattedToDate = formatDate(response.data[i].to_date);

            if (response.data[i].from_date) {
                experience = getExperience(response.data[i].from_date.split("/").reverse().join("/"), response.data[i]
                    .to_date.split("/").reverse().join("/"));
            }
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.data[i].employer_name?response.data[i].employer_name:""}</td>
                            <td>${response.data[i].post_held?response.data[i].post_held:""}</td>
                            <td>${response.data[i].from_date ? formattedFromDate : "" } - ${ response.data[i].to_date ? formattedToDate : "" }</td>
                            <td>${experience?experience:"less than 1"} Year</td>
                            <td>${response.data[i].nature_of_duties?response.data[i].nature_of_duties:""}</td>
                            <td>${response.data[i].job_type?response.data[i].job_type.job_type:""}</td>
                            <td>
                            ${response.data[i].experience_certificate ?
                                    `<a href="${completExpCerificate}" target="_blank">View</a>` :
                                    ""
                                }
                            </td>
                            <td>
                                <button onclick="confirmDelete(` + param['id'] + "," + param['tab_id'] + `);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        // console.log(tableRow,"wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww");
        $("#expeTbody").html(tableRow);
    }

    function competitiveExam(response) {
        let tableRow = ``;
        let param = [];
        for (let i = 0; i < response.data.length; i++) {
            let completCertificate = response.data[i]
                .certificate;
            param['tab_id'] = response.tab_id;
            param['id'] = response.data[i].id;
            tableRow += `<tr>
                                        <td>
                                           ${i + 1}
                                        </td>
                                        <td>
                                            ${response.data[i].exam_details?response.data[i].exam_details.exam_name:""}
                                        </td>
                                        <td>
                                          ${response.data[i].score?response.data[i].score:""}
                                        </td>
                                        <td>
                                           ${response.data[i].appearing_year?response.data[i].appearing_year.passing_year:""}
                                        </td>
                                        <td>
                                         ${response.data[i].certificate?
                                            `<a href="${completCertificate}"  target="_blank">View</a>`:""}
                                        </td>
                                        <td>
                                            <button onclick="confirmDelete(` + param['id'] + "," + param['tab_id'] + `);">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`;
        }
        // console.log(tableRow);
        $("#competTbody").html(tableRow);


    }

    function trainingDetails(response) {

        let tableRow = ``;
        let param = [];
        for (let i = 0; i < response.data.length; i++) {


            let completTrainingCertificate = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data[i].training_certificate_filepath + "&fileName=" + response.data[
                    i].training_certificate;
            param['tab_id'] = response.tab_id;
            param['id'] = response.data[i].id;
            tableRow += `<tr>
                                        <td>
                                           ${i + 1}
                                        </td>
                                        <td>
                                            ${response.data[i].name_of_training?response.data[i].name_of_training:""}
                                        </td>
                                        <td>
                                          ${response.data[i].description?response.data[i].description:""}
                                        </td>

                                        <td>
                                         ${response.data[i].training_certificate?
                                            `<a href="${completTrainingCertificate}"  target="_blank">View</a>`:""}
                                        </td>
                                        <td>
                                            <button onclick="confirmDelete(` + param['id'] + "," + param['tab_id'] + `);">
                                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" class="size-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0">
                                                    </path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>`;
        }
        // console.log(tableRow);
        $("#TrainCbody").html(tableRow);

    }

    function additionalDetails(response) {

        let tableRow = ``;
        let param = [];
        for (let i = 0; i < response.data.length; i++) {
            let completAchievements = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data[i].achievements_filepath + "&fileName=" + response.data[i]
                .achievements;
            let completaward_certificate = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.data[i].award_certificate_filepath + "&fileName=" + response.data[i]
                .award_certificate;
            param['tab_id'] = response.tab_id;
            param['id'] = response.data[i].id;
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.data[i].award_name?response.data[i].award_name:""}</td>
                            <td>${response.data[i].award_details?response.data[i].award_details:""}</td>
                            <td>
                            ${response.data[i].award_certificate?
                            `<a href="${completaward_certificate}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                            ${response.data[i].achievements?
                            `<a href="${completAchievements}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                                <button onclick="confirmDelete(` + param['id'] + "," + param['tab_id'] + `);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        // console.log(tableRow);
        $("#additTbody").html(tableRow);
    }

    function applicationPreview(response) {
        // $("#previewId").text("{{ Auth::user()->id }}");
        // $("#previewName").text("{{ Auth::user()->name }}");
        // $("#previewEmail").text("{{ Auth::user()->email }}");
        // $("#previewMobileNo").text("{{ Auth::user()->mobile }}");
        // $("#previewDob").text("{{ Auth::user()->date_of_birth }}");
        console.log(response.personal_details);
        if (response && response.personal_details) {
            let completResume = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                "/viewFiles?pathName=" + response.personal_details.upload_resume_filepath + "&fileName=" + response.personal_details
                .upload_resume;
            $("#previewEngagementType").text(response.personal_details.engagement_type ? response.personal_details.engagement_type.engagement_type : "");
            $("#previewName").text(response.personal_details.full_name);
            $("#previewMobileNo").text(response.personal_details.mobile_no);
            $("#previewEmail").text(response.personal_details.email);
            $("#previewGender").text(response.personal_details.gender);
            $("#previewFnameHname").text(response.personal_details.father_husband_name);
            $("#previewDob").text(response.personal_details.date_of_birth);
            $("#previewSpouseName").text(response.personal_details.spouse_name ?? '');
            $("#previewSpouseNo").text(response.personal_details.spouse_mobile_no ?? '');
            $("#previewPincode").text(response.personal_details.pincode);
            $("#previewCaddress").text(response.personal_details.correspondence_address);
            $("#previewPaddress").text(response.personal_details.permanent_address);
            $("#previewCv").html('<a target="_blank" href="'+ completResume + '" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp');
        }
        /******************************Educational detailslisting  ************************** */
        let tableRow1 = ``;
        let param = [];
        for (let i = 0; i < response.educational_details.length; i++) {
            // console.log(response.educational_details[i].id,"aa gayayay");
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta
                ?.getAttribute("content")
                ?.replace(/\/+$/, ""); // remove trailing slash

            let completMarksheet = websiteUrl +
                "/resource-pool-portal/candidate/viewFiles?pathName=" + response.educational_details[i].marksheet_degree_filepath + "&fileName=" +
                response.educational_details[i].marksheet_degree;
            param['tab_id'] = 2;
            param['id'] = response.educational_details[i].id;
            tableRow1 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${(() => {
                                const edu = response.educational_details[i];
                                const qualification = edu.qualification;

                                if (!qualification) return "";

                                if (qualification.qualification_name === "Others") {
                                    return edu.other_qualification || "";
                                }

                                return qualification.qualification_name || "";
                                })()}
                            </td>
                            <td>${response.educational_details[i].board_university_college ? (response.educational_details[i].board_university_college.name == 'Others' ? response.educational_details[i].other_board_university_collage : response.educational_details[i].board_university_college.name) :""}</td>
                            <td>${response.educational_details[i].main_subject ? response.educational_details[i].main_subject.subject_name : response.educational_details[i].other_main_subject ? response.educational_details[i].other_main_subject : ""}</td>
                            <td>${response.educational_details[i].course_mode?response.educational_details[i].course_mode.course_mode:""}</td>
                            <td>${response.educational_details[i].ref_passing_year?response.educational_details[i].ref_passing_year?.passing_year:""}</td>
                            <td>${response.educational_details[i].percentage?response.educational_details[i].percentage:""}</td>
                            <td>
                            ${response.educational_details[i].marksheet_degree?
                            `<a href="${completMarksheet}"  target="_blank">View</a>`:''}
                            </td>
                        </tr>`;
        }
        // console.log(tableRow1);
        $("#preEdu").html(tableRow1);

        /******************************End Educational Details Listing  *********************** */

        /*********************************Work experience details listing ********************** */
        let tableRow2 = ``;
        let param1 = [];
        for (let i = 0; i < response.experience_details.length; i++) {
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta
                ?.getAttribute("content")
                ?.replace(/\/+$/, ""); // remove trailing slash
            let completExpCertificate = websiteUrl +
                "/resource-pool-portal/candidate/viewFiles?pathName=" + response.experience_details[i].experience_certificate_filepath + "&fileName=" +
                response.experience_details[i].experience_certificate;
            param1['tab_id'] = 3;
            param1['id'] = response.experience_details[i].id;
            let experience = 0;
            if (response.experience_details && response.experience_details[i].from_date) {
                experience = getExperience(response.experience_details[i].from_date.split("/").reverse().join("/"),
                    response.experience_details[i].to_date.split("/").reverse().join("/"));
            }
            tableRow2 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.experience_details[i].employer_name?response.experience_details[i].employer_name:""}</td>
                            <td>${response.experience_details[i].post_held ? response.experience_details[i].post_held : ""}</td>
                            <td>${response.experience_details[i].from_date ? response.experience_details[i].from_date : "" } - ${ response.experience_details[i].to_date ? response.experience_details[i].to_date : "" }</td>
                            <td>${experience ? experience : "less than 1"} Year</td>
                            <td>${response.experience_details[i].nature_of_duties?response.experience_details[i].nature_of_duties:""}</td>
                            <td>${response.experience_details[i].job_type?response.experience_details[i].job_type.job_type:""}</td>
                            <td>
                            ${response.experience_details[i].experience_certificate?
                            `<a href="${completExpCertificate}"  target="_blank">View</a>`:""}
                            </td>
                        </tr>`;
        }
        // console.log(tableRow2);
        $("#preWorkExp").html(tableRow2);

        /*******************************End Work experience details listing ******************** */

        /******************************Competitive Exam listing ********************************** */
        let tableRowCompetitive = ``;
        let paramCompet = [];
        // console.log("WWWWWWWWWWWWWWWWWWWWWWWWW");
        for (let i = 0; i < response.competitive_details.length; i++) {
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta
                ?.getAttribute("content")
                ?.replace(/\/+$/, ""); // remove trailing slash
                
            let completExpCertificate = websiteUrl +
                "/resource-pool-portal/candidate/viewFiles?pathName=" + response.competitive_details[i].certificate_filepath + "&fileName=" + response
                .competitive_details[i].certificate;
            paramCompet['tab_id'] = 4;
            paramCompet['id'] = response.competitive_details[i].id;
            tableRowCompetitive += `<tr>
                                        <td>
                                           ${i + 1}
                                        </td>
                                        <td>
                                            ${response.competitive_details[i].exam_details?response.competitive_details[i].exam_details.exam_name:""}
                                        </td>
                                        <td>
                                          ${response.competitive_details[i].score?response.competitive_details[i].score:""}
                                        </td>
                                        <td>
                                           ${response.competitive_details[i].appearing_year?response.competitive_details[i].appearing_year.passing_year:""}
                                        </td>
                                        <td>
                                         ${response.competitive_details[i].certificate?
                                            `<a href="${completExpCertificate}"  target="_blank">View</a>`:""}
                                        </td>
                                    </tr>`;
        }
        // console.log(tableRowCompetitive);
        $("#preCompetDetails").html(tableRowCompetitive);


        /******************************End Competitive Exam listing ********************************** */


        /****************************** Additionaldetails listing ******************************* */

        let tableRow3 = ``;
        let param2 = [];
        for (let i = 0; i < response.additional_details.length; i++) {
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta
                ?.getAttribute("content")
                ?.replace(/\/+$/, ""); // remove trailing slash
            let completAwdCertificate = websiteUrl +
                "/resource-pool-portal/candidate/viewFiles?pathName=" + response.additional_details[i].award_certificate_filepath + "&fileName=" +
                response.additional_details[i].award_certificate;
            param2['tab_id'] = 5;
            param2['id'] = response.additional_details[i].id;
            tableRow3 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.additional_details[i].award_name?response.additional_details[i].award_name:""}</td>
                            <td>${response.additional_details[i].award_details?response.additional_details[i].award_details:""}</td>
                            <td>
                            ${response.additional_details[i].award_certificate?
                            `<a href="${completAwdCertificate}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                            ${response.additional_details[i].achievements?
                            `<a href="${response.additional_details[i].achievements}"  target="_blank">View</a>`:""}
                            </td>
                        </tr>`;
        }
        // console.log(tableRow3);
        $("#preAddDetails").html(tableRow3);

        /*******************************End Additional details  Listing ************************* */


        /****************************** Training tails listing ******************************* */
        // console.log((response.training_details && response.training_details.length),"traaaaaaaaaaaaaaiiiiiiiiiinnnnnnnn");
        let tableRow6 = ``;
        let param6 = [];
        if (response.training_details && response.training_details.length) {
            for (let i = 0; i < response.training_details.length; i++) {
                const websiteMeta = document.querySelector('meta[name="website-url"]');
                const websiteUrl = websiteMeta
                    ?.getAttribute("content")
                    ?.replace(/\/+$/, ""); // remove trailing slash
                let completTrainingCertificate = websiteUrl + "/resource-pool-portal/candidate/viewFiles?pathName=" + response.training_details[i].training_certificate_filepath +
                    "&fileName=" + response.training_details[i].training_certificate;
                param6['tab_id'] = 6;
                param6['id'] = response.training_details[i].id;
                tableRow6 += `<tr>
                                            <td>
                                            ${i + 1}
                                            </td>
                                            <td>
                                                ${response.training_details[i].name_of_training?response.training_details[i].name_of_training:""}
                                            </td>
                                            <td>
                                            ${response.training_details[i].description?response.training_details[i].description:""}
                                            </td>
                                            <td>
                                            ${response.training_details[i].training_certificate?
                                                `<a href="${completTrainingCertificate}"  target="_blank">View</a>`:""}
                                            </td>
                                        </tr>`;
            }
            // console.log(tableRow6);
            $("#preTrainCbody").html(tableRow6);
        }

        /*******************************End Training details  Listing ************************* */

        if (response.disclouser_questions) {
            // console.log("disclousersssssssssssssss",response.disclouser_questions);

            if (response.disclouser_questions.conviction !== undefined) {

                if (response.disclouser_questions.conviction) {
                    $("[name='conviction'][value='Yes']").prop("checked", true);
                } else {
                    $("[name='conviction'][value='No']").prop("checked", true);
                }
            }


            if (response.disclouser_questions.criminal_case !== undefined) {
                if (response.disclouser_questions.criminal_case) {
                    // If true, check the "Yes" radio button
                    $("[name='criminal_case'][value='Yes']").prop("checked", true);
                } else {
                    // If false, check the "No" radio button
                    $("[name='criminal_case'][value='No']").prop("checked", true);
                }
            }


            if (response.disclouser_questions.financial_liabilities !== undefined) {
                if (response.disclouser_questions.financial_liabilities) {
                    // If true, check the "Yes" radio button
                    $("[name='financial_liabilities'][value='Yes']").prop("checked", true);
                } else {
                    // If false, check the "No" radio button
                    $("[name='financial_liabilities'][value='No']").prop("checked", true);
                }
            }

            // For conflict_of_interest field
            if (response.disclouser_questions.conflict_of_interest !== undefined) {
                if (response.disclouser_questions.conflict_of_interest) {
                    // If true, check the "Yes" radio button
                    $("[name='conflict_of_interest'][value='Yes']").prop("checked", true);
                } else {
                    // If false, check the "No" radio button
                    $("[name='conflict_of_interest'][value='No']").prop("checked", true);
                }
            }

            if (response.disclouser_questions.draft_or_submit == "drafted") {
                $("#final_status").text(" :-Drafted");
            } else {
                // $(".finalBtnDev").hide();
                $("#final_status").text(" :-Submitted");
            }
            // Set checkboxes
            if (response.disclouser_questions.terms_agreement) {
                $("[name='terms_agreement']").prop("checked", true);
            }
            if (response.disclouser_questions.documentary_proof) {
                $("[name='documentary_proof']").prop("checked", true);
            }
            if (response.disclouser_questions.eligibility_criteria) {
                $("[name='eligibility_criteria']").prop("checked", true);
            }
            if (response.disclouser_questions.information_accuracy) {
                $("[name='information_accuracy']").prop("checked", true);
            }

            if (response.disclouser_questions.conviction_file) {
                $("#conviction_filee").val(response.disclouser_questions.conviction_file);
                if ($("input[name='conviction']:checked").val() == "Yes") {
                    $(".cf").hide();
                    $(".convictionDev").show();
                    if ($('#temp_conviction').length) {
                        $('#temp_conviction').remove();
                    }
                    let completConvictionFile = window.location.href.substring(0, window.location.href.lastIndexOf(
                            '/')) + "/viewFiles?pathName=" + response.disclouser_questions.conviction_filepath +
                        "&fileName=" + response.disclouser_questions.conviction_file;
                    $('.attachment_section_conviction_file').append(`<div id="temp_conviction" class="my-3">
                <a target="_blank" href="` + completConvictionFile + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
                <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
                </div>`);

                }
            }
            if (response.disclouser_questions.criminal_case_file) {
                $("#criminal_case_filee").val(response.disclouser_questions.criminal_case_file);
                if ($("input[name='criminal_case']:checked").val() == "Yes") {
                    $(".ccf").hide();
                    $(".criminal_caseDev").show();
                    if ($('#temp_criminal_case').length) {
                        $('#temp_criminal_case').remove();
                    }
                    let completCriminalCaseFile = window.location.href.substring(0, window.location.href.lastIndexOf(
                            '/')) + "/viewFiles?pathName=" + response.disclouser_questions.criminal_case_filepath +
                        "&fileName=" + response.disclouser_questions.criminal_case_file;
                    $('.attachment_section_criminal_case_file').append(`<div id="temp_criminal_case" class="my-3">
                <a target="_blank" href="` + completCriminalCaseFile + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
                <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
                </div>`);

                }
            }
            if (response.disclouser_questions.financial_liabilities_file) {
                $("#financial_liabilities_filee").val(response.disclouser_questions.financial_liabilities_file);
                if ($("input[name='financial_liabilities']:checked").val() == "Yes") {
                    $(".flf").hide();
                    $(".financial_liabilitiesDev").show();
                    if ($('#temp_financial_liabilities').length) {
                        $('#temp_financial_liabilities').remove();
                    }
                    let completFinancialFile = window.location.href.substring(0, window.location.href.lastIndexOf(
                            '/')) + "/viewFiles?pathName=" + response.disclouser_questions
                        .financial_liabilities_filepath +
                        "&fileName=" + response.disclouser_questions.financial_liabilities_file;
                    $('.attachment_section_financial_liabilities_file').append(`<div id="temp_financial_liabilities" class="my-3">
                <a target="_blank" href="` + completFinancialFile + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
                <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
                </div>`);

                }
            }
            if (response.disclouser_questions.conflict_of_interest_file) {
                $("#conflict_of_interest_filee").val(response.disclouser_questions
                    .conflict_of_interest_file); // Assuming it's a checkbox or boolean property

                if ($("input[name='conflict_of_interest']:checked").val() == "Yes") {
                    $(".coif").hide();
                    $(".conflict_of_interestDev").show();
                    if ($('#temp_conflict_of_interest').length) {
                        $('#temp_conflict_of_interest').remove();
                    }
                    let completConflictFile = window.location.href.substring(0, window.location.href.lastIndexOf('/')) +
                        "/viewFiles?pathName=" + response.disclouser_questions.conflict_of_interest_filepath +
                        "&fileName=" + response.disclouser_questions.conflict_of_interest_file;
                    $('.attachment_section_conflict_of_interest_file').append(`<div id="temp_conflict_of_interest" class="my-3">
                <a target="_blank" href="` + completConflictFile + `" class=" bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View </a>&nbsp
                <a href="javascript:void(0);" class="focus:outline-none  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_pre" data-id="2" data-name="">Remove</a>
                </div>`);

                }
            }



        }
    }

    function getExperience(startDate, endDate) {

        let start = new Date(startDate);
        let end = new Date(endDate);

        let diffTime = end - start;
        let diffYears = diffTime / (1000 * 3600 * 24 * 365.25);
        let experienceYears = Math.floor(diffYears);
        // console.log(experienceYears, "years of experience");
        return experienceYears;
    }
    window.onload = function() {
        let currentTab = getCookie('selected_tab_candidate');

        if (currentTab && currentTab !== "#") {
            setTimeout(() => {
                $("#" + currentTab).click();
            }, 10);
        } else {
            // fallback: click default tab
            $("#defaultOpen1").click();
        }
    };

    function confirmDelete(id, tab_id) {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/delete-candidate` : null;

        var urlLink = finalUrl + "/?tab_id=" + tab_id + "&id=" + id;
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: "Cancel",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {


            if (result.isConfirmed) {
                window.location.href = urlLink;
            }
        })
    }
    /**************************Area of expertise tag js *********************** */
    const tagInput = document.getElementById('tagInput');
    const tagList = document.getElementById('tagList');
    if (tagInput) {
        tagInput.addEventListener('keypress', function(event) {
            if (event.key === 'Enter' && tagInput.value.trim() !== '') {
                addTag(tagInput.value.trim());

                let areaOfExpert = $("#area_of_expertise").val();
                areaOfExpert += "," + tagInput.value
                $("#area_of_expertise").val(areaOfExpert);

                tagInput.value = '';
                event.preventDefault();

            }
        });


        function addTag(tag) {
            // Create a new tag element
            const tagElement = document.createElement('span');
            tagElement.classList.add('tag');
            tagElement.innerHTML = `${tag} <span onclick="removeTag(this)">x</span>`;

            // Append tag to the list
            tagList.appendChild(tagElement);
        }

        function removeTag(element) {
            element.parentElement.remove();
        }
    }

    function formatDate(dateString) {
        const date = new Date(dateString);
        const pad = (n) => n.toString().padStart(2, '0');

        const day = pad(date.getDate());
        const month = pad(date.getMonth() + 1); // months are 0-based
        const year = date.getFullYear();
        const hours = pad(date.getHours());
        const minutes = pad(date.getMinutes());
        const seconds = pad(date.getSeconds());

        return `${day}-${month}-${year}`;
    }
    /**************************End Area of Expertise Tag js *********************** */
