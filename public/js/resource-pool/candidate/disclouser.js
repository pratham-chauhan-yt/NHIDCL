/*****************************Disclouser Button *********************************** */
        $('#disclouserFinalBtn, #disclouserBtn').click(function() {
                let   id =this.id;

                $("#conviction_err").text("");
                $("#criminal_case_err").text("");
                $("#financial_liabilities_err").text("");
                $("#conflict_of_interest_err").text("");
                $("#terms_agreement_err").text("");
                $("#documentary_proof_err").text("");
                $("#eligibility_criteria_err").text("");
                $("#information_accuracy_err").text("");
                $("#conviction_file_err").text("");
                $("#criminal_case_file_err").text("");
                $("#financial_liabilities_file_err").text("");
                $("#conflict_of_interest_file_err").text("");



                var isValid = true;

                if ($("input[name='conviction']:checked").length == 0) {
                    $("#conviction_err").text('Please select whether you have been convicted by any court.');
                    isValid = false;
                }else{
                    let selectedValue = $("input[name='conviction']:checked").val();
                    if((selectedValue=="Yes") && ($("#conviction_filee").val()=="")){
                        $("#conviction_file_err").text('Please upload conviction file.');
                        isValid = false;
                    }
                }

                if ($("input[name='criminal_case']:checked").length == 0) {
                    $("#criminal_case_err").text('Please select whether there is any criminal case pending against you.');
                    isValid = false;
                }else{
                    let selectedValue = $("input[name='criminal_case']:checked").val();
                    if((selectedValue=="Yes") && ($("#criminal_case_filee").val()=="")){
                        $("#criminal_case_file_err").text('Please upload criminal case file.');
                        isValid = false;
                    }

                }

                if ($("input[name='financial_liabilities']:checked").length == 0) {
                    $("#financial_liabilities_err").text('Please select whether there are any financial liabilities pending with your current employer.');
                    isValid = false;
                }else{
                    let selectedValue = $("input[name='financial_liabilities']:checked").val();

                    if((selectedValue=="Yes") && ($("#financial_liabilities_filee").val()=="")){
                        $("#financial_liabilities_file_err").text('Please upload financial liabilities file.');
                        isValid = false;
                    }

                }

                if ($("input[name='conflict_of_interest']:checked").length == 0) {
                    $("#conflict_of_interest_err").text('Please select whether you have any conflict of interest with the Government of India.');
                    isValid = false;
                }else{
                    let selectedValue = $("input[name='conflict_of_interest']:checked").val();
                    if((selectedValue=="Yes") && ($("#conflict_of_interest_filee").val()=="")){
                        $("#conflict_of_interest_file_err").text('Please upload conflict of interest file.');
                        isValid = false;
                    }

                }

                if (!$("input[name='terms_agreement']").prop('checked')) {
                    $("#terms_agreement_err").text('You must agree to the Terms and Conditions.');
                    isValid = false;
                }

                if (!$("input[name='documentary_proof']").prop('checked')) {
                    $("#documentary_proof_err").text('You must agree to submit documentary proof as required.');
                    isValid = false;
                }

                if (!$("input[name='eligibility_criteria']").prop('checked')) {
                    $("#eligibility_criteria_err").text('You must agree to fulfill the eligibility criteria for the position.');
                    isValid = false;
                }

                if (!$("input[name='information_accuracy']").prop('checked')) {
                    $("#information_accuracy_err").text('You must agree that the information provided is accurate.');
                    isValid = false;
                }

                if (isValid) {
                    $("#draftOrSubmit").val(id);
                    $('#loader').show();

                    const websiteMeta = document.querySelector('meta[name="website-url"]');
                    const websiteUrl = websiteMeta?.getAttribute('content');
                    const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/candidate/candidate_details?tab_id=7` : null;

                    $.ajax({
                            url: finalUrl,
                            type: 'GET',
                            data: "",
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                $('#loader').hide();
                                if((response.personal_details && response.educational_details && response.educational_details.length) && (response.experience_details && response.experience_details.length)){
                                    $("#clouserForm").submit();
                                }else{
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Tabs Pending To Submit',
                                        text: "Please make sure education & work experience has filled successfully",
                                    });
                                }

                            },
                            error: function(xhr, status, error) {
                                console.error("Error occurred: " + status + " " + error);
                            }

                    })
                }
            });

            /******************************End Disclouser Button ******************************* */

            $(document).on("click","#conviction_no",function(){
                $(".convictionDev").hide();
            });
            $(document).on("click","#conviction_yes",function(){
                $(".convictionDev").show();
            });

            $(document).on("click","#criminal_no",function(){
                $(".criminal_caseDev").hide();
            });
            $(document).on("click","#criminal_yes",function(){
                $(".criminal_caseDev").show();
            });

            $(document).on("click","#financial_liabilities_no",function(){
                $(".financial_liabilitiesDev").hide();
            });
            $(document).on("click","#financial_liabilities_yes",function(){
                $(".financial_liabilitiesDev").show();
            });

            $(document).on("click","#conflict_of_interest_no",function(){
                $(".conflict_of_interestDev").hide();
            });
            $(document).on("click","#conflict_of_interest_yes",function(){
                $(".conflict_of_interestDev").show();
            });

            /*****************************Upload Conviction File **************** */

            $(document).on('change', '.conviction_file', function() {
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
                formData.append('conviction_file', file);
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
                            let pathName = encodeURIComponent('/uploads/candidate/conviction_file/');
                            let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                            url = url.replace(':fileName', fileName);
                            url = url.replace(':pathName', pathName);
                            var fileUrl =url;
                            var autoid = $this.attr('id').split('_')[2];
                            $this.hide();
                            $this.closest('.attachment_section_conviction_file').find('.upload_cust').hide();
                            $this.closest('.attachment_section_conviction_file').find('.conviction_filee').val(fileUrl);
                            $this.siblings('input[type="hidden"]').val(response.file_name);

                            var $section = $this.closest('.attachment_section_conviction_file');
                            $section.append(`
                            <div id="temp${autoid}" class="my-3">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                            </div>
                        `);
                            /*$('.attachment_section').append(`
                                <div id="temp${autoid}">
                                    <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                    <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
                $(`#conviction_file_${autoid}`).show().prop('required', true);
                $(`#hidden_document_${autoid}`).val('');
                $(this).parent().remove();
            });


            /*****************************End  Upload Conviction File *************/

            /************************** criminal case file Upload start **************************** */

            $(document).on('change', '.criminal_case_file', function() {
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
                formData.append('criminal_case_file', file);
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
                            let pathName = encodeURIComponent('/uploads/candidate/criminal_case_file/');
                            let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                            url = url.replace(':fileName', fileName);
                            url = url.replace(':pathName', pathName);
                            var fileUrl =url;
                            var autoid = $this.attr('id').split('_')[2];
                            $this.hide();
                            $this.closest('.attachment_section_criminal_case_file').find('.upload_cust').hide();
                            $this.closest('.attachment_section_criminal_case_file').find('.criminal_case_filee').val(fileUrl);
                            $this.siblings('input[type="hidden"]').val(response.file_name);

                            var $section = $this.closest('.attachment_section_criminal_case_file');
                            $section.append(`
                            <div id="temp${autoid}" class="my-3">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                            </div>
                        `);
                            /*$('.attachment_section').append(`
                                <div id="temp${autoid}">
                                    <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                    <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
                $(`#criminal_case_file_${autoid}`).show().prop('required', true);
                $(`#hidden_document_${autoid}`).val('');
                $(this).parent().remove();
            });


            /**************************criminal case file Upload End ****************************** */


            /************************** financial_liabilities_file Upload3 start ********************************************* */
            $(document).on('change', '.financial_liabilities_file', function() {
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
                formData.append('financial_liabilities_file', file);
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
                            let pathName = encodeURIComponent('/uploads/candidate/financial_liabilities_file/');
                            let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                            url = url.replace(':fileName', fileName);
                            url = url.replace(':pathName', pathName);
                            var fileUrl =url;
                            var autoid = $this.attr('id').split('_')[2];
                            $this.hide();
                            $this.closest('.attachment_section_financial_liabilities_file').find('.upload_cust').hide();
                            $this.closest('.attachment_section_financial_liabilities_file').find('.financial_liabilities_filee').val(fileUrl);
                            $this.siblings('input[type="hidden"]').val(response.file_name);

                            var $section = $this.closest('.attachment_section_financial_liabilities_file');
                            $section.append(`
                            <div id="temp${autoid}" class="my-3">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                            </div>
                        `);
                            /*$('.attachment_section').append(`
                                <div id="temp${autoid}">
                                    <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                    <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
                $(`#financial_liabilities_file_${autoid}`).show().prop('required', true);
                $(`#hidden_document_${autoid}`).val('');
                $(this).parent().remove();
            });

            /***************************financial_liabilities_file Upload end ********************************************* */

            /*************************Upload4 Start ************************************************************ */
            $(document).on('change', '.conflict_of_interest_file', function() {
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
                formData.append('conflict_of_interest_file', file);
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
                            let pathName = encodeURIComponent('/uploads/candidate/conflict_of_interest_file/');
                            let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                            url = url.replace(':fileName', fileName);
                            url = url.replace(':pathName', pathName);
                            var fileUrl =url;
                            var autoid = $this.attr('id').split('_')[2];
                            $this.hide();
                            $this.closest('.attachment_section_conflict_of_interest_file').find('.upload_cust').hide();
                            $this.closest('.attachment_section_conflict_of_interest_file').find('.conflict_of_interest_filee').val(fileUrl);
                            $this.siblings('input[type="hidden"]').val(response.file_name);

                            var $section = $this.closest('.attachment_section_conflict_of_interest_file');
                            $section.append(`
                            <div id="temp${autoid}" class="my-3">
                                <a target="_blank" href="${fileUrl}" class="quick-btn view-btn bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview">View</a>&nbsp;
                                <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
                            </div>
                        `);
                            /*$('.attachment_section').append(`
                                <div id="temp${autoid}">
                                    <a target="_blank" href="${fileUrl}" class="quick-btn view_doc_btn report_preview">View</a>
                                    <a href="javascript:void(0);" class="quick-btn reupload-btn focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove" data-id="${autoid}" data-name="${response.file_name}">Re-upload</a>
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
                $(`#conflict_of_interest_file_${autoid}`).show().prop('required', true);
                $(`#hidden_document_${autoid}`).val('');
                $(this).parent().remove();
            });

            /**************************Upload4 End ************************************************************* */
