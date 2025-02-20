<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset ('assets/img/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">


<?php $__env->startSection('title', 'Edit KPI'); ?>
<main class="content">
<?php $__env->startSection('content'); ?>

    <div class="container">
    <h2>Edit KPI</h2>
    <form action="<?php echo e(route('check-kontrak', ['year' => $selectedYear])); ?>">
        <button class="btn btn-primary" type="submit">Back</button>
    </form>
    <br>
    <div class="row">
        <form method="POST" action="<?php echo e(route('update-kpi', ['id' => $kpi->id])); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" name="sasaran_id" value="<?php echo e($kpi->sasaran_id); ?>">

            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <a href="/form-kontrak?year=<?php echo $selectedYear?>">Back</a>
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="kpi">Key Performance Indicator</label>
                                    <input type="text" class="form-control" name="kpi_name" value="<?php echo e($kpi->kpi_name); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="target">Target</label>
                                    <input type="text" class="form-control" name="target" value="<?php echo e($kpi->target); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" value="<?php echo e($kpi->satuan); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="milestone">Milestone</label>
                                    <input type="text" class="form-control" name="milestone" value="<?php echo e($kpi->milestone); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="esgc">ESG/C</label>
                                    <select name="esgc" class="form-select" required>
                                        <option value="E" <?php echo e($kpi->esgc == 'E' ? 'selected' : ''); ?>>E</option>
                                        <option value="S" <?php echo e($kpi->esgc == 'S' ? 'selected' : ''); ?>>S</option>
                                        <option value="G" <?php echo e($kpi->esgc == 'G' ? 'selected' : ''); ?>>G</option>
                                        <option value="C" <?php echo e($kpi->esgc == 'C' ? 'selected' : ''); ?>>C</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="polaritas">Polaritas</label>
                                    <select name="polaritas" class="form-select" required>
                                        <option value="maximize" <?php echo e($kpi->polaritas == 'maximize' ? 'selected' : ''); ?>>Maximize</option>
                                        <option value="minimize" <?php echo e($kpi->polaritas == 'minimize' ? 'selected' : ''); ?>>Minimize</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" min="0" max="100" step="0.01" value="<?php echo e($kpi->bobot); ?>" required>
                                </div>
                                <div class="mb-3">
                                    <h5>Matriks Tanggung Jawab</h5>
                                    <label class="form-label">DI</label>
                                    <select name="du" class="form-select mb-2">
                                        <option value="O" <?php echo e($kpi->du == 'O' ? 'selected' : ''); ?>>O (Overall)</option>
                                        <option value="R" <?php echo e($kpi->du == 'R' ? 'selected' : ''); ?>>R (Responsible)</option>
                                        <option value="S" <?php echo e($kpi->du == 'S' ? 'selected' : ''); ?>>S (Support)</option>
                                    </select>
                                    <label class="form-label">DK&SDM</label>
                                    <select name="dk" class="form-select mb-2">
                                        <option value="O" <?php echo e($kpi->dk == 'O' ? 'selected' : ''); ?>>O (Overall)</option>
                                        <option value="R" <?php echo e($kpi->dk == 'R' ? 'selected' : ''); ?>>R (Responsible)</option>
                                        <option value="S" <?php echo e($kpi->dk == 'S' ? 'selected' : ''); ?>>S (Support)</option>
                                    </select>
                                    <label class="form-label">DO</label>
                                    <select name="do" class="form-select mb-2">
                                        <option value="O" <?php echo e($kpi->do == 'O' ? 'selected' : ''); ?>>O (Overall)</option>
                                        <option value="R" <?php echo e($kpi->do == 'R' ? 'selected' : ''); ?>>R (Responsible)</option>
                                        <option value="S" <?php echo e($kpi->do == 'S' ? 'selected' : ''); ?>>S (Support)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary" type="submit">Update KPI</button>
                </div>
            </div>
        </form>
    </div>
    </div>
</main>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-kpi.blade.php ENDPATH**/ ?>