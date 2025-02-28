<?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
?>
@extends('layouts.app')
@include('partials.favicon')
@section('title', 'Evaluasi IKU')

<main class="content">
    @section('content')

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
                <h3>Form Evaluasi Iku {{ $departmentName }} Bulan {{ $selectedMonthName }}</h3>
                <form method="GET" class="mb-3">
                    <label for="month-year" class="form-label">Pilih Periode:</label>
                    <input type="month" id="month-year" name="month-year" class="form-control w-auto d-inline"
                        value="{{ date('Y-m', strtotime("$selectedYear-$selectedMonth-01")) }}">
                    <button type="submit" class="btn btn-primary">Pilih</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card card-body border-0 shadow table-wrapper table-responsive">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-left: 12px; margin-top: 25px; margin-bottom: 25px;">
            <img src="{{ asset('assets/img/logo-ksp.jpg')}}" class="img-kiecs" alt="">
            <h5 style="text-transform: uppercase">EVALUASI PENCAPAIAN INDIKATOR KINERJA UTAMA (IKU) s/d BULAN <?php echo $selectedMonthName?></h5>
        </div>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th class="border-0 text-center" rowspan="2">Indikator Kinerja Utama</th>
                    <th class="border-0 text-center" rowspan="2">Polaritas</th>
                    <th class="border-0 text-center" rowspan="2">Bobot (A)</th>
                    <th class="border-0 text-center" rowspan="2">Satuan</th>
                    <th class="border-0 text-center" colspan="3">Target</th>
                    <th class="border-0 text-center" colspan="2">Realisasi</th>
                    <th class="border-0 text-center" colspan="2">Prosentase Pencapaian THD Target</th>
                    <th class="border-0 text-center" colspan="2">Score</th>
                    <th class="border-0 text-center" rowspan="3">Penyebab Tidak Tercapai</th>
                    <th class="border-0 text-center" rowspan="3">Program Kerja/Langkah Kerja/langkah Pencapaian target IKU (jika capaian < 95%)</th>
                </tr>
                <tr>
                    <th class="border-0 text-center">Tahun (1)</th>
                    <th class="border-0 text-center"style="white-space:pre">Bulan ini
(2)</th>
                    <th class="border-0 text-center" style="white-space:pre">s/d Bulan ini
(3)</th>
                    <th class="border-0 text-center" style="white-space:pre">Bulan ini
(4)</th>
                    <th class="border-0 text-center" style="white-space:pre">s/d Bulan ini
(5)</th>
                    <th class="border-0 text-center" style="white-space:pre">6=(5):(3)
(6)</th>
                    <th class="border-0 text-center" style="white-space:pre">7=(5):(1)
(7)</th>
                    <th class="border-0 text-center">Ttl</th>
                    <th class="border-0 text-center">Adj.</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 1; @endphp
                @foreach ($evaluations as $eval)
                    <tr>
                        <td class="fw-normal text-center">{{ $eval->iku_name }}
                            @if($eval->sub_point_name)
                                <br> <span style="font-size: 0.9em; color: gray;">{{ $eval->sub_point_name }}</span>
                            @endif
                        </td>
                        <td class="fw-normal text-center">{{ $eval->polaritas }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->bobot, 2) }}</td>
                        <td class="fw-normal text-center">{{ $eval->satuan }}</td>
                        <td class="fw-normal text-center">{{ number_format((float) $eval->base, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->target_bulan_ini, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->target_sdbulan_ini, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->realisasi_bulan_ini, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->realisasi_sdbulan_ini, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format((float) $eval->percent_target, 2) }}%</td>
                        <td class="fw-normal text-center">{{ number_format((float) $eval->percent_year, 2) }}%</td>
                        <td class="fw-normal text-center">{{ number_format($eval->ttl, 2) }}</td>
                        <td class="fw-normal text-center">{{ number_format($eval->adj, 2) }}</td>
                        <td class="fw-normal text-center">{{ $eval->penyebab_tidak_tercapai }}</td>
                        <td class="fw-normal text-center">{{ $eval->program_kerja }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        <a href="/form-evaluasi?month={{ $selectedMonth }}&year={{ $selectedYear }}" class="btn btn-primary">
            Tambah/Ubah Form Evaluasi
        </a>
    </div>

</main>
@endsection
