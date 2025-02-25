<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>


<?php $__env->startSection('title', 'Form Evaluasi IKU'); ?>

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
                <li class="breadcrumb-item">Evaluasi</li>
                <li class="breadcrumb-item"><a href="/evaluasi">Pilih Periode</a></li>
                <li class="breadcrumb-item active" aria-current="page">Bulan <?php echo e($selectedMonthName); ?> Tahun <?php echo e($selectedYear); ?></li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h4>Form Evaluasi IKU Bulan <?php echo e($selectedMonthName); ?></h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-4">
            <div class="card border-0 shadow components-section">
                <div class="card-body">
                    <h5>Pilih Indikator Kinerja Utama</h5>
                    <div id="sasaran-checkbox-list">
                        <!-- IKU Selector -->
                        <div class="mb-3">
                        <label for="iku-selector"><strong>Pilih Indikator Kinerja Utama</strong></label>
                        <select id="iku-selector" class="form-select">
                            <option value="">-- Pilih IKU --</option>
                            <?php $__currentLoopData = $sasaranGrouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $perspektif): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if(!empty($perspektif['ikus'])): ?>
                                    <optgroup label="<?php echo e($perspektif['number']); ?>. <?php echo e($perspektif['perspektif']); ?>">
                                        <?php $__currentLoopData = $perspektif['ikus']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $iku): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option
                                            value="<?php echo e($iku->id); ?>"
                                            data-is-multiple="<?php echo e($iku->is_multi_point); ?>"
                                            data-polaritas="<?php echo e($iku->polaritas); ?>"
                                            data-bobot="<?php echo e($iku->bobot); ?>"
                                            data-satuan="<?php echo e($iku->satuan); ?>"
                                            data-base="<?php echo e($iku->base); ?>"
                                        >
                                            <?php echo e($iku->iku); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </optgroup>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        </div>

                        <!-- Container for IKU Sub-Points -->
                        <div id="iku-sub-points" style="display: none;">
                            <h6>Sub-Points:</h6>
                            <ul id="sub-points-list">
                                <?php $__currentLoopData = $ikuPoints; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $formIkuId => $points): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <ul class="sub-points-group" data-iku-id="<?php echo e($formIkuId); ?>" style="display: none;">
                                        <?php $__currentLoopData = $points; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $point): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li>
                                            <input type="radio"
                                                name="selected_iku_point"
                                                value="<?php echo e($point->id); ?>"
                                                id="point_<?php echo e($point->id); ?>"
                                                data-polaritas="<?php echo e($point->polaritas); ?>"
                                                data-bobot="<?php echo e($point->bobot); ?>"
                                                data-satuan="<?php echo e($point->satuan); ?>"
                                                data-base="<?php echo e($point->base); ?>"
                                            >
                                            <label for="point_<?php echo e($point->id); ?>">
                                                <?php echo e($point->point_name); ?> - <?php echo e($point->base); ?> (<?php echo e($point->satuan); ?>)
                                            </label>
                                        </li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                    </ul>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                        <p>Selected IKU: <span id="selected-iku-text">None</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form KPI -->
    <div class="row">
        <form method="POST" action="<?php echo e(route('store-eval')); ?>">
            <?php echo csrf_field(); ?>
            <input type="hidden" id="selected-iku-id" name="selected_iku_id">
            <input type="hidden" id="selected-sub-points" name="selected_sub_points">
            <input type="hidden" name="year" value="<?php echo e($selectedYear); ?>">
            <input type="hidden" name="month" value="<?php echo e($selectedMonth); ?>">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <h5>IKU: <span id="selected-iku-heading">None</span></h5>
                        <div class="row mb-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <label for="polaritas">Polaritas</label>
                                    <input name="polaritas" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="bobot">Bobot</label>
                                    <input type="number" class="form-control" name="bobot" id="bobot">
                                </div>
                                <div class="mb-3">
                                    <label for="satuan">Satuan</label>
                                    <input type="text" class="form-control" name="satuan" id="satuan">
                                </div>
                                <div class="mb-3">
                                    <h5>Target</h5>
                                    <label >Tahun (1)</label>
                                    <input type="text" class="form-control" name="base" id="base">
                                    <label for="target_bulan_ini">Bulan Ini (2)</label>
                                    <input type="text" class="form-control" name="target_bulan_ini" id="target_bulan_ini">
                                    <label for="target_sdbulan_ini">s/d Bulan Ini (3)</label>
                                    <input type="text" class="form-control" name="target_sdbulan_ini" id="target_sdbulan_ini">
                                </div>
                                <div class="mb-3">
                                    <h5>Realisasi</h5>
                                    <label for="realisasi_bulan_ini">Bulan Ini (4)</label>
                                    <input type="text" class="form-control" name="realisasi_bulan_ini" id="realisasi_bulan_ini">
                                    <label for="realisasi_sdbulan_ini">s/d Bulan Ini (5)</label>
                                    <input type="text" class="form-control" name="realisasi_sdbulan_ini" id="realisasi_sdbulan_ini">
                                </div>
                            </div>
                            <div class="col-lg-2 col-sm-6">
                            </div>
                            <div class="col-lg-4 col-sm-6">
                                <div class="mb-3">
                                    <h5>Prosentase Pencapaian THD Target</h5>
                                    <label for="percent_target">6 = (5):(3) (6)</label>
                                    <input type="text" class="form-control" name="percent_target" id="percent_target" readonly>

                                    <label for="percent_year">7 = (5):(1) (7)</label>
                                    <input type="text" class="form-control" name="percent_year" id="percent_year" readonly>

                                </div>
                                <div class="mb-3">
                                    <h5>Score</h5>
                                    <label for="ttl">Ttl</label>
                                    <input type="text" class="form-control" name="ttl" id="ttl" readonly>
                                    <label for="adj">Adj.</label>
                                    <input type="text" class="form-control" name="adj" id="adj" readonly>
                                </div>
                                <div class="my-4">
                                    <label for="proker">Penyebab Tidak Tercapai</label>
                                    <textarea class="form-control" id="proker" name="proker" rows="4"></textarea>
                                </div>
                                <div class="my-4">
                                    <label for="proker">Program Kerja/Langkah Kerja/langkah Pencapaian target IKU (jika capaian < 95%)</label>
                                    <textarea class="form-control" id="proker" name="proker" rows="4"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                <button class="btn btn-tertiary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</main>

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const ikuSelector = document.getElementById("iku-selector");
    const ikuSubPointsContainer = document.getElementById("iku-sub-points");
    const selectedIkuDisplay = document.getElementById("selected-iku-text");
    const selectedIkuHeading = document.getElementById("selected-iku-heading");
    const selectedIkuInput = document.getElementById("selected-iku-id");
    const subPointsList = document.getElementById("sub-points-list");
    const selectedSubPointsInput = document.getElementById("selected-sub-points");

    const polaritasInput = document.querySelector("input[name='polaritas']");
    const bobotInput = document.querySelector("input[name='bobot']");
    const satuanInput = document.querySelector("input[name='satuan']");
    const baseInput = document.querySelector("input[name='base']");

    ikuSelector.addEventListener("change", function () {
        let selectedOption = ikuSelector.options[ikuSelector.selectedIndex];

        if (!selectedOption || !selectedOption.value) return;

        let isMultiPoint = selectedOption.getAttribute("data-is-multiple") === "1";
        let selectedIkuId = selectedOption.value.trim();

        selectedIkuDisplay.textContent = selectedOption.text;
        selectedIkuHeading.textContent = selectedOption.text;
        selectedIkuInput.value = selectedIkuId;

        polaritasInput.value = selectedOption.getAttribute("data-polaritas");
        bobotInput.value = selectedOption.getAttribute("data-bobot");
        satuanInput.value = selectedOption.getAttribute("data-satuan");
        baseInput.value = selectedOption.getAttribute("data-base");

        document.querySelectorAll(".sub-points-group").forEach(group => {
            group.style.display = "none";
        });

        if (isMultiPoint) {
            ikuSubPointsContainer.style.display = "block";
            let subPointGroup = document.querySelector(`.sub-points-group[data-iku-id='${selectedIkuId}']`);
            if (subPointGroup) {
                subPointGroup.style.display = "block";
            }
        } else {
            ikuSubPointsContainer.style.display = "none";
            selectedSubPointsInput.value = "";
        }
    });

    subPointsList.addEventListener("change", function (event) {
        if (event.target.name === "selected_iku_point") {
            let selectedSubPoint = event.target;
            let pointName = selectedSubPoint.nextElementSibling.textContent.trim();

            selectedIkuDisplay.textContent = pointName;
            selectedIkuHeading.textContent = pointName;
            selectedSubPointsInput.value = selectedSubPoint.value;

            polaritasInput.value = selectedSubPoint.getAttribute("data-polaritas");
            bobotInput.value = selectedSubPoint.getAttribute("data-bobot");
            satuanInput.value = selectedSubPoint.getAttribute("data-satuan");
            baseInput.value = selectedSubPoint.getAttribute("data-base");
        }
    });

    function calculateResults() {
    const nilai5 = parseFloat(document.querySelector('input[name="realisasi_sdbulan_ini"]').value) || 0;
    const nilai3 = parseFloat(document.querySelector('input[name="target_sdbulan_ini"]').value) || 0;
    const nilai1 = parseFloat(document.querySelector('input[name="base"]').value) || 0;
    const bobot = parseFloat(document.querySelector('input[name="bobot"]').value) || 0;
    const polaritas = document.querySelector('input[name="polaritas"]').value.trim().toLowerCase();

    // Calculate percentTarget based on polaritas
    let percentTarget;
    if (polaritas === "maximize") {
        percentTarget = nilai3 !== 0 ? (nilai5 / nilai3 * 100).toFixed(0) + "%" : "0%";
    } else {
        percentTarget = nilai5 !== 0 ? (nilai3 / nilai5 * 100).toFixed(0) + "%" : "0%";
    }

    // Calculate percentYear based on polaritas
    let percentYear;
    if (polaritas === "maximize") {
        percentYear = nilai1 !== 0 ? (nilai5 / nilai1 * 100).toFixed(0) + "%" : "0%";
    } else {
        percentYear = nilai5 !== 0 ? (nilai1 / nilai5 * 100).toFixed(0) + "%" : "0%";
    }

    // Compute additional calculations
    const N = nilai1 !== 0 ? (nilai5 / nilai1 * 100) : 0;
    const O = (N * bobot).toFixed(2);

    let Q = N;
    if (N > 120) {
        Q = 120;
    } else if (N < 0) {
        Q = 0;
    }

    const adjRaw = (Q * bobot).toFixed(2);
    const ttlRaw = O < 0 ? "0.00" : O;

    const adj = (parseFloat(adjRaw) / 100).toFixed(2);
    const ttl = (parseFloat(ttlRaw) / 100).toFixed(2);

    // Update input fields with calculated values
    document.querySelector('input[name="percent_target"]').value = percentTarget;
    document.querySelector('input[name="percent_year"]').value = percentYear;
    document.querySelector('input[name="ttl"]').value = ttl;
    document.querySelector('input[name="adj"]').value = adj;
}

// Attach event listener to inputs for real-time calculation
document.querySelectorAll('input[name="realisasi_sdbulan_ini"], input[name="target_sdbulan_ini"], input[name="base"], input[name="bobot"], input[name="polaritas"]').forEach(input => {
    input.addEventListener('input', calculateResults);
});

});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\ghifa\Documents\admin-dashboard\resources\views/pages/form-evaluasi.blade.php ENDPATH**/ ?>