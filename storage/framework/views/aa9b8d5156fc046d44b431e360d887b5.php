<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
?>



<?php $__env->startSection('title', 'Edit IKU'); ?>

<?php $__env->startSection('content'); ?>
<main class="content">
    <div class="container">
        <h2>Edit IKU</h2>
        <a href="<?php echo e(url('/form-iku?year=' . date('Y'))); ?>" class="btn btn-secondary mb-3">Back</a>

        <form method="POST" action="<?php echo e(route('update-iku', ['id' => $iku->id])); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <input type="hidden" name="sasaran_id" value="<?php echo e($iku->sasaran_id); ?>">

            <div class="card border-0 shadow">
                <div class="card-body">
                    <div class="row">
                        <!-- Left Section -->
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">IKU Atasan</label>
                                <input type="text" name="iku_atasan" class="form-control" value="<?php echo e($iku->iku_atasan); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Target</label>
                                <input type="text" name="target" class="form-control" value="<?php echo e($iku->target); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">IKU</label>
                                <input type="text" name="iku" class="form-control" value="<?php echo e($iku->iku); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Satuan</label>
                                <input type="text" name="satuan" class="form-control" value="<?php echo e($iku->satuan); ?>">
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Polaritas</label>
                                <select name="polaritas" class="form-select">
                                    <option class="form-control" value="maximize" <?php echo e($iku->polaritas == 'maximize' ? 'selected' : ''); ?>>Maximize</option>
                                    <option class="form-control" value="minimize" <?php echo e($iku->polaritas == 'minimize' ? 'selected' : ''); ?>>Minimize</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Bobot</label>
                                <input type="number" name="bobot" class="form-control" value="<?php echo e($iku->bobot); ?>" min="0" max="100">
                            </div>

                            <div class="mb-3">
                                <label for="proker">Program Kerja</label>
                                <textarea class="form-control" id="proker" name="proker" rows="4"><?php echo e($iku->proker); ?></textarea>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Penanggung Jawab</label>
                                <input type="text" name="pj" class="form-control" value="<?php echo e($iku->pj); ?>">
                            </div>
                        </div>

                        <!-- Right Section -->
                        <div class="col-md-6">
                            <!-- IKU Points Section -->
                            <?php $__currentLoopData = $ikuPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <h4>IKU Points</h4>
                                <input type="hidden" name="points[<?php echo e($point->id); ?>][id]" class="form-control" value="<?php echo e($point->id); ?>">
                                <div class="mb-3">
                                    <label class="form-label">Point Name</label>
                                    <input type="text" name="points[<?php echo e($point->id); ?>][point_name]" class="form-control" value="<?php echo e($point->point_name); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Base</label>
                                    <input type="text" name="points[<?php echo e($point->id); ?>][base]" class="form-control" value="<?php echo e($point->base); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Stretch</label>
                                    <input type="text" name="points[<?php echo e($point->id); ?>][stretch]" class="form-control" value="<?php echo e($point->stretch); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Satuan</label>
                                    <input type="text" name="points[<?php echo e($point->id); ?>][satuan]" class="form-control" value="<?php echo e($point->satuan); ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Polaritas</label>
                                    <select name="points[<?php echo e($point->id); ?>][polaritas]" class="form-select">
                                        <option class="form-control" value="maximize" <?php echo e($point->polaritas == 'maximize' ? 'selected' : ''); ?>>Maximize</option>
                                        <option class="form-control" value="minimize" <?php echo e($point->polaritas == 'minimize' ? 'selected' : ''); ?>>Minimize</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Bobot</label>
                                    <input type="number" name="points[<?php echo e($point->id); ?>][bobot]" class="form-control" value="<?php echo e($point->bobot); ?>" min="0" max="100">
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-iku.blade.php ENDPATH**/ ?>