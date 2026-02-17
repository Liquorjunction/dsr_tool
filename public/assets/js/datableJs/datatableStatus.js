// Handles status toggle AJAX for DataTable status switches
$(document).on('change', 'input[data-toggle="toggle"][data-url]', function() {
    var $checkbox = $(this);
    var url = $checkbox.data('url');
    var userId = $checkbox.data('id');
    if (!url) return;
    $checkbox.prop('disabled', true);
    var postData = {
        _token: window.Laravel && window.Laravel.csrfToken ? window.Laravel.csrfToken : $('meta[name="csrf-token"]').attr('content')
    };
    if (userId) {
        postData.id = userId;
        console.log(postData);
    }
    $.ajax({
        url: url,
        method: 'POST',
        data: postData,
        complete: function() {
            $checkbox.prop('disabled', false);
        }
    });
});
