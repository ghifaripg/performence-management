<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

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
@extends('layouts.app')

@section('title', 'Form IKU')

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
                <li class="breadcrumb-item"><a href="/iku">IKU</a></li>
                <li class="breadcrumb-item active" aria-current="page">Pilih Tahun</li>
            </ol>
        </nav>
        <div class="d-flex justify-content-between w-100 flex-wrap">
            <div class="mb-3 mb-lg-0">
            <h1>IKU <?php echo $departmentName ?> Tahun <?php echo $selectedYear; ?></h1>
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
            <h3>FORM IKU <?php echo $departmentName ?> TAHUN <?php echo $selectedYear ?></h3>
            <img src="{{ asset('assets/img/Picture1.png')}}" class="img-kiec" alt="">
        </div>
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
                        @foreach($sasaranGrouped as $sasaran)
                            @php $rowCount = count($sasaran['ikus']); @endphp
                            @foreach ($sasaran['ikus'] as $index => $iku)
                                @php
                                    $ikuPointList = $iku->points ?? collect();
                                    $maxRows = max(1, $ikuPointList->count());
                                @endphp

                                <tr>
                                    @if ($index == 0)
                                        <td class="fw-bold align-middle text-center" rowspan="{{ $rowCount * $maxRows }}">{{ $sasaran['number'] }}</td>
                                        <td class="fw-normal align-middle text-center" rowspan="{{ $rowCount * $maxRows }}">{{ $sasaran['perspektif'] }}</td>
                                    @endif

                                    <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{{ $iku->iku_atasan }}</td>
                                    <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{{ $iku->target }}</td>

                                    <!-- Main IKU (Merged for All Points) -->
                                    <td class="fw-normal text-start" rowspan="{{ $maxRows }}">
                                        <strong>{{ $iku->iku }}</strong>
                                        @foreach ($ikuPointList as $point)
                                            <br>{{ $point->point_name }}
                                        @endforeach
                                    </td>

                                    @php $firstPoint = $ikuPointList->first(); @endphp
                                    <td class="fw-normal text-center">{{ $firstPoint->base ?? '-' }}</td>
                                    <td class="fw-normal text-center">{{ $firstPoint->stretch ?? '-' }}</td>
                                    <td class="fw-normal text-center">{{ $firstPoint->satuan ?? '-' }}</td>
                                    <td class="fw-normal text-center">{{ ucfirst($firstPoint->polaritas ?? '-') }}</td>
                                    <td class="fw-normal bobot-cell">{{ $firstPoint->bobot ?? '-' }}</td>

                                    <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{!! nl2br(e($iku->proker)) !!}</td>
                                    <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{{ $iku->pj }}</td>
                                    <td class="fw-normal text-center" rowspan="{{ $maxRows }}">
                                        <form action="{{ route('edit-iku', $iku->id) }}" method="GET">
                                            @csrf
                                            <button type="submit" class="btn btn-pill btn-outline-tertiary">
                                                <i class="fas fa-edit me-1"></i>Edit
                                            </button>
                                        </form>
                                        <form action="{{ route('delete-iku', $iku->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this IKU?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-pill btn-outline-danger">
                                                <i class="fas fa-trash-alt me-1"></i>Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- IKU Points (without showing main IKU again) -->
                                @foreach ($ikuPointList->skip(1) as $point)
                                    <tr>
                                        <td class="fw-normal text-center">{{ $point->base ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ $point->stretch ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ $point->satuan ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ ucfirst($point->polaritas ?? '-') }}</td>
                                        <td class="fw-normal bobot-cell">{{ $point->bobot ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @endforeach
                    </tbody>
        </table>
    </div><br>
    <form action="{{ route('export.iku') }}" method="GET">
        <input type="hidden" name="year" value="{{ $selectedYear }}">
        <button type="submit" class="btn btn-pill btn-outline-success">Export to Excel</button>
    </form>
    <div class="mt-5">
        <a href="{{ route('check-iku', ['year' => $selectedYear]) }}" class="btn btn-primary">
            Tambah/Ubah IKU
        </a>
    </div>
</main>
@endsection
