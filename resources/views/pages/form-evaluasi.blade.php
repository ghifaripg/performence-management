<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['month'])) {
        $selectedYear = htmlspecialchars($_GET['month']);
    }
    ?>
@extends('layouts.app')

@section('title', 'Form Evaluasi IKU')

<main class="content">
@section('content')

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
                    <h4>Form Evaluasi IKU Bulan  </h4>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 mb-4">
                    <div class="card border-0 shadow components-section">
                        <div class="card-body">
                            <h5>Pilih Indikator Kinerja Utama</h5>
                            <div id="sasaran-checkbox-list">
                                @foreach($sasaranGrouped as $sasaranId => $sasaran)
                                    <div class="mb-3">
                                        <h6 class="mb-1">
                                            <input type="checkbox" class="form-check-input sasaran-checkbox"
                                                   name="selected_sasaran"
                                                   value="{{ $sasaranId }}"
                                                   id="sasaran_{{ $sasaranId }}">
                                            <label for="sasaran_{{ $sasaranId }}" class="fw-bold">
                                                {{ $sasaran['number'] }}. {{ $sasaran['perspektif'] }}
                                            </label>
                                        </h6>

                                        <div class="iku-list mt-2" id="iku-list-{{ $sasaranId }}" style="display: none;">
                                            @if(count($sasaran['ikus']) > 0)
                                                @foreach($sasaran['ikus'] as $iku)
                                                    <div class="form-check">
                                                        <input type="radio" class="form-check-input iku-checkbox"
                                                               name="selected_iku"
                                                               value="{{ $iku }}"
                                                               id="iku_{{ $sasaranId }}_{{ $loop->index }}">
                                                        <label class="form-check-label" for="iku_{{ $sasaranId }}_{{ $loop->index }}">
                                                            {{ $iku }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            @else
                                                <p class="text-muted">Tidak ada IKU untuk Perspektif ini. Silahkan Buat IKU Pada <a href="/form-iku">Form IKU</a></p>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form KPI -->
            <div class="row">
                <form method="POST" action="{{ route('store-iku') }}">
                    @csrf
                    <input type="hidden" id="selected-iku-id" name="selected_iku_id">
                    <input type="hidden" name="year" value="{{ $selectedYear }}">
                    <div class="col-12 mb-4">
                        <div class="card border-0 shadow components-section">
                            <div class="card-body">
                                <h5>IKU: <span id="selected-iku"></span></h5>
                                <div class="row mb-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <!-- Form -->
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
                                        <div class="mb-3">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" class="form-control" name="satuan" id="satuan">
                                        </div>
                                        <div class="mb-3">
                                            <h5>Target</h5>
                                            <label for="base">Tahun (1)</label>
                                            <input type="text" class="form-control" name="base" id="base">
                                            <label for="stretch">Bulan Ini (2)</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                            <label for="stretch">s/d Bulan Ini (3)</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                        </div>
                                        <div class="mb-3">
                                            <h5>Realisasi</h5>
                                            <label for="base">Bulan Ini (4)</label>
                                            <input type="text" class="form-control" name="base" id="base">
                                            <label for="stretch">s/d Bulan Ini (5)</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                        </div>
                                    </div>
                                    <div class="col-lg-2 col-sm-6">
                                    </div>
                                    <div class="col-lg-4 col-sm-6">

                                        <div class="mb-3">
                                            <h5>Prosentase Pencapaian THD Target</h5>
                                            <label for="base">6 = (5):(3) (6)</label>
                                            <input type="text" class="form-control" name="base" id="base">
                                            <label for="stretch">7 = (5):(1) (7)</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                        </div>
                                        <div class="mb-3">
                                            <h5>Score</h5>
                                            <label for="base">Ttl</label>
                                            <input type="text" class="form-control" name="base" id="base">
                                            <label for="stretch">Adj.</label>
                                            <input type="text" class="form-control" name="stretch" id="stretch">
                                        </div>
                                        <!-- Form -->
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
                        <button class="btn btn-tertiary" type="submit">Submit</button><br>
                    </div>
                </form>
            </div>


</main>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const sasaranCheckboxes = document.querySelectorAll('.sasaran-checkbox');
    const ikuLists = document.querySelectorAll('.iku-list');
    const ikuRadios = document.querySelectorAll('.iku-checkbox');
    const selectedIkuInput = document.getElementById('selected-iku-id');
    const selectedIkuText = document.getElementById('selected-iku');

    ikuLists.forEach(list => list.style.display = 'none');

    sasaranCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            sasaranCheckboxes.forEach(cb => {
                if (cb !== this) {
                    cb.checked = false;
                }
            });

            ikuLists.forEach(list => list.style.display = 'none');

            const selectedIkuList = document.getElementById('iku-list-' + this.value);
            if (this.checked && selectedIkuList) {
                selectedIkuList.style.display = 'block';
            }
        });
    });

    ikuRadios.forEach(ikuRadio => {
        ikuRadio.addEventListener('change', function() {
            selectedIkuInput.value = this.value;
            selectedIkuText.textContent = this.nextElementSibling.textContent;
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
