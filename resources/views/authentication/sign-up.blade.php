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
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

<!-- Sweet Alert -->
<link type="text/css" href="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}" rel="stylesheet">

<!-- Notyf -->
<link type="text/css" href="{{ asset('assets/vendor/notyf/notyf.min.css')}}" rel="stylesheet">

<!-- Volt CSS -->
<link type="text/css" href="{{ asset('assets/css/volt.css')}}" rel="stylesheet">

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
                                <h1 class="mb-0 h3">Create Account </h1>
                            </div>
                            <form method="POST" action="/register" class="mt-4">
                                @csrf
                                <!-- Form -->
                                <div class="form-group mb-4">
                                    <label for="id">Your Username</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="username" class="form-control" placeholder="Enter your username" id="username" required>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="nama">Your Name</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z"></path>
                                                <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z"></path>
                                            </svg>
                                        </span>
                                        <input type="text" name="nama" class="form-control" placeholder="Your Name" id="nama" value="{{ old('nama') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label for="department_id">Select Department</label>
                                    <select name="department_id" id="department_id" class="form-control">
                                        <option value="">-- Choose Department --</option>
                                        @foreach ($departments as $department)
                                            <option value="{{ $department->department_id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password">Your Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input type="password" name="password" placeholder="Password" class="form-control" id="password" required>
                                    </div>
                                </div>

                                <div class="form-group mb-4">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon2">
                                            <svg class="icon icon-xs text-gray-600" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd"></path>
                                            </svg>
                                        </span>
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Confirm your password">
                                    </div>
                                </div>

                                @if ($errors->any())
                                <div class="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-gray-800">Sign up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Core -->
<script src="{{ asset('assets/vendor/@popperjs/core/dist/umd/popper.min.js')}}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js')}}"></script>

<!-- Vendor JS -->
<script src="{{ asset('assets/vendor/onscreen/dist/on-screen.umd.min.js')}}"></script>

<!-- Slider -->
<script src="{{ asset('assets/vendor/nouislider/distribute/nouislider.min.js')}}"></script>

<!-- Smooth scroll -->
<script src="{{ asset('assets/vendor/smooth-scroll/dist/smooth-scroll.polyfills.min.js')}}"></script>

<!-- Charts -->
<script src="{{ asset('assets/vendor/chartist/dist/chartist.min.js')}}"></script>
<script src="{{ asset('assets/vendor/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>

<!-- Datepicker -->
<script src="{{ asset('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Sweet Alerts 2 -->
<script src="{{ asset('assets/vendor/sweetalert2/dist/sweetalert2.all.min.js')}}"></script>

<!-- Moment JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.27.0/moment.min.js"></script>

<!-- Vanilla JS Datepicker -->
<script src="{{ asset('assets/vendor/vanillajs-datepicker/dist/js/datepicker.min.js')}}"></script>

<!-- Notyf -->
<script src="{{ asset('assets/vendor/notyf/notyf.min.js')}}"></script>

<!-- Simplebar -->
<script src="{{ asset('assets/vendor/simplebar/dist/simplebar.min.js')}}"></script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>

<!-- Volt JS -->
<script src="{{ asset('assets/js/volt.js')}}"></script>

</body>

</html>
