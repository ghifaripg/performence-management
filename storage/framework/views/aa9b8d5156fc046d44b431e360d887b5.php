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
                    <div class="mb-3">
                        <label for="iku_name" class="form-label">IKU Name</label>
                        <input type="text" class="form-control" id="iku_name" name="iku_name" value="<?php echo e($iku->iku_name); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="target" class="form-label">Target</label>
                        <input type="text" class="form-control" id="target" name="target" value="<?php echo e($iku->target); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="satuan" class="form-label">Satuan</label>
                        <input type="text" class="form-control" id="satuan" name="satuan" value="<?php echo e($iku->satuan); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="polaritas" class="form-label">Polaritas</label>
                        <select class="form-control" id="polaritas" name="polaritas">
                            <option value="maximize" <?php echo e($iku->polaritas == 'maximize' ? 'selected' : ''); ?>>Maximize</option>
                            <option value="minimize" <?php echo e($iku->polaritas == 'minimize' ? 'selected' : ''); ?>>Minimize</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="bobot" class="form-label">Bobot</label>
                        <input type="number" class="form-control" id="bobot" name="bobot" value="<?php echo e($iku->bobot); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="proker" class="form-label">Program Kerja</label>
                        <input type="text" class="form-control" id="proker" name="proker" value="<?php echo e($iku->proker); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="pj" class="form-label">Penanggung Jawab</label>
                        <input type="text" class="form-control" id="pj" name="pj" value="<?php echo e($iku->pj); ?>" required>
                    </div>

                    <h4>IKU Points</h4>
                    <?php $__currentLoopData = $ikuPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="mb-3">
                            <label class="form-label">Point Name</label>
                            <input type="text" class="form-control" name="points[<?php echo e($point->id); ?>][point_name]" value="<?php echo e($point->point_name); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Base</label>
                            <input type="text" class="form-control" name="points[<?php echo e($point->id); ?>][base]" value="<?php echo e($point->base); ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Stretch</label>
                            <input type="text" class="form-control" name="points[<?php echo e($point->id); ?>][stretch]" value="<?php echo e($point->stretch); ?>">
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-iku.blade.php ENDPATH**/ ?>