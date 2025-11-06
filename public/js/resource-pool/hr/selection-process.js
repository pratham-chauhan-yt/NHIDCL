function fetchExternalMembers() {
    let $select = $('select[name="users3[]"]');
    const toggleDiv = $("#toggleDiv"); // Use jQuery for consistency
    var selectedUserIds = [];

    // Get checked users
    $("input[name='selected[]']:checked").each(function () {
        selectedUserIds.push($(this).val());
    });

    // If no user is selected, show an alert and exit the function
    if (selectedUserIds.length === 0) {
        Swal.fire({
            icon: "info",
            html: `Please select at least one candidate to update.`,
        });
        return; // Stop execution
    }

    // Toggle the div visibility
    if (toggleDiv.is(":visible")) {
        toggleDiv.hide();
        return; // Stop execution
    } else {
        toggleDiv.show();
    }

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    let finalUrl = websiteUrl
        ? `${websiteUrl}/resource-pool-portal/fetchExternalMember`
        : null;

    // Fetch external members via AJAX
    $.ajax({
        url: finalUrl,
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.length === 0) return;
            $select.empty(); // Clear existing options

            response.forEach(function (user) {
                if ($select.find(`option[value="${user.id}"]`).length === 0) {
                    $select.append(
                        `<option value="${user.id}">${user.name} (${user.email})</option>`
                    );
                }
            });
        },
        error: function (error) {
            console.error("Error fetching external members:", error);
        },
    });
}

function fetchManualExternalMembers() {
    let $select = $('select[name="users3[]"]');
    const toggleDiv = $("#toggleDiv"); // Use jQuery for consistency
    var selectedUserIds = [];

    // Get checked users
    $("input[name='selected[]']:checked").each(function () {
        selectedUserIds.push($(this).val());
    });

    // If no user is selected, show an alert and exit the function
    if (selectedUserIds.length === 0) {
        Swal.fire({
            icon: "info",
            html: `Please select at least one candidate to update.`,
        });
        return; // Stop execution
    }

    let remarks = $("#remarks").val();
    if (remarks == ""){
        Swal.fire({
            icon: "info",
            html: `Please enter remarks.`,
        });
        return; // Stop execution
    }

    // Toggle the div visibility
    if (toggleDiv.is(":visible")) {
        toggleDiv.hide();
        return; // Stop execution
    } else {
        toggleDiv.show();
    }

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    let finalUrl = websiteUrl
        ? `${websiteUrl}/resource-pool-portal/fetchExternalMember`
        : null;

    // Fetch external members via AJAX
    $.ajax({
        url: finalUrl,
        method: "GET",
        dataType: "json",
        success: function (response) {
            if (response.length === 0) return;
            $select.empty(); // Clear existing options

            response.forEach(function (user) {
                if ($select.find(`option[value="${user.id}"]`).length === 0) {
                    $select.append(
                        `<option value="${user.id}">${user.name} (${user.email})</option>`
                    );
                }
            });
        },
        error: function (error) {
            console.error("Error fetching external members:", error);
        },
    });
}

$(document).ready(function () {
    $(".js-multiple").select2();
    $(".js-single").select2();
    let storedCandidates = {};

    $("#job_title_id").change(function () {
        var jobTitleData = $(this).val(); // Get the selected value from the dropdown

        if (jobTitleData) {
            var jobTitleArray = jobTitleData.split(",");
            var jobId = jobTitleArray[0]; // Job ID
            var refQualificationId = jobTitleArray[1]; // Reference Qualification ID
            var minWorkExperience = jobTitleArray[2];

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/search-users-by-role?job_title_id=${jobId}&ref_qualification_id=${refQualificationId}&min_work_experience=${minWorkExperience}`
                : null;

            $("#candidateTable").DataTable().ajax.url(finalUrl).load();
        }
    });

    $("#requisition-year").on("change", function () {
        let requisitionYear = $(this).val();

        if (requisitionYear) {
            let requisitionListDropdown = $("#requisitionId");
            requisitionListDropdown.html('<option value="">Select requisition ID</option>');

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/selection-process`
                : null;

            $.ajax({
                url: finalUrl,
                type: "GET",
                data: {
                    requisitionYear: requisitionYear,
                },
                success: function (response) {
                    if (response.success && response.listOfRequisitions.length > 0) {
                        response.listOfRequisitions.forEach(function (item, index) {
                            requisitionListDropdown.append(
                                `<option value="${item.id}">${item.id} - ${item.job_title}</option>`
                            );
                        });
                    } else {
                        requisitionListDropdown.html(
                            '<option value="">No data found</option>'
                        );
                    }
                },
                error: function () {
                    console.log("Error fetching requisition list codes.");
                    requisitionListDropdown.html(
                        '<option value="">No data found</option>'
                    );
                },
            });
        }
    });

    $(document).on("click", "#generateCandidateList", function () {
        if ($.fn.dataTable.isDataTable("#candidateTable")) {
            $("#candidateTable").DataTable().destroy();
        }

        let postId = $("#requisitionId").val();
        $("#requisitionId_err").text("");
        if (postId == "") {
            $("#requisitionId_err").text("Please Select a Requisition ID");
            return false;
        }

        storedCandidates = {};
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute("content");
        let finalUrl = websiteUrl
            ? `${websiteUrl}/resource-pool-portal/search-users-by-role`
            : null;

        $("#candidateTable").DataTable({
            processing: true,
            serverSide: true,
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],
            ajax: {
                url: finalUrl,
                type: "GET",
                data: {
                    postId: postId,
                },
            },
            columns: [
                {
                    data: "DT_RowIndex",
                    name: "DT_RowIndex",
                    orderable: false,
                    searchable: false,
                }, // Serial number column
                {
                    data: "name",
                    name: "name",
                }, // Candidate Name
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "status",
                    name: "status",
                }, // Status column
                {
                    data: "action",
                    name: "action",
                    orderable: false,
                    searchable: false,
                }, // Action buttons
                {
                    data: "checkbox",
                    name: "checkbox",
                    orderable: false,
                    searchable: false,
                    render: (data, type, row) => {
                        let isChecked = data.checked ? "checked" : "";
                        let isDisabled = data.disabled ? "disabled" : "";
                        let isStored = storedCandidates[row.user_id]?.selected;

                        return `<input type="checkbox" class="select-input" name="selected[]" id="${
                            row.user_id
                        }" data-id="${row.user_id}" ${
                            isStored !== undefined
                                ? isStored
                                    ? "checked"
                                    : ""
                                : isChecked
                        } ${isDisabled}>`;
                    },
                },
            ],
            initComplete: function () {
                let api = this.api();

                // For each column
                api.columns().every(function () {
                    let column = this;

                    // Only target inputs in the 2nd row of header
                    $('input', column.header().nextElementSibling).on('keyup change clear', function () {
                        if (column.search() !== this.value) {
                            column.search(this.value).draw();
                        }
                    });
                });
            }
        });

        // Store selection when checkbox is checked/unchecked
        $(document).on("change", ".select-input", function () {
            let userId = $(this).data("id");
            if (!storedCandidates[userId]) storedCandidates[userId] = {};
            storedCandidates[userId].selected = $(this).prop("checked")
                ? true
                : false;
        });

        // Restore selections & remarks when table is redrawn (pagination, sorting, etc.)
        $("#candidateTable").on("draw.dt", function () {
            let table = $("#candidateTable").DataTable();
            let tableData = table.rows().data().toArray();

            tableData.forEach((row) => {
                let userId = row.user_id;

                if (!storedCandidates[userId] && row?.checkbox?.checked) {
                    storedCandidates[userId] = {
                        selected: row.checkbox.checked,
                    };
                }
            });

            if (tableData[0]?.checkbox?.disabled) {
                $(
                    "#efileCommittee, #remarks, #efileCommitteee, #generateShortlisted, #togglesButton, #shortlist"
                ).prop("disabled", true);
            } else {
                $(
                    "#efileCommittee, #remarks, #efileCommitteee, #generateShortlisted, #togglesButton, #shortlist"
                ).prop("disabled", false);
            }

            // Apply stored selections to checkboxes
            $(".select-input").each(function () {
                let userId = $(this).data("id");
                $(this).prop(
                    "checked",
                    storedCandidates[userId]?.selected ?? false
                );
            });
        });
    });

    $("#users1").on("change", function () {
        var selectedChairperson = $(this).val(); // Get selected chairperson ID
        if (selectedChairperson) {
            $("#users2 option").each(function () {
                if ($(this).val() == selectedChairperson) {
                    $(this).prop("disabled", true);
                } else {
                    $(this).prop("disabled", false);
                }
            });
        } else {
            $("#users2 option").prop("disabled", false);
        }
    });

    $("#users2").on("change", function () {
        var selectedCommitteeMember = $(this).val();
        if (selectedCommitteeMember) {
            $("#users1 option").each(function () {
                if ($(this).val() == selectedCommitteeMember) {
                    $(this).prop("disabled", true);
                } else {
                    $(this).prop("disabled", false);
                }
            });
        } else {
            $("#users1 option").prop("disabled", false);
        }
    });

    $.ajax({
        // {{-- url: "{{ route('ajax.searchUsersByRol') }}", --}}
        method: "GET",
        success: function (response) {
            if (response.html) {
                $("#user-list").html(response.html);
                $("#userModal").fadeIn();
            } else {
            }
        },
        error: function (xhr, status, error) {
            console.log("Error:", error);
        },
    });

    $("#generateShortlisted , #shortlist").click(function () {
        let clickedFrom = this.id;

        var users2 = [];
        $("select[name='users2[]'] option:selected").each(function () {
            users2.push($(this).val());
        });

        var users1 = $("#users1").val();
        let user3 = $("#users3").val();

        let requisitionId = $("#requisitionId").val();
        let errors = 0;
        let remarks = $("#remarks").val();
        $("#remarks_err").text("");
        if (remarks == "") {
            $("#remarks_err").text("Please enter remarks");
            errors++;
        }
        let efileCommittee = $("#efileCommitteee").val();
        /*****If clicked on Save Drafts Then ***************** */
        if (clickedFrom == "generateShortlisted") {
            let chairPerson = $("#users1").val();
            let member = $("#users2").val();
            $("#users2_err").text("");
            $("#users1_err").text("");

            if (chairPerson.length == 0) {
                $("#users1_err").text("Please select a chair person");
                errors++;
            }
            if (member.length == 0) {
                $("#users2_err").text("Please select a member");
                errors++;
            }
        }
        if (errors > 0) {
            return false;
        }

        if (users2.length > 0) {
            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/generateShortlisted`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "GET",
                data: {
                    chairPersone_id: users1,
                    committieeMember_id: users2,
                    externalMember: user3,
                    resource_requision_id: requisitionId,
                    remarks: remarks,
                    efileCommittee: efileCommittee,
                    selectedUser: storedCandidates,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Committee members finalized successfully.",
                        icon: "success",
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: error || 'Something went wrong, try again.',
                        icon: "error",
                    });
                },
            });
        } else {
            if (
                !(
                    Object.keys(storedCandidates).length > 0 &&
                    Object.entries(storedCandidates).length > 0
                )
            ) {
                Swal.fire({
                    icon: "info",
                    html: `Please select at least one candidate to update.`,
                });
                return; // Stop execution
            }

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/saveDraft`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "GET",
                data: {
                    chairPersone_id: users1,
                    committieeMember_id: users2,
                    externalMember: user3,
                    resource_requision_id: requisitionId,
                    remarks: remarks,
                    efileCommittee: efileCommittee,
                    selectedUser: storedCandidates,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Committee members drafted successfully.",
                        icon: "success",
                    });
                    $("#selectedCandidateTable").DataTable().destroy();
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "error-msg",
                        text: error,
                    });
                },
            });
        }
    });

    $("#generateManualShortlisted").click(function(){
        let clickedFrom = this.id;

        var users1 = $("#users1").val();
        var users2 = [];
        $("select[name='users2[]'] option:selected").each(function () {
            users2.push($(this).val());
        });
        let user3 = $("#users3").val();

        let errors = 0;
        let remarks = $("#remarks").val();
        if (remarks == ""){
            Swal.fire({
                icon: "info",
                html: `Please enter remarks.`,
            });
            return; // Stop execution
        }
        let efileCommittee = $("#efileCommitteee").val();
        let requisitionId = $("#requisitionId").val();
        /*****If clicked on Save Drafts Then ***************** */
        if (clickedFrom == "generateShortlisted") {
            let chairPerson = $("#users1").val();
            let member = $("#users2").val();
            $("#users2_err").text("");
            $("#users1_err").text("");

            if (chairPerson.length == 0) {
                Swal.fire({
                    icon: "info",
                    html: `Please select a chair person.`,
                });
                return; // Stop execution
            }
            if (member.length == 0) {
                Swal.fire({
                    icon: "info",
                    html: `Please select a chair member.`,
                });
                return; // Stop execution
            }
        }
        if (errors > 0) {
            return false;
        }

        var selectedUserIds = [];
        // Get checked users
        $("input[name='selected[]']:checked").each(function () {
            selectedUserIds.push($(this).val());
        });

        // If no user is selected, show an alert and exit the function
        if (selectedUserIds.length === 0) {
            Swal.fire({
                icon: "info",
                html: `Please select at least one candidate to update.`,
            });
            return; // Stop execution
        }

        if (users2.length > 0) {
            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/manual/generateShortlisted`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "GET",
                data: {
                    chairPersone_id: users1,
                    committieeMember_id: users2,
                    externalMember: user3,
                    resource_requision_id: requisitionId,
                    remarks: remarks,
                    efileCommittee: efileCommittee,
                    selectedUser: selectedUserIds,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Committee members finalized successfully.",
                        icon: "success",
                    });
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        html: "Error: " + error,
                    });
                    return; // Stop execution
                },
            });
        } else {
            if (
                !(
                    Object.keys(storedCandidates).length > 0 &&
                    Object.entries(storedCandidates).length > 0
                )
            ) {
                Swal.fire({
                    icon: "info",
                    html: `Please select at least one candidate to update.`,
                });
                return; // Stop execution
            }

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/saveDraft`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "GET",
                data: {
                    chairPersone_id: users1,
                    committieeMember_id: users2,
                    externalMember: user3,
                    resource_requision_id: requisitionId,
                    remarks: remarks,
                    efileCommittee: efileCommittee,
                    selectedUser: storedCandidates,
                },
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: "Committee members drafted successfully.",
                        icon: "success",
                    });
                    $("#selectedCandidateTable").DataTable().destroy();
                    setTimeout(() => {
                        location.reload();
                    }, 3000);
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        icon: "info",
                        html: "Error: " + error,
                    });
                    return; // Stop execution
                },
            });
        }
    });

    $("#ExternalMemberData").click(function () {
        $("#registerExternalMember").validate({
            rules: {
                externalMemberName: {
                    required: true,
                    minlength: 3,
                    maxlength: 500,
                },
                externalMemberEmail: {
                    required: true,
                    email: true,
                },
                externalMemberMobile: {
                    required: true,
                    digits: true,
                    minlength: 10,
                    maxlength: 10,
                },
            },
            messages: {
                externalMemberName: {
                    required: "Name is required.",
                    minlength: "Name must be at least 3 characters.",
                },
                externalMemberEmail: {
                    required: "Email is required.",
                    email: "Enter a valid email address.",
                },
                externalMemberMobile: {
                    required: "Mobile number is required.",
                    digits: "Enter a valid 10-digit mobile number.",
                },
            },
            errorPlacement: function (error, element) {
                var $errorContainer = element.next(".error-message");
                $errorContainer.html(""); // Clear old errors
                error.appendTo($errorContainer);
            },
        });

        if ($("#registerExternalMember").valid()) {
            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            const finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/external.committee.store`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "GET",
                data: {
                    externalMemberName: $("#externalMemberName").val(),
                    externalMemberEmail: $("#externalMemberEmail").val(),
                    externalMemberMobile: $("#externalMemberMobile").val(),
                },
                success: function (response) {
                    $("#registerExternalMember")[0].reset();

                    Swal.fire({
                        title: "Success!",
                        text: "New external member has been created successfully.",
                        icon: "success",
                    });

                    fetchExternalMembers();
                },
                error: function (xhr, status, error) {
                    Swal.fire({
                        title: "Error!",
                        text: "Failed to create member. Please try again.",
                        icon: "error",
                    });
                },
            });
        }
    });

    /**************************************efileCommittee Upload code ************* */
    $(".efileCommittee").on("change", function () {
        var $this = $(this);

        // Check the file type
        if ($this[0].files[0].type !== "application/pdf") {
            Swal.fire(
                "Warning",
                "Please select a valid pdf file only!!!",
                "warning"
            );
            $this.val("");
            return false;
        }

        // Check the file size (2MB)
        if ($this[0].files[0].size > 2000000) {
            $this.val("");
            Swal.fire(
                "Warning",
                "File size should not exceed 2MB!!!",
                "warning"
            );
            return false;
        }

        var formData = new FormData();
        var file = $this[0].files[0];
        formData.append("efileCommittee", file);
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");
        formData.append("_token", csrfToken);

        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute("content");
        let finalUrl = websiteUrl
            ? `${websiteUrl}/resource-pool-portal/efileCommittee`
            : null;
        let finalUrlOfViewFiles = websiteUrl
            ? `${websiteUrl}/resource-pool-portal/hr/viewFiles`
            : null;

        $.ajax({
            url: finalUrl,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    var fileName = encodeURIComponent(response.file_name);
                    var pathName = encodeURIComponent(
                        "uploads/hr/efileCommittee/"
                    );
                    let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                    url = url.replace(":fileName", fileName);
                    url = url.replace(":pathName", pathName);
                    $("#efileCommitteee").val(url);
                    let ii = 0;

                    $this
                        .parents(".attachment_section_efileCommittee")
                        .find(".upload_cust")
                        .hide();
                    $this
                        .parents(".attachment_section_efileCommittee")
                        .find('input[type="file"]')
                        .prop("required", false);
                    $this
                        .parents(".attachment_section_efileCommittee")
                        .siblings(".attachment_section_efileCommittee")
                        .show();

                    $(".attachment_section_efileCommittee").append(
                        '<div id="temp_12' +
                            ii +
                            '" ><a target="_blank" href="' +
                            url +
                            '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_efileCommittee" data-id="' +
                            ii++ +
                            '" data-name="' +
                            response.file_name +
                            '">Remove</a>&nbsp&nbsp&nbsp&nbsp'
                    );

                    $("#upload_efileCommittee").val(response.file_name);
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "error-msg",
                        text: response.message,
                    });
                    $this.val("");
                }
            },
            error: function (xhr, status, error) {
                console.error("Error occurred: " + status + " " + error);
            },
        });
    });
    $(document).on("click", ".report_remove_efileCommittee", function () {
        var $this = $(this);
        var id = $(this).attr("data-id");
        $this
            .parents(".attachment_section_efileCommittee")
            .find(".upload_cust")
            .show();
        $this.parents("#temp_12" + id).hide();
        $("#hiddendoc_upload_cover_photo").val("");
    });
});

/************************************* End efileCommittee Upload code  *********************/

$(document).ready(function () {
    let storedCandidates = {};
    let selectedCandidateTable;
    $(document).on("change", "#listSelectedByChairPerson", function () {
        $("#selectedCandidateTable").DataTable().destroy();

        let requision__short_id = $("#listSelectedByChairPerson").val();

        storedCandidates = {};
        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute("content");
        let finalUrl = websiteUrl
            ? `${websiteUrl}/resource-pool-portal/fetchusersortlistedByChairperson`
            : null;

        selectedCandidateTable = $("#selectedCandidateTable").DataTable({
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, "All"],
            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: finalUrl,
                type: "GET",
                data: {
                    requisitionId: requision__short_id,
                    shortlistId: 0,
                },
                dataSrc: function (json) {
                    if (json.recordsTotal === 0) {
                        $("#selectedCandidateTable")
                            .DataTable()
                            .settings()[0].oLanguage.sEmptyTable = `<div class='text-center text-gray-600 font-semibold'>${
                            json.customMessage || "No data found."
                        }</div>`;
                    }
                    return json.data;
                },
            },
            language: {
                emptyTable:
                    "<div class='text-center text-gray-600 font-semibold'>No data found.</div>",
            },
            columns: [
                {
                    data: null,
                    render: (data, type, row, meta) =>
                        meta.row + meta.settings._iDisplayStart + 1,
                    orderable: false,
                },
                {
                    data: "name",
                    name: "name",
                },
                {
                    data: "email",
                    name: "email",
                },
                {
                    data: "status",
                    name: "status",
                },
                {
                    data: "view-profile",
                    name: "view-profile",
                    orderable: false,
                    searchable: false,
                },
                {
                    data: "committee_remarks",
                    name: "committee_remarks",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        if (typeof data === "string") {
                            try {
                                data = JSON.parse(data);
                            } catch (e) {
                                console.error("Error parsing data:", e);
                                return '<span class="text-gray-400">No Members</span>';
                            }
                        }

                        if (!Array.isArray(data) || data.length === 0) {
                            return '<span class="text-gray-400">No Members</span>';
                        }

                        let membersHTML =
                            '<div class="flex flex-wrap gap-1 divide-x-2 divide-gray-400">';
                        data.forEach((member, index) => {
                            membersHTML += `
                                <button class="p-0 m-0 px-1 btn btn-default btn-sm" data-popover-target="popover-${
                                    row.id
                                }-${index}" type="button">
                                    <span class="${
                                        member.status === "Selected"
                                            ? "selected"
                                            : "rejected"
                                    }">${member.status}</span>
                                </button>
                                <div data-popover id="popover-${
                                    row.id
                                }-${index}"
                                    role="tooltip"
                                    class="absolute z-10 invisible w-72 text-wrap p-2 m-2 bg-white rounded-lg shadow-lg border border-gray-200 dark:bg-gray-800">
                                    <div class="bg-gray-400 border-b border-gray-600 rounded dark:border-gray-800 dark:bg-gray-900">
                                        <h3 class="font-semibold ps-1">${
                                            member.name
                                        } (${member.email})</h3>
                                    </div>
                                    <div class="py-2">
                                        <p>${member.remark}</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            `;
                        });
                        membersHTML += "</div>";
                        return membersHTML;
                    },
                },
                {
                    data: "chairperson_remarks",
                    name: "chairperson_remarks",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        if (typeof data === "string") {
                            try {
                                data = JSON.parse(data);
                            } catch (e) {
                                console.error("Error parsing data:", e);
                                return '<span class="text-gray-400">No Members</span>';
                            }
                        }

                        if (!Array.isArray(data) || data.length === 0) {
                            return '<span class="text-gray-400">No data found</span>';
                        }

                        let membersHTML =
                            '<div class="flex flex-wrap gap-1 divide-x-2 divide-gray-400">';
                        data.forEach((member, index) => {
                            membersHTML += `
                                <button class="p-0 m-0 px-1 btn btn-default btn-sm" data-popover-target="popover-${
                                    row.id
                                }-${index}-cp" data-popover-trigger="hover" type="button">
                                    <span class="${
                                        member.status === "Selected"
                                            ? "selected"
                                            : "rejected"
                                    }">${member.status}</span>
                                </button>
                                <div data-popover id="popover-${
                                    row.id
                                }-${index}-cp"
                                    role="tooltip"
                                    class="absolute z-10 invisible w-72 text-wrap p-2 m-2 bg-white rounded-lg shadow-lg border border-gray-200 dark:bg-gray-800">
                                    <div class="bg-gray-400 border-b border-gray-600 rounded dark:border-gray-800 dark:bg-gray-900">
                                        <h3 class="font-semibold ps-1">${
                                            member.name
                                        } (${member.email})</h3>
                                    </div>
                                    <div class="py-2">
                                        <p>${member.remark}</p>
                                    </div>
                                    <div data-popper-arrow></div>
                                </div>
                            `;
                        });
                        membersHTML += "</div>";
                        return membersHTML;
                    },
                },
                {
                    data: "select",
                    name: "select",
                    orderable: false,
                    searchable: false,
                    render: (data, type, row) => {
                        let batchData = data.batchData || "";
                        let isBatchAssigned = data.isBatchAssigned
                            ? "disabled"
                            : "";
                        let isStored = storedCandidates[row.id]?.selected;

                        return isBatchAssigned
                            ? batchData
                            : `<input type="checkbox" class="select-input" id="${
                                  row.id
                              }" data-id="${row.id}" ${
                                  isStored !== undefined
                                      ? isStored
                                          ? "checked"
                                          : ""
                                      : ""
                              }>`;
                    },
                },
            ],
        });

        // Function to initialize Flowbite popovers
        function initializePopovers() {
            // Loop through all popover elements and initialize them using Flowbite
            $("[data-popover]").each(function () {
                const targetEl = $(this)[0]; // The popover target
                const triggerEl = $(this).prev("[data-popover-target]")[0]; // The trigger element (button)
                const options = {
                    placement: "bottom",
                    triggerType: "hover",
                    offset: 5,
                };

                // Initialize popover using Flowbite's Popover constructor
                if (targetEl && triggerEl) {
                    new Popover(targetEl, triggerEl, options);
                }
            });
        }

        //  Store selection when checkbox is checked/unchecked and Store remark when input changes
        $(document).on("change", ".select-input, .remark-input", function () {
            let userId = $(this).data("id");
            if (!storedCandidates[userId]) storedCandidates[userId] = {};

            // Find the checkbox and input field for the same user
            let checkbox = $('.select-input[data-id="' + userId + '"]');
            let remarkInput = $('.remark-input[data-id="' + userId + '"]');

            // Update both values in storedCandidates
            storedCandidates[userId].selected = checkbox.prop("checked")
                ? true
                : false;
            storedCandidates[userId].remark = remarkInput.val().trim() || null; // Store null if empty
        });

        //  Restore selections & remarks when table is redrawn (pagination, sorting, etc.)
        selectedCandidateTable.on("draw", function () {
            $(".remark-input").each(function () {
                let userId = $(this).data("id");

                if (storedCandidates[userId]?.remark !== undefined) {
                    $(this).val(storedCandidates[userId].remark);
                }
            });

            $(".select-input").each(function () {
                let userId = $(this).data("id");
                isStored = storedCandidates[userId]?.selected;

                if (isStored !== undefined) {
                    $(this).prop("checked", isStored ?? false);
                }
            });
            initializePopovers();
        });
    });

    /**********************************Candidate Assessmenet ******************** */
    $(document).on("click", "#assessmentSubmitButton", function () {
        let exam = $("#exam-checkbox").prop("checked");
        let interview = $("#interview-checkbox").prop("checked");
        let batch_number = $("#batch_number").val();
        let date_time = $("#date_time").val();

        $(".exam_err").text("");
        $(".interview_err").text("");
        $(".batch_number_err").text("");
        $(".date_time_err").text("");
        // alert(exam);
        let err = 0;

        if (!exam && !interview) {
            $(".interview_err").text(
                "Exam or Interview one field should be checked"
            );
            err = 1;
        }
        // if(interview==""){
        //     $(".interview_err").text("Interview field is required");
        //     err=1;
        // }
        if (batch_number == "") {
            $(".batch_number_err").text("Batch number field is required");
            err = 1;
        }

        // $("input[name^='date_time_']").each(function(index) {
        //     let inputVal = $(this).val();
        //     let inputId = $(this).attr('id');
        //     let errorSpan = $("#" + inputId + "_err");

        //     errorSpan.text("");

        //     if (inputVal === "") {
        //         errorSpan.text("This field is required.");
        //         err=1;
        //     }else{
        //         let dateCount =dateValidation(inputVal);

        //         if((dateCount==0) || (dateCount<0)){
        //             errorSpan.text("Date time should be of future date.");
        //             err=1;
        //         }
        //     }
        // });

        if (date_time == "") {
            $(".date_time_err").text("Date time field is required");
            err = 1;
        } else {
            let dateCount = dateValidation(date_time);

            if (dateCount == 0 || dateCount < 0) {
                $(".date_time_err").text("Date time should be of future date");
                err = 1;
            }
        }
        if (!err) {
            let advertisement_id = $("#listSelectedByChairPerson").val();
            if (advertisement_id == "") {
                Swal.fire({
                    icon: "error",
                    title: "msg",
                    text: "Please select an advertisement",
                });
                err = 1;
            } else {
                if ($("#dataTablesRow tr").length) {
                    $("#dataTablesRow tr").each(function () {
                        let email = $(this).find("td").eq(2).text().trim();
                        $("#candidate_email").val(email); // Corrected this line
                        //alert(email);
                    });
                    let requision = $("#listSelectedByChairPerson").val();
                    $("#requision_id").val(requision);
                }
            }
        }
        if (err) {
            return false;
        } else {
            let formData = new FormData(
                document.getElementById("assessmentForm")
            );
            let selectedCandidates = Object.entries(storedCandidates)
                .filter(([id, data]) => data.selected === true) // only selected ones
                .map(([id]) => ({
                    id: id,
                }));
            formData.append(
                "selectedCandidates",
                JSON.stringify(selectedCandidates)
            );
            if (selectedCandidates.length === 0) {
                return Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Select at least one candidate",
                });
            }

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/candidate-batch`
                : null;

            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                url: finalUrl,
                type: "POST",
                processData: false,
                contentType: false,
                data: formData,
                success: function (response) {
                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                    });
                    $("#assessmentForm")[0].reset();
                    location.reload(true);
                },
                error: function (xhr, status, error) {
                    //alert('Error: ' + error);
                    console.log(xhr, status, error, "eeeeeeeeeeeeeeeeeeeee");
                    if (xhr.responseJSON.message) {
                        Swal.fire({
                            icon: "error",
                            title: "error-msg",
                            text: xhr.responseJSON.message,
                        });
                        $("#assessmentForm")[0].reset();
                    }
                },
            });
        }
    });
});

/*************************Code to create multiple batch timinmg ****************  */
// $(document).on("change", "#batch_number", function() {
//     $("#batches").html("");  // Clear the #batches container
//     let batchNo = $("#batch_number").val();  // Get the selected batch number
//     let batchList = "";

//     // Make sure batchNo is a number
//     let numberOfBatches = parseInt(batchNo, 10);

//     // Loop to generate the batch input fields
//     for (let i = 1; i <= numberOfBatches; i++) {
//         $("#batches").append(`
//             <div class="batches">
//                 <label for="date_time_${i}">Date and Time of Batch ${i}</label>
//                 <input name="date_time_${i}" id="date_time_${i}" type="datetime-local" class="date_time_input" placeholder="Date and Time of Batch ${i}" required>
//                 <span id="date_time_${i}_err" class="date_time_err candidateErr"></span>
//             </div>
//         `);
//     }
// });

/********************************************JS  For Candidate selection start  ******************************** */
$(document).ready(function () {
    // Initialize DataTable
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    let finalUrl = websiteUrl
        ? `${websiteUrl}/resource-pool-portal/hr/batchlisted-users`
        : null;
    let finalCandidateTable = $("#finalCandidate").DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
            type: "GET",
            data: function (d) {
                d.batch_id = $("#batchList").val(); // Send batch_id as part of the request
            },
            dataSrc: function (json) {
                if (json.recordsTotal === 0) {
                    $("#finalCandidate")
                        .DataTable()
                        .settings()[0].oLanguage.sEmptyTable = `<div class='text-center text-gray-600 font-semibold'>${
                        json.customMessage || "No data found."
                    }</div>`;
                }
                return json.data;
            },
        },
        language: {
            emptyTable:
                "<div class='text-center text-gray-600 font-semibold'>No data found.</div>",
        },
        columns: [
            {
                data: null,
                render: (data, type, row, meta) =>
                    meta.row + meta.settings._iDisplayStart + 1,
                orderable: false,
            },
            {
                data: "user_id",
                name: "user_id",
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "view-profile",
                name: "view-profile",
                orderable: false,
                searchable: false,
            },
            {
                data: "select",
                name: "select",
                orderable: false,
                searchable: false,
                render: (data, type, row) => {
                    return data;
                },
                // render: (data, type, row) => {
                //     return `<select class="" required>
                //                     <option value="">Select...</option>
                //                     <option value="Rejected">Rejected</option>
                //                     <option value="Reserve">Reserve</option>
                //                     <option value="Selected">Selected</option>
                //                 </select>`;
                // }
            },
            {
                data: "offer_letter",
                name: "offer_letter",
                orderable: false,
                searchable: false,
                // render: (data, type, row) => {
                //     return `<input type="file" class="border p-1 rounded w-full offer-letter" data-id="${row.id}" placeholder="Upload offer letter.">`;
                // }
            },
            {
                data: "date_of_joining",
                name: "date_of_joining",
                orderable: false,
                searchable: false,
                // render: (data, type, row) => {
                //     return `<input type="date" class="border p-1 rounded w-full joining-date" data-id="${row.id}">`;
                // }
            },
            {
                data: "remark",
                name: "remark",
                orderable: false,
                searchable: false,
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    // $(document).on('click', '.submit-btn', function() {
    //     var candidateId = $(this).data('id');
    //     var status = $('.select-status[data-id="' + candidateId + '"]').val();
    //     var dateOfJoining = $('.date-of-joining[data-id="' + candidateId + '"]').val();
    //     var offer = $('.upload-offer[data-id="' + candidateId + '"]').prop('files')[0];

    //     if (confirm('Are you sure you want to submit this information?')) {
    //         var formData = new FormData();
    //         formData.append('status', status);
    //         formData.append('date_of_joining', dateOfJoining);
    //         if (offer) {
    //             formData.append('offer', offer);
    //         }

    //         $.ajax({
    //             url: "{{ route('board-university-college.update', ':id') }}".replace(':id', candidateId),
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             type: 'POST',
    //             data: formData,
    //             processData: false,
    //             contentType: false,
    //             success: function(response) {
    //                 alert('Candidate updated successfully!');
    //                 table.ajax.reload();
    //             },
    //             error: function(xhr, status, error) {
    //                 alert('Something went wrong!');
    //             }
    //         });
    //     }
    // });

    $("#cs-requisitionId").on("change", function () {
        let csRequisitionId = $(this).val();
        let batchListDropdown = $("#batchList").html(
            '<option value="">Select batch code</option>'
        );

        if (csRequisitionId) {
            const csrfToken = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            const websiteMeta = document.querySelector(
                'meta[name="website-url"]'
            );
            const websiteUrl = websiteMeta?.getAttribute("content");
            let finalUrl = websiteUrl
                ? `${websiteUrl}/resource-pool-portal/hr/get-list-of-batches`
                : null;

            $.ajax({
                url: finalUrl,
                type: "GET",
                data: {
                    requisitionId: csRequisitionId,
                    _token: csrfToken,
                },
                success: function (response) {
                    if (response.success && response.batches.length > 0) {
                        response.batches.forEach(function (item, index) {
                            batchListDropdown.append(
                                `<option value="${item.id}">Batch - ${item.id}</option>`
                            );
                        });
                    } else {
                        finalCandidateTable.clear().draw();
                        batchListDropdown.html(
                            '<option value="">No batch found</option>'
                        );
                    }
                },
                error: function () {
                    console.log("Error fetching batch codes.");
                    finalCandidateTable.clear().draw();
                    batchListDropdown.html(
                        '<option value="">No batch found</option>'
                    );
                },
            });
        } else {
            finalCandidateTable.clear().draw();
            batchListDropdown.html('<option value="">No batch found</option>');
        }
    });

    // Handle the change event on the #batchList dropdown
    $(document).on("change", "#batchList", function () {
        finalCandidateTable.clear().draw();

        $("#batchList").val() ? finalCandidateTable.ajax.reload() : "";
    });

    $(document).on("change", ".upload-offer", function () {
        const $this = $(this); // Fix: assign `this` to `$this` so it's usable
        const row = $this.closest("tr");
        const offerLetter = $this[0].files[0];

        // File type check
        if (offerLetter.type !== "application/pdf") {
            Swal.fire(
                "Warning",
                "Please select a valid PDF file only!",
                "warning"
            );
            $this.val("");
            return false;
        }

        // File size check (2MB)
        if (offerLetter.size > 2 * 1024 * 1024) {
            Swal.fire("Warning", "File size should not exceed 2MB!", "warning");
            $this.val("");
            return false;
        }

        const formData = new FormData();
        formData.append("upload_offer_letter", offerLetter); // Fix: match backend input name
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        const websiteUrl = $('meta[name="website-url"]').attr("content");
        const uploadUrl = `${websiteUrl}/resource-pool-portal/hr/storeUpload_cover_photo`;
        const viewUrl = `${websiteUrl}/resource-pool-portal/hr/viewFiles`;

        $.ajax({
            url: uploadUrl,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status === true) {
                    const fileName = encodeURIComponent(response.file_name);
                    const pathName = encodeURIComponent(
                        "uploads/hr/upload_offer_letter/"
                    );
                    const fileUrl = `${viewUrl}?pathName=${pathName}&fileName=${fileName}`;

                    // Set value and show link
                    row.find(".store-filepath").val(fileName);
                    const $link = row.find(".view-offer-letter");
                    $link.attr("href", fileUrl).removeClass("hidden");
                }
                // else {
                    // row.find(".view-offer-letter").addClass("hidden");
                // }
            },
            error: function (xhr, status, error) {
                console.error("Error occurred:", status, error);
            },
        });
    });

    // Handle the click event on the submit button
    $(document).on("click", ".submit-btn", function () {
        const $btn = $(this);
        const originalText = $btn.html(); // Save original button content
        const userId = $btn.data("id");

        // Find the row that matches this userId
        const row = $btn.closest("tr");
        const status = row.find(".select-status").val();
        const offerLetter = row.find(".store-filepath").val();
        const dateOfJoining = row.find(".date-of-joining").val();
        const remark = row.find(".remark").val();

        // Validation
        if (!status) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please select a status for the candidate",
            });
            return;
        }

        if (status === "Selected" && !offerLetter && !dateOfJoining) {
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Please select an offer letter and date of joining for selected candidates",
            });
            return;
        }

        if (!confirm("Are you sure you want to submit this candidate's data?")) {
            return;
        }

        // Disable the button and show spinner
        $btn.prop("disabled", true).html(`Processing...`);

        const formData = new FormData();
        formData.append("ref_users_id", userId);
        formData.append("status", status);
        formData.append("date_of_joining", dateOfJoining);
        formData.append("remark", remark);

        if (offerLetter) {
            formData.append("offer_letter_file", offerLetter);
        }

        formData.append("nhidcl_batches_id", $("#batchList").val());
        formData.append("nhidcl_resource_requisition_id", $("#cs-requisitionId").val());

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
        formData.append("_token", csrfToken);

        const websiteMeta = document.querySelector('meta[name="website-url"]');
        const websiteUrl = websiteMeta?.getAttribute("content");
        const finalUrl = websiteUrl ? `${websiteUrl}/resource-pool-portal/hr/finalize-candidate-shortlist-status` : null;

        $.ajax({
            url: finalUrl,
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function (res) {
                location.reload();
                row.addClass("table-success");
            },
            error: function (xhr) {
                console.error(xhr.responseText);
                Swal.fire({
                    icon: "error",
                    title: "Error",
                    text: "Something went wrong! Please try again.",
                });

                // Re-enable the button and restore text on failure
                $btn.prop("disabled", false).html(originalText);
            }
        });
    });
});
