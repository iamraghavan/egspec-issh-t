<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/mdi/css/materialdesignicons.min.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/ti-icons/css/themify-icons.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/css/vendor.bundle.base.css") }}">
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css") }}">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css") }}" />
        <link rel="stylesheet" href="{{ asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css") }}">

        <link rel="stylesheet" href="{{ asset("/assets/admin-user/css/style.css") }}">

        <link rel="shortcut icon" href="{{ asset("/assets/admin-user/images/favicon.png") }}" />

        <meta name="csrf-token" content="{{ csrf_token() }}">


        <style>
            .brand-logo img {
    width: 25rem !important;
    height: auto; /* Maintain aspect ratio */
}

/* Styles for mobile devices */
@media (max-width: 768px) {
    .brand-logo img {
        width: 13rem !important;
        height: auto; /* Maintain aspect ratio */
    }
}
        </style>

    </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo">
                  <img src="{{asset('/assets/egspec-r1.png')}}">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="{{ route('auth.admin-login') }}">
                    @csrf
                  <div class="form-group">

                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" required>
                    @error('email')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="form-group">

                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    @error('password')
                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mt-3">
                    <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN IN</button>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> Keep me signed in </label>
                    </div>
                    <a href="#" class="auth-link text-black">Forgot password?</a>


                  </div>
                  <div class="mb-2">
                    @if ($errors->has('email'))
            <div class="alert alert-danger mt-3">{{ $errors->first('email') }}</div>
        @endif

                  </div>
                  <div class="text-center mt-4 font-weight-light"> Don't have an account? <a href="register.html" class="text-primary">Create</a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="{{ asset("/assets/admin-user/vendors/js/vendor.bundle.base.js") }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ asset("/assets/admin-user/vendors/chart.js/chart.umd.js") }}"></script>
    <script src="{{ asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js") }}"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset("/assets/admin-user/js/off-canvas.js") }}"></script>
    <script src="{{ asset("/assets/admin-user/js/misc.js") }}"></script>
    <script src="{{ asset("/assets/admin-user/js/settings.js") }}"></script>
    <script src="{{ asset("/assets/admin-user/js/todolist.js") }}"></script>
    <script src="{{ asset("/assets/admin-user/js/jquery.cookie.js") }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{ asset("/assets/admin-user/js/dashboard.js") }}"></script>
    <!-- endinject -->
  </body>
</html>

{{-- <div class="container">
    <h2>Login</h2>
    <form method="POST" action="{{ route('auth.admin-login') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email address</label>
            <input type="email" class="form-control" id="email" name="email" required>
            @error('email')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Login</button>

        @if ($errors->has('email'))
            <div class="alert alert-danger mt-3">{{ $errors->first('email') }}</div>
        @endif
    </form>

</div>
 --}}
