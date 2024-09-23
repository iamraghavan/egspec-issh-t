<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/mdi/css/materialdesignicons.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/ti-icons/css/themify-icons.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/css/vendor.bundle.base.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css")); ?>">

        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/font-awesome/css/font-awesome.min.css")); ?>" />
        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css")); ?>">

        <link rel="stylesheet" href="<?php echo e(asset("/assets/admin-user/css/style.css")); ?>">

        <link rel="shortcut icon" href="<?php echo e(asset("/assets/admin-user/images/favicon.png")); ?>" />

        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


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
                  <img src="<?php echo e(asset('/assets/egspec-r1.png')); ?>">
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form class="pt-3" method="POST" action="<?php echo e(route('auth.admin-login')); ?>">
                    <?php echo csrf_field(); ?>
                  <div class="form-group">

                    <input type="email" class="form-control form-control-lg" id="email" placeholder="Email" name="email" required>
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                  </div>
                  <div class="form-group">

                    <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="alert alert-danger mt-2"><?php echo e($message); ?></div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <?php if($errors->has('email')): ?>
            <div class="alert alert-danger mt-3"><?php echo e($errors->first('email')); ?></div>
        <?php endif; ?>

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
    <script src="<?php echo e(asset("/assets/admin-user/vendors/js/vendor.bundle.base.js")); ?>"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo e(asset("/assets/admin-user/vendors/chart.js/chart.umd.js")); ?>"></script>
    <script src="<?php echo e(asset("/assets/admin-user/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js")); ?>"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo e(asset("/assets/admin-user/js/off-canvas.js")); ?>"></script>
    <script src="<?php echo e(asset("/assets/admin-user/js/misc.js")); ?>"></script>
    <script src="<?php echo e(asset("/assets/admin-user/js/settings.js")); ?>"></script>
    <script src="<?php echo e(asset("/assets/admin-user/js/todolist.js")); ?>"></script>
    <script src="<?php echo e(asset("/assets/admin-user/js/jquery.cookie.js")); ?>"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="<?php echo e(asset("/assets/admin-user/js/dashboard.js")); ?>"></script>
    <!-- endinject -->
  </body>
</html>


<?php /**PATH D:\laragon\laragon\www\plevents\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>