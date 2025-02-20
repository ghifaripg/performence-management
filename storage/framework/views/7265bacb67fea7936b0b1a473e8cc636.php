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


<?php $__env->startSection('title', 'Dashboard'); ?>
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
                        <li class="breadcrumb-item active" aria-current="page">Progres</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                        <h1 class="h4">Progres Form Iku <?php echo $name ?></h1>
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
                                <th>Need Discussion</th>
                                <th>Meeting Date</th>
                                <th>Notes</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $progresData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $progres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <form method="POST" action="<?php echo e(route('progres.update', $progres->id)); ?>">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <td><?php echo e($progresData->firstItem() + $index); ?></td>
                                    <td><?php echo e($progres->iku_id); ?></td>
                                    <td>
                                        <select name="status" class="form-select">
                                            <option value="pending" <?php echo e($progres->status === 'pending' ? 'selected' : ''); ?>>Pending</option>
                                            <option value="accept" <?php echo e($progres->status === 'accept' ? 'selected' : ''); ?>>Accept</option>
                                            <option value="reject" <?php echo e($progres->status === 'reject' ? 'selected' : ''); ?>>Reject</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="need_discussion" class="form-select">
                                            <option value="0" <?php echo e($progres->need_discussion == 0 ? 'selected' : ''); ?>>No</option>
                                            <option value="1" <?php echo e($progres->need_discussion == 1 ? 'selected' : ''); ?>>Yes</option>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="date" name="meeting_date" class="form-control" value="<?php echo e(old('meeting_date', $progres->meeting_date)); ?>">
                                    </td>
                                    <td>
                                        <textarea name="notes" class="form-control"><?php echo e($progres->notes); ?></textarea>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn btn-primary">Save</button>
                                        <a href="<?php echo e(route('iku.detail', $progres->iku_id)); ?>" class="btn btn-info">Detail</a>
                                    </td>
                                </form>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="card-footer px-3 border-0 d-flex flex-column flex-lg-row align-items-center justify-content-between">
                        <div class="d-flex justify-content-center mt-3">
                            <?php echo e($progresData->links('pagination::bootstrap-4')); ?>

                        </div>
                    </div>
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
                                <th class="border-0">Need Discussion</th>
                                <th class="border-0">Meeting Date</th>
                                <th class="border-0">Revision</th>
                                <th class="border-0">Notes</th>
                                <th class="border-0">Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $progresData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $progres): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><a href="#" class="text-primary fw-bold"><?php echo e($index + 1); ?>.</a></td>
                                <td><?php echo e($progres->iku_id); ?></td>
                                <td><?php echo e(ucfirst($progres->status)); ?></td>
                                <td><?php echo e($progres->need_discussion ? 'Yes' : 'No'); ?></td>
                                <td><?php echo e($progres->meeting_date ? date('d/m/Y', strtotime($progres->meeting_date)) : '-'); ?></td>
                                <td>
                                    <?php if($progres->status === 'reject'): ?>
                                    <a href="/iku" class="btn btn-warning">Revise</a>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($progres->notes ?? '-'); ?></td>
                                <td>
                                    <?php if($progres->status === 'accept'): ?>
                                    <a href="#" class="btn btn-success">Download</a>
                                    <?php else: ?>
                                    -
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
            </div>
            <?php endif; ?>
    </main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/progres.blade.php ENDPATH**/ ?>