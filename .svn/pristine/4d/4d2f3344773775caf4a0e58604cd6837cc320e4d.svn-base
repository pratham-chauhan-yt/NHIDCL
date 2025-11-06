$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/document-management/document` : null;

    const columnConfigs = {
        "Office-Order": [
            { data: null, name: 'DT_RowIndex', render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1, orderable: false, searchable: false },
            { data: "title", name: 'title' },
            { data: "file_number", name: 'file_number' },
            { data: "ref_type_id", name: 'type.type', orderable: false, searchable: false },
            { data: 'ref_department_id', name: 'department.name' },
            { data: 'issue_date', name: 'issue_date' },
            { data: 'tagged_user_name', name: 'tagged_user_name', orderable: true, searchable: true },
            { data: "file", orderable: false, searchable: false },
        ],
        "SOP": [
            { data: null, render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1, orderable: false, searchable: false },
            { data: "title", name: 'title' },
            { data: "file_number", name: 'file_number' },
            { data: "ref_department_id", name: 'department.name' },
            { data: "issue_date", name: 'issue_date' },
            { data: "file", orderable: false, searchable: false },
        ],
        "Policy": [
            { data: null, render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1, orderable: false, searchable: false },
            { data: "title", name: 'title' },
            { data: "file_number", name: 'file_number' },
            { data: "issue_date", name: 'issue_date' },
            { data: "file", orderable: false, searchable: false },
        ],
        "Circular": [
            { data: null, render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1, orderable: false, searchable: false },
            { data: "title", name: 'title' },
            { data: "file_number", name: 'file_number' },
            { data: "ref_department_id" },
            { data: "issue_date", name: 'issue_date' },
            { data: "file", orderable: false, searchable: false },
        ],
        "IS-Codes": [
            { data: null, render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1, orderable: false, searchable: false },
            { data: "title", name: 'title' },
            { data: "file_number", name: 'file_number' },
            { data: "year", name: 'passingYear.passing_year' },
            { data: "file", orderable: false, searchable: false },
        ]
    };

    const tableIdConfigs = {
        "Office-Order": "Office-OrderTable",
        "SOP": "SOPTable",
        "Policy": "PolicyTable",
        "Circular": "CircularTable",
        "IS-Codes": "IS-CodesTable"
    };

    // Init default table
    DataTableManager.init(
        "Office-Order",
        DataTableManager.addActionCols("Office-Order", [...columnConfigs["Office-Order"]], tableIdConfigs),
        tableIdConfigs,
        finalUrl,
        "GET"
    );

    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");
        DataTableManager.init(
            render,
            DataTableManager.addActionCols(render, [...columnConfigs[render]], tableIdConfigs),
            tableIdConfigs,
            finalUrl,
            "GET"
        );
    });
});
