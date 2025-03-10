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
<!-- Favicon -->
<link rel="apple-touch-icon" sizes="120x120" href="{{ asset ('assets/img/favicon/apple-touch-icon.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/img/favicon-32x32.png') }}">
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/img/favicon-16x16.png') }}">
<link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}">

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
            <h3>IKU <?php echo $departmentName ?> Tahun <?php echo $selectedYear; ?></h3>
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
    <div>

    </div>

    <div class="d-flex align-items-center mb-2">
        @php
        $isAccepted = DB::table('progres')
            ->where('iku_id', $iku_ikuIdentifier)
            ->where('status', 'accept')
            ->exists();
    @endphp

    @if ($isAccepted)
        <form action="{{ route('export.iku') }}" method="GET" class="me-auto">
            <input type="hidden" name="year" value="{{ $selectedYear }}">
            <button type="button" class="btn btn-outline-success d-inline-flex align-items-center" onclick="getNamesAndExport()">
                Export to Excel
                <svg class="icon icon-xxs ms-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M2 9.5A3.5 3.5 0 005.5 13H9v2.586l-1.293-1.293a1 1 0 00-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 15.586V13h2.5a4.5 4.5 0 10-.616-8.958 4.002 4.002 0 10-7.753 1.977A3.5 3.5 0 002 9.5zm9 3.5H9V8a1 1 0 012 0v5z" clip-rule="evenodd" /></svg>
            </button>
        </form>
    @else
    <form action="/progres" method="GET" class="me-auto">
        <button type="submit" class="btn btn-pill btn-outline-info">Progres Form IKU</button>
    </form>
    @endif

        <div>
            <!-- Zoom Out Button -->
            <button class="btn btn-outline-secondary zoom-btn me-2" data-zoom="out">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-out" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                    <path d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z"/>
                    <path fill-rule="evenodd" d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5"/>
                </svg>
            </button>

            <!-- Zoom In Button -->
            <button class="btn btn-outline-secondary zoom-btn" data-zoom="in">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11M13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0"/>
                    <path d="M10.344 11.742q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1 6.5 6.5 0 0 1-1.398 1.4z"/>
                    <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5"/>
                </svg>
            </button>
        </div>
    </div>


    <div class="form-iku table-wrapper table-responsive">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-left: 12px; margin-top: 25px; margin-bottom: 25px;">
            <img src="{{ asset('assets/img/logo-ksp.jpg')}}" class="img-kiecs" alt="">
            <h6 style="text-transform: uppercase">form iku <?php echo $departmentName?> <?php echo $selectedYear?></h6>
        </div>

        <!-- Search Bar -->
        <div class="mb-3" style="text-align: right; padding-right: 20px;">
            <input type="text" id="searchInput" class="form-control" placeholder="Search...">
        </div>

        <!-- Table Container -->
        <div id="zoomContainer">
            <table class="table table-hover" id="ikuTable">
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
                    </tr>
                    <tr>
                        <th class="border-0 text-center">IKU Atasan</th>
                        <th class="border-0 text-center">Target</th>
                        <th class="border-0 text-center">Base</th>
                        <th class="border-0 text-center">Stretch</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($sasaranGrouped as $sasaran)
                        @php
                            $ikuCount = count($sasaran['ikus']);
                            $totalRows = 0;
                            $ikuAtasanRowspan = [];
                            $targetRowspan = [];

                            foreach ($sasaran['ikus'] as $iku) {
                                $ikuPointList = collect($iku->points ?? []);
                                $maxRows = max(1, $ikuPointList->count());
                                $totalRows += $maxRows;

                                $ikuAtasanRowspan[$iku->iku_atasan] = ($ikuAtasanRowspan[$iku->iku_atasan] ?? 0) + $maxRows;
                                $targetRowspan[$iku->target] = ($targetRowspan[$iku->target] ?? 0) + $maxRows;
                            }
                        @endphp

                        @foreach ($sasaran['ikus'] as $index => $iku)
                            @php
                                $ikuPointList = collect($iku->points ?? []);
                                $maxRows = max(1, $ikuPointList->count());
                            @endphp

                            <tr>
                                @if ($index == 0)
                                    <td class="fw-bold align-middle text-center" rowspan="{{ $totalRows }}">
                                        {{ $sasaran['number'] }}
                                    </td>
                                    <td class="fw-normal align-middle text-center" rowspan="{{ $totalRows }}">
                                        {{ $sasaran['perspektif'] }}
                                    </td>
                                @endif

                                @if ($ikuAtasanRowspan[$iku->iku_atasan] > 0)
                                    <td class="fw-normal text-center" rowspan="{{ $ikuAtasanRowspan[$iku->iku_atasan] }}">
                                        {{ $iku->iku_atasan }}
                                    </td>
                                    @php
                                        $ikuAtasanRowspan[$iku->iku_atasan] = 0;
                                    @endphp
                                @endif

                                @if ($targetRowspan[$iku->target] > 0)
                                    <td class="fw-normal text-center" rowspan="{{ $targetRowspan[$iku->target] }}">
                                        {{ $iku->target }}
                                    </td>
                                    @php
                                        $targetRowspan[$iku->target] = 0;
                                    @endphp
                                @endif

                                <td class="fw-normal text-start" rowspan="{{ $maxRows }}">
                                    <strong class="fw-normal text-center">{{ $iku->iku }}</strong>
                                    @if($ikuPointList->isNotEmpty())
                                        <ul class="m-0 p-0">
                                            @foreach ($ikuPointList as $point)
                                                <li style="font-size: 0.875rem;">{{ $point->point_name }}</li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </td>

                                @php
                                    $firstPoint = $ikuPointList->first() ?? null;
                                @endphp
                                <td class="fw-normal text-center">
                                    {{ $firstPoint->base ?? $iku->base ?? '-' }}
                                </td>
                                <td class="fw-normal text-center">
                                    {{ $firstPoint->stretch ?? $iku->stretch ?? '-' }}
                                </td>
                                <td class="fw-normal text-center">
                                    {{ $firstPoint->satuan ?? $iku->satuan ?? '-' }}
                                </td>
                                <td class="fw-normal text-center">
                                    {{ ucfirst($firstPoint->polaritas ?? $iku->polaritas ?? '-') }}
                                </td>
                                <td class="fw-normal bobot-cell">
                                    {{ $firstPoint->bobot ?? $iku->bobot ?? '-' }}
                                </td>

                                <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{!! nl2br(e($iku->proker)) !!}</td>
                                <td class="fw-normal text-center" rowspan="{{ $maxRows }}">{{ $iku->pj }}</td>
                            </tr>

                            @if ($ikuPointList->count() > 1)
                                @foreach ($ikuPointList->slice(1) as $point)
                                    <tr>
                                        <td class="fw-normal text-center">{{ $point->base ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ $point->stretch ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ $point->satuan ?? '-' }}</td>
                                        <td class="fw-normal text-center">{{ ucfirst($point->polaritas ?? '-') }}</td>
                                        <td class="fw-normal bobot-cell">{{ $point->bobot ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <script>
    document.getElementById("searchInput").addEventListener("keyup", function () {
        var filter = this.value.toLowerCase();
        var rows = document.querySelectorAll("#ikuTable tbody tr");

        rows.forEach(function (row) {
            var text = row.innerText.toLowerCase();
            row.style.display = text.includes(filter) ? "" : "none";
        });
    });
    </script>
    <br>

    <div class="mt-1 mb-3">
        <a href="{{ route('check-iku', ['year' => $selectedYear]) }}" class="btn btn-sm btn-gray-800 d-inline-flex align-items-center">
            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah/Ubah
        </a>
    </div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function () {
    let zoomLevel = 1;
    const zoomContainer = document.getElementById("zoomContainer");

    document.querySelectorAll(".zoom-btn").forEach(button => {
        button.addEventListener("click", function () {
            const zoomType = this.getAttribute("data-zoom");

            if (zoomType === "in" && zoomLevel < 1.5) {
                zoomLevel += 0.1;
            } else if (zoomType === "out" && zoomLevel > 0.7) {
                zoomLevel -= 0.1;
            }

            zoomContainer.style.transform = `scale(${zoomLevel})`;
            zoomContainer.style.transformOrigin = "top center";
        });
    });
});
</script>
<script>
async function getNamesAndExport() {
    const { value: formValues } = await Swal.fire({
        title: "Masukkan Nama Pimpinan",
        html: `
            <label for="swal-input1">HC & Finance Directorate</label>
            <input id="swal-input1" class="swal2-input" placeholder="Nama HC & Finance Directorate">
            <label for="swal-input2">Manager</label>
            <input id="swal-input2" class="swal2-input" placeholder="Nama Manager">
        `,
        focusConfirm: false,
        preConfirm: () => {
            return {
                hc_directorate: document.getElementById("swal-input1").value,
                manager: document.getElementById("swal-input2").value,
            };
        }
    });

    if (formValues) {
        const year = document.querySelector('input[name="year"]').value;
        formValues.year = year;

        const queryString = new URLSearchParams(formValues).toString();
        window.location.href = "{{ route('export.iku') }}?" + queryString;
    }
}

</script>
@endsection
