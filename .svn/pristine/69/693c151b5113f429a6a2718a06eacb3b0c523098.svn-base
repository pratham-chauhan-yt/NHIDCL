const DataTableManager = {
    tables: {}, // to store DataTable instances

    init: function (render, columnConfigs, tableIdConfigs, ajaxUrl, urlMethod, extraDataCallback) {
        let tableId = `#${tableIdConfigs[render]}`;

        // Destroy if already initialized
        if ($.fn.DataTable.isDataTable(tableId)) {
            if (DataTableManager.tables[render]) {
                DataTableManager.tables[render].clear().destroy();
            } else {
                $(tableId).DataTable().clear().destroy(); // fallback
            }
        }

        // Init DataTable
        DataTableManager.tables[render] = $(tableId).DataTable({
            lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
            processing: true,
            serverSide: true,
            ajax: {
                url: ajaxUrl,
                type: urlMethod,
                data: function (d) {
                    d.rendering = render; // always pass which table you are rendering
                    if (typeof extraDataCallback === "function") {
                        extraDataCallback(d);
                    }
                },
            },
            language: {
                emptyTable: "<div class='text-center text-gray-600 font-semibold'>No data found.</div>"
            },
            columns: columnConfigs
        });
    },

    addActionCols: function (render, cols, tableIdMap) {
        const tableId = tableIdMap[render];
        if (!tableId) return cols;

        const $table = $(`#${tableId}`);
        const canEdit = $table.data("edit") === true || $table.data("edit") === "true";
        const canDelete = $table.data("delete") === true || $table.data("delete") === "true";

        if (canEdit || canDelete) {
            cols.push({
                data: "action",
                orderable: false,
                searchable: false
            });
        }
        return cols;
    }
}
