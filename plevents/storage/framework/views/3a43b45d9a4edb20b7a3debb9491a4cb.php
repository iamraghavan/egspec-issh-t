<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/bootstrap.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/animate.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/meanmenu.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/boxicons.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/flaticon.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/odometer.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/owl.carousel.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/owl.theme.default.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/magnific-popup.min.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/style.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/dark.css")); ?>">
        <link rel="stylesheet" href="<?php echo e(asset("/assets/css/hystmodal/hystmodal.min.css")); ?>">
		<link rel="stylesheet" href="<?php echo e(asset("/assets/css/responsive.css")); ?>">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,opsz,wght@0,6..12,200..1000;1,6..12,200..1000&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/24.3.4/css/intlTelInput.css" integrity="sha512-E/UQ6jODkpdvwzsowrc5LkTuBkC9oqDx96cUj9v9T5qke/JLFb3RA/PAvhzAA9w4rbMEHf8iR9SHPbYswqdG2Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		<title>EGSPEC Event Conference & Community</title>

        <link rel="icon" type="image/png" href="<?php echo e(asset("/assets/images/favicon.png")); ?>">
        <script src="https://accounts.google.com/gsi/client" async defer></script>

        




    </head>
    <body>




        <?php if (isset($component)) { $__componentOriginala6a6ea176e0d3ba52bc7d41e75684b5e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala6a6ea176e0d3ba52bc7d41e75684b5e = $attributes; } ?>
<?php $component = App\View\Components\GoogleSignIn::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('google-sign-in'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GoogleSignIn::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala6a6ea176e0d3ba52bc7d41e75684b5e)): ?>
<?php $attributes = $__attributesOriginala6a6ea176e0d3ba52bc7d41e75684b5e; ?>
<?php unset($__attributesOriginala6a6ea176e0d3ba52bc7d41e75684b5e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala6a6ea176e0d3ba52bc7d41e75684b5e)): ?>
<?php $component = $__componentOriginala6a6ea176e0d3ba52bc7d41e75684b5e; ?>
<?php unset($__componentOriginala6a6ea176e0d3ba52bc7d41e75684b5e); ?>
<?php endif; ?>
        <?php echo $__env->make('partials.cookie-consent', ['show_cookie_notice' => $show_cookie_notice ?? false], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>

        <?php echo $__env->yieldContent('content'); ?>

        <div class="hystmodal" id="myModal" aria-hidden="true">
            <div class="hystmodal__wrap">
                <div class="hystmodal__window" role="dialog" aria-modal="true">
                    <button class="hystmodal__close" data-hystclose>Close</button>
                    <h2 id="modalTitle">Title</h2>
                    <p id="modalMessage">Message</p>
                </div>
            </div>
        </div>


        <?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>

        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
        <script src="https://unpkg.com/micromodal/dist/micromodal.min.js"></script>

        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

        




        <script src="<?php echo e(asset("/assets/css/hystmodal/hystmodal.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/jquery.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/bootstrap.bundle.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/jquery.meanmenu.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/owl.carousel.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/jquery.appear.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/odometer.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/jquery.magnific-popup.min.js")); ?>"></script>
		<script src="<?php echo e(asset("/assets/js/jquery.ajaxchimp.min.js")); ?>"></script>
		<script src="<?php echo e(asset("/assets/js/form-validator.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/contact-form-script.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/wow.min.js")); ?>"></script>
        <script src="<?php echo e(asset("/assets/js/main.js")); ?>"></script>
        

        <script>
            async function fetchUserIP() {
            try {
                const response = await fetch('https://api.ipify.org?format=json');
                const data = await response.json();
                document.getElementById('user-ip').innerText = data.ip;
            } catch (error) {
                console.error('Error fetching IP address:', error);
                document.getElementById('user-ip').innerText = 'Unable to retrieve IP address';
            }
        }

        window.onload = fetchUserIP;
        </script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var acceptButton = document.getElementById('acceptCookies');
        if (acceptButton) {
            acceptButton.addEventListener('click', function() {
                fetch('<?php echo e(route('acceptCookieConsent')); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                        'Content-Type': 'application/json',
                    },
                }).then(function() {
                    document.getElementById('cookieConsent').style.display = 'none';
                });
            });
        }
    });
</script>
    </body>
</html>



<?php /**PATH D:\laragon\laragon\www\plevents\resources\views/layout/app.blade.php ENDPATH**/ ?>