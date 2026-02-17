// Handles delete action for DataTable users with SweetAlert2 confirmation
$(document).on('click', '.delete-action', function(e) {
    e.preventDefault();
    var $btn = $(this);
    var url = $btn.data('delete-url');
    var userId = $btn.data('delete-id');
    if (!url || !userId) return;

    window.showAdminConfirm({
        title: '<span class="text-danger"><i class="mdi mdi-delete fs-2 me-2"></i> Confirm Delete</span>',
        html: '<div class="fw-bold mb-2">This action will permanently delete the user.</div>' +
              '<div class="text-muted">You cannot undo this operation.</div>',
        confirmButtonText: '<i class="mdi mdi-check"></i> Yes, delete',
        cancelButtonText: '<i class="mdi mdi-close"></i> Cancel',
        icon: 'warning',
    }).then(function(result) {
        if (result.isConfirmed) {
            $btn.prop('disabled', true);
            $.ajax({
                url: url,
                method: 'DELETE',
                data: {
                    id: userId,
                    _token: window.Laravel && window.Laravel.csrfToken ? window.Laravel.csrfToken : $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message || 'User deleted successfully.');
                        // Optionally refresh DataTable
                        if (window.userDataTable) {
                            window.userDataTable.ajax.reload(null, false);
                        } else {
                            location.reload();
                        }
                    } else {
                        toastr.error(response.message || 'Failed to delete user.');
                    }
                },
                error: function(xhr) {
                    let msg = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred.';
                    toastr.error(msg);
                },
                complete: function() {
                    $btn.prop('disabled', false);
                }
            });
        }
    });
});
