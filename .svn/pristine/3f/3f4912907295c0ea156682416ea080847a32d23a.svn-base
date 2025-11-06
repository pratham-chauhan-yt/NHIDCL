    function personalDeatils(response){
        //console.log(response);
        if((response != null) && (response.data)) {
            $("#full_name").val(response.data.full_name?response.data.full_name:"");
            $("#father_husband_name").val(response.data.father_husband_name?response.data.father_husband_name:"");
            $("#email").val(response.data.email?response.data.email:"");
            $("#mobile_no").val(response.data.mobile_no);
            $("#date_of_birth").val(response.data.date_of_birth?response.data.date_of_birth:"");
            $("#ref_engagement_id option[value='" + response.data.ref_engagement_id?response.data.ref_engagement_id:'' + "']").attr("selected", "selected");
            $("#gender option[value='" + response.data.gender?response.data.gender:'' + "']").attr("selected", "selected");
            $("#correspondence_address").val(response.data.correspondence_address?response.data.correspondence_address:"");
            $("#permanent_address").val(response.data.permanent_address?response.data.permanent_address:"");
            $("#upload_signaturee").val(response.data.upload_signature?response.data.upload_signature:"");
            $("#upload_resumee").val(response.data.upload_resume?response.data.upload_resume:"");
            $("#upload_photoss").val(response.data.upload_photos?response.data.upload_photos:"");
        }

    }

    function educationalDetails(response) {

        let tableRow = ``;
        let param=[];
        for (let i = 0; i < response.data.length; i++) {



                param['tab_id']=response.tab_id;
                param['id']=response.data[i].id;
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.data[i].qualification?response.data[i].qualification:""}</td>
                            <td>${response.data[i].board_university_collage?response.data[i].board_university_collage:""}</td>
                            <td>${response.data[i].main_subject?response.data[i].main_subject:""}</td>
                            <td>${response.data[i].course_mode?response.data[i].course_mode:""}</td>
                            <td>${response.data[i].ref_passing_year?response.data[i].ref_passing_year?.passing_year:""}</td>
                            <td>${response.data[i].percentage?response.data[i].percentage:""}</td>
                            <td>
                                ${response.data[i].marksheet_degree ?
                                    `<a href="${response.data[i].marksheet_degree}" target="_blank">View</a>` :
                                    ""
                                }
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param['id']+","+param['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        console.log(tableRow);
        $("#eduTbody").html(tableRow);
    }


    function experienceDetails(response){

        let tableRow = ``;
        let param=[];
        for (let i = 0; i < response.data.length; i++) {
                param['tab_id']=response.tab_id;
                param['id']=response.data[i].id;
                let experience=0;
                if(response.data[i].from_date){
                    experience =getExperience(response.data[i].from_date.split("/").reverse().join("/"),response.data[i].to_date.split("/").reverse().join("/"));
                }
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.data[i].employer_name?response.data[i].employer_name:""}</td>
                            <td>${response.data[i].post_held?response.data[i].post_held:""}</td>
                            <td>${response.data[i].from_date ? response.data[i].from_date : "" } - ${ response.data[i].to_date ? response.data[i].to_date : "" }</td>
                            <td>${experience?experience:"less than 1"} Year</td>
                            <td>${response.data[i].nature_of_duties?response.data[i].nature_of_duties:""}</td>
                            <td>${response.data[i].job_type?response.data[i].job_type:""}</td>
                            <td>
                            ${response.data[i].experience_certificate ?
                                    `<a href="${response.data[i].experience_certificate}" target="_blank">View</a>` :
                                    ""
                                }
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param['id']+","+param['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        //console.log(tableRow,"wwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww");
        $("#expeTbody").html(tableRow);
    }

    function additionalDetails(response){

        let tableRow = ``;
        let param=[];
        for (let i = 0; i < response.data.length; i++) {
            param['tab_id']=response.tab_id;
            param['id']=response.data[i].id;
            tableRow += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.data[i].award_name?response.data[i].award_name:""}</td>
                            <td>${response.data[i].award_details?response.data[i].award_details:""}</td>
                            <td>
                            ${response.data[i].award_certificate?
                            `<a href="${response.data[i].award_certificate}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                            ${response.data[i].achievements?
                            `<a href="${response.data[i].achievements}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param['id']+","+param['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        //console.log(tableRow);
        $("#additTbody").html(tableRow);
    }

    function applicationPreview(response){
        if(response && response.personal_details){
            $("#previewEngagementType").text(response.personal_details.engagementType ? response.personal_details.engagementType.engagement_name:"");
            $("#previewName").text(response.personal_details.full_name);
            $("#previewGender").text(response.personal_details.gender);
            $("#previewFnameHname").text(response.personal_details.father_husband_name);
            $("#previewDob").text(response.personal_details.date_of_birth);
            $("#previewMobileNo").text(response.personal_details.mobile_no);
            $("#previewEmail").text(response.personal_details.email);
            $("#previewCaddress").text(response.personal_details.correspondence_address);
            $("#previewPaddress").text(response.personal_details.permanent_address);
        }
        /******************************Educational detailslisting  ************************** */
        let tableRow1 = ``;
        let param=[];
        for (let i = 0; i < response.educational_details.length; i++) {
                // console.log(response.educational_details[i].id,"aa gayayay");
                param['tab_id']=2;
                param['id']=response.educational_details[i].id;
            tableRow1 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.educational_details[i].qualification?response.educational_details[i].qualification:""}</td>
                            <td>${response.educational_details[i].board_university_collage?response.educational_details[i].board_university_collage:""}</td>
                            <td>${response.educational_details[i].main_subject?response.educational_details[i].main_subject:""}</td>
                            <td>${response.educational_details[i].course_mode?response.educational_details[i].course_mode:""}</td>
                            <td>${response.educational_details[i].ref_passing_year?response.educational_details[i].ref_passing_year?.passing_year:""}</td>
                            <td>${response.educational_details[i].percentage?response.educational_details[i].percentage:""}</td>
                            <td>
                            ${response.educational_details[i].marksheet_degree?
                            `<a href="${response.educational_details[i].marksheet_degree}"  target="_blank">View</a>`:''}
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param['id']+","+param['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        //console.log(tableRow1);
        $("#preEdu").html(tableRow1);

        /******************************End Educational Details Listing  *********************** */

        /*********************************Work experience details listing ********************** */
        let tableRow2 = ``;
        let param1=[];
        for (let i = 0; i < response.experience_details.length; i++) {
                param1['tab_id']=3;
                param1['id']=response.experience_details[i].id;
                let experience=0;
            if(response.experience_details && response.experience_details[i].from_date){
             experience =getExperience(response.experience_details[i].from_date.split("/").reverse().join("/"),response.experience_details[i].to_date.split("/").reverse().join("/"));
            }
             tableRow2 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.experience_details[i].employer_name?response.experience_details[i].employer_name:""}</td>
                            <td>${response.experience_details[i].post_held?response.experience_details[i].post_held:""}</td>
                            <td>${response.experience_details[i].from_date ? response.experience_details[i].from_date : "" } - ${ response.experience_details[i].to_date ? response.experience_details[i].to_date : "" }</td>
                            <td>${experience?experience:"less than 1"} Year</td>
                            <td>${response.experience_details[i].nature_of_duties?response.experience_details[i].nature_of_duties:""}</td>
                            <td>${response.experience_details[i].job_type?response.experience_details[i].job_type:""}</td>
                            <td>
                            ${response.experience_details[i].experience_certificate?
                            `<a href="${response.experience_details[i].experience_certificate}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param1['id']+","+param1['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        //console.log(tableRow2);
        $("#preWorkExp").html(tableRow2);

        /*******************************End Work experience details listing ******************** */

        /****************************** Additionaldetails listing ******************************* */

        let tableRow3 = ``;
        let param2=[];
        for (let i = 0; i < response.additional_details.length; i++) {
            param2['tab_id']=4;
            param2['id']=response.additional_details[i].id;
            tableRow3 += `<tr>
                            <td>${i + 1}</td> <!-- Using i+1 for numbering -->
                            <td>${response.additional_details[i].award_name?response.additional_details[i].award_name:""}</td>
                            <td>${response.additional_details[i].award_details?response.additional_details[i].award_details:""}</td>
                            <td>
                            ${response.additional_details[i].award_certificate?
                            `<a href="${response.additional_details[i].award_certificate}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                            ${response.additional_details[i].achievements?
                            `<a href="${response.additional_details[i].achievements}"  target="_blank">View</a>`:""}
                            </td>
                            <td>
                                <button onclick="confirmDelete(`+param2['id']+","+param2['tab_id']+`);">
                                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="size-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"></path>
                                    </svg>
                                </button>
                            </td>
                        </tr>`;
        }
        //console.log(tableRow3);
        $("#preAddDetails").html(tableRow3);

        /*******************************End Additional details  Listing ************************* */

    }

    function getExperience(startDate, endDate) {

        let start = new Date(startDate);
        let end = new Date(endDate);

        let diffTime = end - start;
        let diffYears = diffTime / (1000 * 3600 * 24 * 365.25);
        let experienceYears = Math.floor(diffYears);
        //console.log(experienceYears, "years of experience");
        return experienceYears;
    }
    window.onload = function() {
        let currentTab=getCookie('selected_tab_candidate');
        //alert(currentTab);
        setTimeout(() => {
            $("#"+currentTab).click();
        }, 10);
    };

    function confirmDelete(id,tab_id) {
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute('content');
        const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/delete-candidate?tab_id=${tab_id}&id=${id}` : null;
        var urlLink = finalUrl;
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

