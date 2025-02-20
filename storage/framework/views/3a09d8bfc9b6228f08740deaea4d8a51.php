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
                    <h4>Form IKU </h4>
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

            <!-- Form KPI -->
            <div class="row">
                <form method="POST" action="<?php echo e(route('store-iku')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="sasaran_id" id="selected-sasaran-id">
                    <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow components-section">
                            <div class="card-body">
                                <h5>Sasaran Strategis: <span id="selected-sasaran">None</span></h5>
                                <div class="row mb-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <!-- Form -->
                                        <div class="mb-3">
                                            <h5>Key Adress</h5>
                                            <label for="iku_atasan">IKU Atasan</label>
                                            <input type="text" class="form-control" name="iku_atasan" id="iku_atasan">
                                            <label for="target">Target</label>
                                            <input type="text" class="form-control" name="target" id="target">
                                        </div>
                                        <!-- End of Form -->
                                        <div class="mb-3">
                                            <label for="iku">Indikator Kerja Utama</label>
                                            <input type="text" class="form-control" name="iku" id="iku">
                                        </div>
                                        <div class="mb-3">
                                            <h5>Target</h5>
                                            <label for="base">Base</label>
                                            <input type="text" class="form-control" name="base" id="base">
                                            <label for="stretch">Stretch</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                        </div>
                                        <div class="mb-3">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" id="satuan">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
                                    </div>
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="polaritas">Polaritas</label>
                                            <select name="polaritas" class="form-select" required>
                                                <option value="maximize">Maximize</option>
                                                <option value="minimize">Minimize</option>
                                             </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="bobot">Bobot</label>
                                            <input type="number" class="form-control" name="bobot" id="bobot">
                                        </div>
                                        <!-- Form -->
                                        <div class="my-4">
                                            <label for="proker">Program Kerja</label>
                                            <textarea class="form-control" placeholder="Tulis Program Kerja Anda...." id="proker" name="proker" rows="4"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="pj">Penanggung Jawab</label>
                                            <input type="text" class="form-control" name="pj" id="pj">
                                        </div>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-tertiary" type="submit">Submit</button><br>
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
                            <th class="border-0 text-center" rowspan="2" style="white-space: nowrap">Indikator Kerja Utama</th>
                            <th class="border-0 text-center" colspan="2">Target</th>
                            <th class="border-0 text-center" rowspan="2">Satuan</th>
                            <th class="border-0 text-center" rowspan="2">Polaritas</th>
                            <th class="border-0 text-center" rowspan="2">Bobot</th>
                            <th class="border-0 text-center" rowspan="2" style="white-space: normal">Program Kerja</th>
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
                                $rowCount = count($sasaran['ikus']);
                            ?>
                        <?php $__currentLoopData = $sasaran['ikus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $iku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <?php if($index == 0): ?>
                                        <td class="fw-bold align-middle text-center" rowspan="<?php echo e($rowCount); ?>"><?php echo e($sasaran['number']); ?></td>
                                        <td class="fw-normal align-middle text-center" rowspan="<?php echo e($rowCount); ?>"><?php echo e($sasaran['perspektif']); ?></td>
                                    <?php endif; ?>
                                <td class="fw-normal text-center"><?php echo e($iku->iku_atasan); ?></td>
                                <td class="fw-normal text-center "><?php echo e($iku->target); ?></td>
                                <td class="fw-normal text-center"><?php echo e($index + 1); ?>. <?php echo e($iku->iku); ?></td>
                                <td class="fw-normal text-center"><?php echo e($iku->base ?? '-'); ?></td>
                                <td class="fw-normal text-center"><?php echo e($iku->stretch); ?></td>
                                <td class="fw-normal text-center"><?php echo e($iku->satuan); ?></td>
                                <td class="fw-normal text-center"><?php echo e(ucfirst($iku->polaritas)); ?></td>
                                <td class="fw-normal text-center"><?php echo e($iku->bobot); ?></td>
                                <td class="fw-normal text-center"><?php echo nl2br(e($iku->proker)); ?></td>
                                <td class="fw-normal text-center"><?php echo e($iku->pj); ?></td>
                                <td class="fw-normal text-center">
                                    <!-- Edit Button -->
                                    <form action="<?php echo e(route('edit-iku', $iku->id)); ?>" method="GET">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-pill btn-outline-tertiary">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="<?php echo e(route('delete-iku', $iku->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this IKU?');">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-pill btn-outline-danger">
                                            <i class="fas fa-trash-alt me-1"></i>Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
                <h6 id="total-bobot">Total Bobot = 0</h6>
            </div>

</main>
<?php $__env->stopSection(); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sasaranRadios = document.querySelectorAll('.sasaran-checkbox');
    const selectedSasaranInput = document.getElementById('selected-sasaran-id');
    const selectedSasaranText = document.getElementById('selected-sasaran');

    sasaranRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            selectedSasaranInput.value = this.value;
            selectedSasaranText.textContent = this.nextElementSibling.textContent;
        });
    });
    });

    document.addEventListener("DOMContentLoaded", function () {
        function updateTotalBobot() {
        let totalBobot = 0;
            document.querySelectorAll("table tbody tr").forEach(row => {
                let bobotCell = row.querySelector("td:nth-child(10)");
                if (bobotCell) {
                    let bobotValue = parseFloat(bobotCell.textContent.trim()) || 0;
                    totalBobot += bobotValue;
                }
            });

            let totalBobotElement = document.getElementById("total-bobot");
            totalBobotElement.textContent = `Total Bobot = ${totalBobot.toFixed(2)}`;

            if (totalBobot > 100) {
                totalBobotElement.style.color = "red";
            } else {
                totalBobotElement.style.color = "green";
            }
        }
    updateTotalBobot();
});
</script>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views\pages\form-iku.blade.php ENDPATH**/ ?>