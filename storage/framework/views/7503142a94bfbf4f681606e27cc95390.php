<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset ('assets/img/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">

<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>


<?php $__env->startSection('title', 'Signature'); ?>
    <main class="content">
        <?php $__env->startSection('content'); ?>
            <div class="py-4">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </a>
                        </li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="h4">Signature</h1>
                    </div>
                </div>
            </div>
            <?php if(Auth::id() === 1): ?>
                <!-- Admin View -->
                <div class="card card-body border-0 shadow table-wrapper table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Form</th>
                                <th>Status</th>
                                <th>Uploaded File</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form method="POST" action="">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <td><a href="#" class="text-primary fw-bold"></a></td>
                                    <td><input type="text" name="name" class="form-control" disabled></td>
                                    <td>
                                        <select name="status" class="form-select">
                                            <option value="pending">Pending</option>
                                            <option value="accept" >Done</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="file" name="uploaded_form" class="form-control" value="">
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="" class="btn btn-info">Detail</a>
                                    </td>
                                </form>
                            </tr>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
            <!-- User View -->
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <table class="table table-centered table-nowrap mb-0 rounded">
                    <thead>
                        <tr>
                            <th class="border-0">No.</th>
                            <th class="border-0">Nama Form</th>
                            <th class="border-0">Status</th>
                            <th class="border-0">Upload File</th>
                            <th class="border-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><a href="#" class="text-primary fw-bold"></a></td>
                            <td><input type="text" name="name" class="form-control" disabled></td>
                            <td>
                                <select name="status" class="form-select" style="margin-left: 20%">
                                    <option value="pending">Pending</option>
                                    <option value="accept">Done</option>
                                </select>
                            </td>
                            <td>
                                <input type="file" name="uploaded_form" class="form-control">
                            </td>
                            <td>
                                <a href="#" class="btn btn-tertiary" style="max-width: 100%; margin-left:23%">Save</a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/signature.blade.php ENDPATH**/ ?>