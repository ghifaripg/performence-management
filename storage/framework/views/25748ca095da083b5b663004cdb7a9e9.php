<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
?>


<?php $__env->startSection('title', 'Evaluasi IKU'); ?>

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
                <li class="breadcrumb-item"><a href="/evaluasi">Evaluasi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pilih Periode</li>
            </ol>
        </nav>

        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h3>Form Evaluasi Iku <?php echo e($departmentName); ?> Bulan <?php echo e($selectedMonthName); ?></h3>
                <form method="GET" class="mb-3">
                    <label for="month-year" class="form-label">Pilih Periode:</label>
                    <input type="month" id="month-year" name="month-year" class="form-control w-auto d-inline"
                        value="<?php echo e(date('Y-m', strtotime("$selectedYear-$selectedMonth-01"))); ?>">
                    <button type="submit" class="btn btn-primary">Pilih</button>
                </form>

            </div>
        </div>
    </div>

    <div class="mt-5">
        <a href="/form-evaluasi?month=<?php echo e($selectedMonth); ?>&year=<?php echo e($selectedYear); ?>" class="btn btn-primary">
            Tambah/Ubah Form Evaluasi
        </a>
    </div>

</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/evaluasi.blade.php ENDPATH**/ ?>