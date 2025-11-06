$(document).ready(function () {
    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    const finalUrl = websiteUrl ? `${websiteUrl}/document-management/sharing/` : null;

    const columnConfigs = {
        "Received-Documents": [
            {
                data: null,
                name: "DT_RowIndex",
                orderable: false,
                searchable: false,
                render: (d, t, r, m) => m.row + m.settings._iDisplayStart + 1
            },
            { data: "title", name: "title" },
            { data: "remark", name: "remark" },
            { data: "share_type", name: "share_type" },
            { data: "shared_by", name: "shared_by", orderable: true, searchable: true },
            { data: "created_at", name: "created_at" },
            { data: "file", orderable: false, searchable: false }
        ]
    };

    const tableIdMap = {
        "Received-Documents": "Received-DocumentsTable"
    };

    DataTableManager.init('Received-Documents', columnConfigs['Received-Documents'], tableIdMap, finalUrl, "GET");
    $(document).on("click", ".tablink", function () {
        const render = $(this).data("page");
        DataTableManager.init(render, columnConfigs[render], tableIdMap, finalUrl, "GET");
    });
});
