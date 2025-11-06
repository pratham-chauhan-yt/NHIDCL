<script>
function confirmDelete(id, formPrefix = 'delete-form-') {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: "Cancel",
        confirmButtonText: "Yes, delete it!",
    }).then((result) => {
        if (result.isConfirmed) {
            const form = document.getElementById(`${formPrefix}${id}`);
            form.submit();
        }
    });
}
</script>
