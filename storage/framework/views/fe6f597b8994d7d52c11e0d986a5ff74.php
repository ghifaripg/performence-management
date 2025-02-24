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


<?php $__env->startSection('title', 'Form IKU'); ?>

<main class="content">
<?php $__env->startSection('content'); ?>

            <!-- Logo Back Atas -->
            <div class="py-4">
                <nav aria-label="breadcrumb" class="d-none d-md-inline-block">
                    <ol class="breadcrumb breadcrumb-dark breadcrumb-transparent">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">
                                <svg class="icon icon-xxs" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item"><a href="/iku">IKU</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tahun <?php echo $selectedYear; ?></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                    <h4>Form Iku </h4>
                    </div>
                </div>
            </div>

            <!-- Pilih Sasaran Strategis -->
            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow components-section">
                        <div class="card-body">
                            <h5>Pilih Sasaran Strategis</h5>
                            <div id="sasaran-checkbox-list">
                                <?php $__currentLoopData = $sasaranStrategis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sasaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-check d-flex align-items-center mb-2">
                                        <input type="radio" class="form-check-input sasaran-checkbox"
                                            name="sasaran_strategis"
                                            value="<?php echo e($sasaran->id); ?>"
                                            id="sasaran_<?php echo e($sasaran->id); ?>">
                                        <label class="form-check-label ms-2" for="sasaran_<?php echo e($sasaran->id); ?>">
                                            <?php echo e($sasaran->name); ?>

                                        </label>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <form method="POST" action="<?php echo e(route('store-iku')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="sasaran_id" id="selected-sasaran-id">
                    <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
                    <input type="hidden" name="is_multi_point" value="<?php echo e(old('is_multi_point', 0)); ?>">


                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow components-section">
                            <div class="card-body">
                                <h5>Sasaran Strategis: <span id="selected-sasaran">None</span></h5>

                                <!-- IKU Type Selection -->
                                <div class="mb-3">
                                    <label>IKU Type:</label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="iku_type" id="singlePoint" value="single" checked>
                                        <label class="form-check-label" for="singlePoint">Single Point</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="iku_type" id="multiplePoints" value="multiple">
                                        <label class="form-check-label" for="multiplePoints">Multiple Points</label>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <!-- Left Section -->
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <h5>Key Address</h5>
                                            <label for="iku_atasan">IKU Atasan</label>
                                            <input type="text" class="form-control" name="iku_atasan" id="iku_atasan">
                                            <label for="target">Target</label>
                                            <input type="text" class="form-control" name="target" id="target">
                                        </div>
                                        <div class="my-4">
                                            <label for="proker">Program Kerja</label>
                                            <textarea class="form-control" placeholder="Tulis Program Kerja Anda...." id="proker" name="proker" rows="4"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pj">Penanggung Jawab</label>
                                            <input type="text" class="form-control" name="pj" id="pj">
                                        </div>
                                    </div>

                                    <div class="col-lg-2 col-sm-6"></div>

                                    <!-- Right Section -->
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="iku">Indikator Kinerja Utama (IKU)</label>
                                            <input type="text" class="form-control" name="iku" id="iku">
                                        </div>

                                        <!-- Single Point Section -->
                                        <div id="single-point-section">
                                            <h5>IKU Details</h5>
                                            <label>Base</label>
                                            <input type="text" class="form-control" name="single_base" id="single_base">
                                            <label>Stretch</label>
                                            <input type="text" class="form-control" name="single_stretch" id="single_stretch">
                                            <label>Satuan</label>
                                            <input type="text" class="form-control" name="single_satuan" id="single_satuan"">
                                            <label>Polaritas</label>
                                            <select name="single_polaritas" id="single_polaritas" class="form-select">
                                                <option value="maximize">Maximize</option>
                                                <option value="minimize">Minimize</option>
                                            </select>
                                            <label>Bobot</label>
                                            <input type="number" class="form-control" name="single_bobot" id="single_bobot" step="0.01">
                                        </div>

                                        <!-- IKU Points Section -->
                                        <div id="multiple-points-section" style="display: none;">
                                            <h5>IKU Points</h5>
                                            <div id="iku-points-container">
                                                <div class="iku-point mb-3">
                                                    <label>Point Name</label>
                                                    <input type="text" class="form-control" name="points[0][name]">
                                                    <label>Base</label>
                                                    <input type="text" class="form-control" name="points[0][base]">
                                                    <label>Stretch</label>
                                                    <input type="text" class="form-control" name="points[0][stretch]">
                                                    <label>Satuan</label>
                                                    <input type="text" class="form-control" name="points[0][satuan]">
                                                    <label>Polaritas</label>
                                                    <select name="points[0][polaritas]" class="form-select">
                                                        <option value="maximize">Maximize</option>
                                                        <option value="minimize">Minimize</option>
                                                    </select>
                                                    <label>Bobot</label>
                                                    <input type="number" class="form-control point-bobot" name="points[0][bobot]" step="0.01">
                                                    <button type="button" class="btn btn-danger btn-sm remove-point">Remove</button>
                                                </div>
                                            </div>
                                            <button type="button" class="btn btn-primary" id="add-iku-point">Add New Point</button>
                                            <p id="total-bobot" class="mt-2"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-tertiary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
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


                <h6 id="total-bobot">Total Bobot = <span id="bobot-value">0</span></h6>
            </div>


</main>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let pointIndex = 0;

        const sasaranRadios = document.querySelectorAll('.sasaran-checkbox');
        const selectedSasaranInput = document.getElementById('selected-sasaran-id');
        const selectedSasaranText = document.getElementById('selected-sasaran');

        // Toggle between Single and Multiple IKU points
        const singlePointRadio = document.getElementById("singlePoint");
        const multiplePointsRadio = document.getElementById("multiplePoints");
        const singlePointSection = document.getElementById("single-point-section");
        const multiplePointsSection = document.getElementById("multiple-points-section");

        singlePointRadio.addEventListener("change", function() {
            if (this.checked) {
                singlePointSection.style.display = "block";
                multiplePointsSection.style.display = "none";
            }
        });

        multiplePointsRadio.addEventListener("change", function() {
            if (this.checked) {
                singlePointSection.style.display = "none";
                multiplePointsSection.style.display = "block";
            }
        });

        sasaranRadios.forEach(radio => {
            radio.addEventListener('change', function() {
                selectedSasaranInput.value = this.value;
                selectedSasaranText.textContent = this.nextElementSibling.textContent;
            });
        });


    let totalBobot = 0;
    document.querySelectorAll('.bobot-cell').forEach(cell => {
        let value = parseFloat(cell.textContent.trim()) || 0;
        totalBobot += value;
    });
    document.getElementById("bobot-value").textContent = totalBobot;

        document.getElementById('add-iku-point').addEventListener('click', function () {
            pointIndex++;
            const container = document.getElementById('iku-points-container');
            const pointHtml = `
                <div class="iku-point mb-3" data-index="${pointIndex}">
                    <label>Point Name</label>
                    <input type="text" class="form-control" name="points[${pointIndex}][name]">
                    <label>Base</label>
                    <input type="text" class="form-control" name="points[${pointIndex}][base]">
                    <label>Stretch</label>
                    <input type="text" class="form-control" name="points[${pointIndex}][stretch]">
                    <label>Satuan</label>
                    <input type="text" class="form-control" name="points[${pointIndex}][satuan]">
                    <label>Polaritas</label>
                    <select name="points[${pointIndex}][polaritas]" class="form-select">
                        <option value="maximize">Maximize</option>
                        <option value="minimize">Minimize</option>
                    </select>
                    <label>Bobot</label>
                    <input type="number" class="form-control point-bobot" name="points[${pointIndex}][bobot]" step="0.01">
                    <button type="button" class="btn btn-danger btn-sm remove-point">Remove</button>
                </div>`;
            container.insertAdjacentHTML('beforeend', pointHtml);
        });

        // Remove IKU Point
        document.getElementById('iku-points-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-point')) {
                e.target.closest('.iku-point').remove();
            }
        });
    });
    </script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/form-iku.blade.php ENDPATH**/ ?>