<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- Primary Meta Tags -->
<title>Sign Up</title>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="title" content="Volt Premium Bootstrap Dashboard - Sign in page">
<meta name="author" content="Themesberg">
<meta name="description" content="Volt Pro is a Premium Bootstrap 5 Admin Dashboard featuring over 800 components, 10+ plugins and 20 example pages using Vanilla JS.">
<meta name="keywords" content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, themesberg, themesberg dashboard, themesberg admin dashboard" />
<link rel="canonical" href="https://themesberg.com/product/admin-dashboard/volt-premium-bootstrap-5-dashboard">

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset ('assets/img/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">

<!-- Sweet Alert -->
<link type="text/css" href="<?php echo e(asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')); ?>" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="<?php echo e(asset('assets/vendor/notyf/notyf.min.css')); ?>" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="<?php echo e(asset('assets/css/volt.css')); ?>" rel="stylesheet">

</head>

<body>

    <main>

        <!-- Section -->
        <section class="vh-lg-100 mt-5 mt-lg-0 bg-soft d-flex align-items-center">
            <div class="container">
                <p class="text-center">
                    <a href="/dashboard" class="d-flex align-items-center justify-content-center" style="margin-top: 30px; margin-bottom: 30px">
                        <svg class="icon icon-xs me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd"></path></svg>
                        Back to homepage
                    </a>
                </p>
                <div class="row justify-content-center form-bg-image" style="margin-top: 10px" data-background-lg="../../assets/img/illustrations/signin.svg">
                    <div class="col-12 d-flex align-items-center justify-content-center">
                        <div class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500">
                            <div class="text-center text-md-center mb-4 mt-md-0">
                                <h1 class="mb-0 h3">Create Department </h1>
                            </div>
                            <form method="POST" action="/register-department" class="mt-4">
                                <?php echo csrf_field(); ?>
                                <!-- Department Name -->
                                <div class="form-group mb-4">
                                    <label for="department_name">Department Name</label>
                                    <input type="text" name="department_name" class="form-control" placeholder="Enter Department Name" id="department_name" required>
                                </div>

                                <!-- Department Username -->
                                <div class="form-group mb-4">
                                    <label for="department_username">Department Username</label>
                                    <input type="text" name="department_username" class="form-control" placeholder="Enter Department Username" id="department_username" required>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Create Department</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

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
<?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/authentication/register-department.blade.php ENDPATH**/ ?>