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


<?php $__env->startSection('title', 'Edit IKU'); ?>


<main class="content">
    <?php $__env->startSection('content'); ?>
        <nav class="navbar navbar-top navbar-expand navbar-dashboard navbar-dark ps-0 pe-2 pb-0">
  <div class="container-fluid px-0">
    <div class="d-flex justify-content-between w-100" id="navbarSupportedContent">
<div class="container">
    <h2>Edit IKU</h2>
    <div class="row">
        <form method="POST" action="<?php echo e(route('update-iku', ['id' => $iku->id])); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <input type="hidden" name="sasaran_id" id="selected-sasaran-id" value="<?php echo e($iku->sasaran_id); ?>">
            <input type="hidden" name="iku_id" id="iku_id" value="<?php echo e($iku->iku_id); ?>">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <a href="/form-iku?year=<?php echo $selectedYear?>">Back</a>
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <!-- Form -->
                                <div class="mb-3">
                                    <h5>Key Adress</h5>
                                    <label for="iku_atasan">IKU Atasan</label>
                                    <input type="text" class="form-control" name="iku_atasan" id="iku_atasan" value="<?php echo e($iku->iku_atasan); ?>">
                                    <label for="target">Target</label>
                                    <input type="text" class="form-control" name="target" id="target" value="<?php echo e($iku->target); ?>">
                                </div>
                                <!-- End of Form -->
                                <div class="mb-3">
                                    <label for="iku">Indikator Kerja Utama</label>
                                    <textarea class="form-control"name="iku" id="iku" rows="4" required><?php echo e(old('iku', $iku->iku)); ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <h5>Target</h5>
                                    <label for="base">Base</label>
                                    <input type="text" class="form-control" name="base" id="base" value="<?php echo e($iku->base); ?>"required>
                                    <label for="stretch">Stretch</label>
                                    <input type="text" class="form-control" name="stretch" id="stretch" value="<?php echo e($iku->stretch); ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan" value="<?php echo e($iku->satuan); ?>"required>
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="polaritas">Polaritas</label>
                                    <select name="polaritas" class="form-select" value="<?php echo e($iku->polaritas); ?>"required>
                                        <option value="maximize">Maximize</option>
                                        <option value="minimize">Minimize</option>
                                     </select>
                                </div>
                                <div class="mb-3">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" id="bobot" value="<?php echo e($iku->bobot); ?>"required>
                                </div>
                                <!-- Form -->
                                <div class="my-4">
                                    <div class="my-4">
                                        <label for="proker">Program Kerja</label>
                                        <textarea class="form-control" placeholder="Tulis Program Kerja Anda...." id="proker" name="proker" rows="4" required><?php echo e(old('proker', $iku->proker)); ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="pj">Penanggung Jawab</label>
                                    <input type="text" class="form-control" name="pj" id="pj" value="<?php echo e($iku->pj); ?>"required>
                                </div>
                        </div>
                    </div>
                </div>
                <button class="btn btn-tertiary" type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/edit-iku.blade.php ENDPATH**/ ?>