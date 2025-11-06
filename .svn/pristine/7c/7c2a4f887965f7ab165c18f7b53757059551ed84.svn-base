<script>
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function handleFormToggle(formContainerId, formId, isEdit = false, id = null, options = {}) {
    const { updateUrl, editUrl, storeUrl, fieldMap, methodField = '#method', submitBtn = '#submitButton', idField = null } = options;

    $(`#${formContainerId}`).slideDown(400);
    $(`#${formId}`)[0].reset();

    if (isEdit) {
        $(methodField).val('PUT');
        $(submitBtn).text('Update');
        if (idField) $(`#${idField}`).val(id);
        $(`#${formId}`).attr('action', updateUrl.replace(':id', id));
        $.get(editUrl.replace(':id', id), function(data) {
            for (const [field, value] of Object.entries(fieldMap)) {
                $(`#${field}`).val(data[value]);
            }
        });
    } else {
        $(methodField).val('POST');
        $(submitBtn).text('Create');
        $(`#${formId}`).attr('action', storeUrl);
    }
}

function handleFormSubmit(formId, tableSelector, formContainerId) {
    $(`#${formId}`).submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        const actionUrl = $(this).attr('action');
        const method = $(this).find('[name="_method"]').val() || 'POST';

        $.ajax({
            url: actionUrl,
            method: method,
            data: formData,
            success: function(response) {
                Swal.fire('Success!', response.message, 'success');
                $(tableSelector).DataTable().ajax.reload();
                $(`#${formContainerId}`).slideUp(400);
            },
            error: function(xhr) {
                Swal.fire('Error', 'There was an issue saving the data.', 'error');
            }
        });
    });
}
</script>
