<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    $department_id = Auth::user()->department_id;
    $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_username')
        ->first();
    $departmentName = (string) $department->department_username;
    ?>


<?php $__env->startSection('title', 'Form IKU'); ?>

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
                <li class="breadcrumb-item"><a href="/iku">IKU</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pilih Tahun</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
            <h3>IKU <?php echo $departmentName ?> Tahun <?php echo $selectedYear; ?></h3>
                <form method="GET" class="mb-3">
                    <label for="year" class="form-label">Pilih Tahun:</label>
                    <select name="year" id="year" class="form-select w-auto d-inline">
                    <?php for ($year = 2024; $year <= 2030; $year++): ?>
                        <option value="<?php echo $year; ?>" <?php if ($year == $selectedYear) echo 'selected'; ?>>
                            <?php echo $year; ?>
                        </option>
                    <?php endfor; ?>
                    </select>
                    <button type="submit" class="btn btn-primary">Pilih</button>
                </form>
            </div>
        </div>
    </div>
    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-0 text-center" rowspan="2">#</th>
                    <th class="border-0 text-center" rowspan="2">Perspektif</th>
                    <th class="border-0 text-center" colspan="2">Key Address</th>
                    <th class="border-0 text-center" rowspan="2">Indikator Kerja Utama</th>
                    <th class="border-0 text-center" colspan="2">Target</th>
                    <th class="border-0 text-center" rowspan="2">Satuan</th>
                    <th class="border-0 text-center" rowspan="2">Polaritas</th>
                    <th class="border-0 text-center" rowspan="2">Bobot</th>
                    <th class="border-0 text-center" rowspan="2">Program Kerja</th>
                    <th class="border-0 text-center" rowspan="2">Penanggung Jawab</th>
                    <th class="border-0 text-center" rowspan="2">Action</th>
                </tr>
                <tr>
                    <th class="border-0 text-center">IKU Atasan</th>
                    <th class="border-0 text-center">Target</th>
                    <th class="border-0 text-center">Base</th>
                    <th class="border-0 text-center">Stretch</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $sasaranGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sasaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $ikuCount = count($sasaran['ikus']);
                        $totalRows = 0;
                        $ikuAtasanRowspan = [];
                        $targetRowspan = [];

                        // Pre-calculate row spans for merging IKU Atasan & Target
                        foreach ($sasaran['ikus'] as $iku) {
                            $ikuPointList = collect($iku->points ?? []);
                            $maxRows = max(1, $ikuPointList->count());
                            $totalRows += $maxRows;

                            $ikuAtasanRowspan[$iku->iku_atasan] = ($ikuAtasanRowspan[$iku->iku_atasan] ?? 0) + $maxRows;
                            $targetRowspan[$iku->target] = ($targetRowspan[$iku->target] ?? 0) + $maxRows;
                        }
                    ?>

                    <?php $__currentLoopData = $sasaran['ikus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $iku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $ikuPointList = collect($iku->points ?? []);
                            $maxRows = max(1, $ikuPointList->count());
                        ?>

                        <tr>
                            <?php if($index == 0): ?>
                                <td class="fw-bold align-middle text-center" rowspan="<?php echo e($totalRows); ?>">
                                    <?php echo e($sasaran['number']); ?>

                                </td>
                                <td class="fw-normal align-middle text-center" rowspan="<?php echo e($totalRows); ?>">
                                    <?php echo e($sasaran['perspektif']); ?>

                                </td>
                            <?php endif; ?>

                            <?php if($ikuAtasanRowspan[$iku->iku_atasan] > 0): ?>
                                <td class="fw-normal text-center" rowspan="<?php echo e($ikuAtasanRowspan[$iku->iku_atasan]); ?>">
                                    <?php echo e($iku->iku_atasan); ?>

                                </td>
                                <?php
                                    $ikuAtasanRowspan[$iku->iku_atasan] = 0;
                                ?>
                            <?php endif; ?>

                            <?php if($targetRowspan[$iku->target] > 0): ?>
                                <td class="fw-normal text-center" rowspan="<?php echo e($targetRowspan[$iku->target]); ?>">
                                    <?php echo e($iku->target); ?>

                                </td>
                                <?php
                                    $targetRowspan[$iku->target] = 0;
                                ?>
                            <?php endif; ?>

                            <td class="fw-normal text-start" rowspan="<?php echo e($maxRows); ?>">
                                <strong class="fw-normal text-center"><?php echo e($iku->iku); ?></strong>
                                <?php if($ikuPointList->isNotEmpty()): ?>
                                    <ul class="m-0 p-0">
                                        <?php $__currentLoopData = $ikuPointList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li style="font-size: 0.875rem;"><?php echo e($point->point_name); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </td>

                            <?php
                                $firstPoint = $ikuPointList->first() ?? null;
                            ?>
                            <td class="fw-normal text-center">
                                <?php echo e($firstPoint->base ?? $iku->base ?? '-'); ?>

                            </td>
                            <td class="fw-normal text-center">
                                <?php echo e($firstPoint->stretch ?? $iku->stretch ?? '-'); ?>

                            </td>
                            <td class="fw-normal text-center">
                                <?php echo e($firstPoint->satuan ?? $iku->satuan ?? '-'); ?>

                            </td>
                            <td class="fw-normal text-center">
                                <?php echo e(ucfirst($firstPoint->polaritas ?? $iku->polaritas ?? '-')); ?>

                            </td>
                            <td class="fw-normal bobot-cell">
                                <?php echo e($firstPoint->bobot ?? $iku->bobot ?? '-'); ?>

                            </td>

                            <td class="fw-normal text-center" rowspan="<?php echo e($maxRows); ?>"><?php echo nl2br(e($iku->proker)); ?></td>
                            <td class="fw-normal text-center" rowspan="<?php echo e($maxRows); ?>"><?php echo e($iku->pj); ?></td>
                            <td class="fw-normal text-center" rowspan="<?php echo e($maxRows); ?>">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="<?php echo e(route('edit-iku', $iku->id)); ?>" class="btn btn-pill btn-outline-tertiary">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                    <form action="<?php echo e(route('delete-iku', $iku->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this IKU?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-pill btn-outline-danger">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <?php if($ikuPointList->count() > 1): ?>
                            <?php $__currentLoopData = $ikuPointList->slice(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-normal text-center"><?php echo e($point->base ?? '-'); ?></td>
                                    <td class="fw-normal text-center"><?php echo e($point->stretch ?? '-'); ?></td>
                                    <td class="fw-normal text-center"><?php echo e($point->satuan ?? '-'); ?></td>
                                    <td class="fw-normal text-center"><?php echo e(ucfirst($point->polaritas ?? '-')); ?></td>
                                    <td class="fw-normal bobot-cell"><?php echo e($point->bobot ?? '-'); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div><br>
    <form action="<?php echo e(route('export.iku')); ?>" method="GET">
        <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
        <button type="submit" class="btn btn-pill btn-outline-success">Export to Excel</button>
    </form>
    <div class="mt-5">
        <a href="<?php echo e(route('check-iku', ['year' => $selectedYear])); ?>" class="btn btn-primary">
            Tambah/Ubah IKU
        </a>
    </div>
</main>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/iku.blade.php ENDPATH**/ ?>