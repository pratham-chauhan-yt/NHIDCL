$(document).ready(function(){
    $('.js-example-basic-multiple').select2();

        $(document).on("click","#resourceRequisitionBtn",function(){


            let   $job_title= $("#job_title").val();
            let   $Designation_Engagement = $("#Designation_Engagement").val();
            let   $Engagement = $("#Engagement").val();
            let   $expert_professional= $("#expert_professional").val();
            let   $people_of_eminence= $("#people_of_eminence").val();
            let   $number_of_required_resources= $("#number_of_required_resources").val();
            let   $duration_of_engagement_start= $("#duration_of_engagement_start").val();
            let   $duration_of_engagement_end= $("#duration_of_engagement_end").val();
            let   $job_description= $("#job_description").val();
            let   $domain= $("#domain").val();
            let   $discipline= $("#discipline").val();
            let   $qualification_requirements= $("#qualification_requirements").val();
            let   $minimum_work_experience= $("#minimum_work_experience").val();
            let   $retired_government_personnel= $("#retired_government_personnel").val();

            let   $comment= $("#comment").val();

            let  $upload_for_efile_noting =$("#upload_for_efile_noting").val();

            let today = new Date();
            let start_date = new Date($("#start_date").val());
            let end_date = new Date($("#end_date").val());


            $(".job_title_err").text("");
            $(".Designation_Engagement").text("");
            $(".Engagement").text("");
            $(".expert_professional_err").text("");
            $(".people_of_eminence_err").text("");
            $(".number_of_required_resources_err").text("");
            $(".duration_of_engagement_start_err").text("");
            $(".duration_of_engagement_end_err").text("");
            $(".job_description_err").text("");
            $(".domain_err").text("");
            $(".discipline_err").text("");
            $(".qualification_requirements_err").text("");
            $(".minimum_work_experience_err").text("");
            $(".retired_government_personnel_err").text("");
            $(".comment_err").text("");
            $(".upload_for_efile_noting_err").text("");
            $(".duration_of_advertisment_start_err").text("");
            $(".duration_of_advertisment_end_err").text("");

            $err=0;
            if($job_title==""){
                $(".job_title_err").text("Job title field is required");
                $err=1;
            }

            if($Designation_Engagement==""){
                // $(".independent_consultant_err").text("Independent consultant field is required");
                // $err=1;
            }
            if($Engagement==""){
                // $(".independent_consultant_err").text("Independent consultant field is required");
                // $err=1;
            }

            if($expert_professional==""){
                // $(".expert_professional_err").text("Expert professional field is required");
                // $err=1;
            }
            if($people_of_eminence==""){
                // $(".people_of_eminence_err").text("People of eminence field is required");
                // $err=1;
            }
            if($number_of_required_resources==""){
                // $(".number_of_required_resources_err").text("Number of required resources field is required");
                // $err=1;
            }
            // else if(isNaN($number_of_required_resources)){
            //     $(".number_of_required_resources_err").text("Number of required resources value should be numeric ");
            //     $err=1;
            // }
            if($duration_of_engagement_start==""){
                $(".duration_of_engagement_start_err").text("Start date is required");
                $err=1;
            }
            if($duration_of_engagement_end==""){
                $(".duration_of_engagement_end_err").text("End date is required");
                $err=1;
            }

            if (start_date <= today) {
                $(".duration_of_advertisment_start_err").text('Start date should be in the future.');
                    $err=1;
            }
            if (end_date <= today) {
                $(".duration_of_advertisment_end_err").text('End date should be in the future.');
                    $err=1;
            }

            if($job_description==""){
                $(".job_description_err").text("Job description field is required");
                $err=1;
            }

            if($domain==""){
                // $(".domain_err").text("Domain details field is required");
                // $err=1;
            }
            if($discipline==""){
                // $(".discipline_err").text("Discipline field is required");
                // $err=1;
            }
            if($qualification_requirements==""){
                // $(".qualification_requirements_err").text("Qualification requirements field is required");
                // $err=1;
            }
            if($minimum_work_experience==""){
                // $(".minimum_work_experience_err").text("Minimum work experience field is required");
                // $err=1;
            }else if(isNaN($minimum_work_experience)){
                // $(".minimum_work_experience_err").text("Minimum work experience value should be numeric ");
                // $err=1;
            }
            if($retired_government_personnel==""){
                // $(".retired_government_personnel_err").text("Retired government personnel field is required");
                // $err=1;
            }
            if($comment==""){
                // $(".comment_err").text("Comment field is required");
                // $err=1;
            }
            if($upload_for_efile_noting==""){
                // $(".upload_for_efile_noting_err").text("Upload for efile noting field is required");
                // $err=1;
            }


            if($err){
                return false;
            }else{
              //  alert($err);
                $("#resourceRequisitionFrm").submit();
            }

        });

        /*******************************************Upload For Efile Noting  ***********************************************/
        $('.upload_for_efile_noting').on('change', function() {
            var $this = $(this);

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

            var formData = new FormData();
            var file = $this[0].files[0];
            formData.append('upload_for_efile_noting', file);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            formData.append('_token', csrfToken);

            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/storeUpload_cover_photo` : null;
            const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/viewFiles` : null;

            $.ajax({
                url: finalUrl,
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    if (response.status == true) {
                        var fileName = encodeURIComponent(response.file_name);
                        var pathName = encodeURIComponent('uploads/hr/upload_for_efile_noting/');
                        let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                        url = url.replace(':fileName', fileName);
                        url = url.replace(':pathName', pathName);
                        $("#upload_for_efile_noting_txt").val(url);
                        let ii=0;

                        $this.parents('.attachment_section_photos').find('.hide_upload_photos').hide();
                        $this.parents('.attachment_section_photos').find('input[type="file"]').prop('required', false);
                        $this.parents('.attachment_section_photos').siblings('.attachment_section_photos').show();

                        $('.attachment_section_photos').append('<div id="temp_12' + ii + '" ><a target="_blank" href="' + url + '" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_photos" data-id="' + ii++ + '" data-name="' + response.file_name + '">Re-upload</a>&nbsp&nbsp&nbsp&nbsp');

                        $("#upload_photos").val(response.file_name);
                    } else {
                        alert(response.message);
                        $this.val('');
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Error occurred: " + status + " " + error);
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
        /**************************************End Upload For EfileNoting ***************************************** */
        /*************************************Fetching posted jobs ****************** */
        $("#jobPosted").click(function(){
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/posted-jobs` : null;
            const finalUrlEditPostedJobs = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/editPostedJobs/` : null;
            const finalUrlViewPostedJobs = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/viewPostedJobs/` : null;
            const finalUrlDeletePostedJobs = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/deletePostedJobs/` : null;

            $('#loader').show();
            $.ajax({
                    url: finalUrl,
                    type: 'GET',
                    data: "",
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // console.log(response);
                        $('#loader').hide();
                        let finalDev ="";
                        for(let i=0; i<response.length; i++){
                            if (response[i] && response[i].job_title && response[i].job_description && response[i].duration_of_engagement_end) {
                                let editUrl =`${finalUrlEditPostedJobs}${response[i].id}`;
                                let viewUrl = `${finalUrlViewPostedJobs}${response[i].id}`;
                                let deleteUrl = `${finalUrlDeletePostedJobs}${response[i].id}`;
                                finalDev+=`<div class="job_posted_cust">
                                    <a href="#">
                                        <h4 class="">`+response[i].job_title+`</h4>
                                        <div class="mb-[10px] cust_p pt-[5px]">
                                            <p>Active Until: <span> `+response[i].duration_of_engagement_end+`</span></p>
                                        </div>
                                        <p class="">`+response[i].job_description.substr(0, 150)+" ..."+`</p>
                                    </a>
                                    <div class="cust_points_jobs mt-[10px] justify-end">
                                        <span class=""><a href="${editUrl}" class="btn btn-success">Edit</a></span>
                                        <span class=""><a href="${viewUrl}" class="btn btn-default">View</a></span>
                                        <span style="background: rgb(202, 21, 21); color: white;"><a href="${deleteUrl}" class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Delete</a></span>
                                    </div>
                                        </div>
                                </div>`;
                            }
                        }
                        // console.log(finalDev,"tttttttttttttttttttttttttttttt");
                        $("#postedJobs").html(finalDev);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + status + " " + error);
                    }

            })
        });

        /**********************************Fetching  Archived jobs ************************************************ */

        $("#archivedJobs").click(function(){
            const websiteMeta = document.querySelector('meta[name="website-url"]');
            const websiteUrl = websiteMeta?.getAttribute('content');
            const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/archived-jobs` : null;
            $('#loader').show();
            $.ajax({
                    url: finalUrl,
                    type: 'GET',
                    data: "",
                    contentType: false,
                    processData: false,
                    success: function(response) {

                        $('#loader').hide();
                        let finalDev ="";
                        for(let i=0; i<response.length; i++){
                            let creatorName = response[i].creator && response[i].creator.name ? response[i].creator.name : 'No Name Available';
                            finalDev+=`<tr>
                                        <td>
                                           `+(i+1)+`
                                        </td>
                                        <td>
                                           `+response[i].job_title+`
                                        </td>
                                        <td>
                                            `+response[i].duration_of_engagement_start+`
                                        </td>
                                        <td>
                                            `+response[i].duration_of_engagement_end+`
                                        </td>
                                        <td>
                                            `+response[i].created_at+`
                                        </td>
                                        <td>
                                            `+creatorName+`
                                        </td>
                                    </tr>`;
                        }
                        // console.log(finalDev,"Archive..............");
                        $("#archiveRow").html(finalDev);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred: " + status + " " + error);
                    }

            })
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#Engagement').on('change', function () {

            var engagementId = $(this).val();

            if (engagementId) {
                const websiteMeta = document.querySelector('meta[name="website-url"]');
                const websiteUrl = websiteMeta?.getAttribute('content');
                const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/designations?engagement_id=${engagementId}` : null;
                $.ajax({
                    url: finalUrl,
                    method: 'GET',
                    success: function (data) {

                        $('#Designation_Engagement').prop('disabled', false);


                        $('#Designation_Engagement').empty();

                        // $('#Designation_Engagement').append('<option value="">Select </option>');


                        data.forEach(function (item) {

                            $('#Designation_Engagement').append('<option value="' + item.id + '">' + item.designation + '</option>');
                        });
                    },
                    error: function (error) {
                        console.error('Error fetching designations:', error);
                    }
                });
            } else {
                // If no engagement ID is selected, disable the Designation dropdown
                $('#Designation_Engagement').prop('disabled', true);
                $('#Designation_Engagement').empty();
                $('#Designation_Engagement').append('<option value="">Select a Designation</option>');
            }
        });
});
