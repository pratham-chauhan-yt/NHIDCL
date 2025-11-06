const allowedImageType = [
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/webp",
    "image/gif",
];

const allowedFileTypes = [
    // Images
    "image/jpeg",
    "image/png",
    "image/jpg",
    "image/webp",

    "application/pdf",

    "application/msword",
    "application/vnd.openxmlformats-officedocument.wordprocessingml.document",

    "application/vnd.ms-excel",
    "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",


    "application/vnd.google-earth.kml+xml",
    "application/vnd.google-earth.kmz",

    "application/xml", // Fallback for KML
    "application/zip"  // Fallback for KMZ
];

const imageSize = 1 * 1024 * 1024;

function showError(title = "Error", message = "Something went wrong") {
    Swal.fire({
        icon: "error",
        title: title,
        text: message,
    });
}

function showSuccess(
    title = "Success",
    message = "Action completed successfully"
) {
    Swal.fire({
        icon: "success",
        title: title,
        text: message,
    });
}

// start sidemenu script
document.addEventListener("DOMContentLoaded", function () {
    const defaultOpenTab = document.getElementById("defaultOpen");
    if (defaultOpenTab) {
        defaultOpenTab.click();
    }
});

// Sidebar submenu script
document.addEventListener("DOMContentLoaded", function () {
    // Add click listeners to all menu links
    document.querySelectorAll(".menu-link").forEach(function (link) {
        link.addEventListener("click", function (e) {
            e.preventDefault(); // Prevent default link behavior

            const sidebar = document.querySelector(".sidebar");
            if (sidebar && sidebar.classList.contains("open")) {
                const parentDropdown = this.parentElement;

                // Toggle dropdown visibility
                parentDropdown.classList.toggle("show");

                // Close other dropdowns
                document
                    .querySelectorAll(".menu-item.dropdown")
                    .forEach(function (item) {
                        if (item !== parentDropdown) {
                            item.classList.remove("show");
                        }
                    });
            }
        });
    });
});

// Sidebar open/close functionality
const sidebar = document.querySelector(".sidebar");
const closeBtn = document.querySelector("#btn");
const searchBtn = document.querySelector(".bx-search");
const navList = document.querySelector(".nav-list");

if (closeBtn) {
    closeBtn.addEventListener("click", () => {
        toggleSidebar();
    });
}

if (searchBtn) {
    searchBtn.addEventListener("click", () => {
        toggleSidebar();
    });
}

// Function to toggle the sidebar open/close state
function toggleSidebar() {
    sidebar.classList.toggle("open");
    navList.classList.toggle("scroll");
    updateMenuButtonIcon();
    closeAllDropdowns();
}

// Function to update the menu button icon
function updateMenuButtonIcon() {
    if (sidebar.classList.contains("open")) {
        closeBtn.classList.replace("bx-menu", "bx-menu-alt-right");
    } else {
        closeBtn.classList.replace("bx-menu-alt-right", "bx-menu");
    }
}

// Function to close all dropdowns
function closeAllDropdowns() {
    document.querySelectorAll(".menu-item.dropdown").forEach(function (item) {
        item.classList.remove("show");
    });
}
// End sidemenu script

// tab script
// Tab functionality
function openPage(pageName, elmnt, color) {
    // Hide all tab content
    let tabcontent = document.getElementsByClassName("tabcontent");
    for (let i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Remove active class from all buttons
    let tablinks = document.getElementsByClassName("tablink");
    for (let i = 0; i < tablinks.length; i++) {
        tablinks[i].classList.remove("active");
        tablinks[i].style.backgroundColor = "";
    }

    // Show the selected tab
    document.getElementById(pageName).style.display = "block";

    // Add active class to the clicked button
    elmnt.classList.add("active");

    // Optional: keep background color if you want
    if (color) {
        elmnt.style.backgroundColor = color;
    }
}


// Edn tab script

// select input redirect page script

(function ($) {
    $("select #role").change(function () {
        var getValue = $(this).val();
        window.open(getValue, "_blank");
    });
})(jQuery);

// End input redirect page script

// Email formate checking
function isEmail(email) {
    const validateEmail = (email) => {
        return String(email)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
    };

    return validateEmail(email) !== null;
}
// End Email formate checking

if (
    document.getElementById("selection-table") &&
    typeof simpleDatatables.DataTable !== "undefined"
) {
    let multiSelect = true;
    let rowNavigation = false;
    let table = null;

    const resetTable = function () {
        if (table) {
            table.destroy();
        }

        const options = {
            rowRender: (row, tr, _index) => {
                if (!tr.attributes) {
                    tr.attributes = {};
                }
                if (!tr.attributes.class) {
                    tr.attributes.class = "";
                }
                if (row.selected) {
                    tr.attributes.class += " selected";
                } else {
                    tr.attributes.class = tr.attributes.class.replace(
                        " selected",
                        ""
                    );
                }
                return tr;
            },
        };
        if (rowNavigation) {
            options.rowNavigation = true;
            options.tabIndex = 1;
        }

        table = new simpleDatatables.DataTable("#selection-table", options);

        // Mark all rows as unselected
        table.data.data.forEach((data) => {
            data.selected = false;
        });

        table.on("datatable.selectrow", (rowIndex, event) => {
            event.preventDefault();
            const row = table.data.data[rowIndex];
            if (row.selected) {
                row.selected = false;
            } else {
                if (!multiSelect) {
                    table.data.data.forEach((data) => {
                        data.selected = false;
                    });
                }
                row.selected = true;
            }
            table.update();
        });
    };

    // Row navigation makes no sense on mobile, so we deactivate it and hide the checkbox.
    const isMobile = window.matchMedia("(any-pointer:coarse)").matches;
    if (isMobile) {
        rowNavigation = false;
    }

    resetTable();
}

// multi select script
$(function () {
    setCheckboxSelectLabels();

    $(".toggle-next").click(function () {
        $(this).next(".checkboxes").slideToggle(400);
    });

    $(".ckkBox").change(function () {
        toggleCheckedAll(this);
        setCheckboxSelectLabels();
    });
});

function setCheckboxSelectLabels(elem) {
    var wrappers = $(".wrapper");
    $.each(wrappers, function (key, wrapper) {
        var checkboxes = $(wrapper).find(".ckkBox");
        var label = $(wrapper).find(".checkboxes").attr("id");
        var prevText = "";
        $.each(checkboxes, function (i, checkbox) {
            var button = $(wrapper).find("button");
            if ($(checkbox).prop("checked") == true) {
                var text = $(checkbox).next().html();
                var btnText = prevText + text;
                var numberOfChecked = $(wrapper).find(
                    "input.val:checkbox:checked"
                ).length;
                if (numberOfChecked >= 4) {
                    btnText = numberOfChecked + " " + label + " selected";
                }
                $(button).text(btnText);
                prevText = btnText + ", ";
            }
        });
    });
}

function toggleCheckedAll(checkbox) {
    var apply = $(checkbox).closest(".wrapper").find(".apply-selection");
    apply.fadeIn("slow");

    var val = $(checkbox).closest(".checkboxes").find(".val");
    var all = $(checkbox).closest(".checkboxes").find(".all");
    var ckkBox = $(checkbox).closest(".checkboxes").find(".ckkBox");

    if (!$(ckkBox).is(":checked")) {
        $(all).prop("checked", true);
        return;
    }

    if ($(checkbox).hasClass("all")) {
        $(val).prop("checked", false);
    } else {
        $(all).prop("checked", false);
    }
}
// End

function dateValidation(dateString) {
    let inputDate = new Date(dateString);
    let currentDate = new Date();
    inputDate.setHours(0, 0, 0, 0);
    currentDate.setHours(0, 0, 0, 0);
    let diffInTime = inputDate - currentDate;
    let diffInDays = diffInTime / (1000 * 3600 * 24);
    return diffInDays;
}

$("form").on("submit", function () {
    var $btn = $("#login-btn");
    $btn.prop("disabled", true);
    $btn.find(".spinner").show();
});

document.addEventListener("DOMContentLoaded", function () {
    // Email input
    const emailInput =
        document.getElementById("email") || document.getElementById("login");
    const emailError = document.getElementById("emailError");

    // Password input
    const passwordInput = document.getElementById("password");
    const passwordError = document.getElementById("passwordError");

    // Password input
    const otpInput = document.getElementById("code");
    const otpError = document.getElementById("otpError");

    // Email validation
    if (emailInput) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        // 🔹 Validate on input
        emailInput.addEventListener("input", function () {
            const value = emailInput.value;

            // Check for leading space
            const hasLeadingSpace = value.startsWith(" ");

            // Trimmed value for format check
            const trimmedValue = value.trim();

            // Email format validation
            const isValidEmail = emailPattern.test(trimmedValue);
            if (hasLeadingSpace || !isValidEmail) {
                emailInput.classList.add("is-invalid");

                if (emailError) {
                    if (hasLeadingSpace) {
                        emailError.textContent =
                            "Email cannot start with a space.";
                    } else {
                        emailError.textContent =
                            "Please enter a valid email address.";
                    }
                }
            } else {
                emailInput.classList.remove("is-invalid");
                if (emailError) emailError.textContent = "";
            }
        });

        // 🔹 Prevent leading space on keypress
        emailInput.addEventListener("input", function () {
            const raw = emailInput.value;
            const trimmed = raw.trim();
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            emailInput.value = trimmed; // auto-trim input
            const isValid = emailPattern.test(trimmed);

            if (!isValid) {
                emailInput.classList.add("is-invalid");
                if (emailError)
                    emailError.textContent =
                        "Please enter a valid email address.";
            } else {
                emailInput.classList.remove("is-invalid");
                if (emailError) emailError.textContent = "";
            }
        });
    }

    // Password validation
    if (passwordInput) {
        const passwordPattern = /^.{6,}$/; // at least 6 characters
        passwordInput.addEventListener("input", function () {
            const isValid = passwordPattern.test(passwordInput.value);

            if (!isValid) {
                passwordInput.classList.add("is-invalid");
                if (passwordError)
                    passwordError.textContent =
                        "Password must be at least 6 characters.";
            } else {
                passwordInput.classList.remove("is-invalid");
                if (passwordError) passwordError.textContent = "";
            }
        });
    }

    // OTP code validation
    if (otpInput) {
        const otpPattern = /^\d{6}$/; // exactly 6 digits, only numbers

        otpInput.addEventListener("input", function () {
            const isValid = otpPattern.test(otpInput.value);

            if (!isValid) {
                otpInput.classList.add("is-invalid");
                if (otpError)
                    otpError.textContent =
                        "OTP must be exactly 6 numeric digits.";
            } else {
                otpInput.classList.remove("is-invalid");
                if (otpError) otpError.textContent = "";
            }
        });

        // Optional: prevent non-digit input (key press level)
        otpInput.addEventListener("keypress", function (e) {
            if (!/\d/.test(e.key)) {
                e.preventDefault(); // block non-numeric characters
            }
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("login-form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const passwordField = document.getElementById("password");
            const rawPassword = passwordField.value;
            const rawKey = document
                .querySelector('meta[name="salt-key"]')
                .getAttribute("content");
            const fullKey = rawKey.padStart(16, rawKey); // Should be 16 chars
            const key = CryptoJS.enc.Utf8.parse(fullKey);
            const iv = CryptoJS.enc.Utf8.parse(fullKey);

            const encrypted = CryptoJS.AES.encrypt(rawPassword, key, {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7,
            }).toString();

            passwordField.value = encrypted;
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const refreshBtn = document.querySelector(".btn-refresh");
    const loader = document.querySelector(".cloader");
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");

    const refreshCaptchaUrl = websiteUrl
        ? `${websiteUrl}/refresh-captcha`
        : null;

    if (refreshBtn && refreshCaptchaUrl && loader) {
        refreshBtn.addEventListener("click", function () {
            // Disable interaction + show loader
            refreshBtn.style.pointerEvents = "none";
            refreshBtn.style.opacity = "0.5";
            loader.style.display = "block";

            fetch(refreshCaptchaUrl, { method: "GET" })
                .then((response) => response.json())
                .then((data) => {
                    const captchaImage = document.getElementById("captcha-image");
                    if (captchaImage) {
                        captchaImage.src = data.captcha + "?" + Date.now();
                    }
                })
                .catch((error) => {
                    console.error("Captcha refresh failed:", error);
                })
                .finally(() => {
                    // Enable interaction + hide loader
                    refreshBtn.style.pointerEvents = "auto";
                    refreshBtn.style.opacity = "1";
                    loader.style.display = "none";
                });
        });
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("password-change");

    if (form) {
        form.addEventListener("submit", function (e) {
            const $submitBtn = $("#login-btn");
            $submitBtn.prop("disabled", true);
            $submitBtn.find(".spinner").show();
            const passwordField = document.getElementById("password-input");
            const confirmPasswordField =
                document.getElementById("password-confirm");

            const rawPassword = passwordField.value.trim();
            const confirmPassword = confirmPasswordField.value.trim();

            // Password format pattern: min 8 chars, 1 uppercase, 1 number, 1 special character
            const passwordPattern = /^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

            // Clear previous error messages (optional)
            document
                .querySelectorAll(".validation-error")
                .forEach((el) => el.remove());

            let isValid = true;

            // Validate password format
            if (!passwordPattern.test(rawPassword)) {
                showError(
                    passwordField,
                    "Password must be at least 8 characters long and include one uppercase letter, one number, and one special character."
                );
                isValid = false;
            }

            // Validate confirm password format
            if (!passwordPattern.test(confirmPassword)) {
                showError(
                    confirmPasswordField,
                    "Confirm password must follow the same format as the password."
                );
                isValid = false;
            }

            // Check if passwords match
            if (rawPassword !== confirmPassword) {
                showError(
                    confirmPasswordField,
                    "Confirm password does not match the password."
                );
                isValid = false;
            }

            if (!isValid) {
                e.preventDefault(); // Stop form submission if validation fails
                return;
            }

            // Encrypt only if validation passed
            const rawKey = document
                .querySelector('meta[name="salt-key"]')
                .getAttribute("content");
            const fullKey = rawKey.padStart(16, rawKey);
            const key = CryptoJS.enc.Utf8.parse(fullKey);
            const iv = CryptoJS.enc.Utf8.parse(fullKey);

            const encryptedPassword = CryptoJS.AES.encrypt(rawPassword, key, {
                iv: iv,
                mode: CryptoJS.mode.CBC,
                padding: CryptoJS.pad.Pkcs7,
            }).toString();

            const encryptedConfirmPassword = CryptoJS.AES.encrypt(
                confirmPassword,
                key,
                {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7,
                }
            ).toString();

            passwordField.value = encryptedPassword;
            confirmPasswordField.value = encryptedConfirmPassword;
        });
    }

    // Helper to show error message under the field
    function showError(field, message) {
        const $submitBtn = $("#login-btn");
        $submitBtn.prop("disabled", false).find(".spinner").hide();

        // Remove existing error for this field (if any)
        const existingError = field.parentNode.querySelector(".alert-danger");
        if (existingError) {
            existingError.remove();
        }

        // Add new error message
        const error = document.createElement("div");
        error.className = "alert-danger";
        error.innerText = message;
        field.parentNode.appendChild(error);
    }
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("change-password-form");
    if (form) {
        form.addEventListener("submit", function (e) {
            const currentPasswordField =
                document.getElementById("current_password");
            const currentPassword = currentPasswordField.value;

            const newPasswordField = document.getElementById("new_password");
            const newPassword = newPasswordField.value;

            const confirmPasswordField = document.getElementById(
                "new_password_confirmation"
            );
            const confirmPassword = confirmPasswordField.value;

            // Get the 4-digit session key from Blade
            const rawKey = document
                .querySelector('meta[name="salt-key"]')
                .getAttribute("content");

            // Pad the 4-digit key to 16 bytes (e.g. "3482" -> "3482348234823482")
            const fullKey = rawKey.padStart(16, rawKey); // just repeat the digits
            const key = CryptoJS.enc.Utf8.parse(fullKey);
            const iv = CryptoJS.enc.Utf8.parse(fullKey); // same for IV

            const encryptedCurrentPassword = CryptoJS.AES.encrypt(
                currentPassword,
                key,
                {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7,
                }
            ).toString();
            currentPasswordField.value = encryptedCurrentPassword;

            const encryptedNewPassword = CryptoJS.AES.encrypt(
                newPassword,
                key,
                {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7,
                }
            ).toString();
            newPasswordField.value = encryptedNewPassword;

            const encryptedConfirmPassword = CryptoJS.AES.encrypt(
                confirmPassword,
                key,
                {
                    iv: iv,
                    mode: CryptoJS.mode.CBC,
                    padding: CryptoJS.pad.Pkcs7,
                }
            ).toString();
            confirmPasswordField.value = encryptedConfirmPassword;
        });
    }
});

$(document).ready(function () {
    $("#registerFrm").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                maxlength: 24,
                fullname: true,
            },
            mobile: {
                required: true,
                minlength: 10,
                maxlength: 10,
                mobile: true,
            },
            email: {
                required: true,
                email: true,
            },
            captcha: {
                required: true,
                minlength: 5,
                maxlength: 10,
            },

            date_of_birth: {
                required: true,
                dob: true,
            },
        },
        messages: {
            name: {
                required: "Name is required.",
            },
            mobile: {
                required: "Mobile number is required.",
            },
            email: {
                required: "Email is required.",
            },
            captcha: {
                required: "Captcha is required.",
            },
            date_of_birth: {
                required: "Date of birth is required.",
            },
        },
        errorPlacement: function (error, element) {
            // error.appendTo(element.next(".error-message"));

            var $errorContainer = element.next(".error-message");

            // Remove any existing (server) messages, but preserve error labels
            $errorContainer
                .contents()
                .filter(function () {
                    return (
                        this.nodeType === 3 ||
                        (this.nodeType === 1 && this.tagName !== "LABEL")
                    );
                })
                .remove();

            // Append jQuery Validate error label
            error.appendTo($errorContainer);
        },
    });

    $("#registerFrm").on("submit", function (e) {
        e.preventDefault();

        const $submitBtn = $("#registerBtn");
        $submitBtn.prop("disabled", true);
        if (!$("#registerFrm").valid()) {
            $submitBtn.prop("disabled", false).find(".spinner").hide();
            return;
        }

        $(".error").text("");
        $submitBtn.find(".spinner").show();
        $submitBtn.prop("disabled", true);
        $submitBtn.find(".spinner").show();

        $.ajax({
            url: $(this).attr("action"),
            method: "POST",
            data: $(this).serialize(),
            success: function (response) {
                if (response.success) {
                    $("#registerFrm")[0].reset();

                    Swal.fire({
                        icon: "success",
                        title: "Success",
                        text: response.message,
                        timer: 3000, // 3 seconds
                        timerProgressBar: true, // optional progress bar
                        showConfirmButton: false, // hide OK button
                    }).then(() => {
                        window.location.href = response.redirect;
                    });
                } else {
                    Swal.fire("Error", response.message, "error");
                    $submitBtn.prop("disabled", false).find(".spinner").hide();
                }

                $(".error-message").text("");
                $submitBtn.prop("disabled", false);
                $("#email").prop("readonly", false);
                $("#mobile").prop("readonly", false);
            },

            error: function (xhr) {
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    for (let field in errors) {
                        $("#error-" + field).text(errors[field][0]);
                    }

                } else {
                    Swal.fire("Error", "Something went wrong. Please try again.", "error");
                    return false;
                }
                // Call captcha refresh programmatically
                refreshCaptcha();

                $submitBtn.prop("disabled", false).find(".spinner").hide();
                //console.log(xhr);
            },
        });
    });

    // Optional: trigger form submit from the button
    $("#registerBtn").click(function () {
        $("#registerFrm").submit();
    });
});

const checkbox = document.getElementById("checkAppln");
const inputBox = document.getElementById("application_id");
$(document).on("click", "#checkAppln", function () {
    if (checkbox.checked) {
        $("#application_id").show();
    } else {
        $("#application_id").hide();
        $("#application_id_err").text("");
        inputBox.style.display = "none";
    }
});

function isEmail(email) {
    const validateEmail = (email) => {
        return String(email)
            .toLowerCase()
            .match(
                /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
            );
    };

    return validateEmail(email) !== null;
}

$(document).ready(function () {
    var today = new Date();

    var eighteenYearsAgo = new Date(
        today.setFullYear(today.getFullYear() - 18)
    );

    var dd = String(eighteenYearsAgo.getDate()).padStart(2, "0");
    var mm = String(eighteenYearsAgo.getMonth() + 1).padStart(2, "0"); // Months are 0-based
    var yyyy = eighteenYearsAgo.getFullYear();

    var formattedDate = yyyy + "-" + mm + "-" + dd;

    $("#date_of_birth").attr("max", formattedDate);
});

$(document).on("change", "#email", function () {
    if ($("#authEmailOTPStatus").find("button").length > 0) {
        $("#authEmailOTPStatus").html(
            '<button type="button" class="btn btn-success btn-sm"></button>'
        );
        $(".sendEmailOTPDiv").show();
    }
});

$(document).on("change", "#mobile", function () {
    if ($("#authMobileOTPStatus").find("button").length > 0) {
        $("#authMobileOTPStatus").html(
            '<button type="button" class="btn btn-success btn-sm"></button>'
        );
        $(".sendMobOTPDiv").show();
    }
});
/*******************Sending OTP On Email ************************ */
$(document).on("click", "#send_email_otp", function (e) {
    e.preventDefault();

    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const sendOtpUrl = `${websiteUrl}/send-otp`;

    let user_email = $("#email").val().trim();

    if (!user_email) {
        Swal.fire("Warning", "Please enter email address.", "warning");
        return;
    }

    const $btn = $("#send_email_otp");
    $btn.prop("disabled", true).find(".spinner").show();
    $("#email").prop("readonly", true);

    $.post(sendOtpUrl, {
        user_email_id: user_email,
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success" || resp.status === "verify") {
                Swal.fire("Success", resp.message, "success").then(() => {
                    $(".sendEmailOTPDiv").hide();
                    $(".verifyEmailOTPDiv").show();
                    $(".resendEmailBtnDiv").show();
                    startEmailOtpTimer(resp.resend_after || 300);
                });
            } else {
                Swal.fire("Error", resp.message, "error").then(() => {
                    $(".sendEmailOTPDiv").show();
                    $(".verifyEmailOTPDiv").hide();
                    $(".resendEmailBtnDiv").hide();
                    $("#email").prop("readonly", false);
                });
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
            $("#email").prop("readonly", false);
        });
});

// ==================== VERIFY Email OTP ====================
$(document).on("click", ".verifyEmailOTPBtn", function () {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const verifyOtpUrl = `${websiteUrl}/verify-otp`;

    let user_email = $("#email").val();
    let user_email_otp = $("#email_otp").val();
    var otp_token = encodeURIComponent(window.btoa(user_email_otp));

    if (!/^\d{6}$/.test(user_email_otp)) {
        $("#email_otp").val("");
        Swal.fire("Warning", "Please enter a valid 6-digit numeric OTP.", "warning");
        return;
    }

    const $btn = $("#verifyEmailOTPBtn");
    $btn.prop("disabled", true).find(".spinner").show();

    $.post(verifyOtpUrl, {
        user_email_otp: otp_token,
        user_email_id: user_email,
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success") {
                $("#email_otp").val("");
                $(".verifyEmailOTPDiv").hide();
                $(".resendEmailBtnDiv").hide();
                $("#authEmailOTPStatus").html(
                    '<button type="button" class="alert-success">Email OTP verified successfully</button>'
                );
                Swal.fire("Success", resp.message, "success");

                refreshCaptcha();
            } else {
                $("#email_otp").val("");
                Swal.fire("Error", resp.message, "error");
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
        });
});

// ==================== RESEND Email OTP ====================
$(document).on("click", "#email-resend-otp", function (e) {
    e.preventDefault();
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const sendOtpUrl = `${websiteUrl}/send-otp`;

    let user_email = $("#email").val().trim();
    if (!user_email) {
        Swal.fire("Warning", "Please enter email address.", "warning");
        return;
    }

    const $btn = $("#email-resend-otp");
    $btn.prop("disabled", true).find(".spinner").show();

    $.post(sendOtpUrl, {
        user_email_id: user_email,
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success" || resp.status === "verify") {
                Swal.fire("Success", resp.message, "success").then(() => {
                    $(".sendEmailOTPDiv").hide();
                    $(".verifyEmailOTPDiv").show();
                    $(".resendEmailBtnDiv").show();
                    $("#email-resend-otp").hide();
                    startEmailOtpTimer(resp.resend_after || 300);
                });
            } else {
                Swal.fire("Error", resp.message, "error");
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
        });
});
/*******************End Sending OTP On Email ************************ */

/************************* Sending OTP On Mobile ************************ */
$(document).on("click", "#send_mobile_otp", function (e) {
    e.preventDefault();

    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const sendOtpUrl = `${websiteUrl}/send-otp`;

    let user_mobile = $("#mobile").val().trim();

    if (!user_mobile) {
        Swal.fire("Warning", "Please enter mobile.", "warning");
        return;
    }

    const $btn = $("#send_mobile_otp");
    $btn.prop("disabled", true).find(".spinner").show();
    $("#mobile").prop("readonly", true);

    $.post(sendOtpUrl, {
        user_mobile_id: user_mobile,
        user_mobile: user_mobile,
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success" || resp.status === "verify") {
                Swal.fire("Success", resp.message, "success").then(() => {
                    $(".sendMobileOTPDiv").hide();
                    $(".verifyMobileOTPDiv").show();
                    $(".resendMobileBtnDiv").show();

                    startOtpTimer(resp.resend_after || 300);
                });
            } else {
                Swal.fire("Error", resp.message, "error").then(() => {
                    $(".sendMobileOTPDiv").show();
                    $(".verifyMobileOTPDiv").hide();
                    $(".resendMobileBtnDiv").hide();
                    $("#mobile").prop("readonly", false);
                });
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
            $("#mobile").prop("readonly", false);
        });
});

// ==================== VERIFY OTP ====================
$(document).on("click", ".verifyMobileOTPBtn", function () {
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const verifyOtpUrl = `${websiteUrl}/verify-otp`;

    let user_mobile = $("#mobile").val().trim();
    let user_mobile_otp = $("#mobile_otp").val().trim();

    if (!/^\d{6}$/.test(user_mobile_otp)) {
        $("#mobile_otp").val("");
        Swal.fire("Warning", "Please enter a valid 6-digit numeric OTP.", "warning");
        return;
    }

    const $btn = $("#verifyMobileOTPBtn");
    $btn.prop("disabled", true).find(".spinner").show();

    $.post(verifyOtpUrl, {
        user_mobile_id: user_mobile,
        user_mobile: user_mobile,
        user_mobile_otp: btoa(user_mobile_otp), // encode OTP
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success") {
                $("#mobile_otp").val("");
                $(".verifyMobileOTPDiv").hide();
                $(".resendMobileBtnDiv").hide();
                $("#authMobileOTPStatus").html(
                    '<button type="button" class="alert-success">Mobile OTP verified successfully</button>'
                );
                Swal.fire("Success", resp.message, "success");

                refreshCaptcha();
            } else {
                $("#mobile_otp").val("");
                Swal.fire("Error", resp.message, "error");
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
        });
});

// ==================== RESEND OTP ====================
$(document).on("click", "#mobile-resend-otp", function (e) {
    e.preventDefault();
    const csrfToken = $('meta[name="csrf-token"]').attr("content");
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const sendOtpUrl = `${websiteUrl}/send-otp`;

    let user_mobile = $("#mobile").val().trim();
    if (!user_mobile) {
        Swal.fire("Warning", "Please enter mobile.", "warning");
        return;
    }

    const $btn = $("#mobile-resend-otp");
    $btn.prop("disabled", true).find(".spinner").show();

    $.post(sendOtpUrl, {
        user_mobile_id: user_mobile,
        user_mobile: user_mobile,
        _token: csrfToken,
    })
        .done((resp) => {
            $btn.prop("disabled", false).find(".spinner").hide();

            if (resp.status === "success" || resp.status === "verify") {
                Swal.fire("Success", resp.message, "success").then(() => {
                    $(".sendMobileOTPDiv").hide();
                    $(".verifyMobileOTPDiv").show();
                    $(".resendMobileBtnDiv").show();
                    $("#mobile-resend-otp").hide();

                    startOtpTimer(resp.resend_after || 300);
                });
            } else {
                Swal.fire("Error", resp.message, "error");
            }
        })
        .fail((xhr) => {
            $btn.prop("disabled", false).find(".spinner").hide();
            Swal.fire("Error", xhr.responseJSON?.message || "Something went wrong.", "error");
        });
});

// ==================== OTP TIMER HANDLER ====================
function startOtpTimer(seconds) {
    const resendButton = $("#mobile-resend-otp");
    const timerDisplay = $("#mobile-otp-timer");

    resendButton.hide();
    timerDisplay.show();

    let countdown = seconds;
    timerDisplay.text(`Resend OTP in ${countdown} seconds`);

    const timer = setInterval(() => {
        countdown--;
        timerDisplay.text(`Resend OTP in ${countdown} seconds`);

        if (countdown <= 0) {
            clearInterval(timer);
            timerDisplay.hide();
            resendButton.show();
            // Keep Verify button always visible
            $(".verifyMobileOTPBtn").hide();
        }else{
            $(".verifyMobileOTPBtn").show();
        }
    }, 1000);
}

function startEmailOtpTimer(seconds) {
    const resendButton = $("#email-resend-otp");
    const timerDisplay = $("#email-otp-timer");

    resendButton.hide();
    timerDisplay.show();

    let countdown = seconds;
    timerDisplay.text(`Resend OTP in ${countdown} seconds`);

    const timer = setInterval(() => {
        countdown--;
        timerDisplay.text(`Resend OTP in ${countdown} seconds`);

        if (countdown <= 0) {
            clearInterval(timer);
            timerDisplay.hide();
            resendButton.show();
            // Keep Verify button always visible
            $(".verifyEmailOTPBtn").hide();
        }else{
            $(".verifyEmailOTPBtn").show();
        }
    }, 1000);
}


document.addEventListener("DOMContentLoaded", function () {
    const countdownEl = document.getElementById("countdown");
    if (!countdownEl) return;

    let seconds = parseInt(countdownEl.dataset.seconds);
    const otpUrl = countdownEl.dataset.otpUrl;

    if (isNaN(seconds)) return;

    const interval = setInterval(() => {
        let minutes = Math.floor(seconds / 60);
        let sec = seconds % 60;
        countdownEl.textContent = `New OTP will be requested in ${minutes}:${sec < 10 ? "0" : ""
            }${sec}`;
        seconds--;

        if (seconds < 0) {
            clearInterval(interval);
            countdownEl.innerHTML = `<a href="${otpUrl}" class="btn btn-link p-0">Resend OTP</a>`;
        }
    }, 1000);
});
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#engagement").on("change", function () {
        var engagementId = $(this).val();
        var baseUrl = $(this).data("url"); // get URL with placeholder

        if (engagementId) {
            var ajaxUrl = baseUrl.replace(":engagementId", engagementId);

            $.ajax({
                url: ajaxUrl,
                method: "GET",
                success: function (data) {
                    $("#designation_engagement")
                        .prop("disabled", false)
                        .empty();
                    data.forEach(function (item) {
                        $("#designation_engagement").append(
                            '<option value="' +
                            item.id +
                            '">' +
                            item.designation +
                            "</option>"
                        );
                    });
                },
                error: function (error) {
                    console.error("Error fetching designations:", error);
                },
            });
        } else {
            $("#designation_engagement")
                .prop("disabled", true)
                .empty()
                .append('<option value="">Select a Designation</option>');
        }
    });
});

$(document).ready(function () {
    const $container = $("#rolesContainer");

    const listRolesUrl = $container.data("roles-url");
    $("#roleTable").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: listRolesUrl,
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // this generates the index
                },
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        order: [[1, "asc"]], // Change the order index to the correct column
    });
});

$(document).ready(function () {
    const $container = $("#permissionContainer");

    const listRouteUrl = $container.data("route-url");
    $("#permissionTable").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        pageLength: 25,
        ajax: listRouteUrl,
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1; // this generates the index
                },
                orderable: false,
                searchable: false,
            },
            {
                data: "name",
                name: "name",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        order: [[1, "asc"]], // Change the order index to the correct column
    });
});

$(document).ready(function () {
    const $container = $("#candidateContainer");

    const listRouteUrl = $container.data("route-url");
    const exportUrl = $container.data("export-url");
    let table = $("#candidateTable_data").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        pageLength: 25, // Show 50 records per page
        ajax: function (data, callback, settings) {
            // Get filter values from inputs
            var email = $("#email_filter").val();
            var mobile = $("#mobile_filter").val();
            var dob = $("#dob_filter").val();
            var gender = $("#gender_filter").val();
            var board = $("#board_filter").val();
            var experience = $("#experience_filter").val();
            var exam = $("#exam_filter").val();
            var search = $("#dt-search-0").val();

            // Send the filters along with the server-side request
            $.ajax({
                url: listRouteUrl,
                method: "GET",
                data: {
                    email: email,
                    mobile: mobile,
                    dob: dob,
                    gender: gender,
                    board: board,
                    experience: experience,
                    exam: exam,
                    search: search,
                    draw: settings.iDraw, // DataTables parameter
                    start: settings._iDisplayStart,
                    length: settings._iDisplayLength,
                },
                success: function (response) {
                    callback({
                        draw: response.draw,
                        recordsTotal: response.recordsTotal,
                        recordsFiltered: response.recordsFiltered,
                        data: response.data,
                    });
                },
            });
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false,
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
                data: "mobile",
                name: "mobile",
            },
            {
                data: "date_of_birth",
                name: "date_of_birth",
            },
            {
                data: "status",
                name: "status",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        order: [[1, "asc"]],
    });

    // Optionally, you can listen to individual input changes to filter on-the-fly (if required)
    $("#email_filter").keyup(function () {
        table.column(3).search(this.value).draw(); // Filter by email column (index 3)
    });

    $("#mobile_filter").keyup(function () {
        table.column(4).search(this.value).draw(); // Filter by mobile column (index 4)
    });

    $("#dob_filter").keyup(function () {
        table.column(5).search(this.value).draw(); // Filter by department column (index 5)
    });

    $("#gender_filter").change(function () {
        table.column(1).search(this.value).draw(); // Filter by department column (index 5)
    });

    $("#board_filter").change(function () {
        table.column(1).search(this.value).draw();
    });

    $("#experience_filter").change(function () {
        table.column(1).search(this.value).draw();
    });

    $("#exam_filter").change(function () {
        table.column(1).search(this.value).draw();
    });

    $("#dt-search-0").keyup(function () {
        table.search(this.value).draw();
    });

    window.exportFilteredData = function () {
        window.location.href = exportUrl;
    };
});

$(document).ready(function () {
    const $container = $("#usersContainer");

    const listRouteUrl = $container.data("route-url");
    let table = $("#usersTable_data").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        pageLength: 25, // Show 50 records per page
        ajax: function (data, callback, settings) {
            // Get filter values from inputs
            var email = $("#email_filter").val();
            var mobile = $("#mobile_filter").val();
            var department = $("#department_filter").val();
            var role = $("#role_filter").val();
            var search = $("#dt-search-0").val();

            // Send the filters along with the server-side request
            $.ajax({
                url: listRouteUrl,
                method: "GET",
                data: {
                    email: email,
                    mobile: mobile,
                    department: department,
                    role: role,
                    search: search,
                    draw: settings.iDraw, // DataTables parameter
                    start: settings._iDisplayStart,
                    length: settings._iDisplayLength,
                },
                success: function (response) {
                    callback({
                        draw: response.draw,
                        recordsTotal: response.recordsTotal,
                        recordsFiltered: response.recordsFiltered,
                        data: response.data,
                    });
                },
            });
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false,
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
                data: "mobile",
                name: "mobile",
            },
            {
                data: "department_master_id",
                name: "department_master_id",
            },
            {
                data: "roles",
                name: "roles",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
        order: [[1, "asc"]],
    });

    // Optionally, you can listen to individual input changes to filter on-the-fly (if required)
    $("#email_filter").keyup(function () {
        table.column(3).search(this.value).draw(); // Filter by email column (index 3)
    });

    $("#mobile_filter").keyup(function () {
        table.column(4).search(this.value).draw(); // Filter by mobile column (index 4)
    });

    $("#department_filter").change(function () {
        table.column(5).search(this.value).draw(); // Filter by department column (index 5)
    });

    $("#role_filter").change(function () {
        table.column(6).search(this.value).draw(); // Filter by role column (index 6)
    });
    $("#dt-search-0").keyup(function () {
        table.search(this.value).draw();
    });
});

$(document).ready(function () {
    const $container = $("#adsContainer");
    const listDataUrl = $container.data("table-url");

    $("#post_list").DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"],
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        pageLength: 25,

        // 👇 Log full response here
        ajax: {
            url: listDataUrl,
            type: 'GET',
            dataSrc: function (json) {
                return json.data; // DataTables expects `data` array
            }
        },
        columns: [
            {
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false,
            },
            {
                data: "post_name",
                name: "post_name",
            },
            {
                data: "created_at",
                name: "created_at",
            },
            {
                data: "created_by",
                name: "created_by",
            },
            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],

        order: [[1, "desc"]],
    });
});


$(document).ready(function () {
    // Allow only safe characters (no HTML/script tags)
    const htmlTagPattern = /^[^<>]*$/;

    // Set max DOB as 18 years ago
    const today = new Date();
    const eighteenYearsAgo = new Date(
        today.getFullYear() - 18,
        today.getMonth(),
        today.getDate()
    );
    const formattedDate = eighteenYearsAgo.toISOString().split("T")[0];
    $("#date_of_birth").attr("max", formattedDate);

    function isEmail(email) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(email);
    }

    function validateField(
        id,
        name,
        minLength = 1,
        maxLength = null,
        options = {}
    ) {
        const rawValue = $(id).val();
        const trimmedValue = rawValue.trim();
        const errorEl = $(id + "_err");
        errorEl.text("");

        if (rawValue !== trimmedValue) {
            errorEl.text(`${name} should not start or end with spaces`);
            return false;
        }

        if (trimmedValue === "") {
            errorEl.text(`${name} field is required`);
            return false;
        }

        if (!htmlTagPattern.test(trimmedValue)) {
            errorEl.text(`${name} should not contain HTML or script tags`);
            return false;
        }

        if (minLength && trimmedValue.length < minLength) {
            errorEl.text(`${name} should be at least ${minLength} characters`);
            return false;
        }

        if (maxLength && trimmedValue.length > maxLength) {
            errorEl.text(`${name} should not exceed ${maxLength} characters`);
            return false;
        }

        if (options.numeric && isNaN(trimmedValue)) {
            errorEl.text(`${name} must be numeric`);
            return false;
        }

        if (options.email && !isEmail(trimmedValue)) {
            errorEl.text(`Invalid ${name.toLowerCase()}`);
            return false;
        }

        if (options.lengthRange) {
            const [min, max] = options.lengthRange;
            if (trimmedValue.length < min || trimmedValue.length > max) {
                errorEl.text(
                    `${name} should be between ${min} to ${max} digits`
                );
                return false;
            }
        }

        return true;
    }

    $("#creteUserButton").on("click", function () {
        let isValid = true;

        isValid &= validateField("#full_name", "Full name", 2, 50);
        isValid &= validateField("#email", "Email", 1, 100, { email: true });
        isValid &= validateField("#mobile_no", "Mobile number", 7, 15, {
            numeric: true,
            lengthRange: [7, 15],
        });
        isValid &= validateField("#status", "Status");
        isValid &= validateField("#date_of_birth", "Date of birth");
        isValid &= validateField("#ref_designation_id", "Designation");
        isValid &= validateField("#ref_department_id", "Department");
        isValid &= validateField("#address", "Address");
        isValid &= validateField("#ref_office_type_id", "Office type");
        isValid &= validateField("#date_of_joining", "Date of joining");
        isValid &= validateField("#currently_posted", "Currently posted");

        if (!isValid) {
            $("#defaultOpen").focus(); // Optional: focus a tab or section
            return false;
        }

        $("#createUserFrm").submit();
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("interviewChart");
    if (!canvas) return;

    const chartData = JSON.parse(canvas.getAttribute("data-chart"));

    const ctx = canvas.getContext("2d");
    new Chart(ctx, {
        type: "doughnut",
        data: {
            labels: ["Shortlisted", "Selected", "Rejected"],
            datasets: [
                {
                    label: "Total Applicant",
                    data: [
                        chartData.Shortlisted || 0,
                        chartData.Selected || 0,
                        chartData.Rejected || 0,
                    ],
                    backgroundColor: ["#4CAF50", "#FFC107", "#F44336"],
                    borderWidth: 1,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: "bottom",
                },
            },
        },
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const canvas = document.getElementById("distributionChart");
    if (!canvas) return;
    if (typeof window.distributionData === "undefined") {
        console.error("No distribution data found");
        return;
    }

    const distribution = window.distributionData;
    const labels = distribution.map(item => `${item.gender} - ${item.category}`);
    const data = distribution.map(item => item.total);
    const ctx = document.getElementById('distributionChart').getContext('2d');
    new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data,
                backgroundColor: [
                    '#000000', '#36A2EB', '#FF6384', '#FFCE56',
                    '#4BC0C0', '#9966FF', '#ff4040ff',
                    '#047c22ff', '#f56302ff'
                ],
                borderWidth: 1,
            }]
        },
        options: {
            responsive: false,   // disable auto-resize
            maintainAspectRatio: false
        }
    });
});


$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content')
    $(document).on("click", "#submitAdvertisementButton", function () {
        let advertisement_title = $("#advertisement_title").val();
        let note_instruction = $("#note_instruction").val();
        let advertisement_file = $("#advertisement_file").val();

        let today = new Date();
        let as_on_date = new Date($("#as_on_date").val());
        let start_datetime = new Date($("#start_datetime").val());
        let expiry_datetime = new Date($("#expiry_datetime").val());

        $(".advertisement_title_err").text("");
        $(".as_on_date_err").text("");
        $(".start_datetime_err").text("");
        $(".expiry_datetime_err").text("");
        $(".advertisement_file_err").text("");
        $(".note_instruction_err").text("");

        $err = 0;
        if (advertisement_title == "") {
            $(".advertisement_title_err").text("Advertisement title field is required.");
            $err = 1;
        }
        if (note_instruction.length > 255) {
            $(".note_instruction_err").text("Note cannot exceed 255 characters.");
            $err = 1;
        }
        if (!as_on_date || isNaN(new Date(as_on_date).getTime())) {
            $(".as_on_date_err").text("Please select a valid date.");
            $err = 1;
        }
        if (!start_datetime || isNaN(new Date(start_datetime).getTime())) {
            $(".start_datetime_err").text("Please select a valid date.");
            $err = 1;
        }
        if (!expiry_datetime || isNaN(new Date(expiry_datetime).getTime())) {
            $(".expiry_datetime_err").text("Please select a valid date.");
            $err = 1;
        }
        if ((advertisement_file == "")) {
            $(".advertisement_file_err").text("Please choose advertisement file for upload");
            $err = 1;
        }

        if (start_datetime <= today) {
            $(".start_datetime_err").text('Start date time should be in the future.');
            $err = 1;
        }
        if (expiry_datetime <= today) {
            $(".expiry_datetime_err").text('Expiry date time should be in the future.');
            $err = 1;
        }

        if ($err) {
            return false;
        } else {
            $("#advertisementForm").submit();
        }

    });

    $('.advertisement_file').on('change', function () {
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
        formData.append('advertisement_file', file);
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        formData.append('_token', csrfToken);

        const finalUrl = websiteUrl ? `${websiteUrl}/recruitment-portal/advertisement/storeUpload_cover_photo` : null;
        const finalUrlOfViewFiles = websiteUrl ? `${websiteUrl}/recruitment-portal/advertisement/view/files` : null;

        $.ajax({
            url: finalUrl,
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                if (response.status == true) {
                    var fileName = encodeURIComponent(response.file_name);
                    var pathName = encodeURIComponent('uploads/recruitment/advertisement/');
                    let url = `${finalUrlOfViewFiles}?pathName=:pathName&fileName=:fileName`;
                    url = url.replace(':fileName', fileName);
                    url = url.replace(':pathName', pathName);
                    $("#advertisement_file_txt").val(url);
                    let ii = 0;

                    $this.parents('.attachment_advertisement').find('.hide_upload_photos').hide();
                    $this.parents('.attachment_advertisement').find('input[type="file"]').prop('required', false);
                    $this.parents('.attachment_advertisement').siblings('.attachment_advertisement').show();
                    $('.attachment_advertisement').append('<div id="temp_12' + ii + '" ><a target="_blank" href="' + url + '" class="bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-80 report_preview_support_photo">View Document</a>&nbsp<a href="javascript:void(0);" class="focus:outline-none bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 report_remove_photos" data-id="' + ii++ + '" data-name="' + response.file_name + '">Remove</a>&nbsp&nbsp&nbsp&nbsp');
                    $("#upload_file").val(response.file_name);
                } else {
                    Swal.fire('Info', "" + response.message + "", 'info');
                    $this.val("");
                    return false;
                }
            },
            error: function (xhr, status, error) {
                console.error("Error occurred: " + status + " " + error);
            }
        });
    });
    $(document).on('click', '.report_remove_photos', function () {
        var $this = $(this);
        var id = $(this).attr("data-id");
        $this.parents('.attachment_advertisement').find('.hide_upload_photos').show();
        $this.parents('#temp_12' + id).hide();
        $("#advertisement_file_txt").val('');
        $("#advertisement_file").val('');
    });
});

function confirmDelete(id) {
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
            document.getElementById("delete-form-" + id).submit();
        }
    });
}

function confirmSwalOld(id, message, actionType = 'update') {
    // Find the form
    let form = document.getElementById("update-form-" + id);

    // Validate required checkboxes manually
    let requiredCheckboxes = form.querySelectorAll("input[type='checkbox'][required]");
    let allChecked = true;
    let missing = [];

    requiredCheckboxes.forEach(cb => {
        if (!cb.checked) {
            allChecked = false;
            missing.push(cb.name); // optional: keep names for debugging
        }
    });

    if (!allChecked) {
        Swal.fire({
            title: "Missing Declaration",
            text: "Please check all required declaration checkboxes before proceeding.",
            icon: "error",
            confirmButtonColor: "#d33",
        });
        return; // stop here
    }

    // Define action-specific settings
    const settings = {
        update: {
            title: 'Are you sure?',
            confirmText: 'Yes, update it!',
            confirmColor: '#3085d6',
            icon: 'warning'
        },
        submit: {
            title: 'Ready to submit?',
            confirmText: 'Yes, submit it!',
            confirmColor: '#28a745',
            icon: 'info'
        }
    };

    let opts = settings[actionType] || settings.update;

    Swal.fire({
        title: opts.title,
        text: message,
        icon: opts.icon,
        showCancelButton: true,
        confirmButtonColor: opts.confirmColor,
        cancelButtonColor: '#d33',
        confirmButtonText: opts.confirmText
    }).then((result) => {
        if (result.isConfirmed) {
            form.submit();
        }
    });
}

function confirmSwal(id, message, actionType = 'update') {
    // Find the form
    let form = document.getElementById("draftDataForm");

    // Validate required checkboxes manually
    let requiredCheckboxes = form.querySelectorAll("input[type='checkbox'][required]");
    let allChecked = true;

    requiredCheckboxes.forEach(cb => {
        if (!cb.checked) {
            allChecked = false;
        }
    });

    if (!allChecked) {
        Swal.fire({
            title: "Missing Declaration",
            text: "Please check all required declaration checkboxes before proceeding.",
            icon: "error",
            confirmButtonColor: "#d33",
        });
        return; // stop here
    }

    // Define action-specific settings
    const settings = {
        update: {
            title: 'Are you sure?',
            confirmText: 'Yes, update it!',
            confirmColor: '#3085d6',
            icon: 'warning'
        },
        submit: {
            title: 'Ready to submit?',
            confirmText: 'Yes, submit it!',
            confirmColor: '#28a745',
            icon: 'info'
        }
    };

    let opts = settings[actionType] || settings.update;

    Swal.fire({
        title: opts.title,
        text: message,
        icon: opts.icon,
        showCancelButton: true,
        confirmButtonColor: opts.confirmColor,
        cancelButtonColor: '#d33',
        confirmButtonText: opts.confirmText
    }).then((result) => {
        if (result.isConfirmed) {
            // Create or update a hidden input for actiontype
            let actionInput = form.querySelector("input[name='actiontype']");
            if (!actionInput) {
                actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = 'actiontype';
                form.appendChild(actionInput);
            }
            actionInput.value = actionType; // set the value
            form.submit();
        }
    });
}


$(document).ready(function () {
    const initDataTable = (selector, ajaxUrl, columns) => {
        if ($(selector).length && typeof ajaxUrl !== 'undefined') {
            // Destroy existing DataTable if initialized
            if ($.fn.DataTable.isDataTable(selector)) {
                $(selector).DataTable().clear().destroy();
            }
            $(selector).DataTable({
                processing: true,
                serverSide: true,
                ajax: {
                    url: ajaxUrl,
                    data: function (d) {
                        d.user_id = $('#user_id').val();
                        d.start_date = $('#start_date').val();
                        d.end_date = $('#end_date').val();
                        d.postId = $('#postId').val();
                        d.filter_advertisement = $('#filter_advertisement').val();
                        d.filter_year = $('#filter_year').val();
                    }
                },
                columns: columns,
                order: [[6, 'desc']]
            });
        }
    };

    // Attendance Table Columns
    const loginHistoryColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'users', name: 'users' },
        { data: 'browser', name: 'browser' },
        { data: 'platform', name: 'platform' },
        { data: 'activity', name: 'activity' },
        { data: 'ip_address', name: 'ip_address' },
        { data: 'created_at', name: 'created_at' },
    ];

    // Attendance Table Columns
    const externalEmpTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'mobile', name: 'mobile' },
        { data: 'designation_master', name: 'designation_master' },
        { data: 'department_master', name: 'department_master' },
        { data: 'posting_master', name: 'posting_master' },
        { data: 'address', name: 'address' },
        { data: 'status_master', name: 'status_master' },
        { data: 'action', name: 'action' },
    ];

    // Stakeholder Internal employee Table Columns
    const internalEmpTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'mobile', name: 'mobile' },
        { data: 'designation_master', name: 'designation_master' },
        { data: 'department_master', name: 'department_master' },
        { data: 'posting_master', name: 'posting_master' },
        { data: 'office_master', name: 'office_master' },
        { data: 'address', name: 'address' },
    ];

    // Stakeholder External employee Table Columns
    const stakeholderEmpTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'name' },
        { data: 'email', name: 'email' },
        { data: 'mobile', name: 'mobile' },
        { data: 'designation_master', name: 'designation_master' },
        { data: 'department_master', name: 'department_master' },
        { data: 'posting_master', name: 'posting_master' },
        { data: 'address', name: 'address' },
        { data: 'status_master', name: 'status_master' },
    ];

    // Hr dashboard recruitment applicant data Table Columns
    const applicationDataTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'name', name: 'users.name' },
        { data: 'email', name: 'users.email' },
        { data: 'mobile', name: 'users.mobile' },
        { data: 'designation_master', name: 'designation_master' },
        { data: 'department_master', name: 'department_master' },
        { data: 'posting_master', name: 'posting_master' },
        { data: 'status_master', name: 'status_master' },
    ];

    // Hr Advertisement post data Table Columns
    const advertisementPostDataTableColumns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, className: 'text-center' },
        { data: 'post_name', name: 'post_name' },
        { data: 'createdate', name: 'createdate' },
        { data: 'createdby', name: 'createdby' },
        { data: 'action', name: 'action' },
    ];

    if (typeof loginHistoryUrl !== 'undefined') {
        initDataTable('#loginHistoryTable', loginHistoryUrl, loginHistoryColumns);
    }

    if (typeof externalEmpDataUrl !== 'undefined') {
        initDataTable('#externalEmpTableData', externalEmpDataUrl, externalEmpTableColumns);
    }

    if (typeof stakeholderEmpDataUrl !== 'undefined') {
        initDataTable('#stakeholderEmpTableData', stakeholderEmpDataUrl, stakeholderEmpTableColumns);
    }

    if (typeof stakeholderInternalEmpUrl !== 'undefined') {
        initDataTable('#internalEmpTableData', stakeholderInternalEmpUrl, internalEmpTableColumns);
    }

    if (typeof applicationDataUrl !== 'undefined') {
        let applicantTable = initDataTable(
            '#applicantDataTable',
            applicationDataUrl,
            applicationDataTableColumns,
            function(d) {
                d.postId = $('#postId').val(); // add postId dynamically
            }
        );
        // initDataTable('#applicantDataTable', applicationDataUrl, applicationDataTableColumns, function(d) {
        //     d.postId = $('#postId').val(); // pass postId in request
        // });
    }

    if (typeof advertismentPostDataUrl !== 'undefined') {
        let advertisementPostDataTable = initDataTable(
            '#advertisementPostDataTable',
            advertismentPostDataUrl,
            advertisementPostDataTableColumns,
            function(d) {
                d.filter_advertisement = $('#filter_advertisement').val(); // add postId dynamically
            }
        );
    }

    // if (typeof advertismentPostDataUrl !== 'undefined') {
    //     initDataTable('#advertisementPostDataTable', advertismentPostDataUrl, advertisementPostDataTableColumns);
    // }

    $('#filter_advertisement').on('change', function () {
        $('#advertisementPostDataTable').DataTable().ajax.reload();
    });

    $('#postId').on('change', function () {
         $('#applicantDataTable').DataTable().ajax.reload();
    });

    $('#filterForm').on('change', function (e) {
        e.preventDefault(); // Prevent full page reload
        $('#loginHistoryTable').DataTable().ajax.reload(); // Reload table with filters
    });

    $('#resetFilters').on('click', function () {
        $('#user_id').val('');
        $('#start_date').val('');
        $('#end_date').val('');
        $('#loginHistoryTable').DataTable().ajax.reload();
    });

});

document.addEventListener('DOMContentLoaded', function () {
    const fields = document.querySelectorAll('input[type="text"], input[type="email"], input[type="search"], input[type="url"], textarea');
    // Define disallowed patterns
    const forbiddenPatterns = [
        /<\s*script/gi,
        /<\s*\/\s*script\s*>/gi,
        /<\s*\w+\s*.*?>/gi,     // Any HTML-like tags
        /<\?php/gi,             // PHP open tag
        /<%/gi,                 // ASP/ERB style
        /\{\{.*?\}\}/g,         // Blade/Vue style
        /<\/?\w+[^>]*>/g,       // General HTML tags
        /[#%&!~^$]/g              // Special characters disallowed
    ];

    fields.forEach(function (field) {
        field.addEventListener('input', function () {
            let value = field.value;
            let cleanValue = value;

            for (let pattern of forbiddenPatterns) {
                if (pattern.test(cleanValue)) {
                    cleanValue = cleanValue.replace(pattern, '');
                }
            }

            if (cleanValue !== value) {
                field.value = cleanValue;
                field.style.border = '2px solid red';
                showMessage(field, 'Code or script tags are not allowed!');
            } else {
                field.style.border = '';
                hideMessage(field);
            }
        });
    });

    function showMessage(field, message) {
        let msg = field.nextElementSibling;
        if (!msg || !msg.classList.contains('field-error')) {
            msg = document.createElement('div');
            msg.className = 'field-error';
            msg.style.color = 'red';
            msg.style.fontSize = '12px';
            field.parentNode.insertBefore(msg, field.nextSibling);
        }
        msg.textContent = message;
    }

    function hideMessage(field) {
        let msg = field.nextElementSibling;
        if (msg && msg.classList.contains('field-error')) {
            msg.remove();
        }
    }
});

$(document).ready(function () {
    function calculatePercentile() {
        let rank = parseFloat($("#all_india_rank").val());
        let total = parseFloat($("#number_of_candidate").val());

        if (!isNaN(rank) && !isNaN(total) && total > 0) {
            let percentile = (1 - ((rank - 1) / total)) * 100;
            $("#gate_percentile").val(percentile.toFixed(2)); // 2 decimal places
        } else {
            $("#gate_percentile").val('');
        }
    }

    // Calculate on input change
    $("#all_india_rank, #number_of_candidate").on("input", function () {
        calculatePercentile();
    });
});

document.querySelectorAll('input[name="priority_choice_first"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        let selectedStates = this.getAttribute('data-state-id');
        document.getElementById('priority_choice_first_states').value = selectedStates;
    });
});

document.querySelectorAll('input[name="priority_choice_second"]').forEach(function (radio) {
    radio.addEventListener('change', function () {
        let selectedStates = this.getAttribute('data-state-id');
        document.getElementById('priority_choice_second_states').value = selectedStates;
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const saveBtn = document.getElementById("saveGateBtn");
    if (saveBtn) {
        saveBtn.addEventListener("click", function (e) {
            let rank = parseInt(document.getElementById("all_india_rank").value);
            let total = parseInt(document.getElementById("number_of_candidate").value);

            if (rank > total) {
                e.preventDefault();
                Swal.fire('Sorry', "All India Rank cannot be greater than Total Number of Candidates", 'error');
                return false;
            }
        });
    }
});

$(document).on("click", "#saveExternalEmployee", function (e) {
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
    $("#saveExternalEmployeeForm")
    .find("input, select")
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
        $("#saveExternalEmployeeForm").submit();
    }
});

$(document).on("change", ".advertisement_filter", function () {
    let $this = $(this);
    let advertisementId = $this.val();
    const loader = document.querySelector(".loader");
    if (!advertisementId) return;
    loader.style.display = "block";
    let formData = "advertisementId=" + encodeURIComponent(advertisementId);
    const websiteUrl = document.querySelector('meta[name="website-url"]')?.getAttribute('content');
    const postUrl = `${websiteUrl}/recruitment-portal/advertisement/post/data`;

    $.ajax({
        url: postUrl,
        type: 'POST',
        data: formData,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            loader.style.display = "none";
            if (response.status === true && Array.isArray(response.data)) {
                let $tableBody = $('#applicantDataTable tbody');
                $tableBody.empty();
                if (response.data.length === 0) {
                    $tableBody.append('<tr><td colspan="7">No data found</td></tr>');
                } else {
                    response.data.forEach(function(post, index) {
                        $tableBody.append(
                            `<tr>
                                <td>${index + 1}</td>
                                <td>${post.post_name ?? '-'}</td>
                                <td>Permanent</td>
                                <td>${post.total_vacancy ?? 0}</td>
                                <td>${post.last_datetime ?? '0000-00-00 00:00'}</td>
                                <td>${post.applied_count ?? 0}</td>
                            </tr>`
                        );
                    });
                }
            } else {
                Swal.fire('Info', response.message || 'Something went wrong', 'info');
            }
        },
        error: function(xhr, status, error) {
            loader.style.display = "none";
            console.error("Error occurred: " + status + " " + error);
        }
    });
});

$(document).on("click", "#photosDown", function () {
    const loader = document.querySelector(".loader");
    loader.style.display = "block";

    // hide after 4 seconds (4000 ms)
    setTimeout(() => {
        loader.style.display = "none";
    }, 4000);
});

function togglePassword() {
    const passwordInput = document.getElementById("password");
    const eyeIcon = document.getElementById("eyeIcon");
    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.477 0-8.268-2.943-9.542-7a9.978
                          9.978 0 012.682-4.284m3.3-2.158A9.956 9.956 0 0112 5c4.477 0 8.268 2.943 9.542 7a9.978 9.978 0 01-4.132 5.225M15 12a3 3 0 11-6 0 3 3 0 016 0z" />`;
    } else {
        passwordInput.type = "password";
        eyeIcon.innerHTML = `<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.477 0 8.268 2.943 9.542 7-1.274 4.057-5.065 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />`;
  }
}

document.addEventListener("DOMContentLoaded", function() {
    const textarea = document.getElementById("feedback_remarks");
    if(textarea){
        const charCount = document.getElementById("charCount");
        const maxLength = 1000;

        textarea.addEventListener("input", function() {
            let remaining = maxLength - textarea.value.length;
            if (remaining < 0) {
                textarea.value = textarea.value.substring(0, maxLength);
                remaining = 0;
            }
            charCount.textContent = `Maximum 1000 characters allowed. (${remaining} characters left)`;
        });
    }
});


// ==================== CAPTCHA REFRESH ====================
function refreshCaptcha() {
    const websiteUrl = $('meta[name="website-url"]').attr("content");
    const refreshCaptchaUrl = `${websiteUrl}/refresh-captcha`;

    fetch(refreshCaptchaUrl)
        .then((res) => res.json())
        .then((data) => {
            $("#captcha-image").attr("src", data.captcha + "?" + Date.now());
        })
        .catch((err) => console.error("Captcha refresh failed:", err));
}

document.addEventListener("DOMContentLoaded", function () {
    const dateInputs = document.querySelectorAll('input[type="date"], input[type="datetime-local"]');

    dateInputs.forEach(input => {
        // Prevent typing manually
        input.addEventListener('keydown', function (e) {
            e.preventDefault();
        });

        // Allow calendar popup on click/focus
        input.addEventListener('mousedown', function (e) {
            this.showPicker?.(); // modern browsers support showPicker()
        });
    });
});

$(document).ready(function() {
    $("input[name='submit_experience']").on("change", function() {
        if ($(this).val() === "1") {
            // Yes selected → show div
            $("#experience-data").slideDown();
            $("#skip-button").slideUp();
        } else {
            // No selected → hide div
            $("#skip-button").slideDown();
            $("#experience-data").slideUp();
        }
    });
});

$(document).ready(function () {
    function toggleCategoryDiv() {
        const val = $("#category").val();

        if (val == 1) { // loose comparison
            $("#category_div").slideUp();
            $("#category_confirm").prop("checked", false);
        } else {
            $("#category_div").slideDown();
        }
    }
    // Run on change
    $("#category").on("change", toggleCategoryDiv);
    // Run once on page load (in case old value is 1)
    toggleCategoryDiv();
});

$(document).ready(function () {
    function togglePwbdDiv() {
        const val = $("select[name='pwbd']").val();

        if (val === "Yes") {
            $("#pwbd_div").slideDown();
        } else {
            $("#pwbd_div").slideUp();
            $("#disability_consent").prop("checked", false); // uncheck when hidden
        }
    }

    // Run on change
    $("select[name='pwbd']").on("change", togglePwbdDiv);

    // Run once on page load (in case old value is set)
    togglePwbdDiv();
});


$(document).ready(function() {
    $("select[name='ex_serviceman']").on("change", function() {
        if ($(this).val() === "1") {
            $("#ex_serviceman_div").slideDown();
        } else {
            $("#ex_serviceman_div").slideUp();
        }
    });

    // Run once on page load to set correct state
    $("select[name='ex_serviceman']").trigger("change");
});

$(document).ready(function () {
    const password = document.getElementById("new_password");
    if(password){
        password.addEventListener("input", function() {
            const val = password.value;

            // Rules
            const hasLength = val.length >= 8;
            const hasUpperLower = /(?=.*[a-z])(?=.*[A-Z])/.test(val);
            const hasNumber = /\d/.test(val);
            const hasSpecial = /[#@%!^\*\=\-\+\;\.\:]/.test(val);
            const hasSequence = /(012|123|234|345|456|567|678|789|abc|bcd|cde|def|efg|fgh|ghi|hij|ijk|jkl|klm|lmn|mno|nop|opq|pqr|qrs|rst|stu|tuv|uvw|vwx|wxy|xyz)/i.test(val);

            // Apply classes
            toggleRule("rule-length", hasLength);
            toggleRule("rule-upper-lower", hasUpperLower);
            toggleRule("rule-number", hasNumber);
            toggleRule("rule-special", hasSpecial);
            toggleRule("rule-sequence", !hasSequence);
        });
 
        function toggleRule(id, valid) {
            const el = document.getElementById(id);
            el.className = valid ? "valid" : "invalid";
            el.querySelector("span").textContent = valid ? "✅" : "❌";
        }
    }
});

// (function() {
//     let devtoolsOpen = false;
//     const threshold = 160;

//     function checkDevTools() {
//         const widthThreshold = window.outerWidth - window.innerWidth > threshold;
//         const heightThreshold = window.outerHeight - window.innerHeight > threshold;

//         if (widthThreshold || heightThreshold) {
//             if (!devtoolsOpen) {
//                 devtoolsOpen = true;
//                 // Force user away from page
//                 window.location.href = "about:blank";
//             }
//         } else {
//             devtoolsOpen = false;
//         }
//     }

//     setInterval(checkDevTools, 500);

//     // Disable right-click
//     document.addEventListener('contextmenu', e => e.preventDefault());
//     // Disable keyboard shortcuts
//     document.addEventListener('keydown', e => {
//         if (
//             e.key === "F12" ||
//             (e.ctrlKey && e.shiftKey && ["I","C","J"].includes(e.key.toUpperCase())) ||
//             (e.ctrlKey && ["U","S"].includes(e.key.toUpperCase()))
//         ) {
//             e.preventDefault();
//         }
//     });
// })();