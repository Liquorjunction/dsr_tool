// ===============================
// UNIVERSAL DATATABLES DARK THEME & MODERN STYLING (MATCH TOAST/SWEETALERT)
// ===============================
if (window.$?.fn?.dataTable) {
    $.extend(true, $.fn.dataTable.defaults, {
        dom: "<'row align-items-center mb-2'<'col-md-6'l><'col-md-6'f>>" +
             "<'row'<'col-12'tr>>" +
             "<'row align-items-center mt-2'<'col-md-5'i><'col-md-7'p>>",
        language: {
            search: "<span class='me-2 text-light'><i class='bi bi-search'></i></span>",
            searchPlaceholder: "Type to search...",
            lengthMenu: "Show _MENU_",
            info: "<span class='text-secondary'>Showing _START_ to _END_ of _TOTAL_ entries</span>",
            infoEmpty: "<span class='text-secondary'>No entries found</span>",
            zeroRecords: "<span class='text-danger'>No matching records found</span>",
            paginate: {
                first: "<span title='First'>&laquo;</span>",
                last: "<span title='Last'>&raquo;</span>",
                next: "<span title='Next'>&rsaquo;</span>",
                previous: "<span title='Previous'>&lsaquo;</span>"
            }
        },
        drawCallback: function() {
            var $container = $(this.api().table().container());
            // Search input
            $container.find('.dataTables_filter input')
                .addClass('datatable-search-input')
                .removeClass('form-control form-control-sm rounded-pill px-3 border-0 shadow-sm')
                .css({
                    background:'#23272f',
                    color:'#f8f9fa',
                    border:'1px solid #343a40',
                    borderRadius:'1.5rem',
                    maxWidth:'220px',
                    display:'inline-block',
                    fontWeight:'500',
                    boxShadow:'none',
                    padding:'0.5rem 1.25rem',
                });
            // Length select
            $container.find('.dataTables_length select')
                .addClass('datatable-length-select')
                .removeClass('form-select form-select-sm rounded-pill px-2 border-0 shadow-sm')
                .css({
                    background:'#23272f',
                    color:'#f8f9fa',
                    border:'1px solid #343a40',
                    borderRadius:'1.5rem',
                    width:'auto',
                    display:'inline-block',
                    fontWeight:'500',
                    boxShadow:'none',
                    padding:'0.25rem 1rem',
                });
            // Pagination
            $container.find('.dataTables_paginate')
                .addClass('datatable-pagination')
                .removeClass('pagination pagination-sm mb-0 justify-content-end')
                .css({justifyContent:'flex-end'});
            $container.find('.dataTables_paginate a, .dataTables_paginate span')
                .addClass('datatable-page-link')
                .removeClass('page-link rounded-pill border-0 mx-1')
                .css({
                    background:'#23272f',
                    color:'#f8f9fa',
                    border:'1px solid #343a40',
                    borderRadius:'1.5rem',
                    minWidth:'36px',
                    margin:'0 0.25rem',
                    fontWeight:'500',
                    boxShadow:'none',
                });
            // Info
            $container.find('.dataTables_info').addClass('small text-secondary');
        }
    });
}
// Optional: Add custom CSS for DataTable dark theme if not already present
(function(){
    if(document.getElementById('datatable-dark-style')) return;
    const style = document.createElement('style');
    style.id = 'datatable-dark-style';
    style.innerHTML = `
        .datatable-search-input::placeholder,
        .datatable-length-select option { color: #adb5bd !important; }
        .datatable-search-input,
        .datatable-length-select,
        .datatable-page-link {
            transition: background 0.2s, color 0.2s, border 0.2s;
        }
        .datatable-page-link.active, .datatable-page-link:focus, .datatable-page-link:hover {
            background: #343a40 !important;
            color: #fff !important;
            border-color: #495057 !important;
        }
        .datatable-pagination { gap: 0.25rem; }
    `;
    document.head.appendChild(style);
})();
// ===============================
// DOM READY INITIALIZATIONS
// ===============================
document.addEventListener("DOMContentLoaded", function () {

    // Select2
    if (window.$?.fn?.select2) {
        $('select.select2').select2();
    }

    // Bootstrap Toggle
    if (window.$?.fn?.bootstrapToggle) {
        $('[data-toggle="toggle"]').bootstrapToggle();
    }

});


// ===============================
// CSRF FOR AJAX (SAFE)
// ===============================
(function () {
    if (!window.$) return;

    const csrfToken =
        window.Laravel?.csrfToken ||
        document.querySelector('meta[name="csrf-token"]')?.content;

    if (csrfToken) {
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': csrfToken }
        });
    }
})();


// ===============================
// TOASTR GLOBAL CONFIG
// ===============================
if (window.toastr) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-bottom-right",
        timeOut: 3000,
        extendedTimeOut: 1000,
        showDuration: 300,
        hideDuration: 300,
        toastClass: "rounded-3 shadow-sm admin-toast",
        preventDuplicates: true,
        newestOnTop: true,
        iconClasses: {
            success: "bg-success text-light",
            error: "bg-danger text-light",
            info: "bg-info text-light",
            warning: "bg-warning text-dark"
        }
    };
}


// ===============================
// ADMIN TOAST CSS (INJECT ONCE)
// ===============================
(function () {
    if (document.getElementById('admin-toast-style')) return;

    const style = document.createElement('style');
    style.id = 'admin-toast-style';
    style.innerHTML = `
        .admin-toast {
            background: #23272f !important;
            color: #f8f9fa !important;
            border-radius: 0.75rem !important;
            min-width: 320px !important;
            padding: 1rem 1.5rem !important;
            font-size: 1.05rem !important;
        }
        .admin-toast .toast-close-button {
            color: #adb5bd !important;
        }
    `;
    document.head.appendChild(style);
})();


// ===============================
// SWEETALERT2 CONFIRM HELPER
// ===============================
window.showAdminConfirm = function (options = {}) {

    if (!window.Swal) {
        console.error('SweetAlert2 not loaded');
        return Promise.reject();
    }

    return Swal.fire({
        title: options.title ?? 'Confirm Action',
        html: options.html ?? 'Are you sure you want to continue?',
        icon: options.icon ?? 'warning',
        showCancelButton: true,
        reverseButtons: true,
        confirmButtonText: options.confirmButtonText ?? 'Yes',
        cancelButtonText: options.cancelButtonText ?? 'Cancel',
        confirmButtonColor: options.confirmButtonColor ?? '#dc3545',
        cancelButtonColor: options.cancelButtonColor ?? '#6c757d',
        background: '#23272f',
        color: '#f8f9fa',
        customClass: {
            popup: 'rounded-3',
            confirmButton: 'btn btn-danger px-4',
            cancelButton: 'btn btn-secondary px-4'
        },
        ...options.swalExtra
    });
};


// ===============================
// GLOBAL AJAX TOAST HANDLERS
// ===============================
if (window.$ && window.toastr) {

    $(document).ajaxSuccess(function (event, xhr) {
        const res = xhr.responseJSON;
        if (!res?.message) return;

        res.success
            ? toastr.success(res.message)
            : toastr.error(res.message);
    });

    $(document).ajaxError(function (event, xhr) {
        const msg =
            xhr.responseJSON?.message ||
            xhr.statusText ||
            'Something went wrong';

        toastr.error(msg);
    });

}


// ===============================
// STATUS TOGGLE HANDLER (SAFE ROLLBACK)
// ===============================
$(document).on('change', 'input[data-toggle="toggle"][data-url]', function () {

    const $toggle = $(this);
    const url = $toggle.data('url');
    const previous = !$toggle.prop('checked');

    if (!url) return;

    $toggle.prop('disabled', true);

    $.post(url, {
        id: $toggle.data('id') ?? null
    })
        .fail(() => {
            toastr.error('Update failed');
            $toggle.prop('checked', previous).bootstrapToggle('refresh');
        })
        .always(() => {
            $toggle.prop('disabled', false);
        });
});
