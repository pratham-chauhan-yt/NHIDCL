$(document).ready(function () {
    $(".js-select2").select2();

    initValidation("#saveExternalEmployeeForm", {
        name: { required: true, minlength: 3 },
        email: { required: true, strictEmail: true },
        mobile: { required: true, digits: true, lengthRange: [10, 10] },
        designation: { required: true, minlength: 2 },
        department: { required: true, minlength: 2 },
        ref_state_master_id: { required: true },
        address: { required: true, minlength: 3 },
    });

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const finalUrl = websiteUrl
        ? `${websiteUrl}/directory-management/external/employees/create/`
        : null;

    const columnConfigs = {
        "External-Employee": [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false, searchable: false,
                className: "text-center",
            },
            { data: "name", name: "name" },
            { data: "email", name: "email" },
            { data: "mobile", name: "mobile" },
            { data: "designation", name: "designation" },
            { data: "department", name: "department" },
            { data: "state", name: "state.name" },
            { data: "address", name: "address" },
            { data: "is_active", name: "is_active" },
            { data: "action", name: "action", orderable: false, searchable: false },
        ],
    };

    const tableIdMap = {
        "External-Employee": "External-EmployeeTable",
    };

    DataTableManager.init(
        "External-Employee",
        columnConfigs["External-Employee"],
        tableIdMap,
        finalUrl,
        "GET"
    );
    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");
        DataTableManager.init(
            render,
            columnConfigs[render],
            tableIdMap,
            finalUrl,
            "GET"
        );
    });
});
