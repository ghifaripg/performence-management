<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
?>

<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset ('assets/img/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">
<?php $__env->startSection('title', 'Detail'); ?>

<?php $__env->startSection('content'); ?>
<style>
    body{
        overflow-x: hidden;
    }
</style>
<main class="content">
    <div class="py-4">
        <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
            <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                <li class="breadcrumb-item">
                    <a href="/dashboard">
                        <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                    </a>
                </li>
                <li class="breadcrumb-item"><a href="/progres"> Progres</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Form</li>
            </ol>
        </nav>
    </div>

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th rowspan="2">#</th>
                    <th rowspan="2">Perspektif</th>
                    <th colspan="2">Key Address</th>
                    <th rowspan="2">Indikator Kerja Utama</th>
                    <th colspan="2">Target</th>
                    <th rowspan="2">Satuan</th>
                    <th rowspan="2">Polaritas</th>
                    <th rowspan="2">Bobot</th>
                    <th rowspan="2">Program Kerja</th>
                    <th rowspan="2">Penanggung Jawab</th>
                </tr>
                <tr>
                    <th>IKU Atasan</th>
                    <th>Target</th>
                    <th>Base</th>
                    <th>Stretch</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sasaranGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sasaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $ikuCount = count($sasaran->ikus) ?: 1; ?>
                    <tr>
                        <td rowspan="<?php echo e($ikuCount); ?>"><?php echo e($loop->iteration); ?></td>
                        <td rowspan="<?php echo e($ikuCount); ?>"><?php echo e($sasaran->perspektif); ?></td>
                        <?php $__currentLoopData = $sasaran->ikus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><?php echo e($iku->iku_atasan); ?></td>
                            <td><?php echo e($iku->target); ?></td>
                            <td><strong><?php echo e($iku->iku); ?></strong></td>
                            <td><?php echo e($iku->base); ?></td>
                            <td><?php echo e($iku->stretch); ?></td>
                            <td><?php echo e($iku->satuan); ?></td>
                            <td><?php echo e(ucfirst($iku->polaritas)); ?></td>
                            <td><?php echo e($iku->bobot); ?></td>
                            <td><?php echo nl2br(e($iku->proker)); ?></td>
                            <td><?php echo e($iku->pj); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <div class="mt-3 mb-3">
        <a href="/progres" class="btn btn-secondary">Back</a>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/detail.blade.php ENDPATH**/ ?>