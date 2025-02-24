<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

@extends('layouts.app')

@section('title', 'Kontrak Manajemen')
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

<body>
    <?php
    $userId = Auth::user()->id;
    $name = Auth::user()->nama;
    $selectedYear = date('Y');
    if (isset($_GET['year'])) {
        $selectedYear = htmlspecialchars($_GET['year']);
    }
    ?>

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
                        <li class="breadcrumb-item"><a href="/kontrak">Kontrak Manajemen</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Pilih Tahun</li>
                    </ol>
                </nav>
                <div class="d-flex justify-content-between w-100 flex-wrap">
                    <div class="mb-3 mb-lg-0">
                    <h3>Tahun <?php echo $selectedYear; ?></h1>
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
                <div style="display: flex; justify-content: space-between; align-items: center; margin-left: 12px; margin-top: 25px; margin-bottom: 25px;">
                    <h3>KONTRAK MANAJEMEN TAHUN <?php echo $selectedYear ?></h3>
                    <img src="{{ asset('assets/img/Picture1.png')}}" class="img-kiec" alt="">
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-0 text-center" rowspan="2">#</th>
                            <th class="border-0 text-center" rowspan="2">Sasaran Strategis</th>
                            <th class="border-0 text-center" rowspan="2">Key Performance Indicator</th>
                            <th class="border-0 text-center" rowspan="2">Target</th>
                            <th class="border-0 text-center" rowspan="2">Satuan</th>
                            <th class="border-0 text-center" rowspan="2">Milestone</th>
                            <th class="border-0 text-center" rowspan="2">ESG/C</th>
                            <th class="border-0 text-center" rowspan="2">Polaritas</th>
                            <th class="border-0 text-center" rowspan="2">Bobot</th>
                            <th class="border-0 text-center" colspan="3">Matriks Tanggung Jawab</th>
                        </tr>
                        <tr>
                            <th class="border-0 text-center">DU</th>
                            <th class="border-0 text-center">DK</th>
                            <th class="border-0 text-center">DO</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sasaranGrouped as $sasaran)
                            @php
                                $rowCount = count($sasaran['kpis']);
                            @endphp
                            @foreach($sasaran['kpis'] as $index => $kpi)
                                <tr>
                                    @if ($index == 0)
                                        <td class="fw-bold align-middle text-center" rowspan="{{ $rowCount }}">{{ $sasaran['letter'] }}</td>
                                        <td class="fw-normal align-middle text-center" rowspan="{{ $rowCount }}">{{ $sasaran['name'] }}</td>
                                    @endif
                                    <td class="fw-normal text-center">{{ $index + 1 }}. {{ $kpi->kpi_name }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->target }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->satuan }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->milestone ?? '-' }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->esgc }}</td>
                                    <td class="fw-normal text-center">{{ ucfirst($kpi->polaritas) }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->bobot }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->du }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->dk }}</td>
                                    <td class="fw-normal text-center">{{ $kpi->do }}</td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
                <p style="white-space: pre">O (Overall)          :   Bertanggung Jawab secara keseluruhan
R (Responsible)  :   Penanggung Jawab, Pemilik Proses
S (Support)         :   Pendukung
                </p>

            </div><br>
            <form action="{{ route('export.kontrak') }}" method="GET">
                <input type="hidden" name="year" value="{{ $selectedYear }}">
                <button type="submit" class="btn btn-pill btn-outline-success">Export to Excel</button>
            </form>
        <?php if ($userId == 1): ?>
        <div class="mt-5">
            <a href="{{ route('check-kontrak', ['year' => $selectedYear]) }}" class="btn btn-primary">
                Tambah/Ubah Kontrak Manajemen
            </a>
        </div>
        <?php endif; ?>
        </main>

@endsection
