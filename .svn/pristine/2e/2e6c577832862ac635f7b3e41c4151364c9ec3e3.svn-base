$(document).ready(function() {

    function getEncryptedUserIdFromUrl() {
        const urlParts = window.location.pathname.split('/');
        return urlParts[urlParts.length - 1];
    }

    const websiteMeta = document.querySelector('meta[name="website-url"]');
    const websiteUrl = websiteMeta?.getAttribute('content');
    let finalUrl = websiteUrl ? `${websiteUrl}/resource-pool/user/view/details/${getEncryptedUserIdFromUrl()}` : null;

    $('#selectionHistory').DataTable({
        lengthMenu: [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: finalUrl,
            type: "GET",
        },
        language: {
            emptyTable: "<div class='text-center text-gray-600 font-semibold'>No data found.</div>"
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'requisition_id', name: 'requisition_id' },
            { data: 'committee_status', name: 'committee_status' },
            { data: 'committee_remark', name: 'committee_remark' },
            { data: 'chairperson_status', name: 'chairperson_status' },
            { data: 'chairperson_remark', name: 'chairperson_remark' },
            { data: 'final_shortlist_status', name: 'final_shortlist_status' },
            { data: 'final_shortlist_remark', name: 'final_shortlist_remark' },
        ],
        drawCallback: function(settings) {
            $('#selectionHistory tbody td').addClass('border border-gray-200 px-4 py-2 text-sm');
        }
    });
});
