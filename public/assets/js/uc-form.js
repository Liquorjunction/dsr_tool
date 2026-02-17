// Universal Custom Form JS for .uc-wrap forms
// Password visibility toggle
(function() {
  document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.uc-pw-btn').forEach(function(btn) {
      btn.addEventListener('click', function() {
        var input = document.getElementById(this.dataset.target);
        var icon  = this.querySelector('i');
        if (input.type === 'password') {
          input.type = 'text';
          icon.classList.replace('mdi-eye-outline', 'mdi-eye-off-outline');
        } else {
          input.type = 'password';
          icon.classList.replace('mdi-eye-off-outline', 'mdi-eye-outline');
        }
      });
    });
    // Show chosen filename in the drop zone
    var fileInput = document.getElementById('profile_image');
    if (fileInput) {
      fileInput.addEventListener('change', function() {
        var el = document.getElementById('uc-chosen');
        if (this.files && this.files[0]) {
          el.textContent = '\u2713 ' + this.files[0].name;
          el.style.display = 'block';
        } else {
          el.style.display = 'none';
        }
      });
    }
  });
})();
