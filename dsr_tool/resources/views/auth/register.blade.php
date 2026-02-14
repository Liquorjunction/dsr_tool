<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Register | Corona Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="row w-100 m-0">
          <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
              <div class="card-body px-5 py-5">
                <h3 class="card-title text-left mb-3">Register</h3>

                <form method="POST" action="{{ route('register') }}">
                  @csrf
                  <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="name" class="form-control p_input" required>
                  </div>
                  <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control p_input" required>
                  </div>
                  <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control p_input" required>
                  </div>
                  <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control p_input" required>
                  </div>
                  <div class="form-group d-flex align-items-center justify-content-between">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input type="checkbox" class="form-check-input"> I agree to the terms
                      </label>
                    </div>
                  </div>
                  <div class="text-center d-grid gap-2">
                    <button type="submit" class="btn btn-primary btn-block enter-btn">Sign Up</button>
                  </div>
                  <div class="d-flex">
                    <button type="button" class="btn btn-facebook col me-2">
                      <i class="mdi mdi-facebook"></i> Facebook
                    </button>
                    <button type="button" class="btn btn-google col">
                      <i class="mdi mdi-google-plus"></i> Google plus
                    </button>
                  </div>
                  <p class="sign-up text-center">Already have an Account?<a href="{{ route('login') }}"> Login</a></p>
                </form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{ asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/misc.js') }}"></script>
  </body>
</html>
