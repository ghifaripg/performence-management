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
                <li class="breadcrumb-item active" aria-current="page">Tahun {{ $selectedYear }}</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
                <h4>Form Evaluasi IKU Bulan {{ $selectedMonth }}</h4>
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
        @foreach ($sasaranGrouped as $perspektif)
            @if (!empty($perspektif['ikus']))
                <optgroup label="{{ $perspektif['number'] }}. {{ $perspektif['perspektif'] }}">
                    @foreach ($perspektif['ikus'] as $iku)
                        <option value="{{ $iku->iku_id }}" data-is-multiple="{{ isset($iku->is_multi_point) ? $iku->is_multi_point : 0 }}">
                            {{ $iku->iku }} ({{ $iku->iku_id }})
                        </option>
                    @endforeach
                </optgroup>
            @endif
        @endforeach
    </select>
</div>

<!-- Container for IKU Sub-Points -->
<div id="iku-sub-points" style="display: none; padding-left: 20px;">
    <h5>Sub-Points:</h5>
    <ul id="sub-points-list">
        @foreach ($ikuPoints as $ikuId => $points)
            <ul class="sub-points-group" data-iku-id="{{ $ikuId }}" style="display: none;">
                @foreach ($points as $point)
                    <li>
                        <input type="radio" name="selected_iku_point" value="{{ $point->id }}" id="point_{{ $point->id }}">
                        <label for="point_{{ $point->id }}">{{ $point->point_name }} - {{ $point->base }} ({{ $point->satuan }})</label>
                    </li>
                @endforeach
            </ul>
        @endforeach
    </ul>
</div>


<!-- Hidden Input for Selected IKU and Points -->
<input type="hidden" id="selected-iku-id" name="selected_iku_id">
<input type="hidden" id="selected-sub-points" name="selected_sub_points">
<p>Selected IKU: <span id="selected-iku">None</span></p>

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
            <input type="hidden" name="month" value="{{ $selectedMonth }}">
            <div class="col-12 mb-4">
                <div class="card border-0 shadow components-section">
                    <div class="card-body">
                        <h5>IKU: <span id="selected-iku"></span></h5>
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
                <button class="btn btn-tertiary" type="submit">Submit</button>

                </div>
            </div>
        </form>
    </div>

</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const ikuSelector = document.getElementById('iku-selector');
        const selectedIkuInput = document.getElementById('selected-iku-id');
        const selectedIkuText = document.getElementById('selected-iku');
        const ikuSubPointsContainer = document.getElementById('iku-sub-points');
        const subPointsGroups = document.querySelectorAll('.sub-points-group');

        ikuSelector.addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];

            selectedIkuInput.value = selectedOption.value;
            selectedIkuText.textContent = selectedOption.textContent.trim();

            subPointsGroups.forEach(group => group.style.display = 'none');

            if (selectedOption.getAttribute('data-is-multiple') === '1') {
                ikuSubPointsContainer.style.display = 'block';

                const selectedIkuId = selectedOption.value;
                const matchingGroup = document.querySelector(`.sub-points-group[data-iku-id="${selectedIkuId}"]`);
                if (matchingGroup) {
                    matchingGroup.style.display = 'block';
                }
            } else {
                ikuSubPointsContainer.style.display = 'none';
            }
        });
        function calculateResults() {
        const nilai5 = parseFloat(document.querySelector('input[name="realisasi_sdbulan_ini"]').value) || 0;
        const nilai3 = parseFloat(document.querySelector('input[name="target_sdbulan_ini"]').value) || 0;
        const nilai1 = parseFloat(document.querySelector('input[name="base"]').value) || 0;
        const bobot = parseFloat(document.querySelector('input[name="bobot"]').value) || 0;
        const polaritas = document.querySelector('input[name="polaritas"]').value.trim().toLowerCase(); // Normalize text input

        let percentTarget;
        if (polaritas === "maximize") {
            percentTarget = nilai3 !== 0 ? (nilai5 / nilai3 * 100).toFixed(0) + "%" : "0%";
        } else {
            percentTarget = nilai5 !== 0 ? (nilai3 / nilai5 * 100).toFixed(0) + "%" : "0%";
        }

        const percentYear = nilai1 !== 0 ? (nilai5 / nilai1 * 100).toFixed(0) + "%" : "N/A";

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

        document.querySelector('input[name="percent_target"]').value = percentTarget;
        document.querySelector('input[name="percent_year"]').value = percentYear;
        document.querySelector('input[name="ttl"]').value = ttl;
        document.querySelector('input[name="adj"]').value = adj;
    }

    document.querySelectorAll('input[name="realisasi_sdbulan_ini"], input[name="target_sdbulan_ini"], input[name="base"], input[name="bobot"], input[name="polaritas"]').forEach(input => {
        input.addEventListener('input', calculateResults);
    });
    });
    </script>
@endsection
