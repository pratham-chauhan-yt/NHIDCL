$(document).ready(function () {
    const initDataTable = (selector, ajaxUrl, columns, pageLength = 25) => {
        if ($(selector).length && typeof ajaxUrl !== "undefined") {

            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }

            $(selector).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                url: ajaxUrl,
                    data: function (d) {
                        // send filter values to server
                        d.name = $('#name_filter').val();
                        d.email = $('#email_filter').val();
                        d.mobile = $('#mobile_filter').val();
                        d.designation = $('#designation_filter').val();
                        d.department = $('#department_filter').val();
                    }
                },
                columns: columns,
                pageLength: pageLength,
                lengthMenu: [10, 25, 50, 100]
            });
        }
    };

    // Attendance Table Columns
    const sessionsViewColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "name", name: "name" },
        { data: "agenda", name: "agenda" },
        { data: "date", name: "date" },
        { data: "duration", name: "duration" },
        { data: "type", name: "type" },
        { data: "status", name: "status" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action" },
    ];

    // Conditionally initialize each table
    if (typeof sessionsDataUrl !== "undefined") {
        initDataTable("#sessionsTable", sessionsDataUrl, sessionsViewColumns, 25);
    }

    // Request Training Table Columns
    const requestViewColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "training_topic", name: "training_topic" },
        { data: "message", name: "message" },
        { data: "status", name: "status" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action" },
    ];

    if (typeof requestDataUrl !== "undefined") {
        initDataTable("#requestTable", requestDataUrl, requestViewColumns, 25);
    }

    // Training Budget Table Columns
    const budgetViewColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "training", name: "training" },
        { data: "trainer", name: "trainer" },
        { data: "amount", name: "amount" },
        { data: "status", name: "status" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action" },
        
    ];

    if (typeof budgetDataUrl !== "undefined") {
        initDataTable("#budgetTable", budgetDataUrl, budgetViewColumns, 25);
    }

    // Employee Table Columns
    const employeeViewColumns = [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
            className: "text-center",
        },
        { data: "name", name: "name" },
        { data: "email", name: "email" },
        { data: "mobile", name: "mobile" },
        { data: "department_master", name: "department_master" },
        { data: "employee_type", name: "employee_type" },
        { data: "action", name: "action", className: "text-center" },      
    ];

    if (typeof employeeDataUrl !== "undefined") {
        initDataTable("#employeeTable", employeeDataUrl, employeeViewColumns, 50);
    }

    let typingTimer;      // Timer holder
    const typingDelay = 300; // 3 seconds

    $('.filter-input').on('keyup change', function () {
        clearTimeout(typingTimer); // reset timer
        
        typingTimer = setTimeout(function () {
            $('#employeeTable').DataTable().ajax.reload();
        }, typingDelay);
    });
});

$(document).on("click", "#upload-guide-btn", function (e) {
    e.preventDefault(); // stop the form from submitting automatically

    let isValid = true;
    // clear old errors
    $(".error-message").remove();

    // helper to show error under input
    function showError(input, message) {
        isValid = false;
        if (input.next(".error-message").length === 0) {
            input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
        } else {
            input.next(".error-message").text(message);
        }
    }

    // validate all inputs/selects with data-validation rules
    $("#upload-guide-form")
    .find("input, select, textarea")
    .each(function () {
        let input = $(this);
        let val = input.val().trim();
        let type = input.data("validate"); // e.g. "required", "number", "file"

        if (type === "required" && val === "") {
            showError(input, input.data("error") || "This field is required.");
        }
        if (type === "number" && (val === "" || isNaN(val))) {
            showError(input, input.data("error") || "Please enter a valid number.");
        }
        if (type === "file" && this.files.length === 0) {
            showError(input, input.data("error") || "Please upload a file.");
        }
    });

    // Only submit if valid
    if (isValid) {
        $("#upload-guide-form").submit();
    }
});

$(document).on("click", "#upload-budget-btn", function (e) {
    e.preventDefault(); // stop the form from submitting automatically

    let isValid = true;
    // clear old errors
    $(".error-message").remove();

    // helper to show error under input
    function showError(input, message) {
        isValid = false;
        if (input.next(".error-message").length === 0) {
            input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
        } else {
            input.next(".error-message").text(message);
        }
    }

    // validate all inputs/selects with data-validation rules
    $("#upload-budget-form")
    .find("input, select, textarea")
    .each(function () {
        let input = $(this);
        let val = input.val().trim();
        let type = input.data("validate"); // e.g. "required", "number", "file"

        if (type === "required" && val === "") {
            showError(input, input.data("error") || "This field is required.");
        }
        if (type === "number" && (val === "" || isNaN(val))) {
            showError(input, input.data("error") || "Please enter a valid number.");
        }
        if (type === "file" && this.files.length === 0) {
            showError(input, input.data("error") || "Please upload a file.");
        }
    });

    // Only submit if valid
    if (isValid) {
        $("#upload-budget-form").submit();
    }
});

$(document).on("click", "#training-request-btn", function (e) {
    e.preventDefault(); // stop the form from submitting automatically

    let isValid = true;
    // clear old errors
    $(".error-message").remove();

    // helper to show error under input
    function showError(input, message) {
        isValid = false;
        if (input.next(".error-message").length === 0) {
            input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
        } else {
            input.next(".error-message").text(message);
        }
    }

    // validate all inputs/selects with data-validation rules
    $("#training-request-form")
    .find("input, select, textarea")
    .each(function () {
        let input = $(this);
        let val = input.val().trim();
        let type = input.data("validate"); // e.g. "required", "number", "file"

        if (type === "required" && val === "") {
            showError(input, input.data("error") || "This field is required.");
        }
        if (type === "number" && (val === "" || isNaN(val))) {
            showError(input, input.data("error") || "Please enter a valid number.");
        }
        if (type === "file" && this.files.length === 0) {
            showError(input, input.data("error") || "Please upload a file.");
        }
    });

    // Only submit if valid
    if (isValid) {
        $("#training-request-form").submit();
    }
});

$(document).on("click", "#approve-request-btn", function (e) {
    e.preventDefault(); // stop the form from submitting automatically

    let isValid = true;
    // clear old errors
    $(".error-message").remove();

    // helper to show error under input
    function showError(input, message) {
        isValid = false;
        if (input.next(".error-message").length === 0) {
            input.after(`<span class="error-message text-red-600 text-sm">${message}</span>`);
        } else {
            input.next(".error-message").text(message);
        }
    }

    // validate all inputs/selects with data-validation rules
    $("#approve-request-form")
    .find("input, select, textarea")
    .each(function () {
        let input = $(this);
        let val = input.val().trim();
        let type = input.data("validate"); // e.g. "required", "number", "file"

        if (type === "required" && val === "") {
            showError(input, input.data("error") || "This field is required.");
        }
        if (type === "number" && (val === "" || isNaN(val))) {
            showError(input, input.data("error") || "Please enter a valid number.");
        }
        if (type === "file" && this.files.length === 0) {
            showError(input, input.data("error") || "Please upload a file.");
        }
    });

    // Only submit if valid
    if (isValid) {
        $("#approve-request-form").submit();
    }
});

function openGuideModal(sessionId) {
    document.getElementById('session_id').value = sessionId; // Set session ID in hidden input
    document.getElementById('guideModal').style.display = 'flex'; // Show the modal
}

// Close the modal
function closeModal() {
    document.getElementById('session_id').value = '';
    document.getElementById('guideModal').style.display = 'none'; // Hide the modal
}

function openBudgetModal(sessionId) {
    document.getElementById('budget_session_id').value = sessionId; // Set session ID in hidden input
    document.getElementById('budgetModal').style.display = 'flex'; // Show the modal
}

function closeBudgetModal() {
    document.getElementById('budget_session_id').value = '';
    document.getElementById('budgetModal').style.display = 'none'; // Hide the modal
}

function openApproveModal(sessionId) {
    document.getElementById('approve_session_id').value = sessionId; // Set session ID in hidden input
    document.getElementById('approveModal').style.display = 'flex'; // Show the modal
}

function closeApproveModal() {
    document.getElementById('approve_session_id').value = '';
    document.getElementById('approveModal').style.display = 'none'; // Hide the modal
}