// Select2 Sidebar Customization
$(document).ready(function() {
    // Use the sidebar as dropdownParent for correct z-index and visibility
    $('#dsrType').select2({
        minimumResultsForSearch: Infinity,
        dropdownParent: $('#sidebar'),
        width: '100%'
    });
});
