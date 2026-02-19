// Ensure the sidebar toggler in the navbar works regardless of data attribute
$(document).ready(function() {
  $(".navbar-toggler[data-bs-toggle='minimize']").on('click', function() {
    $('.sidebar-offcanvas').toggleClass('active');
  });
});
