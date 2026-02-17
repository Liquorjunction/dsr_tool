document.addEventListener('DOMContentLoaded', function() {
  if (window.$) {
    var table = document.getElementById('users-table');
    if (table) {
      var ajaxUrl = table.getAttribute('data-url') || '/users/datatable';
      var dt = $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: ajaxUrl,
        columns: [
          { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'picture', name: 'picture', orderable: false, searchable: false },
          { data: 'name', name: 'name' },
          { data: 'email', name: 'email' },
          { data: 'phone', name: 'phone' },
          { data: 'roles', name: 'roles', orderable: false, searchable: false },
          { data: 'status', name: 'status', orderable: false, searchable: false },
          { data: 'action', name: 'action', orderable: false, searchable: false },
        ]
      });

      // Re-initialize Bootstrap Toggle after each DataTable draw
      $('#users-table').on('draw.dt', function() {
        if (typeof $.fn.bootstrapToggle === 'function') {
          $('[data-toggle="toggle"]').bootstrapToggle();
        }
      });
    }
  }
});
