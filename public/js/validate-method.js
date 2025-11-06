$.validator.addMethod("lettersOnly", function (value, element) {
    return this.optional(element) || /^[a-zA-Z]+$/.test(value);
}, "Please enter letters only (A-Z or a-z)");

$.validator.addMethod("validMobile", function (value, element) {
    return parseFloat(value) > 6000000000;
}, "Please enter valid mobile number");

$.validator.addMethod("validAmount", function (value, element) {
    return !isNaN(parseFloat(value)) && isFinite(value) && value > 0;
}, "Please enter a valid amount");

$.validator.addMethod("noSpecialChars", function (value, element) {
    return this.optional(element) || /^[^<>,!@#$%^&*()"?":{}_+\\]+$/.test(value);
}, "Special characters are not allowed.");

$.validator.addMethod("fullname", function (value, element) {
    return this.optional(element) || /^[A-Za-z]+(?: [A-Za-z]+)*$/.test(value);
}, "Please enter a valid name (letters and single spaces only)");

$.validator.addMethod("noHtmlTags", function (value, element) {
    return this.optional(element) || !/<[^>]*>/g.test(value);
}, "HTML tags are not allowed.");

$.validator.addMethod("mobile", function (value, element) {
    return this.optional(element) || /^[6-9][0-9]{9}$/.test(value);
}, "Please enter a valid 10-digit mobile number.");

$.validator.addMethod("eemail", function (value, element) {
    return this.optional(element) || /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(value);
}, "Please enter a valid email address.");

$.validator.addMethod("dob", function (value, element) {
    if (!value) return false;

    const inputDate = new Date(value);

    const today = new Date();

    const eighteenYearsAgo = new Date();

    eighteenYearsAgo.setFullYear(today.getFullYear() - 18);

    return inputDate <= eighteenYearsAgo;
}, "You must be at least 18 years old.");

$.validator.addMethod("currentOrFutureDate", function (value, element) {
    if (!value) return false;

    let inputDate = new Date(value);
    let today = new Date();

    inputDate.setHours(0, 0, 0, 0);
    today.setHours(0, 0, 0, 0);

    return this.optional(element) || inputDate >= today;
}, "Please enter today or a future date.");

$.validator.addMethod("maxNumberLength", function (value, element, param) {
    if (this.optional(element)) {
        return true;
    }
    var numOnly = value.replace(/[^0-9]/g, '');
    return numOnly.length <= param;
}, "Please enter no more than {0} digits.");

