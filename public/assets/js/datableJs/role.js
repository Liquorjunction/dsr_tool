$(document).ready(function () {
    var table = $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: $('#roles-table').data('url'),
            type: 'GET'
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'name', name: 'name' },
            { data: 'permissions', name: 'permissions', orderable: false, searchable: false },
            { data: 'action', name: 'action', orderable: false, searchable: false }
        ],
        order: [[1, 'asc']],
        responsive: true,
        language: {
            emptyTable: 'No roles found',
            processing: 'Loading...'
        }
    });

    // Optional: handle delete confirmation
    $('#roles-table').on('submit', 'form', function (e) {
        if (!confirm('Are you sure you want to delete this role?')) {
            e.preventDefault();
        }
    });
});
