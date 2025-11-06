$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/grievance/application` : null;

});


$(document).ready(function () {

    let formId = $('#payment-form').length ? '#payment-form' : '#payment-form';

    $(formId).validate({
        rules: {
            name: {
                required: true,
                maxlength: 50,
                noSpecialChars: true
            },
            email: {
                required: true,
                maxlength: 50,
                eemail: true
            },
            mobile: {
                required: true,
                validMobile: true
            }

        },
        messages: {

        },
        errorElement: "div",
        errorPlacement: function (error, element) {
            error.addClass('error-message');
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});










