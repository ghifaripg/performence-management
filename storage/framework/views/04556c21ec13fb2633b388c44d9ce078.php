<?php
    use Carbon\Carbon;
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    $department_id = Auth::user()->department_id;
    $department = DB::table('department')
        ->where('department_id', $department_id)
        ->select('department_name')
        ->first();
    $departmentName = (string) $department->department_name;
    ?>


<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo e(asset ('assets/img/favicon/apple-touch-icon.png')); ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo e(asset('assets/img/favicon-32x32.png')); ?>">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo e(asset('assets/img/favicon-16x16.png')); ?>">
<link rel="shortcut icon" href="<?php echo e(asset('assets/img/favicon.ico')); ?>">
<?php $__env->startSection('title', 'Dashboard'); ?>
    <main class="content">
            <?php $__env->startSection('content'); ?>
            <div class="py-4 main-content">
                <div class="dropdown">
                    <button class="btn btn-gray-800 d-inline-flex align-items-center me-2 dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                        New Task
                    </button>
                    <div class="dropdown-menu dashboard-dropdown dropdown-menu-start mt-2 py-1">
                        <a class="dropdown-item d-flex align-items-center" href="/kontrak">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z"></path></svg>
                            Lihat Kontrak
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/iku">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                            Lihat IKU
                        </a>
                        <a class="dropdown-item d-flex align-items-center" href="/progres">
                            <svg class="dropdown-icon text-gray-400 me-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5.5 13a3.5 3.5 0 01-.369-6.98 4 4 0 117.753-1.977A4.5 4.5 0 1113.5 13H11V9.413l1.293 1.293a1 1 0 001.414-1.414l-3-3a1 1 0 00-1.414 0l-3 3a1 1 0 001.414 1.414L9 9.414V13H5.5z"></path><path d="M9 13h2v5a1 1 0 11-2 0v-5z"></path></svg>
                            Progres
                        </a>
                    </div>
                </div>
            </div>

            <!-- Chart Evaluasi-->
            <div class="main-content">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card bg-yellow-100 border-0 shadow">
                            <div class="card-header d-sm-flex flex-row align-items-center flex-0">
                                <div class="d-block mb-3 mb-sm-0">
                                    <form method="GET" class="mb-3">
                                        <label for="year" class="form-label">Pilih Tahun:</label>
                                        <select name="year" id="year" class="form-select w-auto d-inline">
                                            <?php for ($year = 2024; $year <= 2030; $year++): ?>
                                                <option value="<?= $year ?>" <?= $year == $selectedYear ? 'selected' : '' ?>>
                                                    <?= $year ?>
                                                </option>
                                            <?php endfor; ?>
                                        </select>

                                        <?php if(auth()->user()->id == 1): ?>
                                        <label for="department" class="form-label ms-3">Pilih Unit Kerja:</label>
                                        <select name="department" id="department" class="form-select w-auto d-inline" required>
                                            <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($dept->department_id); ?>" <?php echo e($dept->department_id == $selectedDepartment ? 'selected' : ''); ?>>
                                                    <?php echo e($dept->department_name); ?>

                                                </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php endif; ?>
                                        <button type="submit" class="btn btn-secondary">Pilih</button>
                                    </form>

                                    <div class="fs-5 fw-normal mb-2">Performance Management - Capaian IKU <?php echo e($selectedYear); ?></div>
                                    <?php if(auth()->user()->id == 1): ?>
                                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($dept->department_id == $selectedDepartment): ?>
                                            <h2 class="fs-3 fw-extrabold">Unit Kerja: <?php echo e($dept->department_name); ?></h2>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <h2 class="fs-3 fw-extrabold">Unit Kerja: <?php echo e($departmentName); ?></h2>
                                <?php endif; ?>
                                </div>

                            </div>
                            <div class="card-body p-2">
                                <div id="sales-chart"></div>
                            </div>

                            <script>
                                document.addEventListener("DOMContentLoaded", function () {
                                    var options = {
                                        chart: {
                                            type: 'area',
                                            height: 300,
                                            animations: {
                                                enabled: true,
                                                easing: 'easeout',
                                                speed: 800
                                            }
                                        },
                                        series: [{
                                            name: "Skor IKU",
                                            data: <?php echo $adjSeriesJson; ?>

                                        }],
                                        colors: ['#FF9E42'],
                                        xaxis: {
                                            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agust', 'Sept', 'Okt', 'Nov', 'Des'],
                                            labels: {
                                                rotate: -45
                                            }
                                        },
                                        yaxis: {
                                            labels: {
                                                formatter: function (value) {
                                                    return value.toFixed(2);
                                                }
                                            }
                                        },
                                        stroke: {
                                            curve: 'smooth'
                                        },
                                        fill: {
                                            type: "gradient",
                                            gradient: {
                                                shadeIntensity: 1,
                                                opacityFrom: 0.4,
                                                opacityTo: 0
                                            }
                                        },
                                        tooltip: {
                                            theme: "dark"
                                        }
                                    };

                                    var chart = new ApexCharts(document.querySelector("#sales-chart"), options);
                                    chart.render();
                                });
                            </script>

                        </div>
                    </div>

                    <!-- Table Total Skor -->
                    <div class="col-12 col-xl-8">
                        <div class="row">
                            <div class="col-12 mb-4">
                                <div class="card border-0 shadow">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">
                                                <h2 class="fs-5 fw-bold mb-0">Total Skor IKU Perspektif (Perbandingan Per Tahun)</h2>
                                                <form method="GET" class="mb-3">
                                                    <label for="month-year" class="form-label">Pilih Periode:</label>
                                                    <input type="month" id="month-year" class="form-control w-auto d-inline"
                                                    value="<?php echo e(sprintf('%04d-%02d', $selectedYear, $selectedMonth)); ?>"
                                                    onchange="updateMonthYear(this.value)">
                                                    <input type="hidden" name="month" id="month">
                                                    <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
                                                    <input type="hidden" name="department" value="<?php echo e($selectedDepartment); ?>">
                                                    <button type="submit" class="btn btn-primary">Pilih</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="table-responsive" style="overflow-x: unset">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th class="border-0 text-center" style="background-color: #F3F2F2; color:black">No</th>
                                                        <th class="border-0 text-center" style="background-color: #F3F2F2; color:black">Perspektif</th>
                                                        <th class="border-0 text-center" style="background-color: #F3F2F2; color:black">Jumlah</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $__currentLoopData = $totalAdjPerSasaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $sasaran): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <tr>
                                                            <td style="border: none; text-align:left"><?php echo e($index + 1); ?></td>
                                                            <td style="border: none; text-align:left"><?php echo e($sasaran->perspektif); ?></td>
                                                            <td class="fw-normal text-center iku-cell" style="border: none; text-align:left"><?php echo e($sasaran->total); ?></td>
                                                        </tr>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <small class="text-tertiary mb-0">Total Skor =
                                            <span id="total-iku">
                                                <?php echo e(collect($totalAdjPerSasaran)->sum('total')); ?>

                                            </span>
                                        </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Progess Form Evaluasi -->
                <div class="col-12 col-sm-6 col-xl-4 mb-4">
                    <div class="card border-0 shadow">
                        <div class="card-header border-bottom d-flex align-items-center justify-content-between">
                            <h2 class="fs-5 fw-bold mb-0">Progres Evaluasi</h2>
                            <a href="/evaluasi" class="btn btn-sm btn-primary">Isi Evaluasi</a>
                        </div>
                        <div class="card-body">
                            <h5 class="mb-4">Evaluasi Bulanan - <?php echo $selectedYear ?></h5>
                            <div class="mt-4">
                            <?php $__currentLoopData = $months; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month => $percentage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="row align-items-center mb-4">
                                    <div class="col-auto">
                                        <svg class="icon icon-sm text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                        </svg>
                                    </div>
                                    <div class="col">
                                        <div class="progress-wrapper">
                                            <div class="progress-info">
                                                <div class="h6 mb-0">
                                                    <?php echo e(Carbon::createFromFormat('!m', $month)->locale('id')->translatedFormat('F')); ?>

                                                </div>
                                                <div class="small fw-bold text-gray-500"><span><?php echo e($percentage); ?> %</span></div>
                                            </div>
                                            <div class="progress mb-0">
                                                <div class="progress-bar
                                                    <?php if($percentage == 100): ?> bg-success
                                                    <?php elseif($percentage >= 50): ?> bg-warning
                                                    <?php else: ?> bg-danger
                                                    <?php endif; ?>"
                                                    role="progressbar"
                                                    aria-valuenow="<?php echo e($percentage); ?>"
                                                    aria-valuemin="0"
                                                    aria-valuemax="100"
                                                    style="width: <?php echo e($percentage); ?>%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                            <div class="d-flex justify-content-between mt-3">
                                <?php if($page > 1): ?>
                                    <a href="<?php echo e(url()->current()); ?>?page=<?php echo e($page - 1); ?>" class="btn btn-outline-primary btn-sm">Previous</a>
                                <?php else: ?>
                                    <span class="btn btn-outline-secondary btn-sm disabled">Previous</span>
                                <?php endif; ?>

                                <span>Page <?php echo e($page); ?> of <?php echo e($totalPages); ?></span>

                                <?php if($page < $totalPages): ?>
                                    <a href="<?php echo e(url()->current()); ?>?page=<?php echo e($page + 1); ?>" class="btn btn-outline-primary btn-sm">Next</a>
                                <?php else: ?>
                                    <span class="btn btn-outline-secondary btn-sm disabled">Next</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </main>
<script>
    function updateMonthYear(value) {
        const parts = value.split("-");
        if (parts.length === 2) {
            document.getElementById("month").value = parts[1];
            }
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

            function updateTotalIku() {
                let totalBobot = 0;

                document.querySelectorAll(".iku-cell").forEach(cell => {
                    let bobotValue = parseFloat(cell.textContent.trim()) || 0;
                    totalBobot += bobotValue;
                });

                let totalBobotElement = document.getElementById("total-iku");
                if (totalBobotElement) {
                    totalBobotElement.textContent = totalBobot.toFixed(2);
                }
            }
            updateTotalIku();
        }
    )
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/dashboard.blade.php ENDPATH**/ ?>