$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute("content");
    const externalStackholderUrl = websiteUrl ? `${websiteUrl}/directory-management/external/employees/create/` : null;

    const columnConfigs = {
        "External-Stakeholder": [
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
        ],

        "Contractors": [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                orderable: false, searchable: false,
                className: "text-center",
            },
            { data: "contractor_name", name: "contractor_name" },
            { data: "upc", name: "upc" },
            { data: "project_name", name: "project_name" },
            { data: "location", name: "location" },
            { data: "total_length", name: "address" },
            { data: "mode", name: "mode" },
            { data: "nh", name: "nh" },
            { data: "awarded_cost", name: "awarded_cost" },
            { data: "start_date", name: "start_date" },
            { data: "schedule_date", name: "schedule_date" },
            { data: "current_status", name: "current_status" },
            { data: "action", name: "action" },
        ],
    };

    const urlConfigs = {
        "External-Stakeholder": externalStackholderUrl,
        "Contractors": "https://pmp.nhidcl.com/api/contractors", // Replace with actual URL
    };

    const tableIdMap = {
        "External-Stakeholder": "External-StakeholderTable",
        "Contractors": "ContractorsTable",
    };

    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");
        DataTableManager.init(
            render,
            columnConfigs[render],
            tableIdMap,
            urlConfigs[render],
            "GET"
        );
    });
});
