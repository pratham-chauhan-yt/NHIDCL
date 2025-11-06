<script>
function initDataTable(selector, ajaxUrl, columns, orderIndex = 1) {
    $(selector).DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        bDestroy: true,
        bFilter: true,
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
            {
                data: null,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                },
                orderable: false,
                searchable: false
            },
            ...columns,
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }
        ],
        order: [[orderIndex, 'asc']]
    });
}
</script>
