<!DOCTYPE html>
<html lang="en">

<head>
    <?php echo $__env->make('partials.favicon', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title><?php echo $__env->yieldContent('title', 'Dashboard'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Sweet Alert -->
<link type="text/css" href="<?php echo e(asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')); ?>" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="<?php echo e(asset('assets/vendor/notyf/notyf.min.css')); ?>" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="<?php echo e(asset('assets/css/volt.css')); ?>" rel="stylesheet">

</head>

<body>
   <?php echo $__env->make('partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

   <?php echo $__env->make('partials.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Core -->
<script src="<?php echo e(asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>

<!-- Vendor JS -->
<script src="<?php echo e(asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')); ?>"></script>

<!-- Slider -->
<script src="<?php echo e(asset('assets/vendor/nouislider/distribute/nouislider.min.js')); ?>"></script>

<!-- Smooth scroll -->
<script src="<?php echo e(asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')); ?>"></script>

<!-- Charts -->
<script src="<?php echo e(asset('assets/vendor/chartist/dist/chartist.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')); ?>"></script>

<!-- Datepicker -->
<script src="<?php echo e(asset('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')); ?>"></script>

<!-- Sweet Alerts 2 -->
<script src="<?php echo e(asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')); ?>"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="<?php echo e(asset('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')); ?>"></script>

<!-- Notyf -->
<script src="<?php echo e(asset('assets/vendor/notyf/notyf.min.js')); ?>"></script>

<!-- Simplebar -->
<script src="<?php echo e(asset('assets/vendor/simplebar/dist/simplebar.min.js')); ?>"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="<?php echo e(asset('assets/js/volt.js')); ?>"></script>

</body>

</html>
<?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/layouts/app.blade.php ENDPATH**/ ?>