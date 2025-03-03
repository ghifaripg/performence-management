<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
?>



<main class="content">
<?php $__env->startSection('content'); ?>
<div class="container">
    <h2 class="mb-4">Edit Evaluasi</h2>

    <?php if(session('success')): ?>
        <div class="alert alert-success"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <form action="<?php echo e(route('evaluasi.update', $eval->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="row">
            <!-- Left Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="iku_name" class="form-label">IKU Name</label>
                    <input type="text" class="form-control" id="iku_name" name="iku_name" value="<?php echo e($eval->iku_name); ?>" required>
                </div>
                <div class="mb-3">
                    <label for="polaritas" class="form-label">Polaritas</label>
                    <input type="text" class="form-control" id="polaritas" name="polaritas" value="<?php echo e($eval->polaritas); ?>">
                </div>
                <div class="mb-3">
                    <label for="bobot" class="form-label">Bobot</label>
                    <input type="text" step="0.01" class="form-control" id="bobot" name="bobot" value="<?php echo e($eval->bobot); ?>">
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo e($eval->satuan); ?>">
                </div>
                <div class="mb-3">
                    <label for="base" class="form-label">Base</label>
                    <input type="text" step="0.01" class="form-control" id="base" name="base" value="<?php echo e($eval->base); ?>">
                </div>
                <div class="mb-3">
                    <label for="target_bulan_ini" class="form-label">Target Bulan Ini</label>
                    <input type="text" step="0.01" class="form-control" id="target_bulan_ini" name="target_bulan_ini" value="<?php echo e($eval->target_bulan_ini); ?>">
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="realisasi_bulan_ini" class="form-label">Realisasi Bulan Ini</label>
                    <input type="text" step="0.01" class="form-control" id="realisasi_bulan_ini" name="realisasi_bulan_ini" value="<?php echo e($eval->realisasi_bulan_ini); ?>">
                </div>
                <div class="mb-3">
                    <label for="percent_target" class="form-label">% Target</label>
                    <input type="text" step="0.01" class="form-control" id="percent_target" name="percent_target" value="<?php echo e($eval->percent_target); ?>">
                </div>
                <div class="mb-3">
                    <label for="percent_year" class="form-label">% Year</label>
                    <input type="text" step="0.01" class="form-control" id="percent_year" name="percent_year" value="<?php echo e($eval->percent_year); ?>">
                </div>
                <div class="mb-3">
                    <label for="ttl" class="form-label">TTL</label>
                    <input type="text" step="0.01" class="form-control" id="ttl" name="ttl" value="<?php echo e($eval->ttl); ?>">
                </div>
                <div class="mb-3">
                    <label for="adj" class="form-label">Adjusted</label>
                    <input type="text" step="0.01" class="form-control" id="adj" name="adj" value="<?php echo e($eval->adj); ?>">
                </div>
                <div class="mb-3">
                    <label for="penyebab_tidak_tercapai" class="form-label">Penyebab Tidak Tercapai</label>
                    <textarea class="form-control" id="penyebab_tidak_tercapai" name="penyebab_tidak_tercapai"><?php echo e($eval->penyebab_tidak_tercapai); ?></textarea>
                </div>
            </div>
        </div>

        <!-- Full-width textarea -->
        <div class="mb-3">
            <label for="program_kerja" class="form-label">Program Kerja</label>
            <textarea class="form-control" id="program_kerja" name="program_kerja"><?php echo e($eval->program_kerja); ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="<?php echo e(route('form-evaluasi')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-evaluasi.blade.php ENDPATH**/ ?>