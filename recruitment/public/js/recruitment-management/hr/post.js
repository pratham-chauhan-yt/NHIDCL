$(document).ready(function () {
    $('.js-multiple').select2();

    const $gateDetail = $('#required_gate_detail');
    const $gateFields = $('#required_gate_exam_year, #required_gate_discipline');

    function toggleGateFields() {
        const isRequired = $gateDetail.val() === '1';
        $gateFields.prop('disabled', !isRequired);
    }

    toggleGateFields(); // Initial check
    $gateDetail.change(toggleGateFields); // On change
});

$(document).ready(function () {
    // Hide amount field initially
    //$("#amount_field").hide();
    $("#post_payment_type").on("change", function () {
        let selectedValue = $(this).val();        
        if (selectedValue === "Paid") {
            $("#amount_field").slideDown(300); // Smooth animation
            $("#amount").prop("required", true); // Use prop() instead of attr()
        } else {
            $("#amount_field").slideUp(300); // Smooth animation
            $("#amount").prop("required", false).val(""); // Use prop() instead of attr()
        }
    });
    $("#post_payment_type").trigger("change");
});

$(document).ready(function () {
    const $postExamDetail = $('#post_examination');
    const $gateFields = $('#required_gate_detail, #required_gate_exam_year, #required_gate_discipline');

    function toggleGateFields() {
        const isRequired = $postExamDetail.val() === 'GATE';
        $gateFields.prop('disabled', !isRequired);
    }

    toggleGateFields(); // Initial check
    $postExamDetail.change(toggleGateFields); // On change
});