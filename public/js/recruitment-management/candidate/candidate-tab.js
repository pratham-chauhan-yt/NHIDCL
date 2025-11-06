const websiteMeta = document.querySelector('meta[name="website-url"]');
const websiteUrl = websiteMeta?.getAttribute('content');
const viewFileUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/candidate/advertisement/view/files` : null;

function formatDate(dateStr) {
    if (!dateStr) return "";
    const date = new Date(dateStr);
    return isNaN(date) ? "" : date.toISOString().split("T")[0]; // YYYY-MM-DD
}

function getExperience(startDate, endDate) {
    const start = new Date(startDate);
    const end = new Date(endDate);
    const diffYears = (end - start) / (1000 * 3600 * 24 * 365.25);
    return Math.floor(diffYears);
}

function personalDeatils(response) {
    if (!response?.data) return;
    const data = response.data;
    let citizenShipConsent = data?.citizenship_consent ?? 0;
    if (citizenShipConsent == 1) {
        $("#citizenship_consent").prop("checked", true);
        $("#citizenship_consent_hidden").val(1); // ensure hidden field matches
    } else {
        $("#citizenship_consent").prop("checked", false);
        $("#citizenship_consent_hidden").val(0);
    }

    // Also update hidden field dynamically when user toggles
    $("#citizenship_consent").on("change", function () {
        $("#citizenship_consent_hidden").val(this.checked ? 1 : 0);
    });

    let categoryConsent = data?.category_confirm ?? 0;
    if (categoryConsent == 1) {
        $("#category_confirm").prop("checked", true);
        $("#category_confirm_hidden").val(1); // ensure hidden field matches
    } else {
        $("#category_confirm").prop("checked", false);
        $("#category_confirm_hidden").val(0);
    }

    // Also update hidden field dynamically when user toggles
    $("#category_confirm").on("change", function () {
        $("#category_confirm_hidden").val(this.checked ? 1 : 0);
    });

    let exServiceManData = data?.ex_serviceman ?? false;
    let exServiceManConsent = data?.ex_serviceman_consent ?? 0;
    if (exServiceManData == true && exServiceManConsent == 1) {
        $("#ex_serviceman_div").slideDown();
        $("#ex_serviceman_consent").prop("checked", true);
        $("#ex_serviceman_consent_hidden").val(1); // ensure hidden field matches
    } else {
        $("#ex_serviceman_div").slideUp();
        $("#ex_serviceman_consent").prop("checked", false);
        $("#ex_serviceman_consent_hidden").val(0);
    }

    // Also update hidden field dynamically when user toggles
    $("#ex_serviceman_consent").on("change", function () {
        $("#ex_serviceman_consent_hidden").val(this.checked ? 1 : 0);
    });

    let disabilityData = data?.pwbd ?? 'No';
    let disabilityConsent = data?.disability_consent ?? 0;
    if (disabilityData == 'Yes' && disabilityConsent == 1) {
        $("#pwbd_div").slideDown();
        $("#disability_consent").prop("checked", true);
        $("#disability_consent_hidden").val(1); // ensure hidden field matches
    } else {
        $("#pwbd_div").slideUp();
        $("#disability_consent").prop("checked", false);
        $("#disability_consent_hidden").val(0);
    }

    // Also update hidden field dynamically when user toggles
    $("#disability_consent").on("change", function () {
        $("#disability_consent_hidden").val(this.checked ? 1 : 0);
    });

    let dobConsent = data?.dob_consent ?? 0;
    if (dobConsent == 1) {
        $("#dob_consent").prop("checked", true);
        $("#dob_consent_hidden").val(1); // ensure hidden field matches
    } else {
        $("#dob_consent").prop("checked", false);
        $("#dob_consent_hidden").val(0);
    }

    // Also update hidden field dynamically when user toggles
    $("#dob_consent").on("change", function () {
        $("#dob_consent_hidden").val(this.checked ? 1 : 0);
    });

    const fieldMap = {
        "#father_husband_name": data.father_husband_name,
        "#aadhar_number": data.aadhar_number,
        "#gender": data.gender,
        "#category": data.ref_caste_id,
        "#pwbd": data.pwbd,
        "#disability": data.disability,
        "#ex_serviceman": data.ex_serviceman ? "1" : "0",
        "#dob_consent_hidden": data.dob_consent ? "1" : "0",
        "#correspondence_address": data.correspondence_address,
        "#correspondence_city": data.correspondence_city,
        "#correspondence_state": data.ref_correspondence_state_id,
        "#correspondence_pincode": data.correspondence_pincode,
        "#permanent_address": data.permanent_address,
        "#permanent_city": data.permanent_city,
        "#permanent_state": data.ref_permanent_state_id,
        "#permanent_pincode": data.permanent_pincode,
        "#marital_status": data.marital_status,
        "#spouse_name": data.spouse_name,
        "#indian_citizen": data.indian_citizen,
    };

    for (const [selector, value] of Object.entries(fieldMap)) {
        $(selector).val(value || "");
        if (["#category", "#correspondence_state", "#permanent_state", "#marital_status", "#indian_citizen"].includes(selector)) {
            $(selector).trigger("change");
        }
    }

    // Handle spouse field after marital status is set
    if (data.marital_status === "Married") {
        document.getElementById("spouse_name_wrapper").style.display = "block";
        $("#spouse_name_field").show(); // your spouse input wrapper div
        $("#spouse_name").val(data.spouse_name || "");
    } else {
        document.getElementById("spouse_name_wrapper").style.display = "none";
        $("#spouse_name_field").hide();
        $("#spouse_name").val("");
    }

    const files = {
        upload_photoss: ["upload_photos", "upload_photos_filepath", ".attachment_section_photos", "temp_photos", "hide_upload_photos"],
        upload_signaturee: ["upload_signature", "upload_signature_filepath", ".attachment_section_sign", "temp_signature", "hide_upload_signature"],
        upload_caste_certificatee: ["upload_caste_certificate", "upload_caste_certificate_filepath", ".attachment_section_caste_certificate", "temp_caste", "hide_upload_caste_certificate"],
        upload_disability_prooff: ["upload_disability_proof", "upload_disability_proof_filepath", ".attachment_section_disability_proof", "temp_disability", "hide_upload_disability_proof"],
        upload_dob_prooff: ["upload_dob_proof", "upload_dob_proof_filepath", ".attachment_section_dob_proof", "temp_dob", "hide_upload_dob_proof"],
        upload_ex_serviceman_prooff: ["upload_ex_serviceman_proof", "upload_ex_serviceman_proof_filepath", ".attachment_section_ex_serviceman_proof", "temp_ex_serviceman", "hide_upload_ex_serviceman_proof"],
        upload_identity: ["upload_identity_proof", "upload_identity_proof_filepath", ".attachment_section_upload_identity", "temp_identity", "hide_upload_identity_proof"],
    };

    for (const [inputId, [fileKey, pathKey, sectionClass, tempId, hideUploadBtnClass]] of Object.entries(files)) {
        const file = data[fileKey];
        const path = data[pathKey];
        const url = file && path ? `${viewFileUrl}?pathName=${path}&fileName=${file}` : "";

        $(`#${inputId}`).val(url);
        $(`#${tempId}`).remove();

        if (file) {
            $(sectionClass).append(`
                <div id="${tempId}" class="my-3">
                    <a target="_blank" href="${url}" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">View</a>
                    <a href="javascript:void(0);" class="bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 report_remove_pre" data-id="2">Remove</a>
                </div>`);

            $('.attachment_preview').find(`.${hideUploadBtnClass}`).hide();
        }
    }
}

function educationalDetails(response) {
    if (!response?.data) return;
    let tableRow = ``;

    response.data.forEach((item, i) => {
        let completMarksheet = "";

        // strict check: both must be non-empty strings
        if (item.marksheet && item.marksheet.trim() !== "" && item.marksheet_filepath && item.marksheet_filepath.trim() !== "") {
            completMarksheet = `${viewFileUrl}?pathName=${encodeURIComponent(item.marksheet_filepath)}&fileName=${encodeURIComponent(item.marksheet)}`;
        }
        const param = { id: item.id, tab_id: response.tab_id };
        //<td>${completMarksheet ? `<a href="${completMarksheet}" class="btn btn-default btn-sm" target="_blank">View</a>` : "Not Uploaded"}</td>
        tableRow += `
            <tr>
                <td>${i + 1}</td>
                <td>${item.examination ?? ""}</td>
                <td>${item.institute_name ?? ""}</td>
                <td>${item.university_board ?? ""}</td>
                <td>${item.passing_year?.passing_year ?? ""}</td>
                <td>${item.percentage_cgpa ?? ""}</td>
                <td>
                    <button onclick="confirmEdutDelete(${item.id}, ${response.tab_id});" data-url="candidate/educational_details/delete" class="btn btn-danger btn-sm">Delete</button>
                </td>
            </tr>`;
    });
    $("#eduTbody").html(tableRow);
}

function experienceDetails(response) {
    if (!response?.data) return;
    let tableRow = ``;

    response.data.forEach((item, i) => {
        const completExpCerificate = `${viewFileUrl}?pathName=${item.experience_certificate_filepath}&fileName=${item.experience_certificate}`;
        const fromDate = formatDate(item.from_date);
        const toDate = formatDate(item.to_date);
        const experience = (fromDate && toDate) ? getExperience(fromDate, toDate) : "less than 1 Month";

        const param = { id: item.id, tab_id: response.tab_id };
        // <td>
        //     ${
        //         item.experience_certificate && item.experience_certificate.trim() !== ""
        //         ? `<a href="${completExpCerificate}" class="btn btn-default btn-sm" target="_blank">View</a>`
        //         : ""
        //     }
        // </td>
        tableRow += `
            <tr>
                <td>${i + 1}</td>
                <td>${item.employer_name ?? ""}</td>
                <td>${item.post_held ?? ""}</td>
                <td>${fromDate} - ${toDate}</td>
                <td>${experience}</td>
                <td>${item.job_description ?? ""}</td>
                <td>
                    <button class="btn btn-danger btn-sm" onclick="confirmDelete(${param.id}, ${param.tab_id});">Delete</button>
                </td>
            </tr>`;
    });

    $("#expeTbody").html(tableRow);
}

function getExperience(fromDate, toDate) {
    const start = new Date(fromDate);
    const end = new Date(toDate);

    let years = end.getFullYear() - start.getFullYear();
    let months = end.getMonth() - start.getMonth();
    let days = end.getDate() - start.getDate();

    // Adjust days
    if (days < 0) {
        months -= 1;
        days += new Date(end.getFullYear(), end.getMonth(), 0).getDate(); 
    }

    // Adjust months
    if (months < 0) {
        years -= 1;
        months += 12;
    }

    // Build result string
    let result = [];
    if (years > 0) result.push(years + " Year" + (years > 1 ? "s" : ""));
    if (months > 0) result.push(months + " Month" + (months > 1 ? "s" : ""));
    //if (days > 0) result.push(days + " Day" + (days > 1 ? "s" : ""));

    return result.length > 0 ? result.join(" ") : "less than 1 Month";
}

window.onload = function () {
    const currentTab = getCookie('selected_tab_candidate');
    if (currentTab && currentTab !== "#") {
        setTimeout(() => $(`#${currentTab}`).click(), 10);
    } else {
        $("#defaultOpen1").click();
    }
};

function confirmEdutDelete(id) {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content')
    Swal.fire({
        title: "Are you sure?",
        text: "You want to delete this record!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            // Perform AJAX delete
            $.ajax({
                url: websiteUrl+"/recruitment-portal/candidate/educational_details/delete/" + id,   // <-- Laravel delete route
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    Swal.fire("Deleted!", "Record has been deleted.", "success")
                        .then(() => {
                            location.reload();
                        });
                },
                error: function (xhr) {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        }
    });
}


