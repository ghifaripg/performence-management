<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>


<?php $__env->startSection('title', 'Dashboard'); ?>

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
                        <li class="breadcrumb-item"><a href="/kontrak">Kontrak Manajemen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Tahun <?php echo $selectedYear; ?></li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                    <h4>Kontrak Manajemen Tahun <?php echo $selectedYear; ?></h4>
                    </div>
                </div>
            </div>
            <!-- Tambah Sasaran Strategis -->
            <div class="row">
                <div class="col-12 mb-4">
                    <h5>Sasaran Strategis</h5>
                    <div class="card border-0 shadow components-section">
                        <form method="POST" action="<?php echo e(route('store-sasaran')); ?>" class="form-sasaran" >
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
                            <div class="mb-3">
                                <input type="text" name="sasaran_name" class="form-control" placeholder="Nama Sasaran Strategis" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Tambah Sasaran</button>
                        </form>
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
                                        <form action="<?php echo e(route('delete-sasaran', $sasaran->id)); ?>" method="POST" onsubmit="return confirm('Hapus Sasaran Strategis Ini?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-danger" style="margin-top: 0%; margin-bottom:3px; margin-left:12px; max-height:88%; max-width:90%">
                                                <i class="fas fa-trash-alt me-1"></i>Delete
                                            </button>
                                        </form>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form KPI -->
            <div class="row">
                <form method="POST" action="<?php echo e(route('store-kpi')); ?>">
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="sasaran_id" id="selected-sasaran-id">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow components-section">
                            <div class="card-body">
                                <h5>Sasaran Strategis: <span id="selected-sasaran">None</span></h5>
                                <div class="row mb-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="mb-3">
                                            <label for="kpi">Key Perfomance Indicator</label>
                                            <input type="text" class="form-control" name="kpi_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="target">Target</label>
                                            <input type="text" class="form-control" name="target" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="milestone">Milestone</label>
                                            <input type="text" class="form-control" name="milestone">
                                        </div>
                                        <div class="mb-3">
                                            <label for="esgc">ESG/C</label>
                                            <select name="esgc" class="form-select" required>
                                                <option value="E">E</option>
                                                <option value="S">S</option>
                                                <option value="G">G</option>
                                                <option value="C">C</option>
                                            </select>
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
                                            <input type="number" class="form-control" name="bobot" min="0" max="100" step="0.01" required>
                                        </div>
                                        <div class="mb-3">
                                            <h5>Matriks Tanggung Jawab</h5>
                                            <label class="form-label">DI</label>
                                            <select name="du" class="form-select mb-2">
                                                <option value="O">O (Overall)</option>
                                                <option value="R">R (Responsible)</option>
                                                <option value="S">S (Support)</option>
                                            </select>
                                            <label class="form-label">DK&SDM</label>
                                            <select name="dk" class="form-select mb-2">
                                                <option value="O">O (Overall)</option>
                                                <option value="R">R (Responsible)</option>
                                                <option value="S">S (Support)</option>
                                            </select>
                                            <label class="form-label">DO</label>
                                            <select name="do" class="form-select mb-2">
                                                <option value="O">O (Overall)</option>
                                                <option value="R">R (Responsible)</option>
                                                <option value="S">S (Support)</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <button class="btn btn-tertiary" type="submit">Submit</button><br>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card card-body border-0 shadow table-wrapper table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-gray-200">#</th>
                            <th class="border-gray-200">Sasaran Strategis</th>
                            <th class="border-gray-200">Key Performance Indicator</th>
                            <th class="border-gray-200">Target</th>
                            <th class="border-gray-200">Satuan</th>
                            <th class="border-gray-200">Milestone</th>
                            <th class="border-gray-200">ESG/C</th>
                            <th class="border-gray-200">Polaritas</th>
                            <th class="border-gray-200">Bobot</th>
                            <th class="border-gray-200">DU</th>
                            <th class="border-gray-200">DK</th>
                            <th class="border-gray-200">DO</th>
                            <th class="border-gray-200">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $sasaranGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sasaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $rowCount = count($sasaran['kpis']);
                            ?>
                            <?php $__currentLoopData = $sasaran['kpis']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $kpi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <?php if($index == 0): ?>
                                        <td class="fw-bold align-middle" rowspan="<?php echo e($rowCount); ?>"><?php echo e($sasaran['letter']); ?></td>
                                        <td class="fw-normal align-middle" rowspan="<?php echo e($rowCount); ?>"><?php echo e($sasaran['name']); ?></td>
                                    <?php endif; ?>
                                <td class="fw-normal"><?php echo e($index + 1); ?>. <?php echo e($kpi->kpi_name); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->target); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->satuan); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->milestone ?? '-'); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->esgc); ?></td>
                                <td class="fw-normal"><?php echo e(ucfirst($kpi->polaritas)); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->bobot); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->du); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->dk); ?></td>
                                <td class="fw-normal"><?php echo e($kpi->do); ?></td>
                                <td>
                                    <!-- Edit Button -->
                                    <form action="<?php echo e(route('edit-kpi', $kpi->id)); ?>" method="GET">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="btn btn-pill btn-outline-tertiary">
                                            <i class="fas fa-edit me-1"></i>Edit
                                        </button>
                                    </form>

                                    <!-- Delete Button -->
                                    <form action="<?php echo e(route('delete-kpi', $kpi->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this KPI?');">
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
                    let bobotCell = row.querySelector("td:nth-child(9)");
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views\pages\form-kontrak.blade.php ENDPATH**/ ?>